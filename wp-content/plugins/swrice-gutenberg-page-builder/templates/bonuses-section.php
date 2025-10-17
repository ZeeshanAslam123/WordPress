<?php
/**
 * Bonuses Section Template
 */

if (!defined('ABSPATH')) exit;

$bonuses_heading = isset($attributes['bonusesHeading']) ? $attributes['bonusesHeading'] : 'Bonuses';
$bonuses_icon = isset($attributes['bonusesIcon']) ? $attributes['bonusesIcon'] : '🎁';
$bonus_items = isset($attributes['bonusItems']) ? $attributes['bonusItems'] : array();

if (empty($bonus_items) || !is_array($bonus_items)) return;
?>

<section class="sppm-section sppm-bonuses-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($bonuses_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($bonuses_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($bonuses_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-bonuses-grid">
            <?php foreach ($bonus_items as $item): ?>
                <?php if (!empty($item['title']) || !empty($item['description'])): ?>
                    <div class="sppm-bonus-item">
                        <?php if (!empty($item['icon'])): ?>
                            <div class="sppm-bonus-icon">
                                <?php echo esc_html($item['icon']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="sppm-bonus-content">
                            <?php if (!empty($item['title'])): ?>
                                <h3 class="sppm-bonus-title"><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['description'])): ?>
                                <p class="sppm-bonus-description"><?php echo esc_html($item['description']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['value'])): ?>
                                <div class="sppm-bonus-value">Value: <?php echo esc_html($item['value']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
