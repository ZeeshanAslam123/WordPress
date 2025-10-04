# Collapsible Sections for LearnDash

Transform your LearnDash course sections into collapsible, user-friendly navigation. Improve course UX by showing only section headings by default, with expandable content on demand.

## Description

**Collapsible Sections for LearnDash** is a premium WordPress plugin that enhances the user experience of your LearnDash courses by making course sections collapsible. Instead of showing all lessons at once, students see only section headings by default and can expand sections as needed.

### Key Features

- **🎯 Improved Course Navigation** - Reduce visual clutter and help students focus
- **🎨 Customizable Colors** - Match your site's design with custom toggler and background colors
- **⚡ Lightweight & Fast** - Minimal impact on page load times
- **🔧 Easy Setup** - Works out of the box with all LearnDash themes
- **♿ Accessibility Ready** - Full keyboard navigation and ARIA support
- **📱 Mobile Responsive** - Perfect experience on all devices
- **🔄 LearnDash Integration** - Works seamlessly with existing LearnDash functionality

## Installation

1. Upload the plugin files to `/wp-content/plugins/collapsible-sections-for-learndash/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Navigate to **LearnDash > Collapsible Sections** to configure settings

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- LearnDash LMS plugin (any version)

## Configuration

### Admin Settings

Access the plugin settings under **LearnDash > Collapsible Sections** in your WordPress admin:

- **Toggler Color** - Customize the color of section toggle icons
- **Section Background Color** - Set the background color for expanded sections

### Color Customization

The plugin includes a user-friendly color picker interface that allows you to:
- Choose custom colors that match your site design
- Preview changes in real-time
- Reset to default colors anytime

## How It Works

1. **Default State**: Course sections appear collapsed, showing only section headings
2. **User Interaction**: Students click section headings to expand/collapse content
3. **Smooth Animation**: Sections expand and collapse with smooth transitions
4. **State Management**: Sections remember their state during the session
5. **Accessibility**: Full keyboard navigation support with proper ARIA attributes

## Technical Details

### File Structure
```
collapsible-sections-for-learndash/
├── assets/
│   ├── css/
│   │   ├── collapsible-sections.css
│   │   └── admin.css
│   └── js/
│       ├── collapsible-sections.js
│       └── admin.js
├── includes/
│   ├── class-settings.php
│   └── class-template-override.php
├── templates/
│   ├── admin-page.php
│   └── section.php
└── collapsible-sections-for-learndash.php
```

### Template Override System

The plugin uses LearnDash's template override system to safely modify section display without affecting core files. This ensures:
- **Update Safety** - Plugin updates won't break your customizations
- **Theme Compatibility** - Works with any LearnDash-compatible theme
- **Clean Uninstall** - No leftover modifications when deactivated

### JavaScript Architecture

- **Namespace Isolation** - All functionality uses unique selectors to avoid conflicts
- **Event Management** - Proper event binding and cleanup
- **Performance Optimized** - Minimal DOM manipulation and efficient event handling
- **Accessibility First** - Full keyboard navigation and screen reader support

## Compatibility

### LearnDash Versions
- ✅ LearnDash 3.x
- ✅ LearnDash 4.x
- ✅ All future versions (uses stable API)

### WordPress Themes
- ✅ BuddyBoss Theme
- ✅ Astra Pro
- ✅ LearnDash themes
- ✅ Most WordPress themes

### Page Builders
- ✅ Elementor
- ✅ Beaver Builder
- ✅ Gutenberg
- ✅ Classic Editor

## Troubleshooting

### Common Issues

**Q: Sections aren't collapsing**
A: Ensure LearnDash is active and you're viewing a course page. Check browser console for JavaScript errors.

**Q: Colors aren't applying**
A: Clear any caching plugins and check that custom CSS isn't overriding the plugin styles.

**Q: Plugin deactivated automatically**
A: This happens when LearnDash is deactivated. Reactivate LearnDash first, then reactivate this plugin.

### Debug Mode

Enable WordPress debug mode to see detailed logging:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Support

For support, feature requests, or bug reports:
- 📧 Email: support@example.com
- 🐛 GitHub Issues: [Report a bug](https://github.com/swrice/collapsible-sections-for-learndash/issues)
- 📖 Documentation: [View docs](https://github.com/swrice/collapsible-sections-for-learndash)

## Changelog

### 1.0.0
- Initial release
- Core collapsible functionality
- Admin color customization
- LearnDash dependency management
- Full accessibility support

## License

This plugin is licensed under the GPL v2 or later.

## Author

**Swrice** - [GitHub Profile](https://github.com/swrice)

---

*Transform your LearnDash courses into a more organized, user-friendly learning experience with Collapsible Sections for LearnDash.*

