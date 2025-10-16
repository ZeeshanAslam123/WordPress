/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { 
	Button, 
	ToggleControl,
	Flex,
	FlexItem,
	Card,
	CardBody
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { dragHandle } from '@wordpress/icons';

/**
 * Section Manager Component
 * Handles section ordering and enabling/disabling
 */
export default function SectionManager({ sectionOrder, sectionEnabled, onOrderChange, onEnabledChange }) {
	const [draggedIndex, setDraggedIndex] = useState(null);

	// Section labels for display
	const sectionLabels = {
		problem: __('Problem Section', 'swrice-gutenberg-page-builder'),
		solution: __('Solution Section', 'swrice-gutenberg-page-builder'),
		how_it_works: __('How It Works', 'swrice-gutenberg-page-builder'),
		features: __('Features', 'swrice-gutenberg-page-builder'),
		testimonials: __('Testimonials', 'swrice-gutenberg-page-builder'),
		faq: __('FAQ', 'swrice-gutenberg-page-builder'),
		bonuses: __('Bonuses', 'swrice-gutenberg-page-builder'),
		guarantee: __('Guarantee', 'swrice-gutenberg-page-builder'),
		why_choose: __('Why Choose Us', 'swrice-gutenberg-page-builder'),
		about: __('About', 'swrice-gutenberg-page-builder'),
		final_cta: __('Final CTA', 'swrice-gutenberg-page-builder')
	};

	// Handle drag start
	const handleDragStart = (e, index) => {
		setDraggedIndex(index);
		e.dataTransfer.effectAllowed = 'move';
	};

	// Handle drag over
	const handleDragOver = (e) => {
		e.preventDefault();
		e.dataTransfer.dropEffect = 'move';
	};

	// Handle drop
	const handleDrop = (e, dropIndex) => {
		e.preventDefault();
		
		if (draggedIndex === null || draggedIndex === dropIndex) {
			setDraggedIndex(null);
			return;
		}

		const newOrder = [...sectionOrder];
		const draggedItem = newOrder[draggedIndex];
		
		// Remove dragged item
		newOrder.splice(draggedIndex, 1);
		
		// Insert at new position
		newOrder.splice(dropIndex, 0, draggedItem);
		
		onOrderChange(newOrder);
		setDraggedIndex(null);
	};

	// Handle section toggle
	const handleToggle = (sectionKey, enabled) => {
		const newEnabled = { ...sectionEnabled };
		newEnabled[sectionKey] = enabled;
		onEnabledChange(newEnabled);
	};

	return (
		<div className="sgpb-section-manager">
			<p className="description">
				{__('Drag and drop sections to reorder them. Use the toggle switches to enable/disable sections.', 'swrice-gutenberg-page-builder')}
			</p>
			
			<div className="sgpb-section-list">
				{sectionOrder.map((sectionKey, index) => (
					<Card 
						key={sectionKey}
						className={`sgpb-section-item ${!sectionEnabled[sectionKey] ? 'disabled' : ''}`}
						draggable
						onDragStart={(e) => handleDragStart(e, index)}
						onDragOver={handleDragOver}
						onDrop={(e) => handleDrop(e, index)}
					>
						<CardBody>
							<Flex align="center" gap={3}>
								<FlexItem>
									<Button
										icon={dragHandle}
										variant="tertiary"
										size="small"
										style={{ cursor: 'grab' }}
										aria-label={__('Drag to reorder', 'swrice-gutenberg-page-builder')}
									/>
								</FlexItem>
								
								<FlexItem isBlock>
									<strong>{sectionLabels[sectionKey] || sectionKey}</strong>
								</FlexItem>
								
								<FlexItem>
									<ToggleControl
										checked={sectionEnabled[sectionKey] || false}
										onChange={(enabled) => handleToggle(sectionKey, enabled)}
										aria-label={__('Enable/disable section', 'swrice-gutenberg-page-builder')}
									/>
								</FlexItem>
							</Flex>
						</CardBody>
					</Card>
				))}
			</div>
		</div>
	);
}
