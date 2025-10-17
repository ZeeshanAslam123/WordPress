/**
 * Swrice Plugin Page Builder - Individual Section Blocks
 * Modern Gutenberg blocks for each section
 */

const { registerBlockType } = wp.blocks;
const { createElement, Fragment } = wp.element;
const { 
    TextControl, 
    TextareaControl, 
    PanelBody, 
    Button,
    MediaUpload,
    MediaUploadCheck
} = wp.components;
const { InspectorControls } = wp.blockEditor;

// Repeater Field Component
const RepeaterField = ({ items, onChange, fields, addButtonText = 'Add Item' }) => {
    const addItem = () => {
        const newItem = {};
        fields.forEach(field => {
            newItem[field.key] = field.default || '';
        });
        onChange([...items, newItem]);
    };

    const removeItem = (index) => {
        const newItems = items.filter((_, i) => i !== index);
        onChange(newItems);
    };

    const updateItem = (index, key, value) => {
        const newItems = [...items];
        newItems[index] = { ...newItems[index], [key]: value };
        onChange(newItems);
    };

    return createElement('div', { className: 'repeater-field' },
        items.map((item, index) =>
            createElement('div', { 
                key: index, 
                className: 'repeater-item',
                style: { 
                    border: '1px solid #ddd', 
                    padding: '15px', 
                    marginBottom: '10px',
                    borderRadius: '4px',
                    backgroundColor: '#f9f9f9'
                }
            },
                createElement('div', { 
                    style: { 
                        display: 'flex', 
                        justifyContent: 'space-between', 
                        alignItems: 'center',
                        marginBottom: '10px'
                    }
                },
                    createElement('strong', null, `Item ${index + 1}`),
                    createElement(Button, {
                        isDestructive: true,
                        isSmall: true,
                        onClick: () => removeItem(index)
                    }, 'Remove')
                ),
                ...fields.map(field =>
                    field.type === 'textarea' 
                        ? createElement(TextareaControl, {
                            key: field.key,
                            label: field.label,
                            value: item[field.key] || '',
                            onChange: (value) => updateItem(index, field.key, value),
                            rows: 3
                        })
                        : createElement(TextControl, {
                            key: field.key,
                            label: field.label,
                            value: item[field.key] || '',
                            onChange: (value) => updateItem(index, field.key, value),
                            placeholder: field.placeholder || ''
                        })
                )
            )
        ),
        createElement(Button, {
            isPrimary: true,
            onClick: addItem,
            style: { marginTop: '10px' }
        }, addButtonText)
    );
};

