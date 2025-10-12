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

// OPTIMIZED: Get ALL meta fields with a single database query for better performance
$all_meta = get_post_meta($post->ID);

// Extract values from the single meta query result
$plugin_name = $post->post_title;
$hero_subtitle = isset($all_meta['hero_subtitle'][0]) ? $all_meta['hero_subtitle'][0] : '';
$plugin_price = isset($all_meta['plugin_price'][0]) ? $all_meta['plugin_price'][0] : '';
$plugin_original_price = isset($all_meta['plugin_original_price'][0]) ? $all_meta['plugin_original_price'][0] : '';
$buy_now_shortcode = isset($all_meta['buy_now_shortcode'][0]) ? $all_meta['buy_now_shortcode'][0] : '';

// Hero image - from featured image
$hero_image = get_the_post_thumbnail_url($post->ID, 'large');

// Section 1: Problem Section
$problem_heading = isset($all_meta['problem_heading'][0]) ? $all_meta['problem_heading'][0] : '';
$problem_icon = isset($all_meta['problem_icon'][0]) ? $all_meta['problem_icon'][0] : '';
$problem_items = isset($all_meta['problem_items'][0]) ? maybe_unserialize($all_meta['problem_items'][0]) : array();

// Section 2: Solution Section
$solution_heading = isset($all_meta['solution_heading'][0]) ? $all_meta['solution_heading'][0] : '';
$solution_icon = isset($all_meta['solution_icon'][0]) ? $all_meta['solution_icon'][0] : '';
$solution_description = isset($all_meta['solution_description'][0]) ? $all_meta['solution_description'][0] : '';

// Section 3: How It Works Section
$how_it_works_heading = isset($all_meta['how_it_works_heading'][0]) ? $all_meta['how_it_works_heading'][0] : '';
$how_it_works_icon = isset($all_meta['how_it_works_icon'][0]) ? $all_meta['how_it_works_icon'][0] : '';
$steps_items = isset($all_meta['steps_items'][0]) ? maybe_unserialize($all_meta['steps_items'][0]) : array();

// Section 4: Features Section
$features_heading = isset($all_meta['features_heading'][0]) ? $all_meta['features_heading'][0] : '';
$features_icon = isset($all_meta['features_icon'][0]) ? $all_meta['features_icon'][0] : '';
$feature_items = isset($all_meta['feature_items'][0]) ? maybe_unserialize($all_meta['feature_items'][0]) : array();

// Section 5: Testimonials Section
$testimonials_heading = isset($all_meta['testimonials_heading'][0]) ? $all_meta['testimonials_heading'][0] : '';
$testimonials_icon = isset($all_meta['testimonials_icon'][0]) ? $all_meta['testimonials_icon'][0] : '';
$testimonial_items = isset($all_meta['testimonial_items'][0]) ? maybe_unserialize($all_meta['testimonial_items'][0]) : array();

// Section 6: FAQ Section
$faq_heading = isset($all_meta['faq_heading'][0]) ? $all_meta['faq_heading'][0] : '';
$faq_icon = isset($all_meta['faq_icon'][0]) ? $all_meta['faq_icon'][0] : '';
$faq_items = isset($all_meta['faq_items'][0]) ? maybe_unserialize($all_meta['faq_items'][0]) : array();

// Section 7: Bonuses Section
$bonuses_heading = isset($all_meta['bonuses_heading'][0]) ? $all_meta['bonuses_heading'][0] : '';
$bonuses_icon = isset($all_meta['bonuses_icon'][0]) ? $all_meta['bonuses_icon'][0] : '';
$bonus_items = isset($all_meta['bonus_items'][0]) ? maybe_unserialize($all_meta['bonus_items'][0]) : array();

// Section 8: Guarantee Section
$guarantee_heading = isset($all_meta['guarantee_heading'][0]) ? $all_meta['guarantee_heading'][0] : '';
$guarantee_icon = isset($all_meta['guarantee_icon'][0]) ? $all_meta['guarantee_icon'][0] : '';
$guarantee_text = isset($all_meta['guarantee_text'][0]) ? $all_meta['guarantee_text'][0] : '';
$guarantee_points = isset($all_meta['guarantee_points'][0]) ? maybe_unserialize($all_meta['guarantee_points'][0]) : array();

// Section 9: Why Choose Section
$why_choose_heading = isset($all_meta['why_choose_heading'][0]) ? $all_meta['why_choose_heading'][0] : '';
$why_choose_icon = isset($all_meta['why_choose_icon'][0]) ? $all_meta['why_choose_icon'][0] : '';
$why_choose_items = isset($all_meta['why_choose_items'][0]) ? maybe_unserialize($all_meta['why_choose_items'][0]) : array();

