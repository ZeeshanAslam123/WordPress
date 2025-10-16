/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Hero Section Component
 * Renders the hero section for both editor and frontend
 */
export default function HeroSection({
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
	isEditor = false
}) {
	// Helper function to render stars
	const renderStars = (rating) => {
		return '★'.repeat(rating) + '☆'.repeat(5 - rating);
	};

	return (
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
						isEditor ? (
							<div className="sgpb-shortcode-preview">
								<code>{buyNowShortcode}</code>
							</div>
						) : (
							<div dangerouslySetInnerHTML={{ __html: buyNowShortcode }} />
						)
					) : (
						<button className="sppm-btn sppm-btn-primary">
							Buy Now - ${pluginPrice}
							{pluginOriginalPrice && pluginOriginalPrice !== pluginPrice && (
								<span className="sppm-original-price"> (was ${pluginOriginalPrice})</span>
							)}
						</button>
					)}
					{demoLink && demoLink !== '#' && (
						<a 
							href={demoLink} 
							className="sppm-btn sppm-btn-ghost" 
							target="_blank" 
							rel="noopener noreferrer"
							onClick={isEditor ? (e) => e.preventDefault() : undefined}
						>
							Live Demo
						</a>
					)}
				</div>
			</div>

			<div className="sppm-hero-right">
				{heroImageUrl ? (
					<img 
						src={heroImageUrl} 
						alt={heroImageAlt || pluginName} 
						className="sppm-hero-image" 
					/>
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
}
