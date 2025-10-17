const { registerBlockType } = wp.blocks;
const { createElement, Fragment, useState } = wp.element;
const { 
    TextControl, 
    TextareaControl, 
    PanelBody, 
    ToggleControl, 
    Button, 
    TabPanel,
    SelectControl,
    MediaUpload,
    MediaUploadCheck
} = wp.components;
const { InspectorControls, MediaPlaceholder } = wp.blockEditor;

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

// Section Manager Component
const SectionManager = ({ sectionOrder, sectionEnabled, onOrderChange, onEnabledChange }) => {
    const sectionLabels = {
        'problem': 'Problem Section',
        'solution': 'Solution Section', 
        'how_it_works': 'How It Works',
        'features': 'Features',
        'testimonials': 'Testimonials',
        'faq': 'FAQ',
        'bonuses': 'Bonuses',
        'guarantee': 'Guarantee',
        'why_choose': 'Why Choose Us',
        'about': 'About',
        'final_cta': 'Final CTA'
    };

    const moveSection = (fromIndex, toIndex) => {
        const newOrder = [...sectionOrder];
        const [movedSection] = newOrder.splice(fromIndex, 1);
        newOrder.splice(toIndex, 0, movedSection);
        onOrderChange(newOrder);
    };

    return createElement('div', { className: 'section-manager' },
        createElement('h4', null, 'Section Management'),
        createElement('p', { style: { fontSize: '13px', color: '#666', marginBottom: '15px' } }, 
            'Toggle sections on/off and drag to reorder them.'
        ),
        sectionOrder.map((section, index) =>
            createElement('div', {
                key: section,
                className: 'section-item',
                style: {
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'space-between',
                    padding: '10px',
                    border: '1px solid #ddd',
                    marginBottom: '5px',
                    borderRadius: '4px',
                    backgroundColor: sectionEnabled[section] ? '#f0f8ff' : '#f5f5f5'
                }
            },
                createElement('div', { style: { display: 'flex', alignItems: 'center', gap: '10px' } },
                    createElement('span', { 
                        style: { 
                            cursor: 'move', 
                            fontSize: '16px',
                            color: '#666'
                        } 
                    }, '⋮⋮'),
                    createElement('span', null, sectionLabels[section] || section)
                ),
                createElement('div', { style: { display: 'flex', alignItems: 'center', gap: '10px' } },
                    createElement(Button, {
                        isSmall: true,
                        disabled: index === 0,
                        onClick: () => moveSection(index, index - 1)
                    }, '↑'),
                    createElement(Button, {
                        isSmall: true,
                        disabled: index === sectionOrder.length - 1,
                        onClick: () => moveSection(index, index + 1)
                    }, '↓'),
                    createElement(ToggleControl, {
                        checked: sectionEnabled[section] || false,
                        onChange: (value) => onEnabledChange({ ...sectionEnabled, [section]: value })
                    })
                )
            )
        )
    );
};

