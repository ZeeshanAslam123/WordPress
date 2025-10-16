/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';

/**
 * HowItWorksSection Component
 */
export default function HowItWorksSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('How It Works', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<p>{__('Configuration options will be added here.', 'swrice-gutenberg-page-builder')}</p>
			</PanelBody>
		);
	}

	// Section render - placeholder
	return (
		<section className="sppm-section sppm-how-it-works-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">How It Works</h2>
			</div>
			<div className="sppm-section-content">
				<p>{__('This section is under development.', 'swrice-gutenberg-page-builder')}</p>
			</div>
		</section>
	);
}
