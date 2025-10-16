/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { 
	PanelBody, 
	TextControl, 
	TextareaControl,
	ToggleControl,
	Button,
	RangeControl,
	SelectControl
} from '@wordpress/components';
import { 
	InspectorControls, 
	MediaUpload, 
	MediaUploadCheck,
	RichText,
	useBlockProps 
} from '@wordpress/block-editor';
import { useState } from '@wordpress/element';

/**
 * Internal dependencies
 */
import HeroSection from '../../components/sections/HeroSection';
import SectionManager from '../../components/SectionManager';
import ProblemSection from '../../components/sections/ProblemSection';
import SolutionSection from '../../components/sections/SolutionSection';
import HowItWorksSection from '../../components/sections/HowItWorksSection';
import FeaturesSection from '../../components/sections/FeaturesSection';
import TestimonialsSection from '../../components/sections/TestimonialsSection';
import FAQSection from '../../components/sections/FAQSection';
import BonusesSection from '../../components/sections/BonusesSection';
import GuaranteeSection from '../../components/sections/GuaranteeSection';
import WhyChooseSection from '../../components/sections/WhyChooseSection';
import AboutSection from '../../components/sections/AboutSection';
import FinalCTASection from '../../components/sections/FinalCTASection';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 */
export default function Edit({ attributes, setAttributes }) {
	const {
		pluginName,
		heroSubtitle,
		pluginPrice,
		pluginOriginalPrice,
		buyNowShortcode,
		demoLink,
		heroImageId,
		heroImageUrl,
		heroImageAlt,
		rating,
		ratingCount,
		sectionOrder,
		sectionEnabled,
		// Section data
		problemHeading,
		problemIcon,
		problemItems,
		solutionHeading,
		solutionIcon,
		solutionDescription,
		howItWorksHeading,
		howItWorksIcon,
		stepsItems,
		featuresHeading,
		featuresIcon,
		featureItems,
		testimonialsHeading,
		testimonialsIcon,
		testimonialItems,
		faqHeading,
		faqIcon,
		faqItems,
		bonusesHeading,
		bonusesIcon,
		bonusItems,
		guaranteeHeading,
		guaranteeIcon,
		guaranteeText,
		whyChooseHeading,
		whyChooseIcon,
		whyChooseItems,
		aboutHeading,
		aboutIcon,
		aboutDescription,
		ctaTitle,
		ctaSubtitle
	} = attributes;

	const [activeTab, setActiveTab] = useState('hero');

	const blockProps = useBlockProps({
		className: 'sgpb-plugin-page-editor'
	});

	// Helper function to render stars
	const renderStars = (rating) => {
		return '★'.repeat(rating) + '☆'.repeat(5 - rating);
	};

	// Section components mapping
	const sectionComponents = {
		problem: ProblemSection,
		solution: SolutionSection,
		how_it_works: HowItWorksSection,
		features: FeaturesSection,
		testimonials: TestimonialsSection,
		faq: FAQSection,
		bonuses: BonusesSection,
		guarantee: GuaranteeSection,
		why_choose: WhyChooseSection,
		about: AboutSection,
		final_cta: FinalCTASection
	};

	return (
		<div {...blockProps}>
			<InspectorControls>
				{/* Hero Settings */}
				<PanelBody title={__('Hero Section', 'swrice-gutenberg-page-builder')} initialOpen={true}>
					<TextControl
						label={__('Plugin Name', 'swrice-gutenberg-page-builder')}
						value={pluginName}
						onChange={(value) => setAttributes({ pluginName: value })}
					/>
					<TextareaControl
						label={__('Hero Subtitle', 'swrice-gutenberg-page-builder')}
						value={heroSubtitle}
						onChange={(value) => setAttributes({ heroSubtitle: value })}
						rows={3}
					/>
					<TextControl
						label={__('Plugin Price', 'swrice-gutenberg-page-builder')}
						value={pluginPrice}
						onChange={(value) => setAttributes({ pluginPrice: value })}
						type="number"
					/>
					<TextControl
						label={__('Original Price (Optional)', 'swrice-gutenberg-page-builder')}
						value={pluginOriginalPrice}
						onChange={(value) => setAttributes({ pluginOriginalPrice: value })}
						type="number"
					/>
					<TextareaControl
						label={__('Buy Now Shortcode', 'swrice-gutenberg-page-builder')}
						value={buyNowShortcode}
						onChange={(value) => setAttributes({ buyNowShortcode: value })}
						help={__('Paste your payment processor shortcode here', 'swrice-gutenberg-page-builder')}
					/>
					<TextControl
						label={__('Demo Link', 'swrice-gutenberg-page-builder')}
						value={demoLink}
						onChange={(value) => setAttributes({ demoLink: value })}
						type="url"
					/>
					<RangeControl
						label={__('Rating', 'swrice-gutenberg-page-builder')}
						value={rating}
						onChange={(value) => setAttributes({ rating: value })}
						min={1}
						max={5}
					/>
					<TextControl
						label={__('Rating Display', 'swrice-gutenberg-page-builder')}
						value={ratingCount}
						onChange={(value) => setAttributes({ ratingCount: value })}
					/>
					
					{/* Hero Image */}
					<MediaUploadCheck>
						<MediaUpload
							onSelect={(media) => {
								setAttributes({
									heroImageId: media.id,
									heroImageUrl: media.url,
									heroImageAlt: media.alt
								});
							}}
							allowedTypes={['image']}
							value={heroImageId}
							render={({ open }) => (
								<div>
									<Button 
										onClick={open}
										variant="secondary"
										style={{ marginBottom: '10px' }}
									>
										{heroImageUrl ? __('Change Hero Image', 'swrice-gutenberg-page-builder') : __('Select Hero Image', 'swrice-gutenberg-page-builder')}
									</Button>
									{heroImageUrl && (
										<div>
											<img src={heroImageUrl} alt={heroImageAlt} style={{ maxWidth: '100%', height: 'auto' }} />
											<Button 
												onClick={() => setAttributes({ heroImageId: 0, heroImageUrl: '', heroImageAlt: '' })}
												variant="link"
												isDestructive
											>
												{__('Remove Image', 'swrice-gutenberg-page-builder')}
											</Button>
										</div>
									)}
								</div>
							)}
						/>
					</MediaUploadCheck>
				</PanelBody>

				{/* Section Management */}
				<PanelBody title={__('Section Management', 'swrice-gutenberg-page-builder')} initialOpen={false}>
					<SectionManager
						sectionOrder={sectionOrder}
						sectionEnabled={sectionEnabled}
						onOrderChange={(newOrder) => setAttributes({ sectionOrder: newOrder })}
						onEnabledChange={(newEnabled) => setAttributes({ sectionEnabled: newEnabled })}
					/>
				</PanelBody>

				{/* Individual Section Settings */}
				{sectionOrder.map((sectionKey) => {
					if (!sectionEnabled[sectionKey]) return null;
					
					const SectionComponent = sectionComponents[sectionKey];
					if (!SectionComponent) return null;

					return (
						<SectionComponent
							key={sectionKey}
							attributes={attributes}
							setAttributes={setAttributes}
							isInspector={true}
						/>
					);
				})}
			</InspectorControls>

			{/* Block Content */}
			<div className="sppm-plugin-page">
				<div className="sppm-container">
					{/* Hero Section */}
					<HeroSection
						pluginName={pluginName}
						heroSubtitle={heroSubtitle}
						pluginPrice={pluginPrice}
						pluginOriginalPrice={pluginOriginalPrice}
						buyNowShortcode={buyNowShortcode}
						demoLink={demoLink}
						heroImageUrl={heroImageUrl}
						heroImageAlt={heroImageAlt}
						rating={rating}
						ratingCount={ratingCount}
						isEditor={true}
					/>

					{/* Dynamic Sections */}
					{sectionOrder.map((sectionKey) => {
						if (!sectionEnabled[sectionKey]) return null;
						
						const SectionComponent = sectionComponents[sectionKey];
						if (!SectionComponent) return null;

						return (
							<SectionComponent
								key={sectionKey}
								attributes={attributes}
								setAttributes={setAttributes}
								isEditor={true}
							/>
						);
					})}
				</div>
			</div>
		</div>
	);
}
