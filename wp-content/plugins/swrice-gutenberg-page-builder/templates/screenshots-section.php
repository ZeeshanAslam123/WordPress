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
        <!-- Main Screenshot Display -->
        <div class="sppm-screenshot-main">
            <div class="sppm-screenshot-viewer" id="screenshot-viewer">
                <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                    <?php foreach ($screenshot_items as $index => $screenshot): ?>
                    <div class="sppm-screenshot-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>">
                        <?php if (!empty($screenshot['imageUrl'])): ?>
                        <div class="sppm-screenshot-image-wrapper">
                            <img src="<?php echo esc_url($screenshot['imageUrl']); ?>" 
                                 alt="<?php echo esc_attr($screenshot['title']); ?>"
                                 class="sppm-screenshot-image"
                                 loading="lazy">
                        </div>
                        <?php endif; ?>
                        
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
            
            <!-- Navigation Arrows -->
            <button class="sppm-screenshot-nav sppm-nav-prev" onclick="screenshotsSlider.prev()" aria-label="Previous screenshot">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="sppm-screenshot-nav sppm-nav-next" onclick="screenshotsSlider.next()" aria-label="Next screenshot">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <!-- Thumbnail Navigation -->
        <div class="sppm-screenshots-thumbnails">
            <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                <?php foreach ($screenshot_items as $index => $screenshot): ?>
                <button class="sppm-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" 
                        onclick="screenshotsSlider.goTo(<?php echo $index; ?>)"
                        data-slide="<?php echo $index; ?>"
                        aria-label="View screenshot <?php echo $index + 1; ?>">
                    <?php if (!empty($screenshot['imageUrl'])): ?>
                    <img src="<?php echo esc_url($screenshot['imageUrl']); ?>" 
                         alt="<?php echo esc_attr($screenshot['title']); ?>">
                    <?php endif; ?>
                </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Dots Indicator -->
        <div class="sppm-screenshots-dots">
            <?php if (is_array($screenshot_items) && !empty($screenshot_items)): ?>
                <?php foreach ($screenshot_items as $index => $screenshot): ?>
                <button class="sppm-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                        onclick="screenshotsSlider.goTo(<?php echo $index; ?>)"
                        data-slide="<?php echo $index; ?>"
                        aria-label="Go to screenshot <?php echo $index + 1; ?>"></button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Enhanced Screenshots Slider JavaScript
const screenshotsSlider = {
    currentSlide: 0,
    totalSlides: <?php echo count($screenshot_items); ?>,
    autoPlayInterval: null,
    isTransitioning: false,
    
    init() {
        if (this.totalSlides <= 1) return;
        
        this.updateSlider();
        this.addKeyboardNavigation();
        this.addTouchSupport();
        this.startAutoPlay();
        this.addHoverPause();
    },
    
    next() {
        if (this.isTransitioning) return;
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlider(true);
    },
    
    prev() {
        if (this.isTransitioning) return;
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateSlider(true);
    },
    
    goTo(index) {
        if (this.isTransitioning || index === this.currentSlide) return;
        this.currentSlide = index;
        this.updateSlider(true);
    },
    
    updateSlider(animate = false) {
        const slides = document.querySelectorAll('.sppm-screenshot-slide');
        const dots = document.querySelectorAll('.sppm-dot');
        const thumbnails = document.querySelectorAll('.sppm-thumbnail');
        
        if (animate) {
            this.isTransitioning = true;
            
            // Fade out current slide
            slides.forEach((slide, index) => {
                if (slide.classList.contains('active') && index !== this.currentSlide) {
                    slide.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    slide.style.opacity = '0';
                    slide.style.transform = 'scale(0.98)';
                }
            });
            
            setTimeout(() => {
                // Update active states
                slides.forEach((slide, index) => {
                    slide.classList.toggle('active', index === this.currentSlide);
                    if (index === this.currentSlide) {
                        slide.style.opacity = '0';
                        slide.style.transform = 'scale(0.98)';
                        slide.style.transition = 'opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                        
                        // Animate in
                        setTimeout(() => {
                            slide.style.opacity = '1';
                            slide.style.transform = 'scale(1)';
                        }, 50);
                        
                        // Clean up
                        setTimeout(() => {
                            slide.style.transition = '';
                            this.isTransitioning = false;
                        }, 450);
                    } else {
                        slide.style.opacity = '';
                        slide.style.transform = '';
                        slide.style.transition = '';
                    }
                });
                
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === this.currentSlide);
                });
                
                thumbnails.forEach((thumb, index) => {
                    thumb.classList.toggle('active', index === this.currentSlide);
                });
            }, 150);
        } else {
            // Instant update
            slides.forEach((slide, index) => {
                slide.classList.toggle('active', index === this.currentSlide);
            });
            
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentSlide);
            });
            
            thumbnails.forEach((thumb, index) => {
                thumb.classList.toggle('active', index === this.currentSlide);
            });
        }
    },
    
    startAutoPlay() {
        this.stopAutoPlay();
        this.autoPlayInterval = setInterval(() => {
            this.next();
        }, 5000);
    },
    
    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    },
    
    addKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            const container = document.querySelector('.sppm-screenshots-container');
            if (!container || !this.isInViewport(container)) return;
            
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                this.prev();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                this.next();
            }
        });
    },
    
    addTouchSupport() {
        const container = document.querySelector('.sppm-screenshot-main');
        if (!container) return;
        
        let startX = 0;
        let startY = 0;
        
        container.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        }, { passive: true });
        
        container.addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            
            const deltaX = endX - startX;
            const deltaY = endY - startY;
            
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    this.prev();
                } else {
                    this.next();
                }
            }
        }, { passive: true });
    },
    
    addHoverPause() {
        const container = document.querySelector('.sppm-screenshots-container');
        if (!container) return;
        
        container.addEventListener('mouseenter', () => {
            this.stopAutoPlay();
        });
        
        container.addEventListener('mouseleave', () => {
            this.startAutoPlay();
        });
    },
    
    isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom > 0;
    }
};