// Hero Section Block
registerBlockType('swrice/hero-section', {
    title: 'Hero Section',
    icon: '🚀',
    category: 'swrice-blocks',
    attributes: {
        pluginName: { type: 'string', default: 'My Awesome Plugin' },
        heroSubtitle: { type: 'string', default: 'Transform your WordPress experience with our powerful plugin solution' },
        pluginPrice: { type: 'string', default: '49' },
        pluginOriginalPrice: { type: 'string', default: '99' },
        buyNowShortcode: { type: 'string', default: '' },
        demoLink: { type: 'string', default: '' },
        heroImageId: { type: 'number', default: 0 },
        heroImageUrl: { type: 'string', default: '' }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Hero Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Plugin Name',
                        value: getAttr('pluginName'),
                        onChange: (val) => setAttributes({ pluginName: val })
                    }),
                    createElement(TextareaControl, {
                        label: 'Hero Subtitle',
                        value: getAttr('heroSubtitle'),
                        onChange: (val) => setAttributes({ heroSubtitle: val }),
                        rows: 3
                    }),
                    createElement(TextControl, {
                        label: 'Plugin Price ($)',
                        value: getAttr('pluginPrice'),
                        onChange: (val) => setAttributes({ pluginPrice: val }),
                        type: 'number'
                    }),
                    createElement(TextControl, {
                        label: 'Original Price ($)',
                        value: getAttr('pluginOriginalPrice'),
                        onChange: (val) => setAttributes({ pluginOriginalPrice: val }),
                        type: 'number'
                    }),
                    createElement(TextareaControl, {
                        label: 'Buy Now Shortcode',
                        value: getAttr('buyNowShortcode'),
                        onChange: (val) => setAttributes({ buyNowShortcode: val }),
                        help: 'Paste your payment processor shortcode here',
                        rows: 3
                    }),
                    createElement(TextControl, {
                        label: 'Demo Link',
                        value: getAttr('demoLink'),
                        onChange: (val) => setAttributes({ demoLink: val }),
                        type: 'url',
                        placeholder: 'https://demo.yoursite.com'
                    })
                ),
                createElement(PanelBody, { title: 'Hero Image', initialOpen: false },
                    createElement(TextControl, {
                        label: 'Hero Image URL',
                        value: getAttr('heroImageUrl'),
                        onChange: (val) => setAttributes({ heroImageUrl: val }),
                        placeholder: 'https://example.com/image.jpg',
                        help: 'Enter the URL of your hero image or use the media library button below'
                    }),
                    createElement('div', { style: { marginTop: '10px' } },
                        createElement(Button, {
                            isPrimary: true,
                            onClick: () => {
                                // Simple media frame approach
                                if (typeof wp !== 'undefined' && wp.media) {
                                    const frame = wp.media({
                                        title: 'Select Hero Image',
                                        button: { text: 'Use Image' },
                                        multiple: false,
                                        library: { type: 'image' }
                                    });
                                    
                                    frame.on('select', () => {
                                        const attachment = frame.state().get('selection').first().toJSON();
                                        setAttributes({ 
                                            heroImageId: attachment.id,
                                            heroImageUrl: attachment.url 
                                        });
                                    });
                                    
                                    frame.open();
                                }
                            }
                        }, 'Select from Media Library')
                    ),
                    getAttr('heroImageUrl') && createElement('div', { style: { marginTop: '10px' } },
                        createElement('img', { 
                            src: getAttr('heroImageUrl'), 
                            style: { maxWidth: '100%', height: 'auto', border: '1px solid #ddd', borderRadius: '4px' }
                        }),
                        createElement('div', { style: { marginTop: '5px' } },
                            createElement(Button, {
                                isDestructive: true,
                                isSmall: true,
                                onClick: () => setAttributes({ heroImageId: 0, heroImageUrl: '' })
                            }, 'Remove Image')
                        )
                    )
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-hero-preview',
                style: {
                    background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                    color: 'white',
                    padding: '30px',
                    borderRadius: '8px',
                    textAlign: 'center'
                }
            },
                createElement('h2', { 
                    style: { 
                        margin: '0 0 15px 0', 
                        fontSize: '28px',
                        fontWeight: 'bold'
                    } 
                }, getAttr('pluginName', 'My Awesome Plugin')),
                createElement('p', { 
                    style: { 
                        margin: '0 0 20px 0', 
                        fontSize: '16px',
                        opacity: 0.9
                    } 
                }, getAttr('heroSubtitle') || 'Configure your hero section settings in the sidebar.'),
                createElement('div', { 
                    style: { 
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center',
                        gap: '15px',
                        marginBottom: '20px'
                    }
                },
                    getAttr('pluginOriginalPrice') && createElement('span', { 
                        style: { 
                            fontSize: '18px', 
                            textDecoration: 'line-through',
                            opacity: 0.7
                        } 
                    }, '$' + getAttr('pluginOriginalPrice')),
                    createElement('span', { 
                        style: { 
                            fontSize: '32px', 
                            fontWeight: 'bold'
                        } 
                    }, '$' + getAttr('pluginPrice', '49'))
                ),
                createElement('div', { 
                    style: { 
                        fontSize: '14px',
                        opacity: 0.8
                    } 
                }, '🚀 Hero Section - Configure settings in the sidebar')
            )
        );
    },
    save: () => null // Server-side rendering
});

