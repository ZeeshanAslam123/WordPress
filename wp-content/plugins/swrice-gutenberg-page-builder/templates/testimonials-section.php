<?php
/**
 * Testimonials Section Template
 */

if (!defined('ABSPATH')) exit;

// Include render_stars function if not already defined
if (!function_exists('render_stars')) {
    function render_stars($rating) {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $rating ? '⭐' : '☆';
        }
        return $stars;
    }
}

$testimonials_heading = isset($attributes['testimonialsHeading']) ? $attributes['testimonialsHeading'] : 'Testimonials';
$testimonials_icon = isset($attributes['testimonialsIcon']) ? $attributes['testimonialsIcon'] : '💬';
$testimonial_items = isset($attributes['testimonialItems']) ? $attributes['testimonialItems'] : array();

if (empty($testimonial_items) || !is_array($testimonial_items)) return;
?>

<section class="sppm-section sppm-testimonials-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($testimonials_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($testimonials_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($testimonials_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-testimonials-grid">
            <?php foreach ($testimonial_items as $item): ?>
                <?php if (!empty($item['name']) && !empty($item['content'])): ?>
                    <div class="sppm-testimonial-item">
                        <?php if (!empty($item['content'])): ?>
                            <div class="sppm-testimonial-content">
                                <p>"<?php echo esc_html($item['content']); ?>"</p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="sppm-testimonial-author">
                            <?php if (!empty($item['name'])): ?>
                                <h4 class="sppm-testimonial-name"><?php echo esc_html($item['name']); ?></h4>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['title'])): ?>
                                <p class="sppm-testimonial-title"><?php echo esc_html($item['title']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['rating'])): ?>
                                <div class="sppm-testimonial-rating">
                                    <?php echo render_stars(intval($item['rating'])); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
