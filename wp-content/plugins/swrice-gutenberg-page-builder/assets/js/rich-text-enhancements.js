/**
 * Swrice Plugin Sell Page Builder - Rich Text Enhancements
 * Adds rich text formatting capabilities to existing blocks
 */

(function() {
    'use strict';

    // Wait for WordPress to be ready
    wp.domReady(function() {
        // Check if we're in the block editor
        if (typeof wp.blocks === 'undefined' || typeof wp.blockEditor === 'undefined') {
            return;
        }

        const { registerBlockType, unregisterBlockType, getBlockType } = wp.blocks;
        const { RichText, InspectorControls } = wp.blockEditor;
        const { createElement, Fragment } = wp.element;
        const { PanelBody } = wp.components;

        // Function to enhance a block with RichText capabilities
        function enhanceBlockWithRichText(blockName, fieldsToEnhance) {
            const existingBlock = getBlockType(blockName);
            if (!existingBlock) {
                console.warn(`Block ${blockName} not found for enhancement`);
                return;
            }

            // Unregister the existing block
            unregisterBlockType(blockName);

            // Create enhanced version with RichText
            const enhancedBlock = {
                ...existingBlock,
                edit: function(props) {
                    const { attributes, setAttributes } = props;
                    const getAttr = (key, fallback = '') => attributes[key] || fallback;

                    // Call the original edit function to get the base structure
                    const originalEdit = existingBlock.edit(props);
                    
                    // Create enhanced inspector controls with RichText fields
                    const enhancedInspectorControls = createElement(InspectorControls, null,
                        createElement(PanelBody, { title: 'Content Settings', initialOpen: true },
                            ...fieldsToEnhance.map(field => {
                                if (field.type === 'richtext') {
                                    return createElement('div', { 
                                        key: field.key,
                                        style: { marginBottom: '20px' }
                                    },
                                        createElement('label', { 
                                            style: { 
                                                display: 'block', 
                                                marginBottom: '8px',
                                                fontWeight: 'bold',
                                                fontSize: '13px'
                                            }
                                        }, field.label),
                                        createElement(RichText, {
                                            tagName: field.tagName || 'div',
                                            value: getAttr(field.key),
                                            onChange: (value) => setAttributes({ [field.key]: value }),
                                            placeholder: field.placeholder || `Enter ${field.label.toLowerCase()}...`,
                                            allowedFormats: field.allowedFormats || [
                                                'core/bold',
                                                'core/italic', 
                                                'core/link',
                                                'core/underline',
                                                'core/strikethrough'
                                            ],
                                            style: {
                                                border: '1px solid #ddd',
                                                padding: '10px',
                                                minHeight: field.minHeight || '50px',
                                                borderRadius: '4px'
                                            }
                                        })
                                    );
                                }
                                return null;
                            }).filter(Boolean)
                        )
                    );

                    // Return the enhanced edit function with both original and new controls
                    return createElement(Fragment, null,
                        enhancedInspectorControls,
                        originalEdit
                    );
                }
            };

            // Re-register the enhanced block
            registerBlockType(blockName, enhancedBlock);
        }

        // Define which fields to enhance for each block
        const blockEnhancements = {
            'swrice/hero-section': [
                {
                    key: 'pluginName',
                    label: 'Plugin Name (Rich Text)',
                    type: 'richtext',
                    tagName: 'h2',
                    placeholder: 'Enter your plugin name with formatting...',
                    allowedFormats: ['core/bold', 'core/italic', 'core/link']
                },
                {
                    key: 'heroSubtitle',
                    label: 'Hero Subtitle (Rich Text)',
                    type: 'richtext',
                    tagName: 'p',
                    placeholder: 'Enter your hero subtitle with formatting...',
                    minHeight: '80px'
                }
            ],
            'swrice/problem-section': [
                {
                    key: 'problemTitle',
                    label: 'Problem Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter problem title with formatting...'
                },
                {
                    key: 'problemDescription',
                    label: 'Problem Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the problem with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/solution-section': [
                {
                    key: 'solutionTitle',
                    label: 'Solution Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter solution title with formatting...'
                },
                {
                    key: 'solutionDescription',
                    label: 'Solution Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the solution with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/features-section': [
                {
                    key: 'featuresTitle',
                    label: 'Features Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter features title with formatting...'
                },
                {
                    key: 'featuresDescription',
                    label: 'Features Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the features with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/faq-section': [
                {
                    key: 'faqTitle',
                    label: 'FAQ Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter FAQ title with formatting...'
                },
                {
                    key: 'faqDescription',
                    label: 'FAQ Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the FAQ section with formatting...',
                    minHeight: '80px'
                }
            ],
            'swrice/how-it-works-section': [
                {
                    key: 'howItWorksTitle',
                    label: 'How It Works Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter how it works title with formatting...'
                },
                {
                    key: 'howItWorksDescription',
                    label: 'How It Works Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe how it works with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/testimonials-section': [
                {
                    key: 'testimonialsTitle',
                    label: 'Testimonials Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter testimonials title with formatting...'
                },
                {
                    key: 'testimonialsDescription',
                    label: 'Testimonials Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the testimonials section with formatting...',
                    minHeight: '80px'
                }
            ],
            'swrice/bonuses-section': [
                {
                    key: 'bonusesTitle',
                    label: 'Bonuses Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter bonuses title with formatting...'
                },
                {
                    key: 'bonusesDescription',
                    label: 'Bonuses Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the bonuses with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/guarantee-section': [
                {
                    key: 'guaranteeTitle',
                    label: 'Guarantee Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter guarantee title with formatting...'
                },
                {
                    key: 'guaranteeDescription',
                    label: 'Guarantee Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the guarantee with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/why-choose-section': [
                {
                    key: 'whyChooseTitle',
                    label: 'Why Choose Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter why choose title with formatting...'
                },
                {
                    key: 'whyChooseDescription',
                    label: 'Why Choose Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe why choose with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/about-section': [
                {
                    key: 'aboutTitle',
                    label: 'About Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter about title with formatting...'
                },
                {
                    key: 'aboutDescription',
                    label: 'About Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the about section with formatting...',
                    minHeight: '100px'
                }
            ],
            'swrice/final-cta-section': [
                {
                    key: 'finalCtaTitle',
                    label: 'Final CTA Title (Rich Text)',
                    type: 'richtext',
                    tagName: 'h3',
                    placeholder: 'Enter final CTA title with formatting...'
                },
                {
                    key: 'finalCtaDescription',
                    label: 'Final CTA Description (Rich Text)',
                    type: 'richtext',
                    tagName: 'div',
                    placeholder: 'Describe the final CTA with formatting...',
                    minHeight: '100px'
                }
            ]
        };

        // Apply enhancements to each block
        Object.keys(blockEnhancements).forEach(blockName => {
            // Add a small delay to ensure blocks are registered
            setTimeout(() => {
                enhanceBlockWithRichText(blockName, blockEnhancements[blockName]);
            }, 100);
        });

        console.log('Swrice Rich Text Enhancements loaded successfully!');
    });
})();
