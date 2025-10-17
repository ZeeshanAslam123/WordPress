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
 * Icon options for Features Section - matching original plugin exactly
 */
const FEATURES_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '🚀 Rocket', value: '🚀' },
	{ label: '💎 Diamond', value: '💎' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '⚡ Lightning', value: '⚡' }
];

const FEATURE_ITEM_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '✅ Check Mark', value: '✅' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '🚀 Rocket', value: '🚀' },
	{ label: '💎 Diamond', value: '💎' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '⚡ Lightning', value: '⚡' }
];

/**
 * FeaturesSection Component
 */
export default function FeaturesSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { featuresHeading, featuresIcon, featureItems } = attributes;

	// Handle adding new feature item
	const addFeatureItem = () => {
		const newItems = [...featureItems, {
			icon: '✅',
			title: 'New Feature',
			description: 'Describe this amazing feature'
		}];
		setAttributes({ featureItems: newItems });
	};

	// Handle removing feature item
	const removeFeatureItem = (index) => {
		const newItems = featureItems.filter((_, i) => i !== index);
		setAttributes({ featureItems: newItems });
	};

	// Handle updating feature item
	const updateFeatureItem = (index, field, value) => {
		const newItems = [...featureItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ featureItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Features Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={featuresHeading}
					onChange={(value) => setAttributes({ featuresHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={featuresIcon}
					options={FEATURES_ICON_OPTIONS}
					onChange={(value) => setAttributes({ featuresIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>

				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Feature Items', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addFeatureItem}
						>
							{__('Add Feature', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>

					{featureItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Feature', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeFeatureItem(index)}
								/>
							</div>
							<SelectControl
								label={__('Icon', 'swrice-gutenberg-page-builder')}
								value={item.icon}
								options={FEATURE_ITEM_ICON_OPTIONS}
								onChange={(value) => updateFeatureItem(index, 'icon', value)}
							/>
							<TextControl
								label={__('Title', 'swrice-gutenberg-page-builder')}
								value={item.title}
								onChange={(value) => updateFeatureItem(index, 'title', value)}
							/>
							<TextareaControl
								label={__('Description', 'swrice-gutenberg-page-builder')}
								value={item.description}
								onChange={(value) => updateFeatureItem(index, 'description', value)}
								rows={3}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!featuresHeading && !featureItems.length) return null;

	return (
		<section className="sppm-section sppm-features-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{featuresIcon && <span className="sppm-section-icon">{featuresIcon}</span>}
					{featuresHeading}
				</h2>
			</div>

			<div className="sppm-features-grid">
				{featureItems.map((item, index) => (
					<div key={index} className="sppm-feature-card">
						<div className="sppm-feature-header">
							{item.icon && <div className="sppm-feature-icon">{item.icon}</div>}
							<h3 className="sppm-feature-title">{item.title}</h3>
						</div>
						<p className="sppm-feature-desc">{item.description}</p>
					</div>
				))}
			</div>
		</section>
	);
}