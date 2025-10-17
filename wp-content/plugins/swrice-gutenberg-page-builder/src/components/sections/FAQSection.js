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
 * Icon options for FAQ Section - matching original plugin exactly
 */
const FAQ_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '❓ Question Mark', value: '❓' },
	{ label: '❔ White Question Mark', value: '❔' },
	{ label: '🤔 Thinking Face', value: '🤔' },
	{ label: '💭 Thought Bubble', value: '💭' },
	{ label: '📋 Clipboard', value: '📋' }
];

/**
 * FAQSection Component
 */
export default function FAQSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { faqHeading, faqIcon, faqItems } = attributes;

	// Handle adding new FAQ item
	const addFaqItem = () => {
		const newItems = [...faqItems, {
			question: 'New Question?',
			answer: 'Answer to the question goes here.'
		}];
		setAttributes({ faqItems: newItems });
	};

	// Handle removing FAQ item
	const removeFaqItem = (index) => {
		const newItems = faqItems.filter((_, i) => i !== index);
		setAttributes({ faqItems: newItems });
	};

	// Handle updating FAQ item
	const updateFaqItem = (index, field, value) => {
		const newItems = [...faqItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ faqItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('FAQ Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={faqHeading}
					onChange={(value) => setAttributes({ faqHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={faqIcon}
					options={FAQ_ICON_OPTIONS}
					onChange={(value) => setAttributes({ faqIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('FAQ Items', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addFaqItem}
						>
							{__('Add FAQ', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>
					
					{faqItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('FAQ', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeFaqItem(index)}
								/>
							</div>
							<TextControl
								label={__('Question', 'swrice-gutenberg-page-builder')}
								value={item.question}
								onChange={(value) => updateFaqItem(index, 'question', value)}
							/>
							<TextareaControl
								label={__('Answer', 'swrice-gutenberg-page-builder')}
								value={item.answer}
								onChange={(value) => updateFaqItem(index, 'answer', value)}
								rows={4}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!faqHeading && !faqItems.length) return null;

	return (
		<section className="sppm-section sppm-faq-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{faqIcon && <span className="sppm-section-icon">{faqIcon}</span>}
					{faqHeading}
				</h2>
			</div>
			
			<div className="sppm-faq-container">
				{faqItems.map((item, index) => (
					<div key={index} className="sppm-faq-item">
						<h3 className="sppm-faq-question">{item.question}</h3>
						<div className="sppm-faq-answer">
							<p>{item.answer}</p>
						</div>
					</div>
				))}
			</div>
		</section>
	);
}
