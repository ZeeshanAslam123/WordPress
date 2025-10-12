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
$hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true) ?: 'Transform your website with our powerful plugin solution.';
$plugin_price = get_post_meta($post->ID, 'plugin_price', true) ?: '29';
$plugin_original_price = get_post_meta($post->ID, 'plugin_original_price', true) ?: '';
$buy_now_shortcode = get_post_meta($post->ID, 'buy_now_shortcode', true) ?: '';

// Hero image - from featured image
$hero_image = get_the_post_thumbnail_url($post->ID, 'large');

// Section 1: Problem Section
$problem_heading = get_post_meta($post->ID, 'problem_heading', true) ?: 'The Problems Killing Your Success';
$problem_icon = get_post_meta($post->ID, 'problem_icon', true) ?: '😤';
$problem_items = get_post_meta($post->ID, 'problem_items', true);
if (!is_array($problem_items) || empty($problem_items)) {
    $problem_items = array(
        array('title' => 'Overwhelming Experience', 'description' => 'Long, cluttered content confuses users and hurts completion rates', 'icon' => '🚫'),
        array('title' => 'Poor Mobile Experience', 'description' => 'Users struggle to navigate on mobile devices, leading to dropouts', 'icon' => '📱'),
        array('title' => 'Wasted Time', 'description' => 'Users spend more time searching for content than actually using it', 'icon' => '⏰'),
        array('title' => 'Lost Revenue', 'description' => 'Poor user experience leads to refund requests and negative reviews', 'icon' => '💸')
    );
}

// Section 2: Solution Section
$solution_heading = get_post_meta($post->ID, 'solution_heading', true) ?: 'Introducing Your Perfect Solution';
$solution_icon = get_post_meta($post->ID, 'solution_icon', true) ?: '✨';
$solution_description = get_post_meta($post->ID, 'solution_description', true) ?: 'Transform chaotic layouts into clean, professional navigation that users love. Our premium plugin creates an elegant, organized environment that increases completion rates and improves user satisfaction.';

// Section 3: How It Works Section
$how_it_works_heading = get_post_meta($post->ID, 'how_it_works_heading', true) ?: 'How It Works - Simple 3-Step Setup';
$how_it_works_icon = get_post_meta($post->ID, 'how_it_works_icon', true) ?: '🛠️';
$steps_items = get_post_meta($post->ID, 'steps_items', true);
if (!is_array($steps_items) || empty($steps_items)) {
    $steps_items = array(
        array('title' => 'Install & Activate', 'description' => 'Upload the plugin, activate it, and you\'re 90% done. No complex configuration required.'),
        array('title' => 'Choose Your Settings', 'description' => 'Configure your preferences using the intuitive admin interface.'),
        array('title' => 'Customize & Launch', 'description' => 'Use the modern admin interface to customize and watch your results soar.')
    );
}

// Section 4: Features Section
$features_heading = get_post_meta($post->ID, 'features_heading', true) ?: 'Powerful Features';
$features_icon = get_post_meta($post->ID, 'features_icon', true) ?: '🔥';
$feature_items = get_post_meta($post->ID, 'feature_items', true);
if (!is_array($feature_items) || empty($feature_items)) {
    $feature_items = array(
        array('title' => 'Lightning Fast', 'description' => 'Optimized for maximum speed and performance', 'icon' => '⚡'),
        array('title' => 'Easy to Use', 'description' => 'Intuitive interface that anyone can master', 'icon' => '🎯'),
        array('title' => 'Secure & Reliable', 'description' => 'Built with security and stability in mind', 'icon' => '🔧'),
        array('title' => 'Mobile Friendly', 'description' => 'Perfect performance on all devices', 'icon' => '📱')
    );
}

// Section 5: Testimonials Section
$testimonials_heading = get_post_meta($post->ID, 'testimonials_heading', true) ?: 'What Our Customers Say';
$testimonials_icon = get_post_meta($post->ID, 'testimonials_icon', true) ?: '💬';
$testimonial_items = get_post_meta($post->ID, 'testimonial_items', true);
if (!is_array($testimonial_items) || empty($testimonial_items)) {
    $testimonial_items = array(
        array('name' => 'Sarah Johnson', 'title' => 'Corporate Training Manager', 'content' => 'This plugin transformed our corporate training platform. Course completion rates increased by 35% within the first month. The dual-mode system is genius!', 'rating' => '5'),
        array('name' => 'Mike Chen', 'title' => 'Online Course Creator', 'content' => 'Finally, a plugin that makes courses look professional on mobile. Our students love the clean navigation, and we\'ve seen fewer support tickets.', 'rating' => '5'),
        array('name' => 'Lisa Rodriguez', 'title' => 'Educational Director', 'content' => 'The modern admin interface is beautiful and so easy to use. We customized the colors to match our brand in minutes. Best plugin investment we\'ve made.', 'rating' => '5')
    );
}

// Section 6: FAQ Section
$faq_heading = get_post_meta($post->ID, 'faq_heading', true) ?: 'Frequently Asked Questions';
$faq_icon = get_post_meta($post->ID, 'faq_icon', true) ?: '❓';
$faq_items = get_post_meta($post->ID, 'faq_items', true);
if (!is_array($faq_items) || empty($faq_items)) {
    $faq_items = array(
        array('question' => 'Will this plugin conflict with my theme or other plugins?', 'answer' => 'No! Our plugin uses official template systems, ensuring zero conflicts with themes and other plugins. It\'s designed to work seamlessly with any WordPress theme.'),
        array('question' => 'Do I need coding skills to use this plugin?', 'answer' => 'Absolutely not! The plugin works perfectly out of the box with default settings. The modern admin interface makes customization as simple as clicking options.'),
        array('question' => 'Will this work on mobile devices?', 'answer' => 'Yes! The plugin is built with a mobile-first approach. All features work perfectly on smartphones and tablets.')
    );
}

