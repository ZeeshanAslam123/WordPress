<?php
/**
 * Screenshots Section Template
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
        <div class="sppm-screenshots-slider">
            <div class="sppm-screenshots-track" id="screenshots-track">
                <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                    <?php foreach ($screenshot_items as $index => $screenshot): ?>
                    <div class="sppm-screenshot-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>">
                        <div class="sppm-screenshot-image">
                            <?php if (!empty($screenshot['imageUrl'])): ?>
                            <img src="<?php echo esc_url($screenshot['imageUrl']); ?>" 
                                 alt="<?php echo esc_attr($screenshot['title']); ?>"
                                 loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="sppm-screenshot-info">
                            <?php if (!empty($screenshot['title'])): ?>
                            <h3 class="sppm-screenshot-title"><?php echo esc_html($screenshot['title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($screenshot['description'])): ?>
                            <p class="sppm-screenshot-desc"><?php echo esc_html($screenshot['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Navigation Controls -->
            <div class="sppm-screenshots-nav">
                <button class="sppm-nav-btn sppm-nav-prev" onclick="screenshotsSlider.prev()">
                    <span>‹</span>
                </button>
                <button class="sppm-nav-btn sppm-nav-next" onclick="screenshotsSlider.next()">
                    <span>›</span>
                </button>
            </div>
            
            <!-- Dots Indicator -->
            <div class="sppm-screenshots-dots">
                <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                    <?php foreach ($screenshot_items as $index => $screenshot): ?>
                    <button class="sppm-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                            onclick="screenshotsSlider.goTo(<?php echo $index; ?>)"
                            data-slide="<?php echo $index; ?>"></button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Thumbnails -->
        <div class="sppm-screenshots-thumbnails">
            <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                <?php foreach ($screenshot_items as $index => $screenshot): ?>
                <div class="sppm-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" 
                     onclick="screenshotsSlider.goTo(<?php echo $index; ?>)"
                     data-slide="<?php echo $index; ?>">
                    <?php if (!empty($screenshot['imageUrl'])): ?>
                    <img src="<?php echo esc_url($screenshot['imageUrl']); ?>" 
                         alt="<?php echo esc_attr($screenshot['title']); ?>">
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Screenshots Slider JavaScript
const screenshotsSlider = {
    currentSlide: 0,
    totalSlides: <?php echo count($screenshot_items); ?>,
    
    init() {
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
        
        // Update thumbnails
        document.querySelectorAll('.sppm-thumbnail').forEach((thumb, index) => {
            thumb.classList.toggle('active', index === this.currentSlide);
        });
    }
};

// Initialize slider when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    screenshotsSlider.init();
});
</script>

<style>
.sppm-screenshots-container {
    max-width: 1000px;
    margin: 0 auto;
}

.sppm-screenshots-slider {
    position: relative;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(29,42,63,0.06);
    overflow: hidden;
    margin-bottom: 30px;
}

.sppm-screenshot-slide {
    display: none;
    text-align: center;
}

.sppm-screenshot-slide.active {
    display: block;
}

.sppm-screenshot-image img {
    width: 100%;
    height: auto;
    max-height: 600px;
    object-fit: contain;
}

.sppm-screenshot-info {
    padding: 30px;
    background: #f8f9fa;
}

.sppm-screenshot-title {
    font-size: 24px;
    font-weight: 600;
    color: #1f2b33;
    margin: 0 0 15px 0;
}

.sppm-screenshot-desc {
    font-size: 16px;
    color: #6b747b;
    line-height: 1.6;
    margin: 0;
}

.sppm-screenshots-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    pointer-events: none;
}

.sppm-nav-btn {
    background: rgba(0,0,0,0.7);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    pointer-events: all;
    transition: all 0.3s ease;
}

.sppm-nav-btn:hover {
    background: rgba(0,0,0,0.9);
    transform: scale(1.1);
}

.sppm-screenshots-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

.sppm-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.sppm-dot.active {
    background: #5fa0d8;
}

.sppm-screenshots-thumbnails {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.sppm-thumbnail {
    width: 120px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.sppm-thumbnail.active {
    border-color: #5fa0d8;
}

.sppm-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sppm-thumbnail:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .sppm-screenshots-thumbnails {
        display: none;
    }
    
    .sppm-nav-btn {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
    
    .sppm-screenshots-nav {
        padding: 0 10px;
    }
}
</style>

