<?php
/**
 * Final CTA Section Template
 */

if (!defined('ABSPATH')) exit;

$final_cta_heading = isset($attributes['finalCtaHeading']) ? $attributes['finalCtaHeading'] : 'Ready to Get Started?';
$final_cta_icon = isset($attributes['finalCtaIcon']) ? $attributes['finalCtaIcon'] : '🚀';
$cta_title = isset($attributes['ctaTitle']) ? $attributes['ctaTitle'] : 'Get Started Today';
$cta_subtitle = isset($attributes['ctaSubtitle']) ? $attributes['ctaSubtitle'] : 'Join thousands of satisfied customers';
$buy_now_shortcode = isset($attributes['buyNowShortcode']) ? $attributes['buyNowShortcode'] : '';

if (empty($cta_title) && empty($final_cta_heading)) return;
?>

<section class="sppm-section sppm-final-cta-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($final_cta_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($final_cta_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($final_cta_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-cta-content">
            <?php if (!empty($cta_title)): ?>
                <h3 class="sppm-cta-title"><?php echo esc_html($cta_title); ?></h3>
            <?php endif; ?>
            
            <?php if (!empty($cta_subtitle)): ?>
                <p class="sppm-cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($buy_now_shortcode)): ?>
                <div class="sppm-cta-button">
                    <?php echo do_shortcode($buy_now_shortcode); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
