<?php
/**
 * View: Virtual Instructor error message.
 *
 * @since 4.13.0
 * @version 4.13.0
 *
 * @var Chat_Message $message Chat message object.
 * @var Template     $this    Current instance of template engine rendering this template.
 *
 * @package LearnDash\Core
 */

use LearnDash\Core\Modules\AI\Chat_Message;
use LearnDash\Core\Template\Template;
?>
<div class="ld-virtual-instructor-chatbox__message ld-virtual-instructor-chatbox__message--error">
	<p class="ld-virtual-instructor-chatbox__message__text">
		<span class="ld-virtual-instructor-chatbox__message__label ld-virtual-instructor-chatbox__message__label--error">
			<?php esc_html_e( 'Error', 'learndash' ); ?>:
		</span>
		<span class="ld-virtual-instructor-chatbox__message__content">
			<?php echo esc_html( $message->content ); ?>
		</span>
	</p>
</div>