// Section 7: Bonuses Section
$bonuses_heading = get_post_meta($post->ID, 'bonuses_heading', true) ?: 'Exclusive Bonuses';
$bonuses_icon = get_post_meta($post->ID, 'bonuses_icon', true) ?: '🎁';
$bonus_items = get_post_meta($post->ID, 'bonus_items', true);
if (!is_array($bonus_items) || empty($bonus_items)) {
    $bonus_items = array(
        array('title' => 'Premium Support', 'description' => 'Get priority email support for 1 year', 'value' => '$99', 'icon' => '🎧'),
        array('title' => 'Custom CSS Guide', 'description' => 'Step-by-step customization guide', 'value' => '$49', 'icon' => '🎨'),
        array('title' => 'Video Tutorials', 'description' => 'Complete video tutorial series', 'value' => '$79', 'icon' => '📹')
    );
}

// Section 8: Guarantee Section
$guarantee_heading = get_post_meta($post->ID, 'guarantee_heading', true) ?: 'Risk-Free 30-Day Money-Back Guarantee';
$guarantee_icon = get_post_meta($post->ID, 'guarantee_icon', true) ?: '🛡️';
$guarantee_text = get_post_meta($post->ID, 'guarantee_text', true) ?: 'We\'re so confident that this plugin will transform your experience and boost engagement that we offer a complete 30-day money-back guarantee. If you\'re not completely satisfied for any reason, simply contact us within 30 days for a full refund. No questions asked.';
$guarantee_points = get_post_meta($post->ID, 'guarantee_points', true);
if (!is_array($guarantee_points) || empty($guarantee_points)) {
    $guarantee_points = array(
        array('point' => 'Try the plugin risk-free for 30 full days'),
        array('point' => 'Test all features and customization options'),
        array('point' => 'See the impact on your completion rates'),
        array('point' => 'Full refund if not completely satisfied')
    );
}

// Section 9: Why Choose Section
$why_choose_heading = get_post_meta($post->ID, 'why_choose_heading', true) ?: 'Why Choose This Plugin?';
$why_choose_icon = get_post_meta($post->ID, 'why_choose_icon', true) ?: '🎯';
$why_choose_items = get_post_meta($post->ID, 'why_choose_items', true);
if (!is_array($why_choose_items) || empty($why_choose_items)) {
    $why_choose_items = array(
        array('title' => 'Boost User Engagement', 'description' => 'Reduce cognitive overload and help users focus on one section at a time. Studies show organized content increases completion rates by up to 40%.', 'icon' => '📈'),
        array('title' => 'Professional Design', 'description' => 'Seamlessly integrates with your existing theme. No design conflicts, no broken layouts - just clean, professional pages that build trust.', 'icon' => '💼'),
        array('title' => 'Mobile-First Experience', 'description' => 'Perfect responsive design ensures your content looks amazing on every device. Your mobile users will thank you.', 'icon' => '📱'),
        array('title' => 'Instant Organization', 'description' => 'Transform chaotic layouts into clean, professional navigation that users love. Show only what matters with smooth expandable content.', 'icon' => '⚡')
    );
}

// Section 10: About Section
$about_heading = get_post_meta($post->ID, 'about_heading', true) ?: 'About Our Company';
$about_icon = get_post_meta($post->ID, 'about_icon', true) ?: '👨‍💻';
$about_description = get_post_meta($post->ID, 'about_description', true) ?: 'We specialize in creating premium WordPress plugins that solve real problems for online educators and course creators. With years of experience in development and a deep understanding of online learning challenges, we build tools that make a real difference in user engagement and success.';

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
        <?php if (!empty($problem_items)): ?>
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

        <!-- SECTION 3: HOW IT WORKS SECTION - FULLY DYNAMIC -->
        <?php if (!empty($steps_items)): ?>
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
        <?php if (!empty($feature_items)): ?>
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
                    <?php if (!empty($feature['icon'])): ?>
                    <div class="sppm-feature-icon"><?php echo $feature['icon']; ?></div>
                    <?php endif; ?>
                    <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                    <p class="sppm-feature-desc"><?php echo esc_html($feature['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- SECTION 5: TESTIMONIALS SECTION - FULLY DYNAMIC -->
        <?php if (!empty($testimonial_items)): ?>
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
        <?php if (!empty($faq_items)): ?>
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
        <?php if (!empty($bonus_items)): ?>
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

        <!-- SECTION 9: WHY CHOOSE SECTION - FULLY DYNAMIC -->
        <?php if (!empty($why_choose_items)): ?>
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

        <!-- FINAL CTA SECTION - FULLY DYNAMIC -->
        <section class="sppm-section sppm-final-cta">
            <div class="sppm-cta">
                <div class="sppm-cta-content">
                    <h3 class="sppm-cta-title">Ready to Get Started?</h3>
                    <p class="sppm-cta-subtitle">Join thousands of satisfied customers and transform your website today.</p>
                </div>
                
                <div class="sppm-cta-buttons">
                    <?php if ($buy_now_shortcode): ?>
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    <?php else: ?>
                        <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
                    <?php endif; ?>
                    <a href="#" class="sppm-btn sppm-btn-ghost">Live Demo</a>
                </div>
            </div>
        </section>

    </div>
</div>
