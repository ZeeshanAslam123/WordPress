<?php
/**
 * LearnDash LD30 Displays section with toggle functionality
 * Custom template for BuddyBoss Child Theme
 *
 * Available Variables:
 * WIP
 *
 * @since 3.0.0
 *
 * @package LearnDash\Templates\LD30
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fires before the section title (outside wrapper).
 *
 * @since 3.0.0
 *
 * @param WP_Post $section   `WP_Post` object for section.
 * @param int     $course_id Course ID.
 * @param int     $user_id   User ID.
 */
do_action( 'learndash-before-section-heading', $section, $course_id, $user_id ); ?>
<div class="ld-item-list-section-heading ld-item-section-heading-<?php echo esc_attr( $section->ID ); ?> ld-collapsible-section-header" data-section-toggle="<?php echo esc_attr( $section->ID ); ?>">
	<?php
	/**
	 * Fires before the section title (inside wrapper).
	 *
	 * @since 3.0.0
	 *
	 * @param WP_Post $section   `WP_Post` object for section.
	 * @param int     $course_id Course ID.
	 * @param int     $user_id   User ID.
	 */
	do_action( 'learndash-before-inner-section-heading', $section, $course_id, $user_id );
	?>
	
	<div class="ld-section-toggle-wrapper">
		<div class="ld-section-toggle-icon">
			<span class="ld-icon ld-icon-arrow-right" aria-hidden="true"></span>
		</div>
		<div class="ld-lesson-section-heading" aria-role="heading" aria-level="3">
			<?php echo esc_html( $section->post_title ); ?>
		</div>
	</div>
	
	<?php
	/**
	 * Fires after the section title (inside wrapper).
	 *
	 * @since 3.0.0
	 *
	 * @param WP_Post $section   `WP_Post` object for section.
	 * @param int     $course_id Course ID.
	 * @param int     $user_id   User ID.
	 */
	do_action( 'learndash-after-inner-section-heading', $section, $course_id, $user_id );
	?>
</div>
<?php
/**
 * Fires after the section title (outside wrapper).
 *
 * @since 3.0.0
 *
 * @param WP_Post $section   `WP_Post` object for section.
 * @param int     $course_id Course ID.
 * @param int     $user_id   User ID.
 */
do_action( 'learndash-after-section-heading', $section, $course_id, $user_id );

