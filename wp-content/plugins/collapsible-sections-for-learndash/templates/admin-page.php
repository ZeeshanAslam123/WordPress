<?php
/**
 * Admin page template
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

<div class="wrap">
    <h1><?php _e('Collapsible Sections for LearnDash', 'collapsible-sections-learndash'); ?></h1>
    <p><?php _e('Configure the collapsible sections settings for your LearnDash courses.', 'collapsible-sections-learndash'); ?></p>

    <form id="csld-settings-form" method="post">
        <?php wp_nonce_field('csld_settings_nonce', 'csld_nonce'); ?>
        
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="enable_plugin">
                            <?php _e('Enable Plugin', 'collapsible-sections-learndash'); ?>
                        </label>
                    </th>
                    <td>
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
                        <p class="description">
                            <?php _e('Turn the collapsible sections feature on or off. When disabled, normal LearnDash functionality will be used instead.', 'collapsible-sections-learndash'); ?>
                        </p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="toggler_outer_color">
                            <?php _e('Toggler Outer Color', 'collapsible-sections-learndash'); ?>
                        </label>
                    </th>
                    <td>
                        <input 
                            type="text" 
                            id="toggler_outer_color" 
                            name="toggler_outer_color" 
                            value="<?php echo esc_attr($settings['toggler_outer_color']); ?>" 
                            class="csld-color-picker"
                        />
                        <p class="description">
                            <?php _e('Background color for the section toggle icons.', 'collapsible-sections-learndash'); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="toggler_inner_color">
                            <?php _e('Toggler Inner Color', 'collapsible-sections-learndash'); ?>
                        </label>
                    </th>
                    <td>
                        <input 
                            type="text" 
                            id="toggler_inner_color" 
                            name="toggler_inner_color" 
                            value="<?php echo esc_attr($settings['toggler_inner_color']); ?>" 
                            class="csld-color-picker"
                        />
                        <p class="description">
                            <?php _e('Inner fill color for the section toggle icons.', 'collapsible-sections-learndash'); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="section_background_color">
                            <?php _e('Section Background Color', 'collapsible-sections-learndash'); ?>
                        </label>
                    </th>
                    <td>
                        <input 
                            type="text" 
                            id="section_background_color" 
                            name="section_background_color" 
                            value="<?php echo esc_attr($settings['section_background_color']); ?>" 
                            class="csld-color-picker"
                        />
                        <p class="description">
                            <?php _e('Background color for the collapsible sections.', 'collapsible-sections-learndash'); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>
    </form>
</div>

