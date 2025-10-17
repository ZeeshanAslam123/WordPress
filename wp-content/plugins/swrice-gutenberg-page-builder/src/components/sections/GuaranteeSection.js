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
 * Icon options for Guarantee Section - matching original plugin exactly
 */
const GUARANTEE_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🛡️ Shield', value: '🛡️' },
	{ label: '✅ Check Mark', value: '✅' },
	{ label: '💯 Hundred', value: '💯' },
	{ label: '🔒 Lock', value: '🔒' },
	{ label: '⭐ Star', value: '⭐' }
];

/**
 * GuaranteeSection Component
 */
export default function GuaranteeSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { guaranteeHeading, guaranteeIcon, guaranteeText } = attributes;

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Guarantee Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={guaranteeHeading}
					onChange={(value) => setAttributes({ guaranteeHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={guaranteeIcon}
					options={GUARANTEE_ICON_OPTIONS}
					onChange={(value) => setAttributes({ guaranteeIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				<TextareaControl
					label={__('Guarantee Text', 'swrice-gutenberg-page-builder')}
					value={guaranteeText}
					onChange={(value) => setAttributes({ guaranteeText: value })}
					rows={4}
				/>
			</PanelBody>
		);
	}

	// Section render
	if (!guaranteeHeading && !guaranteeText) return null;

	return (
		<section className="sppm-section sppm-guarantee-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{guaranteeIcon && <span className="sppm-section-icon">{guaranteeIcon}</span>}
					{guaranteeHeading}
				</h2>
			</div>
			
			<div className="sppm-guarantee-content">
				<p>{guaranteeText}</p>
			</div>
		</section>
	);
}
