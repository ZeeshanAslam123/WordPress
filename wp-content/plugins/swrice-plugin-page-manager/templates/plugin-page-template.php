<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get meta data with defaults
$plugin_price = get_post_meta($post->ID, 'plugin_price', true) ?: '97';
$plugin_original_price = get_post_meta($post->ID, 'plugin_original_price', true) ?: '147';
$plugin_features = get_post_meta($post->ID, 'plugin_features', true);
$plugin_testimonials = get_post_meta($post->ID, 'plugin_testimonials', true);
$plugin_faq = get_post_meta($post->ID, 'plugin_faq', true);
$plugin_bonuses = get_post_meta($post->ID, 'plugin_bonuses', true);
$buy_now_shortcode = get_post_meta($post->ID, 'buy_now_shortcode', true);
$meta_title = get_post_meta($post->ID, 'meta_title', true);
$meta_description = get_post_meta($post->ID, 'meta_description', true);
$meta_keywords = get_post_meta($post->ID, 'meta_keywords', true);
$hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true);
$problem_section = get_post_meta($post->ID, 'problem_section', true);
$solution_section = get_post_meta($post->ID, 'solution_section', true);
$guarantee_text = get_post_meta($post->ID, 'guarantee_text', true);
$about_section = get_post_meta($post->ID, 'about_section', true);

// Get featured image
$featured_image = get_the_post_thumbnail_url($post->ID, 'large');
?>

