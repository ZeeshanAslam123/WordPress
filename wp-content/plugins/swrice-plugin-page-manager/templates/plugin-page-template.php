<?php
/**
 * Fully Dynamic Plugin Page Template - Fixed to Match Backend
 * 
 * This template uses the ACTUAL meta keys from the backend admin interface
 * All 10 sections are displayed dynamically from WordPress meta fields
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get all dynamic data from WordPress meta fields using ACTUAL backend keys
$plugin_name = $post->post_title;
$hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true);
$plugin_price = get_post_meta($post->ID, 'plugin_price', true);
$plugin_original_price = get_post_meta($post->ID, 'plugin_original_price', true);
$buy_now_shortcode = get_post_meta($post->ID, 'buy_now_shortcode', true);

// Hero image - from featured image
$hero_image = get_the_post_thumbnail_url($post->ID, 'large');

// Section 1: Problem Section
$problem_heading = get_post_meta($post->ID, 'problem_heading', true);
$problem_icon = get_post_meta($post->ID, 'problem_icon', true);
$problem_items = get_post_meta($post->ID, 'problem_items', true);

// Section 2: Solution Section
$solution_heading = get_post_meta($post->ID, 'solution_heading', true);
$solution_icon = get_post_meta($post->ID, 'solution_icon', true);
$solution_description = get_post_meta($post->ID, 'solution_description', true);

// Section 3: How It Works Section
$how_it_works_heading = get_post_meta($post->ID, 'how_it_works_heading', true);
$how_it_works_icon = get_post_meta($post->ID, 'how_it_works_icon', true);
$steps_items = get_post_meta($post->ID, 'steps_items', true);

// Section 4: Features Section
$features_heading = get_post_meta($post->ID, 'features_heading', true);
$features_icon = get_post_meta($post->ID, 'features_icon', true);
$feature_items = get_post_meta($post->ID, 'feature_items', true);

// Section 5: Testimonials Section
$testimonials_heading = get_post_meta($post->ID, 'testimonials_heading', true);
$testimonials_icon = get_post_meta($post->ID, 'testimonials_icon', true);
$testimonial_items = get_post_meta($post->ID, 'testimonial_items', true);

// Section 6: FAQ Section
$faq_heading = get_post_meta($post->ID, 'faq_heading', true);
$faq_icon = get_post_meta($post->ID, 'faq_icon', true);
$faq_items = get_post_meta($post->ID, 'faq_items', true);

// Section 7: Bonuses Section
$bonuses_heading = get_post_meta($post->ID, 'bonuses_heading', true);
$bonuses_icon = get_post_meta($post->ID, 'bonuses_icon', true);
$bonus_items = get_post_meta($post->ID, 'bonus_items', true);

// Section 8: Guarantee Section
$guarantee_heading = get_post_meta($post->ID, 'guarantee_heading', true);
$guarantee_icon = get_post_meta($post->ID, 'guarantee_icon', true);
$guarantee_text = get_post_meta($post->ID, 'guarantee_text', true);
$guarantee_points = get_post_meta($post->ID, 'guarantee_points', true);

// Section 9: Why Choose Section
$why_choose_heading = get_post_meta($post->ID, 'why_choose_heading', true);
$why_choose_icon = get_post_meta($post->ID, 'why_choose_icon', true);
$why_choose_items = get_post_meta($post->ID, 'why_choose_items', true);

// Section 10: About Section
$about_heading = get_post_meta($post->ID, 'about_heading', true);
$about_icon = get_post_meta($post->ID, 'about_icon', true);
$about_description = get_post_meta($post->ID, 'about_description', true);

// Final CTA Section
$cta_title = get_post_meta($post->ID, 'cta_title', true);
$cta_subtitle = get_post_meta($post->ID, 'cta_subtitle', true);
$demo_link = get_post_meta($post->ID, 'demo_link', true);

// Function to render stars for ratings
function render_stars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= $i <= $rating ? '⭐' : '☆';
    }
    return $stars;
}
?>

<div class="sppm-plugin-page">
    <div class="sppm-container">
        
        <!-- HERO SECTION - FULLY DYNAMIC -->
        <section class="sppm-hero">
            <div class="sppm-hero-left">
                <div class="sppm-logo-row">
                    <div class="sppm-logo-mark">
                        <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="20" height="4" rx="2" fill="#5fa0d8"/>
                            <rect x="2" y="10" width="16" height="4" rx="2" fill="#82bfe4"/>
                            <rect x="2" y="18" width="12" height="4" rx="2" fill="#bcdff6"/>
                        </svg>
                    </div>
                    <div class="sppm-logo-text">
                        <?php echo esc_html($plugin_name); ?>
                    </div>
                </div>

                <div class="sppm-rating">
                    <div class="sppm-rating-stars">★ ★ ★ ★ ★</div>
                    <div>5.0</div>
                </div>

                <h1 class="sppm-hero-title"><?php echo esc_html($plugin_name); ?></h1>
                <p class="sppm-hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>

                <div class="sppm-hero-ctas">
                    <?php if ($buy_now_shortcode): ?>
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    <?php else: ?>
                        <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
                    <?php endif; ?>
                    <a href="#" class="sppm-btn sppm-btn-ghost">Live Demo</a>
                </div>
            </div>

            <div class="sppm-hero-right">
                <?php if ($hero_image): ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($plugin_name); ?>" class="sppm-hero-image" />
                <?php else: ?>
                    <div class="sppm-device">
                        <div class="sppm-device-inner">
                            <h3>Plugin Preview</h3>
                            <div class="sppm-section-row">Getting Started <span>▾</span></div>
                            <div class="sppm-section-row">Configuration <span>▾</span></div>
                            <div class="sppm-section-row">Advanced Features <span>▾</span></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- SECTION 1: PROBLEM SECTION - FULLY DYNAMIC -->
        <?php if (!empty($problem_items) && is_array($problem_items)): ?>
        <section class="sppm-section sppm-problem-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($problem_icon): ?><span class="sppm-section-icon"><?php echo $problem_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($problem_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-problem-grid">
                <?php foreach ($problem_items as $problem): ?>
                <div class="sppm-problem-card">
                    <?php if (!empty($problem['icon'])): ?>
                    <div class="sppm-problem-icon"><?php echo $problem['icon']; ?></div>
                    <?php endif; ?>
                    <h3 class="sppm-problem-title"><?php echo esc_html($problem['title']); ?></h3>
                    <p class="sppm-problem-desc"><?php echo esc_html($problem['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 2: SOLUTION SECTION - FULLY DYNAMIC -->
        <?php if (!empty($solution_heading) || !empty($solution_description)): ?>
        <section class="sppm-section sppm-solution-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($solution_icon): ?><span class="sppm-section-icon"><?php echo $solution_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($solution_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-solution-content">
                <p><?php echo esc_html($solution_description); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 3: HOW IT WORKS SECTION - FULLY DYNAMIC -->
        <?php if (!empty($steps_items) && is_array($steps_items)): ?>
        <section class="sppm-section sppm-steps-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($how_it_works_icon): ?><span class="sppm-section-icon"><?php echo $how_it_works_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($how_it_works_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-steps-grid">
                <?php foreach ($steps_items as $index => $step): ?>
                <div class="sppm-step-card">
                    <div class="sppm-step-number"><?php echo ($index + 1); ?></div>
                    <h3 class="sppm-step-title"><?php echo esc_html($step['title']); ?></h3>
                    <p class="sppm-step-desc"><?php echo esc_html($step['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 4: FEATURES SECTION - FULLY DYNAMIC -->
        <?php if (!empty($feature_items) && is_array($feature_items)): ?>
        <section class="sppm-section sppm-features-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($features_icon): ?><span class="sppm-section-icon"><?php echo $features_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($features_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-features-grid">
                <?php foreach ($feature_items as $feature): ?>
                <div class="sppm-feature-card">
                    <div class="sppm-feature-card-header">
                        <?php if (!empty($feature['icon'])): ?>
                        <div class="sppm-feature-icon"><?php echo $feature['icon']; ?></div>
                        <?php endif; ?>
                        <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                    </div>
                    <div class="sppm-feature-card-body">
                        <p class="sppm-feature-desc"><?php echo esc_html($feature['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 5: TESTIMONIALS SECTION - FULLY DYNAMIC -->
        <?php if (!empty($testimonial_items) && is_array($testimonial_items)): ?>
        <section class="sppm-section sppm-testimonials-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($testimonials_icon): ?><span class="sppm-section-icon"><?php echo $testimonials_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($testimonials_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-testimonials-grid">
                <?php foreach ($testimonial_items as $testimonial): ?>
                <div class="sppm-testimonial-card">
                    <div class="sppm-testimonial-rating">
                        <?php echo render_stars(intval($testimonial['rating'])); ?>
                    </div>
                    <div class="sppm-testimonial-content">"<?php echo esc_html($testimonial['content']); ?>"</div>
                    <div class="sppm-testimonial-author">
                        <strong><?php echo esc_html($testimonial['name']); ?></strong>
                        <span><?php echo esc_html($testimonial['title']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 6: FAQ SECTION - FULLY DYNAMIC -->
        <?php if (!empty($faq_items) && is_array($faq_items)): ?>
        <section class="sppm-section sppm-faq-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($faq_icon): ?><span class="sppm-section-icon"><?php echo $faq_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($faq_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-faq-list">
                <?php foreach ($faq_items as $index => $faq): ?>
                <div class="sppm-faq-item" data-faq="<?php echo $index; ?>">
                    <div class="sppm-faq-question">
                        <?php echo esc_html($faq['question']); ?>
                        <span>+</span>
                    </div>
                    <div class="sppm-faq-answer"><?php echo esc_html($faq['answer']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 7: BONUSES SECTION - FULLY DYNAMIC -->
        <?php if (!empty($bonus_items) && is_array($bonus_items)): ?>
        <section class="sppm-section sppm-bonuses-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($bonuses_icon): ?><span class="sppm-section-icon"><?php echo $bonuses_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($bonuses_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-bonuses-grid">
                <?php foreach ($bonus_items as $bonus): ?>
                <div class="sppm-bonus-card">
                    <?php if (!empty($bonus['icon'])): ?>
                    <div class="sppm-bonus-icon"><?php echo $bonus['icon']; ?></div>
                    <?php endif; ?>
                    <h3 class="sppm-bonus-title"><?php echo esc_html($bonus['title']); ?></h3>
                    <?php if (!empty($bonus['value'])): ?>
                    <div class="sppm-bonus-value">Value: <?php echo esc_html($bonus['value']); ?></div>
                    <?php endif; ?>
                    <p class="sppm-bonus-desc"><?php echo esc_html($bonus['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 8: GUARANTEE SECTION - FULLY DYNAMIC -->
        <?php if (!empty($guarantee_heading) || !empty($guarantee_text)): ?>
        <section class="sppm-section sppm-guarantee-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($guarantee_icon): ?><span class="sppm-section-icon"><?php echo $guarantee_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($guarantee_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-guarantee-content">
                <p class="sppm-guarantee-text"><?php echo esc_html($guarantee_text); ?></p>
                
                <?php if (!empty($guarantee_points)): ?>
                <div class="sppm-guarantee-points">
                    <?php foreach ($guarantee_points as $point): ?>
                    <div class="sppm-guarantee-point">
                        <span class="sppm-guarantee-check">✅</span>
                        <?php echo esc_html($point['point']); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 9: WHY CHOOSE SECTION - FULLY DYNAMIC -->
        <?php if (!empty($why_choose_items) && is_array($why_choose_items)): ?>
        <section class="sppm-section sppm-why-choose-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($why_choose_icon): ?><span class="sppm-section-icon"><?php echo $why_choose_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($why_choose_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-why-choose-grid">
                <?php foreach ($why_choose_items as $benefit): ?>
                <div class="sppm-benefit-card">
                    <?php if (!empty($benefit['icon'])): ?>
                    <div class="sppm-benefit-icon"><?php echo $benefit['icon']; ?></div>
                    <?php endif; ?>
                    <h3 class="sppm-benefit-title"><?php echo esc_html($benefit['title']); ?></h3>
                    <p class="sppm-benefit-desc"><?php echo esc_html($benefit['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 10: ABOUT SECTION - FULLY DYNAMIC -->
        <?php if (!empty($about_heading) || !empty($about_description)): ?>
        <section class="sppm-section sppm-about-section">
            <div class="sppm-section-header">
                <h2 class="sppm-section-title">
                    <?php if ($about_icon): ?><span class="sppm-section-icon"><?php echo $about_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($about_heading); ?>
                </h2>
            </div>
            
            <div class="sppm-about-content">
                <p><?php echo nl2br(esc_html($about_description)); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- FINAL CTA SECTION - FULLY DYNAMIC -->
        <?php if (!empty($cta_title) || !empty($cta_subtitle)): ?>
        <section class="sppm-section sppm-final-cta">
            <div class="sppm-cta">
                <div class="sppm-cta-content">
                    <?php if (!empty($cta_title)): ?>
                    <h3 class="sppm-cta-title"><?php echo esc_html($cta_title); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($cta_subtitle)): ?>
                    <p class="sppm-cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="sppm-cta-buttons">
                    <?php if ($buy_now_shortcode): ?>
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    <?php else: ?>
                        <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
                    <?php endif; ?>
                    <?php if (!empty($demo_link) && $demo_link !== '#'): ?>
                    <a href="<?php echo esc_url($demo_link); ?>" class="sppm-btn sppm-btn-ghost" target="_blank">Live Demo</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

    </div>
</div>
