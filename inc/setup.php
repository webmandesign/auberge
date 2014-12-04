<?php
/**
 * Theme setup
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 *
 * CONTENT:
 * -  10) Actions and filters
 * -  20) Global variables
 * -  30) Theme setup
 * -  40) Assets and design
 * -  50) Site global markup
 * - 100) Other functions
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Styles and scripts
			add_action( 'init',               'wm_register_assets',       10   );
			add_action( 'wp_enqueue_scripts', 'wm_enqueue_assets',        100  );
			add_action( 'wp_enqueue_scripts', 'wm_post_nav_background',   110  );
			add_action( 'wp_footer',          'wm_footer_custom_scripts', 9998 );
		//Theme setup
			add_action( 'after_setup_theme', 'wm_setup',                      10 );
			add_action( 'after_setup_theme', 'wm_food_menu_page_template_id', 20 );
		//Content width
			add_action( 'template_redirect', 'wm_content_width' );
		//Page templates
			add_action( 'save_post', 'wm_food_menu_page_template_transient_flusher', 10 );
		//Register widget areas
			add_action( 'widgets_init', 'wm_register_widget_areas', 1 );
		//Pagination fallback
			add_action( 'wmhook_postslist_after', 'wm_pagination', 10 );
		//Website sections
			//DOCTYPE
				add_action( 'wmhook_html_before',          'wm_doctype',                    10   );
			//HEAD
				add_action( 'wp_head',                     'wm_head',                       1    );
			//Body
				add_action( 'wmhook_body_top',             'wm_site_top',                   10   );
				add_action( 'wmhook_body_bottom',          'wm_site_bottom',                100  );
			//Header
				add_action( 'wmhook_header_top',           'wm_header_top',                 10   );
				add_action( 'wmhook_header',               'wm_logo',                       10   );
				add_action( 'wmhook_header',               'wm_navigation',                 20   );
				add_action( 'wmhook_header',               'wm_menu_social',                30   );
				add_action( 'wmhook_header_bottom',        'wm_header_bottom',              10   );
			//Content
				add_action( 'wmhook_content_top',          'wm_content_top',                10   );
				add_action( 'wmhook_entry_container_atts', 'wm_entry_container_atts',       10   );
				add_action( 'wmhook_entry_top',            'wm_post_title',                 10   );
				add_action( 'wmhook_entry_top',            'wm_entry_top',                  20   );
				add_action( 'wmhook_entry_bottom',         'wm_entry_bottom',               10   );
				add_action( 'wmhook_entry_bottom',         'wm_sticky_label',               20   );
				add_action( 'wmhook_content_bottom',       'wm_content_bottom',             100  );
			//Footer
				add_action( 'wmhook_footer_top',           'wm_footer_top',                 100  );
				add_action( 'wmhook_footer',               'wm_footer',                     100  );
				add_action( 'wmhook_footer_bottom',        'wm_footer_bottom',              100  );
			//Front page content
				add_action( 'after_setup_theme',           'wm_front_page_sections',        100  );
				add_action( 'wmhook_content_before',       'wm_front_page_widgets',         10   );
				add_action( 'wmhook_content_top',          'wm_front_page_sections_top',    10   );
				add_action( 'wmhook_content_bottom',       'wm_front_page_sections_bottom', 10   );
		//Additional page sections links
			add_action( 'wmhook_loop_food_menu_postslist_after',      'wm_food_menu_more_link', 10 );
			add_action( 'wmhook_loop_blog_condensed_postslist_after', 'wm_blog_more_link',      10 );
		//Jetpack
			add_action( 'after_setup_theme',     'wm_jetpack',                         30  );
			add_action( 'admin_enqueue_scripts', 'wm_jetpack_styles_admin',            100 );
			add_action( 'wp',                    'wm_jetpack_remove_food_menu_markup', 10  );

		//Remove actions
			remove_action( 'wp_head', 'wp_generator'     );
			remove_action( 'wp_head', 'wlwmanifest_link' );



	/**
	 * Filters
	 */

		//BODY classes
			add_filter( 'body_class', 'wm_body_classes', 98 );
		//[gallery] shortcode modifications
			add_filter( 'post_gallery',              'wm_shortcode_gallery_assets', 10, 2 );
			add_filter( 'use_default_gallery_style', '__return_false'                     );
		//Navigation improvements
			add_filter( 'nav_menu_css_class',       'wm_nav_item_classes', 10, 3 );
			add_filter( 'walker_nav_menu_start_el', 'wm_nav_item_process', 10, 4 );
		//Excerpt modifications
			add_filter( 'the_excerpt',                        'wm_remove_shortcodes',        10 );
			add_filter( 'the_excerpt',                        'wm_excerpt',                  20 );
			add_filter( 'excerpt_length',                     'wm_excerpt_length',           10 );
			add_filter( 'excerpt_more',                       'wm_excerpt_more',             10 );
			add_filter( 'wmhook_wm_excerpt_continue_reading', 'wm_excerpt_continue_reading', 10 );
		//Custom CSS fonts
			add_filter( 'wmhook_wm_custom_styles_value', 'wm_css_font_name', 10, 2 );
		//Jetpack
			add_filter( 'sharing_show',                'wm_jetpack_sharing',             10, 2 );
			add_filter( 'infinite_scroll_js_settings', 'wm_jetpack_is_js_settings',      10    );
			add_filter( 'wp_insert_post_data',         'wm_jetpack_add_many_food_menus', 10, 2 );

		//Remove filters
			remove_filter( 'widget_title', 'esc_html' );





