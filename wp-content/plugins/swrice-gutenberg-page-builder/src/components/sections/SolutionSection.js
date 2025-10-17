/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';

/**
 * Icon options for Solution Section - matching original plugin exactly
 */
const SOLUTION_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '✨ Sparkles', value: '✨' },
	{ label: '🚀 Rocket', value: '🚀' },
	{ label: '💡 Light Bulb', value: '💡' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '⚡ Lightning', value: '⚡' }
];

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
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={solutionIcon}
					options={SOLUTION_ICON_OPTIONS}
					onChange={(value) => setAttributes({ solutionIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
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
