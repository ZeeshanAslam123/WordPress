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
    
    // Integration with LearnDash's "Expand All" / "Collapse All" functionality
    initExpandAllIntegration();
    
    function initExpandAllIntegration() {
        // Listen for clicks on LearnDash's main expand/collapse button
        $(document).on('click.customSectionExpandAll', '.ld-expand-button', function(e) {
            // Small delay to let LearnDash handle its functionality first
            setTimeout(function() {
                var $mainButton = $('.ld-expand-button').first();
                if ($mainButton.length) {
                    var isMainExpanded = $mainButton.hasClass('ld-expanded');
                    
                    // Sync all custom section toggles with the main expand/collapse state
                    $('.custom-section-toggle-btn').each(function() {
                        var $customToggle = $(this);
                        var sectionId = $customToggle.data('custom-section-id');
                        var $sectionContent = $('#custom-section-content-' + sectionId);
                        var isCustomExpanded = $customToggle.hasClass('expanded');
                        
                        if (isMainExpanded && !isCustomExpanded) {
                            // Expand this custom section
                            $customToggle.addClass('expanded');
                            $customToggle.attr('aria-expanded', 'true');
                            $sectionContent.slideDown(300);
                        } else if (!isMainExpanded && isCustomExpanded) {
                            // Collapse this custom section
                            $customToggle.removeClass('expanded');
                            $customToggle.attr('aria-expanded', 'false');
                            $sectionContent.slideUp(300);
                        }
                    });
                }
            }, 100); // Small delay to ensure LearnDash processes first
        });
    }
    
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
