<?php
/**
 * Problem Section Template
 * Individual template for the Problem Section block
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Extract attributes with defaults
$problem_heading = isset($attributes['problemHeading']) ? $attributes['problemHeading'] : 'The Problem';
$problem_icon = isset($attributes['problemIcon']) ? $attributes['problemIcon'] : '⚠️';
$problem_items = isset($attributes['problemItems']) ? $attributes['problemItems'] : array();

// Don't render if no items
if (empty($problem_items) || !is_array($problem_items)) {
    return;
}
?>

<section class="sppm-section sppm-problem-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($problem_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($problem_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($problem_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-problem-grid">
            <?php foreach ($problem_items as $item): ?>
                <?php if (!empty($item['title']) || !empty($item['description'])): ?>
                    <div class="sppm-problem-item">
                        <?php if (!empty($item['icon'])): ?>
                            <div class="sppm-problem-icon">
                                <?php echo esc_html($item['icon']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['title'])): ?>
                            <h3 class="sppm-problem-title"><?php echo esc_html($item['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['description'])): ?>
                            <p class="sppm-problem-description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
