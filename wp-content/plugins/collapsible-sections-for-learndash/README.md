# Collapsible Sections for LearnDash

**Version 1.0** - A powerful WordPress plugin that transforms LearnDash course pages by adding intelligent collapsible section functionality. Display only section headings by default with smooth expandable content, creating a cleaner and more organized learning experience.

## ✨ Key Features

### 🎯 **Core Functionality**
- **Collapsible Section Headings**: Shows only section/topic headings by default for cleaner course navigation
- **Expandable Content**: Click to reveal lessons, topics, and quizzes within each section
- **Smart Section Management**: Automatically organizes course content into logical, collapsible groups

### 🔧 **Advanced Integration**
- **Dual Expand/Collapse Behaviors**: 
  - **"All Content" (Default)**: Expands both LearnDash content AND custom sections
  - **"Sections Only"**: Expands only custom sections, keeps LearnDash content collapsed
- **Perfect LearnDash Integration**: Works seamlessly with LearnDash's native "Expand All" functionality
- **Template Override System**: Uses proper LearnDash template override system that survives plugin updates

### 🎨 **User Experience**
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Accessibility Support**: Full keyboard navigation, ARIA attributes, and screen reader compatibility
- **Smooth Animations**: CSS transitions for expand/collapse actions
- **Clean UI**: Matches LearnDash's existing design language perfectly

### ⚙️ **Admin Features**
- **Settings Panel**: Easy-to-use admin interface for configuration
- **Behavior Control**: Switch between "All Content" and "Sections Only" modes
- **Real-time Preview**: See changes immediately without page refresh

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The plugin will automatically work on LearnDash course pages

## 🚀 How It Works

### 🔄 **Expand/Collapse Behaviors**

#### **"All Content" Mode (Default)**
- **Expand All**: Expands both LearnDash lessons/topics/quizzes AND custom sections
- **Individual Sections**: Can be expanded/collapsed independently
- **Perfect Sync**: Works alongside LearnDash's native functionality
- **Complete Experience**: Users see everything when they click "Expand All"

#### **"Sections Only" Mode**
- **Expand All**: Only expands custom section headings
- **LearnDash Content**: Remains collapsed regardless of main button state
- **Focused Navigation**: Users see only section structure, not individual lessons
- **Override Mode**: Completely overrides LearnDash's expand functionality

### 🛠️ **Technical Implementation**
- **Template Override System**: Uses LearnDash's `learndash_template` filter for update-safe customization
- **Smart Click Interception**: Intercepts "Expand All" clicks BEFORE LearnDash processes them
- **MutationObserver**: Watches for state changes to maintain perfect synchronization
- **Event Namespacing**: Uses unique event namespaces to avoid conflicts

### 📋 **Default Behavior**
- **Course Page Load**: Only section headings are visible by default
- **Section Click**: Expands to show lessons, topics, and quizzes in that section
- **Expand All Button**: Behavior depends on selected mode (All Content vs Sections Only)
- **Responsive**: Adapts perfectly to all screen sizes

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

## 📋 Requirements & Compatibility

### **System Requirements**
- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **LearnDash**: 3.0+ (LD30 template system required)

### **Theme Compatibility**
- ✅ **BuddyBoss Theme**: Fully tested and optimized
- ✅ **LearnDash Themes**: Compatible with all official LearnDash themes
- ✅ **Custom Themes**: Works with any theme using LearnDash 3.0 templates
- ✅ **Popular Themes**: Tested with Astra, GeneratePress, and other popular themes

### **Browser Support**
- ✅ Chrome 60+
- ✅ Firefox 55+
- ✅ Safari 12+
- ✅ Edge 79+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 📝 Changelog

### **Version 1.0** - *Latest Release*

#### **🎉 Major Features Added**
- **Dual Expand/Collapse Behaviors**: Complete implementation of both "All Content" and "Sections Only" modes
- **Perfect LearnDash Integration**: Seamless integration with LearnDash's native "Expand All" functionality
- **Smart Click Interception**: Advanced timing system that intercepts clicks BEFORE LearnDash processes them
- **Admin Settings Panel**: Full-featured admin interface for behavior configuration

#### **🔧 Technical Improvements**
- **MutationObserver Integration**: Real-time state synchronization between plugin and LearnDash
- **Event Namespacing**: Unique event namespaces prevent conflicts with other plugins
- **Template Override System**: Update-safe template customization using LearnDash filters
- **Responsive Design**: Mobile-first approach with perfect cross-device compatibility

#### **🐛 Bug Fixes**
- **Expand All Conflict Resolution**: Fixed issue where "Expand All" wouldn't show topics/quizzes in collapsed sections
- **State Synchronization**: Perfect sync between main expand button and individual sections
- **Memory Optimization**: Improved performance and reduced memory footprint

#### **🧹 Code Quality**
- **Debug Code Removal**: All console.log and debug messages removed for production
- **Code Cleanup**: Removed unnecessary comments and optimized file structure
- **Version Standardization**: Updated all version references to 1.0

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
