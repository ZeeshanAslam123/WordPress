<?php
/**
 * Hero Section Template
 * Individual template for the Hero Section block
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Extract attributes with defaults
$plugin_name = isset($attributes['pluginName']) ? $attributes['pluginName'] : 'My Awesome Plugin';
$hero_subtitle = isset($attributes['heroSubtitle']) ? $attributes['heroSubtitle'] : 'Transform your WordPress experience';
$plugin_price = isset($attributes['pluginPrice']) ? $attributes['pluginPrice'] : '49';
$plugin_original_price = isset($attributes['pluginOriginalPrice']) ? $attributes['pluginOriginalPrice'] : '99';
$buy_now_shortcode = isset($attributes['buyNowShortcode']) ? $attributes['buyNowShortcode'] : '';
$demo_link = isset($attributes['demoLink']) ? $attributes['demoLink'] : '';
$hero_image_url = isset($attributes['heroImageUrl']) ? $attributes['heroImageUrl'] : '';
?>

<section class="sppm-section sppm-hero-section">
    <div class="sppm-container">
        <div class="sppm-hero-content">
            <div class="sppm-hero-text">
                <h1 class="sppm-hero-title"><?php echo esc_html($plugin_name); ?></h1>
                <p class="sppm-hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                
                <div class="sppm-pricing">
                    <?php if (!empty($plugin_original_price) && $plugin_original_price != $plugin_price): ?>
                        <span class="sppm-original-price">$<?php echo esc_html($plugin_original_price); ?></span>
                    <?php endif; ?>
                    <span class="sppm-current-price">$<?php echo esc_html($plugin_price); ?></span>
                </div>
                
                <div class="sppm-hero-buttons">
                    <?php if (!empty($buy_now_shortcode)): ?>
                        <div class="sppm-buy-button">
                            <?php echo do_shortcode($buy_now_shortcode); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($demo_link)): ?>
                        <a href="<?php echo esc_url($demo_link); ?>" class="sppm-demo-button" target="_blank">
                            View Demo
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if (!empty($hero_image_url)): ?>
                <div class="sppm-hero-image">
                    <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($plugin_name); ?>" />
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
