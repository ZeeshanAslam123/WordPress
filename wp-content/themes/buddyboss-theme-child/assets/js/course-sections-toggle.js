/**
 * LearnDash Course Sections Toggle Functionality
 * Handles collapsible sections on course pages
 * Uses unique selectors to avoid conflicts with LearnDash's existing functionality
 */

jQuery(document).ready(function($) {
    'use strict';
    
    // Initialize collapsible sections
    initCustomSectionToggles();
    
    function initCustomSectionToggles() {
        // Find all custom section toggle buttons (using unique class)
        $('.ld-custom-section-toggle').each(function() {
            var $toggle = $(this);
            var sectionId = $toggle.data('section-toggle');
            var $sectionContent = $('#ld-section-content-' + sectionId);
            
            // Ensure section content is hidden by default
            $sectionContent.hide();
            
            // Add click handler to toggle button
            $toggle.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent event bubbling to avoid conflicts
                toggleCustomSection($toggle, $sectionContent);
            });
            
            // Add keyboard support (Enter and Space)
            $toggle.on('keydown', function(e) {
                if (e.which === 13 || e.which === 32) { // Enter or Space
                    e.preventDefault();
                    e.stopPropagation();
                    toggleCustomSection($toggle, $sectionContent);
                }
            });
        });
    }
    
    function toggleCustomSection($toggle, $sectionContent) {
        var isExpanded = $toggle.hasClass('ld-expanded');
        
        if (isExpanded) {
            // Collapse section
            $toggle.removeClass('ld-expanded');
            $toggle.attr('aria-expanded', 'false');
            $sectionContent.slideUp(300);
        } else {
            // Expand section
            $toggle.addClass('ld-expanded');
            $toggle.attr('aria-expanded', 'true');
            $sectionContent.slideDown(300);
        }
    }
    
    // Optional: Integration with LearnDash's main expand/collapse functionality
    // This listens for LearnDash's expand/collapse events without interfering
    $(document).on('click', '.ld-expand-button:not(.ld-custom-section-toggle)', function() {
        // Small delay to let LearnDash handle its own functionality first
        setTimeout(function() {
            var $mainButton = $('.ld-expand-button:not(.ld-custom-section-toggle)').first();
            if ($mainButton.length) {
                var isMainExpanded = $mainButton.hasClass('ld-expanded');
                
                // Sync our custom section toggles with the main expand/collapse state
                $('.ld-custom-section-toggle').each(function() {
                    var $customToggle = $(this);
                    var sectionId = $customToggle.data('section-toggle');
                    var $sectionContent = $('#ld-section-content-' + sectionId);
                    var isCustomExpanded = $customToggle.hasClass('ld-expanded');
                    
                    if (isMainExpanded && !isCustomExpanded) {
                        // Expand this custom section
                        $customToggle.addClass('ld-expanded');
                        $customToggle.attr('aria-expanded', 'true');
                        $sectionContent.slideDown(300);
                    } else if (!isMainExpanded && isCustomExpanded) {
                        // Collapse this custom section
                        $customToggle.removeClass('ld-expanded');
                        $customToggle.attr('aria-expanded', 'false');
                        $sectionContent.slideUp(300);
                    }
                });
            }
        }, 100);
    });
    
    // Handle window resize to ensure proper layout
    $(window).on('resize', function() {
        // Recalculate any necessary dimensions if needed
        // This is a placeholder for any responsive adjustments
    });
    
    // Optional: Save section state in localStorage
    function saveCustomSectionState(sectionId, isExpanded) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('[data-ld-expand-id]').attr('data-ld-expand-id');
            if (courseId) {
                var storageKey = 'ld_custom_section_state_' + courseId;
                var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
                sectionStates[sectionId] = isExpanded;
                localStorage.setItem(storageKey, JSON.stringify(sectionStates));
            }
        }
    }
    
    function loadCustomSectionState(sectionId) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('[data-ld-expand-id]').attr('data-ld-expand-id');
            if (courseId) {
                var storageKey = 'ld_custom_section_state_' + courseId;
                var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
                return sectionStates[sectionId] || false;
            }
        }
        return false;
    }
    
    // Uncomment the following lines if you want to persist section states
    /*
    // Load saved states on page load
    $('.ld-custom-section-toggle').each(function() {
        var $toggle = $(this);
        var sectionId = $toggle.data('section-toggle');
        var $sectionContent = $('#ld-section-content-' + sectionId);
        var savedState = loadCustomSectionState(sectionId);
        
        if (savedState) {
            $toggle.addClass('ld-expanded');
            $toggle.attr('aria-expanded', 'true');
            $sectionContent.show();
        }
    });
    
    // Save state when sections are toggled
    $(document).on('click', '.ld-custom-section-toggle', function() {
        var $toggle = $(this);
        var sectionId = $toggle.data('section-toggle');
        var isExpanded = $toggle.hasClass('ld-expanded');
        saveCustomSectionState(sectionId, isExpanded);
    });
    */
});
