/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';

/**
 * WhyChooseSection Component
 */
export default function WhyChooseSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Why Choose Us', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<p>{__('Configuration options will be added here.', 'swrice-gutenberg-page-builder')}</p>
			</PanelBody>
		);
	}

	// Section render - placeholder
	return (
		<section className="sppm-section sppm-why-choose-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">Why Choose Us</h2>
			</div>
			<div className="sppm-section-content">
				<p>{__('This section is under development.', 'swrice-gutenberg-page-builder')}</p>
			</div>
		</section>
	);
}
