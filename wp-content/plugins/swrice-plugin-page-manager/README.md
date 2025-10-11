# Swrice Plugin Page Manager

A comprehensive WordPress plugin for creating and managing professional plugin landing pages with custom post types, shortcodes, and SEO-optimized output.

## Features

### 🎯 **Custom Post Type**
- Dedicated "Plugin Pages" post type
- Professional admin interface with tabbed meta boxes
- Easy content management for multiple plugins

### 🎨 **Modern Admin Interface**
- Tabbed interface (Basic Info, Content, Pricing, SEO)
- Character counters for SEO fields
- Auto-save functionality
- Form validation
- Tooltips and help text

### 📱 **SEO-Optimized Output**
- Proper meta tags and schema markup
- Mobile-first responsive design
- Fast loading with optimized CSS/JS
- Accessibility compliant (WCAG 2.1 AA)

### 🛠️ **Shortcode System**
- `[plugin_page id="123"]` - Display complete plugin page
- `[buy_now_button]` - Customizable buy now buttons
- Automatic shortcode generation
- Easy copy-to-clipboard functionality

### 🎨 **Professional Styling**
- Beautiful gradient backgrounds
- Smooth animations and transitions
- Responsive design for all devices
- Professional typography

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Plugin Pages" in your WordPress admin to create your first plugin page

## Usage

### Creating a Plugin Page

1. Navigate to **Plugin Pages > Add New**
2. Enter your plugin title
3. Fill in the content using the tabbed interface:
   - **Basic Info**: Hero subtitle, buy now shortcode
   - **Content**: Problem/solution sections, features, testimonials, FAQ, bonuses
   - **Pricing**: Current and original prices
   - **SEO**: Meta title, description, keywords

### Using Shortcodes

#### Display Plugin Page
```
[plugin_page id="123"]
```

#### Buy Now Button
```
[buy_now_button url="https://your-payment-link.com" text="Buy Now - $97"]
```

### Content Structure

The plugin page template includes these sections:
- **Hero Section**: Title, subtitle, featured image, price display
- **Problem Section**: Pain points your plugin solves
- **Solution Section**: How your plugin addresses the problems
- **Features Section**: Key plugin features and benefits
- **Testimonials**: Customer reviews and social proof
- **FAQ Section**: Common questions and answers
- **Pricing Section**: Professional pricing card
- **Bonuses Section**: Additional value offers
- **Guarantee Section**: Money-back guarantee details
- **Final CTA**: Last chance to convert
- **About Section**: Company/developer information

## Customization

### CSS Classes

The plugin uses prefixed CSS classes for easy customization:
- `.sppm-plugin-page` - Main container
- `.sppm-hero` - Hero section
- `.sppm-section` - Content sections
- `.sppm-pricing-card` - Pricing display
- `.sppm-buy-now-btn` - Buy buttons

### Hooks and Filters

```php
// Modify plugin page content
add_filter('sppm_plugin_page_content', 'your_custom_function');

// Add custom CSS
add_action('wp_head', function() {
    if (is_singular('plugin_page')) {
        echo '<style>/* Your custom CSS */</style>';
    }
});
```

## SEO Features

### Meta Tags
- Automatic meta title and description
- Open Graph tags for social sharing
- Schema.org markup for rich snippets

### Performance
- Minified CSS and JavaScript
- Optimized images
- Fast loading times
- Mobile-first approach

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Modern web browser

## File Structure

```
swrice-plugin-page-manager/
├── swrice-plugin-page-manager.php    # Main plugin file
├── admin/
│   └── meta-boxes/
│       └── plugin-details.php        # Admin meta box template
├── templates/
│   └── plugin-page-template.php      # Frontend template
├── assets/
│   ├── css/
│   │   ├── frontend.css               # Frontend styles
│   │   └── admin.css                  # Admin styles
│   └── js/
│       ├── frontend.js                # Frontend JavaScript
│       └── admin.js                   # Admin JavaScript
└── README.md                          # This file
```

## Shortcode Reference

### Plugin Page Shortcode
```
[plugin_page id="123"]
```
**Parameters:**
- `id` (required): The ID of the plugin page post

### Buy Now Button Shortcode
```
[buy_now_button url="#" text="Buy Now" class="custom-class" target="_blank"]
```
**Parameters:**
- `url`: Link URL (default: "#")
- `text`: Button text (default: "Buy Now")
- `class`: CSS class (default: "sppm-buy-now-btn")
- `target`: Link target (default: "_blank")

## Support

For support and feature requests, please contact:
- Email: support@swrice.com
- Website: https://swrice.com

## Changelog

### Version 1.0.0
- Initial release
- Custom post type for plugin pages
- Shortcode system
- SEO optimization
- Responsive design
- Admin interface

## License

This plugin is licensed under the GPL v2 or later.

## Credits

Developed by [Swrice](https://swrice.com) - Premium WordPress plugins for online educators and course creators.
