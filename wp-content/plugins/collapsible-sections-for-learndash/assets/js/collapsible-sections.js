/**
 * Collapsible Sections for LearnDash - Frontend JavaScript
 * Completely independent from LearnDash's existing functionality
 * Uses unique selectors and classes to avoid any conflicts
 * 
 * @package CollapsibleSectionsLearnDash
 * @version 1.0.0
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
        var $icon = $toggleBtn.find('.custom-toggle-icon');
        
        if (isExpanded) {
            // Collapse section
            $toggleBtn.removeClass('expanded');
            $toggleBtn.attr('aria-expanded', 'false');
            $sectionContent.hide();
            
            // Change icon from arrow-down to arrow-right
            $icon.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
        } else {
            // Expand section
            $toggleBtn.addClass('expanded');
            $toggleBtn.attr('aria-expanded', 'true');
            $sectionContent.show();
            
            // Change icon from arrow-right to arrow-down
            $icon.removeClass('dashicons-arrow-right').addClass('dashicons-arrow-down');
        }
    }
    
    // Integration with LearnDash's Expand All functionality
    initExpandAllIntegration();
    
    function initExpandAllIntegration() {
        // Find the main expand/collapse button
        var $mainExpandButton = $('.ld-expand-button[data-ld-expands]').first();
        
        if ($mainExpandButton.length) {
            // Get the expand/collapse behavior setting
            var expandBehavior = (typeof csld_settings !== 'undefined' && csld_settings.expand_collapse_behavior) 
                ? csld_settings.expand_collapse_behavior 
                : 'all_content';
            
            if (expandBehavior === 'sections_only') {
                // SECTIONS ONLY BEHAVIOR - Current working implementation
                initSectionsOnlyBehavior($mainExpandButton);
            } else {
                // ALL CONTENT BEHAVIOR - Default behavior (expand everything)
                initAllContentBehavior($mainExpandButton);
            }
        }
    }
    
    function initSectionsOnlyBehavior($mainExpandButton) {
        // COMPLETELY OVERRIDE the click event to ONLY expand sections, NOT lessons
        $mainExpandButton.off('click'); // Remove LearnDash's original handler
        
        $mainExpandButton.on('click.customSectionOnly', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            var $button = $(this);
            var isCurrentlyExpanded = $button.hasClass('ld-expanded');
            
            if (!isCurrentlyExpanded) {
                
                // ONLY expand sections, do NOT let LearnDash expand lessons
                $('.custom-section-toggle-btn').each(function() {
                    var $sectionToggle = $(this);
                    var sectionId = $sectionToggle.data('custom-section-id');
                    var $sectionContent = $('#custom-section-content-' + sectionId);
                    var $icon = $sectionToggle.find('.custom-toggle-icon');
                    
                    if (!$sectionToggle.hasClass('expanded')) {
                        $sectionToggle.addClass('expanded');
                        $sectionToggle.attr('aria-expanded', 'true');
                        $sectionContent.show();
                        
                        // Change icon from arrow-right to arrow-down
                        $icon.removeClass('dashicons-arrow-right').addClass('dashicons-arrow-down');
                    }
                });
                
                // Update button state to expanded
                $button.addClass('ld-expanded');
                $button.find('.ld-text').text($button.data('ld-collapse-text') || 'Collapse All');
                
            } else {
                
                // Collapse all sections
                $('.custom-section-toggle-btn').each(function() {
                    var $sectionToggle = $(this);
                    var sectionId = $sectionToggle.data('custom-section-id');
                    var $sectionContent = $('#custom-section-content-' + sectionId);
                    var $icon = $sectionToggle.find('.custom-toggle-icon');
                    
                    if ($sectionToggle.hasClass('expanded')) {
                        $sectionToggle.removeClass('expanded');
                        $sectionToggle.attr('aria-expanded', 'false');
                        $sectionContent.hide();
                        
                        // Change icon from arrow-down to arrow-right
                        $icon.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
                    }
                });
                
                // Update button state to collapsed
                $button.removeClass('ld-expanded');
                $button.find('.ld-text').text($button.data('ld-expand-text') || 'Expand All');
            }
            
            return false;
        });
    }
    
    function initAllContentBehavior($mainExpandButton) {
        // ALL CONTENT BEHAVIOR - Let LearnDash handle its content AND expand our sections
        // We don't override LearnDash's click handler, we just add our own logic
        
        $mainExpandButton.on('click.customSectionAll', function(e) {
            // Don't prevent default - let LearnDash handle its own content
            // Don't stop propagation - let LearnDash's handler run too
            
            var $button = $(this);
            
            // Small delay to let LearnDash process first, then handle our sections AND lesson content
            setTimeout(function() {
                var isCurrentlyExpanded = $button.hasClass('ld-expanded');
                
                if (isCurrentlyExpanded) {
                    // LearnDash just expanded, so expand our sections too
                    $('.custom-section-toggle-btn').each(function() {
                        var $sectionToggle = $(this);
                        var sectionId = $sectionToggle.data('custom-section-id');
                        var $sectionContent = $('#custom-section-content-' + sectionId);
                        var $icon = $sectionToggle.find('.custom-toggle-icon');
                        
                        if (!$sectionToggle.hasClass('expanded')) {
                            $sectionToggle.addClass('expanded');
                            $sectionToggle.attr('aria-expanded', 'true');
                            $sectionContent.show();
                            
                            // Change icon from arrow-right to arrow-down
                            $icon.removeClass('dashicons-arrow-right').addClass('dashicons-arrow-down');
                        }
                    });
                    
                    // ALSO expand all individual lesson content (topics/quizzes inside lessons)
                    // Use LearnDash's native ld_expand_element function instead of trigger('click')
                    $('.ld-expand-button[data-ld-expands]').not($button).each(function() {
                        var $lessonExpandButton = $(this);
                        var expandsTarget = $lessonExpandButton.data('ld-expands');
                        var $expandTarget = $('#' + expandsTarget);
                        
                        // Only expand if not already expanded
                        if (!$lessonExpandButton.hasClass('ld-expanded') && $expandTarget.length) {
                            // Call LearnDash's native expand function directly
                            if (typeof ld_expand_element === 'function') {
                                ld_expand_element($lessonExpandButton);
                            }
                        }
                    });
                    
                } else {
                    // LearnDash just collapsed, so collapse our sections too
                    $('.custom-section-toggle-btn').each(function() {
                        var $sectionToggle = $(this);
                        var sectionId = $sectionToggle.data('custom-section-id');
                        var $sectionContent = $('#custom-section-content-' + sectionId);
                        var $icon = $sectionToggle.find('.custom-toggle-icon');
                        
                        if ($sectionToggle.hasClass('expanded')) {
                            $sectionToggle.removeClass('expanded');
                            $sectionToggle.attr('aria-expanded', 'false');
                            $sectionContent.hide();
                            
                            // Change icon from arrow-down to arrow-right
                            $icon.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
                        }
                    });
                    
                    // ALSO collapse all individual lesson content (topics/quizzes inside lessons)
                    // Use LearnDash's native ld_expand_element function instead of trigger('click')
                    $('.ld-expand-button[data-ld-expands]').not($button).each(function() {
                        var $lessonExpandButton = $(this);
                        var expandsTarget = $lessonExpandButton.data('ld-expands');
                        var $expandTarget = $('#' + expandsTarget);
                        
                        // Only collapse if currently expanded
                        if ($lessonExpandButton.hasClass('ld-expanded') && $expandTarget.length) {
                            // Call LearnDash's native expand function directly (it will collapse since it's already expanded)
                            if (typeof ld_expand_element === 'function') {
                                ld_expand_element($lessonExpandButton);
                            }
                        }
                    });
                }
            }, 100); // Slightly longer delay to ensure LearnDash processes first
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