<div class="sppm-plugin-page" itemscope itemtype="https://schema.org/SoftwareApplication">
    
    <!-- SEO Meta Tags (if not handled by SEO plugin) -->
    <?php if ($meta_title || $meta_description || $meta_keywords): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.title === '' || document.title.includes('<?php echo get_bloginfo('name'); ?>')) {
                document.title = '<?php echo esc_js($meta_title ?: $post->post_title); ?>';
            }
            
            // Add meta description if not exists
            if (!document.querySelector('meta[name="description"]') && '<?php echo esc_js($meta_description); ?>') {
                var metaDesc = document.createElement('meta');
                metaDesc.name = 'description';
                metaDesc.content = '<?php echo esc_js($meta_description); ?>';
                document.head.appendChild(metaDesc);
            }
            
            // Add meta keywords if not exists
            if (!document.querySelector('meta[name="keywords"]') && '<?php echo esc_js($meta_keywords); ?>') {
                var metaKeywords = document.createElement('meta');
                metaKeywords.name = 'keywords';
                metaKeywords.content = '<?php echo esc_js($meta_keywords); ?>';
                document.head.appendChild(metaKeywords);
            }
        });
    </script>
    <?php endif; ?>
    
    <!-- Hero Section -->
    <section class="sppm-hero">
        <div class="sppm-container">
            <div class="sppm-hero-content">
                <h1 class="sppm-hero-title" itemprop="name"><?php echo esc_html($post->post_title); ?></h1>
                
                <?php if ($hero_subtitle): ?>
                <h2 class="sppm-hero-subtitle"><?php echo wp_kses_post($hero_subtitle); ?></h2>
                <?php endif; ?>
                
                <?php if ($featured_image): ?>
                <div class="sppm-hero-image">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post->post_title); ?>" itemprop="image" />
                </div>
                <?php endif; ?>
                
                <div class="sppm-hero-cta">
                    <?php if ($buy_now_shortcode): ?>
                        <div class="sppm-buy-now-hero">
                            <?php echo do_shortcode($buy_now_shortcode); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($plugin_price): ?>
                    <div class="sppm-price-display" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                        <span class="sppm-currency">$</span>
                        <span class="sppm-price" itemprop="price"><?php echo esc_html($plugin_price); ?></span>
                        <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                        <span class="sppm-original-price">$<?php echo esc_html($plugin_original_price); ?></span>
                        <?php endif; ?>
                        <meta itemprop="priceCurrency" content="USD" />
                        <meta itemprop="availability" content="https://schema.org/InStock" />
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Content -->
    <section class="sppm-main-content">
        <div class="sppm-container">
            
            <!-- Problem Section -->
            <?php if ($problem_section): ?>
            <div class="sppm-section sppm-problem-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($problem_section); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Solution Section -->
            <?php if ($solution_section): ?>
            <div class="sppm-section sppm-solution-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($solution_section); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Main Description -->
            <?php if ($post->post_content): ?>
            <div class="sppm-section sppm-description-section">
                <div class="sppm-section-content" itemprop="description">
                    <?php echo apply_filters('the_content', $post->post_content); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Features Section -->
            <?php if ($plugin_features): ?>
            <div class="sppm-section sppm-features-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($plugin_features); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Testimonials Section -->
            <?php if ($plugin_testimonials): ?>
            <div class="sppm-section sppm-testimonials-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($plugin_testimonials); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- FAQ Section -->
            <?php if ($plugin_faq): ?>
            <div class="sppm-section sppm-faq-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($plugin_faq); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Pricing Section -->
            <div class="sppm-section sppm-pricing-section" id="sppm-pricing">
                <div class="sppm-section-content">
                    <div class="sppm-pricing-card">
                        <div class="sppm-pricing-header">
                            <h3>Get <?php echo esc_html($post->post_title); ?> Today</h3>
                            <div class="sppm-pricing-price">
                                <span class="sppm-currency">$</span>
                                <span class="sppm-amount"><?php echo esc_html($plugin_price); ?></span>
                                <span class="sppm-period">one-time</span>
                            </div>
                            <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                            <div class="sppm-pricing-discount">
                                <span class="sppm-original">Was $<?php echo esc_html($plugin_original_price); ?></span>
                                <span class="sppm-save">Save $<?php echo esc_html($plugin_original_price - $plugin_price); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="sppm-pricing-cta">
                            <?php if ($buy_now_shortcode): ?>
                                <?php echo do_shortcode($buy_now_shortcode); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="sppm-pricing-guarantee">
                            <p>🛡️ 30-Day Money-Back Guarantee</p>
                            <p>🔒 Secure Payment Processing</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bonuses Section -->
            <?php if ($plugin_bonuses): ?>
            <div class="sppm-section sppm-bonuses-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($plugin_bonuses); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Guarantee Section -->
            <?php if ($guarantee_text): ?>
            <div class="sppm-section sppm-guarantee-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($guarantee_text); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Final CTA Section -->
            <div class="sppm-section sppm-final-cta-section">
                <div class="sppm-section-content">
                    <h2>Ready to Get Started?</h2>
                    <p>Join thousands of satisfied customers who have transformed their experience with <?php echo esc_html($post->post_title); ?>.</p>
                    
                    <?php if ($buy_now_shortcode): ?>
                    <div class="sppm-final-cta">
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="sppm-final-benefits">
                        <p>✅ Instant Download & Access</p>
                        <p>✅ 30-Day Money-Back Guarantee</p>
                        <p>✅ Lifetime Updates Included</p>
                        <p>✅ Professional Support</p>
                    </div>
                </div>
            </div>
            
            <!-- About Section -->
            <?php if ($about_section): ?>
            <div class="sppm-section sppm-about-section">
                <div class="sppm-section-content">
                    <?php echo wp_kses_post($about_section); ?>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </section>
    
    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "<?php echo esc_js($post->post_title); ?>",
        "description": "<?php echo esc_js($meta_description ?: wp_trim_words(strip_tags($post->post_content), 20)); ?>",
        <?php if ($featured_image): ?>
        "image": "<?php echo esc_url($featured_image); ?>",
        <?php endif; ?>
        "author": {
            "@type": "Organization",
            "name": "Swrice",
            "url": "https://swrice.com"
        },
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "WordPress",
        <?php if ($plugin_price): ?>
        "offers": {
            "@type": "Offer",
            "price": "<?php echo esc_js($plugin_price); ?>",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock"
        },
        <?php endif; ?>
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "ratingCount": "127"
        }
    }
    </script>
    
</div>
