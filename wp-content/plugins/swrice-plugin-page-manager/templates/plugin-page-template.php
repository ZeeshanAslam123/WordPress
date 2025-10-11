<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get meta data with defaults
$plugin_price = get_post_meta($post->ID, 'plugin_price', true) ?: '97';
$plugin_original_price = get_post_meta($post->ID, 'plugin_original_price', true) ?: '147';
$plugin_features = get_post_meta($post->ID, 'plugin_features', true);
$plugin_testimonials = get_post_meta($post->ID, 'plugin_testimonials', true);
$plugin_faq = get_post_meta($post->ID, 'plugin_faq', true);
$plugin_bonuses = get_post_meta($post->ID, 'plugin_bonuses', true);
$buy_now_shortcode = get_post_meta($post->ID, 'buy_now_shortcode', true);
$hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true) ?: 'Transform your WordPress experience with our powerful plugin solution';
$problem_section = get_post_meta($post->ID, 'problem_section', true);
$solution_section = get_post_meta($post->ID, 'solution_section', true);
$guarantee_text = get_post_meta($post->ID, 'guarantee_text', true);
$about_section = get_post_meta($post->ID, 'about_section', true);

// Get featured image
$featured_image = get_the_post_thumbnail_url($post->ID, 'large') ?: 'https://via.placeholder.com/400x300/007cba/ffffff?text=Plugin+Preview';

// Add default content for sections
$problem_items = get_post_meta($post->ID, 'problem_items', true);
if (empty($problem_items) || !is_array($problem_items)) {
    $problem_items = array(
        array('title' => 'Slow Performance', 'description' => 'Your current setup is slowing down your website', 'icon' => '🐌'),
        array('title' => 'Complex Setup', 'description' => 'Difficult configuration and management processes', 'icon' => '😵'),
        array('title' => 'Poor Support', 'description' => 'Limited help when you need it most', 'icon' => '❌')
    );
}

$how_it_works_items = get_post_meta($post->ID, 'how_it_works_items', true);
if (empty($how_it_works_items) || !is_array($how_it_works_items)) {
    $how_it_works_items = array(
        array('title' => 'Install & Activate', 'description' => 'Quick one-click installation process'),
        array('title' => 'Configure Settings', 'description' => 'Easy setup with guided configuration'),
        array('title' => 'Enjoy Results', 'description' => 'See immediate improvements in performance')
    );
}

if (empty($plugin_features) || !is_array($plugin_features)) {
    $plugin_features = array(
        array('title' => 'Lightning Fast', 'description' => 'Optimized for maximum speed and performance', 'icon' => '⚡'),
        array('title' => 'Easy to Use', 'description' => 'Intuitive interface that anyone can master', 'icon' => '✨'),
        array('title' => '24/7 Support', 'description' => 'Round-the-clock expert assistance', 'icon' => '🎯'),
        array('title' => 'Regular Updates', 'description' => 'Continuous improvements and new features', 'icon' => '🔄'),
        array('title' => 'Secure & Reliable', 'description' => 'Built with security and stability in mind', 'icon' => '🔒'),
        array('title' => 'Mobile Friendly', 'description' => 'Perfect performance on all devices', 'icon' => '📱')
    );
}

if (empty($plugin_testimonials) || !is_array($plugin_testimonials)) {
    $plugin_testimonials = array(
        array('content' => 'This plugin completely transformed my website performance. Highly recommended!', 'author' => 'Sarah Johnson', 'title' => 'Web Developer', 'rating' => 5),
        array('content' => 'Easy to use and excellent support. Worth every penny!', 'author' => 'Mike Chen', 'title' => 'Business Owner', 'rating' => 5),
        array('content' => 'The best investment I made for my WordPress site.', 'author' => 'Lisa Rodriguez', 'title' => 'Blogger', 'rating' => 5)
    );
}

if (empty($plugin_faq) || !is_array($plugin_faq)) {
    $plugin_faq = array(
        array('question' => 'How easy is it to install?', 'answer' => 'Installation is simple - just upload, activate, and configure in minutes.'),
        array('question' => 'Do you offer support?', 'answer' => 'Yes! We provide 24/7 support to help you with any questions or issues.'),
        array('question' => 'Is it compatible with my theme?', 'answer' => 'Our plugin works with all standard WordPress themes and popular page builders.'),
        array('question' => 'What if I\'m not satisfied?', 'answer' => 'We offer a 30-day money-back guarantee - no questions asked!')
    );
}

if (empty($plugin_bonuses) || !is_array($plugin_bonuses)) {
    $plugin_bonuses = array(
        array('title' => 'Premium Templates', 'description' => 'Access to exclusive design templates', 'value' => '49', 'icon' => '🎨'),
        array('title' => 'Video Tutorials', 'description' => 'Step-by-step video guides', 'value' => '29', 'icon' => '📹'),
        array('title' => 'Priority Support', 'description' => '1-year of priority customer support', 'value' => '99', 'icon' => '🚀')
    );
}
?>