// Problem Section Block
registerBlockType('swrice/problem-section', {
    title: 'Problem Section',
    icon: '⚠️',
    category: 'swrice-blocks',
    attributes: {
        problemHeading: { type: 'string', default: 'The Problem' },
        problemIcon: { type: 'string', default: '⚠️' },
        problemItems: { 
            type: 'array', 
            default: [
                {
                    title: 'Problem 1',
                    description: 'Description of the problem',
                    icon: '❌'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Problem Section Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('problemHeading'),
                        onChange: (val) => setAttributes({ problemHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('problemIcon'),
                        onChange: (val) => setAttributes({ problemIcon: val }),
                        placeholder: '⚠️'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('problemItems', []),
                        onChange: (items) => setAttributes({ problemItems: items }),
                        fields: [
                            { key: 'title', label: 'Problem Title', type: 'text' },
                            { key: 'description', label: 'Problem Description', type: 'textarea' },
                            { key: 'icon', label: 'Icon', type: 'text', placeholder: '❌' }
                        ],
                        addButtonText: 'Add Problem'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-problem-preview',
                style: {
                    background: '#fff3cd',
                    border: '1px solid #ffeaa7',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#856404',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('problemIcon')),
                    getAttr('problemHeading', 'The Problem')
                ),
                createElement('div', { style: { color: '#856404' } },
                    `${getAttr('problemItems', []).length} problem(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// Solution Section Block
registerBlockType('swrice/solution-section', {
    title: 'Solution Section',
    icon: '✅',
    category: 'swrice-blocks',
    attributes: {
        solutionHeading: { type: 'string', default: 'The Solution' },
        solutionIcon: { type: 'string', default: '✅' },
        solutionDescription: { type: 'string', default: 'Our plugin solves all your problems with an elegant solution.' }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Solution Section Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('solutionHeading'),
                        onChange: (val) => setAttributes({ solutionHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('solutionIcon'),
                        onChange: (val) => setAttributes({ solutionIcon: val }),
                        placeholder: '✅'
                    }),
                    createElement(TextareaControl, {
                        label: 'Solution Description',
                        value: getAttr('solutionDescription'),
                        onChange: (val) => setAttributes({ solutionDescription: val }),
                        rows: 4
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-solution-preview',
                style: {
                    background: '#d4edda',
                    border: '1px solid #c3e6cb',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#155724',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('solutionIcon')),
                    getAttr('solutionHeading', 'The Solution')
                ),
                createElement('p', { style: { color: '#155724', margin: 0 } },
                    getAttr('solutionDescription') || 'Configure your solution description in the sidebar.'
                )
            )
        );
    },
    save: () => null
});

// Features Section Block
registerBlockType('swrice/features-section', {
    title: 'Features Section',
    icon: '🚀',
    category: 'swrice-blocks',
    attributes: {
        featuresHeading: { type: 'string', default: 'Features' },
        featuresIcon: { type: 'string', default: '🚀' },
        featureItems: { 
            type: 'array', 
            default: [
                {
                    title: 'Feature 1',
                    description: 'Description of the feature',
                    icon: '✨'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Features Section Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('featuresHeading'),
                        onChange: (val) => setAttributes({ featuresHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('featuresIcon'),
                        onChange: (val) => setAttributes({ featuresIcon: val }),
                        placeholder: '🚀'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('featureItems', []),
                        onChange: (items) => setAttributes({ featureItems: items }),
                        fields: [
                            { key: 'title', label: 'Feature Title', type: 'text' },
                            { key: 'description', label: 'Feature Description', type: 'textarea' },
                            { key: 'icon', label: 'Icon', type: 'text', placeholder: '✨' }
                        ],
                        addButtonText: 'Add Feature'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-features-preview',
                style: {
                    background: '#e3f2fd',
                    border: '1px solid #bbdefb',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#0d47a1',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('featuresIcon')),
                    getAttr('featuresHeading', 'Features')
                ),
                createElement('div', { style: { color: '#0d47a1' } },
                    `${getAttr('featureItems', []).length} feature(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// FAQ Section Block
registerBlockType('swrice/faq-section', {
    title: 'FAQ Section',
    icon: '❓',
    category: 'swrice-blocks',
    attributes: {
        faqHeading: { type: 'string', default: 'FAQ' },
        faqIcon: { type: 'string', default: '❓' },
        faqItems: { 
            type: 'array', 
            default: [
                {
                    question: 'How does it work?',
                    answer: 'It works great!'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'FAQ Section Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('faqHeading'),
                        onChange: (val) => setAttributes({ faqHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('faqIcon'),
                        onChange: (val) => setAttributes({ faqIcon: val }),
                        placeholder: '❓'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('faqItems', []),
                        onChange: (items) => setAttributes({ faqItems: items }),
                        fields: [
                            { key: 'question', label: 'Question', type: 'text' },
                            { key: 'answer', label: 'Answer', type: 'textarea' }
                        ],
                        addButtonText: 'Add FAQ'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-faq-preview',
                style: {
                    background: '#f3e5f5',
                    border: '1px solid #e1bee7',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#4a148c',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('faqIcon')),
                    getAttr('faqHeading', 'FAQ')
                ),
                createElement('div', { style: { color: '#4a148c' } },
                    `${getAttr('faqItems', []).length} FAQ(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// How It Works Section Block
registerBlockType('swrice/how-it-works-section', {
    title: 'How It Works Section',
    icon: '⚙️',
    category: 'swrice-blocks',
    attributes: {
        howItWorksHeading: { type: 'string', default: 'How It Works' },
        howItWorksIcon: { type: 'string', default: '⚙️' },
        stepsItems: { 
            type: 'array', 
            default: [
                {
                    title: 'Step 1',
                    description: 'Description of the step'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'How It Works Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('howItWorksHeading'),
                        onChange: (val) => setAttributes({ howItWorksHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('howItWorksIcon'),
                        onChange: (val) => setAttributes({ howItWorksIcon: val }),
                        placeholder: '⚙️'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('stepsItems', []),
                        onChange: (items) => setAttributes({ stepsItems: items }),
                        fields: [
                            { key: 'title', label: 'Step Title', type: 'text' },
                            { key: 'description', label: 'Step Description', type: 'textarea' }
                        ],
                        addButtonText: 'Add Step'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-how-it-works-preview',
                style: {
                    background: '#f8f9fa',
                    border: '1px solid #dee2e6',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#495057',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('howItWorksIcon')),
                    getAttr('howItWorksHeading', 'How It Works')
                ),
                createElement('div', { style: { color: '#495057' } },
                    `${getAttr('stepsItems', []).length} step(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// Testimonials Section Block
registerBlockType('swrice/testimonials-section', {
    title: 'Testimonials Section',
    icon: '💬',
    category: 'swrice-blocks',
    attributes: {
        testimonialsHeading: { type: 'string', default: 'Testimonials' },
        testimonialsIcon: { type: 'string', default: '💬' },
        testimonialItems: { 
            type: 'array', 
            default: [
                {
                    name: 'John Doe',
                    title: 'CEO, Company',
                    content: 'This plugin is amazing!',
                    rating: '5'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Testimonials Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('testimonialsHeading'),
                        onChange: (val) => setAttributes({ testimonialsHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('testimonialsIcon'),
                        onChange: (val) => setAttributes({ testimonialsIcon: val }),
                        placeholder: '💬'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('testimonialItems', []),
                        onChange: (items) => setAttributes({ testimonialItems: items }),
                        fields: [
                            { key: 'name', label: 'Customer Name', type: 'text' },
                            { key: 'title', label: 'Customer Title', type: 'text' },
                            { key: 'content', label: 'Testimonial Content', type: 'textarea' },
                            { key: 'rating', label: 'Rating (1-5)', type: 'text', placeholder: '5' }
                        ],
                        addButtonText: 'Add Testimonial'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-testimonials-preview',
                style: {
                    background: '#e8f5e8',
                    border: '1px solid #c3e6cb',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#155724',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('testimonialsIcon')),
                    getAttr('testimonialsHeading', 'Testimonials')
                ),
                createElement('div', { style: { color: '#155724' } },
                    `${getAttr('testimonialItems', []).length} testimonial(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// Bonuses Section Block
registerBlockType('swrice/bonuses-section', {
    title: 'Bonuses Section',
    icon: '🎁',
    category: 'swrice-blocks',
    attributes: {
        bonusesHeading: { type: 'string', default: 'Bonuses' },
        bonusesIcon: { type: 'string', default: '🎁' },
        bonusItems: { 
            type: 'array', 
            default: [
                {
                    title: 'Bonus 1',
                    description: 'Description of the bonus',
                    value: '$50',
                    icon: '🎁'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Bonuses Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('bonusesHeading'),
                        onChange: (val) => setAttributes({ bonusesHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('bonusesIcon'),
                        onChange: (val) => setAttributes({ bonusesIcon: val }),
                        placeholder: '🎁'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('bonusItems', []),
                        onChange: (items) => setAttributes({ bonusItems: items }),
                        fields: [
                            { key: 'title', label: 'Bonus Title', type: 'text' },
                            { key: 'description', label: 'Bonus Description', type: 'textarea' },
                            { key: 'value', label: 'Bonus Value', type: 'text', placeholder: '$50' },
                            { key: 'icon', label: 'Icon', type: 'text', placeholder: '🎁' }
                        ],
                        addButtonText: 'Add Bonus'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-bonuses-preview',
                style: {
                    background: '#fff3cd',
                    border: '1px solid #ffeaa7',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#856404',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('bonusesIcon')),
                    getAttr('bonusesHeading', 'Bonuses')
                ),
                createElement('div', { style: { color: '#856404' } },
                    `${getAttr('bonusItems', []).length} bonus(es) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// Guarantee Section Block
registerBlockType('swrice/guarantee-section', {
    title: 'Guarantee Section',
    icon: '🛡️',
    category: 'swrice-blocks',
    attributes: {
        guaranteeHeading: { type: 'string', default: 'Guarantee' },
        guaranteeIcon: { type: 'string', default: '🛡️' },
        guaranteeText: { type: 'string', default: 'We offer a 30-day money back guarantee.' },
        guaranteePoints: { 
            type: 'array', 
            default: [
                {
                    point: '30-day money back guarantee'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Guarantee Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('guaranteeHeading'),
                        onChange: (val) => setAttributes({ guaranteeHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('guaranteeIcon'),
                        onChange: (val) => setAttributes({ guaranteeIcon: val }),
                        placeholder: '🛡️'
                    }),
                    createElement(TextareaControl, {
                        label: 'Guarantee Text',
                        value: getAttr('guaranteeText'),
                        onChange: (val) => setAttributes({ guaranteeText: val }),
                        rows: 3
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('guaranteePoints', []),
                        onChange: (items) => setAttributes({ guaranteePoints: items }),
                        fields: [
                            { key: 'point', label: 'Guarantee Point', type: 'text' }
                        ],
                        addButtonText: 'Add Guarantee Point'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-guarantee-preview',
                style: {
                    background: '#d1ecf1',
                    border: '1px solid #bee5eb',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#0c5460',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('guaranteeIcon')),
                    getAttr('guaranteeHeading', 'Guarantee')
                ),
                createElement('p', { style: { color: '#0c5460', margin: '0 0 10px 0' } },
                    getAttr('guaranteeText') || 'Configure your guarantee text in the sidebar.'
                ),
                createElement('div', { style: { color: '#0c5460' } },
                    `${getAttr('guaranteePoints', []).length} guarantee point(s) configured.`
                )
            )
        );
    },
    save: () => null
});

// Why Choose Section Block
registerBlockType('swrice/why-choose-section', {
    title: 'Why Choose Section',
    icon: '⭐',
    category: 'swrice-blocks',
    attributes: {
        whyChooseHeading: { type: 'string', default: 'Why Choose Us' },
        whyChooseIcon: { type: 'string', default: '⭐' },
        whyChooseItems: { 
            type: 'array', 
            default: [
                {
                    title: 'Reason 1',
                    description: 'Why you should choose us',
                    icon: '⭐'
                }
            ]
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Why Choose Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('whyChooseHeading'),
                        onChange: (val) => setAttributes({ whyChooseHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('whyChooseIcon'),
                        onChange: (val) => setAttributes({ whyChooseIcon: val }),
                        placeholder: '⭐'
                    }),
                    createElement(RepeaterField, {
                        items: getAttr('whyChooseItems', []),
                        onChange: (items) => setAttributes({ whyChooseItems: items }),
                        fields: [
                            { key: 'title', label: 'Reason Title', type: 'text' },
                            { key: 'description', label: 'Reason Description', type: 'textarea' },
                            { key: 'icon', label: 'Icon', type: 'text', placeholder: '⭐' }
                        ],
                        addButtonText: 'Add Reason'
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-why-choose-preview',
                style: {
                    background: '#ffeaa7',
                    border: '1px solid #fdcb6e',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#8b6914',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('whyChooseIcon')),
                    getAttr('whyChooseHeading', 'Why Choose Us')
                ),
                createElement('div', { style: { color: '#8b6914' } },
                    `${getAttr('whyChooseItems', []).length} reason(s) configured. Configure in the sidebar.`
                )
            )
        );
    },
    save: () => null
});

// About Section Block
registerBlockType('swrice/about-section', {
    title: 'About Section',
    icon: 'ℹ️',
    category: 'swrice-blocks',
    attributes: {
        aboutHeading: { type: 'string', default: 'About' },
        aboutIcon: { type: 'string', default: 'ℹ️' },
        aboutDescription: { type: 'string', default: 'Learn more about our company and mission.' }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'About Section Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('aboutHeading'),
                        onChange: (val) => setAttributes({ aboutHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('aboutIcon'),
                        onChange: (val) => setAttributes({ aboutIcon: val }),
                        placeholder: 'ℹ️'
                    }),
                    createElement(TextareaControl, {
                        label: 'About Description',
                        value: getAttr('aboutDescription'),
                        onChange: (val) => setAttributes({ aboutDescription: val }),
                        rows: 4
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-about-preview',
                style: {
                    background: '#e2e3e5',
                    border: '1px solid #d6d8db',
                    padding: '20px',
                    borderRadius: '8px'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        color: '#383d41',
                        display: 'flex',
                        alignItems: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('aboutIcon')),
                    getAttr('aboutHeading', 'About')
                ),
                createElement('p', { style: { color: '#383d41', margin: 0 } },
                    getAttr('aboutDescription') || 'Configure your about description in the sidebar.'
                )
            )
        );
    },
    save: () => null
});

// Final CTA Section Block
registerBlockType('swrice/final-cta-section', {
    title: 'Final CTA Section',
    icon: '🎯',
    category: 'swrice-blocks',
    attributes: {
        finalCtaHeading: { type: 'string', default: 'Ready to Get Started?' },
        finalCtaIcon: { type: 'string', default: '🚀' },
        ctaTitle: { type: 'string', default: 'Get Started Today' },
        ctaSubtitle: { type: 'string', default: 'Join thousands of satisfied customers' },
        buyNowShortcode: { type: 'string', default: '' }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Final CTA Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Section Heading',
                        value: getAttr('finalCtaHeading'),
                        onChange: (val) => setAttributes({ finalCtaHeading: val })
                    }),
                    createElement(TextControl, {
                        label: 'Section Icon',
                        value: getAttr('finalCtaIcon'),
                        onChange: (val) => setAttributes({ finalCtaIcon: val }),
                        placeholder: '🚀'
                    }),
                    createElement(TextControl, {
                        label: 'CTA Title',
                        value: getAttr('ctaTitle'),
                        onChange: (val) => setAttributes({ ctaTitle: val })
                    }),
                    createElement(TextControl, {
                        label: 'CTA Subtitle',
                        value: getAttr('ctaSubtitle'),
                        onChange: (val) => setAttributes({ ctaSubtitle: val })
                    }),
                    createElement(TextareaControl, {
                        label: 'Buy Now Shortcode',
                        value: getAttr('buyNowShortcode'),
                        onChange: (val) => setAttributes({ buyNowShortcode: val }),
                        help: 'Paste your payment processor shortcode here',
                        rows: 3
                    })
                )
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-final-cta-preview',
                style: {
                    background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                    color: 'white',
                    padding: '30px',
                    borderRadius: '8px',
                    textAlign: 'center'
                }
            },
                createElement('h3', { 
                    style: { 
                        margin: '0 0 15px 0',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        gap: '10px'
                    } 
                }, 
                    createElement('span', null, getAttr('finalCtaIcon')),
                    getAttr('finalCtaHeading', 'Ready to Get Started?')
                ),
                createElement('h4', { style: { margin: '0 0 10px 0' } }, 
                    getAttr('ctaTitle', 'Get Started Today')
                ),
                createElement('p', { style: { margin: '0 0 15px 0', opacity: 0.9 } },
                    getAttr('ctaSubtitle', 'Join thousands of satisfied customers')
                ),
                createElement('div', { style: { fontSize: '14px', opacity: 0.8 } },
                    '🎯 Final CTA Section - Configure settings in the sidebar'
                )
            )
        );
    },
    save: () => null
});
