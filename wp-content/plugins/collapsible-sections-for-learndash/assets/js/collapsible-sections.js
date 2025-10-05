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
            
            // Use multiple timeouts to ensure proper sequencing
            setTimeout(function() {
                var isCurrentlyExpanded = $button.hasClass('ld-expanded');
                console.log('All Content Behavior - Button expanded state:', isCurrentlyExpanded);
                
                if (isCurrentlyExpanded) {
                    // First expand our custom sections
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
                    
                    // Then expand individual lesson content with additional delay
                    setTimeout(function() {
                        var lessonButtons = $('.ld-expand-button[data-ld-expands]').not($button);
                        console.log('Found lesson expand buttons:', lessonButtons.length);
                        
                        lessonButtons.each(function(index) {
                            var $lessonExpandButton = $(this);
                            var expandsTarget = $lessonExpandButton.data('ld-expands');
                            var $expandTarget = $('#' + expandsTarget);
                            
                            console.log('Processing lesson button', index, 'target:', expandsTarget, 'already expanded:', $lessonExpandButton.hasClass('ld-expanded'));
                            
                            // Force expand regardless of current state - the issue is that LearnDash expands the container but not the content inside
                            if ($expandTarget.length) {
                                // Add a small delay between each expansion to avoid conflicts
                                setTimeout(function() {
                                    console.log('Force expanding lesson content for target:', expandsTarget);
                                    
                                    // If already expanded, collapse first then expand to force content to show
                                    if ($lessonExpandButton.hasClass('ld-expanded')) {
                                        console.log('Button already expanded, collapsing first then re-expanding');
                                        if (typeof ld_expand_element === 'function') {
                                            ld_expand_element($lessonExpandButton); // This will collapse it
                                            
                                            // Then expand it again after a short delay
                                            setTimeout(function() {
                                                console.log('Re-expanding after collapse for:', expandsTarget);
                                                ld_expand_element($lessonExpandButton);
                                            }, 100);
                                        }
                                    } else {
                                        // Not expanded, just expand normally
                                        console.log('Button not expanded, expanding normally for:', expandsTarget);
                                        if (typeof ld_expand_element === 'function') {
                                            ld_expand_element($lessonExpandButton);
                                        } else {
                                            console.log('ld_expand_element function not available, trying click trigger');
                                            $lessonExpandButton.trigger('click');
                                        }
                                    }
                                }, index * 100); // Increased stagger time for collapse/expand cycle
                            }
                        });
                    }, 200); // Additional delay for lesson expansion
                    
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
                    
                    // ALSO collapse all individual lesson content
                    setTimeout(function() {
                        $('.ld-expand-button[data-ld-expands]').not($button).each(function() {
                            var $lessonExpandButton = $(this);
                            var expandsTarget = $lessonExpandButton.data('ld-expands');
                            var $expandTarget = $('#' + expandsTarget);
                            
                            // Only collapse if currently expanded
                            if ($lessonExpandButton.hasClass('ld-expanded') && $expandTarget.length) {
                                if (typeof ld_expand_element === 'function') {
                                    ld_expand_element($lessonExpandButton);
                                }
                            }
                        });
                    }, 100);
                }
            }, 150); // Initial delay to let LearnDash process first
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