/**
 * 20) Global variables
 */

	/**
	 * Max content width
	 *
	 * Required here, because we don't set it up in functions.php.
	 * The $content_width is calculated as golden ratio of the site container width.
	 */

		if ( ! isset( $content_width ) || ! $content_width ) {
			global $content_width;
			$content_width = 1020;
		}



		/**
		 * Adjust content_width value for pages with sidebar
		 */
		if ( ! function_exists( 'wm_content_width' ) ) {
			function wm_content_width() {
				if ( ! is_page_template( 'page-template/_fullwidth.php' ) ) {
					$GLOBALS['content_width'] = 1020 * .62;
				}
			}
		} // /wm_content_width



	/**
	 * Theme helper variables
	 *
	 * @param  string $variable Helper variables array key to return
	 * @param  string $key      Additional key if the variable is array
	 */
	if ( ! function_exists( 'wm_helper_var' ) ) {
		function wm_helper_var( $variable, $key = '' ) {
			//Helper variables
				$output = array();

				//Google Fonts
					$output['google-fonts'] = array(
							//No Google Font
								' ' => __( ' - do not use Google Font', 'wm_domain' ),

							//Default theme font
								'optgroup' . 0  => sprintf( __( 'Theme default', 'wm_domain' ), 1 ),
									'Ubuntu:400,300' => 'Ubuntu',
								'/optgroup' . 0 => '',

							//Insipration from http://femmebot.github.io/google-type/
								'optgroup' . 1  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 1 ),
									'Playfair Display' => 'Playfair Display',
									'Fauna One'        => 'Fauna One',
								'/optgroup' . 1 => '',

								'optgroup' . 2  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 2 ),
									'Fugaz One'   => 'Fugaz One',
									'Oleo Script' => 'Oleo Script',
									'Monda'       => 'Monda',
								'/optgroup' . 2 => '',

								'optgroup' . 3  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 3 ),
									'Unica One' => 'Unica One',
									'Vollkorn'  => 'Vollkorn',
								'/optgroup' . 3 => '',

								'optgroup' . 4  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 4 ),
									'Megrim'                  => 'Megrim',
									'Roboto Slab:400,300,100' => 'Roboto Slab',
								'/optgroup' . 4 => '',

								'optgroup' . 5  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 5 ),
									'Open Sans:400,300' => 'Open Sans',
									'Gentium Basic'     => 'Gentium Basic',
								'/optgroup' . 5 => '',

								'optgroup' . 6  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 6 ),
									'Ovo'          => 'Ovo',
									'Muli:300,400' => 'Muli',
								'/optgroup' . 6 => '',

								'optgroup' . 7  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 7 ),
									'Neuton:200,300,400' => 'Neuton',
								'/optgroup' . 7 => '',

								'optgroup' . 8  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 8 ),
									'Quando' => 'Quando',
									'Judson' => 'Judson',
									'Montserrat' => 'Montserrat',
								'/optgroup' . 8 => '',

								'optgroup' . 9  => sprintf( __( 'Recommendation #%d', 'wm_domain' ), 9 ),
									'Ultra'                => 'Ultra',
									'Stint Ultra Expanded' => 'Stint Ultra Expanded',
									'Slabo 13px'           => 'Slabo 13px',
								'/optgroup' . 9 => '',

							//Google Fonts selection
								'optgroup' . 10  => sprintf( __( 'Fonts selection', 'wm_domain' ), 10 ),
									'Abril Fatface'             => 'Abril Fatface',
									'Arvo'                      => 'Arvo',
									'Domine'                    => 'Domine',
									'Droid Sans'                => 'Droid Sans',
									'Droid Serif'               => 'Droid Serif',
									'Duru Sans'                 => 'Duru Sans',
									'Inconsolata'               => 'Inconsolata',
									'Josefin Slab:400,300'      => 'Josefin Slab',
									'Lato:400,300,100'          => 'Lato',
									'Lobster'                   => 'Lobster',
									'Merriweather:400,300'      => 'Merriweather',
									'Merriweather Sans:400,300' => 'Merriweather Sans',
									'Metamorphous'              => 'Metamorphous',
									'Michroma'                  => 'Michroma',
									'Monoton'                   => 'Monoton',
									'Nixie One'                 => 'Nixie One',
									'Noto Sans'                 => 'Noto Sans',
									'Numans'                    => 'Numans',
									'Nunito:400,300'            => 'Nunito',
									'Old Standard TT'           => 'Old Standard TT',
									'Open Sans Condensed:300'   => 'Open Sans Condensed',
									'Oswald:400,300'            => 'Oswald',
									'PT Sans'                   => 'PT Sans',
									'PT Serif'                  => 'PT Serif',
									'Quicksand:400,300'         => 'Quicksand',
									'Raleway:400,300,200'       => 'Raleway',
									'Roboto:400,300'            => 'Roboto',
									'Rokkitt'                   => 'Rokkitt',
									'Source Sans Pro:400,300'   => 'Source Sans Pro',
									'Tenor Sans'                => 'Tenor Sans',
									'Ubuntu Condensed'          => 'Ubuntu Condensed',
									'Yanone Kaffeesatz:400,300' => 'Yanone Kaffeesatz',
								'/optgroup' . 10 => '',
						);

				//Google Fonts subsets
					$output['google-fonts-subset'] = array(
							'latin'        => 'Latin',
							'latin-ext'    => 'Latin Extended',
							'cyrillic'     => 'Cyrillic',
							'cyrillic-ext' => 'Cyrillic Extended',
							'greek'        => 'Greek',
							'greek-ext'    => 'Greek Extended',
							'vietnamese'   => 'Vietnamese',
						);

				//Widget areas
					$output['widget-areas'] = array(
							'sidebar' => array(
								'name'        => __( 'Sidebar', 'wm_domain' ),
								'description' => __( 'Page sidebar.', 'wm_domain' ),
							),
							'front-page'  => array(
								'name'        => __( 'Front Page Widgets', 'wm_domain' ),
								'description' => __( 'This widgets area is displayed below the Banner area on the front page (homepage).', 'wm_domain' ),
							),
							'footer'  => array(
								'name'        => __( 'Footer Widgets', 'wm_domain' ),
								'description' => __( 'Masonry layout is used to display footer widgets.', 'wm_domain' ),
							),
						);

			//Output
				$output = apply_filters( 'wmhook_wm_helper_var_output', $output );

				if ( isset( $output[ $variable ] ) ) {
					$output = $output[ $variable ];
					if ( isset( $output[ $key ] ) ) {
						$output = $output[ $key ];
					}
				} else {
					$output = '';
				}

				return $output;
		}
	} // /wm_helper_var





/**
 * 30) Theme setup
 */

	/**
	 * Theme setup
	 */
	if ( ! function_exists( 'wm_setup' ) ) {
		function wm_setup() {

			//Helper variables
				global $content_width;

				//WordPress visual editor CSS stylesheets
					$visual_editor_css = array_filter( (array) apply_filters( 'wmhook_wm_setup_visual_editor_css', array(
							str_replace( ',', '%2C', wm_google_fonts_url( array( 'Ubuntu:400,300' ) ) ),
							add_query_arg( array( 'ver' => WM_THEME_VERSION ), wm_get_stylesheet_directory_uri( 'genericons/genericons.css' ) ),
							add_query_arg( array( 'ver' => WM_THEME_VERSION ), wm_get_stylesheet_directory_uri( 'css/editor-style.css' ) ),
						) ) );

			//Localization
				load_theme_textdomain( 'wm_domain', WM_LANGUAGES );

			//Visual editor styles
				add_editor_style( $visual_editor_css );

			//Feed links
				add_theme_support( 'automatic-feed-links' );

			//Enable HTML5 markup
				add_theme_support( 'html5', array(
						'comment-list',
						'comment-form',
						'search-form',
						'gallery',
						'caption',
					) );

			//Custom menus
				add_theme_support( 'menus' );
				register_nav_menus( apply_filters( 'wmhook_wm_setup_menus', array(
						'primary' => __( 'Primary Menu', 'wm_domain' ),
						'social'  => __( 'Social Links Menu', 'wm_domain' ),
					) ) );

			//Custom header
				add_theme_support( 'custom-header', apply_filters( 'wmhook_wm_setup_custom_background_args', array(
						'default-image' => wm_get_stylesheet_directory_uri( 'images/header.jpg' ),
						'header-text'   => false,
						'width'         => 1640,
						'height'        => 686,
						'flex-height'   => false,
						'flex-width'    => false,
					) ) );

			//Custom background
				add_theme_support( 'custom-background', apply_filters( 'wmhook_wm_setup_custom_background_args', array(
						'default-color' => 'eaecee',
					) ) );

			//Thumbnails support
				add_post_type_support( 'attachment:audio', 'thumbnail' );
				add_post_type_support( 'attachment:video', 'thumbnail' );

				add_theme_support( 'post-thumbnails', array( 'attachment:audio', 'attachment:video' ) );
				add_theme_support( 'post-thumbnails' );

				//Image sizes (x, y, crop)
					add_image_size( 'banner', 1640, 686, true ); //@link http://en.wikipedia.org/wiki/Anamorphic_format
					add_image_size( 'banner-small', absint( $content_width ), absint( $content_width / 2.39 ), true ); //@link http://en.wikipedia.org/wiki/Anamorphic_format

					//Set default WordPress image sizes
						$default_image_sizes = apply_filters( 'wmhook_wm_setup_default_image_sizes', array(
								'thumbnail' => array( 420,                             280, true  ), //Posts list thumbnails
								'medium'    => array( absint( $content_width * .62 ), 9999, false ), //Content width image
								'large'     => array( absint( $content_width       ), 9999, false ), //Single post featured image
							) );

						foreach ( $default_image_sizes as $name => $size ) {
							update_option( $name . '_size_w', $default_image_sizes[ $name ][0] );
							update_option( $name . '_size_h', $default_image_sizes[ $name ][1] );
							update_option( $name . '_crop',   $default_image_sizes[ $name ][2] );
						}

			//WordPress 4.1+
				if ( function_exists( '_wp_render_title_tag' ) ) {
					add_theme_support( 'title-tag' );
				}

		}
	} // /wm_setup





