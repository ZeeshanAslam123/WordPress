/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';

/**
 * FAQSection Component
 */
export default function FAQSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('FAQ', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<p>{__('Configuration options will be added here.', 'swrice-gutenberg-page-builder')}</p>
			</PanelBody>
		);
	}

	// Section render - placeholder
	return (
		<section className="sppm-section sppm-faq-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">FAQ</h2>
			</div>
			<div className="sppm-section-content">
				<p>{__('This section is under development.', 'swrice-gutenberg-page-builder')}</p>
			</div>
		</section>
	);
}
