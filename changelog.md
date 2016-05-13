# Auberge Changelog

## 2.0

* **Add**: Nested Food Menu sections support
* **Add**: Option to display a specific Food Menu section on Food Menu page template
* **Add**: Support for HTML in Food Menu section description
* **Add**: Sticky food menu sections navigation
* **Add**: Advanced Custom Fields plugin support
* **Add**: Documentation in theme folder
* **Add**: New theme options in customizer
* **Add**: WordPress 4.5 logo support
* **Add**: WordPress 4.5 customizer selective refresh support
* **Update**: Much more accessible headings structure (with a single H1 tag per page)
* **Update**: Optimized files and improved file organization
* **Update**: Library v2.0
* **Update**: Improved and optimized styles and scripts
* **Update**: Improved support for child themes
* **Update**: Responsive breakpoints
* **Update**: Enabled table of contents for pages
* **Update**: Documentation design and content
* **Update**: Removed edit links from front-end
* **Update**: Improved support for Polylang and WPML plugin
* **Update**: Improved support for Beaver Builder page builder plugin
* **Update**: Scripts: ImagesLoaded 4.1.0, Slick slider 1.5.9
* **Update**: Improved files loading
* **Update**: Improved theme customizer experience and options organization
* **Update**: Simplified implementation of Theme Hook Alliance hooks, added missing hooks
* **Update**: Social icons display (added "Back to top" button)
* **Update**: Improved icon font loading
* **Update**: Removed PHP constants
* **Update**: Localization
* **Fix**: Language selector styling issue on Internet Explorer browsers
* **Fix**: Minor style issues
* **Fix**: Header and navigation styles
* **Fix**: Schema.org microformats
* **Fix**: Google Recipe view

#### Files changed:

	*.*
	All the files have been changed and reorganized.


## 1.4.8

* **Add**: WordPress 4.3 support
* **Add**: Touch enabled navigation, accessible with Tab key
* **Update**: Updated scripts: TGM Plugin Activation 2.5.2, Slick 1.5.8
* **Update**: Improved featured image size setup for pages
* **Update**: Licensed under GPLv3
* **Update**: Admin interface
* **Update**: Improved food menu sections navigation for better controlability via custom code
* **Update**: Support for Custom Fields for Restaurant Reservations plugin
* **Update**: Documentation (user manual)
* **Fix**: Google Fonts URL function subset issue
* **Fix**: Fixed issue with masonry footer layout when using Jetpack's infinite scroll

#### Files changed:

	license.txt
	readme.md
	style.css
	css/admin.css
	css/customizer.css
	inc/setup-theme-options.php
	inc/setup.php
	inc/customizer/customizer.php
	inc/lib/admin.php
	inc/lib/core.php
	inc/tgmpa/class-tgm-plugin-activation.php
	js/scripts-global.js
	js/scripts-navigation.js


## 1.4.7

* **Update**: Removed `utm_source` from theme credits URL
* **Update**: Localization
* **Fix**: Made "Donate" word translatable

#### Files changed:

	inc/setup-theme-options.php
	languages/sk_SK.mo
	languages/sk_SK.po
	languages/xx_XX.pot


## 1.4.6

* **Fix**: `wmhook_entry_image_link` is not applied correctly on page content

#### Files changed:

	content-page.php


## 1.4.5

* **Update**: TGM Plugin Activation 2.4.2
* **Update**: Removing `example.html` Genericons file
* **Update**: Prefixed custom theme image sizes
* **Update**: Using new prefixed image sizes
* **Update**: Enqueuing `comment-reply.js` the right way
* **Update**: Saving image size setup into theme mod, not individual options
* **Update**: Removing obsolete constants

#### Files changed:

	content-featured-post.php
	functions.php
	genericons/example.html
	inc/setup.php
	inc/setup-theme-options.php
	inc/lib/admin.php
	inc/lib/core.php
	inc/tgmpa/class-tgm-plugin-activation.php