/**
 * 40) Assets and design
 */

	/**
	 * Registering theme styles and scripts
	 */
	if ( ! function_exists( 'wm_register_assets' ) ) {
		function wm_register_assets() {

			/**
			 * Styles
			 */

				$register_styles = apply_filters( 'wmhook_wm_register_assets_register_styles', array(
						'wm-customizer'   => array( get_template_directory_uri() . '/css/customizer.css'              ),
						'wm-genericons'   => array( wm_get_stylesheet_directory_uri( 'genericons/genericons.css' )    ),
						'wm-google-fonts' => array( wm_google_fonts_url()                                             ),
						'wm-stylesheet'   => array( 'src' => get_stylesheet_uri(), 'deps' => array( 'wm-genericons' ) ),
						'wm-slick'        => array( wm_get_stylesheet_directory_uri( 'css/slick.css' )                ),
					) );

				foreach ( $register_styles as $handle => $atts ) {
					$src   = ( isset( $atts['src'] )   ) ? ( $atts['src']   ) : ( $atts[0]           );
					$deps  = ( isset( $atts['deps'] )  ) ? ( $atts['deps']  ) : ( false              );
					$ver   = ( isset( $atts['ver'] )   ) ? ( $atts['ver']   ) : ( WM_SCRIPTS_VERSION );
					$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'all'              );

					wp_register_style( $handle, $src, $deps, $ver, $media );
				}

			/**
			 * Scripts
			 */

				$register_scripts = apply_filters( 'wmhook_wm_register_assets_register_scripts', array(
						'wm-customizer-preview'  => array( 'src' => wm_get_stylesheet_directory_uri( 'js/customizer-preview.js' ), 'deps' => array( 'customizer-preview' ) ),
						'wm-imagesloaded'        => array( wm_get_stylesheet_directory_uri( 'js/imagesloaded.pkgd.min.js' )                                                ),
						'wm-slick'               => array( 'src' => wm_get_stylesheet_directory_uri( 'js/slick.min.js' ), 'deps' => array( 'jquery' )                      ),
						'wm-theme-scripts'       => array( 'src' => wm_get_stylesheet_directory_uri( 'js/scripts.js' ), 'deps' => array( 'jquery', 'wm-imagesloaded' )     ),
						'wm-skip-link-focus-fix' => array( wm_get_stylesheet_directory_uri( 'js/skip-link-focus-fix.js' )                                                  ),
					) );

				foreach ( $register_scripts as $handle => $atts ) {
					$src       = ( isset( $atts['src'] )       ) ? ( $atts['src']       ) : ( $atts[0]           );
					$deps      = ( isset( $atts['deps'] )      ) ? ( $atts['deps']      ) : ( false              );
					$ver       = ( isset( $atts['ver'] )       ) ? ( $atts['ver']       ) : ( WM_SCRIPTS_VERSION );
					$in_footer = ( isset( $atts['in_footer'] ) ) ? ( $atts['in_footer'] ) : ( true               );

					wp_register_script( $handle, $src, $deps, $ver, $in_footer );
				}

			/**
			 * Custom actions
			 */

				do_action( 'wmhook_wm_register_assets' );
		}
	} // /wm_register_assets



	/**
	 * Frontend HTML head assets enqueue
	 */
	if ( ! function_exists( 'wm_enqueue_assets' ) ) {
		function wm_enqueue_assets() {
			//Helper variables
				global $is_IE;

				$enqueue_styles = $enqueue_scripts = array();

				$custom_styles = wm_custom_styles();

			/**
			 * Styles
			 */

				//Google Fonts
					if ( wm_google_fonts_url() ) {
						$enqueue_styles[] = 'wm-google-fonts';
					}
				//Food menu icon for search results
					if (
							is_search()
							&& defined( 'JETPACK__VERSION' )
							&& class_exists( 'Nova_Restaurant' )
						) {
						wp_enqueue_style( 'nova-font',  plugins_url( 'css/nova-font.css', JETPACK__PLUGIN_DIR . 'modules/custom-post-types/nova.php' ), array(), JETPACK__VERSION );
					}
				//Banner slider
					if (
							is_front_page()
							&& wm_has_banner_posts( 2 )
						) {
						$enqueue_styles[] = 'wm-slick';
					}
				//Main
					$enqueue_styles[] = 'wm-stylesheet';

				$enqueue_styles = apply_filters( 'wmhook_wm_enqueue_assets_enqueue_styles', $enqueue_styles, $is_IE );

				foreach ( $enqueue_styles as $handle ) {
					wp_enqueue_style( $handle );
				}

			/**
			 * Styles - inline
			 */

				//Customizer setup custom styles
					if ( $custom_styles ) {
						wp_add_inline_style( 'wm-stylesheet', "\r\n" . $custom_styles . "\r\n" );
					}
				//Custom styles set in post/page 'custom-css' custom field
					if (
							is_singular()
							&& $output = get_post_meta( get_the_ID(), 'custom_css', true )
						) {
						$output = apply_filters( 'wmhook_wm_enqueue_assets_singular_inline_styles', "\r\n\r\n/* Custom singular styles */\r\n" . $output . "\r\n", $is_IE );

						wp_add_inline_style( 'wm-stylesheet', $output . "\r\n" );
					}

			/**
			 * Scripts
			 */

				//Masonry script (in footer and in archives)
					$footer_widgets = wp_get_sidebars_widgets();
					if (
							(
								is_array( $footer_widgets )
								&& isset( $footer_widgets['footer'] )
								&& count( $footer_widgets['footer'] ) > absint( apply_filters( 'wmhook_footer_columns_max_count', 3 ) )
							)
							|| is_archive()
							|| is_front_page()
							|| is_home()
							|| is_search()
						) {
						$enqueue_scripts[] = 'jquery-masonry';
					}
				//Banner slider
					if (
							is_front_page()
							&& wm_has_banner_posts( 2 )
						) {
						$enqueue_scripts[] = 'wm-slick';
					}
				//Global theme scripts
					$enqueue_scripts[] = 'wm-theme-scripts';
				//Skip link focus fix
					$enqueue_scripts[] = 'wm-skip-link-focus-fix';

				$enqueue_scripts = apply_filters( 'wmhook_wm_enqueue_assets_enqueue_scripts', $enqueue_scripts, $is_IE );

				foreach ( $enqueue_scripts as $handle ) {
					wp_enqueue_script( $handle );
				}

				//Put comments reply scripts into footer
					if (
							is_singular()
							&& comments_open()
							&& get_option( 'thread_comments' )
						) {
						wp_enqueue_script( 'comment-reply', false, false, false, true );
					}

			/**
			 * Scripts - inline
			 */

				$scripts_inline = apply_filters( 'wmhook_wm_enqueue_assets_scripts_inline', array( 'text_menu_group_nav' => __( '&uarr; Menu sections', 'wm_domain' ) ) );

				wp_localize_script( 'wm-theme-scripts', '$scriptsInline', $scripts_inline );

			/**
			 * Custom actions
			 */

				do_action( 'wmhook_wm_enqueue_assets', $is_IE );
		}
	} // /wm_enqueue_assets



	/**
	 * HTML Body classes
	 *
	 * @param  array $classes
	 */
	if ( ! function_exists( 'wm_body_classes' ) ) {
		function wm_body_classes( $classes ) {
			//Helper variables
				$body_classes = array();

			//Preparing output
				//Sintular?
					if ( ! is_front_page() ) {
						$body_classes[0] = 'not-front-page';
					}

				//Sintular?
					if ( is_singular() ) {
						$body_classes[10] = 'is-singular';
					}

				//Has featured image?
					if ( is_singular() && has_post_thumbnail() ) {
						$body_classes[20] = 'has-post-thumbnail';
					}

				//Is posts list?
					if ( is_archive() || is_search() ) {
						$body_classes[30] = 'is-posts-list';
					}

			//Output
				$body_classes = array_filter( (array) apply_filters( 'wmhook_wm_body_classes_output', $body_classes ) );
				$classes      = array_merge( $classes, $body_classes );

				asort( $classes );

				return $classes;
		}
	} // /wm_body_classes



	/**
	 * Add featured image as background image to post navs
	 */
	if ( ! function_exists( 'wm_post_nav_background' ) ) {
		function wm_post_nav_background() {
			//Requrements check
				if ( ! is_single() ) {
					return;
				}

			//Helper variables
				$output   = '';
				$previous = ( is_attachment() ) ? ( get_post( get_post()->post_parent ) ) : ( get_adjacent_post( false, '', true ) );
				$next     = get_adjacent_post( false, '', false );

				if (
						is_attachment()
						&& 'attachment' == $previous->post_type
					) {
					return;
				}

			//Preparing output
				if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
					$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'banner-small' );
					$output .= '.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }';
				}

				if ( $next && has_post_thumbnail( $next->ID ) ) {
					$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'banner-small' );
					$output .= '.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }';
				}

			//Output
				wp_add_inline_style( 'wm-stylesheet', apply_filters( 'wmhook_wm_post_nav_background_output', $output ) . "\r\n" );
		}
	} // /wm_post_nav_background





