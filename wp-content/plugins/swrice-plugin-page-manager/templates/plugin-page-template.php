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
$hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true);
$problem_section = get_post_meta($post->ID, 'problem_section', true);
$solution_section = get_post_meta($post->ID, 'solution_section', true);
$guarantee_text = get_post_meta($post->ID, 'guarantee_text', true);
$about_section = get_post_meta($post->ID, 'about_section', true);

// Get featured image
$featured_image = get_the_post_thumbnail_url($post->ID, 'large');
?>

<div class="sppm-plugin-page">
    
    <!-- Header Section -->
    <header class="sppm-header">
        <div class="sppm-container">
            <div class="sppm-header-content">
                <h1 class="sppm-main-title"><?php echo esc_html($post->post_title); ?></h1>
                <?php if ($hero_subtitle): ?>
                <p class="sppm-subtitle"><?php echo wp_kses_post($hero_subtitle); ?></p>
                <?php endif; ?>
                
                <?php if ($plugin_price): ?>
                <div class="sppm-price-box">
                    <div class="sppm-price-content">
                        <span class="sppm-price-label">Only</span>
                        <span class="sppm-price-amount">$<?php echo esc_html($plugin_price); ?></span>
                        <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                        <span class="sppm-original-price">$<?php echo esc_html($plugin_original_price); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($buy_now_shortcode): ?>
                    <div class="sppm-buy-button">
                        <?php echo do_shortcode($buy_now_shortcode); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="sppm-main">
        <div class="sppm-container">
            
            <!-- Problem Section -->
            <?php 
            $problem_heading = get_post_meta($post->ID, 'problem_heading', true);
            $problem_items = get_post_meta($post->ID, 'problem_items', true);
            
            if (!empty($problem_items) && is_array($problem_items)): ?>
            <section class="sppm-section sppm-problems">
                <?php if ($problem_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($problem_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-problems-list">
                    <?php foreach ($problem_items as $problem): ?>
                    <?php if (!empty($problem['title']) || !empty($problem['description'])): ?>
                    <div class="sppm-problem-item">
                        <?php if (!empty($problem['icon'])): ?>
                        <div class="sppm-problem-icon"><?php echo esc_html($problem['icon']); ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($problem['title'])): ?>
                        <h3 class="sppm-problem-title"><?php echo esc_html($problem['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($problem['description'])): ?>
                        <p class="sppm-problem-description"><?php echo esc_html($problem['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Solution Section -->
            <?php 
            $solution_heading = get_post_meta($post->ID, 'solution_heading', true);
            $solution_description = get_post_meta($post->ID, 'solution_description', true);
            
            if ($solution_heading || $solution_description): ?>
            <section class="sppm-section sppm-solution">
                <?php if ($solution_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($solution_heading); ?></h2>
                <?php endif; ?>
                
                <?php if ($solution_description): ?>
                <div class="sppm-solution-content">
                    <?php echo wpautop(esc_html($solution_description)); ?>
                </div>
                <?php endif; ?>
            </section>
            <?php endif; ?>
            
            <!-- How It Works Section -->
            <?php 
            $how_it_works_heading = get_post_meta($post->ID, 'how_it_works_heading', true);
            $how_it_works_items = get_post_meta($post->ID, 'how_it_works_items', true);
            
            if (!empty($how_it_works_items) && is_array($how_it_works_items)): ?>
            <section class="sppm-section sppm-how-it-works">
                <?php if ($how_it_works_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($how_it_works_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-steps-list">
                    <?php $step_number = 1; ?>
                    <?php foreach ($how_it_works_items as $step): ?>
                    <?php if (!empty($step['title']) || !empty($step['description'])): ?>
                    <div class="sppm-step-item">
                        <div class="sppm-step-number"><?php echo $step_number; ?></div>
                        
                        <?php if (!empty($step['title'])): ?>
                        <h3 class="sppm-step-title"><?php echo esc_html($step['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($step['description'])): ?>
                        <p class="sppm-step-description"><?php echo esc_html($step['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php $step_number++; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Features Section -->
            <?php 
            $features_heading = get_post_meta($post->ID, 'features_heading', true);
            
            if (!empty($plugin_features) && is_array($plugin_features)): ?>
            <section class="sppm-section sppm-features">
                <?php if ($features_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($features_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-features-list">
                    <?php foreach ($plugin_features as $feature): ?>
                    <?php if (!empty($feature['title']) || !empty($feature['description'])): ?>
                    <div class="sppm-feature-item">
                        <?php if (!empty($feature['icon'])): ?>
                        <div class="sppm-feature-icon"><?php echo esc_html($feature['icon']); ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($feature['title'])): ?>
                        <h3 class="sppm-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($feature['description'])): ?>
                        <p class="sppm-feature-description"><?php echo esc_html($feature['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Testimonials Section -->
            <?php 
            $testimonials_heading = get_post_meta($post->ID, 'testimonials_heading', true);
            
            if (!empty($plugin_testimonials) && is_array($plugin_testimonials)): ?>
            <section class="sppm-section sppm-testimonials">
                <?php if ($testimonials_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($testimonials_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-testimonials-list">
                    <?php foreach ($plugin_testimonials as $testimonial): ?>
                    <?php if (!empty($testimonial['content']) || !empty($testimonial['author'])): ?>
                    <div class="sppm-testimonial-item">
                        <?php if (!empty($testimonial['rating'])): ?>
                        <div class="sppm-testimonial-rating">
                            <?php 
                            $rating = intval($testimonial['rating']);
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $rating ? '★' : '☆';
                            }
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($testimonial['content'])): ?>
                        <div class="sppm-testimonial-content">
                            "<?php echo esc_html($testimonial['content']); ?>"
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($testimonial['author'])): ?>
                        <div class="sppm-testimonial-author">
                            <strong><?php echo esc_html($testimonial['author']); ?></strong>
                            <?php if (!empty($testimonial['title'])): ?>
                            <span class="sppm-testimonial-title"><?php echo esc_html($testimonial['title']); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- FAQ Section -->
            <?php 
            $faq_heading = get_post_meta($post->ID, 'faq_heading', true);
            
            if (!empty($plugin_faq) && is_array($plugin_faq)): ?>
            <section class="sppm-section sppm-faq">
                <?php if ($faq_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($faq_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-faq-list">
                    <?php foreach ($plugin_faq as $faq): ?>
                    <?php if (!empty($faq['question']) || !empty($faq['answer'])): ?>
                    <div class="sppm-faq-item">
                        <?php if (!empty($faq['question'])): ?>
                        <h3 class="sppm-faq-question"><?php echo esc_html($faq['question']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($faq['answer'])): ?>
                        <div class="sppm-faq-answer">
                            <?php echo wpautop(esc_html($faq['answer'])); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Bonuses Section -->
            <?php 
            $bonuses_heading = get_post_meta($post->ID, 'bonuses_heading', true);
            
            if (!empty($plugin_bonuses) && is_array($plugin_bonuses)): ?>
            <section class="sppm-section sppm-bonuses">
                <?php if ($bonuses_heading): ?>
                <h2 class="sppm-section-title"><?php echo esc_html($bonuses_heading); ?></h2>
                <?php endif; ?>
                
                <div class="sppm-bonuses-list">
                    <?php foreach ($plugin_bonuses as $bonus): ?>
                    <?php if (!empty($bonus['title']) || !empty($bonus['description'])): ?>
                    <div class="sppm-bonus-item">
                        <?php if (!empty($bonus['icon'])): ?>
                        <div class="sppm-bonus-icon"><?php echo esc_html($bonus['icon']); ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($bonus['title'])): ?>
                        <h3 class="sppm-bonus-title"><?php echo esc_html($bonus['title']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($bonus['value'])): ?>
                        <div class="sppm-bonus-value">Value: $<?php echo esc_html($bonus['value']); ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($bonus['description'])): ?>
                        <p class="sppm-bonus-description"><?php echo esc_html($bonus['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Guarantee Section -->
            <?php if ($guarantee_text): ?>
            <section class="sppm-section sppm-guarantee">
                <div class="sppm-guarantee-content">
                    <?php echo wp_kses_post($guarantee_text); ?>
                </div>
            </section>
            <?php endif; ?>
            
            <!-- Final CTA Section -->
            <section class="sppm-section sppm-final-cta">
                <h2 class="sppm-section-title">Get Started Today!</h2>
                <p>Transform your experience with <?php echo esc_html($post->post_title); ?></p>
                
                <?php if ($plugin_price): ?>
                <div class="sppm-final-price">
                    <span class="sppm-price-label">Special Price:</span>
                    <span class="sppm-price-amount">$<?php echo esc_html($plugin_price); ?></span>
                    <?php if ($plugin_original_price && $plugin_original_price > $plugin_price): ?>
                    <span class="sppm-original-price">$<?php echo esc_html($plugin_original_price); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if ($buy_now_shortcode): ?>
                <div class="sppm-final-button">
                    <?php echo do_shortcode($buy_now_shortcode); ?>
                </div>
                <?php endif; ?>
                
                <div class="sppm-guarantee-badges">
                    <p>✅ 30-Day Money-Back Guarantee</p>
                    <p>✅ Instant Download</p>
                    <p>✅ Lifetime Updates</p>
                </div>
            </section>
            
        </div>
    </main>
    
</div>
