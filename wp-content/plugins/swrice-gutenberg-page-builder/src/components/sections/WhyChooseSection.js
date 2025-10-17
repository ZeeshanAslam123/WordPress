/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { 
	PanelBody, 
	TextControl, 
	TextareaControl,
	SelectControl,
	Button
} from '@wordpress/components';
import { plus, trash } from '@wordpress/icons';

/**
 * Icon options for Why Choose Section - matching original plugin exactly
 */
const WHY_CHOOSE_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🏆 Trophy', value: '🏆' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '💎 Diamond', value: '💎' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '🚀 Rocket', value: '🚀' }
];

const WHY_CHOOSE_ITEM_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '✅ Check Mark', value: '✅' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '🏆 Trophy', value: '🏆' },
	{ label: '💎 Diamond', value: '💎' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '🚀 Rocket', value: '🚀' }
];

/**
 * WhyChooseSection Component
 */
export default function WhyChooseSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { whyChooseHeading, whyChooseIcon, whyChooseItems } = attributes;

	// Handle adding new why choose item
	const addWhyChooseItem = () => {
		const newItems = [...whyChooseItems, {
			icon: '✅',
			title: 'New Reason',
			description: 'Describe why customers should choose you'
		}];
		setAttributes({ whyChooseItems: newItems });
	};

	// Handle removing why choose item
	const removeWhyChooseItem = (index) => {
		const newItems = whyChooseItems.filter((_, i) => i !== index);
		setAttributes({ whyChooseItems: newItems });
	};

	// Handle updating why choose item
	const updateWhyChooseItem = (index, field, value) => {
		const newItems = [...whyChooseItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ whyChooseItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Why Choose Us Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={whyChooseHeading}
					onChange={(value) => setAttributes({ whyChooseHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={whyChooseIcon}
					options={WHY_CHOOSE_ICON_OPTIONS}
					onChange={(value) => setAttributes({ whyChooseIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Why Choose Items', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addWhyChooseItem}
						>
							{__('Add Item', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>
					
					{whyChooseItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Reason', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeWhyChooseItem(index)}
								/>
							</div>
							<SelectControl
								label={__('Icon', 'swrice-gutenberg-page-builder')}
								value={item.icon}
								options={WHY_CHOOSE_ITEM_ICON_OPTIONS}
								onChange={(value) => updateWhyChooseItem(index, 'icon', value)}
							/>
							<TextControl
								label={__('Title', 'swrice-gutenberg-page-builder')}
								value={item.title}
								onChange={(value) => updateWhyChooseItem(index, 'title', value)}
							/>
							<TextareaControl
								label={__('Description', 'swrice-gutenberg-page-builder')}
								value={item.description}
								onChange={(value) => updateWhyChooseItem(index, 'description', value)}
								rows={3}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!whyChooseHeading && !whyChooseItems.length) return null;

	return (
		<section className="sppm-section sppm-why-choose-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{whyChooseIcon && <span className="sppm-section-icon">{whyChooseIcon}</span>}
					{whyChooseHeading}
				</h2>
			</div>
			
			<div className="sppm-why-choose-grid">
				{whyChooseItems.map((item, index) => (
					<div key={index} className="sppm-why-choose-card">
						<div className="sppm-why-choose-header">
							{item.icon && <div className="sppm-why-choose-icon">{item.icon}</div>}
							<h3 className="sppm-why-choose-title">{item.title}</h3>
						</div>
						<p className="sppm-why-choose-desc">{item.description}</p>
					</div>
				))}
			</div>
		</section>
	);
}
