<?php
/**
 * Template override class for Collapsible Sections for LearnDash
 *
 * @package CollapsibleSectionsLearnDash
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Template override management class
 */
class CSLD_Template_Override {
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Override LearnDash templates
        add_filter('learndash_template', array($this, 'override_section_template'), 10, 5);
        
        // Add template debugging (only for admins in debug mode)
        if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) {
            add_action('wp_footer', array($this, 'debug_template_info'));
        }
    }
    
    /**
     * Override LearnDash section template
     */
    public function override_section_template($filepath, $name, $args, $echo, $return_file_path) {
        // Only override the section template for LD30 theme
        if ($name === 'lesson/partials/section' && $this->is_ld30_theme($filepath)) {
            $custom_template = $this->get_custom_template_path('section.php');
            
            if (file_exists($custom_template)) {
                // Log template override for debugging
                if (defined('WP_DEBUG') && WP_DEBUG) {
                    error_log('CSLD: Overriding section template: ' . $filepath . ' -> ' . $custom_template);
                }
                
                return $custom_template;
            }
        }
        
        return $filepath;
    }
    
    /**
     * Check if the template is from LD30 theme
     */
    private function is_ld30_theme($filepath) {
        return strpos($filepath, 'ld30') !== false;
    }
    
    /**
     * Get custom template path
     */
    private function get_custom_template_path($template_name) {
        return CSLD_PLUGIN_DIR . 'templates/' . $template_name;
    }
    
    /**
     * Debug template information (only in debug mode)
     */
    public function debug_template_info() {
        if (!is_singular(array('sfwd-courses', 'sfwd-lessons', 'sfwd-topic'))) {
            return;
        }
        
        echo '<!-- CSLD Debug: Template override active -->';
    }
    
    /**
     * Get available custom templates
     */
    public function get_available_templates() {
        $template_dir = CSLD_PLUGIN_DIR . 'templates/';
        $templates = array();
        
        if (is_dir($template_dir)) {
            $files = scandir($template_dir);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && $file !== 'admin-page.php') {
                    $templates[] = $file;
                }
            }
        }
        
        return $templates;
    }
    
    /**
     * Check if template override is working
     */
    public function is_override_working() {
        $custom_template = $this->get_custom_template_path('section.php');
        return file_exists($custom_template) && is_readable($custom_template);
    }
}

// Initialize template override
new CSLD_Template_Override();