## 1.4.4

* **Fix**: Food menu sections on-page navigation not displaying after 1.4 theme update

#### Files changed:

	inc/setup.php


## 1.4.3

* **Update**: TGM Plugin Activation 2.4.1
* **Update**: Beaver Builder compatibility
* **Update**: Starter CSS

#### Files changed:

	css/starter.css
	inc/beaver-builder/beaver-builder.php
	inc/tgmpa/class-tgm-plugin-activation.php


## 1.4.2

* **Fix**: Condense posts thumbnail size issue introduced in version 1.4.1

#### Files changed:

	inc/setup.php


## 1.4.1

* **Update**: Localization

#### Files changed:

	languages/sk_SK.mo
	languages/sk_SK.po
	languages/xx_XX.pot

## 1.4

* **Add**: Static mobile menu button
* **Update**: Tightened security
* **Update**: Improved code
* **Update**: Improved image sizes setup
* **Update**: Improved Google Fonts setup
* **Update**: Remove obsolete constants and `loop-singular.php` file
* **Update**: Library updated
* **Update**: Scripts: Slick 1.5.0, Starter CSS 1.4
* **Fix**: Comments display on posts list
* **Fix**: Sticky header CSS3 animation
* **Fix**: Beaver Builder front page styles

#### Files changed:

	comments.php
	content-food-menu.php
	content-page.php
	content.php
	functions.php
	image.php
	style.css
	css/colors.css
	css/starter.css
	inc/setup-theme-options.php
	inc/setup.php
	inc/customizer/customizer.php
	inc/lib/core.php
	inc/tgmpa/class-tgm-plugin-activation.php
	js/scripts-global.js


## 1.3.3

* **Update**: Editor stylesheet
* **Update**: Code optimization
* **Fix**: Filter names and passed arguments
* **Fix**: Sticky header appear animation

#### Files changed:

	style.css
	css/editor-style.css
	inc/setup.php


## 1.3.2

* **Fix**: Food menu on-page sections navigation

#### Files changed:

	js/scripts.js


## 1.3.1

* **Fix**: Localization

#### Files changed:

	inc/lib/core.php
	languages/sk_SK.mo
	languages/sk_SK.po
	languages/xx_XX.pot


## 1.3

* **Add**: Support for Restaurant Reservations plugin
* **Add**: Support for NS Featured Posts plugin to populate banner slideshow
* **Add**: Post Views Count plugin support
* **Add**: Responsive styles for logo images
* **Add**: Styles for trackbacks/pingbacks
* **Update**: Improved Beaver Builder page builder support
* **Update**: Optimized code
* **Update**: Updated TGM Plugin Activation script
* **Update**: Updated default `header.jpg` image
* **Update**: Improved Customizer organization and functionality
* **Update**: Styles - using `starter.css` for basic styles
* **Update**: Scripts
* **Update**: Updated copyright year in files
* **Update**: Removed `readme.txt` file in favour for `readme.md`
* **Update**: Localization files
* **Update**: User manual updates
* **Fix**: Minor styles fixes
* **Fix**: Hiding food menu titles on homepage when using Beaver Builder
* **Fix**: Food menu sections taxonomy pages display

#### Files changed:

	content-featured-post.php
	content-food-menu.php
	content-page.php
	content.php
	functions.php
	image.php
	loop-blog-condensed.php
	loop-food-menu.php
	loop.php
	sidebar.php
	style.css
	css/_custom.css
	css/colors.css
	css/customizer.css
	css/starter.css
	inc/setup-theme-options.php
	inc/setup.php
	inc/beaver-builder/beaver-builder.php
	inc/custom-header/custom-header.php
	inc/customizer/customizer.php
	inc/jetpack/jetpack.php
	inc/lib/admin.php
	inc/lib/core.php
	inc/lib/hooks.php
	inc/tgmpa/class-tgm-plugin-activation.php
	inc/tgmpa/plugins.php
	js/scripts.js


## 1.2.5

