/**
 * Custom Course Sections Toggle Functionality
 * Completely independent from LearnDash's existing functionality
 * Uses unique selectors and classes to avoid any conflicts
 */

jQuery(document).ready(function($) {
    'use strict';
    
    // Initialize custom section toggles
    initCustomSectionToggles();
    
    function initCustomSectionToggles() {
        // Find all custom section toggle buttons (completely unique selectors)
        $('.custom-section-toggle-btn').each(function() {
            var $toggleBtn = $(this);
            var sectionId = $toggleBtn.data('custom-section-id');
            var $sectionContent = $('#custom-section-content-' + sectionId);
            
            // Ensure section content is hidden by default
            $sectionContent.hide();
            
            // Add click handler to toggle button
            $toggleBtn.on('click.customSectionToggle', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation(); // Completely stop event propagation
                toggleCustomSection($toggleBtn, $sectionContent);
                return false;
            });
            
            // Add keyboard support (Enter and Space)
            $toggleBtn.on('keydown.customSectionToggle', function(e) {
                if (e.which === 13 || e.which === 32) { // Enter or Space
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    toggleCustomSection($toggleBtn, $sectionContent);
                    return false;
                }
            });
        });
    }
    
    function toggleCustomSection($toggleBtn, $sectionContent) {
        var isExpanded = $toggleBtn.hasClass('expanded');
        
        if (isExpanded) {
            // Collapse section
            $toggleBtn.removeClass('expanded');
            $toggleBtn.attr('aria-expanded', 'false');
            $sectionContent.slideUp(300);
        } else {
            // Expand section
            $toggleBtn.addClass('expanded');
            $toggleBtn.attr('aria-expanded', 'true');
            $sectionContent.slideDown(300);
        }
    }
    
    // Completely isolated - no integration with LearnDash functionality
    // This ensures zero interference with existing togglers
    
    // Handle window resize to ensure proper layout
    $(window).on('resize.customSectionToggle', function() {
        // Recalculate any necessary dimensions if needed
        // This is a placeholder for any responsive adjustments
    });
    
    // Optional: Save section state in localStorage (completely separate from LearnDash)
    function saveCustomSectionState(sectionId, isExpanded) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('.ld-item-list-items').attr('id');
            if (courseId) {
                var storageKey = 'custom_section_state_' + courseId;
                var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
                sectionStates[sectionId] = isExpanded;
                localStorage.setItem(storageKey, JSON.stringify(sectionStates));
            }
        }
    }
    
    function loadCustomSectionState(sectionId) {
        if (typeof(Storage) !== "undefined") {
            var courseId = $('.ld-item-list-items').attr('id');
            if (courseId) {
                var storageKey = 'custom_section_state_' + courseId;
                var sectionStates = JSON.parse(localStorage.getItem(storageKey) || '{}');
                return sectionStates[sectionId] || false;
            }
        }
        return false;
    }
    
    // Uncomment the following lines if you want to persist section states
    /*
    // Load saved states on page load
    $('.custom-section-toggle-btn').each(function() {
        var $toggleBtn = $(this);
        var sectionId = $toggleBtn.data('custom-section-id');
        var $sectionContent = $('#custom-section-content-' + sectionId);
        var savedState = loadCustomSectionState(sectionId);
        
        if (savedState) {
            $toggleBtn.addClass('expanded');
            $toggleBtn.attr('aria-expanded', 'true');
            $sectionContent.show();
        }
    });
    
    // Save state when sections are toggled
    $(document).on('click.customSectionToggle', '.custom-section-toggle-btn', function() {
        var $toggleBtn = $(this);
        var sectionId = $toggleBtn.data('custom-section-id');
        var isExpanded = $toggleBtn.hasClass('expanded');
        saveCustomSectionState(sectionId, isExpanded);
    });
    */
});
