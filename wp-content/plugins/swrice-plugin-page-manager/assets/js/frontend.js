/**
 * Swrice Plugin Page Manager - Frontend JavaScript
 * 
 * Minimal JS since we're using your custom inline scripts
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Any additional functionality can be added here
        // The main FAQ and button functionality is handled inline in the template
        
        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 20
                }, 800);
            }
        });
    });
    
})(jQuery);

