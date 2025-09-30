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
			/* Custom Section Header - Matches LearnDash lesson item styling exactly */
			.custom-section-item {
				border: 2px solid #e2e7ed;
				border-radius: 6px;
				margin: 1em 0;
				background: #fff;
			}
			
			.custom-section-toggle-btn {
				background: transparent;
				color: #00a2e8;
				padding: 20px;
				border: none;
				cursor: pointer;
				display: flex;
				align-items: center;
				justify-content: space-between;
				width: 100%;
				text-decoration: none;
				font-family: inherit;
				font-size: 0.75em;
				font-weight: 800;
				transition: opacity 0.3s ease;
				margin: 0;
				border-radius: 6px;
			}
			
			.custom-section-toggle-btn:hover {
				color: #00a2e8;
				opacity: 0.85;
			}
			
			.custom-section-toggle-btn:focus {
				outline: none;
				opacity: 0.75;
			}
			
			.custom-section-left {
				display: flex;
				align-items: center;
				flex: 1;
			}
			
			.custom-toggle-icon {
				background: #00a2e8;
				color: white;
				border-radius: 100%;
				width: 18px;
				height: 18px;
				flex: 0 0 18px;
				padding: 2px;
				line-height: 14px;
				text-align: center;
				font-weight: bold;
				transition: color 0.3s ease, background 0.3s ease, transform 0.3s ease;
				margin-right: 0.5em;
				font-size: 10px;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			
			.custom-toggle-text {
				padding-left: 0.5em;
				flex: 1;
				text-align: left;
				font-weight: 600;
				font-size: 1.1em;
				color: #495255;
			}
			
			/* Expanded state */
			.custom-section-toggle-btn.expanded .custom-toggle-icon {
				transform: rotate(90deg);
			}
			
			/* Section content styling */
			.custom-section-content {
				margin-left: 26px;
				border-left: 2px solid #e2e7ed;
				padding-left: 20px;
				margin-bottom: 20px;
				overflow: hidden;
				transition: all 0.3s ease;
			}
			
			.ld-section-wrapper {
				margin-bottom: 20px;
			}
			
			.custom-section-heading-wrapper {
				margin-bottom: 0;
			}
			
			/* Ensure proper spacing for lessons within sections */
			.custom-section-content .ld-item-list-item {
				margin: 1em 0;
			}
			
			/* Remove extra borders from nested lessons */
			.custom-section-content .ld-item-list-item {
				border-left: none;
				margin-left: 0;
			}
			
			/* Responsive adjustments */
			@media (max-width: 640px) {
				.custom-section-toggle-btn {
					text-align: left;
					padding: 15px;
				}
				
				.custom-toggle-text {
					font-size: 1em;
				}
			}
		');
	}
}
