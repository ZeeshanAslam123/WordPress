<?php
/**
 * Admin page template for Collapsible Sections for LearnDash
 *
 * @package CollapsibleSectionsLearnDash
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get current settings
$settings = $this->get_settings();
?>

<div class="wrap csld-admin-wrap">
    <!-- Modern Header Section -->
    <div class="csld-header-section">
        <div class="csld-header-content">
            <div class="csld-header-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z" fill="#0073aa"/>
                    <path d="M7 8H17V10H7V8ZM7 15H17V17H7V15Z" fill="#135e96"/>
                </svg>
            </div>
            <div class="csld-header-text">
                <h1 class="csld-main-title"><?php _e('Collapsible Sections for LearnDash', 'collapsible-sections-learndash'); ?></h1>
                <p class="csld-subtitle">
                    <?php _e('Transform your LearnDash courses with elegant collapsible sections that improve navigation and user experience.', 'collapsible-sections-learndash'); ?>
                </p>
            </div>
        </div>
        <div class="csld-header-actions">
            <a href="https://swrice.com/collapsible-sections-for-learndash/" target="_blank" class="csld-btn csld-btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z" fill="currentColor"/>
                </svg>
                <?php _e('Documentation', 'collapsible-sections-learndash'); ?>
            </a>
            <a href="https://swrice.com/contact-us/" target="_blank" class="csld-btn csld-btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                </svg>
                <?php _e('Get Support', 'collapsible-sections-learndash'); ?>
            </a>
        </div>
    </div>

    <!-- Message area for save/error feedback -->
    <div id="csld-save-message" class="csld-notice" style="display: none;">
        <div class="csld-notice-content">
            <svg class="csld-notice-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
            </svg>
            <p></p>
        </div>
    </div>

    <div class="csld-admin-content">
        <div class="csld-main-panel">
            <!-- Plugin Status Card -->
            <div class="csld-card csld-status-card">
                <div class="csld-card-header">
                    <h2 class="csld-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="#10b981"/>
                        </svg>
                        <?php _e('Plugin Status', 'collapsible-sections-learndash'); ?>
                    </h2>
                </div>
                <div class="csld-card-body">
                    <div class="csld-status-grid">
                        <div class="csld-status-item">
                            <div class="csld-status-indicator csld-status-success"></div>
                            <div class="csld-status-details">
                                <span class="csld-status-label"><?php _e('LearnDash Integration', 'collapsible-sections-learndash'); ?></span>
                                <span class="csld-status-value"><?php _e('Active & Compatible', 'collapsible-sections-learndash'); ?></span>
                            </div>
                        </div>
                        <div class="csld-status-item">
                            <div class="csld-status-indicator csld-status-success"></div>
                            <div class="csld-status-details">
                                <span class="csld-status-label"><?php _e('Template Override', 'collapsible-sections-learndash'); ?></span>
                                <span class="csld-status-value"><?php _e('Functioning Properly', 'collapsible-sections-learndash'); ?></span>
                            </div>
                        </div>
                        <div class="csld-status-item">
                            <div class="csld-status-indicator csld-status-info"></div>
                            <div class="csld-status-details">
                                <span class="csld-status-label"><?php _e('Plugin Version', 'collapsible-sections-learndash'); ?></span>
                                <span class="csld-status-value"><?php echo CSLD_VERSION; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Form Card -->
            <div class="csld-card csld-settings-card">
                <div class="csld-card-header">
                    <h2 class="csld-card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z" fill="#0073aa"/>
                        </svg>
                        <?php _e('Plugin Configuration', 'collapsible-sections-learndash'); ?>
                    </h2>
                    <p class="csld-card-description">
                        <?php _e('Customize the appearance and behavior of your collapsible course sections.', 'collapsible-sections-learndash'); ?>
                    </p>
                </div>
                <div class="csld-card-body">
                    <form id="csld-settings-form" method="post">
                        <?php wp_nonce_field('csld_settings_nonce', 'csld_nonce'); ?>
                        
                        <div class="csld-form-grid">
                            <!-- Enable Plugin Field -->
                            <div class="csld-form-field csld-form-field-toggle">
                                <div class="csld-field-header">
                                    <label for="enable_plugin" class="csld-field-label">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z" fill="#0073aa"/>
                                        </svg>
                                        <?php _e('Enable Plugin', 'collapsible-sections-learndash'); ?>
                                    </label>
                                    <div class="csld-field-toggle">
                                        <label class="csld-toggle-switch">
                                            <input 
                                                type="checkbox" 
                                                id="enable_plugin" 
                                                name="enable_plugin" 
                                                value="yes"
                                                <?php checked($settings['enable_plugin'], 'yes'); ?>
                                            />
                                            <span class="csld-toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <p class="csld-field-description">
                                    <?php _e('Turn the collapsible sections feature on or off. When disabled, normal LearnDash functionality will be used instead.', 'collapsible-sections-learndash'); ?>
                                </p>
                            </div>
                            
                            <!-- Color Settings Section -->
                            <div class="csld-form-section">
                                <h3 class="csld-section-title">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 3C16.97 3 21 7.03 21 12S16.97 21 12 21 3 16.97 3 12 7.03 3 12 3ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15 15 13.66 15 12 13.66 9 12 9Z" fill="#0073aa"/>
                                    </svg>
                                    <?php _e('Color Customization', 'collapsible-sections-learndash'); ?>
                                </h3>
                                <p class="csld-section-description">
                                    <?php _e('Customize the colors to match your site\'s design and branding.', 'collapsible-sections-learndash'); ?>
                                </p>
                                
                                <div class="csld-color-grid">
                                    <!-- Toggler Outer Color -->
                                    <div class="csld-form-field csld-form-field-color">
                                        <label for="toggler_outer_color" class="csld-field-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" fill="<?php echo esc_attr($settings['toggler_outer_color']); ?>"/>
                                            </svg>
                                            <?php _e('Toggler Outer Color', 'collapsible-sections-learndash'); ?>
                                        </label>
                                        <div class="csld-color-input-wrapper">
                                            <input 
                                                type="text" 
                                                id="toggler_outer_color" 
                                                name="toggler_outer_color" 
                                                value="<?php echo esc_attr($settings['toggler_outer_color']); ?>" 
                                                class="csld-color-picker" 
                                                data-default-color="#093b7d"
                                            />
                                        </div>
                                        <p class="csld-field-description">
                                            <?php _e('Background color for the section toggle icons.', 'collapsible-sections-learndash'); ?>
                                        </p>
                                    </div>

                                    <!-- Toggler Inner Color -->
                                    <div class="csld-form-field csld-form-field-color">
                                        <label for="toggler_inner_color" class="csld-field-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" fill="<?php echo esc_attr($settings['toggler_inner_color']); ?>"/>
                                            </svg>
                                            <?php _e('Toggler Inner Color', 'collapsible-sections-learndash'); ?>
                                        </label>
                                        <div class="csld-color-input-wrapper">
                                            <input 
                                                type="text" 
                                                id="toggler_inner_color" 
                                                name="toggler_inner_color" 
                                                value="<?php echo esc_attr($settings['toggler_inner_color']); ?>" 
                                                class="csld-color-picker" 
                                                data-default-color="#a3a5a9"
                                            />
                                        </div>
                                        <p class="csld-field-description">
                                            <?php _e('Inner fill color for the section toggle icons.', 'collapsible-sections-learndash'); ?>
                                        </p>
                                    </div>

                                    <!-- Section Background Color -->
                                    <div class="csld-form-field csld-form-field-color">
                                        <label for="section_background_color" class="csld-field-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" fill="<?php echo esc_attr($settings['section_background_color']); ?>"/>
                                            </svg>
                                            <?php _e('Section Background Color', 'collapsible-sections-learndash'); ?>
                                        </label>
                                        <div class="csld-color-input-wrapper">
                                            <input 
                                                type="text" 
                                                id="section_background_color" 
                                                name="section_background_color" 
                                                value="<?php echo esc_attr($settings['section_background_color']); ?>" 
                                                class="csld-color-picker" 
                                                data-default-color="#ffffff"
                                            />
                                        </div>
                                        <p class="csld-field-description">
                                            <?php _e('Background color for section toggle buttons.', 'collapsible-sections-learndash'); ?>
                                        </p>
                                    </div>

                                    <!-- Section Border Color -->
                                    <div class="csld-form-field csld-form-field-color">
                                        <label for="section_border_color" class="csld-field-label">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" fill="<?php echo esc_attr($settings['section_border_color']); ?>"/>
                                            </svg>
                                            <?php _e('Section Border Color', 'collapsible-sections-learndash'); ?>
                                        </label>
                                        <div class="csld-color-input-wrapper">
                                            <input 
                                                type="text" 
                                                id="section_border_color" 
                                                name="section_border_color" 
                                                value="<?php echo esc_attr($settings['section_border_color']); ?>" 
                                                class="csld-color-picker" 
                                                data-default-color="#e2e7ed"
                                            />
                                        </div>
                                        <p class="csld-field-description">
                                            <?php _e('Border color for section items (.custom-section-item).', 'collapsible-sections-learndash'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Behavior Settings Section -->
                            <div class="csld-form-section">
                                <h3 class="csld-section-title">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L2 7L12 12L22 7L12 2ZM2 17L12 22L22 17M2 12L12 17L22 12" stroke="#0073aa" stroke-width="2" fill="none"/>
                                    </svg>
                                    <?php _e('Behavior Settings', 'collapsible-sections-learndash'); ?>
                                </h3>
                                <p class="csld-section-description">
                                    <?php _e('Configure how the expand/collapse functionality behaves for your users.', 'collapsible-sections-learndash'); ?>
                                </p>
                                
                                <!-- Expand/Collapse Behavior -->
                                <div class="csld-form-field csld-form-field-select">
                                    <label for="expand_collapse_behavior" class="csld-field-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 14L12 9L17 14H7Z" fill="#0073aa"/>
                                        </svg>
                                        <?php _e('Expand/Collapse Behavior', 'collapsible-sections-learndash'); ?>
                                    </label>
                                    <div class="csld-select-wrapper">
                                        <select id="expand_collapse_behavior" name="expand_collapse_behavior" class="csld-select">
                                            <option value="all_content" <?php selected($settings['expand_collapse_behavior'], 'all_content'); ?>>
                                                <?php _e('Expand/Collapse All Content (Default)', 'collapsible-sections-learndash'); ?>
                                            </option>
                                            <option value="sections_only" <?php selected($settings['expand_collapse_behavior'], 'sections_only'); ?>>
                                                <?php _e('Expand/Collapse Sections Only', 'collapsible-sections-learndash'); ?>
                                            </option>
                                        </select>
                                        <svg class="csld-select-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 10L12 15L17 10H7Z" fill="#666"/>
                                        </svg>
                                    </div>
                                    <div class="csld-field-description">
                                        <div class="csld-behavior-options">
                                            <div class="csld-behavior-option">
                                                <strong><?php _e('All Content:', 'collapsible-sections-learndash'); ?></strong>
                                                <?php _e('Expands both sections and lesson content (LearnDash default + sections)', 'collapsible-sections-learndash'); ?>
                                            </div>
                                            <div class="csld-behavior-option">
                                                <strong><?php _e('Sections Only:', 'collapsible-sections-learndash'); ?></strong>
                                                <?php _e('Only expands/collapses section headings, not individual lessons', 'collapsible-sections-learndash'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="csld-form-actions">
                            <button type="submit" class="csld-btn csld-btn-primary" id="csld-save-settings">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3ZM19 19H5V5H16.17L19 7.83V19ZM12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12ZM6 6H15V10H6V6Z" fill="currentColor"/>
                                </svg>
                                <?php _e('Save Settings', 'collapsible-sections-learndash'); ?>
                            </button>
                            
                            <button type="button" class="csld-btn csld-btn-outline" id="csld-reset-settings">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V1L7 6L12 11V7C15.31 7 18 9.69 18 13S15.31 19 12 19 6 16.31 6 13H4C4 17.42 7.58 21 12 21S20 17.42 20 13 16.42 5 12 5Z" fill="currentColor"/>
                                </svg>
                                <?php _e('Reset to Defaults', 'collapsible-sections-learndash'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="csld-sidebar">
            <!-- Quick Actions Card -->
            <div class="csld-card csld-quick-actions-card">
                <div class="csld-card-header">
                    <h3 class="csld-card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 3C13.55 3 14 3.45 14 4V12L15.5 10.5C15.89 10.11 16.56 10.11 16.95 10.5C17.34 10.89 17.34 11.56 16.95 11.95L12.95 15.95C12.56 16.34 11.89 16.34 11.5 15.95L7.5 11.95C7.11 11.56 7.11 10.89 7.5 10.5C7.89 10.11 8.56 10.11 8.95 10.5L10.5 12V4C10.5 3.45 10.95 3 11.5 3H13ZM6 19C6 19.55 6.45 20 7 20H17C17.55 20 18 19.55 18 19S17.55 18 17 18H7C6.45 18 6 18.45 6 19Z" fill="#0073aa"/>
                        </svg>
                        <?php _e('Quick Actions', 'collapsible-sections-learndash'); ?>
                    </h3>
                </div>
                <div class="csld-card-body">
                    <div class="csld-quick-actions">
                        <a href="<?php echo admin_url('admin.php?page=csld-settings'); ?>" class="csld-quick-action">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8C13.1 8 14 8.9 14 10S13.1 12 12 12 10 11.1 10 10 10.9 8 12 8ZM12 14C13.1 14 14 14.9 14 16S13.1 18 12 18 10 17.1 10 16 10.9 14 12 14ZM12 2C13.1 2 14 2.9 14 4S13.1 6 12 6 10 5.1 10 4 10.9 2 12 2Z" fill="currentColor"/>
                            </svg>
                            <span><?php _e('Plugin Settings', 'collapsible-sections-learndash'); ?></span>
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=learndash-lms'); ?>" class="csld-quick-action">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7L12 12L22 7L12 2ZM2 17L12 22L22 17M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                            <span><?php _e('LearnDash Settings', 'collapsible-sections-learndash'); ?></span>
                        </a>
                        <a href="<?php echo admin_url('edit.php?post_type=sfwd-courses'); ?>" class="csld-quick-action">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V5H19V19ZM17 12H7V10H17V12ZM13 16H7V14H13V16ZM17 8H7V6H17V8Z" fill="currentColor"/>
                            </svg>
                            <span><?php _e('Manage Courses', 'collapsible-sections-learndash'); ?></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- How It Works Card -->
            <div class="csld-card csld-info-card">
                <div class="csld-card-header">
                    <h3 class="csld-card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z" fill="#10b981"/>
                        </svg>
                        <?php _e('How It Works', 'collapsible-sections-learndash'); ?>
                    </h3>
                </div>
                <div class="csld-card-body">
                    <div class="csld-feature-list">
                        <div class="csld-feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="#10b981"/>
                            </svg>
                            <span><?php _e('Course sections are collapsed by default', 'collapsible-sections-learndash'); ?></span>
                        </div>
                        <div class="csld-feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="#10b981"/>
                            </svg>
                            <span><?php _e('Students can click to expand/collapse sections', 'collapsible-sections-learndash'); ?></span>
                        </div>
                        <div class="csld-feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="#10b981"/>
                            </svg>
                            <span><?php _e('Improves course navigation and reduces clutter', 'collapsible-sections-learndash'); ?></span>
                        </div>
                        <div class="csld-feature-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="#10b981"/>
                            </svg>
                            <span><?php _e('Works with all LearnDash themes and templates', 'collapsible-sections-learndash'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Card -->
            <div class="csld-card csld-support-card">
                <div class="csld-card-header">
                    <h3 class="csld-card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 19H11V17H13V19ZM15.07 11.25L14.17 12.17C13.45 12.9 13 13.5 13 15H11V14.5C11 13.4 11.45 12.4 12.17 11.67L13.41 10.41C13.78 10.05 14 9.55 14 9C14 7.9 13.1 7 12 7S10 7.9 10 9H8C8 6.79 9.79 5 12 5S16 6.79 16 9C16 9.88 15.64 10.68 15.07 11.25Z" fill="#f59e0b"/>
                        </svg>
                        <?php _e('Need Help?', 'collapsible-sections-learndash'); ?>
                    </h3>
                </div>
                <div class="csld-card-body">
                    <p class="csld-support-text">
                        <?php _e('Get help with setup, customization, or troubleshooting. Our team is here to help you succeed.', 'collapsible-sections-learndash'); ?>
                    </p>
                    <div class="csld-support-actions">
                        <a href="https://swrice.com/collapsible-sections-for-learndash/" target="_blank" class="csld-btn csld-btn-outline csld-btn-small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V5H19V19ZM17 12H7V10H17V12ZM13 16H7V14H13V16ZM17 8H7V6H17V8Z" fill="currentColor"/>
                            </svg>
                            <?php _e('Documentation', 'collapsible-sections-learndash'); ?>
                        </a>
                        <a href="https://swrice.com/contact-us/" target="_blank" class="csld-btn csld-btn-secondary csld-btn-small">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                            </svg>
                            <?php _e('Contact Support', 'collapsible-sections-learndash'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
