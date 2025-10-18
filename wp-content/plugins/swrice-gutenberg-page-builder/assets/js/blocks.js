/**
 * Swrice Plugin Page Builder - Individual Section Blocks
 * Modern Gutenberg blocks for each section
 */

const { registerBlockType } = wp.blocks;
const { createElement, Fragment } = wp.element;
const { 
    TextControl, 
    TextareaControl, 
    SelectControl,
    PanelBody, 
    Button,
    MediaUpload,
    MediaUploadCheck
} = wp.components;
const { InspectorControls } = wp.blockEditor;

// Icon options for different sections
const PROBLEM_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '😤 Frustrated Face', value: '😤' },
    { label: '🚫 Prohibited', value: '🚫' },
    { label: '⚠️ Warning', value: '⚠️' },
    { label: '💸 Money Loss', value: '💸' },
    { label: '📉 Declining', value: '📉' }
];

const SOLUTION_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '✨ Sparkles', value: '✨' },
    { label: '🚀 Rocket', value: '🚀' },
    { label: '💡 Light Bulb', value: '💡' },
    { label: '🎯 Target', value: '🎯' },
    { label: '⚡ Lightning', value: '⚡' }
];

const HOW_IT_WORKS_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '🔧 Wrench', value: '🔧' },
    { label: '⚙️ Gear', value: '⚙️' },
    { label: '🛠️ Tools', value: '🛠️' },
    { label: '📋 Clipboard', value: '📋' },
    { label: '🎯 Target', value: '🎯' }
];

const FEATURES_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '⭐ Star', value: '⭐' },
    { label: '🌟 Glowing Star', value: '🌟' },
    { label: '✨ Sparkles', value: '✨' },
    { label: '🎯 Target', value: '🎯' },
    { label: '🚀 Rocket', value: '🚀' }
];

const TESTIMONIALS_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '💬 Speech Bubble', value: '💬' },
    { label: '🗣️ Speaking', value: '🗣️' },
    { label: '💭 Thought Bubble', value: '💭' },
    { label: '📢 Megaphone', value: '📢' },
    { label: '⭐ Star', value: '⭐' }
];

const FAQ_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '❓ Question Mark', value: '❓' },
    { label: '❔ White Question Mark', value: '❔' },
    { label: '🤔 Thinking Face', value: '🤔' },
    { label: '💭 Thought Bubble', value: '💭' },
    { label: '📋 Clipboard', value: '📋' }
];

const BONUSES_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '🎁 Gift', value: '🎁' },
    { label: '🎉 Party', value: '🎉' },
    { label: '💎 Diamond', value: '💎' },
    { label: '🏆 Trophy', value: '🏆' },
    { label: '⭐ Star', value: '⭐' }
];

const GUARANTEE_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '✅ Check Mark', value: '✅' },
    { label: '🛡️ Shield', value: '🛡️' },
    { label: '🔒 Lock', value: '🔒' },
    { label: '💯 Hundred', value: '💯' },
    { label: '🎯 Target', value: '🎯' }
];

const WHY_CHOOSE_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '🏆 Trophy', value: '🏆' },
    { label: '⭐ Star', value: '⭐' },
    { label: '💎 Diamond', value: '💎' },
    { label: '🎯 Target', value: '🎯' },
    { label: '🚀 Rocket', value: '🚀' }
];

const ABOUT_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '👥 People', value: '👥' },
    { label: '🏢 Building', value: '🏢' },
    { label: '📖 Book', value: '📖' },
    { label: '💼 Briefcase', value: '💼' },
    { label: '🌟 Star', value: '🌟' }
];