<div class="sppm-plugin-page">
    
    <!-- Hero Section - Two Column Layout Like Your Image -->
    <section class="sppm-hero-section">
        <div class="sppm-container">
            <div class="sppm-hero-grid">
                <!-- Left Column - Content -->
                <div class="sppm-hero-content">
                    <h1 class="sppm-hero-title"><?php echo esc_html($post->post_title); ?></h1>
                    <p class="sppm-hero-description"><?php echo wp_kses_post($hero_subtitle); ?></p>
                    
                    <div class="sppm-hero-features">
                        <div class="sppm-feature-check">✅ Easy Installation</div>
                        <div class="sppm-feature-check">✅ 24/7 Support</div>
                        <div class="sppm-feature-check">✅ 30-Day Guarantee</div>
                    </div>
                    
                    <div class="sppm-hero-pricing">
                        <div class="sppm-price-container">
                            <span class="sppm-price-label">Special Price:</span>
                            <span class="sppm-current-price">$<?php echo esc_html($plugin_price); ?></span>
                            <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                            <span class="sppm-old-price">$<?php echo esc_html($plugin_original_price); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($buy_now_shortcode): ?>
                        <div class="sppm-hero-cta">
                            <?php echo do_shortcode($buy_now_shortcode); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Right Column - Image -->
                <div class="sppm-hero-image">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post->post_title); ?>" />
                </div>
            </div>
        </div>
    </section>

    <!-- Problems Section -->
    <section class="sppm-section sppm-problems-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">Are You Struggling With These Issues?</h2>
            <div class="sppm-problems-grid">
                <?php foreach ($problem_items as $problem): ?>
                <div class="sppm-problem-card">
                    <div class="sppm-problem-icon"><?php echo esc_html($problem['icon']); ?></div>
                    <h3 class="sppm-problem-title"><?php echo esc_html($problem['title']); ?></h3>
                    <p class="sppm-problem-desc"><?php echo esc_html($problem['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Solution Section -->
    <section class="sppm-section sppm-solution-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">Here's The Perfect Solution</h2>
            <div class="sppm-solution-content">
                <p>Our plugin eliminates all these problems with a simple, powerful solution that works right out of the box. No complex setup, no technical knowledge required - just install and enjoy the results!</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="sppm-section sppm-how-works-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">How It Works</h2>
            <div class="sppm-steps-grid">
                <?php $step = 1; foreach ($how_it_works_items as $item): ?>
                <div class="sppm-step-card">
                    <div class="sppm-step-number"><?php echo $step; ?></div>
                    <h3 class="sppm-step-title"><?php echo esc_html($item['title']); ?></h3>
                    <p class="sppm-step-desc"><?php echo esc_html($item['description']); ?></p>
                </div>
                <?php $step++; endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="sppm-section sppm-features-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">Powerful Features</h2>
            <div class="sppm-features-grid">
                <?php foreach ($plugin_features as $feature): ?>
                <div class="sppm-feature-card">
                    <div class="sppm-feature-icon"><?php echo esc_html($feature['icon']); ?></div>
                    <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                    <p class="sppm-feature-desc"><?php echo esc_html($feature['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="sppm-section sppm-testimonials-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">What Our Customers Say</h2>
            <div class="sppm-testimonials-grid">
                <?php foreach ($plugin_testimonials as $testimonial): ?>
                <div class="sppm-testimonial-card">
                    <div class="sppm-testimonial-stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="sppm-star <?php echo $i <= $testimonial['rating'] ? 'filled' : ''; ?>">★</span>
                        <?php endfor; ?>
                    </div>
                    <p class="sppm-testimonial-text">"<?php echo esc_html($testimonial['content']); ?>"</p>
                    <div class="sppm-testimonial-author">
                        <strong><?php echo esc_html($testimonial['author']); ?></strong>
                        <span><?php echo esc_html($testimonial['title']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="sppm-section sppm-faq-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">Frequently Asked Questions</h2>
            <div class="sppm-faq-list">
                <?php foreach ($plugin_faq as $faq): ?>
                <div class="sppm-faq-item">
                    <div class="sppm-faq-question">
                        <span><?php echo esc_html($faq['question']); ?></span>
                        <span class="sppm-faq-toggle">+</span>
                    </div>
                    <div class="sppm-faq-answer">
                        <p><?php echo esc_html($faq['answer']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Bonuses Section -->
    <section class="sppm-section sppm-bonuses-section">
        <div class="sppm-container">
            <h2 class="sppm-section-title">Exclusive Bonuses</h2>
            <div class="sppm-bonuses-grid">
                <?php foreach ($plugin_bonuses as $bonus): ?>
                <div class="sppm-bonus-card">
                    <div class="sppm-bonus-icon"><?php echo esc_html($bonus['icon']); ?></div>
                    <h3 class="sppm-bonus-title"><?php echo esc_html($bonus['title']); ?></h3>
                    <div class="sppm-bonus-value">Value: $<?php echo esc_html($bonus['value']); ?></div>
                    <p class="sppm-bonus-desc"><?php echo esc_html($bonus['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="sppm-section sppm-final-cta-section">
        <div class="sppm-container">
            <div class="sppm-cta-content">
                <h2 class="sppm-cta-title">Get Started Today!</h2>
                <p class="sppm-cta-subtitle">Join thousands of satisfied customers and transform your website now</p>
                
                <div class="sppm-cta-pricing">
                    <div class="sppm-cta-price">
                        <span class="sppm-cta-label">Limited Time Offer:</span>
                        <span class="sppm-cta-amount">$<?php echo esc_html($plugin_price); ?></span>
                        <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                        <span class="sppm-cta-original">$<?php echo esc_html($plugin_original_price); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($buy_now_shortcode): ?>
                    <div class="sppm-cta-button">
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="sppm-cta-guarantees">
                    <div class="sppm-guarantee-item">✅ 30-Day Money Back Guarantee</div>
                    <div class="sppm-guarantee-item">✅ Instant Download</div>
                    <div class="sppm-guarantee-item">✅ Lifetime Updates</div>
                </div>
            </div>
        </div>
    </section>

</div>

