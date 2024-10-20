<?php
/**
 * SureFormsSendData.
 * php version 5.6
 *
 * @category SureFormsSendData
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */

namespace SureTriggers\Integrations\SureForms\Actions;

use SureTriggers\Integrations\AutomateAction;
use SureTriggers\Traits\SingletonLoader;

/**
 * SureFormsSendData
 *
 * @category SureFormsSendData
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */
class SureFormsSendData extends AutomateAction {

	/**
	 * Integration type.
	 *
	 * @var string
	 */
	public $integration = 'SureForms';

	/**
	 * Action name.
	 *
	 * @var string
	 */
	public $action = 'sureforms_send_data';

	use SingletonLoader;

	/**
	 * Register a action.
	 *
	 * @param array $actions actions.
	 * @return array
	 */
	public function register( $actions ) {
		$actions[ $this->integration ][ $this->action ] = [
			'label'    => __( 'Send Data', 'suretriggers' ),
			'action'   => $this->action,
			'function' => [ $this, 'action_listener' ],
		];
		return $actions;
	}

	/**
	 * Action listener.
	 *
	 * @param int   $user_id user_id.
	 * @param int   $automation_id automation_id.
	 * @param array $fields fields.
	 * @param array $selected_options selectedOptions.
	 * @psalm-suppress UndefinedMethod
	 * 
	 * @throws \Exception Exception.
	 *
	 * @return array|mixed
	 */
	public function _action_listener( $user_id, $automation_id, $fields, $selected_options ) {
		$method       = $selected_options['method'] ? $selected_options['method'] : 'post';
		$endpoint_url = $selected_options['endpoint_url'];
		$payload_type = $selected_options['payload_type'];

		// Handling SSRF Attack.
		$blocked_hosts = [
			'127.0.0.1', // Local access.
			'localhost',
			'192.168.0.0/16', // Organization access.
			'10.0.0.0/8',
			'172.16.0.0/12',
			'169.254.0.0/16',
			'0.0.0.0',
			'0.0.0.0/0',
			'169.254.169.254', // EC2 meta-data access.
		];

		$host = wp_parse_url( $endpoint_url, PHP_URL_HOST );

		if ( in_array( $host, $blocked_hosts ) ) {
			throw new \Exception( 'Access blocked.' );
		}
		$body = [];
		if ( ! empty( $selected_options['parameters'] ) ) {
			$body = $this->prepare_params( $selected_options['parameters'] );
		}
		$headers = [];
		if ( ! empty( $selected_options['header'] ) ) {
			$headers = $this->prepare_params( $selected_options['header'] );
		}

		$args = [
			'method'    => strtoupper( $method ),
			'headers'   => array_merge(
				$headers,
				[
					'User-Agent' => 'SureTriggers',
				]
			),
			'sslverify' => true,
			'timeout'   => 30, // phpcs:ignore WordPressVIPMinimum.Performance.RemoteRequestTimeout.timeout_timeout
		];

		switch ( $payload_type ) {
			case 'query_params':
				// Add query arguments to the endpoint URL.
				$endpoint_url = $this->add_query_arg( $body, $endpoint_url );
				break;
			case 'form_data':
				$args['body']                    = $body;
				$args['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
				break;
		}

		if ( null === $endpoint_url ) {
			return [];
		}
		// Send the HTTP request based on the method.
		$response = wp_remote_request( $endpoint_url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			if ( ! empty( $selected_options['test_action'] ) ) {
				return [
					'success' => false,
					'message' => 'Error: ' . $error_message,
				];
			}
			throw new \Exception( 'Request failed: ' . $error_message );
		}
		
		// Check for successful HTTP status codes (200, 201, 204).
		$status_code = wp_remote_retrieve_response_code( $response );
		if ( ! in_array( $status_code, [ 200, 201, 204 ], true ) ) {
			$error = 'Failed to communicate with the API: ' . $endpoint_url;
			if ( ! empty( $selected_options['test_action'] ) ) {
				return [
					'success' => false,
					'message' => $error,
				];
			}
			throw new \Exception( 'API request failed: ' . wp_remote_retrieve_body( $response ) );
		}

		$result = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( json_last_error() !== JSON_ERROR_NONE ) {
			$result = [ 'response' => wp_remote_retrieve_body( $response ) ];
		}
		return $result;
	}

	/**
	 * Prepare params
	 * 
	 * @param array $parameters_input parameters_input.
	 *
	 * @return array
	 */
	public static function prepare_params( array $parameters_input = [] ) {
		$parameters = [];
		if ( is_array( $parameters_input ) && count( $parameters_input ) ) {
			$param_key   = array_column( $parameters_input, 'key' );
			$param_value = array_column( $parameters_input, 'value' );
			$parameters  = array_combine( $param_key, $param_value );
		}

		return $parameters;
	}

	/**
	 * Added query argument
	 *
	 * @param  array  $args Args.
	 * @param  string $url URL.
	 * 
	 * @return string|null
	 */
	public static function add_query_arg( $args, $url ) {
		$url_parts = wp_parse_url( $url );
		if ( false === $url_parts ) {
			return $url;
		}
		$query      = isset( $url_parts['query'] ) ? $url_parts['query'] : '';
		$query_args = [];
		$query      = str_replace( '+', '%2B', $query );
		parse_str( $query, $query_args );
		$query_args = array_merge( $query_args, $args );
		$query      = http_build_query( $query_args );
		$scheme     = isset( $url_parts['scheme'] ) ? $url_parts['scheme'] . '://' : '';
		$host       = isset( $url_parts['host'] ) ? $url_parts['host'] : '';
		$path       = isset( $url_parts['path'] ) ? $url_parts['path'] : '';
		
		$result = $scheme . $host . $path;
		if ( ! empty( $query ) ) {
			$result .= ( strpos( $result, '?' ) === false ? '?' : '&' ) . $query;
		}

		return preg_replace( '/%5B\d+%5D/', '[]', $result );
	}

}

SureFormsSendData::get_instance();
