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
