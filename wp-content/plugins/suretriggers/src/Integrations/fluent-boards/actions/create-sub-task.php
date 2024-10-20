<?php
/**
 * CreateSubTask.
 * php version 5.6
 *
 * @category CreateSubTask
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
 * CreateSubTask
 *
 * @category CreateSubTask
 * @package  SureTriggers
 * @author   BSF <username@example.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     https://www.brainstormforce.com/
 * @since    1.0.0
 */
class CreateSubTask extends AutomateAction {


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
	public $action = 'fbs_create_sub_task';

	use SingletonLoader;

	/**
	 * Register a action.
	 *
	 * @param array $actions actions.
	 * @return array
	 */
	public function register( $actions ) {

		$actions[ $this->integration ][ $this->action ] = [
			'label'    => __( 'Create Sub Task', 'suretriggers' ),
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
		$title     = sanitize_text_field( $selected_options['title'] );
		$task_id   = sanitize_text_field( $selected_options['task_id'] );
		$board_id  = sanitize_text_field( $selected_options['board_id'] );
		$stage_id  = sanitize_text_field( $selected_options['stage_id'] );
		$priority  = sanitize_text_field( $selected_options['priority'] );
		$status    = sanitize_text_field( $selected_options['status'] );
		$task_data = [
			'title'    => $title,
			'stage_id' => $stage_id,
			'priority' => $priority,
			'status'   => $status,
		];
		if ( ! class_exists( 'FluentBoards\App\Models\Task' ) ) {
			return;
		}
		$sub_task = \FluentBoards\App\Models\Task::createSubtask(
			$board_id,
			$task_id,
			$task_data
		);
		return $sub_task;
	}
}

CreateSubTask::get_instance();
