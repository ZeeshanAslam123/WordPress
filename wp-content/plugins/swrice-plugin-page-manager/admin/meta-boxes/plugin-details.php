<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get meta values
$plugin_price = get_post_meta($post->ID, 'plugin_price', true);
$plugin_original_price = get_post_meta($post->ID, 'plugin_original_price', true);
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
?>

<div class="sppm-meta-box">
    <div class="sppm-tabs">
        <ul class="sppm-tab-nav">
            <li><a href="#tab-basic" class="sppm-tab-link active">Basic Info</a></li>
            <li><a href="#tab-content" class="sppm-tab-link">Content</a></li>
            <li><a href="#tab-pricing" class="sppm-tab-link">Pricing</a></li>
            <li><a href="#tab-seo" class="sppm-tab-link">SEO</a></li>
        </ul>
        
        <div id="tab-basic" class="sppm-tab-content active">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="hero_subtitle"><?php _e('Hero Subtitle', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="hero_subtitle" name="hero_subtitle" rows="3" cols="50" class="large-text"><?php echo esc_textarea($hero_subtitle); ?></textarea>
                        <p class="description"><?php _e('The subtitle that appears below the main title in the hero section.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="buy_now_shortcode"><?php _e('Buy Now Shortcode', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="buy_now_shortcode" name="buy_now_shortcode" rows="3" cols="50" class="large-text"><?php echo esc_textarea($buy_now_shortcode); ?></textarea>
                        <p class="description"><?php _e('Paste your buy now shortcode here (e.g., from payment processors like Stripe, PayPal, etc.).', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="tab-content" class="sppm-tab-content">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="problem_section"><?php _e('Problem Section', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="problem_section" name="problem_section" rows="8" cols="50" class="large-text"><?php echo esc_textarea($problem_section); ?></textarea>
                        <p class="description"><?php _e('Describe the problems your plugin solves. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="solution_section"><?php _e('Solution Section', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="solution_section" name="solution_section" rows="8" cols="50" class="large-text"><?php echo esc_textarea($solution_section); ?></textarea>
                        <p class="description"><?php _e('Describe how your plugin solves the problems. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="plugin_features"><?php _e('Plugin Features', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="plugin_features" name="plugin_features" rows="10" cols="50" class="large-text"><?php echo esc_textarea($plugin_features); ?></textarea>
                        <p class="description"><?php _e('List the key features of your plugin. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="plugin_testimonials"><?php _e('Testimonials', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="plugin_testimonials" name="plugin_testimonials" rows="8" cols="50" class="large-text"><?php echo esc_textarea($plugin_testimonials); ?></textarea>
                        <p class="description"><?php _e('Customer testimonials. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="plugin_faq"><?php _e('FAQ Section', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="plugin_faq" name="plugin_faq" rows="10" cols="50" class="large-text"><?php echo esc_textarea($plugin_faq); ?></textarea>
                        <p class="description"><?php _e('Frequently asked questions. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="plugin_bonuses"><?php _e('Bonuses Section', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="plugin_bonuses" name="plugin_bonuses" rows="8" cols="50" class="large-text"><?php echo esc_textarea($plugin_bonuses); ?></textarea>
                        <p class="description"><?php _e('Bonus offers and additional value. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="guarantee_text"><?php _e('Guarantee Text', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="guarantee_text" name="guarantee_text" rows="5" cols="50" class="large-text"><?php echo esc_textarea($guarantee_text); ?></textarea>
                        <p class="description"><?php _e('Money-back guarantee details. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="about_section"><?php _e('About Section', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="about_section" name="about_section" rows="6" cols="50" class="large-text"><?php echo esc_textarea($about_section); ?></textarea>
                        <p class="description"><?php _e('About the company/developer. Use HTML for formatting.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="tab-pricing" class="sppm-tab-content">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="plugin_price"><?php _e('Current Price', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <input type="number" id="plugin_price" name="plugin_price" value="<?php echo esc_attr($plugin_price); ?>" step="0.01" min="0" />
                        <p class="description"><?php _e('Current selling price (without currency symbol).', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="plugin_original_price"><?php _e('Original Price', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <input type="number" id="plugin_original_price" name="plugin_original_price" value="<?php echo esc_attr($plugin_original_price); ?>" step="0.01" min="0" />
                        <p class="description"><?php _e('Original price (for showing discounts). Leave empty if no discount.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="tab-seo" class="sppm-tab-content">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="meta_title"><?php _e('Meta Title', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="meta_title" name="meta_title" value="<?php echo esc_attr($meta_title); ?>" class="large-text" />
                        <p class="description"><?php _e('SEO title for the page (recommended: 50-60 characters).', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="meta_description"><?php _e('Meta Description', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="meta_description" name="meta_description" rows="3" cols="50" class="large-text"><?php echo esc_textarea($meta_description); ?></textarea>
                        <p class="description"><?php _e('SEO description for the page (recommended: 150-160 characters).', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="meta_keywords"><?php _e('Meta Keywords', 'swrice-plugin-manager'); ?></label>
                    </th>
                    <td>
                        <textarea id="meta_keywords" name="meta_keywords" rows="2" cols="50" class="large-text"><?php echo esc_textarea($meta_keywords); ?></textarea>
                        <p class="description"><?php _e('SEO keywords separated by commas.', 'swrice-plugin-manager'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<style>
.sppm-meta-box {
    margin-top: 20px;
}

.sppm-tab-nav {
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #ccd0d4;
    display: flex;
}

.sppm-tab-nav li {
    margin: 0;
    padding: 0;
}

.sppm-tab-link {
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    color: #646970;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.sppm-tab-link:hover,
.sppm-tab-link.active {
    color: #2271b1;
    border-bottom-color: #2271b1;
}

.sppm-tab-content {
    display: none;
    padding: 20px 0;
}

.sppm-tab-content.active {
    display: block;
}

.sppm-tab-content .form-table th {
    width: 200px;
    vertical-align: top;
    padding-top: 15px;
}

.sppm-tab-content .form-table td {
    padding-top: 10px;
}

.sppm-tab-content textarea,
.sppm-tab-content input[type="text"],
.sppm-tab-content input[type="number"] {
    width: 100%;
    max-width: 600px;
}
</style>

<script>
jQuery(document).ready(function($) {
    $('.sppm-tab-link').on('click', function(e) {
        e.preventDefault();
        
        var target = $(this).attr('href');
        
        // Remove active class from all tabs and content
        $('.sppm-tab-link').removeClass('active');
        $('.sppm-tab-content').removeClass('active');
        
        // Add active class to clicked tab and corresponding content
        $(this).addClass('active');
        $(target).addClass('active');
    });
});
</script>
