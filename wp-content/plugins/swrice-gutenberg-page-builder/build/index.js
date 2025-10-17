/**
 * WordPress dependencies
 */
(function() {
    'use strict';
    
    // Ensure wp.blocks is available
    if (typeof wp === 'undefined' || typeof wp.blocks === 'undefined') {
        console.error('WordPress blocks not available');
        return;
    }

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { 
	PanelBody, 
	TextControl, 
	TextareaControl,
	ToggleControl,
	Button,
	RangeControl,
	Flex,
	FlexItem,
	Card,
	CardBody
} = wp.components;
const { 
	InspectorControls, 
	MediaUpload, 
	MediaUploadCheck,
	useBlockProps 
} = wp.blockEditor;
const { useState } = wp.element;
const { dragHandle, plus, trash } = wp.icons;

/**
 * Section Manager Component
 */
function SectionManager({ sectionOrder, sectionEnabled, onOrderChange, onEnabledChange }) {
	const [draggedIndex, setDraggedIndex] = useState(null);

	const sectionLabels = {
		problem: __('Problem Section', 'swrice-gutenberg-page-builder'),
		solution: __('Solution Section', 'swrice-gutenberg-page-builder'),
		how_it_works: __('How It Works', 'swrice-gutenberg-page-builder'),
		features: __('Features', 'swrice-gutenberg-page-builder'),
		testimonials: __('Testimonials', 'swrice-gutenberg-page-builder'),
		faq: __('FAQ', 'swrice-gutenberg-page-builder'),
		bonuses: __('Bonuses', 'swrice-gutenberg-page-builder'),
		guarantee: __('Guarantee', 'swrice-gutenberg-page-builder'),
		why_choose: __('Why Choose Us', 'swrice-gutenberg-page-builder'),
		about: __('About', 'swrice-gutenberg-page-builder'),
		final_cta: __('Final CTA', 'swrice-gutenberg-page-builder')
	};

	const handleToggle = (sectionKey, enabled) => {
		const newEnabled = { ...sectionEnabled };
		newEnabled[sectionKey] = enabled;
		onEnabledChange(newEnabled);
	};

	return wp.element.createElement('div', { className: 'sgpb-section-manager' },
		wp.element.createElement('p', { className: 'description' },
			__('Use the toggle switches to enable/disable sections.', 'swrice-gutenberg-page-builder')
		),
		wp.element.createElement('div', { className: 'sgpb-section-list' },
			sectionOrder.map((sectionKey, index) => 
				wp.element.createElement(Card, { 
					key: sectionKey,
					className: `sgpb-section-item ${!sectionEnabled[sectionKey] ? 'disabled' : ''}`
				},
					wp.element.createElement(CardBody, null,
						wp.element.createElement(Flex, { align: 'center', gap: 3 },
							wp.element.createElement(FlexItem, { isBlock: true },
								wp.element.createElement('strong', null, sectionLabels[sectionKey] || sectionKey)
							),
							wp.element.createElement(FlexItem, null,
								wp.element.createElement(ToggleControl, {
									checked: sectionEnabled[sectionKey] || false,
									onChange: (enabled) => handleToggle(sectionKey, enabled)
								})
							)
						)
					)
				)
			)
		)
	);
}

/**
 * Hero Section Component
 */
function HeroSection({
	pluginName,
	heroSubtitle,
	pluginPrice,
	buyNowShortcode,
	demoLink,
	heroImageUrl,
	heroImageAlt,
	rating,
	ratingCount,
	isEditor = false
}) {
	const renderStars = (rating) => {
		return '★'.repeat(rating) + '☆'.repeat(5 - rating);
	};

	return wp.element.createElement('section', { className: 'sppm-hero' },
		wp.element.createElement('div', { className: 'sppm-hero-left' },
			wp.element.createElement('div', { className: 'sppm-logo-row' },
				wp.element.createElement('div', { className: 'sppm-logo-mark' },
					wp.element.createElement('svg', { width: '28', height: '24', viewBox: '0 0 28 24', fill: 'none' },
						wp.element.createElement('rect', { x: '2', y: '2', width: '20', height: '4', rx: '2', fill: '#5fa0d8' }),
						wp.element.createElement('rect', { x: '2', y: '10', width: '16', height: '4', rx: '2', fill: '#82bfe4' }),
						wp.element.createElement('rect', { x: '2', y: '18', width: '12', height: '4', rx: '2', fill: '#bcdff6' })
					)
				),
				wp.element.createElement('div', { className: 'sppm-logo-text' }, pluginName)
			),
			wp.element.createElement('div', { className: 'sppm-rating' },
				wp.element.createElement('div', { className: 'sppm-rating-stars' }, renderStars(rating)),
				wp.element.createElement('div', null, ratingCount)
			),
			wp.element.createElement('h1', { className: 'sppm-hero-title' }, pluginName),
			wp.element.createElement('p', { className: 'sppm-hero-subtitle' }, heroSubtitle),
			wp.element.createElement('div', { className: 'sppm-hero-ctas' },
				buyNowShortcode ? 
					(isEditor ? 
						wp.element.createElement('div', { className: 'sgpb-shortcode-preview' },
							wp.element.createElement('code', null, buyNowShortcode)
						) :
						wp.element.createElement('div', { dangerouslySetInnerHTML: { __html: buyNowShortcode } })
					) :
					wp.element.createElement('button', { className: 'sppm-btn sppm-btn-primary' },
						`Buy Now - $${pluginPrice}`
					),
				demoLink && demoLink !== '#' &&
					wp.element.createElement('a', { 
						href: demoLink, 
						className: 'sppm-btn sppm-btn-ghost',
						target: '_blank',
						rel: 'noopener noreferrer',
						onClick: isEditor ? (e) => e.preventDefault() : undefined
					}, 'Live Demo')
			)
		),
		wp.element.createElement('div', { className: 'sppm-hero-right' },
			heroImageUrl ? 
				wp.element.createElement('img', { 
					src: heroImageUrl, 
					alt: heroImageAlt || pluginName, 
					className: 'sppm-hero-image' 
				}) :
				wp.element.createElement('div', { className: 'sppm-device' },
					wp.element.createElement('div', { className: 'sppm-device-inner' },
						wp.element.createElement('h3', null, 'Plugin Preview'),
						wp.element.createElement('div', { className: 'sppm-section-row' }, 'Getting Started ', wp.element.createElement('span', null, '▾')),
						wp.element.createElement('div', { className: 'sppm-section-row' }, 'Configuration ', wp.element.createElement('span', null, '▾')),
						wp.element.createElement('div', { className: 'sppm-section-row' }, 'Advanced Features ', wp.element.createElement('span', null, '▾'))
					)
				)
		)
	);
}

/**
 * Simple Section Component
 */
function SimpleSection({ title, content, className = '' }) {
	if (!content) return null;
	
	return wp.element.createElement('section', { className: `sppm-section ${className}` },
		wp.element.createElement('div', { className: 'sppm-section-header' },
			wp.element.createElement('h2', { className: 'sppm-section-title' }, title)
		),
		wp.element.createElement('div', { className: 'sppm-section-content' },
			wp.element.createElement('p', null, content)
		)
	);
}

/**
 * Block Edit Component
 */
function Edit({ attributes, setAttributes }) {
	const {
		pluginName,
		heroSubtitle,
		pluginPrice,
		pluginOriginalPrice,
		buyNowShortcode,
		demoLink,
		heroImageId,
		heroImageUrl,
		heroImageAlt,
		rating,
		ratingCount,
		sectionOrder,
		sectionEnabled,
		solutionHeading,
		solutionDescription,
		aboutHeading,
		aboutDescription,
		ctaTitle,
		ctaSubtitle
	} = attributes;

	const blockProps = useBlockProps({
		className: 'sgpb-plugin-page-editor'
	});

	return wp.element.createElement('div', blockProps,
		wp.element.createElement(InspectorControls, null,
			// Hero Settings
			wp.element.createElement(PanelBody, { title: __('Hero Section', 'swrice-gutenberg-page-builder'), initialOpen: true },
				wp.element.createElement(TextControl, {
					label: __('Plugin Name', 'swrice-gutenberg-page-builder'),
					value: pluginName,
					onChange: (value) => setAttributes({ pluginName: value })
				}),
				wp.element.createElement(TextareaControl, {
					label: __('Hero Subtitle', 'swrice-gutenberg-page-builder'),
					value: heroSubtitle,
					onChange: (value) => setAttributes({ heroSubtitle: value }),
					rows: 3
				}),
				wp.element.createElement(TextControl, {
					label: __('Plugin Price', 'swrice-gutenberg-page-builder'),
					value: pluginPrice,
					onChange: (value) => setAttributes({ pluginPrice: value }),
					type: 'number'
				}),
				wp.element.createElement(TextareaControl, {
					label: __('Buy Now Shortcode', 'swrice-gutenberg-page-builder'),
					value: buyNowShortcode,
					onChange: (value) => setAttributes({ buyNowShortcode: value }),
					help: __('Paste your payment processor shortcode here', 'swrice-gutenberg-page-builder')
				}),
				wp.element.createElement(TextControl, {
					label: __('Demo Link', 'swrice-gutenberg-page-builder'),
					value: demoLink,
					onChange: (value) => setAttributes({ demoLink: value }),
					type: 'url'
				}),
				wp.element.createElement(RangeControl, {
					label: __('Rating', 'swrice-gutenberg-page-builder'),
					value: rating,
					onChange: (value) => setAttributes({ rating: value }),
					min: 1,
					max: 5
				}),
				wp.element.createElement(TextControl, {
					label: __('Rating Display', 'swrice-gutenberg-page-builder'),
					value: ratingCount,
					onChange: (value) => setAttributes({ ratingCount: value })
				}),
				
				// Hero Image
				wp.element.createElement(MediaUploadCheck, null,
					wp.element.createElement(MediaUpload, {
						onSelect: (media) => {
							setAttributes({
								heroImageId: media.id,
								heroImageUrl: media.url,
								heroImageAlt: media.alt
							});
						},
						allowedTypes: ['image'],
						value: heroImageId,
						render: ({ open }) => wp.element.createElement('div', null,
							wp.element.createElement(Button, { 
								onClick: open,
								variant: 'secondary',
								style: { marginBottom: '10px' }
							}, heroImageUrl ? __('Change Hero Image', 'swrice-gutenberg-page-builder') : __('Select Hero Image', 'swrice-gutenberg-page-builder')),
							heroImageUrl && wp.element.createElement('div', null,
								wp.element.createElement('img', { src: heroImageUrl, alt: heroImageAlt, style: { maxWidth: '100%', height: 'auto' } }),
								wp.element.createElement(Button, { 
									onClick: () => setAttributes({ heroImageId: 0, heroImageUrl: '', heroImageAlt: '' }),
									variant: 'link',
									isDestructive: true
								}, __('Remove Image', 'swrice-gutenberg-page-builder'))
							)
						)
					})
				)
			),

			// Section Management
			wp.element.createElement(PanelBody, { title: __('Section Management', 'swrice-gutenberg-page-builder'), initialOpen: false },
				wp.element.createElement(SectionManager, {
					sectionOrder: sectionOrder,
					sectionEnabled: sectionEnabled,
					onOrderChange: (newOrder) => setAttributes({ sectionOrder: newOrder }),
					onEnabledChange: (newEnabled) => setAttributes({ sectionEnabled: newEnabled })
				})
			),

			// Solution Section
			wp.element.createElement(PanelBody, { title: __('Solution Section', 'swrice-gutenberg-page-builder'), initialOpen: false },
				wp.element.createElement(TextControl, {
					label: __('Section Heading', 'swrice-gutenberg-page-builder'),
					value: solutionHeading,
					onChange: (value) => setAttributes({ solutionHeading: value })
				}),
				wp.element.createElement(TextareaControl, {
					label: __('Description', 'swrice-gutenberg-page-builder'),
					value: solutionDescription,
					onChange: (value) => setAttributes({ solutionDescription: value }),
					rows: 4
				})
			),

			// About Section
			wp.element.createElement(PanelBody, { title: __('About Section', 'swrice-gutenberg-page-builder'), initialOpen: false },
				wp.element.createElement(TextControl, {
					label: __('Section Heading', 'swrice-gutenberg-page-builder'),
					value: aboutHeading,
					onChange: (value) => setAttributes({ aboutHeading: value })
				}),
				wp.element.createElement(TextareaControl, {
					label: __('Description', 'swrice-gutenberg-page-builder'),
					value: aboutDescription,
					onChange: (value) => setAttributes({ aboutDescription: value }),
					rows: 4
				})
			),

			// Final CTA Section
			wp.element.createElement(PanelBody, { title: __('Final CTA Section', 'swrice-gutenberg-page-builder'), initialOpen: false },
				wp.element.createElement(TextControl, {
					label: __('CTA Title', 'swrice-gutenberg-page-builder'),
					value: ctaTitle,
					onChange: (value) => setAttributes({ ctaTitle: value })
				}),
				wp.element.createElement(TextControl, {
					label: __('CTA Subtitle', 'swrice-gutenberg-page-builder'),
					value: ctaSubtitle,
					onChange: (value) => setAttributes({ ctaSubtitle: value })
				})
			)
		),

		// Block Content
		wp.element.createElement('div', { className: 'sppm-plugin-page' },
			wp.element.createElement('div', { className: 'sppm-container' },
				// Hero Section
				wp.element.createElement(HeroSection, {
					pluginName,
					heroSubtitle,
					pluginPrice,
					pluginOriginalPrice,
					buyNowShortcode,
					demoLink,
					heroImageUrl,
					heroImageAlt,
					rating,
					ratingCount,
					isEditor: true
				}),

				// Dynamic Sections
				sectionOrder.map((sectionKey) => {
					if (!sectionEnabled[sectionKey]) return null;
					
					switch (sectionKey) {
						case 'solution':
							return sectionEnabled.solution && wp.element.createElement(SimpleSection, {
								key: sectionKey,
								title: solutionHeading,
								content: solutionDescription,
								className: 'sppm-solution-section'
							});
						case 'about':
							return sectionEnabled.about && wp.element.createElement(SimpleSection, {
								key: sectionKey,
								title: aboutHeading,
								content: aboutDescription,
								className: 'sppm-about-section'
							});
						case 'final_cta':
							return sectionEnabled.final_cta && (ctaTitle || ctaSubtitle) && wp.element.createElement('section', {
								key: sectionKey,
								className: 'sppm-section sppm-final-cta'
							},
								wp.element.createElement('div', { className: 'sppm-cta' },
									wp.element.createElement('div', { className: 'sppm-cta-content' },
										ctaTitle && wp.element.createElement('h3', { className: 'sppm-cta-title' }, ctaTitle),
										ctaSubtitle && wp.element.createElement('p', { className: 'sppm-cta-subtitle' }, ctaSubtitle)
									),
									wp.element.createElement('div', { className: 'sppm-cta-buttons' },
										wp.element.createElement('button', { className: 'sppm-btn sppm-btn-primary' }, `Buy Now - $${pluginPrice}`)
									)
								)
							);
						default:
							return wp.element.createElement(SimpleSection, {
								key: sectionKey,
								title: sectionKey.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase()),
								content: `This ${sectionKey.replace('_', ' ')} section is under development.`,
								className: `sppm-${sectionKey.replace('_', '-')}-section`
							});
					}
				})
			)
		)
	);
}

/**
 * Block Save Component
 */
function Save({ attributes }) {
	const {
		pluginName,
		heroSubtitle,
		pluginPrice,
		buyNowShortcode,
		demoLink,
		heroImageUrl,
		heroImageAlt,
		rating,
		ratingCount,
		sectionOrder,
		sectionEnabled,
		solutionHeading,
		solutionDescription,
		aboutHeading,
		aboutDescription,
		ctaTitle,
		ctaSubtitle
	} = attributes;

	const blockProps = useBlockProps.save({
		className: 'sppm-plugin-page'
	});

	const renderStars = (rating) => {
		return '★'.repeat(rating) + '☆'.repeat(5 - rating);
	};

	return wp.element.createElement('div', blockProps,
		wp.element.createElement('div', { className: 'sppm-container' },
			// Hero Section
			wp.element.createElement('section', { className: 'sppm-hero' },
				wp.element.createElement('div', { className: 'sppm-hero-left' },
					wp.element.createElement('div', { className: 'sppm-logo-row' },
						wp.element.createElement('div', { className: 'sppm-logo-mark' },
							wp.element.createElement('svg', { width: '28', height: '24', viewBox: '0 0 28 24', fill: 'none' },
								wp.element.createElement('rect', { x: '2', y: '2', width: '20', height: '4', rx: '2', fill: '#5fa0d8' }),
								wp.element.createElement('rect', { x: '2', y: '10', width: '16', height: '4', rx: '2', fill: '#82bfe4' }),
								wp.element.createElement('rect', { x: '2', y: '18', width: '12', height: '4', rx: '2', fill: '#bcdff6' })
							)
						),
						wp.element.createElement('div', { className: 'sppm-logo-text' }, pluginName)
					),
					wp.element.createElement('div', { className: 'sppm-rating' },
						wp.element.createElement('div', { className: 'sppm-rating-stars' }, renderStars(rating)),
						wp.element.createElement('div', null, ratingCount)
					),
					wp.element.createElement('h1', { className: 'sppm-hero-title' }, pluginName),
					wp.element.createElement('p', { className: 'sppm-hero-subtitle' }, heroSubtitle),
					wp.element.createElement('div', { className: 'sppm-hero-ctas' },
						buyNowShortcode ? 
							wp.element.createElement('div', { dangerouslySetInnerHTML: { __html: buyNowShortcode } }) :
							wp.element.createElement('button', { className: 'sppm-btn sppm-btn-primary' }, `Buy Now - $${pluginPrice}`),
						demoLink && demoLink !== '#' &&
							wp.element.createElement('a', { 
								href: demoLink, 
								className: 'sppm-btn sppm-btn-ghost',
								target: '_blank',
								rel: 'noopener noreferrer'
							}, 'Live Demo')
					)
				),
				wp.element.createElement('div', { className: 'sppm-hero-right' },
					heroImageUrl ? 
						wp.element.createElement('img', { 
							src: heroImageUrl, 
							alt: heroImageAlt || pluginName, 
							className: 'sppm-hero-image' 
						}) :
						wp.element.createElement('div', { className: 'sppm-device' },
							wp.element.createElement('div', { className: 'sppm-device-inner' },
								wp.element.createElement('h3', null, 'Plugin Preview'),
								wp.element.createElement('div', { className: 'sppm-section-row' }, 'Getting Started ', wp.element.createElement('span', null, '▾')),
								wp.element.createElement('div', { className: 'sppm-section-row' }, 'Configuration ', wp.element.createElement('span', null, '▾')),
								wp.element.createElement('div', { className: 'sppm-section-row' }, 'Advanced Features ', wp.element.createElement('span', null, '▾'))
							)
						)
				)
			),

			// Dynamic Sections
			sectionOrder.map((sectionKey) => {
				if (!sectionEnabled[sectionKey]) return null;
				
				switch (sectionKey) {
					case 'solution':
						return sectionEnabled.solution && (solutionHeading || solutionDescription) && wp.element.createElement('section', {
							key: sectionKey,
							className: 'sppm-section sppm-solution-section'
						},
							wp.element.createElement('div', { className: 'sppm-section-header' },
								wp.element.createElement('h2', { className: 'sppm-section-title' }, solutionHeading)
							),
							wp.element.createElement('div', { className: 'sppm-solution-content' },
								wp.element.createElement('p', null, solutionDescription)
							)
						);
					case 'about':
						return sectionEnabled.about && aboutDescription && wp.element.createElement('section', {
							key: sectionKey,
							className: 'sppm-section sppm-about-section'
						},
							wp.element.createElement('div', { className: 'sppm-section-header' },
								wp.element.createElement('h2', { className: 'sppm-section-title' }, aboutHeading)
							),
							wp.element.createElement('div', { className: 'sppm-about-content' },
								wp.element.createElement('p', { className: 'sppm-about-description' }, aboutDescription)
							)
						);
					case 'final_cta':
						return sectionEnabled.final_cta && (ctaTitle || ctaSubtitle) && wp.element.createElement('section', {
							key: sectionKey,
							className: 'sppm-section sppm-final-cta'
						},
							wp.element.createElement('div', { className: 'sppm-cta' },
								wp.element.createElement('div', { className: 'sppm-cta-content' },
									ctaTitle && wp.element.createElement('h3', { className: 'sppm-cta-title' }, ctaTitle),
									ctaSubtitle && wp.element.createElement('p', { className: 'sppm-cta-subtitle' }, ctaSubtitle)
								),
								wp.element.createElement('div', { className: 'sppm-cta-buttons' },
									buyNowShortcode ? 
										wp.element.createElement('div', { dangerouslySetInnerHTML: { __html: buyNowShortcode } }) :
										wp.element.createElement('button', { className: 'sppm-btn sppm-btn-primary' }, `Buy Now - $${pluginPrice}`),
									demoLink && demoLink !== '#' &&
										wp.element.createElement('a', { 
											href: demoLink, 
											className: 'sppm-btn sppm-btn-ghost',
											target: '_blank',
											rel: 'noopener noreferrer'
										}, 'Live Demo')
								)
							)
						);
					default:
						return null;
				}
			})
		)
	);
}

/**
 * Register the block
 */
console.log('Registering Swrice Plugin Page Builder block...');
registerBlockType('swrice/plugin-page-builder', {
	title: __('Plugin Page Builder', 'swrice-gutenberg-page-builder'),
	description: __('Create professional plugin landing pages with customizable sections', 'swrice-gutenberg-page-builder'),
	category: 'swrice-blocks',
	icon: 'admin-plugins',
	supports: {
		html: false,
		align: ['wide', 'full']
	},
	attributes: {
		pluginName: {
			type: 'string',
			default: 'My Awesome Plugin'
		},
		heroSubtitle: {
			type: 'string',
			default: 'Transform your WordPress experience with our powerful plugin solution'
		},
		pluginPrice: {
			type: 'string',
			default: '49'
		},
		pluginOriginalPrice: {
			type: 'string',
			default: '99'
		},
		buyNowShortcode: {
			type: 'string',
			default: ''
		},
		demoLink: {
			type: 'string',
			default: '#'
		},
		heroImageId: {
			type: 'number',
			default: 0
		},
		heroImageUrl: {
			type: 'string',
			default: ''
		},
		heroImageAlt: {
			type: 'string',
			default: ''
		},
		rating: {
			type: 'number',
			default: 5
		},
		ratingCount: {
			type: 'string',
			default: '5.0'
		},
		sectionOrder: {
			type: 'array',
			default: [
				'problem',
				'solution', 
				'how_it_works',
				'features',
				'testimonials',
				'faq',
				'bonuses',
				'guarantee',
				'why_choose',
				'about',
				'final_cta'
			]
		},
		sectionEnabled: {
			type: 'object',
			default: {
				problem: true,
				solution: true,
				how_it_works: true,
				features: true,
				testimonials: true,
				faq: true,
				bonuses: true,
				guarantee: true,
				why_choose: true,
				about: true,
				final_cta: true
			}
		},
		solutionHeading: {
			type: 'string',
			default: 'The Solution'
		},
		solutionDescription: {
			type: 'string',
			default: 'Our plugin provides the perfect solution to all your problems with an intuitive interface and powerful features.'
		},
		aboutHeading: {
			type: 'string',
			default: 'About'
		},
		aboutDescription: {
			type: 'string',
			default: 'We are passionate developers committed to creating the best WordPress plugins for our community.'
		},
		ctaTitle: {
			type: 'string',
			default: 'Ready to Get Started?'
		},
		ctaSubtitle: {
			type: 'string',
			default: 'Join thousands of satisfied customers today!'
		}
	},
	edit: Edit,
	save: Save
});

})(); // End IIFE