* **Add**: Beaver Builder recommendation into plugins notice
* **Fix**: Masonry blog layout

#### Files changed:

	inc/tgmpa/plugins.php
	js/customizer-preview.js
	js/scripts.js


## 1.2

* **Add**: Support for Beaver Builder page builder plugin
* **Add**: Full compatibility with WordPress 4.1
* **Add**: Demo content file download via online theme user manual
* **Add**: Development versions of jQuery plugins
* **Add**: Jetpack responsive videos support
* **Update**: Code improvements and optimization
* **Update**: Underscores updates implemented
* **Update**: Reorganized Customizer sections into panels
* **Update**: Updated hook names that weren't following naming convention
* **Update**: Removed obsolete functions and hooks
* **Update**: Removed demo content XML file from the theme folder
* **Update**: User manual updated
* **Update**: Improved styles
* **Update**: Updated localization
* **Update**: Visual editor addons improved
* **Update**: Updated JavaScript files
* **Update**: Added proper escaping for Customizer output CSS
* **Fix**: Hook names
* **Fix**: Submenu plus icon position
* **Fix**: Postlist article hover custom border color not applied
* **Fix**: Added link to access posts with no title

#### Files changed:

	archive.php
	functions.php
	header.php
	sidebar-footer.php
	css/_custom.css
	inc/setup-theme-options.php
	inc/setup.php
	inc/beaver-builder/beaver-builder.php
	inc/customizer/customizer.php
	inc/jetpack/jetpack.php
	inc/lib/admin.php
	inc/lib/core.php
	inc/lib/visual-editor.php
	js/customizer-preview.js
	js/scripts.js
	js/skip-link-focus-fix.js
	js/dev/imagesloaded.pkgd.js
	js/dev/slick.js


## 1.1.5

* **Update**: Customizer to support WP4.1

#### Files changed:

	inc/customizer/customizer.php


## 1.1

* **Add**: Fixed header on window scroll
* **Add**: Slovak localization file
* **Add**: Email icon to social links menu
* **Add**: Smooth window scroll on anchor links
* **Add**: Support for breadcrumbs plugin
* **Add**: Support for shortcodes in Text widget
* **Update**: Improved code structure and notes
* **Update**: Improved theme localization
* **Update**: The custom CSS filter hook name
* **Update**: Custom singular JS output
* **Update**: Mobile pagination styling
* **Update**: Tagcloud styles
* **Update**: Copyright info in readme file
* **Update**: Minor style issues
* **Update**: Stylesheet structure (colors grouped together)
* **Update**: Front page Food menu section button title
* **Update**: Localization
* **Update**: Removed unnecessary hooks
* **Fix**: Jetpack related posts styling
* **Fix**: Nested ordered lists styling
* **Fix**: Styling issues
* **Fix**: Filter hook names

#### Files changed:

	archive.php
	comments.php
	content-food-menu.php
	content-page.php
	content.php
	functions.php
	image.php
	loop-banner.php
	loop-blog-condensed.php
	loop-food-menu.php
	searchform.php
	style.css
	css/_custom.css
	css/colors.css
	css/editor-styles.css
	inc/setup.php
	inc/setup-theme-options.php
	inc/customizer/customizer.php
	inc/customizer/controls/class-WM_Customizer_Hidden.php
	inc/customizer/controls/class-WM_Customizer_HTML.php
	inc/customizer/controls/class-WM_Customizer_Image.php
	inc/customizer/controls/class-WM_Customizer_Multiselect.php
	inc/customizer/controls/class-WM_Customizer_Select.php
	inc/customizer/controls/class-WM_Customizer_Textarea.php
	inc/jetpack/jetpack.php
	inc/lib/admin.php
	inc/lib/core.php
	inc/tgmpa/plugins.php
	js/scripts.js
	languages/readme.md
	languages/sk_SK.mo
	languages/sk_SK.po
	languages/wm_domain.pot


## 1.0

* Initial release.
