/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

/**
 * Solution Section Component
 */
export default function SolutionSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { solutionHeading, solutionIcon, solutionDescription } = attributes;

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Solution Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={solutionHeading}
					onChange={(value) => setAttributes({ solutionHeading: value })}
				/>
				<TextControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={solutionIcon}
					onChange={(value) => setAttributes({ solutionIcon: value })}
				/>
				<TextareaControl
					label={__('Description', 'swrice-gutenberg-page-builder')}
					value={solutionDescription}
					onChange={(value) => setAttributes({ solutionDescription: value })}
					rows={4}
				/>
			</PanelBody>
		);
	}

	// Section render
	if (!solutionHeading && !solutionDescription) return null;

	return (
		<section className="sppm-section sppm-solution-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{solutionIcon && <span className="sppm-section-icon">{solutionIcon}</span>}
					{solutionHeading}
				</h2>
			</div>
			
			<div className="sppm-solution-content">
				<p>{solutionDescription}</p>
			</div>
		</section>
	);
}