registerBlockType('swrice/plugin-page-builder', {
    title: 'Plugin Page Builder',
    icon: 'admin-plugins',
    category: 'widgets',
    attributes: {
        // All attributes are defined in PHP - this is just for reference
        pluginName: { type: 'string', default: 'My Awesome Plugin' },
        heroSubtitle: { type: 'string', default: '' },
        pluginPrice: { type: 'string', default: '49' },
        pluginOriginalPrice: { type: 'string', default: '99' },
        buyNowShortcode: { type: 'string', default: '' },
        demoLink: { type: 'string', default: '' },
        heroImageId: { type: 'number', default: 0 },
        heroImageUrl: { type: 'string', default: '' },
        sectionOrder: { type: 'array', default: ['problem', 'solution', 'how_it_works', 'features', 'testimonials', 'faq', 'bonuses', 'guarantee', 'why_choose', 'about', 'final_cta'] },
        sectionEnabled: { type: 'object', default: {} },
        // Section headings
        problemHeading: { type: 'string', default: 'The Problem' },
        problemIcon: { type: 'string', default: '⚠️' },
        solutionHeading: { type: 'string', default: 'The Solution' },
        solutionIcon: { type: 'string', default: '✅' },
        solutionDescription: { type: 'string', default: '' },
        // ... other attributes defined in PHP
        // Repeater fields
        problemItems: { type: 'array', default: [] },
        stepsItems: { type: 'array', default: [] },
        featureItems: { type: 'array', default: [] },
        testimonialItems: { type: 'array', default: [] },
        faqItems: { type: 'array', default: [] },
        bonusItems: { type: 'array', default: [] },
        whyChooseItems: { type: 'array', default: [] },
        guaranteePoints: { type: 'array', default: [] }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const [activeTab, setActiveTab] = useState('basic');

        // Helper function to get attribute value with fallback
        const getAttr = (key, fallback = '') => attributes[key] || fallback;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(TabPanel, {
                    className: 'plugin-page-builder-tabs',
                    activeClass: 'active-tab',
                    tabs: [
                        { name: 'basic', title: 'Basic Info', className: 'tab-basic' },
                        { name: 'sections', title: 'Sections', className: 'tab-sections' },
                        { name: 'content', title: 'Content', className: 'tab-content' }
                    ]
                }, (tab) => {
                    if (tab.name === 'basic') {
                        return createElement(Fragment, null,
                            createElement(PanelBody, { title: 'Plugin Details', initialOpen: true },
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
                                createElement(MediaUploadCheck, null,
                                    createElement(MediaUpload, {
                                        onSelect: (media) => setAttributes({ 
                                            heroImageId: media.id,
                                            heroImageUrl: media.url 
                                        }),
                                        allowedTypes: ['image'],
                                        value: getAttr('heroImageId'),
                                        render: ({ open }) => (
                                            getAttr('heroImageUrl') 
                                                ? createElement('div', null,
                                                    createElement('img', { 
                                                        src: getAttr('heroImageUrl'), 
                                                        style: { maxWidth: '100%', height: 'auto' }
                                                    }),
                                                    createElement(Button, {
                                                        onClick: open,
                                                        isPrimary: true,
                                                        style: { marginTop: '10px', marginRight: '10px' }
                                                    }, 'Change Image'),
                                                    createElement(Button, {
                                                        onClick: () => setAttributes({ heroImageId: 0, heroImageUrl: '' }),
                                                        isDestructive: true,
                                                        style: { marginTop: '10px' }
                                                    }, 'Remove')
                                                )
                                                : createElement(Button, {
                                                    onClick: open,
                                                    isPrimary: true
                                                }, 'Select Hero Image')
                                        )
                                    })
                                )
                            )
                        );
                    }
                    
                    if (tab.name === 'sections') {
                        return createElement(PanelBody, { title: 'Section Management', initialOpen: true },
                            createElement(SectionManager, {
                                sectionOrder: getAttr('sectionOrder', ['problem', 'solution', 'how_it_works', 'features', 'testimonials', 'faq', 'bonuses', 'guarantee', 'why_choose', 'about', 'final_cta']),
                                sectionEnabled: getAttr('sectionEnabled', {}),
                                onOrderChange: (order) => setAttributes({ sectionOrder: order }),
                                onEnabledChange: (enabled) => setAttributes({ sectionEnabled: enabled })
                            })
                        );
                    }
                    
                    if (tab.name === 'content') {
                        return createElement(Fragment, null,
                            createElement(PanelBody, { title: 'Problem Section', initialOpen: false },
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
                            ),
                            createElement(PanelBody, { title: 'Solution Section', initialOpen: false },
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
                            ),
                            createElement(PanelBody, { title: 'Features Section', initialOpen: false },
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
                            ),
                            createElement(PanelBody, { title: 'FAQ Section', initialOpen: false },
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
                        );
                    }
                })
            ),
            
            // Block Preview
            createElement('div', { 
                className: 'swrice-plugin-page-builder-preview',
                style: {
                    background: '#f9f9f9',
                    padding: '30px',
                    border: '2px dashed #ddd',
                    borderRadius: '8px',
                    textAlign: 'center',
                    minHeight: '200px'
                }
            },
                createElement('div', { 
                    style: { 
                        fontSize: '48px', 
                        marginBottom: '20px',
                        opacity: 0.7
                    } 
                }, '🚀'),
                createElement('h2', { 
                    style: { 
                        margin: '0 0 15px 0', 
                        color: '#333',
                        fontSize: '24px'
                    } 
                }, getAttr('pluginName', 'My Awesome Plugin')),
                createElement('p', { 
                    style: { 
                        margin: '0 0 20px 0', 
                        color: '#666',
                        fontSize: '16px',
                        lineHeight: '1.5'
                    } 
                }, getAttr('heroSubtitle') || 'Configure your plugin page settings in the sidebar to see a preview here.'),
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
                            color: '#999',
                            textDecoration: 'line-through'
                        } 
                    }, '$' + getAttr('pluginOriginalPrice')),
                    createElement('span', { 
                        style: { 
                            fontSize: '28px', 
                            fontWeight: 'bold', 
                            color: '#0073aa'
                        } 
                    }, '$' + getAttr('pluginPrice', '49'))
                ),
                createElement('div', { 
                    style: { 
                        padding: '15px', 
                        background: '#e7f3ff', 
                        border: '1px solid #b3d9ff',
                        borderRadius: '6px',
                        fontSize: '14px',
                        color: '#0073aa'
                    } 
                }, '✨ This is a preview of your Plugin Page Builder. The actual page will render with all sections, styling, and functionality from the original plugin. Configure settings in the sidebar panels above.')
            )
        );
    },
    save: () => null // Server-side rendering
});
