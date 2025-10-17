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
 * Icon options for Problem Section - matching original plugin exactly
 */
const PROBLEM_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '😤 Frustrated Face', value: '😤' },
	{ label: '🚫 Prohibited', value: '🚫' },
	{ label: '⚠️ Warning', value: '⚠️' },
	{ label: '💸 Money Loss', value: '💸' },
	{ label: '📉 Declining', value: '📉' }
];

const PROBLEM_ITEM_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🚫 Prohibited', value: '🚫' },
	{ label: '📱 Mobile', value: '📱' },
	{ label: '⏰ Time', value: '⏰' },
	{ label: '💸 Money Loss', value: '💸' },
	{ label: '😤 Frustrated', value: '😤' },
	{ label: '📉 Declining', value: '📉' }
];

/**
 * Problem Section Component
 */
export default function ProblemSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { problemHeading, problemIcon, problemItems } = attributes;

	// Handle adding new problem item
	const addProblemItem = () => {
		const newItems = [...problemItems, {
			icon: '⚠️',
			title: 'New Problem',
			description: 'Describe the problem here'
		}];
		setAttributes({ problemItems: newItems });
	};

	// Handle removing problem item
	const removeProblemItem = (index) => {
		const newItems = problemItems.filter((_, i) => i !== index);
		setAttributes({ problemItems: newItems });
	};

	// Handle updating problem item
	const updateProblemItem = (index, field, value) => {
		const newItems = [...problemItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ problemItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Problem Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={problemHeading}
					onChange={(value) => setAttributes({ problemHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={problemIcon}
					options={PROBLEM_ICON_OPTIONS}
					onChange={(value) => setAttributes({ problemIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Problem Items', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addProblemItem}
						>
							{__('Add Item', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>
					
					{problemItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Problem', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeProblemItem(index)}
								/>
							</div>
							<SelectControl
								label={__('Icon', 'swrice-gutenberg-page-builder')}
								value={item.icon}
								options={PROBLEM_ITEM_ICON_OPTIONS}
								onChange={(value) => updateProblemItem(index, 'icon', value)}
							/>
							<TextControl
								label={__('Title', 'swrice-gutenberg-page-builder')}
								value={item.title}
								onChange={(value) => updateProblemItem(index, 'title', value)}
							/>
							<TextareaControl
								label={__('Description', 'swrice-gutenberg-page-builder')}
								value={item.description}
								onChange={(value) => updateProblemItem(index, 'description', value)}
								rows={3}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!problemItems || problemItems.length === 0) return null;

	return (
		<section className="sppm-section sppm-problem-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{problemIcon && <span className="sppm-section-icon">{problemIcon}</span>}
					{problemHeading}
				</h2>
			</div>
			
			<div className="sppm-problem-grid">
				{problemItems.map((problem, index) => (
					<div key={index} className="sppm-problem-card">
						{problem.icon && <div className="sppm-problem-icon">{problem.icon}</div>}
						<h3 className="sppm-problem-title">{problem.title}</h3>
						<p className="sppm-problem-desc">{problem.description}</p>
					</div>
				))}
			</div>
		</section>
	);
}