/**
 * 50) Site global markup
 */

	/**
	 * Website DOCTYPE
	 */
	if ( ! function_exists( 'wm_doctype' ) ) {
		function wm_doctype() {
			//Helper variables
				$output = '<!doctype html>';

			//Output
				echo apply_filters( 'wmhook_wm_doctype_output', $output );
		}
	} // /wm_doctype



	/**
	 * Website HEAD
	 */
	if ( ! function_exists( 'wm_head' ) ) {
		function wm_head() {
			//Helper variables
				global $is_IE;

				$output = array();

			//Preparing output
				$output[10] = '<meta charset="' . get_bloginfo( 'charset' ) . '" />';
				$output[20] = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
				$output[30] = '<link rel="profile" href="http://gmpg.org/xfn/11" />';
				$output[40] = '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />';

				//Filter output array
					$output = apply_filters( 'wmhook_wm_head_output_array', $output );

			//Output
				echo apply_filters( 'wmhook_wm_head_output', implode( "\r\n", $output ) . "\r\n" );
		}
	} // /wm_head



	/**
	 * Body top
	 */
	if ( ! function_exists( 'wm_site_top' ) ) {
		function wm_site_top() {
			//Helper variables
				$output  = '<div id="page" class="hfeed site">' . "\r\n";
				$output .= "\t" . '<div class="site-inner">' . "\r\n";

			//Output
				echo apply_filters( 'wmhook_wm_site_top_output', $output );
		}
	} // /wm_site_top



		/**
		 * Body bottom
		 */
		if ( ! function_exists( 'wm_site_bottom' ) ) {
			function wm_site_bottom() {
				//Helper variables
					$output  = "\r\n\t" . '</div><!-- /.site-inner -->';
					$output .= "\r\n" . '</div><!-- /#page -->' . "\r\n\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_site_bottom_output', $output );
			}
		} // /wm_site_bottom



	/**
	 * Header top
	 */
	if ( ! function_exists( 'wm_header_top' ) ) {
		function wm_header_top() {
			//Preparing output
				$output = "\r\n\r\n" . '<header id="masthead" class="site-header" role="banner"' . wm_schema_org( 'WPHeader' ) . '>' . "\r\n\r\n";

			//Output
				echo apply_filters( 'wmhook_wm_header_top_output', $output );
		}
	} // /wm_header_top



		/**
		 * Header bottom
		 */
		if ( ! function_exists( 'wm_header_bottom' ) ) {
			function wm_header_bottom() {
				//Helper variables
					$output = "\r\n\r\n" . '</header>' . "\r\n\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_header_bottom_output', $output );
			}
		} // /wm_header_bottom



		/**
		 * Display social links
		 */
		if ( ! function_exists( 'wm_menu_social' ) ) {
			function wm_menu_social() {
				get_template_part( 'menu', 'social' );
			}
		} // /wm_menu_social



	/**
	 * Navigation
	 */
	if ( ! function_exists( 'wm_navigation' ) ) {
		function wm_navigation() {
			//Helper variables
				$output = '';

				$args = apply_filters( 'wmhook_wm_navigation_args', array(
						'theme_location'  => 'primary',
						'container'       => 'div',
						'container_class' => 'menu',
						'menu_class'      => 'menu', //fallback for pagelist
						'echo'            => false,
						'items_wrap'      => '<ul>%3$s</ul>',
					) );

			//Preparing output
				$output .= '<nav id="site-navigation" class="main-navigation" role="navigation"' . wm_schema_org( 'SiteNavigationElement' ) . '>';
					$output .= '<span class="screen-reader-text">' . sprintf( __( '%s site navigation', 'wm_domain' ), get_bloginfo( 'name' ) ) . '</span>';
					$output .= wm_accessibility_skip_link( 'to_content' );
					$output .= '<div class="main-navigation-inner">';
						$output .= wp_nav_menu( $args );
						$output .= '<div id="nav-search-form" class="nav-search-form"><a href="#" id="search-toggle" class="search-toggle"><span class="screen-reader-text">' . __( 'Search', 'wm_domain' ) . '</span></a>' . get_search_form( false ) . '</div>';
					$output .= '</div>';
					$output .= '<button id="menu-toggle" class="menu-toggle">' . __( 'Menu', 'wm_domain' ) . '</button>';
				$output .= '</nav>';

			//Output
				echo apply_filters( 'wmhook_wm_navigation_output', $output );
		}
	} // /wm_navigation



		/**
		 * Navigation item classes
		 */
		if ( ! function_exists( 'wm_nav_item_classes' ) ) {
			function wm_nav_item_classes( $classes, $item, $args ) {
				//Requirements check
					if ( ! isset( $item->title ) ) {
						return $classes;
					}

				//Preparing output
					//Converting array to string for searching the specific class name parts
						$classes = implode( ' ', $classes );

					//General class for active menu
						if ( false !== strpos( $classes, 'current-menu' ) ) {
							$classes .= ' active-menu-item';
						}

					//Converting the string back to array
						$classes = explode( ' ', $classes );

				//Output
					return $classes;
			}
		} // /wm_nav_item_classes



		/**
		 * Navigation item improvements
		 */
		if ( ! function_exists( 'wm_nav_item_process' ) ) {
			function wm_nav_item_process( $item_output, $item, $depth, $args ) {
				//Preparing output
					//Display item description
						if (
								'primary' == $args->theme_location
								&& trim( $item->description )
							) {
							$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . trim( $item->description ) . '</span>' . $args->link_after . '</a>', $item_output );
						}

				//Output
					return $item_output;
			}
		} // /wm_nav_item_process



	/**
	 * Post/page heading (title)
	 *
	 * @param  array $args Heading setup arguments
	 */
	if ( ! function_exists( 'wm_post_title' ) ) {
		function wm_post_title( $args = array() ) {
			//Helper variables
				global $post;

				//Requirements check
					if ( ! ( $title = get_the_title() ) ) {
						return;
					}

				$output = '';

				$args = wp_parse_args( $args, apply_filters( 'wmhook_wm_post_title_defaults', array(
						'class'           => 'entry-title',
						'class_container' => 'entry-header',
						'link'            => get_permalink(),
						'output'          => '<header class="{class_container}"><{tag} class="{class}"' . wm_schema_org( 'name' ) . '>{title}</{tag}></header>',
						'tag'             => 'h1',
						'title'           => '<a href="' . get_permalink() . '" rel="bookmark">' . $title . '</a>',
					) ) );

			//Preparing output
				//Singular title (no link applied)
					if (
							is_single()
							|| ( is_page() && 'page' === get_post_type() ) //not to display the below stuff on posts list on static front page
						) {

						if ( $suffix = wm_paginated_suffix( 'small' ) ) {
							$args['title'] .= $suffix;
						} else {
							$args['title'] = $title;
						}

						if ( ( $helper = get_edit_post_link( get_the_ID() ) ) && is_page() ) {
							$args['title'] .= ' <a href="' . esc_url( $helper ) . '" class="entry-edit" title="' . esc_attr( sprintf( __( 'Edit the "%s"', 'wm_domain' ), the_title_attribute( array( 'echo' => false ) ) ) ) . '"><span>' . __( 'Edit', 'wm_domain' ) . '</span></a>';
						}

					}

				//Food Menus CPT title
					if ( 'nova_menu_item' === get_post_type() ) {

						$args['class_container'] .= ' food-menu-item-header';

						//Food menu items title tag
							if ( ! is_single() ) {
								$args['tag'] = 'h3';
							}

						//Check whether we have post content and set the link accordingly
							$permalink = array( '', '' );
							$content   = trim( strip_tags( get_the_content() ) );

							if ( $content ) {
								$permalink = array( '<a href="' . get_permalink() . '">', '</a>' );
							}

						$args['title']  = $permalink[0];
						$args['title'] .= '<span class="food-menu-item-title">' . $title . '</span>';
						$args['title'] .= '<span class="food-menu-item-price">' . strip_tags( get_post_meta( get_the_ID(), 'nova_price', true ) ) . '</span>';
						$args['title'] .= $permalink[1];

					}

				//Filter processed $args
					$args = apply_filters( 'wmhook_wm_post_title_args', $args );

				//Generating output HTML
					$replacements = apply_filters( 'wmhook_wm_post_title_replacements', array(
							'{class}'           => esc_attr( $args['class'] ),
							'{class_container}' => esc_attr( $args['class_container'] ),
							'{tag}'             => esc_attr( $args['tag'] ),
							'{title}'           => do_shortcode( $args['title'] ),
						) );
					$output = strtr( $args['output'], $replacements );

			//Output
				echo apply_filters( 'wmhook_wm_post_title_output', $output );
		}
	} // /wm_post_title



	/**
	 * Content top
	 */
	if ( ! function_exists( 'wm_content_top' ) ) {
		function wm_content_top() {
			//Helper variables
				$output  = "\r\n\r\n" . '<div id="content" class="site-content">';
				$output .= "\r\n\t"   . '<div id="primary" class="content-area">';
				$output .= "\r\n\t\t" . '<main id="main" class="site-main clearfix" role="main">' . "\r\n\r\n";

			//Output
				echo apply_filters( 'wmhook_wm_content_top_output', $output );
		}
	} // /wm_content_top



		/**
		 * Content bottom
		 */
		if ( ! function_exists( 'wm_content_bottom' ) ) {
			function wm_content_bottom() {
				//Helper variables
					$output  = "\r\n\r\n\t\t" . '</main><!-- /#main -->';
					$output .= "\r\n\t"       . '</div><!-- /#primary -->';
					$output .= "\r\n"         . '</div><!-- /#content -->' . "\r\n\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_content_bottom_output', $output );
			}
		} // /wm_content_bottom



		/**
		 * Front page widgets area
		 */
		if ( ! function_exists( 'wm_front_page_widgets' ) ) {
			function wm_front_page_widgets() {
				if ( is_front_page() && ! is_paged() ) {
					get_sidebar( 'front-page' );
				}
			}
		} // /wm_front_page_widgets




		/**
		 * Additional front page action hook - above page content
		 */
		if ( ! function_exists( 'wm_front_page_sections_top' ) ) {
			function wm_front_page_sections_top() {
				if ( is_front_page() && ! is_paged() ) {
					do_action( 'wmhook_front_page_sections_top' );
				}
			}
		} // /wm_front_page_sections_top




			/**
			 * Additional front page action hook - below page content
			 */
			if ( ! function_exists( 'wm_front_page_sections_bottom' ) ) {
				function wm_front_page_sections_bottom() {
					if ( is_front_page() && ! is_paged() ) {
						echo '<div class="clear"></div>';
						do_action( 'wmhook_front_page_sections_bottom' );
					}
				}
			} // /wm_front_page_sections_bottom




			/**
			 * Display Simple Blog loop
			 */
			if ( ! function_exists( 'wm_loop_blog_condensed' ) ) {
				function wm_loop_blog_condensed() {
					get_template_part( 'loop', 'blog-condensed' );
				}
			} // /wm_loop_blog_condensed



			/**
			 * Display Food Menu loop
			 */
			if ( ! function_exists( 'wm_loop_food_menu' ) ) {
				function wm_loop_food_menu() {
					get_template_part( 'loop', 'food-menu' );
				}
			} // /wm_loop_food_menu




			/**
			 * Setting up front page sections
			 */
			if ( ! function_exists( 'wm_front_page_sections' ) ) {
				function wm_front_page_sections() {
					//Helper variable
						$hooks = array(
								'blog-condensed' => array( '-' ),
								'food-menu'      => array( '-' ),
								'_customizer'    => array( get_theme_mod( 'layout-blog-condensed' ), get_theme_mod( 'layout-food-menu' ) ),
							);

						if ( $hooks['_customizer'][0] && 'posts' !== get_option( 'show_on_front' ) ) {
							$hooks['blog-condensed'] = array_filter( explode( '|', (string) $hooks['_customizer'][0] ) );
						}
						if ( $hooks['_customizer'][1] ) {
							$hooks['food-menu'] = array_filter( explode( '|', (string) $hooks['_customizer'][1] ) );
						}

					//Output
						if ( '-' != $hooks['blog-condensed'][0] ) {
							add_action( 'wmhook_front_page_sections_' . $hooks['blog-condensed'][0], 'wm_loop_blog_condensed', $hooks['blog-condensed'][1] );
						}
						if ( '-' != $hooks['food-menu'][0] ) {
							add_action( 'wmhook_front_page_sections_' . $hooks['food-menu'][0], 'wm_loop_food_menu', $hooks['food-menu'][1] );
						}
				}
			} // /wm_front_page_sections



		/**
		 * Entry container attributes
		 */
		if ( ! function_exists( 'wm_entry_container_atts' ) ) {
			function wm_entry_container_atts() {
				echo wm_schema_org( 'entry' );
			}
		} // /wm_entry_container_atts



		/**
		 * Entry top
		 */
		if ( ! function_exists( 'wm_entry_top' ) ) {
			function wm_entry_top() {
				//Post meta
					if ( in_array( get_post_type(), apply_filters( 'wmhook_wm_entry_top_meta', array( 'post', 'nova_menu_item' ) ) ) ) {

						if ( is_singular( 'nova_menu_item' ) ) {

							echo wm_post_meta( apply_filters( 'wmhook_wm_entry_top_meta', array(
									'class' => 'entry-meta entry-meta-top',
									'meta'  => array( 'edit', 'date', 'likes' ),
								) ) );

						} elseif ( is_single() ) {

							echo wm_post_meta( apply_filters( 'wmhook_wm_entry_top_meta', array(
									'class' => 'entry-meta entry-meta-top',
									'meta'  => array( 'edit', 'date', 'likes', 'category', 'author' ),
								) ) );

						}

					}
			}
		} // /wm_entry_top



		/**
		 * Entry bottom
		 */
		if ( ! function_exists( 'wm_entry_bottom' ) ) {
			function wm_entry_bottom() {
				//Post meta
					if ( in_array( get_post_type(), apply_filters( 'wmhook_wm_entry_bottom_meta', array( 'post' ) ) ) ) {
						if ( is_single() ) {
							echo wm_post_meta( apply_filters( 'wmhook_wm_entry_bottom_meta', array(
									'class' => 'entry-meta entry-meta-bottom',
									'meta'  => array( 'edit', 'tags' ),
								) ) );
						} else {
							echo wm_post_meta( apply_filters( 'wmhook_wm_entry_bottom_meta', array(
									'class'       => 'entry-meta',
									'meta'        => array( 'date', 'comments', 'likes' ),
									'date_format' => 'j M Y',
								) ) );
						}
					}

				//Post navigation
					if ( in_array( get_post_type(), apply_filters( 'wmhook_wm_entry_bottom_post_nav', array( 'post' ) ) ) ) {
						wm_post_nav();
					}

				//Comments
					if ( ! ( is_page() && is_front_page() ) ) {
						comments_template( '', true );
					}
			}
		} // /wm_entry_bottom



		/**
		 * Sticky post label
		 */
		if ( ! function_exists( 'wm_sticky_label' ) ) {
			function wm_sticky_label() {
				if ( is_sticky() ) {
					echo '<div class="label-sticky" title="' . __( 'This is sticky post', 'wm_domain' ) . '"><i class="genericon genericon-pinned"></i></div>';
				}
			}
		} // /wm_sticky_label



		/**
		 * Excerpt
		 *
		 * Displays the excerpt properly.
		 * If the post is password protected, display a message.
		 * If the post has more tag, display the content appropriately.
		 *
		 * @param  string $excerpt
		 */
		if ( ! function_exists( 'wm_excerpt' ) ) {
			function wm_excerpt( $excerpt ) {
				//Requirements check
					if ( post_password_required() ) {
						if ( ! is_single() ) {
							return sprintf( __( 'This content is password protected. To view it please <a%s>enter the password</a>.', 'wm_domain' ), ' href="' . get_permalink() . '"' );
						}
						return;
					}

				//Preparing output
					if (
							! is_single()
							&& wm_has_more_tag()
						) {

						/**
						 * Post has more tag
						 */

							//Required for <!--more--> tag to work
								global $more;
								$more = 0;

							if ( has_excerpt() ) {
								$excerpt = '<p class="post-excerpt has-more-tag">' . get_the_excerpt() . '</p>';
							}
							$excerpt = apply_filters( 'the_content', $excerpt . get_the_content( '' ) );

					} else {

						/**
						 * Default excerpt for posts without more tag
						 */

							$excerpt = strtr( $excerpt, apply_filters( 'wmhook_wm_excerpt_replacements', array( '<p' => '<p class="post-excerpt"' ) ) );

					}

					//Adding "Continue reading" link
						if (
								! is_single()
								&& in_array( get_post_type(), apply_filters( 'wmhook_wm_excerpt_continue_reading_post_type', array( 'post', 'page' ) ) )
							) {
							$excerpt .= apply_filters( 'wmhook_wm_excerpt_continue_reading', '' );
						}

				//Output
					return $excerpt;
			}
		} // /wm_excerpt



			/**
			 * Excerpt length
			 *
			 * @param  absint $length
			 */
			if ( ! function_exists( 'wm_excerpt_length' ) ) {
				function wm_excerpt_length( $length ) {
					return 12;
				}
			} // /wm_excerpt_length



			/**
			 * Excerpt more
			 *
			 * @param  string $more
			 */
			if ( ! function_exists( 'wm_excerpt_more' ) ) {
				function wm_excerpt_more( $more ) {
					return '&hellip;';
				}
			} // /wm_excerpt_more



			/**
			 * Excerpt "Continue reading" text
			 *
			 * @param  string $continue
			 */
			if ( ! function_exists( 'wm_excerpt_continue_reading' ) ) {
				function wm_excerpt_continue_reading( $continue ) {
					return '<div class="link-more"><a href="' . get_permalink() . '">' . sprintf( __( 'Continue reading%s&hellip;', 'wm_domain' ), '<span class="screen-reader-text"> "' . get_the_title() . '"</span>' ) . '</a></div>';
				}
			} // /wm_excerpt_continue_reading



		/**
		 * Previous and next post links
		 */
		if ( ! function_exists( 'wm_post_nav' ) ) {
			function wm_post_nav() {
				//Requirements check
					if ( ! is_singular() || is_page() ) {
						return;
					}

				//Helper variables
					$output = $prev_class = $next_class = '';

					$previous = ( is_attachment() ) ? ( get_post( get_post()->post_parent ) ) : ( get_adjacent_post( false, '', true ) );
					$next     = get_adjacent_post( false, '', false );

				//Requirements check
					if (
							( ! $next && ! $previous )
							|| ( is_attachment() && 'attachment' == $previous->post_type )
						) {
						return;
					}

				//Preparing output
					if ( $previous && has_post_thumbnail( $previous->ID ) ) {
						$prev_class = " has-post-thumbnail";
					}
					if ( $next && has_post_thumbnail( $next->ID ) ) {
						$next_class = " has-post-thumbnail";
					}

					if ( is_attachment() ) {
						$output .= get_previous_post_link( '<div class="nav-previous' . $prev_class . '">%link</div>', __( '<span class="meta-nav">Published In</span><span class="post-title">%title</span>', 'wm_domain' ) );
					} else {
						$output .= get_previous_post_link( '<div class="nav-previous' . $prev_class . '">%link</div>', __( '<span class="meta-nav">Previous</span><span class="post-title">%title</span>', 'wm_domain' ) );
						$output .= get_next_post_link( '<div class="nav-next' . $next_class . '">%link</div>', __( '<span class="meta-nav">Next</span><span class="post-title">%title</span>', 'wm_domain' ) );
					}

					if ( $output ) {
						$output = '<nav class="navigation post-navigation" role="navigation"><h1 class="screen-reader-text">' . __( 'Post navigation', 'wm_domain' ) . '</h1><div class="nav-links">' . $output . '</div></nav>';
					}

				//Output
					echo apply_filters( 'wmhook_wm_post_nav_output', $output );
			}
		} // /wm_post_nav



		/**
		 * Pagination
		 */
		if ( ! function_exists( 'wm_pagination' ) ) {
			function wm_pagination() {
				//Requirements check
					if ( class_exists( 'The_Neverending_Home_Page' ) ) {
						//Don't display pagination if Jetpack Infinite Scroll in use
							return;
					}

				//Helper variables
					global $wp_query, $wp_rewrite;

					$output = '';

					$pagination = array(
							'base'      => @add_query_arg( 'paged', '%#%' ),
							'format'    => '',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $wp_query->max_num_pages,
							'prev_text' => '&laquo;',
							'next_text' => '&raquo;',
						);

				//Preparing output
					if ( $output = paginate_links( $pagination ) ) {
						$output = '<div class="pagination">' . $output . '</div>';
					}

				//Output
					echo $output;
			}
		} // /wm_pagination



		/**
		 * Front page blog more link
		 */
		if ( ! function_exists( 'wm_blog_more_link' ) ) {
			function wm_blog_more_link() {
				if ( $page_for_posts_id = absint( get_option( 'page_for_posts' ) ) ) {
					echo '<div class="archive-link"><a href="' . esc_url( get_permalink( $page_for_posts_id ) ) . '" class="button">' . __( 'All posts', 'wm_domain' ) . '</a></div>';
				}
			}
		} // /wm_blog_more_link



			/**
			 * Front page food menu more link
			 */
			if ( ! function_exists( 'wm_food_menu_more_link' ) ) {
				function wm_food_menu_more_link() {
					$food_menu_page_id = intval( get_transient( 'wm-page-template-food-menu' ) );

					if (
							1 <= $food_menu_page_id
							&& ! is_page_template( 'page-template/_menu.php' )
						) {
						echo '<div class="archive-link"><a href="' . esc_url( get_permalink( $food_menu_page_id ) ) . '" class="button">' . __( 'Menu page', 'wm_domain' ) . '</a></div>';
					}
				}
			} // /wm_food_menu_more_link



	/**
	 * Footer
	 *
	 * Theme author credits:
	 * =====================
	 * It is completely optional, but if you like this WordPress theme,
	 * I would appreciate it if you keep the credit link in the footer.
	 */
	if ( ! function_exists( 'wm_footer' ) ) {
		function wm_footer() {
			//Footer widgets
				get_sidebar( 'footer' );

			//Credits
				echo '<div class="site-footer-area footer-area-site-info">';
					echo '<div class="site-info-container">';
						echo '<div class="site-info" role="contentinfo">';
							echo apply_filters( 'wmhook_wm_credits_output',
									'&copy; ' . date( 'Y' ) . ' <a href="' . home_url( '/' ) . '" title="' . get_bloginfo( 'name' ) . '">' . get_bloginfo( 'name' ) . '</a>. '
									. ' Powered by <a href="https://wordpress.org">' . __( 'WordPress', 'wm_domain' ) . '</a>. '
									. sprintf(
											__( 'Theme by %s.', 'wm_domain' ),
											'<a href="' . esc_url( WM_DEVELOPER_URL ) . '">WebMan Design</a>'
										)
									. ' <a href="#top" id="back-to-top" class="back-to-top">' . __( 'Back to top &uarr;', 'wm_domain' ) . '</a>'
								);
						echo '</div>';
						wm_menu_social();
					echo '</div>';
				echo '</div>';
		}
	} // /wm_footer



		/**
		 * Footer top
		 */
		if ( ! function_exists( 'wm_footer_top' ) ) {
			function wm_footer_top() {
				//Preparing output
					$output = "\r\n\r\n" . '<footer id="colophon" class="site-footer"' . wm_schema_org( 'WPFooter' ) . '>' . "\r\n\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_footer_top_output', $output );
			}
		} // /wm_footer_top



		/**
		 * Footer bottom
		 */
		if ( ! function_exists( 'wm_footer_bottom' ) ) {
			function wm_footer_bottom() {
				//Preparing output
					$output = "\r\n\r\n" . '</footer>' . "\r\n\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_footer_bottom_output', $output );
			}
		} // /wm_footer_bottom



		/**
		 * Website footer custom scripts
		 *
		 * Outputs custom scripts set in post/page 'custom-js' custom field.
		 */
		if ( ! function_exists( 'wm_footer_custom_scripts' ) ) {
			function wm_footer_custom_scripts() {
				//Requirements check
					if (
							! is_singular()
							|| ! $output = get_post_meta( get_the_ID(), 'custom_js', true )
						) {
						return;
					}

				//Helper variables
					$output = "\r\n\r\n<!--Custom singular JS -->\r\n<script type='text/javascript'>\r\n/* <![CDATA[ */\r\n" . wp_unslash( esc_js( $output ) ) . "\r\n/* ]]> */\r\n</script>\r\n";

				//Output
					echo apply_filters( 'wmhook_wm_footer_custom_scripts_output', $output );
			}
		} // /wm_footer_custom_scripts





