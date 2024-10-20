<?php
/**
 * CreateTask.
 * php version 5.6
 *
 * @category CreateTask
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */

namespace SureTriggers\Integrations\FluentBoards\Actions;

use Exception;
use SureTriggers\Integrations\AutomateAction;
use SureTriggers\Traits\SingletonLoader;
/**
 * CreateTask
 *
 * @category CreateTask
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */
class CreateTask extends AutomateAction {


	/**
	 * Integration type.
	 *
	 * @var string
	 */
	public $integration = 'FluentBoards';

	/**
	 * Action name.
	 *
	 * @var string
	 */
	public $action = 'fbs_create_task';

	use SingletonLoader;

	/**
	 * Register a action.
	 *
	 * @param array $actions actions.
	 * @return array
	 */
	public function register( $actions ) {

		$actions[ $this->integration ][ $this->action ] = [
			'label'    => __( 'Create Task', 'suretriggers' ),
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
	 * @param array $selected_options selected_options.
	 *
	 * @return array|void
	 *
	 * @throws Exception Exception.
	 */
	public function _action_listener( $user_id, $automation_id, $fields, $selected_options ) {
		$title          = sanitize_text_field( $selected_options['title'] );
		$board_id       = sanitize_text_field( $selected_options['board_id'] );
		$stage_id       = sanitize_text_field( $selected_options['stage_id'] );
		$priority       = sanitize_text_field( $selected_options['priority'] );
		$status         = sanitize_text_field( $selected_options['status'] );
		$crm_contact_id = sanitize_text_field( $selected_options['crm_contact_id'] );
		$task_data      = [
			'title'          => $title,
			'board_id'       => $board_id,
			'stage_id'       => $stage_id,
			'priority'       => $priority,
			'status'         => $status,
			'crm_contact_id' => $crm_contact_id,
		];
		if ( ! function_exists( 'FluentBoardsApi' ) ) {
			return;
		}
		return FluentBoardsApi( 'tasks' )->create( $task_data );
	}
}

CreateTask::get_instance();
