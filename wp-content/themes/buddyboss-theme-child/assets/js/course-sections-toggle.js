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
            
            // Initialize section as collapsed using LearnDash method
            $sectionContent.addClass('collapsed');
            $sectionContent.css({'max-height': 0});
            
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
            // Collapse section - EXACTLY like LearnDash lessons
            $toggleBtn.removeClass('expanded');
            $toggleBtn.attr('aria-expanded', 'false');
            $sectionContent.addClass('collapsed');
            $sectionContent.css({'max-height': 0});
        } else {
            // Expand section - EXACTLY like LearnDash lessons
            $toggleBtn.addClass('expanded');
            $toggleBtn.attr('aria-expanded', 'true');
            $sectionContent.removeClass('collapsed');
            
            // Calculate total height exactly like LearnDash does
            var totalHeight = 0;
            $sectionContent.find('> *').each(function() {
                totalHeight += $(this).outerHeight();
            });
            
            // Set data-height attribute like LearnDash
            $sectionContent.attr('data-height', '' + (totalHeight + 50) + '');
            
            // Set max-height to calculated height like LearnDash
            $sectionContent.css({'max-height': $sectionContent.data('height')});
        }
    }
    
    // Integration with LearnDash's Expand All functionality
    initExpandAllIntegration();
    
    function initExpandAllIntegration() {
        // Find the main expand/collapse button
        var $mainExpandButton = $('.ld-expand-button[data-ld-expands]').first();
        
        if ($mainExpandButton.length) {
            // INTERCEPT the click event BEFORE LearnDash processes it
            $mainExpandButton.on('click.customSectionIntercept', function(e) {
                var $button = $(this);
                var isCurrentlyExpanded = $button.hasClass('ld-expanded');
                
                // If we're about to expand (button is currently collapsed)
                if (!isCurrentlyExpanded) {
                    console.log('Intercepting Expand All - expanding sections first');
                    
                    // FIRST: Expand all sections immediately
                    $('.custom-section-toggle-btn').each(function() {
                        var $sectionToggle = $(this);
                        var sectionId = $sectionToggle.data('custom-section-id');
                        var $sectionContent = $('#custom-section-content-' + sectionId);
                        
                        if (!$sectionToggle.hasClass('expanded')) {
                            $sectionToggle.addClass('expanded');
                            $sectionToggle.attr('aria-expanded', 'true');
                            $sectionContent.removeClass('collapsed');
                            
                            // Calculate height and expand using LearnDash method
                            var totalHeight = 0;
                            $sectionContent.find('> *').each(function() {
                                totalHeight += $(this).outerHeight();
                            });
                            $sectionContent.attr('data-height', '' + (totalHeight + 50) + '');
                            $sectionContent.css({'max-height': $sectionContent.data('height')});
                        }
                    });
                    
                    console.log('All sections expanded, now letting LearnDash process lessons');
                } else {
                    console.log('Intercepting Collapse All - will sync sections after');
                }
            });
            
            // ALSO watch for state changes to sync collapse
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        var $button = $(mutation.target);
                        
                        if ($button.attr('data-ld-expands')) {
                            var isExpanded = $button.hasClass('ld-expanded');
                            
                            // Only handle collapse case here (expand is handled by click intercept)
                            if (!isExpanded) {
                                console.log('Syncing section collapse with main button');
                                $('.custom-section-toggle-btn').each(function() {
                                    var $sectionToggle = $(this);
                                    var sectionId = $sectionToggle.data('custom-section-id');
                                    var $sectionContent = $('#custom-section-content-' + sectionId);
                                    
                                    if ($sectionToggle.hasClass('expanded')) {
                                        $sectionToggle.removeClass('expanded');
                                        $sectionToggle.attr('aria-expanded', 'false');
                                        $sectionContent.addClass('collapsed');
                                        $sectionContent.css({'max-height': 0});
                                    }
                                });
                            }
                        }
                    }
                });
            });
            
            observer.observe($mainExpandButton[0], {
                attributes: true,
                attributeFilter: ['class']
            });
        }
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
