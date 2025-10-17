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
 * Icon options for Bonuses Section - matching original plugin exactly
 */
const BONUSES_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🎁 Gift', value: '🎁' },
<<<<<<< HEAD
	{ label: '🎉 Party Popper', value: '🎉' },
=======
	{ label: '🎉 Party', value: '🎉' },
>>>>>>> ab840280dcf794a970ee055d22939490f494fb0d
	{ label: '💎 Diamond', value: '💎' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '🏆 Trophy', value: '🏆' }
];

const BONUS_ITEM_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '🎁 Gift', value: '🎁' },
	{ label: '📚 Books', value: '📚' },
<<<<<<< HEAD
	{ label: '🎥 Movie Camera', value: '🎥' },
	{ label: '📋 Clipboard', value: '📋' },
=======
	{ label: '🎥 Video', value: '🎥' },
	{ label: '📋 Guide', value: '📋' },
>>>>>>> ab840280dcf794a970ee055d22939490f494fb0d
	{ label: '💎 Diamond', value: '💎' },
	{ label: '⭐ Star', value: '⭐' }
];

/**
 * BonusesSection Component
 */
export default function BonusesSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { bonusesHeading, bonusesIcon, bonusItems } = attributes;

	// Handle adding new bonus item
	const addBonusItem = () => {
		const newItems = [...bonusItems, {
			icon: '🎁',
			title: 'New Bonus',
<<<<<<< HEAD
			description: 'Describe the bonus here',
			value: '99'
=======
			description: 'Description of this bonus',
			value: '29'
>>>>>>> ab840280dcf794a970ee055d22939490f494fb0d
		}];
		setAttributes({ bonusItems: newItems });
	};

	// Handle removing bonus item
	const removeBonusItem = (index) => {
		const newItems = bonusItems.filter((_, i) => i !== index);
		setAttributes({ bonusItems: newItems });
	};

	// Handle updating bonus item
	const updateBonusItem = (index, field, value) => {
		const newItems = [...bonusItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ bonusItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Bonuses Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={bonusesHeading}
					onChange={(value) => setAttributes({ bonusesHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={bonusesIcon}
					options={BONUSES_ICON_OPTIONS}
					onChange={(value) => setAttributes({ bonusesIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Bonus Items', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addBonusItem}
						>
<<<<<<< HEAD
							{__('Add Item', 'swrice-gutenberg-page-builder')}
=======
							{__('Add Bonus', 'swrice-gutenberg-page-builder')}
>>>>>>> ab840280dcf794a970ee055d22939490f494fb0d
						</Button>
					</div>
					
					{bonusItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Bonus', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeBonusItem(index)}
								/>
							</div>
							<SelectControl
								label={__('Icon', 'swrice-gutenberg-page-builder')}
								value={item.icon}
								options={BONUS_ITEM_ICON_OPTIONS}
								onChange={(value) => updateBonusItem(index, 'icon', value)}
							/>
							<TextControl
								label={__('Title', 'swrice-gutenberg-page-builder')}
								value={item.title}
								onChange={(value) => updateBonusItem(index, 'title', value)}
							/>
							<TextareaControl
								label={__('Description', 'swrice-gutenberg-page-builder')}
								value={item.description}
								onChange={(value) => updateBonusItem(index, 'description', value)}
								rows={3}
							/>
							<TextControl
								label={__('Value ($)', 'swrice-gutenberg-page-builder')}
								value={item.value}
								onChange={(value) => updateBonusItem(index, 'value', value)}
								type="number"
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!bonusesHeading && !bonusItems.length) return null;

	return (
		<section className="sppm-section sppm-bonuses-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{bonusesIcon && <span className="sppm-section-icon">{bonusesIcon}</span>}
					{bonusesHeading}
				</h2>
			</div>
			
			<div className="sppm-bonuses-grid">
				{bonusItems.map((item, index) => (
					<div key={index} className="sppm-bonus-card">
						<div className="sppm-bonus-header">
							{item.icon && <div className="sppm-bonus-icon">{item.icon}</div>}
							<h3 className="sppm-bonus-title">{item.title}</h3>
<<<<<<< HEAD
							{item.value && <div className="sppm-bonus-value">${item.value} Value</div>}
=======
							<div className="sppm-bonus-value">${item.value} Value</div>
>>>>>>> ab840280dcf794a970ee055d22939490f494fb0d
						</div>
						<p className="sppm-bonus-desc">{item.description}</p>
					</div>
				))}
			</div>
		</section>
	);
}
