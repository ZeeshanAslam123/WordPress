<?php
/**
 * Features Section Template
 */

if (!defined('ABSPATH')) exit;

$features_heading = isset($attributes['featuresHeading']) ? $attributes['featuresHeading'] : 'Features';
$features_icon = isset($attributes['featuresIcon']) ? $attributes['featuresIcon'] : '🚀';
$feature_items = isset($attributes['featureItems']) ? $attributes['featureItems'] : array();

if (empty($feature_items) || !is_array($feature_items)) return;
?>

<section class="sppm-section sppm-features-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($features_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($features_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($features_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-features-grid">
            <?php foreach ($feature_items as $item): ?>
                <?php if (!empty($item['title']) || !empty($item['description'])): ?>
                    <div class="sppm-feature-item">
                        <?php if (!empty($item['icon'])): ?>
                            <div class="sppm-feature-icon">
                                <?php echo esc_html($item['icon']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['title'])): ?>
                            <h3 class="sppm-feature-title"><?php echo esc_html($item['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['description'])): ?>
                            <p class="sppm-feature-description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
