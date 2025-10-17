<?php
/**
 * Plugin Name: Swrice Gutenberg Page Builder
 * Plugin URI: https://swrice.com/
 * Description: Create professional plugin landing pages with Gutenberg blocks. Modern block-based version of the original Swrice Plugin Page Manager.
 * Version: 1.0.0
 * Author: Swrice
 * Author URI: https://swrice.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: swrice-gutenberg-page-builder
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SGPB_VERSION', '1.0.0');
define('SGPB_PLUGIN_FILE', __FILE__);
define('SGPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SGPB_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SGPB_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class SwriceGutenbergPageBuilder {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('init', array($this, 'init'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets'));
        add_action('enqueue_block_assets', array($this, 'enqueue_block_assets'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    public function init() {
        // Load text domain
        load_plugin_textdomain('swrice-gutenberg-page-builder', false, dirname(plugin_basename(__FILE__)) . '/languages');
        
        // Register blocks
        $this->register_blocks();
        
        // Add block categories
        add_filter('block_categories_all', array($this, 'add_block_categories'), 10, 2);
    }
    
    /**
     * Register all blocks
     */
    public function register_blocks() {
        // Check if Gutenberg is active
        if (!function_exists('register_block_type')) {
            return;
        }
        
        // Register block script first
        wp_register_script(
            'swrice-plugin-page-builder-blocks',
            SGPB_PLUGIN_URL . 'assets/js/blocks.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
            SGPB_VERSION,
            true
        );
        
        // Register individual section blocks
        $this->register_individual_blocks();
            'attributes' => array(
                // Basic Info
                'pluginName' => array(
                    'type' => 'string',
                    'default' => 'My Awesome Plugin'
                ),
                'heroSubtitle' => array(
                    'type' => 'string',
                    'default' => 'Transform your WordPress experience with our powerful plugin solution'
                ),
                'pluginPrice' => array(
                    'type' => 'string',
                    'default' => '49'
                ),
                'pluginOriginalPrice' => array(
                    'type' => 'string',
                    'default' => '99'
                ),
                'buyNowShortcode' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'demoLink' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'heroImageId' => array(
                    'type' => 'number',
                    'default' => 0
                ),
                'heroImageUrl' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                
                // Section Management
                'sectionOrder' => array(
                    'type' => 'array',
                    'default' => array('problem', 'solution', 'how_it_works', 'features', 'testimonials', 'faq', 'bonuses', 'guarantee', 'why_choose', 'about', 'final_cta')
                ),
                'sectionEnabled' => array(
                    'type' => 'object',
                    'default' => array(
                        'problem' => true,
                        'solution' => true,
                        'how_it_works' => true,
                        'features' => true,
                        'testimonials' => true,
                        'faq' => true,
                        'bonuses' => true,
                        'guarantee' => true,
                        'why_choose' => true,
                        'about' => true,
                        'final_cta' => true
                    )
                ),
                
                // Section Headings and Icons
                'problemHeading' => array(
                    'type' => 'string',
                    'default' => 'The Problem'
                ),
                'problemIcon' => array(
                    'type' => 'string',
                    'default' => '⚠️'
                ),
                'solutionHeading' => array(
                    'type' => 'string',
                    'default' => 'The Solution'
                ),
                'solutionIcon' => array(
                    'type' => 'string',
                    'default' => '✅'
                ),
                'solutionDescription' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'howItWorksHeading' => array(
                    'type' => 'string',
                    'default' => 'How It Works'
                ),
                'howItWorksIcon' => array(
                    'type' => 'string',
                    'default' => '⚙️'
                ),
                'featuresHeading' => array(
                    'type' => 'string',
                    'default' => 'Features'
                ),
                'featuresIcon' => array(
                    'type' => 'string',
                    'default' => '🚀'
                ),
                'testimonialsHeading' => array(
                    'type' => 'string',
                    'default' => 'Testimonials'
                ),
                'testimonialsIcon' => array(
                    'type' => 'string',
                    'default' => '💬'
                ),
                'faqHeading' => array(
                    'type' => 'string',
                    'default' => 'FAQ'
                ),
                'faqIcon' => array(
                    'type' => 'string',
                    'default' => '❓'
                ),
                'bonusesHeading' => array(
                    'type' => 'string',
                    'default' => 'Bonuses'
                ),
                'bonusesIcon' => array(
                    'type' => 'string',
                    'default' => '🎁'
                ),
                'guaranteeHeading' => array(
                    'type' => 'string',
                    'default' => 'Guarantee'
                ),
                'guaranteeIcon' => array(
                    'type' => 'string',
                    'default' => '🛡️'
                ),
                'guaranteeText' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'whyChooseHeading' => array(
                    'type' => 'string',
                    'default' => 'Why Choose Us'
                ),
                'whyChooseIcon' => array(
                    'type' => 'string',
                    'default' => '⭐'
                ),
                'aboutHeading' => array(
                    'type' => 'string',
                    'default' => 'About'
                ),
                'aboutIcon' => array(
                    'type' => 'string',
                    'default' => 'ℹ️'
                ),
                'aboutDescription' => array(
                    'type' => 'string',
                    'default' => ''
                ),
                'ctaTitle' => array(
                    'type' => 'string',
                    'default' => 'Get Started Today'
                ),
                'ctaSubtitle' => array(
                    'type' => 'string',
                    'default' => 'Join thousands of satisfied customers'
                ),
                'finalCtaHeading' => array(
                    'type' => 'string',
                    'default' => 'Ready to Get Started?'
                ),
                'finalCtaIcon' => array(
                    'type' => 'string',
                    'default' => '🚀'
                ),
                
                // Repeater Fields
                'problemItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Problem 1',
                            'description' => 'Description of the problem',
                            'icon' => '❌'
                        )
                    )
                ),
                'stepsItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Step 1',
                            'description' => 'Description of the step'
                        )
                    )
                ),
                'featureItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Feature 1',
                            'description' => 'Description of the feature',
                            'icon' => '✨'
                        )
                    )
                ),
                'testimonialItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'name' => 'John Doe',
                            'title' => 'CEO, Company',
                            'content' => 'This plugin is amazing!',
                            'rating' => '5'
                        )
                    )
                ),
                'faqItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'question' => 'How does it work?',
                            'answer' => 'It works great!'
                        )
                    )
                ),
                'bonusItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Bonus 1',
                            'description' => 'Description of the bonus',
                            'value' => '$50',
                            'icon' => '🎁'
                        )
                    )
                ),
                'whyChooseItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Reason 1',
                            'description' => 'Why you should choose us',
                            'icon' => '⭐'
                        )
                    )
                ),
                'guaranteePoints' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'point' => '30-day money back guarantee'
                        )
                    )
                )
            )
        ));
    }
    
    /**
     * Render callback for the block
     */
    public function render_plugin_page_builder($attributes) {
        ob_start();
        
        // Include the template file
        include SGPB_PLUGIN_DIR . 'templates/block-template.php';
        
        return ob_get_clean();
    }
    
    /**
     * Add custom block category
     */
    public function add_block_categories($categories, $post) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug'  => 'swrice-blocks',
                    'title' => __('Swrice Blocks', 'swrice-gutenberg-page-builder'),
                    'icon'  => 'admin-plugins',
                ),
            )
        );
    }
    
    /**
     * Enqueue block editor assets (simplified)
     */
    public function enqueue_block_editor_assets() {
        // The script is already registered in register_blocks()
        // Just enqueue it here
        wp_enqueue_script('swrice-plugin-page-builder-block');
    }
    
    /**
     * Enqueue block assets (both editor and frontend)
     */
    public function enqueue_block_assets() {
        // Frontend styles
        wp_enqueue_style(
            'swrice-gutenberg-page-builder-frontend',
            SGPB_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            SGPB_VERSION
        );
        
        // Frontend script (if needed for interactions)
        wp_enqueue_script(
            'swrice-gutenberg-page-builder-frontend',
            SGPB_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery'),
            SGPB_VERSION,
            true
        );
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}

// Initialize the plugin
SwriceGutenbergPageBuilder::get_instance();
