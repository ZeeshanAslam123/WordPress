<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_style' );
				function buddyboss_theme_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}

/**
 * Your code goes below.
 */

// add_action( 'wp_head', 'lcf_display_section_toggler' );
function lcf_display_section_toggler() {

	if ( !function_exists('learndash_is_course_post') || !learndash_is_course_post(get_the_ID()) ) {
		return false;
	}

	?>
	<style>
        .ld-expand-button .ld-icon-arrow-down {
            transition: transform 0.3s ease;
        }

        .ld-expand-button.ld-expanded .ld-icon-arrow-down {
            transform: rotate(180deg);
        }

        .ld-item-list-section-heading {
            display: flex;
            align-items: baseline;
        }

        .ldc-section-button {
            justify-content: flex-start !important;
            padding-right: 10px !important;
            width: max-content !important;
        }

        /* hidden by default */
        .ld-section-wrapper {
            display: none;
        }
    </style>

	<script>
		jQuery(document).ready(function($) {
			$(".ld-item-list-section-heading").each(function(index) {
				var heading = $(this);

				// avoid duplicate button
				if (heading.find('.ldc-section-button').length) return;

				// create toggle button
				var btn = $('<button>', {
					type: 'button',
					class: 'ld-expand-button ld-button-alternate ldc-section-button',
					'aria-expanded': 'false',
					'data-ld-expands': 'ld-section-' + index,
					html: '<span class="ld-icon-arrow-down ld-icon ld-primary-background"></span>'
				});

				heading.prepend(btn);

				// create wrapper
				var wrapper = $('<div>', {
					class: 'ld-item-list-item-expanded ld-section-wrapper',
					id: 'ld-section-' + index
				});

				// collect all siblings until next heading
				var next = heading.next();
				while (next.length && !next.hasClass('ld-item-list-section-heading')) {
					var toMove = next;
					next = next.next();
					wrapper.append(toMove); // move content inside wrapper
				}

				// insert wrapper right after heading
				heading.after(wrapper);

				// click toggle
				btn.on('click', function() {
					var isExpanded = btn.hasClass('ld-expanded');

					if (!isExpanded) {
						btn.addClass('ld-expanded').attr('aria-expanded', 'true');
						heading.addClass('ld-expanded');
						wrapper.stop(true, true).slideDown(300);
					} else {
						btn.removeClass('ld-expanded').attr('aria-expanded', 'false');
						heading.removeClass('ld-expanded');
						wrapper.stop(true, true).slideUp(300);
					}
				});
			});
		});
    </script>

	<?php
}
/**
 * Enqueue custom scripts and styles for LearnDash collapsible sections
 */
add_action( 'wp_enqueue_scripts', 'learndash_collapsible_sections_assets' );
function learndash_collapsible_sections_assets() {
	// Only load on course pages
	if ( function_exists('learndash_is_course_post') && learndash_is_course_post(get_the_ID()) ) {
		wp_enqueue_script( 
			'course-sections-toggle', 
			get_stylesheet_directory_uri() . '/assets/js/course-sections-toggle.js', 
			array('jquery'), 
			'1.0.0', 
			true 
		);
		
		// Add inline CSS for collapsible sections
		wp_add_inline_style( 'child-style', '
			/* Collapsible Section Styles */
			.ld-collapsible-section-header {
				cursor: pointer;
				transition: all 0.3s ease;
				border-radius: 4px;
				padding: 15px;
				margin-bottom: 10px;
				background: #f8f9fa;
				border: 1px solid #e9ecef;
			}
			
			.ld-collapsible-section-header:hover {
				background: #e9ecef;
			}
			
			.ld-section-toggle-wrapper {
				display: flex;
				align-items: center;
				width: 100%;
			}
			
			.ld-section-toggle-icon {
				margin-right: 12px;
				transition: transform 0.3s ease;
			}
			
			.ld-section-toggle-icon .ld-icon {
				font-size: 14px;
				color: #6c757d;
			}
			
			.ld-collapsible-section-header.expanded .ld-section-toggle-icon {
				transform: rotate(90deg);
			}
			
			.ld-lesson-section-heading {
				font-weight: 600;
				font-size: 16px;
				color: #495057;
				margin: 0;
			}
			
			.ld-section-lessons {
				margin-left: 20px;
				border-left: 2px solid #e9ecef;
				padding-left: 20px;
				margin-bottom: 20px;
			}
			
			.ld-section-wrapper {
				margin-bottom: 20px;
			}
			
			/* Animation for section content */
			.ld-section-lessons {
				overflow: hidden;
				transition: all 0.3s ease;
			}
			
			/* Ensure proper spacing for lessons within sections */
			.ld-section-lessons .ld-item-list-item {
				margin-bottom: 10px;
			}
			
			/* Style adjustments for better visual hierarchy */
			.ld-collapsible-sections .ld-item-list-item {
				border-radius: 4px;
				border: 1px solid #e9ecef;
				margin-bottom: 8px;
			}
		');
	}
}