/**
 * 100) Other functions
 */

	/**
	 * Register predefined widget areas (sidebars)
	 */
	if ( ! function_exists( 'wm_register_widget_areas' ) ) {
		function wm_register_widget_areas() {
			foreach( wm_helper_var( 'widget-areas' ) as $id => $area ) {
				register_sidebar( array(
						'id'            => $id,
						'name'          => $area['name'],
						'description'   => $area['description'],
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>'
					) );
			}
		}
	} // /wm_register_widget_areas



	/**
	 * Include additional JavaScript when [gallery] shortcode used
	 *
	 * Not really satisfied with this solution as we're hooking into filter,
	 * but have no choice as there is no action hook in the gallery_shortcode()
	 * WordPress function.
	 *
	 * @see  wp-includes/media.php > gallery_shortcode()
	 *
	 * @param  string $output
	 * @param  array  $attr
	 */
	if ( ! function_exists( 'wm_shortcode_gallery_assets' ) ) {
		function wm_shortcode_gallery_assets( $output, $attr ) {
			wp_enqueue_script( 'jquery-masonry' );
			return $output;
		}
	} // /wm_shortcode_gallery_assets



	/**
	 * Get the "Food Menu" page template page ID
	 *
	 * Returns -1 when no page ID with the page template found.
	 */
	if ( ! function_exists( 'wm_food_menu_page_template_id' ) ) {
		function wm_food_menu_page_template_id() {
			//Preparing output
				if ( false === ( $cached_page_id = get_transient( 'wm-page-template-food-menu' ) ) ) {

					$cached_page_id = -1;

					$the_query = new WP_Query(array(
						'post_type'      => 'page',
						'posts_per_page' => 1,
						'paged'          => 1,
						'meta_key'       => '_wp_page_template',
						'meta_value'     => 'page-template/_menu.php'
					) );

					if (
							$the_query->have_posts()
							&& isset( $the_query->posts[0]->ID )
						) {
						$cached_page_id = absint( $the_query->posts[0]->ID );
					}

					set_transient( 'wm-page-template-food-menu', $cached_page_id );

				}

			//Output
				return $cached_page_id;
		}
	} // /wm_food_menu_page_template_id



		/**
		 * Flush out the transients used in wm_food_menu_page_template_id
		 */
		if ( ! function_exists( 'wm_food_menu_page_template_transient_flusher' ) ) {
			function wm_food_menu_page_template_transient_flusher() {
				delete_transient( 'wm-page-template-food-menu' );
			}
		} // /wm_food_menu_page_template_transient_flusher



	/**
	 * Font CSS name
	 *
	 * @param  string $value       @see wm_custom_styles_value()
	 * @param  array  $skin_option @see wm_custom_styles_value()
	 */
	if ( ! function_exists( 'wm_css_font_name' ) ) {
		function wm_css_font_name( $value, $skin_option ) {
			//Helper variables
				$helper = wm_helper_var( 'google-fonts' );

			//Preparing output
				if (
						isset( $skin_option['id'] )
						&& false !== strpos( $skin_option['id'], 'font-family' )
						&& is_string( $value )
					) {
					$value = trim( $value );

					if ( isset( $helper[ $value ] ) ) {
						$value = "'" . $helper[ $value ] . "', ";
					}
				}

			//Output
				return $value;
		}
	} // /wm_css_font_name



	/**
	 * Plugins integration
	 */

		/**
		 * Jetpack integration
		 */

			/**
			 * Enables Jetpack features
			 */
			if ( ! function_exists( 'wm_jetpack' ) ) {
				function wm_jetpack() {
					//Site logo
						add_theme_support( 'site-logo' );

					//Food menu post type
						add_theme_support( 'nova_menu_item' );
						add_post_type_support( 'nova_menu_item', array( 'comments' ) );

					//Featured content
						add_theme_support( 'featured-content', apply_filters( 'wmhook_wm_jetpack_featured_content', array(
								'featured_content_filter' => 'wm_get_banner_posts',
								'max_posts'               => 6,
								'post_types'              => array( 'post' ),
							) ) );

					//Infinite scroll
						add_theme_support( 'infinite-scroll', apply_filters( 'wmhook_wm_jetpack_infinite_scroll', array(
								'container'      => 'posts',
								'footer'         => false,
								'posts_per_page' => 6,
								'render'         => 'wm_jetpack_is_render',
								'type'           => 'scroll',
								'wrapper'        => false,
							) ) );
				}
			} // /wm_jetpack



			/**
			 * Jetpack sharing buttons
			 */

				/**
				 * Jetpack sharing display
				 *
				 * @param  bool $show
				 * @param  obj  $post
				 */
				if ( ! function_exists( 'wm_jetpack_sharing' ) ) {
					function wm_jetpack_sharing( $show, $post ) {
						//Helper variables
							global $wp_current_filter;

						//Preparing output
							if ( in_array( 'the_excerpt', (array) $wp_current_filter ) ) {
								$show = false;
							}

						//Output
							return $show;
					}
				} // /wm_jetpack_sharing



			/**
			 * Jetpack infinite scroll
			 */

				/**
				 * Jetpack infinite scroll JS settings array modifier
				 *
				 * @param  array $settings
				 */
				if ( ! function_exists( 'wm_jetpack_is_js_settings' ) ) {
					function wm_jetpack_is_js_settings( $settings ) {
						//Helper variables
							$settings['text'] = esc_js( __( 'Load more&hellip;', 'wm_domain' ) );

						//Output
							return $settings;
					}
				} // /wm_jetpack_is_js_settings



				/**
				 * Jetpack infinite scroll posts renderer
				 */
				if ( ! function_exists( 'wm_jetpack_is_render' ) ) {
					function wm_jetpack_is_render() {
						while ( have_posts() ) :

							the_post();

							$content_type = get_post_format();

							if ( 'nova_menu_item' === get_post_type() ) {
								$content_type = 'food-menu';
							}

							get_template_part( 'content', $content_type );

						endwhile;
					}
				} // /wm_jetpack_is_render



			/**
			 * Jetpack Food Menus CPT
			 */

				/**
				 * Jetpack modify food menus Add Many Items post content/excerpt
				 *
				 * @param  array $data
				 * @param  array $postarr
				 */
				if ( ! function_exists( 'wm_jetpack_add_many_food_menus' ) ) {
					function wm_jetpack_add_many_food_menus( $data, $postarr ) {
						//Helper variables
							global $current_screen;

						//Requirements check
							if (
									'nova_menu_item' !== $data['post_type']
									|| ! isset( $current_screen->id )
									|| 'nova_menu_item_page_add_many_nova_items' !== $current_screen->id
								) {
								return $data;
							}

							if ( ! empty( $_POST['ajax'] ) ) {
								check_ajax_referer( 'nova_many_items' );
							} else {
								check_admin_referer( 'nova_many_items' );
							}

						//Preparing output
							if ( $postarr['post_content'] && empty( $postarr['post_excerpt'] ) ) {
								$data['post_excerpt'] = $data['post_content'];
								$data['post_content'] = '';
							}

						//Output
							return $data;
					}
				} // /wm_jetpack_add_many_food_menus



				/**
				 * Jetpack food menus Add Many Items styles
				 */
				if ( ! function_exists( 'wm_jetpack_styles_admin' ) ) {
					function wm_jetpack_styles_admin() {
						//Helper variables
							global $current_screen;

						//Enqueue (only on a specific admin page)
							if (
									isset( $current_screen->id )
									&& 'nova_menu_item_page_add_many_nova_items' === $current_screen->id
								) {
									wp_add_inline_style( 'nova-font', '.many-items-table input[name="nova_title[]"], .many-items-table textarea { width: 360px; max-width: 100%; } .many-items-table textarea { height: 50px; }' );
							}
					}
				} // /wm_jetpack_styles_admin



				/**
				 * Jetpack remove food menus singlular CPT page markup
				 *
				 * @link  https://wordpress.org/support/topic/novaphp-custom-post-type-single-post-view#post-6244588
				 */
				if ( ! function_exists( 'wm_jetpack_remove_food_menu_markup' ) ) {
					function wm_jetpack_remove_food_menu_markup() {
						if ( class_exists( 'Nova_Restaurant' ) && is_singular( 'nova_menu_item' ) ) {
							remove_filter( 'template_include', array( Nova_Restaurant::init(), 'setup_menu_item_loop_markup__in_filter' ) );
						}
					}
				} // /wm_jetpack_remove_food_menu_markup



				/**
				 * Display Menu Sections custom taxonomy anchor links to navigate through food menu
				 *
				 * @return  HTML Unordered list of taxonomy anchor links.
				 *
				 * @todo  This is being generated with JS for the time while Jetpack doesn't improve manipulation and sorting.
				 */
				if ( ! function_exists( 'wm_jetpack_menu_sections_taxonomy' ) ) {
					function wm_jetpack_menu_sections_taxonomy() {
						//Helper variables
							$output = '';

							$taxonomy_name = apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_name', 'nova_menu' );
							$taxonomy_args = (array) apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_args', array() );

						//Requirements check
							if (
									! class_exists( 'Nova_Restaurant' )
									|| ! taxonomy_exists( $taxonomy_name )
								) {
								return;
							}
						//Preparing output
							$terms = get_terms( $taxonomy_name, $taxonomy_args );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term ) {
									$term_link = '#' . strtolower( str_replace( ' ', '_', esc_html( $term->name ) ) );
									$output .= '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
								}
							}
						//Output
							echo apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_output', '<ul id="menu-group-links" class="taxonomy-links taxonomy-' . $taxonomy_name . '">' . $output . '</ul>' );
					}
				} // /wm_jetpack_menu_sections_taxonomy

?>