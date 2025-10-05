<?php
/**
 * Settings class for Collapsible Sections for LearnDash
 *
 * @package CollapsibleSectionsLearnDash
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Settings management class
 */
class CSLD_Settings {
    
    /**
     * Settings option name
     */
    const OPTION_NAME = 'csld_settings';
    
    /**
     * Default settings
     */
    private static $defaults = array(
        'toggler_outer_color' => '#093b7d',
        'toggler_inner_color' => '#a3a5a9',
        'section_background_color' => '#ffffff',
        'enable_animations' => true,
        'animation_speed' => 300
    );
    
    /**
     * Get all settings
     */
    public static function get_settings() {
        $settings = get_option(self::OPTION_NAME, array());
        return wp_parse_args($settings, self::$defaults);
    }
    
    /**
     * Get specific setting
     */
    public static function get_setting($key, $default = null) {
        $settings = self::get_settings();
        
        if (isset($settings[$key])) {
            return $settings[$key];
        }
        
        return $default !== null ? $default : (isset(self::$defaults[$key]) ? self::$defaults[$key] : '');
    }
    
    /**
     * Update settings
     */
    public static function update_settings($new_settings) {
        $current_settings = self::get_settings();
        $updated_settings = wp_parse_args($new_settings, $current_settings);
        
        // Sanitize settings
        $updated_settings = self::sanitize_settings($updated_settings);
        
        return update_option(self::OPTION_NAME, $updated_settings);
    }
    
    /**
     * Update specific setting
     */
    public static function update_setting($key, $value) {
        $settings = self::get_settings();
        $settings[$key] = $value;
        return self::update_settings($settings);
    }
    
    /**
     * Sanitize settings
     */
    private static function sanitize_settings($settings) {
        $sanitized = array();
        
        // Sanitize toggler outer color
        if (isset($settings['toggler_outer_color'])) {
            $sanitized['toggler_outer_color'] = sanitize_hex_color($settings['toggler_outer_color']);
        }
        
        // Sanitize toggler inner color
        if (isset($settings['toggler_inner_color'])) {
            $sanitized['toggler_inner_color'] = sanitize_hex_color($settings['toggler_inner_color']);
        }
        
        // Sanitize section background color
        if (isset($settings['section_background_color'])) {
            $sanitized['section_background_color'] = sanitize_hex_color($settings['section_background_color']);
        }
        
        // Sanitize enable animations
        if (isset($settings['enable_animations'])) {
            $sanitized['enable_animations'] = (bool) $settings['enable_animations'];
        }
        
        // Sanitize animation speed
        if (isset($settings['animation_speed'])) {
            $sanitized['animation_speed'] = absint($settings['animation_speed']);
        }
        
        return $sanitized;
    }
    
    /**
     * Reset settings to defaults
     */
    public static function reset_settings() {
        return update_option(self::OPTION_NAME, self::$defaults);
    }
    
    /**
     * Delete all settings
     */
    public static function delete_settings() {
        return delete_option(self::OPTION_NAME);
    }
    
    /**
     * Get default settings
     */
    public static function get_defaults() {
        return self::$defaults;
    }
}
