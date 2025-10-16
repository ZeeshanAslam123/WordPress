/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 */
export default function save({ attributes }) {
	const {
		pluginName,
		heroSubtitle,
		pluginPrice,
		pluginOriginalPrice,
		buyNowShortcode,
		demoLink,
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

	const blockProps = useBlockProps.save({
		className: 'sppm-plugin-page'
	});

	// Helper function to render stars
	const renderStars = (rating) => {
		return '★'.repeat(rating) + '☆'.repeat(5 - rating);
	};

	// Helper function to render hero section
	const renderHeroSection = () => (
		<section className="sppm-hero">
			<div className="sppm-hero-left">
				<div className="sppm-logo-row">
					<div className="sppm-logo-mark">
						<svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="2" y="2" width="20" height="4" rx="2" fill="#5fa0d8"/>
							<rect x="2" y="10" width="16" height="4" rx="2" fill="#82bfe4"/>
							<rect x="2" y="18" width="12" height="4" rx="2" fill="#bcdff6"/>
						</svg>
					</div>
					<div className="sppm-logo-text">
						{pluginName}
					</div>
				</div>

				<div className="sppm-rating">
					<div className="sppm-rating-stars">{renderStars(rating)}</div>
					<div>{ratingCount}</div>
				</div>

				<h1 className="sppm-hero-title">{pluginName}</h1>
				<p className="sppm-hero-subtitle">{heroSubtitle}</p>

				<div className="sppm-hero-ctas">
					{buyNowShortcode ? (
						<div dangerouslySetInnerHTML={{ __html: buyNowShortcode }} />
					) : (
						<button className="sppm-btn sppm-btn-primary">
							Buy Now - ${pluginPrice}
						</button>
					)}
					{demoLink && demoLink !== '#' && (
						<a href={demoLink} className="sppm-btn sppm-btn-ghost" target="_blank" rel="noopener noreferrer">
							Live Demo
						</a>
					)}
				</div>
			</div>

			<div className="sppm-hero-right">
				{heroImageUrl ? (
					<img src={heroImageUrl} alt={heroImageAlt || pluginName} className="sppm-hero-image" />
				) : (
					<div className="sppm-device">
						<div className="sppm-device-inner">
							<h3>Plugin Preview</h3>
							<div className="sppm-section-row">Getting Started <span>▾</span></div>
							<div className="sppm-section-row">Configuration <span>▾</span></div>
							<div className="sppm-section-row">Advanced Features <span>▾</span></div>
						</div>
					</div>
				)}
			</div>
		</section>
	);

	// Helper function to render problem section
	const renderProblemSection = () => {
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
	};

	// Helper function to render solution section
	const renderSolutionSection = () => {
		if (!solutionHeading && !solutionDescription) return null;
		
		return (
			<section className="sppm-section sppm-solution-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{solutionIcon && <span className="sppm-section-icon">{solutionIcon}</span>}
						{solutionHeading}
					</h2>
				</div>
				
				<div className="sppm-solution-content">
					<p>{solutionDescription}</p>
				</div>
			</section>
		);
	};

	// Helper function to render how it works section
	const renderHowItWorksSection = () => {
		if (!stepsItems || stepsItems.length === 0) return null;
		
		return (
			<section className="sppm-section sppm-how-it-works-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{howItWorksIcon && <span className="sppm-section-icon">{howItWorksIcon}</span>}
						{howItWorksHeading}
					</h2>
				</div>
				
				<div className="sppm-steps-grid">
					{stepsItems.map((step, index) => (
						<div key={index} className="sppm-step-card">
							<div className="sppm-step-number">{index + 1}</div>
							<h3 className="sppm-step-title">{step.title}</h3>
							<p className="sppm-step-desc">{step.description}</p>
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render features section
	const renderFeaturesSection = () => {
		if (!featureItems || featureItems.length === 0) return null;
		
		return (
			<section className="sppm-section sppm-features-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{featuresIcon && <span className="sppm-section-icon">{featuresIcon}</span>}
						{featuresHeading}
					</h2>
				</div>
				
				<div className="sppm-features-grid">
					{featureItems.map((feature, index) => (
						<div key={index} className="sppm-feature-card">
							<div className="sppm-feature-card-header">
								{feature.icon && <div className="sppm-feature-icon">{feature.icon}</div>}
								<h3 className="sppm-feature-title">{feature.title}</h3>
							</div>
							<p className="sppm-feature-desc">{feature.description}</p>
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render testimonials section
	const renderTestimonialsSection = () => {
		if (!testimonialItems || testimonialItems.length === 0) return null;
		
		return (
			<section className="sppm-section sppm-testimonials-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{testimonialsIcon && <span className="sppm-section-icon">{testimonialsIcon}</span>}
						{testimonialsHeading}
					</h2>
				</div>
				
				<div className="sppm-testimonials-grid">
					{testimonialItems.map((testimonial, index) => (
						<div key={index} className="sppm-testimonial-card">
							<div className="sppm-testimonial-rating">
								{renderStars(testimonial.rating || 5)}
							</div>
							<p className="sppm-testimonial-quote">"{testimonial.quote}"</p>
							<div className="sppm-testimonial-meta">
								<strong>{testimonial.author}</strong>
								{testimonial.company && <span>, {testimonial.company}</span>}
							</div>
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render FAQ section
	const renderFAQSection = () => {
		if (!faqItems || faqItems.length === 0) return null;
		
		return (
			<section className="sppm-section sppm-faq-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{faqIcon && <span className="sppm-section-icon">{faqIcon}</span>}
						{faqHeading}
					</h2>
				</div>
				
				<div className="sppm-faq-list">
					{faqItems.map((faq, index) => (
						<div key={index} className="sppm-faq-item">
							<div className="sppm-faq-question">
								<strong>{faq.question}</strong>
								<span>+</span>
							</div>
							<div className="sppm-faq-answer">
								{faq.answer}
							</div>
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render bonuses section
	const renderBonusesSection = () => {
		if (!bonusItems || bonusItems.length === 0) return null;
		
		return (
			<section className="sppm-section sppm-bonuses-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{bonusesIcon && <span className="sppm-section-icon">{bonusesIcon}</span>}
						{bonusesHeading}
					</h2>
				</div>
				
				<div className="sppm-bonuses-grid">
					{bonusItems.map((bonus, index) => (
						<div key={index} className="sppm-bonus-item">
							{bonus.icon && <div className="sppm-bonus-icon">{bonus.icon}</div>}
							<h3 className="sppm-bonus-title">{bonus.title}</h3>
							<p className="sppm-bonus-description">{bonus.description}</p>
							{bonus.value && <div className="sppm-bonus-value">Value: ${bonus.value}</div>}
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render guarantee section
	const renderGuaranteeSection = () => {
		if (!guaranteeText) return null;
		
		return (
			<section className="sppm-section sppm-guarantee-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{guaranteeIcon && <span className="sppm-section-icon">{guaranteeIcon}</span>}
						{guaranteeHeading}
					</h2>
				</div>
				
				<div className="sppm-guarantee-content">
					<p className="sppm-guarantee-text">{guaranteeText}</p>
				</div>
			</section>
		);
	};

	// Helper function to render why choose section
	const renderWhyChooseSection = () => {
		if (!whyChooseItems || whyChooseItems.length === 0) return null;
		
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
						<div key={index} className="sppm-why-choose-item">
							{item.icon && <div className="sppm-why-choose-icon">{item.icon}</div>}
							<h3 className="sppm-why-choose-title">{item.title}</h3>
							<p className="sppm-why-choose-description">{item.description}</p>
						</div>
					))}
				</div>
			</section>
		);
	};

	// Helper function to render about section
	const renderAboutSection = () => {
		if (!aboutDescription) return null;
		
		return (
			<section className="sppm-section sppm-about-section">
				<div className="sppm-section-header">
					<h2 className="sppm-section-title">
						{aboutIcon && <span className="sppm-section-icon">{aboutIcon}</span>}
						{aboutHeading}
					</h2>
				</div>
				
				<div className="sppm-about-content">
					<p className="sppm-about-description">{aboutDescription}</p>
				</div>
			</section>
		);
	};

	// Helper function to render final CTA section
	const renderFinalCTASection = () => {
		if (!ctaTitle && !ctaSubtitle) return null;
		
		return (
			<section className="sppm-section sppm-final-cta">
				<div className="sppm-cta">
					<div className="sppm-cta-content">
						{ctaTitle && <h3 className="sppm-cta-title">{ctaTitle}</h3>}
						{ctaSubtitle && <p className="sppm-cta-subtitle">{ctaSubtitle}</p>}
					</div>
					
					<div className="sppm-cta-buttons">
						{buyNowShortcode ? (
							<div dangerouslySetInnerHTML={{ __html: buyNowShortcode }} />
						) : (
							<button className="sppm-btn sppm-btn-primary">
								Buy Now - ${pluginPrice}
							</button>
						)}
						{demoLink && demoLink !== '#' && (
							<a href={demoLink} className="sppm-btn sppm-btn-ghost" target="_blank" rel="noopener noreferrer">
								Live Demo
							</a>
						)}
					</div>
				</div>
			</section>
		);
	};

	// Section rendering mapping
	const sectionRenderers = {
		problem: renderProblemSection,
		solution: renderSolutionSection,
		how_it_works: renderHowItWorksSection,
		features: renderFeaturesSection,
		testimonials: renderTestimonialsSection,
		faq: renderFAQSection,
		bonuses: renderBonusesSection,
		guarantee: renderGuaranteeSection,
		why_choose: renderWhyChooseSection,
		about: renderAboutSection,
		final_cta: renderFinalCTASection
	};

	return (
		<div {...blockProps}>
			<div className="sppm-container">
				{/* Hero Section */}
				{renderHeroSection()}

				{/* Dynamic Sections */}
				{sectionOrder.map((sectionKey) => {
					if (!sectionEnabled[sectionKey]) return null;
					
					const renderFunction = sectionRenderers[sectionKey];
					if (!renderFunction) return null;

					return renderFunction();
				})}
			</div>
		</div>
	);
}
