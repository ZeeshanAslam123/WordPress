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
			/* Custom Section Toggle - Matches LearnDash expand button styles */
			.learndash-wrapper .ld-custom-section-toggle {
				background: transparent;
				color: #00a2e8;
				padding: 0;
				border: none;
				cursor: pointer;
				display: flex;
				align-items: center;
				width: 100%;
				text-decoration: none;
				font-family: inherit;
				font-size: 0.75em;
				font-weight: 800;
				transition: opacity 0.3s ease;
				margin: 0;
				border-radius: 20px;
			}
			
			.learndash-wrapper .ld-custom-section-toggle .ld-icon {
				background: #00a2e8;
				color: white;
				border-radius: 100%;
				width: 18px;
				height: 18px;
				flex: 0 0 18px;
				padding: 2px;
				line-height: 16px;
				text-align: center;
				font-weight: bold;
				transition: color 0.3s ease, background 0.3s ease, transform 0.3s ease;
				margin-right: 0.5em;
			}
			
			.learndash-wrapper .ld-custom-section-toggle .ld-text {
				padding-left: 0.5em;
				flex: 1;
				text-align: left;
				font-weight: 600;
				font-size: 1.1em;
			}
			
			.learndash-wrapper .ld-custom-section-toggle:hover {
				background: transparent;
				opacity: 0.85;
			}
			
			.learndash-wrapper .ld-custom-section-toggle:focus {
				outline: none;
				opacity: 0.75;
			}
			
			/* Expanded state */
			.learndash-wrapper .ld-custom-section-toggle.ld-expanded .ld-icon {
				transform: rotate(180deg);
			}
			
			/* Section content styling */
			.ld-section-lessons {
				margin-left: 26px;
				border-left: 2px solid #e9ecef;
				padding-left: 20px;
				margin-bottom: 20px;
				overflow: hidden;
				transition: all 0.3s ease;
			}
			
			.ld-section-wrapper {
				margin-bottom: 20px;
			}
			
			.ld-section-heading-wrapper {
				margin-bottom: 10px;
			}
			
			/* Ensure proper spacing for lessons within sections */
			.ld-section-lessons .ld-item-list-item {
				margin-bottom: 10px;
			}
			
			/* Style adjustments for better visual hierarchy */
			.ld-collapsible-sections .ld-section-lessons .ld-item-list-item {
				border-radius: 4px;
				border: 1px solid #e9ecef;
				margin-bottom: 8px;
			}
			
			/* Responsive adjustments */
			@media (max-width: 640px) {
				.learndash-wrapper .ld-custom-section-toggle {
					text-align: left;
					margin-left: 10px;
				}
			}
		');
	}
}
