/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { 
	PanelBody, 
	TextControl, 
	TextareaControl,
	SelectControl,
	Button,
	RangeControl
} from '@wordpress/components';
import { plus, trash } from '@wordpress/icons';

/**
 * Icon options for Testimonials Section - matching original plugin exactly
 */
const TESTIMONIALS_ICON_OPTIONS = [
	{ label: 'No Icon', value: '' },
	{ label: '💬 Speech Bubble', value: '💬' },
	{ label: '⭐ Star', value: '⭐' },
	{ label: '👥 People', value: '👥' },
	{ label: '🗣️ Speaking', value: '🗣️' },
	{ label: '💯 Hundred', value: '💯' }
];

/**
 * TestimonialsSection Component
 */
export default function TestimonialsSection({ attributes, setAttributes, isInspector = false, isEditor = false }) {
	const { testimonialsHeading, testimonialsIcon, testimonialItems } = attributes;

	// Handle adding new testimonial item
	const addTestimonialItem = () => {
		const newItems = [...testimonialItems, {
			name: 'Customer Name',
			role: 'Position',
			company: 'Company Name',
			content: 'This is an amazing testimonial about the product.',
			rating: 5,
			avatar: ''
		}];
		setAttributes({ testimonialItems: newItems });
	};

	// Handle removing testimonial item
	const removeTestimonialItem = (index) => {
		const newItems = testimonialItems.filter((_, i) => i !== index);
		setAttributes({ testimonialItems: newItems });
	};

	// Handle updating testimonial item
	const updateTestimonialItem = (index, field, value) => {
		const newItems = [...testimonialItems];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ testimonialItems: newItems });
	};

	// Inspector controls
	if (isInspector) {
		return (
			<PanelBody title={__('Testimonials Section', 'swrice-gutenberg-page-builder')} initialOpen={false}>
				<TextControl
					label={__('Section Heading', 'swrice-gutenberg-page-builder')}
					value={testimonialsHeading}
					onChange={(value) => setAttributes({ testimonialsHeading: value })}
				/>
				<SelectControl
					label={__('Section Icon', 'swrice-gutenberg-page-builder')}
					value={testimonialsIcon}
					options={TESTIMONIALS_ICON_OPTIONS}
					onChange={(value) => setAttributes({ testimonialsIcon: value })}
					help={__('Choose an icon for this section', 'swrice-gutenberg-page-builder')}
				/>
				
				<div className="sgpb-repeater-field">
					<div className="sgpb-repeater-header">
						<strong>{__('Testimonials', 'swrice-gutenberg-page-builder')}</strong>
						<Button
							icon={plus}
							variant="secondary"
							size="small"
							onClick={addTestimonialItem}
						>
							{__('Add Testimonial', 'swrice-gutenberg-page-builder')}
						</Button>
					</div>
					
					{testimonialItems.map((item, index) => (
						<div key={index} className="sgpb-repeater-item">
							<div className="sgpb-repeater-item-header">
								<strong>{__('Testimonial', 'swrice-gutenberg-page-builder')} {index + 1}</strong>
								<Button
									icon={trash}
									variant="tertiary"
									size="small"
									isDestructive
									onClick={() => removeTestimonialItem(index)}
								/>
							</div>
							<TextControl
								label={__('Name', 'swrice-gutenberg-page-builder')}
								value={item.name}
								onChange={(value) => updateTestimonialItem(index, 'name', value)}
							/>
							<TextControl
								label={__('Role/Position', 'swrice-gutenberg-page-builder')}
								value={item.role}
								onChange={(value) => updateTestimonialItem(index, 'role', value)}
							/>
							<TextControl
								label={__('Company', 'swrice-gutenberg-page-builder')}
								value={item.company}
								onChange={(value) => updateTestimonialItem(index, 'company', value)}
							/>
							<TextareaControl
								label={__('Testimonial Content', 'swrice-gutenberg-page-builder')}
								value={item.content}
								onChange={(value) => updateTestimonialItem(index, 'content', value)}
								rows={4}
							/>
							<RangeControl
								label={__('Rating', 'swrice-gutenberg-page-builder')}
								value={item.rating}
								onChange={(value) => updateTestimonialItem(index, 'rating', value)}
								min={1}
								max={5}
								step={1}
							/>
						</div>
					))}
				</div>
			</PanelBody>
		);
	}

	// Section render
	if (!testimonialsHeading && !testimonialItems.length) return null;

	return (
		<section className="sppm-section sppm-testimonials-section">
			<div className="sppm-section-header">
				<h2 className="sppm-section-title">
					{testimonialsIcon && <span className="sppm-section-icon">{testimonialsIcon}</span>}
					{testimonialsHeading}
				</h2>
			</div>
			
			<div className="sppm-testimonials-grid">
				{testimonialItems.map((item, index) => (
					<div key={index} className="sppm-testimonial-card">
						<div className="sppm-testimonial-content">
							<p>"{item.content}"</p>
						</div>
						<div className="sppm-testimonial-author">
							<div className="sppm-testimonial-info">
								<h4 className="sppm-testimonial-name">{item.name}</h4>
								<p className="sppm-testimonial-role">{item.role} at {item.company}</p>
							</div>
							<div className="sppm-testimonial-rating">
								{[...Array(item.rating)].map((_, i) => (
									<span key={i} className="sppm-star">⭐</span>
								))}
							</div>
						</div>
					</div>
				))}
			</div>
		</section>
	);
}
