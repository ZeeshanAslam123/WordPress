# Swrice Gutenberg Page Builder

A modern Gutenberg block-based plugin for creating professional plugin landing pages. This is the next-generation version of the original Swrice Plugin Page Manager, rebuilt from the ground up using modern WordPress block editor technology.

## Features

✅ **Modern Gutenberg Blocks** - Built with React and modern WordPress standards  
✅ **12+ Configurable Sections** - Hero, Problem, Solution, Features, Testimonials, FAQ, and more  
✅ **Drag & Drop Section Management** - Reorder sections with intuitive interface  
✅ **Professional Design** - Beautiful, responsive design with Inter font  
✅ **Easy Content Management** - Inline editing with block editor controls  
✅ **Mobile Responsive** - Looks great on all devices  
✅ **SEO Optimized** - Clean, semantic HTML structure  

## Installation

1. Upload the plugin files to `/wp-content/plugins/swrice-gutenberg-page-builder/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Create a new page or post and add the "Plugin Page Builder" block
4. Configure your sections using the block settings in the sidebar

## Development

### Requirements
- Node.js 16+ 
- npm or yarn
- WordPress 5.0+
- PHP 7.4+

### Build Process
```bash
# Install dependencies
npm install

# Start development server
npm run start

# Build for production
npm run build
```

### File Structure
```
src/
├── index.js                 # Main entry point
├── blocks/
│   └── plugin-page-builder/
│       ├── block.json       # Block configuration
│       ├── edit.js          # Editor component
│       └── save.js          # Frontend save function
├── components/
│   ├── SectionManager.js    # Section ordering/management
│   └── sections/            # Individual section components
└── assets/
    ├── css/                 # Stylesheets
    └── js/                  # JavaScript files
```

## Available Sections

1. **Hero Section** - Plugin name, subtitle, pricing, CTA buttons
2. **Problem Section** - Highlight customer pain points
3. **Solution Section** - Present your plugin as the solution
4. **How It Works** - Step-by-step process
5. **Features** - Key plugin features with icons
6. **Testimonials** - Customer reviews and ratings
7. **FAQ** - Frequently asked questions
8. **Bonuses** - Additional value propositions
9. **Guarantee** - Money-back guarantee or promises
10. **Why Choose Us** - Competitive advantages
11. **About** - Company/developer information
12. **Final CTA** - Last chance call-to-action

## Customization

### CSS Variables
The plugin uses CSS custom properties for easy theming:

```css
:root {
    --page-bg: #fbfdff;
    --card-bg: #ffffff;
    --muted: #6b747b;
    --accent: #5fa0d8;
    --accent-dark: #4a8bbd;
    --text: #1f2b33;
    --soft: #f3f7fb;
    --shadow: 0 10px 30px rgba(29,42,63,0.06);
}
```

### Block Attributes
All content is stored as block attributes, making it easy to programmatically access and modify:

```javascript
// Access block attributes
const { pluginName, heroSubtitle, featureItems } = attributes;

// Update attributes
setAttributes({ pluginName: 'New Plugin Name' });
```

## Migration from Original Plugin

If you're migrating from the original Swrice Plugin Page Manager:

1. Export your existing plugin pages
2. Create new pages using this block
3. Copy content from the old meta boxes to the new block controls
4. The styling and layout will be preserved

## Support

For support, feature requests, or bug reports, please visit:
- [Plugin Documentation](https://swrice.com/docs)
- [Support Forum](https://swrice.com/support)
- [GitHub Issues](https://github.com/swrice/gutenberg-page-builder)

## Changelog

### 1.0.0
- Initial release
- Complete recreation of original plugin as Gutenberg blocks
- Modern React-based architecture
- Improved user experience with inline editing
- Mobile-responsive design
- All original features preserved and enhanced

## License

GPL v2 or later - https://www.gnu.org/licenses/gpl-2.0.html

## Credits

Built with ❤️ by the Swrice team using:
- WordPress Block Editor
- React
- Inter Font by Google Fonts
- Modern CSS Grid and Flexbox
