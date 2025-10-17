<?php
/**
 * About Section Template
 */

if (!defined('ABSPATH')) exit;

$about_heading = isset($attributes['aboutHeading']) ? $attributes['aboutHeading'] : 'About';
$about_icon = isset($attributes['aboutIcon']) ? $attributes['aboutIcon'] : 'ℹ️';
$about_description = isset($attributes['aboutDescription']) ? $attributes['aboutDescription'] : '';

if (empty($about_description) && empty($about_heading)) return;
?>

<section class="sppm-section sppm-about-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($about_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($about_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($about_heading); ?>
            </h2>
        </div>
        
        <?php if (!empty($about_description)): ?>
            <div class="sppm-about-content">
                <p class="sppm-about-description"><?php echo esc_html($about_description); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
