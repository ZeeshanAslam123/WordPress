<?php
/**
 * Why Choose Section Template
 */

if (!defined('ABSPATH')) exit;

$why_choose_heading = isset($attributes['whyChooseHeading']) ? $attributes['whyChooseHeading'] : 'Why Choose Us';
$why_choose_icon = isset($attributes['whyChooseIcon']) ? $attributes['whyChooseIcon'] : '⭐';
$why_choose_items = isset($attributes['whyChooseItems']) ? $attributes['whyChooseItems'] : array();

if (empty($why_choose_items) || !is_array($why_choose_items)) return;
?>

<section class="sppm-section sppm-why-choose-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($why_choose_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($why_choose_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($why_choose_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-why-choose-grid">
            <?php foreach ($why_choose_items as $item): ?>
                <?php if (!empty($item['title']) || !empty($item['description'])): ?>
                    <div class="sppm-why-choose-item">
                        <?php if (!empty($item['icon'])): ?>
                            <div class="sppm-why-choose-icon">
                                <?php echo esc_html($item['icon']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['title'])): ?>
                            <h3 class="sppm-why-choose-title"><?php echo esc_html($item['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['description'])): ?>
                            <p class="sppm-why-choose-description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
