<?php
/**
 * Fully Dynamic Plugin Page Template
 * 
 * This template creates a dynamic plugin sales page with proper HTML/CSS separation
 * All content is pulled from WordPress meta fields - no static content
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get all dynamic data from WordPress meta fields
$plugin_name = get_post_meta($post->ID, '_plugin_name', true) ?: $post->post_title;
$plugin_subtitle = get_post_meta($post->ID, '_plugin_subtitle', true) ?: 'Transform your website with our powerful plugin solution.';
$plugin_price = get_post_meta($post->ID, '_plugin_price', true) ?: '29';
$plugin_original_price = get_post_meta($post->ID, '_plugin_original_price', true) ?: '';
$plugin_rating = get_post_meta($post->ID, '_plugin_rating', true) ?: '5.0';
$buy_now_shortcode = get_post_meta($post->ID, '_buy_now_shortcode', true) ?: '';
$demo_link = get_post_meta($post->ID, '_demo_link', true) ?: '#';

// Logo and branding - dynamic
$logo_text_line1 = get_post_meta($post->ID, '_logo_text_line1', true) ?: 'YOUR';
$logo_text_line2 = get_post_meta($post->ID, '_logo_text_line2', true) ?: 'PLUGIN';

// Hero image - fully dynamic
$hero_image = get_post_meta($post->ID, '_hero_image', true);
if (!$hero_image) {
    $hero_image = get_the_post_thumbnail_url($post->ID, 'large');
}

// Device mockup content - dynamic
$device_title = get_post_meta($post->ID, '_device_title', true) ?: 'Plugin Preview';
$device_sections = get_post_meta($post->ID, '_device_sections', true);
if (empty($device_sections) || !is_array($device_sections)) {
    $device_sections = array(
        'Getting Started',
        'Configuration', 
        'Advanced Features'
    );
}

// Features section - fully dynamic
$features_title = get_post_meta($post->ID, '_features_title', true) ?: 'Why You\'ll Love It';
$plugin_features = get_post_meta($post->ID, '_plugin_features', true);
if (empty($plugin_features) || !is_array($plugin_features)) {
    $plugin_features = array(
        array('title' => 'Lightning Fast', 'description' => 'Optimized for maximum speed and performance', 'icon' => 'lightning'),
        array('title' => 'Easy to Use', 'description' => 'Intuitive interface that anyone can master', 'icon' => 'pen'),
        array('title' => 'Secure & Reliable', 'description' => 'Built with security and stability in mind', 'icon' => 'save'),
        array('title' => 'Mobile Friendly', 'description' => 'Perfect performance on all devices', 'icon' => 'circle')
    );
}

// Sidebar content - dynamic
$sidebar_title = get_post_meta($post->ID, '_sidebar_title', true) ?: 'Quick Setup';
$sidebar_items = get_post_meta($post->ID, '_sidebar_items', true);
if (empty($sidebar_items) || !is_array($sidebar_items)) {
    $sidebar_items = array(
        array('title' => 'Install & Activate', 'subtitle' => 'One-click setup'),
        array('title' => 'Configure Settings', 'subtitle' => 'Customize to your needs')
    );
}

// Checklist section - dynamic
$checklist_title = get_post_meta($post->ID, '_checklist_title', true) ?: 'Powerful Features';
$plugin_checklist = get_post_meta($post->ID, '_plugin_checklist', true);
if (empty($plugin_checklist) || !is_array($plugin_checklist)) {
    $plugin_checklist = array(
        'Easy Installation',
        'Responsive Design', 
        'SEO Optimized',
        'Regular Updates'
    );
}

// Screenshots section - dynamic
$screenshots_title = get_post_meta($post->ID, '_screenshots_title', true) ?: 'Screenshots';
$plugin_screenshots = get_post_meta($post->ID, '_plugin_screenshots', true);
if (empty($plugin_screenshots) || !is_array($plugin_screenshots)) {
    // Default placeholder screenshots
    $plugin_screenshots = array(
        array('url' => 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'380\'><rect width=\'100%\' height=\'100%\' fill=\'%23f7fbff\'/><text x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%239bbfe0\' font-family=\'Inter\' font-size=\'20\'>Screenshot 1</text></svg>', 'alt' => 'Screenshot 1'),
        array('url' => 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'380\'><rect width=\'100%\' height=\'100%\' fill=\'%23f7fbff\'/><text x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%239bbfe0\' font-family=\'Inter\' font-size=\'20\'>Screenshot 2</text></svg>', 'alt' => 'Screenshot 2'),
        array('url' => 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'380\'><rect width=\'100%\' height=\'100%\' fill=\'%23f7fbff\'/><text x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%239bbfe0\' font-family=\'Inter\' font-size=\'20\'>Screenshot 3</text></svg>', 'alt' => 'Screenshot 3')
    );
}

// Testimonials section - dynamic
$testimonials_title = get_post_meta($post->ID, '_testimonials_title', true) ?: 'What People Are Saying';
$plugin_testimonials = get_post_meta($post->ID, '_plugin_testimonials', true);
if (empty($plugin_testimonials) || !is_array($plugin_testimonials)) {
    $plugin_testimonials = array(
        array('content' => 'This plugin completely transformed my website. Highly recommended!', 'author' => 'Sarah Johnson', 'title' => 'Web Developer'),
        array('content' => 'Easy to use and excellent support. Worth every penny!', 'author' => 'Mike Chen', 'title' => 'Business Owner'),
        array('content' => 'The best investment I made for my WordPress site.', 'author' => 'Lisa Rodriguez', 'title' => 'Blogger')
    );
}

// FAQ section - dynamic
$faq_title = get_post_meta($post->ID, '_faq_title', true) ?: 'Frequently Asked Questions';
$plugin_faq = get_post_meta($post->ID, '_plugin_faq', true);
if (empty($plugin_faq) || !is_array($plugin_faq)) {
    $plugin_faq = array(
        array('question' => 'How easy is it to install?', 'answer' => 'Installation is simple - just upload, activate, and configure in minutes.'),
        array('question' => 'Do you offer support?', 'answer' => 'Yes! We provide 24/7 support to help you with any questions or issues.'),
        array('question' => 'Is it compatible with my theme?', 'answer' => 'Our plugin works with all standard WordPress themes and popular page builders.')
    );
}

// CTA section - dynamic
$cta_title = get_post_meta($post->ID, '_cta_title', true) ?: 'Ready to Get Started?';
$cta_subtitle = get_post_meta($post->ID, '_cta_subtitle', true) ?: 'Join thousands of satisfied customers and transform your website today.';

// Function to get feature icon SVG
function get_feature_icon($icon_type) {
    switch($icon_type) {
        case 'lightning':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" fill="#4a8bbd"/></svg>';
        case 'pen':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z" fill="#4a8bbd"/><path d="M20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#82bfe4"/></svg>';
        case 'save':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7l-4-4z" fill="#4a8bbd"/><path d="M17 3v4H7V3" fill="#82bfe4"/></svg>';
        case 'circle':
        default:
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" fill="#bcdff6"/></svg>';
    }
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
                        <?php echo esc_html($logo_text_line1); ?><br><?php echo esc_html($logo_text_line2); ?>
                    </div>
                </div>

                <div class="sppm-rating">
                    <div class="sppm-rating-stars">★ ★ ★ ★ ★</div>
                    <div><?php echo esc_html($plugin_rating); ?></div>
                </div>

                <h1 class="sppm-hero-title"><?php echo esc_html($plugin_name); ?></h1>
                <p class="sppm-hero-subtitle"><?php echo esc_html($plugin_subtitle); ?></p>

                <div class="sppm-hero-ctas">
                    <?php if ($buy_now_shortcode): ?>
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    <?php else: ?>
                        <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($demo_link); ?>" class="sppm-btn sppm-btn-ghost">Live Demo</a>
                </div>
            </div>

            <div class="sppm-hero-right">
                <?php if ($hero_image): ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($plugin_name); ?>" class="sppm-hero-image" />
                <?php else: ?>
                    <div class="sppm-device">
                        <div class="sppm-device-inner">
                            <h3><?php echo esc_html($device_title); ?></h3>
                            <?php foreach ($device_sections as $section): ?>
                            <div class="sppm-section-row"><?php echo esc_html($section); ?> <span>▾</span></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- FEATURES SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <div class="sppm-features-wrapper">
                <div class="sppm-features-main">
                    <h2 class="sppm-section-title"><?php echo esc_html($features_title); ?></h2>
                    
                    <div class="sppm-features-grid">
                        <?php foreach ($plugin_features as $feature): ?>
                        <div class="sppm-feature-card">
                            <div class="sppm-feature-icon">
                                <?php echo get_feature_icon($feature['icon']); ?>
                            </div>
                            <div>
                                <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                                <p class="sppm-feature-desc"><?php echo esc_html($feature['description']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sppm-sidebar">
                    <div class="sppm-sidebar-card">
                        <h4 class="sppm-sidebar-title"><?php echo esc_html($sidebar_title); ?></h4>
                        <?php foreach ($sidebar_items as $item): ?>
                        <div class="sppm-sidebar-item">
                            <strong><?php echo esc_html($item['title']); ?></strong>
                            <div class="sppm-sidebar-item-subtitle"><?php echo esc_html($item['subtitle']); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- CHECKLIST SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <h2 class="sppm-checklist-title"><?php echo esc_html($checklist_title); ?></h2>
            
            <div class="sppm-checklist">
                <?php foreach ($plugin_checklist as $item): ?>
                <div class="sppm-check-item">
                    <svg class="sppm-check-icon" viewBox="0 0 24 24" width="20" height="20">
                        <circle cx="12" cy="12" r="10" fill="#eaf6fc"/>
                        <path d="M9 12.5l1.8 1.8L15 10" stroke="#2b7fb3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                    <div class="sppm-check-text"><?php echo esc_html($item); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- SCREENSHOTS SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <h3 class="sppm-screenshots-title"><?php echo esc_html($screenshots_title); ?></h3>
            
            <div class="sppm-screenshots">
                <?php foreach ($plugin_screenshots as $screenshot): ?>
                <div class="sppm-screenshot">
                    <img src="<?php echo esc_url($screenshot['url']); ?>" alt="<?php echo esc_attr($screenshot['alt']); ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- TESTIMONIALS SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <h3 class="sppm-testimonials-title"><?php echo esc_html($testimonials_title); ?></h3>
            
            <div class="sppm-testimonials">
                <?php foreach ($plugin_testimonials as $testimonial): ?>
                <div class="sppm-testimonial-card">
                    <div class="sppm-testimonial-quote">"<?php echo esc_html($testimonial['content']); ?>"</div>
                    <div class="sppm-testimonial-meta">— <?php echo esc_html($testimonial['author']); ?>, <?php echo esc_html($testimonial['title']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- FAQ SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <h3 class="sppm-faq-title"><?php echo esc_html($faq_title); ?></h3>
            
            <div class="sppm-faq-list">
                <?php foreach ($plugin_faq as $index => $faq): ?>
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

        <!-- CTA SECTION - FULLY DYNAMIC -->
        <section class="sppm-section">
            <div class="sppm-cta">
                <div class="sppm-cta-content">
                    <h3 class="sppm-cta-title"><?php echo esc_html($cta_title); ?></h3>
                    <p class="sppm-cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
                </div>
                
                <div class="sppm-cta-buttons">
                    <?php if ($buy_now_shortcode): ?>
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    <?php else: ?>
                        <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($demo_link); ?>" class="sppm-btn sppm-btn-ghost">Live Demo</a>
                </div>
            </div>
        </section>

    </div>
</div>