// Section 10: About Section
$about_heading = isset($all_meta['about_heading'][0]) ? $all_meta['about_heading'][0] : '';
$about_icon = isset($all_meta['about_icon'][0]) ? $all_meta['about_icon'][0] : '';
$about_description = isset($all_meta['about_description'][0]) ? $all_meta['about_description'][0] : '';

// Final CTA Section
$cta_title = isset($all_meta['cta_title'][0]) ? $all_meta['cta_title'][0] : '';
$cta_subtitle = isset($all_meta['cta_subtitle'][0]) ? $all_meta['cta_subtitle'][0] : '';
$demo_link = isset($all_meta['demo_link'][0]) ? $all_meta['demo_link'][0] : '';

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
                    <?php if (!empty($demo_link) && $demo_link !== '#'): ?>
                        <a href="<?php echo esc_url($demo_link); ?>" class="sppm-btn sppm-btn-ghost" target="_blank">Live Demo</a>
                    <?php endif; ?>
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

        <?php
        // Get section order and enabled states
        $section_order = maybe_unserialize(isset($all_meta['section_order'][0]) ? $all_meta['section_order'][0] : array());
        $section_enabled = maybe_unserialize(isset($all_meta['section_enabled'][0]) ? $all_meta['section_enabled'][0] : array());
        
        // Default section order if not set
        if (!is_array($section_order) || empty($section_order)) {
            $section_order = array(
                'problem', 'solution', 'how_it_works', 'features', 
                'testimonials', 'faq', 'bonuses', 'guarantee', 
                'why_choose', 'about', 'final_cta'
            );
        }
        
        // Default enabled states if not set
        if (!is_array($section_enabled)) {
            $section_enabled = array();
            foreach ($section_order as $section) {
                $section_enabled[$section] = true;
            }
        }
        
        // Loop through sections in the specified order
        foreach ($section_order as $section_key):
            // Skip if section is disabled
            if (!isset($section_enabled[$section_key]) || !$section_enabled[$section_key]) {
                continue;
            }
            
            // Render each section based on its key using original template structure
            switch ($section_key):
                case 'problem':
                    if (!empty($problem_items) && is_array($problem_items)): ?>
                    <section class="sppm-section sppm-problem-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($problem_icon): ?><span class="sppm-section-icon"><?php echo $problem_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($problem_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-problem-grid">
                            <?php if (is_array($problem_items) && !empty($problem_items)): ?>
                                <?php foreach ($problem_items as $problem): ?>
                                    <div class="sppm-problem-item">
                                        <?php if (!empty($problem['icon'])): ?>
                                            <div class="sppm-problem-icon"><?php echo $problem['icon']; ?></div>
                                        <?php endif; ?>
                                        <h3 class="sppm-problem-title"><?php echo esc_html($problem['title']); ?></h3>
                                        <p class="sppm-problem-description"><?php echo esc_html($problem['description']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'solution': ?>
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
                    <?php break;
                    
                case 'how_it_works':
                    if (!empty($steps_items) && is_array($steps_items)): ?>
                    <section class="sppm-section sppm-steps-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($how_it_works_icon): ?><span class="sppm-section-icon"><?php echo $how_it_works_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($how_it_works_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-steps-grid">
                            <?php if (is_array($steps_items) && !empty($steps_items)): ?>
                                <?php foreach ($steps_items as $index => $step): ?>
                                <div class="sppm-step-card">
                                    <div class="sppm-step-number"><?php echo ($index + 1); ?></div>
                                    <h3 class="sppm-step-title"><?php echo esc_html($step['title']); ?></h3>
                                    <p class="sppm-step-desc"><?php echo esc_html($step['description']); ?></p>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'features':
                    if (!empty($feature_items) && is_array($feature_items)): ?>
                    <section class="sppm-section sppm-features-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($features_icon): ?><span class="sppm-section-icon"><?php echo $features_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($features_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-features-grid">
                            <?php if (is_array($feature_items) && !empty($feature_items)): ?>
                                <?php foreach ($feature_items as $feature): ?>
                                    <div class="sppm-feature-item">
                                        <?php if (!empty($feature['icon'])): ?>
                                            <div class="sppm-feature-icon"><?php echo $feature['icon']; ?></div>
                                        <?php endif; ?>
                                        <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                                        <p class="sppm-feature-description"><?php echo esc_html($feature['description']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'testimonials':
                    if (!empty($testimonial_items) && is_array($testimonial_items)): ?>
                    <section class="sppm-section sppm-testimonials-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($testimonials_icon): ?><span class="sppm-section-icon"><?php echo $testimonials_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($testimonials_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-testimonials-grid">
                            <?php if (is_array($testimonial_items) && !empty($testimonial_items)): ?>
                                <?php foreach ($testimonial_items as $testimonial): ?>
                                    <div class="sppm-testimonial-item">
                                        <div class="sppm-testimonial-content">
                                            <p class="sppm-testimonial-text">"<?php echo esc_html($testimonial['text']); ?>"</p>
                                            <div class="sppm-testimonial-author">
                                                <strong><?php echo esc_html($testimonial['author']); ?></strong>
                                                <?php if (!empty($testimonial['position'])): ?>
                                                    <span class="sppm-testimonial-position"><?php echo esc_html($testimonial['position']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'faq':
                    if (!empty($faq_items) && is_array($faq_items)): ?>
                    <section class="sppm-section sppm-faq-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($faq_icon): ?><span class="sppm-section-icon"><?php echo $faq_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($faq_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-faq-list">
                            <?php if (is_array($faq_items) && !empty($faq_items)): ?>
                                <?php foreach ($faq_items as $index => $faq): ?>
                                    <div class="sppm-faq-item">
                                        <div class="sppm-faq-question" data-faq="<?php echo $index; ?>">
                                            <h3><?php echo esc_html($faq['question']); ?></h3>
                                            <span class="sppm-faq-toggle">+</span>
                                        </div>
                                        <div class="sppm-faq-answer" id="faq-<?php echo $index; ?>">
                                            <p><?php echo esc_html($faq['answer']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'bonuses':
                    if (!empty($bonus_items) && is_array($bonus_items)): ?>
                    <section class="sppm-section sppm-bonuses-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($bonuses_icon): ?><span class="sppm-section-icon"><?php echo $bonuses_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($bonuses_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-bonuses-grid">
                            <?php if (is_array($bonus_items) && !empty($bonus_items)): ?>
                                <?php foreach ($bonus_items as $bonus): ?>
                                    <div class="sppm-bonus-item">
                                        <?php if (!empty($bonus['icon'])): ?>
                                            <div class="sppm-bonus-icon"><?php echo $bonus['icon']; ?></div>
                                        <?php endif; ?>
                                        <h3 class="sppm-bonus-title"><?php echo esc_html($bonus['title']); ?></h3>
                                        <p class="sppm-bonus-description"><?php echo esc_html($bonus['description']); ?></p>
                                        <?php if (!empty($bonus['value'])): ?>
                                            <div class="sppm-bonus-value">Value: $<?php echo esc_html($bonus['value']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'guarantee': ?>
                    <section class="sppm-section sppm-guarantee-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($guarantee_icon): ?><span class="sppm-section-icon"><?php echo $guarantee_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($guarantee_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-guarantee-content">
                            <p class="sppm-guarantee-text"><?php echo esc_html($guarantee_text); ?></p>
                        </div>
                    </section>
                    <?php break;
                    
                case 'why_choose':
                    if (!empty($why_choose_items) && is_array($why_choose_items)): ?>
                    <section class="sppm-section sppm-why-choose-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($why_choose_icon): ?><span class="sppm-section-icon"><?php echo $why_choose_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($why_choose_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-why-choose-grid">
                            <?php if (is_array($why_choose_items) && !empty($why_choose_items)): ?>
                                <?php foreach ($why_choose_items as $item): ?>
                                    <div class="sppm-why-choose-item">
                                        <?php if (!empty($item['icon'])): ?>
                                            <div class="sppm-why-choose-icon"><?php echo $item['icon']; ?></div>
                                        <?php endif; ?>
                                        <h3 class="sppm-why-choose-title"><?php echo esc_html($item['title']); ?></h3>
                                        <p class="sppm-why-choose-description"><?php echo esc_html($item['description']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif;
                    break;
                    
                case 'about': ?>
                    <section class="sppm-section sppm-about-section">
                        <div class="sppm-section-header">
                            <h2 class="sppm-section-title">
                                <?php if ($about_icon): ?><span class="sppm-section-icon"><?php echo $about_icon; ?></span><?php endif; ?>
                                <?php echo esc_html($about_heading); ?>
                            </h2>
                        </div>
                        
                        <div class="sppm-about-content">
                            <p class="sppm-about-description"><?php echo esc_html($about_description); ?></p>
                        </div>
                    </section>
                    <?php break;
                    
                case 'final_cta':
                    if (!empty($cta_title) || !empty($cta_subtitle)): ?>
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
                    <?php endif;
                    break;
                    
            endswitch;
            
        endforeach;
        ?>
        

    </div>
</div>