// Initialize slider when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    screenshotsSlider.init();
});

// Make available globally
window.screenshotsSlider = screenshotsSlider;
</script>

<style>
/* Screenshots Section - Themed Design */
.sppm-screenshots-section {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow);
    margin: 40px 0;
}

.sppm-screenshots-container {
    max-width: 1200px;
    margin: 0 auto;
}

.sppm-screenshot-main {
    position: relative;
    background: var(--soft);
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
}

.sppm-screenshot-viewer {
    position: relative;
    min-height: 400px;
}

.sppm-screenshot-slide {
    display: none;
    position: relative;
}

.sppm-screenshot-slide.active {
    display: block;
}

.sppm-screenshot-image-wrapper {
    position: relative;
    background: var(--card-bg);
    padding: 20px;
    text-align: center;
}

.sppm-screenshot-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(29,42,63,0.08);
}

.sppm-screenshot-info {
    padding: 30px;
    background: var(--card-bg);
    text-align: center;
}

.sppm-screenshot-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 12px 0;
}

.sppm-screenshot-desc {
    font-size: 16px;
    color: var(--muted);
    line-height: 1.6;
    margin: 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Navigation Arrows */
.sppm-screenshot-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--card-bg);
    border: none;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: var(--shadow);
    color: var(--accent);
    transition: all 0.3s ease;
    z-index: 10;
}

.sppm-nav-prev {
    left: 20px;
}

.sppm-nav-next {
    right: 20px;
}

.sppm-screenshot-nav:hover {
    background: var(--accent);
    color: white;
    transform: translateY(-50%) scale(1.1);
}

/* Thumbnails */
.sppm-screenshots-thumbnails {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.sppm-thumbnail {
    width: 100px;
    height: 70px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    background: var(--soft);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sppm-thumbnail.active {
    border-color: var(--accent);
    box-shadow: 0 4px 12px rgba(95,160,216,0.3);
}

.sppm-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sppm-thumbnail:hover {
    transform: scale(1.05);
    border-color: var(--accent-dark);
}

/* Dots Indicator */
.sppm-screenshots-dots {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
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
    transform: scale(1.2);
}

.sppm-dot:hover {
    background: var(--accent-dark);
}

/* Responsive Design */
@media (max-width: 768px) {
    .sppm-screenshots-section {
        padding: 30px 20px;
    }
    
    .sppm-screenshots-thumbnails {
        display: none;
    }
    
    .sppm-screenshot-nav {
        width: 40px;
        height: 40px;
    }
    
    .sppm-nav-prev {
        left: 10px;
    }
    
    .sppm-nav-next {
        right: 10px;
    }
    
    .sppm-screenshot-info {
        padding: 20px;
    }
    
    .sppm-screenshot-title {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .sppm-screenshot-image-wrapper {
        padding: 15px;
    }
    
    .sppm-screenshot-image {
        max-height: 300px;
    }
}
</style>
