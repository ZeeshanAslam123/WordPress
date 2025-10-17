/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { 
	PanelBody, 
	TextControl, 
	TextareaControl,
	SelectControl
} from '@wordpress/components';

/**
 * Icon options for About Section - matching original plugin exactly
 */
const ABOUT_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '👤 Person', value: '👤' },
	{ label: '👥 People', value: '👥' },
	{ label: '🏢 Office Building', value: '🏢' },
	{ label: '📖 Book', value: '📖' },
	{ label: '💼 Briefcase', value: '💼' }
];

/**
 * AboutSection Component
 */
export default function AboutSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { aboutHeading, aboutIcon, aboutText } = attributes;

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('About Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={aboutHeading}
					onChange={(value) => setAttributes({ aboutHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={aboutIcon}
					options={ABOUT_ICON_OPTIONS}
					onChange={(value) => setAttributes({ aboutIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				<TextareaControl
					label={__('About Text', 'swrice-gutenberg-page-builder')}
					value={aboutText}
					onChange={(value) => setAttributes({ aboutText: value })}
					rows={6}
				/>
			</PanelBody>
		);
	}

	// Section render
	if (!aboutHeading && !aboutText) return null;

	return (
		<section className="sppm-section sppm-about-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{aboutIcon && <span className="sppm-section-icon">{aboutIcon}</span>}
					{aboutHeading}
				</h2>
			</div>
			
			<div className="sppm-about-content">
				<p>{aboutText}</p>
			</div>
		</section>
	);
}
