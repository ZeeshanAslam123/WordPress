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
        $custom_template = $this->get_custom_template_path('section.php');
        
        // Debug: Show all template calls with detailed info
        echo '<div style="background: #f0f0f0; padding: 10px; margin: 5px; border: 1px solid #ccc;">';
        echo '<strong>CSLD Template Override Called:</strong><br>';
        echo 'Name: ' . $name . '<br>';
        echo 'Filepath: ' . $filepath . '<br>';
        echo 'Is LD30: ' . ($this->is_ld30_theme($filepath) ? 'YES' : 'NO') . '<br>';
        echo 'Custom template path: ' . $custom_template . '<br>';
        echo 'Custom template exists: ' . (file_exists($custom_template) ? 'YES' : 'NO') . '<br>';
        echo 'Section match: ' . ($name === 'lesson/partials/section' ? 'YES' : 'NO') . '<br>';
        echo '</div>';
        
        // Override section template - check for both with and without .php
        if (($name === 'lesson/partials/section' || $name === 'lesson/partials/section.php') && $this->is_ld30_theme($filepath)) {
            
            if (file_exists($custom_template)) {
                echo '<div style="background: #d4edda; padding: 10px; margin: 5px; border: 1px solid #c3e6cb;">';
                echo '<strong>✅ CSLD: Using custom section template:</strong><br>';
                echo 'Original: ' . $filepath . '<br>';
                echo 'Custom: ' . $custom_template . '<br>';
                echo '</div>';
                
                return $custom_template;
            } else {
                echo '<div style="background: #f8d7da; padding: 10px; margin: 5px; border: 1px solid #f5c6cb;">';
                echo '<strong>❌ CSLD: Custom template not found:</strong><br>';
                echo 'Looking for: ' . $custom_template . '<br>';
                echo '</div>';
            }
        }
        
        // Override course listing template
        if (($name === 'course/listing' || $name === 'course/listing.php') && $this->is_ld30_theme($filepath)) {
            $custom_listing_template = $this->get_custom_template_path('listing.php');
            
            if (file_exists($custom_listing_template)) {
                echo '<div style="background: #d4edda; padding: 10px; margin: 5px; border: 1px solid #c3e6cb;">';
                echo '<strong>✅ CSLD: Using custom listing template:</strong><br>';
                echo 'Original: ' . $filepath . '<br>';
                echo 'Custom: ' . $custom_listing_template . '<br>';
                echo '</div>';
                
                return $custom_listing_template;
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

// Template override class is instantiated by main plugin file
