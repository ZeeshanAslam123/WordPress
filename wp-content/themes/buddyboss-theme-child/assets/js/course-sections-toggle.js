/**
 * LearnDash Course Sections Toggle Functionality
 * Handles collapsible sections on course pages
 */

jQuery(document).ready(function($) {
    'use strict';
    
    // Initialize collapsible sections
    initCollapsibleSections();
    
    function initCollapsibleSections() {
        // Find all section headers
        $('.ld-collapsible-section-header').each(function() {
            var $header = $(this);
            var sectionId = $header.data('section-toggle');
            var $sectionLessons = $('[data-section-lessons="' + sectionId + '"]');
            
            // Ensure lessons are hidden by default
            $sectionLessons.hide();
            
            // Add click handler to section header
            $header.on('click', function(e) {
                e.preventDefault();
                toggleSection($header, $sectionLessons);
            });
            
            // Add keyboard support (Enter and Space)
            $header.on('keydown', function(e) {
                if (e.which === 13 || e.which === 32) { // Enter or Space
                    e.preventDefault();
                    toggleSection($header, $sectionLessons);
                }
            });
            
            // Make header focusable for accessibility
            $header.attr('tabindex', '0');
            $header.attr('role', 'button');
            $header.attr('aria-expanded', 'false');
            $header.attr('aria-controls', 'section-lessons-' + sectionId);
            
            // Add ID to lessons container for accessibility
            $sectionLessons.attr('id', 'section-lessons-' + sectionId);
        });
    }
    
    function toggleSection($header, $sectionLessons) {
        var isExpanded = $header.hasClass('expanded');
        
        if (isExpanded) {
            // Collapse section
            $header.removeClass('expanded');
            $header.attr('aria-expanded', 'false');
            $sectionLessons.slideUp(300, function() {
                // Callback after animation completes
                $sectionLessons.hide();
            });
        } else {
            // Expand section
            $header.addClass('expanded');
            $header.attr('aria-expanded', 'true');
            $sectionLessons.slideDown(300, function() {
                // Callback after animation completes
                $sectionLessons.show();
            });
        }
    }
    
    // Optional: Add "Expand All" / "Collapse All" functionality
    // This can be integrated with existing LearnDash expand/collapse buttons
    $(document).on('click', '.ld-expand-button', function() {
        var $button = $(this);
        var isExpanding = !$button.hasClass('ld-expanded');
        
        // Toggle all sections based on the main expand/collapse button
        $('.ld-collapsible-section-header').each(function() {
            var $header = $(this);
            var sectionId = $header.data('section-toggle');
            var $sectionLessons = $('[data-section-lessons="' + sectionId + '"]');
            var isCurrentlyExpanded = $header.hasClass('expanded');
            
            if (isExpanding && !isCurrentlyExpanded) {
                // Expand this section
                $header.addClass('expanded');
                $header.attr('aria-expanded', 'true');
                $sectionLessons.slideDown(300);
            } else if (!isExpanding && isCurrentlyExpanded) {
                // Collapse this section
                $header.removeClass('expanded');
                $header.attr('aria-expanded', 'false');
                $sectionLessons.slideUp(300);
            }
        });
    });
    
    // Handle window resize to ensure proper layout
    $(window).on('resize', function() {
        // Recalculate any necessary dimensions if needed
        // This is a placeholder for any responsive adjustments
    });
    
    // Optional: Save section state in localStorage
    function saveSectionState(sectionId, isExpanded) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('[data-ld-expand-id]').attr('data-ld-expand-id');
            var storageKey = 'ld_section_state_' + courseId;
            var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
            sectionStates[sectionId] = isExpanded;
            localStorage.setItem(storageKey, JSON.stringify(sectionStates));
        }
    }
    
    function loadSectionState(sectionId) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('[data-ld-expand-id]').attr('data-ld-expand-id');
            var storageKey = 'ld_section_state_' + courseId;
            var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
            return sectionStates[sectionId] || false;
        }
        return false;
    }
    
    // Uncomment the following lines if you want to persist section states
    /*
    // Load saved states on page load
    $('.ld-collapsible-section-header').each(function() {
        var $header = $(this);
        var sectionId = $header.data('section-toggle');
        var $sectionLessons = $('[data-section-lessons="' + sectionId + '"]');
        var savedState = loadSectionState(sectionId);
        
        if (savedState) {
            $header.addClass('expanded');
            $header.attr('aria-expanded', 'true');
            $sectionLessons.show();
        }
    });
    
    // Save state when sections are toggled
    $(document).on('click', '.ld-collapsible-section-header', function() {
        var $header = $(this);
        var sectionId = $header.data('section-toggle');
        var isExpanded = $header.hasClass('expanded');
        saveSectionState(sectionId, isExpanded);
    });
    */
});

