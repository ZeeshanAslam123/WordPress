/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';

/**
 * Icon options for Final CTA Section - matching original plugin exactly
 */
const FINAL_CTA_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🚀 Rocket', value: '🚀' },
	{ label: '✨ Sparkles', value: '✨' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '💎 Diamond', value: '💎' },
	{ label: '🔥 Fire', value: '🔥' }
];

/**
 * FinalCTASection Component
 */
export default function FinalCTASection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { ctaTitle, ctaSubtitle, finalCtaHeading, finalCtaIcon, buyNowShortcode, demoLink, pluginPrice } = attributes;

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Final CTA Section (Get Started)', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={finalCtaHeading}
					onChange={(value) => setAttributes({ finalCtaHeading: value })}
					placeholder={__('Ready to Get Started?', 'swrice-gutenberg-page-builder')}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={finalCtaIcon}
					options={FINAL_CTA_ICON_OPTIONS}
					onChange={(value) => setAttributes({ finalCtaIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				<TextControl
					label={__('CTA Title', 'swrice-gutenberg-page-builder')}
					value={ctaTitle}
					onChange={(value) => setAttributes({ ctaTitle: value })}
					placeholder={__('Ready to Get Started?', 'swrice-gutenberg-page-builder')}
				/>
				<TextareaControl
					label={__('CTA Subtitle', 'swrice-gutenberg-page-builder')}
					value={ctaSubtitle}
					onChange={(value) => setAttributes({ ctaSubtitle: value })}
					rows={3}
					placeholder={__('Join thousands of satisfied customers and transform your website today.', 'swrice-gutenberg-page-builder')}
				/>
			</PanelBody>
		);
	}

	// Section render
	if (!ctaTitle && !ctaSubtitle && !buyNowShortcode && !demoLink) return null;

	return (
		<section className="sppm-section sppm-final-cta">
			<div className="sppm-cta">
				<div className="sppm-cta-content">
					{finalCtaHeading && (
						<h2 className="sppm-section-title">
							{finalCtaIcon && <span className="sppm-section-icon">{finalCtaIcon}</span>}
							{finalCtaHeading}
						</h2>
					)}
					{ctaTitle && <h3 className="sppm-cta-title">{ctaTitle}</h3>}
					{ctaSubtitle && <p className="sppm-cta-subtitle">{ctaSubtitle}</p>}
				</div>
				
				<div className="sppm-cta-buttons">
					{buyNowShortcode ? (
						<div dangerouslySetInnerHTML={{ __html: buyNowShortcode }} />
					) : pluginPrice ? (
						<button className="sppm-btn sppm-btn-primary">
							Buy Now - ${pluginPrice}
						</button>
					) : null}
					{demoLink && demoLink !== '#' && (
						<a href={demoLink} className="sppm-btn sppm-btn-ghost" target="_blank" rel="noopener noreferrer">
							Live Demo
						</a>
					)}
				</div>
			</div>
		</section>
	);
}
