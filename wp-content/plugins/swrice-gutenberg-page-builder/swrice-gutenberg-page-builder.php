<?php
/**
 * Plugin Name: Swrice Gutenberg Page Builder
 * Plugin URI: https://swrice.com
 * Description: Modern Gutenberg blocks for creating professional plugin landing pages. Individual blocks for each section with complete customization.
 * Version: 2.0.0
 * Author: Swrice
 * License: GPL v2 or later
 * Text Domain: swrice-gutenberg-page-builder
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SGPB_VERSION', '2.0.0');
define('SGPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SGPB_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Main Plugin Class
 */
class Swrice_Gutenberg_Page_Builder {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor_assets'));
        add_filter('block_categories_all', array($this, 'add_block_categories'), 10, 2);
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Register blocks
        $this->register_blocks();
    }
    
    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        wp_enqueue_style(
            'swrice-plugin-page-builder-frontend',
            SGPB_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            SGPB_VERSION
        );
        
        wp_enqueue_script(
            'swrice-plugin-page-builder-frontend',
            SGPB_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery'),
            SGPB_VERSION,
            true
        );
    }
    
    /**
     * Enqueue editor assets
     */
    public function enqueue_editor_assets() {
        wp_enqueue_style(
            'swrice-plugin-page-builder-editor',
            SGPB_PLUGIN_URL . 'assets/css/editor.css',
            array(),
            SGPB_VERSION
        );
    }
    
    /**
     * Register all blocks
     */
    public function register_blocks() {
        // Register the blocks script
        wp_register_script(
            'swrice-plugin-page-builder-blocks',
            SGPB_PLUGIN_URL . 'assets/js/blocks.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
            SGPB_VERSION,
            true
        );
        
        // Register individual section blocks
        $this->register_hero_block();
        $this->register_problem_block();
        $this->register_solution_block();
        $this->register_features_block();
        $this->register_faq_block();
        $this->register_final_cta_block();
    }
    
    /**
     * Register Hero Section Block
     */
    public function register_hero_block() {
        register_block_type('swrice/hero-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_hero_section'),
            'attributes' => array(
                'pluginName' => array('type' => 'string', 'default' => 'My Awesome Plugin'),
                'heroSubtitle' => array('type' => 'string', 'default' => 'Transform your WordPress experience'),
                'pluginPrice' => array('type' => 'string', 'default' => '49'),
                'pluginOriginalPrice' => array('type' => 'string', 'default' => '99'),
                'buyNowShortcode' => array('type' => 'string', 'default' => ''),
                'demoLink' => array('type' => 'string', 'default' => ''),
                'heroImageId' => array('type' => 'number', 'default' => 0),
                'heroImageUrl' => array('type' => 'string', 'default' => '')
            )
        ));
    }
    
    /**
     * Register Problem Section Block
     */
    public function register_problem_block() {
        register_block_type('swrice/problem-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_problem_section'),
            'attributes' => array(
                'problemHeading' => array('type' => 'string', 'default' => 'The Problem'),
                'problemIcon' => array('type' => 'string', 'default' => '⚠️'),
                'problemItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Problem 1',
                            'description' => 'Description of the problem',
                            'icon' => '❌'
                        )
                    )
                )
            )
        ));
    }
    
    /**
     * Register Solution Section Block
     */
    public function register_solution_block() {
        register_block_type('swrice/solution-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_solution_section'),
            'attributes' => array(
                'solutionHeading' => array('type' => 'string', 'default' => 'The Solution'),
                'solutionIcon' => array('type' => 'string', 'default' => '✅'),
                'solutionDescription' => array('type' => 'string', 'default' => 'Our plugin solves all your problems.')
            )
        ));
    }
    
    /**
     * Register Features Section Block
     */
    public function register_features_block() {
        register_block_type('swrice/features-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_features_section'),
            'attributes' => array(
                'featuresHeading' => array('type' => 'string', 'default' => 'Features'),
                'featuresIcon' => array('type' => 'string', 'default' => '🚀'),
                'featureItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'title' => 'Feature 1',
                            'description' => 'Description of the feature',
                            'icon' => '✨'
                        )
                    )
                )
            )
        ));
    }
    
    /**
     * Register FAQ Section Block
     */
    public function register_faq_block() {
        register_block_type('swrice/faq-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_faq_section'),
            'attributes' => array(
                'faqHeading' => array('type' => 'string', 'default' => 'FAQ'),
                'faqIcon' => array('type' => 'string', 'default' => '❓'),
                'faqItems' => array(
                    'type' => 'array',
                    'default' => array(
                        array(
                            'question' => 'How does it work?',
                            'answer' => 'It works great!'
                        )
                    )
                )
            )
        ));
    }
    
    /**
     * Register Final CTA Section Block
     */
    public function register_final_cta_block() {
        register_block_type('swrice/final-cta-section', array(
            'editor_script' => 'swrice-plugin-page-builder-blocks',
            'render_callback' => array($this, 'render_final_cta_section'),
            'attributes' => array(
                'finalCtaHeading' => array('type' => 'string', 'default' => 'Ready to Get Started?'),
                'finalCtaIcon' => array('type' => 'string', 'default' => '🚀'),
                'ctaTitle' => array('type' => 'string', 'default' => 'Get Started Today'),
                'ctaSubtitle' => array('type' => 'string', 'default' => 'Join thousands of satisfied customers'),
                'buyNowShortcode' => array('type' => 'string', 'default' => '')
            )
        ));
    }
    
    // Render callbacks for individual blocks
    public function render_hero_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/hero-section.php';
        return ob_get_clean();
    }
    
    public function render_problem_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/problem-section.php';
        return ob_get_clean();
    }
    
    public function render_solution_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/solution-section.php';
        return ob_get_clean();
    }
    
    public function render_features_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/features-section.php';
        return ob_get_clean();
    }
    
    public function render_faq_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/faq-section.php';
        return ob_get_clean();
    }
    
    public function render_final_cta_section($attributes) {
        ob_start();
        include SGPB_PLUGIN_DIR . 'templates/final-cta-section.php';
        return ob_get_clean();
    }
    
    /**
     * Add custom block category
     */
    public function add_block_categories($categories, $post) {
        return array_merge(
            array(
                array(
                    'slug' => 'swrice-blocks',
                    'title' => __('Swrice Plugin Page Builder', 'swrice-gutenberg-page-builder'),
                    'icon' => 'admin-page'
                )
            ),
            $categories
        );
    }
}

// Initialize the plugin
new Swrice_Gutenberg_Page_Builder();
