/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';

/**
 * BonusesSection Component
 */
export default function BonusesSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Bonuses', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<p>{__('Configuration options will be added here.', 'swrice-gutenberg-page-builder')}</p>
			</PanelBody>
		);
	}

	// Section render - placeholder
	return (
		<section className="sppm-section sppm-bonuses-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">Bonuses</h2>
			</div>
			<div className="sppm-section-content">
				<p>{__('This section is under development.', 'swrice-gutenberg-page-builder')}</p>
			</div>
		</section>
	);
}
