<?php
/**
 * Plugin Name: Collapsible Sections for LearnDash
 * Plugin URI: https://swrice.com/collapsible-sections-for-learndash/
 * Description: Transform your LearnDash course sections into collapsible, user-friendly navigation. Improve course UX by showing only section headings by default, with expandable content on demand.
 * Version: 1.0
 * Author: Swrice
 * Author URI: https://swrice.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: collapsible-sections-learndash
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 * 
 * @package CollapsibleSectionsLearnDash
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CSLD_VERSION', '1.0');
define('CSLD_PLUGIN_FILE', __FILE__);
define('CSLD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSLD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CSLD_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class CollapsibleSectionsLearnDash {
    
    /**
     * Single instance of the plugin
     */
    private static $instance = null;
    
    /**
     * Plugin settings
     */
    private $settings;
    
    /**
     * Get single instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Check LearnDash dependency on activation
        register_activation_hook(CSLD_PLUGIN_FILE, array($this, 'activation_check'));
        
        // Initialize plugin
        add_action('plugins_loaded', array($this, 'init'));
        
        // Admin hooks
        if (is_admin()) {
            add_action('admin_init', array($this, 'check_learndash_dependency'));
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
            add_action('wp_ajax_csld_save_settings', array($this, 'save_settings'));

        }
        
        // Frontend hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        // Template override is handled by CSLD_Template_Override class
    }
    
    /**
     * Check LearnDash dependency on activation
     */
    public function activation_check() {
        if (!$this->is_learndash_active()) {
            deactivate_plugins(CSLD_PLUGIN_BASENAME);
            wp_die(
                __('Collapsible Sections for LearnDash requires LearnDash LMS plugin to be installed and activated.', 'collapsible-sections-learndash'),
                __('Plugin Activation Error', 'collapsible-sections-learndash'),
                array('back_link' => true)
            );
        }
    }
    
    /**
     * Check LearnDash dependency during runtime
     */
    public function check_learndash_dependency() {
        if (!$this->is_learndash_active()) {
            deactivate_plugins(CSLD_PLUGIN_BASENAME);
            add_action('admin_notices', array($this, 'learndash_missing_notice'));
        }
    }
    
    /**
     * Check if LearnDash is active
     */
    private function is_learndash_active() {
        return class_exists('SFWD_LMS') || class_exists('LearnDash_Settings_Section');
    }
    
    /**
     * Show admin notice when LearnDash is missing
     */
    public function learndash_missing_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e('Collapsible Sections for LearnDash has been deactivated because LearnDash LMS plugin is not active.', 'collapsible-sections-learndash'); ?></p>
        </div>
        <?php
    }
    

    
    /**
     * Initialize plugin
     */
    public function init() {
        // Plugin initialized
        
        // Load text domain
        load_plugin_textdomain('collapsible-sections-learndash', false, dirname(CSLD_PLUGIN_BASENAME) . '/languages');
        
        // Load settings
        $this->load_settings();
        
        // Include required files
        $this->include_files();
    }
    
    /**
     * Include required files
     */
    private function include_files() {
        require_once CSLD_PLUGIN_DIR . 'includes/class-settings.php';
        require_once CSLD_PLUGIN_DIR . 'includes/class-template-override.php';
        
        // Initialize template override
        new CSLD_Template_Override();
    }
    
    /**
     * Load plugin settings
     */
    private function load_settings() {
        $default_settings = array(
            'enable_plugin' => true,
            'toggler_outer_color' => '#093b7d',
            'toggler_inner_color' => '#a3a5a9',
            'section_background_color' => '#ffffff',
            'section_border_color' => '#e2e7ed',
            'expand_collapse_behavior' => 'all_content'
        );
        
        $this->settings = wp_parse_args(get_option('csld_settings', array()), $default_settings);
    }
    
    /**
     * Get plugin settings
     */
    public function get_settings() {
        return $this->settings;
    }
    
    /**
     * Get specific setting
     */
    public function get_setting($key, $default = '') {
        return isset($this->settings[$key]) ? $this->settings[$key] : $default;
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_submenu_page(
            'learndash-lms',
            __('Collapsible Sections', 'collapsible-sections-learndash'),
            __('Collapsible Sections', 'collapsible-sections-learndash'),
            'manage_options',
            'csld-settings',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Admin page callback
     */
    public function admin_page() {
        include CSLD_PLUGIN_DIR . 'templates/admin-page.php';
    }
    
    /**
     * Enqueue admin scripts
     */
    public function admin_enqueue_scripts($hook) {
        if ('learndash-lms_page_csld-settings' !== $hook) {
            return;
        }
        
        // Enqueue WordPress color picker
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        
        // Enqueue admin scripts
        wp_enqueue_style(
            'csld-admin-style',
            CSLD_PLUGIN_URL . 'assets/css/admin.css',
            array('wp-color-picker'),
            CSLD_VERSION
        );
        
        wp_enqueue_script(
            'csld-admin-script',
            CSLD_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery', 'wp-color-picker'),
            CSLD_VERSION,
            true
        );
        
        wp_localize_script('csld-admin-script', 'csld_admin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('csld_settings_nonce'),
            'saving_text' => __('Saving...', 'collapsible-sections-learndash'),
            'saved_text' => __('Settings Saved!', 'collapsible-sections-learndash')
        ));
    }
    
    /**
     * Enqueue frontend scripts
     */
    public function enqueue_scripts() {
        // Check if plugin is enabled
        if (!$this->get_setting('enable_plugin', true)) {
            return;
        }
        
        // Only load on LearnDash pages
        if (!$this->is_learndash_course_page()) {
            return;
        }
        
        // Enqueue styles
        wp_enqueue_style(
            'csld-style',
            CSLD_PLUGIN_URL . 'assets/css/collapsible-sections.css',
            array(),
            CSLD_VERSION
        );
        
        // Enqueue scripts
        wp_enqueue_script(
            'csld-script',
            CSLD_PLUGIN_URL . 'assets/js/collapsible-sections.js',
            array('jquery'),
            CSLD_VERSION,
            true
        );
        
        // Pass settings to frontend JavaScript
        wp_localize_script('csld-script', 'csld_settings', array(
            'expand_collapse_behavior' => $this->get_setting('expand_collapse_behavior', 'all_content')
        ));
        
        // Add dynamic CSS for custom colors
        $this->add_dynamic_css();
    }
    
    /**
     * Check if current page is a LearnDash course page
     */
    private function is_learndash_course_page() {
        // Use the same function as child theme
        return function_exists('learndash_is_course_post') && learndash_is_course_post(get_the_ID());
    }
    
    /**
     * Add dynamic CSS for custom colors
     */
    private function add_dynamic_css() {
        $toggler_outer_color = $this->get_setting('toggler_outer_color', '#093b7d');
        $toggler_inner_color = $this->get_setting('toggler_inner_color', '#a3a5a9');
        $section_bg_color = $this->get_setting('section_background_color', '#ffffff');
        $section_border_color = $this->get_setting('section_border_color', '#e2e7ed');
        
        $custom_css = "
        .custom-toggle-icon {
            background: {$toggler_outer_color} !important;
            color: {$toggler_inner_color} !important;
        }
        .custom-section-toggle-btn {
            background-color: {$section_bg_color} !important;
        }
        .custom-section-item {
            border: 2px solid {$section_border_color} !important;
        }
        ";
        
        wp_add_inline_style('csld-style', $custom_css);
    }
    
    /**
     * Save settings via AJAX
     */
    public function save_settings() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'csld_settings_nonce')) {
            wp_die(__('Security check failed', 'collapsible-sections-learndash'));
        }
        
        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_die(__('Insufficient permissions', 'collapsible-sections-learndash'));
        }
        
        // Sanitize and save settings
        $new_settings = array(
            'enable_plugin' => isset($_POST['enable_plugin']) ? true : false,
            'toggler_outer_color' => sanitize_hex_color($_POST['toggler_outer_color']),
            'toggler_inner_color' => sanitize_hex_color($_POST['toggler_inner_color']),
            'section_background_color' => sanitize_hex_color($_POST['section_background_color']),
            'section_border_color' => sanitize_hex_color($_POST['section_border_color']),
            'expand_collapse_behavior' => isset($_POST['expand_collapse_behavior']) ? sanitize_text_field($_POST['expand_collapse_behavior']) : 'all_content'
        );
        
        // Get current settings and merge with new ones to preserve other settings
        $current_settings = CSLD_Settings::get_settings();
        $settings = array_merge($current_settings, $new_settings);
        
        CSLD_Settings::update_settings($settings);
        
        wp_send_json_success(array(
            'message' => __('Settings saved successfully!', 'collapsible-sections-learndash')
        ));
    }
}

/**
 * Initialize the plugin
 */
function csld_init() {
    return CollapsibleSectionsLearnDash::get_instance();
}

// Start the plugin
csld_init();
