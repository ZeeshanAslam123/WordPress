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
                // Only handle clicks on our custom section toggle buttons
                // Don't interfere with LearnDash lesson expand buttons
                if ($(e.target).closest('.ld-expand-button').length === 0) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    toggleCustomSection($toggleBtn, $sectionContent);
                    return false;
                }
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
            
            // Ensure LearnDash's expand/collapse functionality works within the newly expanded section
            setTimeout(function() {
                reinitializeLearnDashExpandButtons($sectionContent);
            }, 100);
        }
    }
    
    /**
     * Reinitialize LearnDash expand buttons within a section
     * This ensures lesson topic expansion works after section expansion
     */
    function reinitializeLearnDashExpandButtons($sectionContent) {
        // Find all LearnDash expand buttons within the section
        $sectionContent.find('.ld-expand-button').each(function() {
            var $expandBtn = $(this);
            var expandsId = $expandBtn.data('ld-expands');
            
            if (expandsId) {
                // Ensure the target element is visible
                var $targetElement = $('#' + expandsId);
                if ($targetElement.length) {
                    // Make sure the target element is properly initialized for LearnDash
                    $targetElement.attr('data-ld-expand-list', 'true');
                    
                    // Trigger LearnDash's initialization if available
                    if (typeof window.ldExpandInit === 'function') {
                        window.ldExpandInit($expandBtn);
                    }
                }
            }
        });
    }
    
    // Integration with LearnDash's Expand All functionality
    // Use a slight delay to ensure LearnDash's scripts have loaded
    setTimeout(function() {
        initExpandAllIntegration();
    }, 100);
    
    function initExpandAllIntegration() {
        // Get the expand/collapse behavior setting (default to 'all_content' for backward compatibility)
        var expandCollapseBehavior = (typeof csld_settings !== 'undefined' && csld_settings.expand_collapse_behavior) 
            ? csld_settings.expand_collapse_behavior 
            : 'all_content';
        
        // Debug logging (can be removed in production)
        if (typeof console !== 'undefined' && console.log) {
            console.log('CSLD: Expand/Collapse behavior setting:', expandCollapseBehavior);
        }
        
        // Find the main expand/collapse button
        var $mainExpandButton = $('.ld-expand-button[data-ld-expands]').first();
        
        if ($mainExpandButton.length) {
            if (expandCollapseBehavior === 'sections_only') {
                // SECTIONS ONLY MODE: Override LearnDash completely
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
                                
                                // Reinitialize LearnDash expand buttons
                                setTimeout(function() {
                                    reinitializeLearnDashExpandButtons($sectionContent);
                                }, 100);
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
                
            } else {
                // ALL CONTENT MODE: Add section expansion to LearnDash's default behavior
                if (typeof console !== 'undefined' && console.log) {
                    console.log('CSLD: Adding section expansion to LearnDash default behavior (all content)');
                }
                
                // Remove any previous custom handlers to avoid conflicts
                $mainExpandButton.off('click.customSectionOnly');
                
                // Add our section expansion as an additional handler (don't override LearnDash)
                $mainExpandButton.on('click.customSectionExpansion', function(e) {
                    // Don't prevent default - let LearnDash handle lessons/topics
                    // Don't stop propagation - let LearnDash's handler run too
                    
                    var $button = $(this);
                    
                    // Use a small delay to let LearnDash update the button state first
                    setTimeout(function() {
                        var isCurrentlyExpanded = $button.hasClass('ld-expanded');
                        
                        if (isCurrentlyExpanded) {
                            // LearnDash just expanded everything, so expand our sections too
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
                                    
                                    // Reinitialize LearnDash expand buttons
                                    setTimeout(function() {
                                        reinitializeLearnDashExpandButtons($sectionContent);
                                    }, 100);
                                }
                            });
                        } else {
                            // LearnDash just collapsed everything, so collapse our sections too
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
                        }
                    }, 50); // Small delay to let LearnDash process first
                });
            }
        }
        // This ensures LearnDash's default behavior works completely uninterrupted
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
