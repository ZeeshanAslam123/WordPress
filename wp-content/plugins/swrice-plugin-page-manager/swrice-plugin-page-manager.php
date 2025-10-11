<?php
/**
 * Plugin Name: Swrice Plugin Page Manager
 * Plugin URI: https://swrice.com/
 * Description: Create and manage professional plugin landing pages with custom post types, shortcodes, and SEO-optimized output.
 * Version: 1.0.0
 * Author: Swrice
 * Author URI: https://swrice.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: swrice-plugin-manager
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SPPM_VERSION', '1.0.0');
define('SPPM_PLUGIN_FILE', __FILE__);
define('SPPM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SPPM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SPPM_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main plugin class
 */
class SwricePluginPageManager {
    
    /**
     * Single instance of the plugin
     */
    private static $instance = null;
    
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
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Load text domain
        load_plugin_textdomain('swrice-plugin-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');
        
        // Register custom post type
        $this->register_post_type();
        
        // Register shortcodes
        $this->register_shortcodes();
        
        // Add meta boxes
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
        
        // Add admin columns
        add_filter('manage_plugin_page_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_plugin_page_posts_custom_column', array($this, 'display_admin_columns'), 10, 2);
    }
    
    /**
     * Register custom post type
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x('Plugin Pages', 'Post type general name', 'swrice-plugin-manager'),
            'singular_name'         => _x('Plugin Page', 'Post type singular name', 'swrice-plugin-manager'),
            'menu_name'             => _x('Plugin Pages', 'Admin Menu text', 'swrice-plugin-manager'),
            'name_admin_bar'        => _x('Plugin Page', 'Add New on Toolbar', 'swrice-plugin-manager'),
            'add_new'               => __('Add New', 'swrice-plugin-manager'),
            'add_new_item'          => __('Add New Plugin Page', 'swrice-plugin-manager'),
            'new_item'              => __('New Plugin Page', 'swrice-plugin-manager'),
            'edit_item'             => __('Edit Plugin Page', 'swrice-plugin-manager'),
            'view_item'             => __('View Plugin Page', 'swrice-plugin-manager'),
            'all_items'             => __('All Plugin Pages', 'swrice-plugin-manager'),
            'search_items'          => __('Search Plugin Pages', 'swrice-plugin-manager'),
            'parent_item_colon'     => __('Parent Plugin Pages:', 'swrice-plugin-manager'),
            'not_found'             => __('No plugin pages found.', 'swrice-plugin-manager'),
            'not_found_in_trash'    => __('No plugin pages found in Trash.', 'swrice-plugin-manager'),
            'featured_image'        => _x('Plugin Featured Image', 'Overrides the "Featured Image" phrase', 'swrice-plugin-manager'),
            'set_featured_image'    => _x('Set featured image', 'Overrides the "Set featured image" phrase', 'swrice-plugin-manager'),
            'remove_featured_image' => _x('Remove featured image', 'Overrides the "Remove featured image" phrase', 'swrice-plugin-manager'),
            'use_featured_image'    => _x('Use as featured image', 'Overrides the "Use as featured image" phrase', 'swrice-plugin-manager'),
            'archives'              => _x('Plugin Page archives', 'The post type archive label', 'swrice-plugin-manager'),
            'insert_into_item'      => _x('Insert into plugin page', 'Overrides the "Insert into post" phrase', 'swrice-plugin-manager'),
            'uploaded_to_this_item' => _x('Uploaded to this plugin page', 'Overrides the "Uploaded to this post" phrase', 'swrice-plugin-manager'),
            'filter_items_list'     => _x('Filter plugin pages list', 'Screen reader text for the filter links', 'swrice-plugin-manager'),
            'items_list_navigation' => _x('Plugin pages list navigation', 'Screen reader text for the pagination', 'swrice-plugin-manager'),
            'items_list'            => _x('Plugin pages list', 'Screen reader text for the items list', 'swrice-plugin-manager'),
        );
        
        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'plugin-page'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-admin-plugins',
            'supports'           => array('title', 'editor', 'thumbnail'),
            'show_in_rest'       => true,
        );
        
        register_post_type('plugin_page', $args);
    }
    
    /**
     * Register shortcodes
     */
    public function register_shortcodes() {
        add_shortcode('plugin_page', array($this, 'plugin_page_shortcode'));
        add_shortcode('buy_now_button', array($this, 'buy_now_button_shortcode'));
    }
    
    /**
     * Plugin page shortcode
     */
    public function plugin_page_shortcode($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
        ), $atts, 'plugin_page');
        
        if (empty($atts['id'])) {
            return '<p>Please provide a plugin page ID.</p>';
        }
        
        $post = get_post($atts['id']);
        if (!$post || $post->post_type !== 'plugin_page') {
            return '<p>Plugin page not found.</p>';
        }
        
        // Get meta data
        $meta = get_post_meta($post->ID);
        
        // Start output buffering
        ob_start();
        
        // Include the template
        include SPPM_PLUGIN_DIR . 'templates/plugin-page-template.php';
        
        return ob_get_clean();
    }
    
    /**
     * Buy now button shortcode
     */
    public function buy_now_button_shortcode($atts, $content = '') {
        $atts = shortcode_atts(array(
            'url' => '#',
            'text' => 'Buy Now',
            'class' => 'sppm-buy-now-btn',
            'target' => '_blank',
        ), $atts, 'buy_now_button');
        
        return sprintf(
            '<div class="sppm-buy-now-container"><a href="%s" class="%s" target="%s">%s</a></div>',
            esc_url($atts['url']),
            esc_attr($atts['class']),
            esc_attr($atts['target']),
            !empty($content) ? $content : esc_html($atts['text'])
        );
    }
    
    /**
     * Add meta boxes
     */
    public function add_meta_boxes() {
        add_meta_box(
            'plugin_page_details',
            __('Plugin Page Details', 'swrice-plugin-manager'),
            array($this, 'plugin_page_details_callback'),
            'plugin_page',
            'normal',
            'high'
        );
        
        add_meta_box(
            'plugin_page_shortcode',
            __('Shortcode', 'swrice-plugin-manager'),
            array($this, 'plugin_page_shortcode_callback'),
            'plugin_page',
            'side',
            'high'
        );
    }
    
    /**
     * Plugin page details meta box callback
     */
    public function plugin_page_details_callback($post) {
        wp_nonce_field('plugin_page_details_nonce', 'plugin_page_details_nonce');
        
        $meta = get_post_meta($post->ID);
        
        include SPPM_PLUGIN_DIR . 'admin/meta-boxes/plugin-details.php';
    }
    
    /**
     * Plugin page shortcode meta box callback
     */
    public function plugin_page_shortcode_callback($post) {
        echo '<p><strong>Use this shortcode to display the plugin page:</strong></p>';
        echo '<input type="text" value="[plugin_page id=&quot;' . $post->ID . '&quot;]" readonly style="width: 100%;" onclick="this.select();" />';
        echo '<p><small>Copy and paste this shortcode anywhere you want to display this plugin page.</small></p>';
    }
    
    /**
     * Save meta boxes
     */
    public function save_meta_boxes($post_id) {
        if (!isset($_POST['plugin_page_details_nonce']) || !wp_verify_nonce($_POST['plugin_page_details_nonce'], 'plugin_page_details_nonce')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Save simple meta fields
        $meta_fields = array(
            'plugin_price',
            'plugin_original_price',
            'buy_now_shortcode',
            'hero_subtitle',
            'problem_heading',
            'problem_icon',
            'solution_heading',
            'solution_icon',
            'solution_description',
            'how_it_works_heading',
            'how_it_works_icon',
            'faq_heading',
            'faq_icon',
            'features_heading',
            'features_icon',
            'testimonials_heading',
            'testimonials_icon',
            'bonuses_heading',
            'bonuses_icon',
            'guarantee_heading',
            'guarantee_icon',
            'guarantee_text',
            'why_choose_heading',
            'why_choose_icon',
            'about_heading',
            'about_icon',
            'about_description'
        );
        
        foreach ($meta_fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_textarea_field($_POST[$field]));
            }
        }
        
        // Save repeater fields
        
        // Save Problem items
        if (isset($_POST['problem_items']) && is_array($_POST['problem_items'])) {
            $problem_items = array();
            foreach ($_POST['problem_items'] as $item) {
                if (!empty($item['title']) || !empty($item['description'])) {
                    $problem_items[] = array(
                        'title' => sanitize_text_field($item['title']),
                        'description' => sanitize_textarea_field($item['description']),
                        'icon' => sanitize_text_field($item['icon'])
                    );
                }
            }
            update_post_meta($post_id, 'problem_items', $problem_items);
        }
        
        // Save Steps items
        if (isset($_POST['steps_items']) && is_array($_POST['steps_items'])) {
            $steps_items = array();
            foreach ($_POST['steps_items'] as $item) {
                if (!empty($item['title']) || !empty($item['description'])) {
                    $steps_items[] = array(
                        'title' => sanitize_text_field($item['title']),
                        'description' => sanitize_textarea_field($item['description'])
                    );
                }
            }
            update_post_meta($post_id, 'steps_items', $steps_items);
        }
        
        // Save FAQ items
        if (isset($_POST['faq_items']) && is_array($_POST['faq_items'])) {
            $faq_items = array();
            foreach ($_POST['faq_items'] as $item) {
                if (!empty($item['question']) || !empty($item['answer'])) {
                    $faq_items[] = array(
                        'question' => sanitize_text_field($item['question']),
                        'answer' => sanitize_textarea_field($item['answer'])
                    );
                }
            }
            update_post_meta($post_id, 'faq_items', $faq_items);
        }
        
        // Save Feature items
        if (isset($_POST['feature_items']) && is_array($_POST['feature_items'])) {
            $feature_items = array();
            foreach ($_POST['feature_items'] as $item) {
                if (!empty($item['title']) || !empty($item['description'])) {
                    $feature_items[] = array(
                        'title' => sanitize_text_field($item['title']),
                        'description' => sanitize_textarea_field($item['description']),
                        'icon' => sanitize_text_field($item['icon'])
                    );
                }
            }
            update_post_meta($post_id, 'feature_items', $feature_items);
        }
        
        // Save Testimonial items
        if (isset($_POST['testimonial_items']) && is_array($_POST['testimonial_items'])) {
            $testimonial_items = array();
            foreach ($_POST['testimonial_items'] as $item) {
                if (!empty($item['name']) || !empty($item['content'])) {
                    $testimonial_items[] = array(
                        'name' => sanitize_text_field($item['name']),
                        'title' => sanitize_text_field($item['title']),
                        'content' => sanitize_textarea_field($item['content']),
                        'rating' => sanitize_text_field($item['rating'])
                    );
                }
            }
            update_post_meta($post_id, 'testimonial_items', $testimonial_items);
        }
        
        // Save Bonus items
        if (isset($_POST['bonus_items']) && is_array($_POST['bonus_items'])) {
            $bonus_items = array();
            foreach ($_POST['bonus_items'] as $item) {
                if (!empty($item['title']) || !empty($item['description'])) {
                    $bonus_items[] = array(
                        'title' => sanitize_text_field($item['title']),
                        'description' => sanitize_textarea_field($item['description']),
                        'value' => sanitize_text_field($item['value']),
                        'icon' => sanitize_text_field($item['icon'])
                    );
                }
            }
            update_post_meta($post_id, 'bonus_items', $bonus_items);
        }
        
        // Save Guarantee Points
        if (isset($_POST['guarantee_points']) && is_array($_POST['guarantee_points'])) {
            $guarantee_points = array();
            foreach ($_POST['guarantee_points'] as $item) {
                if (!empty($item['point'])) {
                    $guarantee_points[] = array(
                        'point' => sanitize_text_field($item['point'])
                    );
                }
            }
            update_post_meta($post_id, 'guarantee_points', $guarantee_points);
        }
        
        // Save Why Choose items
        if (isset($_POST['why_choose_items']) && is_array($_POST['why_choose_items'])) {
            $why_choose_items = array();
            foreach ($_POST['why_choose_items'] as $item) {
                if (!empty($item['title']) || !empty($item['description'])) {
                    $why_choose_items[] = array(
                        'title' => sanitize_text_field($item['title']),
                        'description' => sanitize_textarea_field($item['description']),
                        'icon' => sanitize_text_field($item['icon'])
                    );
                }
            }
            update_post_meta($post_id, 'why_choose_items', $why_choose_items);
        }
    }
    
    /**
     * Add admin columns
     */
    public function add_admin_columns($columns) {
        $columns['shortcode'] = __('Shortcode', 'swrice-plugin-manager');
        $columns['price'] = __('Price', 'swrice-plugin-manager');
        return $columns;
    }
    
    /**
     * Display admin columns
     */
    public function display_admin_columns($column, $post_id) {
        switch ($column) {
            case 'shortcode':
                echo '<code>[plugin_page id="' . $post_id . '"]</code>';
                break;
            case 'price':
                $price = get_post_meta($post_id, 'plugin_price', true);
                echo $price ? '$' . $price : '-';
                break;
        }
    }
    
    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_style('sppm-frontend', SPPM_PLUGIN_URL . 'assets/css/frontend.css', array(), SPPM_VERSION);
        wp_enqueue_script('sppm-frontend', SPPM_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), SPPM_VERSION, true);
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        global $post_type;
        
        if ($post_type === 'plugin_page') {
            wp_enqueue_style('sppm-admin', SPPM_PLUGIN_URL . 'assets/css/admin.css', array(), SPPM_VERSION);
            wp_enqueue_script('sppm-admin', SPPM_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), SPPM_VERSION, true);
        }
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        $this->register_post_type();
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        flush_rewrite_rules();
    }
}

// Initialize the plugin
SwricePluginPageManager::get_instance();
