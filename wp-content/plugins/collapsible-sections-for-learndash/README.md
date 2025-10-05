# Collapsible Sections for LearnDash

A WordPress plugin that adds collapsible section functionality to LearnDash course pages, displaying only section headings by default with expandable content.

## Features

- **Collapsible Section Headings**: Shows only section/topic headings by default
- **Expandable Content**: Click to reveal lessons within each section
- **LearnDash 3.0 Template Override**: Uses proper template override system that survives plugin updates
- **Responsive Design**: Works perfectly on desktop and mobile devices
- **Accessibility Support**: Full keyboard navigation and ARIA attributes
- **Expand All Integration**: Works with LearnDash's existing "Expand All" button
- **Clean UI**: Matches LearnDash's existing design language

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The plugin will automatically work on LearnDash course pages

## How It Works

### Template Override System
The plugin uses LearnDash's `learndash_template` filter to override:
- `lesson/partials/section.php` - Section headings with toggle functionality
- `course/listing.php` - Course listing with collapsible sections

### Default Behavior
- **Course Page Load**: Only section headings are visible
- **Section Click**: Expands to show lessons in that section
- **Expand All Button**: Expands/collapses all sections at once

## File Structure

```
collapsible-sections-for-learndash/
├── assets/
│   ├── css/
│   │   ├── collapsible-sections.css    # Frontend styles
│   │   └── admin.css                   # Admin panel styles
│   └── js/
│       ├── collapsible-sections.js     # Frontend functionality
│       └── admin.js                    # Admin panel functionality
├── includes/
│   ├── class-settings.php              # Settings management
│   └── class-template-override.php     # Template override logic
├── templates/
│   ├── admin-page.php                  # Admin settings page
│   ├── section.php                     # Custom section template
│   └── listing.php                     # Custom listing template
├── collapsible-sections-for-learndash.php  # Main plugin file
└── README.md                           # This file
```

## Technical Details

### Template Override Logic
```php
// Override section template
if ($name === 'lesson/partials/section.php' && $this->is_ld30_theme($filepath)) {
    $custom_template = $this->get_custom_template_path('section.php');
    if (file_exists($custom_template)) {
        return $custom_template;
    }
}
```

### JavaScript Functionality
- Uses unique CSS classes to avoid conflicts with LearnDash
- Implements proper event handling with `stopImmediatePropagation()`
- Provides keyboard accessibility (Enter/Space keys)
- Integrates with LearnDash's Expand All functionality

### CSS Styling
- Matches LearnDash's existing design system
- Uses CSS custom properties for theme compatibility
- Responsive design with mobile optimizations
- Proper z-index management for tooltips

## Compatibility

- **LearnDash**: 3.0+ (LD30 template)
- **WordPress**: 5.0+
- **PHP**: 7.4+
- **Themes**: Compatible with any theme using LearnDash 3.0 templates

## Customization

### Admin Settings
The plugin includes an admin panel at **Settings > Collapsible Sections** with options for:
- Toggle icon colors
- Section background colors
- Animation settings
- Custom CSS

### CSS Customization
Override styles by targeting these classes:
```css
.custom-section-item { /* Section container */ }
.custom-section-toggle-btn { /* Toggle button */ }
.custom-toggle-icon { /* Arrow icon */ }
.custom-section-content { /* Expandable content */ }
```

## Development

### Hooks and Filters
The plugin provides several hooks for customization:
- `csld_before_section_toggle` - Before section toggle
- `csld_after_section_toggle` - After section toggle
- `csld_custom_css` - Filter custom CSS output

### Template Customization
Copy templates to your theme:
```
your-theme/
└── learndash/
    └── ld30/
        ├── lesson/
        │   └── partials/
        │       └── section.php
        └── course/
            └── listing.php
```

## Support

For support and customization requests, please contact the development team.

## Changelog

### Version 1.0.0
- Initial release
- Collapsible section functionality
- LearnDash 3.0 template override system
- Admin settings panel
- Mobile responsive design
- Accessibility support

## License

This plugin is licensed under the GPL v2 or later.