const FINAL_CTA_ICON_OPTIONS = [
    { label: 'No Icon', value: '' },
    { label: '🚀 Rocket', value: '🚀' },
    { label: '✨ Sparkles', value: '✨' },
    { label: '🎯 Target', value: '🎯' },
    { label: '💎 Diamond', value: '💎' },
    { label: '🔥 Fire', value: '🔥' }
];

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
            
            // Block Preview - Exact Frontend Match
            createElement('div', { className: 'sgpb-plugin-page-editor' },
                createElement('div', { className: 'sppm-plugin-page' },
                    createElement('div', { className: 'sppm-container' },
                        createElement('section', { className: 'sppm-hero' },
                            createElement('div', { className: 'sppm-hero-left' },
                                createElement('div', { className: 'sppm-logo-row' },
                                    createElement('div', { className: 'sppm-logo-mark' },
                                        createElement('svg', { 
                                            width: '28', 
                                            height: '24', 
                                            viewBox: '0 0 28 24', 
                                            fill: 'none',
                                            xmlns: 'http://www.w3.org/2000/svg'
                                        },
                                            createElement('rect', { x: '2', y: '2', width: '20', height: '4', rx: '2', fill: '#5fa0d8' }),
                                            createElement('rect', { x: '2', y: '10', width: '16', height: '4', rx: '2', fill: '#82bfe4' }),
                                            createElement('rect', { x: '2', y: '18', width: '12', height: '4', rx: '2', fill: '#bcdff6' })
                                        )
                                    ),
                                    createElement('div', { className: 'sppm-logo-text' }, 
                                        getAttr('pluginName', 'My Awesome Plugin')
                                    )
                                ),
                                createElement('div', { className: 'sppm-rating' },
                                    createElement('div', { className: 'sppm-rating-stars' }, '★ ★ ★ ★ ★'),
                                    createElement('div', null, '5.0')
                                ),
                                createElement('h1', { className: 'sppm-hero-title' }, 
                                    getAttr('pluginName', 'My Awesome Plugin')
                                ),
                                createElement('p', { className: 'sppm-hero-subtitle' }, 
                                    getAttr('heroSubtitle', 'Transform your WordPress experience with our powerful plugin solution')
                                ),
                                createElement('div', { className: 'sppm-hero-ctas' },
                                    getAttr('buyNowShortcode') ? 
                                        createElement('div', { 
                                            dangerouslySetInnerHTML: { __html: '[Shortcode Preview]' }
                                        }) :
                                        createElement('button', { className: 'sppm-btn sppm-btn-primary' }, 
                                            'Buy Now - $' + getAttr('pluginPrice', '49')
                                        ),
                                    getAttr('demoLink') && getAttr('demoLink') !== '#' && getAttr('demoLink') !== '' ?
                                        createElement('a', { 
                                            className: 'sppm-btn sppm-btn-ghost',
                                            href: '#',
                                            onClick: (e) => e.preventDefault()
                                        }, 'Live Demo') : null
                                )
                            ),
                            createElement('div', { className: 'sppm-hero-right' },
                                getAttr('heroImageUrl') ?
                                    createElement('img', { 
                                        src: getAttr('heroImageUrl'),
                                        alt: getAttr('pluginName', 'Plugin Preview'),
                                        className: 'sppm-hero-image'
                                    }) :
                                    createElement('div', { className: 'sppm-device' },
                                        createElement('div', { className: 'sppm-device-inner' },
                                            createElement('h3', null, 'Plugin Preview'),
                                            createElement('div', { className: 'sppm-section-row' }, 'Getting Started ', createElement('span', null, '▾')),
                                            createElement('div', { className: 'sppm-section-row' }, 'Configuration ', createElement('span', null, '▾')),
                                            createElement('div', { className: 'sppm-section-row' }, 'Advanced Features ', createElement('span', null, '▾'))
                                        )
                                    )
                            )
                        )
                    )
                )
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('problemIcon'),
                        options: PROBLEM_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ problemIcon: val }),
                        help: 'Choose an icon for this section'
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
            
            // Block Preview - Exact Frontend Match
            createElement('div', { className: 'sgpb-plugin-page-editor' },
                createElement('div', { className: 'sppm-plugin-page' },
                    createElement('section', { className: 'sppm-section sppm-problem-section' },
                        createElement('div', { className: 'sppm-section-header' },
                            createElement('h2', { className: 'sppm-section-title' },
                                getAttr('problemIcon') ? 
                                    createElement('span', { className: 'sppm-section-icon' }, getAttr('problemIcon')) : null,
                                getAttr('problemHeading', 'The Problem')
                            )
                        ),
                        createElement('div', { className: 'sppm-problem-grid' },
                            getAttr('problemItems', []).length > 0 ?
                                getAttr('problemItems', []).map((problem, index) =>
                                    createElement('div', { 
                                        key: index,
                                        className: 'sppm-problem-card' 
                                    },
                                        problem.icon ? 
                                            createElement('div', { className: 'sppm-problem-icon' }, problem.icon) : null,
                                        createElement('h3', { className: 'sppm-problem-title' }, 
                                            problem.title || 'Problem Title'
                                        ),
                                        createElement('p', { className: 'sppm-problem-desc' }, 
                                            problem.description || 'Problem description'
                                        )
                                    )
                                ) :
                                createElement('div', { 
                                    className: 'sppm-problem-card',
                                    style: { opacity: 0.6 }
                                },
                                    createElement('div', { className: 'sppm-problem-icon' }, '⚠️'),
                                    createElement('h3', { className: 'sppm-problem-title' }, 'Sample Problem'),
                                    createElement('p', { className: 'sppm-problem-desc' }, 'Add problems in the sidebar to see them here.')
                                )
                        )
                    )
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('solutionIcon'),
                        options: SOLUTION_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ solutionIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('featuresIcon'),
                        options: FEATURES_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ featuresIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('faqIcon'),
                        options: FAQ_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ faqIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('howItWorksIcon'),
                        options: HOW_IT_WORKS_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ howItWorksIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('testimonialsIcon'),
                        options: TESTIMONIALS_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ testimonialsIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('bonusesIcon'),
                        options: BONUSES_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ bonusesIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('guaranteeIcon'),
                        options: GUARANTEE_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ guaranteeIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('whyChooseIcon'),
                        options: WHY_CHOOSE_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ whyChooseIcon: val }),
                        help: 'Choose an icon for this section'
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('aboutIcon'),
                        options: ABOUT_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ aboutIcon: val }),
                        help: 'Choose an icon for this section'
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
        buyNowShortcode: { type: 'string', default: '' },
        demoLink: { type: 'string', default: '' },
        pluginPrice: { type: 'string', default: '29' }
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
                    createElement(SelectControl, {
                        label: 'Section Icon',
                        value: getAttr('finalCtaIcon'),
                        options: FINAL_CTA_ICON_OPTIONS,
                        onChange: (val) => setAttributes({ finalCtaIcon: val }),
                        help: 'Choose an icon for this section'
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
                    }),
                    createElement(TextControl, {
                        label: 'Demo Link URL',
                        value: getAttr('demoLink'),
                        onChange: (val) => setAttributes({ demoLink: val }),
                        type: 'url',
                        placeholder: 'https://example.com/demo',
                        help: 'Enter a URL for the Live Demo button. Leave empty to hide the demo button.'
                    })
                )
            ),
            
            // Block Preview - Exact Frontend Match
            createElement('div', { className: 'sgpb-plugin-page-editor' },
                createElement('div', { className: 'sppm-plugin-page' },
                    createElement('section', { className: 'sppm-section sppm-final-cta' },
                        createElement('div', { className: 'sppm-cta' },
                            createElement('div', { className: 'sppm-cta-content' },
                                getAttr('finalCtaHeading') ?
                                    createElement('h2', { className: 'sppm-section-title' },
                                        getAttr('finalCtaIcon') ? 
                                            createElement('span', { className: 'sppm-section-icon' }, getAttr('finalCtaIcon')) : null,
                                        getAttr('finalCtaHeading', 'Ready to Get Started?')
                                    ) : null,
                                getAttr('ctaTitle') ?
                                    createElement('h3', { className: 'sppm-cta-title' }, 
                                        getAttr('ctaTitle', 'Get Started Today')
                                    ) : null,
                                getAttr('ctaSubtitle') ?
                                    createElement('p', { className: 'sppm-cta-subtitle' },
                                        getAttr('ctaSubtitle', 'Join thousands of satisfied customers')
                                    ) : null
                            ),
                            createElement('div', { className: 'sppm-cta-buttons' },
                                getAttr('buyNowShortcode') ? 
                                    createElement('div', { 
                                        dangerouslySetInnerHTML: { __html: '[Shortcode Preview]' }
                                    }) :
                                    getAttr('pluginPrice') ?
                                        createElement('button', { className: 'sppm-btn sppm-btn-primary' }, 
                                            'Buy Now - $' + getAttr('pluginPrice', '29')
                                        ) : null,
                                getAttr('demoLink') && getAttr('demoLink') !== '#' && getAttr('demoLink') !== '' ?
                                    createElement('a', { 
                                        className: 'sppm-btn sppm-btn-ghost',
                                        href: '#',
                                        onClick: (e) => e.preventDefault()
                                    }, 'Live Demo') : null
                            )
                        )
                    )
                )
            )
        );
    },
    save: () => null
});
