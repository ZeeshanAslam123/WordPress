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
        
        // Register the main plugin page builder block using direct method
        register_block_type('swrice/plugin-page-builder', array(
            'editor_script' => 'swrice-gutenberg-page-builder-editor',
            'editor_style'  => 'swrice-gutenberg-page-builder-editor',
            'style'         => 'swrice-gutenberg-page-builder-frontend',
            'attributes'    => array(
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
                'rating' => array(
                    'type' => 'number',
                    'default' => 5
                ),
                'ratingCount' => array(
                    'type' => 'string',
                    'default' => '5.0'
                )
            )
        ));
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
     * Enqueue block editor assets
     */
    public function enqueue_block_editor_assets() {
        // Block editor script
        $asset_file = include(SGPB_PLUGIN_DIR . 'build/index.asset.php');
        
        wp_enqueue_script(
            'swrice-gutenberg-page-builder-editor',
            SGPB_PLUGIN_URL . 'build/index.js',
            $asset_file['dependencies'],
            $asset_file['version'],
            true
        );
        
        // Block editor styles
        wp_enqueue_style(
            'swrice-gutenberg-page-builder-editor',
            SGPB_PLUGIN_URL . 'assets/css/editor.css',
            array('wp-edit-blocks'),
            SGPB_VERSION
        );
        
        // Localize script for translations and settings
        wp_localize_script(
            'swrice-gutenberg-page-builder-editor',
            'sgpbSettings',
            array(
                'pluginUrl' => SGPB_PLUGIN_URL,
                'version' => SGPB_VERSION,
                'nonce' => wp_create_nonce('sgpb_nonce'),
            )
        );
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
