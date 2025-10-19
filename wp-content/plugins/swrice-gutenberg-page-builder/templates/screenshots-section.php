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
/* Professional Screenshots Slider */
.sppm-screenshots-container {
    max-width: 900px;
    margin: 0 auto;
}

.sppm-screenshots-slider {
    position: relative;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 30px;
    border: 1px solid rgba(95,160,216,0.1);
}

.sppm-slides-wrapper {
    position: relative;
    min-height: 450px;
    background: var(--soft);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sppm-screenshot-slide {
    display: none;
    text-align: center;
    padding: 30px;
    width: 100%;
}

.sppm-screenshot-slide.active {
    display: block;
}

.sppm-screenshot-image {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(29,42,63,0.1);
    background: white;
    padding: 10px;
}

/* Professional Arrows */
.sppm-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--card-bg);
    color: var(--accent);
    border: none;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sppm-arrow-left {
    left: 20px;
}

.sppm-arrow-right {
    right: 20px;
}

.sppm-arrow:hover {
    background: var(--accent);
    color: white;
    transform: translateY(-50%) scale(1.1);
}

/* Professional Dots */
.sppm-dots {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: var(--card-bg);
}

.sppm-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: rgba(107,116,123,0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.sppm-dot.active {
    background: var(--accent);
    transform: scale(1.3);
    box-shadow: 0 2px 8px rgba(95,160,216,0.4);
}

.sppm-dot:hover {
    background: var(--accent-dark);
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .sppm-screenshots-container {
        max-width: 100%;
        padding: 0 20px;
    }
    
    .sppm-slides-wrapper {
        min-height: 350px;
    }
    
    .sppm-screenshot-slide {
        padding: 20px;
    }
    
    .sppm-screenshot-image {
        max-height: 300px;
        padding: 8px;
    }
    
    .sppm-arrow {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .sppm-arrow-left {
        left: 15px;
    }
    
    .sppm-arrow-right {
        right: 15px;
    }
    
    .sppm-dots {
        padding: 15px;
    }
}

@media (max-width: 480px) {
    .sppm-slides-wrapper {
        min-height: 280px;
    }
    
    .sppm-screenshot-slide {
        padding: 15px;
    }
    
    .sppm-screenshot-image {
        max-height: 250px;
        padding: 6px;
    }
    
    .sppm-arrow {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }
    
    .sppm-arrow-left {
        left: 10px;
    }
    
    .sppm-arrow-right {
        right: 10px;
    }
}
</style>
