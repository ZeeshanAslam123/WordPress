<?php
/**
 * How It Works Section Template
 */

if (!defined('ABSPATH')) exit;

$how_it_works_heading = isset($attributes['howItWorksHeading']) ? $attributes['howItWorksHeading'] : 'How It Works';
$how_it_works_icon = isset($attributes['howItWorksIcon']) ? $attributes['howItWorksIcon'] : '⚙️';
$steps_items = isset($attributes['stepsItems']) ? $attributes['stepsItems'] : array();

if (empty($steps_items) || !is_array($steps_items)) return;
?>

<section class="sppm-section sppm-how-it-works-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($how_it_works_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($how_it_works_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($how_it_works_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-steps-grid">
            <?php foreach ($steps_items as $index => $item): ?>
                <?php if (!empty($item['title']) || !empty($item['description'])): ?>
                    <div class="sppm-step-item">
                        <div class="sppm-step-number"><?php echo ($index + 1); ?></div>
                        
                        <?php if (!empty($item['title'])): ?>
                            <h3 class="sppm-step-title"><?php echo esc_html($item['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['description'])): ?>
                            <p class="sppm-step-description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
