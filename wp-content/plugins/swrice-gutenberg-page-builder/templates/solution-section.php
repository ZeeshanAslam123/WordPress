<?php
/**
 * Solution Section Template
 */

if (!defined('ABSPATH')) exit;

$solution_heading = isset($attributes['solutionHeading']) ? $attributes['solutionHeading'] : 'The Solution';
$solution_icon = isset($attributes['solutionIcon']) ? $attributes['solutionIcon'] : '✅';
$solution_description = isset($attributes['solutionDescription']) ? $attributes['solutionDescription'] : '';

if (empty($solution_heading) && empty($solution_description)) return;
?>

<section class="sppm-section sppm-solution-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($solution_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($solution_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($solution_heading); ?>
            </h2>
        </div>
        
        <?php if (!empty($solution_description)): ?>
            <div class="sppm-solution-content">
                <p class="sppm-solution-description"><?php echo esc_html($solution_description); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
