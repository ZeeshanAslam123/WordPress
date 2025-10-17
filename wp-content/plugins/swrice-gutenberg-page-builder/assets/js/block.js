const { registerBlockType } = wp.blocks;
const { createElement, Fragment } = wp.element;
const { TextControl, PanelBody } = wp.components;
const { InspectorControls } = wp.blockEditor;

registerBlockType('swrice/plugin-page-builder', {
    title: 'Plugin Page Builder',
    icon: 'admin-plugins',
    category: 'widgets',
    attributes: {
        pluginName: {
            type: 'string',
            default: 'My Awesome Plugin',
        },
        heroSubtitle: {
            type: 'string',
            default: 'Transform your WordPress experience with our powerful plugin solution',
        },
        pluginPrice: {
            type: 'string',
            default: '49',
        },
        rating: {
            type: 'number',
            default: 5,
        },
        ratingCount: {
            type: 'string',
            default: '5.0',
        },
    },
    edit: (props) => {
        const {
            attributes: { pluginName, heroSubtitle, pluginPrice, rating, ratingCount },
            setAttributes
        } = props;

        return createElement(Fragment, null,
            createElement(InspectorControls, null,
                createElement(PanelBody, { title: 'Plugin Settings', initialOpen: true },
                    createElement(TextControl, {
                        label: 'Plugin Name',
                        value: pluginName || '',
                        onChange: (val) => setAttributes({ pluginName: val })
                    }),
                    createElement(TextControl, {
                        label: 'Hero Subtitle',
                        value: heroSubtitle || '',
                        onChange: (val) => setAttributes({ heroSubtitle: val })
                    }),
                    createElement(TextControl, {
                        label: 'Plugin Price',
                        value: pluginPrice || '',
                        onChange: (val) => setAttributes({ pluginPrice: val })
                    }),
                    createElement(TextControl, {
                        label: 'Rating Count',
                        value: ratingCount || '',
                        onChange: (val) => setAttributes({ ratingCount: val })
                    })
                )
            ),
            createElement('div', { 
                className: 'swrice-plugin-page-builder-preview',
                style: {
                    background: '#f9f9f9',
                    padding: '20px',
                    border: '1px solid #ddd',
                    borderRadius: '4px',
                    marginTop: '10px'
                }
            },
                createElement('h2', { style: { margin: '0 0 10px 0', color: '#333' } }, pluginName || 'My Awesome Plugin'),
                createElement('p', { style: { margin: '0 0 15px 0', color: '#666' } }, heroSubtitle || 'Transform your WordPress experience'),
                createElement('div', { style: { fontSize: '24px', fontWeight: 'bold', color: '#0073aa', marginBottom: '10px' } }, '$' + (pluginPrice || '49')),
                createElement('div', { style: { color: '#666' } }, 'Rating: ' + (ratingCount || '5.0') + '/5'),
                createElement('p', { 
                    style: { 
                        marginTop: '15px', 
                        padding: '10px', 
                        background: '#e7f3ff', 
                        border: '1px solid #b3d9ff',
                        borderRadius: '3px',
                        fontSize: '14px'
                    } 
                }, '✨ This is a preview of your Plugin Page Builder block. Configure the settings in the sidebar to customize your plugin landing page.')
            )
        );
    },
    save: () => null // Server-side rendering
});
