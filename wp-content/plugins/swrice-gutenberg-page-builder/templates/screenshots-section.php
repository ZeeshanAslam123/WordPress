<?php
/**
 * Screenshots Section Template - Themed Design
 */

if (!defined('ABSPATH')) exit;

$screenshots_heading = isset($attributes['screenshotsHeading']) ? $attributes['screenshotsHeading'] : 'Screenshots';
$screenshots_icon = isset($attributes['screenshotsIcon']) ? $attributes['screenshotsIcon'] : '📸';
$screenshots_description = isset($attributes['screenshotsDescription']) ? $attributes['screenshotsDescription'] : '';
$screenshot_items = isset($attributes['screenshotItems']) ? $attributes['screenshotItems'] : array();

if (empty($screenshot_items) || !is_array($screenshot_items)) return;
?>

<section class="sppm-section sppm-screenshots-section">
    <div class="sppm-section-header">
        <h2 class="sppm-section-title">
            <?php if ($screenshots_icon): ?><span class="sppm-section-icon"><?php echo $screenshots_icon; ?></span><?php endif; ?>
            <?php echo esc_html($screenshots_heading); ?>
        </h2>
        <?php if ($screenshots_description): ?>
        <p class="sppm-section-description"><?php echo esc_html($screenshots_description); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="sppm-screenshots-container">
        <!-- Simple Slider -->
        <div class="sppm-screenshots-slider">
            <div class="sppm-slides-wrapper">
                <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                    <?php foreach ($screenshot_items as $index => $screenshot): ?>
                    <div class="sppm-screenshot-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <?php if (!empty($screenshot['imageUrl'])): ?>
                        <img src="<?php echo esc_url($screenshot['imageUrl']); ?>" 
                             alt="<?php echo esc_attr($screenshot['title']); ?>"
                             class="sppm-screenshot-image">
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Simple Arrows -->
            <button class="sppm-arrow sppm-arrow-left" onclick="screenshotsSlider.prev()">‹</button>
            <button class="sppm-arrow sppm-arrow-right" onclick="screenshotsSlider.next()">›</button>
        </div>
        
        <!-- Simple Dots -->
        <div class="sppm-dots">
            <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                <?php foreach ($screenshot_items as $index => $screenshot): ?>
                <button class="sppm-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                        onclick="screenshotsSlider.goTo(<?php echo $index; ?>)"></button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Simple Screenshots Slider
const screenshotsSlider = {
    currentSlide: 0,
    totalSlides: <?php echo count($screenshot_items); ?>,
    
    init() {
        if (this.totalSlides <= 1) return;
        this.updateSlider();
    },
    
    next() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlider();
    },
    
    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateSlider();
    },
    
    goTo(index) {
        this.currentSlide = index;
        this.updateSlider();
    },
    
    updateSlider() {
        // Update slides
        document.querySelectorAll('.sppm-screenshot-slide').forEach((slide, index) => {
            slide.classList.toggle('active', index === this.currentSlide);
        });
        
        // Update dots
        document.querySelectorAll('.sppm-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
        });
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    screenshotsSlider.init();
});
</script>

<style>
/* Simple Screenshots Slider */
.sppm-screenshots-container {
    max-width: 800px;
    margin: 0 auto;
}

.sppm-screenshots-slider {
    position: relative;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(29,42,63,0.06);
    overflow: hidden;
    margin-bottom: 30px;
}

.sppm-slides-wrapper {
    position: relative;
    min-height: 400px;
}

.sppm-screenshot-slide {
    display: none;
    text-align: center;
}

.sppm-screenshot-slide.active {
    display: block;
}

.sppm-screenshot-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
}

/* Simple Arrows */
.sppm-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.7);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.sppm-arrow-left {
    left: 20px;
}

.sppm-arrow-right {
    right: 20px;
}

.sppm-arrow:hover {
    background: rgba(0,0,0,0.9);
    transform: translateY(-50%) scale(1.1);
}

/* Simple Dots */
.sppm-dots {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
}

.sppm-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: rgba(0,0,0,0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.sppm-dot.active {
    background: #5fa0d8;
    transform: scale(1.2);
}

.sppm-dot:hover {
    background: #4a8bbd;
}

/* Responsive */
@media (max-width: 768px) {
    .sppm-arrow {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
    
    .sppm-arrow-left {
        left: 10px;
    }
    
    .sppm-arrow-right {
        right: 10px;
    }
}
</style>
