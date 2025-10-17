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
 * Icon options for How It Works Section - matching original plugin exactly
 */
const HOW_IT_WORKS_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '⚙️ Gear', value: '⚙️' },
	{ label: '🔧 Wrench', value: '🔧' },
	{ label: '📋 Clipboard', value: '📋' },
	{ label: '🎯 Target', value: '🎯' },
	{ label: '⚡ Lightning', value: '⚡' }
];

const STEP_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '1️⃣ Step 1', value: '1️⃣' },
	{ label: '2️⃣ Step 2', value: '2️⃣' },
	{ label: '3️⃣ Step 3', value: '3️⃣' },
	{ label: '📝 Note', value: '📝' },
	{ label: '⚙️ Gear', value: '⚙️' },
	{ label: '🚀 Rocket', value: '🚀' }
];

/**
 * HowItWorksSection Component
 */
export default function HowItWorksSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { howItWorksHeading, howItWorksIcon, stepsItems } = attributes;

	// Handle adding new step item
	const addStepItem = () => {
		const newItems = [...stepsItems, {
			icon: '📝',
			title: 'New Step',
			description: 'Describe this step'
		}];
		setAttributes({ stepsItems: newItems });
	};

	// Handle removing step item
	const removeStepItem = (index) => {
		const newItems = stepsItems.filter((_, i) => i !== index);
		setAttributes({ stepsItems: newItems });
	};

	// Handle updating step item
	const updateStepItem = (index, field, value) => {
		const newItems = [...stepsItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ stepsItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('How It Works Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={howItWorksHeading}
					onChange={(value) => setAttributes({ howItWorksHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={howItWorksIcon}
					options={HOW_IT_WORKS_ICON_OPTIONS}
					onChange={(value) => setAttributes({ howItWorksIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Steps', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addStepItem}
						>
							{__('Add Step', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>
					
					{stepsItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Step', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeStepItem(index)}
								/>
							</div>
							<SelectControl
								label={__('Icon', 'swrice-gutenberg-page-builder')}
								value={item.icon}
								options={STEP_ICON_OPTIONS}
								onChange={(value) => updateStepItem(index, 'icon', value)}
							/>
							<TextControl
								label={__('Title', 'swrice-gutenberg-page-builder')}
								value={item.title}
								onChange={(value) => updateStepItem(index, 'title', value)}
							/>
							<TextareaControl
								label={__('Description', 'swrice-gutenberg-page-builder')}
								value={item.description}
								onChange={(value) => updateStepItem(index, 'description', value)}
								rows={3}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!howItWorksHeading && !stepsItems.length) return null;

	return (
		<section className="sppm-section sppm-how-it-works-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{howItWorksIcon && <span className="sppm-section-icon">{howItWorksIcon}</span>}
					{howItWorksHeading}
				</h2>
			</div>
			
			<div className="sppm-steps-container">
				{stepsItems.map((item, index) => (
					<div key={index} className="sppm-step-item">
						<div className="sppm-step-header">
							{item.icon && <div className="sppm-step-icon">{item.icon}</div>}
							<h3 className="sppm-step-title">{item.title}</h3>
						</div>
						<p className="sppm-step-desc">{item.description}</p>
					</div>
				))}
			</div>
		</section>
	);
}
