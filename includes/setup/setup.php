<?php
/**
 * Theme setup
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.7.1
 *
 * Contents:
 *
 *   1) Required files
 *  10) Global variables
 *  20) Theme setup
 *  30) Assets and design
 *  40) Site global markup
 * 100) Other functions
 * 999) Plugins integration
 */





/**
 * 1) Required files
 */

	// Theme options

		require_once( get_template_directory() . '/includes/theme-options/theme-options.php' );

	// Post media

		require_once( get_template_directory() . '/includes/post-media/post-media.php' );

	// Custom header

		require_once( get_template_directory() . '/includes/custom-header/custom-header.php' );

	// SVG

		require_once( get_template_directory() . '/includes/svg/class-svg.php' );





/**
 * 10) Global variables
 */

	/**
	 * Adjust content_width value for pages with sidebar
	 *
	 * @since    1.0
	 * @version  1.0
	 */
	if ( ! function_exists( 'wm_content_width' ) ) {
		function wm_content_width() {

			// Processing

				$GLOBALS['content_width'] = 1020;

		}
	} // /wm_content_width

	add_action( 'after_setup_theme', 'wm_content_width', -100 );


	/**
	 * Adjust content_width value for pages with sidebar
	 *
	 * @since    1.0
	 * @version  1.0
	 */
	if ( ! function_exists( 'wm_content_width_narrow' ) ) {
		function wm_content_width_narrow() {

			// Processing

				if ( ! is_page_template( 'page-template/_fullwidth.php' ) ) {
					$GLOBALS['content_width'] = 1020 * .62;
				}

		}
	} // /wm_content_width_narrow

	add_action( 'template_redirect', 'wm_content_width_narrow' );



	/**
	 * Theme helper variables
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  string $variable Helper variables array key to return
	 * @param  string $key      Additional key if the variable is array
	 */
	if ( ! function_exists( 'wm_helper_var' ) ) {
		function wm_helper_var( $variable, $key = null ) {

			// Helper variables

				$output = array();

				// Google Fonts

					$i = 0;

					$output['google-fonts'] = array(

							// No Google Font

								' ' => esc_html__( ' - do not use Google Font', 'auberge' ),

							// Default theme font

								'optgroup' . $i  => esc_html_x( 'Theme default', 'Google Font default setup options group title.', 'auberge' ),
									'Ubuntu:400,300' => 'Ubuntu',
								'/optgroup' . $i => '',

							// Insipration from http://femmebot.github.io/google-type/

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Playfair Display' => 'Playfair Display',
									'Fauna One'        => 'Fauna One',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Fugaz One'   => 'Fugaz One',
									'Oleo Script' => 'Oleo Script',
									'Monda'       => 'Monda',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Unica One' => 'Unica One',
									'Vollkorn'  => 'Vollkorn',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Megrim'                  => 'Megrim',
									'Roboto Slab:400,300,100' => 'Roboto Slab',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Open Sans:400,300' => 'Open Sans',
									'Gentium Basic'     => 'Gentium Basic',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Ovo'          => 'Ovo',
									'Muli:300,400' => 'Muli',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Neuton:200,300,400' => 'Neuton',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Quando' => 'Quando',
									'Judson' => 'Judson',
									'Montserrat' => 'Montserrat',
								'/optgroup' . $i => '',

								'optgroup' . ++$i  => sprintf( esc_html_x( 'Recommendation #%d', 'Google Font setup recommendation (numbered) group title.', 'auberge' ), $i ),
									'Ultra'                => 'Ultra',
									'Stint Ultra Expanded' => 'Stint Ultra Expanded',
									'Slabo 13px'           => 'Slabo 13px',
								'/optgroup' . $i => '',

							// Google Fonts selection

								'optgroup' . ++$i  => esc_html_x( 'Fonts selection', 'Title for selection of fonts picked from Google Fontss', 'auberge' ),
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
								'/optgroup' . $i => '',
						);

				// Google Fonts subsets

					$output['google-fonts-subset'] = array(
							'latin'        => 'Latin',
							'latin-ext'    => 'Latin Extended',
							'cyrillic'     => 'Cyrillic',
							'cyrillic-ext' => 'Cyrillic Extended',
							'greek'        => 'Greek',
							'greek-ext'    => 'Greek Extended',
							'vietnamese'   => 'Vietnamese',
						);

				// Widget areas

					$output['widget-areas'] = array(
							'sidebar' => array(
								'name'        => esc_html__( 'Sidebar', 'auberge' ),
								'description' => esc_html__( 'Page sidebar.', 'auberge' ),
							),
							'front-page'  => array(
								'name'        => esc_html__( 'Front Page Widgets', 'auberge' ),
								'description' => esc_html__( 'This widgets area is displayed below the Banner area on the front page (homepage).', 'auberge' ),
							),
							'footer'  => array(
								'name'        => esc_html__( 'Footer Widgets', 'auberge' ),
								'description' => esc_html__( 'Masonry layout is used to display footer widgets.', 'auberge' ),
							),
						);


			// Output

				$output = apply_filters( 'wmhook_wm_helper_var_output', $output );

				if ( isset( $output[ $variable ] ) ) {
					$output = $output[ $variable ];
					if ( null !== $key && isset( $output[ $key ] ) ) {
						$output = $output[ $key ];
					}
				} else {
					$output = '';
				}

				return $output;

		}
	} // /wm_helper_var





/**
 * 20) Theme setup
 */

	/**
	 * Theme setup
	 *
	 * @since    1.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_setup' ) ) {
		function wm_setup() {

			// Helper variables

				$image_sizes = array_filter( apply_filters( 'wmhook_wm_setup_image_sizes', array() ) );

				// WordPress visual editor CSS stylesheets

					$visual_editor_css = array();

					$rtl_suffix = ( is_rtl() ) ? ( '-rtl' ) : ( '' );

					if ( $load_google_fonts = wm_google_fonts_url() ) {
						$visual_editor_css[] = str_replace( ',', '%2C', $load_google_fonts );
					}

					$editor_stylesheets = array(
						'main' . $rtl_suffix,
						'custom-editor',
						'editor-style' . $rtl_suffix,
					);
					foreach ( $editor_stylesheets as $stylesheet ) {
						$visual_editor_css[] = esc_url_raw( add_query_arg(
							array( 'ver' => wp_get_theme( get_template() )->get( 'Version' ) ),
							get_theme_file_uri( 'assets/css/' . $stylesheet . '.css' )
						) );
					}

					$visual_editor_css = array_filter( (array) apply_filters( 'wmhook_wm_setup_visual_editor_css', $visual_editor_css ) );


			// Processing

				// Localization

					/**
					 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
					 */

					// wp-content/languages/theme-name/it_IT.mo

						load_theme_textdomain( 'auberge', trailingslashit( WP_LANG_DIR ) . 'themes/auberge' );

					// wp-content/themes/child-theme-name/languages/it_IT.mo

						load_theme_textdomain( 'auberge', get_stylesheet_directory() . '/languages' );

					// wp-content/themes/theme-name/languages/it_IT.mo

						load_theme_textdomain( 'auberge', get_template_directory() . '/languages' );

				// Declare support for child theme stylesheet automatic enqueuing

					add_theme_support( 'child-theme-stylesheet' );

				// Add editor stylesheets

					add_editor_style( $visual_editor_css );

				// Custom menus

					register_nav_menus( apply_filters( 'wmhook_wm_setup_menus', array(
						'primary' => esc_html__( 'Primary Menu', 'auberge' ),
						'social'  => esc_html__( 'Social Links Menu', 'auberge' ),
					) ) );

				// Post types supports

					add_post_type_support( 'attachment:audio', 'thumbnail' );
					add_post_type_support( 'attachment:video', 'thumbnail' );
					add_post_type_support( 'attachment', 'custom-fields' );

				// Indicate widget sidebars can use selective refresh in the Customizer

					add_theme_support( 'customize-selective-refresh-widgets' );

				// Title tag

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
					 */
					add_theme_support( 'title-tag' );

				// Site logo

					/**
					 * @link  https://codex.wordpress.org/Theme_Logo
					 */
					add_theme_support( 'custom-logo' );

				// Feed links

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
					 */
					add_theme_support( 'automatic-feed-links' );

				// Enable HTML5 markup

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
					 */
					add_theme_support( 'html5', array(
						'comment-list',
						'comment-form',
						'search-form',
						'gallery',
						'caption',
					) );

				// Custom header

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
					 */
					add_theme_support( 'custom-header', apply_filters( 'wmhook_wm_setup_custom_header_args', array(
						'default-text-color' => 'ffffff',
						'header-text'        => true,
						'random-default'     => true,
						'width'              => ( isset( $image_sizes['auberge_banner'] ) ) ? ( $image_sizes['auberge_banner'][0] ) : ( 1920 ),
						'height'             => ( isset( $image_sizes['auberge_banner'] ) ) ? ( $image_sizes['auberge_banner'][1] ) : ( 1080 ),
						'flex-height'        => true,
						'flex-width'         => true,
					) ) );

					// Default custom headers packed with the theme (thumbnail size: 275x155 px)

						register_default_headers( array(

							'header-1' => array(
								'url'           => '%s/assets/images/header/header-1.jpg',
								'thumbnail_url' => '%s/assets/images/header/thumbnail/header-1.jpg',
								'description'   => esc_html_x( 'Coffee machine', 'Header image description.', 'auberge' ),
							),

							'header-2' => array(
								'url'           => '%s/assets/images/header/header-2.jpg',
								'thumbnail_url' => '%s/assets/images/header/thumbnail/header-2.jpg',
								'description'   => esc_html_x( 'Restaurant interior from above', 'Header image description.', 'auberge' ),
							),

							'header-3' => array(
								'url'           => '%s/assets/images/header/header-3.jpg',
								'thumbnail_url' => '%s/assets/images/header/thumbnail/header-3.jpg',
								'description'   => esc_html_x( 'Pouring coffee', 'Header image description.', 'auberge' ),
							),

						) );

				// Custom background

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Background
					 */
					add_theme_support( 'custom-background', apply_filters( 'wmhook_wm_setup_custom_background_args', array(
						'default-color' => 'eaecee',
					) ) );

				// Thumbnails support

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
					 */
					add_theme_support( 'post-thumbnails', array( 'attachment:audio', 'attachment:video' ) );
					add_theme_support( 'post-thumbnails' );

					// Image sizes (x, y, crop)

						if ( ! empty( $image_sizes ) ) {
							foreach ( $image_sizes as $size => $setup ) {
								if ( !in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
									add_image_size(
										$size,
										$image_sizes[ $size ][0],
										$image_sizes[ $size ][1],
										$image_sizes[ $size ][2]
									);
								}
							}
						}

		}
	} // /wm_setup

	add_action( 'after_setup_theme', 'wm_setup', 10 );



	/**
	 * Welcome page
	 */

		require_once( get_template_directory() . '/includes/welcome/welcome.php' );



		/**
		 * Initiate "Welcome" admin notice
		 *
		 * @since    2.2.0
		 * @version  2.2.0
		 */
		if ( ! function_exists( 'wm_activation_admin_notice' ) ) {
			function wm_activation_admin_notice() {

				// Processing

					global $pagenow;

					if (
						is_admin()
						&& 'themes.php' == $pagenow
						&& isset( $_GET['activated'] )
					) {

						add_action( 'admin_notices', 'wm_welcome_admin_notice', 99 );

					}

			}
		} // /wm_activation_admin_notice

		add_action( 'load-themes.php', 'wm_activation_admin_notice' );



		/**
		 * Display "Welcome" admin notice
		 *
		 * @since    2.2.0
		 * @version  2.7.0
		 */
		if ( ! function_exists( 'wm_welcome_admin_notice' ) ) {
			function wm_welcome_admin_notice() {

				// Processing

					get_template_part( 'template-parts/component-notice', 'welcome' );

			}
		} // /wm_welcome_admin_notice



	/**
	 * Setup images
	 */

		/**
		 * Image sizes
		 *
		 * @example
		 *
		 *   $image_sizes = array(
		 *     'image_size_id' => array(
		 *       absint( width ),
		 *       absint( height ),
		 *       (bool) cropped?,
		 *       (string) optional_theme_usage_explanation_text
		 *     )
		 *   );
		 *
		 * @since    1.4
		 * @version  2.0
		 *
		 * @param  array $image_sizes
		 */
		if ( ! function_exists( 'wm_image_sizes' ) ) {
			function wm_image_sizes( $image_sizes = array() ) {

				// Helper variables

					global $content_width;


				// Processing

					$image_sizes = array(
							'thumbnail' => array(
									480,
									280,
									true,
									esc_html__( 'In posts list.', 'auberge' )
								),
							'medium' => array(
									absint( $content_width * .62 ),
									9999,
									false
								),
							'large' => array(
									absint( $content_width ),
									9999,
									false,
									esc_html__( 'In single post page.', 'auberge' )
								),
							'auberge_banner' => array(
									1640,
									686, //@link http://en.wikipedia.org/wiki/Anamorphic_format
									true,
									esc_html__( 'In front page banner.', 'auberge' )
								),
							'auberge_banner_small' => array(
									absint( $content_width ),
									absint( $content_width / 2.39 ), //@link http://en.wikipedia.org/wiki/Anamorphic_format
									true,
									esc_html__( 'In food menu list.', 'auberge' )
								),
						);


				// Output

					return $image_sizes;

			}
		} // /wm_image_sizes

		add_filter( 'wmhook_wm_setup_image_sizes', 'wm_image_sizes' );



		/**
		 * Register recommended image sizes notice
		 *
		 * @since    1.4
		 * @version  1.4
		 */
		if ( ! function_exists( 'wm_image_size_notice' ) ) {
			function wm_image_size_notice() {

				// Processing

					add_settings_field(
							// $id
							'recommended-image-sizes',
							// $title
							'',
							// $callback
							'wm_image_size_notice_html',
							// $page
							'media',
							// $section
							'default',
							// $args
							array()
						);

					register_setting(
							// $option_group
							'media',
							// $option_name
							'recommended-image-sizes',
							// $sanitize_callback
							'esc_attr'
						);

			}
		} // /wm_image_size_notice

		add_action( 'admin_init', 'wm_image_size_notice' );



		/**
		 * Display recommended image sizes notice
		 *
		 * @since    1.4
		 * @version  1.4
		 */
		if ( ! function_exists( 'wm_image_size_notice_html' ) ) {
			function wm_image_size_notice_html() {

				// Helper variables

					$default_image_size_names = array(
							'thumbnail' => esc_html_x( 'Thumbnail size', 'WordPress predefined image size name.', 'auberge' ),
							'medium'    => esc_html_x( 'Medium size', 'WordPress predefined image size name.', 'auberge' ),
							'large'     => esc_html_x( 'Large size', 'WordPress predefined image size name.', 'auberge' ),
						);

					$image_sizes = array_filter( apply_filters( 'wmhook_wm_setup_image_sizes', array() ) );


				// Requirements check

					if ( empty( $image_sizes ) ) {
						return;
					}


				// Output

					// Section styles

						echo '<style type="text/css" media="screen">'
							. '.recommended-image-sizes { display: inline-block; padding: 1.62em; border: 2px solid #dadcde; }'
							. '.recommended-image-sizes h3:first-child { margin-top: 0; }'
							. '.recommended-image-sizes table { margin-top: 1em; }'
							. '.recommended-image-sizes th, .recommended-image-sizes td { width: auto; padding: .19em 1em; border-bottom: 2px dotted #dadcde; vertical-align: top; }'
							. '.recommended-image-sizes thead th { padding: .62em 1em; border-bottom-style: solid; }'
							. '.recommended-image-sizes tr[title] { cursor: help; }'
							. '.recommended-image-sizes .small, .recommended-image-sizes tr[title] th, .recommended-image-sizes tr[title] td { font-size: .81em; }'
							. '</style>';

					// Section HTML

						echo '<div class="recommended-image-sizes">';

							do_action( 'wmhook_wm_image_size_notice_html_top' );

							echo '<h3>' . esc_html__( 'Recommended image sizes', 'auberge' ) . '</h3>'
								. '<p>' . esc_html__( 'For the theme to work correctly, please, set these recommended image sizes:', 'auberge' ) . '</p>';

							echo '<table>';

								echo '<thead>'
									. '<tr>'
									. '<th>' . esc_html__( 'Size name', 'auberge' ) . '</th>'
									. '<th>' . esc_html__( 'Size parameters', 'auberge' ) . '</th>'
									. '<th>' . esc_html__( 'Theme usage', 'auberge' ) . '</th>'
									. '</tr>'
									. '</thead>';

								echo '<tbody>';

									foreach ( $image_sizes as $size => $setup ) {

										$crop = ( $setup[2] ) ? ( esc_html__( 'cropped', 'auberge' ) ) : ( esc_html__( 'scaled', 'auberge' ) );

										if ( isset( $default_image_size_names[ $size ] ) ) {

											echo '<tr><th>' . esc_html( $default_image_size_names[ $size ] ) . ':</th>';

										} else {

											echo '<tr title="' . esc_attr__( 'Additional image size added by the theme. Can not be changed on this page.', 'auberge' ) . '"><th><code>' . esc_html( $size ) . '</code>:</th>';

										}

										echo '<td>' . sprintf(
												esc_html_x( '%1$d &times; %2$d, %3$s', '1: image width, 2: image height, 3: cropped or scaled?', 'auberge' ),
												absint( $setup[0] ),
												absint( $setup[1] ),
												$crop
											) . '</td>'
											. '<td class="small">' . ( ( isset( $setup[3] ) ) ? ( $setup[3] ) : ( '&mdash;' ) ) . '</td>'
											. '</tr>';

									} // /foreach

								echo '</tbody>';

							echo '</table>';

							do_action( 'wmhook_wm_image_size_notice_html_bottom' );

						echo '</div>';

			}
		} // /wm_image_size_notice_html



		/**
		 * Food menu item image link
		 *
		 * @since    2.0
		 * @version  2.0.1
		 *
		 * @param  array $image_link
		 */
		if ( ! function_exists( 'wm_entry_image_link_food_menu' ) ) {
			function wm_entry_image_link_food_menu( $image_link = array() ) {

				// Helper variables

					$post_id = get_the_ID();
					$content = trim( strip_tags( get_the_content() ) );


				// Processing

					if (
							'nova_menu_item' == get_post_type( $post_id )
							&& ! is_single( $post_id )
							&& empty( $content )
						) {

						$image_link = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

					}


				// Output

					return $image_link;

			}
		} // /wm_entry_image_link_food_menu

		add_filter( 'wmhook_entry_image_link', 'wm_entry_image_link_food_menu' );



	/**
	 * Setup typography
	 */

		/**
		 * Google Fonts
		 *
		 * @since    1.4
		 * @version  1.4
		 *
		 * @param  array $fonts_setup
		 */
		if ( ! function_exists( 'wm_google_fonts' ) ) {
			function wm_google_fonts( $fonts_setup ) {

				// Helper variables

					$fonts_setup = array_unique( array_filter( array(
							get_theme_mod( 'font-family-body' ),
							get_theme_mod( 'font-family-headings' )
						) ) );

					if (
							! is_admin()
							&& ! ( function_exists( 'jetpack_get_site_logo' ) && jetpack_get_site_logo( 'id' ) )
							&& get_theme_mod( 'font-family-logo' )
						)  {
						$fonts_setup[] = get_theme_mod( 'font-family-logo' );
					}

					if ( empty( $fonts_setup ) ) {
						$fonts_setup = array( 'Ubuntu:400,300' );
					}


				// Output

					return $fonts_setup;

			}
		} // /wm_google_fonts

		add_filter( 'wmhook_wm_google_fonts_url_fonts_setup', 'wm_google_fonts' );



	/**
	 * Setup widgets
	 */

		/**
		 * Register predefined widget areas (sidebars)
		 *
		 * @since    1.0
		 * @version  2.6.0
		 */
		if ( ! function_exists( 'wm_register_widget_areas' ) ) {
			function wm_register_widget_areas() {

				// Processing

					foreach( wm_helper_var( 'widget-areas' ) as $id => $area ) {
						register_sidebar( array(
							'id'            => $id,
							'name'          => $area['name'],
							'description'   => $area['description'],
							'before_widget' => '<section id="%1$s" class="widget %2$s">',
							'after_widget'  => '</section>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>'
						) );
					}

			}
		} // /wm_register_widget_areas

		add_action( 'widgets_init', 'wm_register_widget_areas', 1 );



	/**
	 * Setup Visual Editor
	 */

		/**
		 * Include Visual Editor (TinyMCE) addons
		 *
		 * @since    1.2
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_visual_editor' ) ) {
			function wm_visual_editor() {

				// Processing

					if (
							is_admin()
							|| isset( $_GET['fl_builder'] )
						) {

						require_once( get_template_directory() . '/library/visual-editor.php' );

					}

			}
		} // /wm_visual_editor

		add_action( 'after_setup_theme', 'wm_visual_editor' );



		/**
		 * Adding additional format dropdown items
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  array $style_formats
		 */
		if ( ! function_exists( 'wm_custom_mce_format_addon' ) ) {
			function wm_custom_mce_format_addon( $style_formats = array() ) {

				// Processing

					unset( $style_formats['100text_styles']['items']['100text_styles140'] );
					unset( $style_formats['100text_styles']['items']['100text_styles150'] );
					unset( $style_formats['100text_styles']['items']['100text_styles160'] );
					unset( $style_formats['100text_styles']['items']['100text_styles170'] );
					unset( $style_formats['100text_styles']['items']['100text_styles180'] );

					$style_formats['100text_styles']['items']['100text_styles090'] = array(
							'title'    => esc_html__( 'Button link', 'auberge' ),
							'selector' => 'a',
							'classes'  => 'button',
							'icon'     => 'link',
						);

					unset( $style_formats['200text_sizes'] );


				// Output

					return $style_formats;

			}
		} // /wm_custom_mce_format_addon

		add_filter( 'wmhook_wm_custom_mce_format', 'wm_custom_mce_format_addon' );





/**
 * 30) Assets and design
 */

	/**
	 * Registering theme styles and scripts
	 *
	 * @since    1.0
	 * @version  2.7.0
	 */
	if ( ! function_exists( 'wm_register_assets' ) ) {
		function wm_register_assets() {

			// Helper variables

				$version = esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) );


			// Processing

				// Styles

					$register_styles = apply_filters( 'wmhook_wm_register_assets_register_styles', array(

						'auberge' => array( 'src' => '' ), // For wp_add_inline_style().

						'genericons-neue' => array( get_theme_file_uri( 'assets/fonts/genericons-neue/genericons-neue.css' ) ),
						'slick'           => array( get_theme_file_uri( 'assets/css/slick.css' ) ),

						'wm-google-fonts' => array( wm_google_fonts_url() ),

						'wm-main'   => array( get_theme_file_uri( 'assets/css/main.css' ) ),
						'wm-custom' => array( get_theme_file_uri( 'assets/css/custom.css' ), 'deps' => array( 'wm-main' ) ),

						'wm-stylesheet' => array( 'src' => get_stylesheet_uri(), 'deps' => array( 'auberge' ) ),
					) );

					foreach ( $register_styles as $handle => $atts ) {
						$src   = ( isset( $atts['src'] )   ) ? ( $atts['src']   ) : ( $atts[0] );
						$deps  = ( isset( $atts['deps'] )  ) ? ( $atts['deps']  ) : ( false    );
						$ver   = ( isset( $atts['ver'] )   ) ? ( $atts['ver']   ) : ( $version );
						$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'all'    );

						wp_register_style( $handle, $src, $deps, $ver, $media );
					}

				// Scripts

					$register_scripts = apply_filters( 'wmhook_wm_register_assets_register_scripts', array(
						'slick'                  => array( 'src' => get_theme_file_uri( 'assets/js/vendor/slick.min.js' ), 'deps' => array( 'jquery' ) ),
						'wm-scripts-global'      => array( 'src' => get_theme_file_uri( 'assets/js/scripts-global.js' ), 'deps' => array( 'jquery', 'imagesloaded', 'wm-scripts-navigation' ) ),
						'wm-scripts-navigation'  => array( get_theme_file_uri( 'assets/js/scripts-navigation.js' ) ),
					) );

					foreach ( $register_scripts as $handle => $atts ) {
						$src       = ( isset( $atts['src'] )       ) ? ( $atts['src']       ) : ( $atts[0] );
						$deps      = ( isset( $atts['deps'] )      ) ? ( $atts['deps']      ) : ( false    );
						$ver       = ( isset( $atts['ver'] )       ) ? ( $atts['ver']       ) : ( $version );
						$in_footer = ( isset( $atts['in_footer'] ) ) ? ( $atts['in_footer'] ) : ( true     );

						wp_register_script( $handle, $src, $deps, $ver, $in_footer );
					}

		}
	} // /wm_register_assets

	add_action( 'wp_enqueue_scripts', 'wm_register_assets', 10 );



	/**
	 * Frontend HTML head assets enqueue
	 *
	 * @since    1.0
	 * @version  2.7.0
	 */
	if ( ! function_exists( 'wm_enqueue_assets' ) ) {
		function wm_enqueue_assets() {

			// Helper variables

				$enqueue_styles = $enqueue_scripts = array();


			// Processing

				// Styles

					// Google Fonts
					if ( wm_google_fonts_url() ) {
						$enqueue_styles[] = 'wm-google-fonts';
					}

					// Food menu icon for search results
					if (
						( is_search() || is_archive() )
						&& defined( 'JETPACK__VERSION' )
						&& class_exists( 'WM_Nova_Restaurant' )
					) {
						wp_enqueue_style( 'nova-font',  plugins_url( 'css/nova-font.css', JETPACK__PLUGIN_DIR . 'modules/custom-post-types/nova.php' ), array(), JETPACK__VERSION );
					}

					// Banner slider
					if (
						is_front_page()
						&& wm_has_banner_posts( 2 )
					) {
						$enqueue_styles[] = 'slick';
					}

					// Main
					$enqueue_styles[] = 'genericons-neue';
					$enqueue_styles[] = 'wm-main';
					$enqueue_styles[] = 'wm-custom';
					$enqueue_styles[] = 'wm-stylesheet';

					$enqueue_styles = apply_filters( 'wmhook_wm_enqueue_assets_enqueue_styles', $enqueue_styles );

					foreach ( $enqueue_styles as $handle ) {
						wp_enqueue_style( $handle );
					}

				// RTL setup

					wp_style_add_data( 'slick', 'rtl', 'replace' );
					wp_style_add_data( 'wm-main', 'rtl', 'replace' );

				// Styles - inline

					// Beaver Builder support
					if ( isset( $_GET['fl_builder'] ) ) {
						$output = apply_filters( 'wmhook_wm_enqueue_assets_styles_inline_beaver_builder', "\r\n"
						          . '.fl-lightbox .fl-builder-settings-fields select { background-image: none; -webkit-appearance: menulist; -moz-appearance: menulist; }'
						          . 'body .fl-builder-lightbox .fl-lightbox { width: 720px; }'
						          . 'body .fl-builder-settings-tab { width: 100%; }'
						          . '.fl-row:not(:hover) { z-index: 0; }'
						          . '.fl-col-content .fl-module:hover { position: relative; z-index: 999; }'
						          . "\r\n" );

						wp_add_inline_style(
							'auberge',
							apply_filters( 'wmhook_esc_css', $output ) . "\r\n"
						);
					}

				// Scripts

					// Masonry script (in footer and in archives)
					$footer_widgets = wp_get_sidebars_widgets();
					if (
						(
							is_array( $footer_widgets )
							&& isset( $footer_widgets['footer'] )
							&& count( $footer_widgets['footer'] ) > absint( apply_filters( 'wmhook_widgets_columns', 3, 'footer' ) )
						)
						|| ( is_archive() && ! is_tax( 'nova_menu' ) )
						|| is_front_page()
						|| is_home()
						|| is_search()
					) {
						$enqueue_scripts[] = 'jquery-masonry';
					}

					// Banner slider
					if (
						is_front_page()
						&& wm_has_banner_posts( 2 )
					) {
						$enqueue_scripts[] = 'slick';
					}

					// Global theme scripts
					$enqueue_scripts[] = 'wm-scripts-global';

					$enqueue_scripts = apply_filters( 'wmhook_wm_enqueue_assets_enqueue_scripts', $enqueue_scripts );

					foreach ( $enqueue_scripts as $handle ) {
						wp_enqueue_script( $handle );
					}

				// Scripts - inline

					$scripts_inline = apply_filters( 'wmhook_wm_enqueue_assets_scripts_inline', array( 'text_menu_group_nav' => esc_html_x( '&uarr; Menu sections', 'Back to food menu sections selectors button title.', 'auberge' ) ) );

					wp_localize_script( 'wm-scripts-global', '$scriptsInline', $scripts_inline );

		}
	} // /wm_enqueue_assets

	add_action( 'wp_enqueue_scripts', 'wm_enqueue_assets', 100 );



	/**
	 * Enqueue comment-reply.js the right way
	 *
	 * @since    1.4.5
	 * @version  1.4.5
	 */
	if ( ! function_exists( 'wm_comment_reply_js_enqueue' ) ) {
		function wm_comment_reply_js_enqueue() {

			// Processing

				if ( get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}

		}
	} // /wm_comment_reply_js_enqueue

	add_action( 'comment_form_before', 'wm_comment_reply_js_enqueue' );



		/**
		 * Customizer preview assets enqueue
		 *
		 * @since    1.4
		 * @version  2.6.0
		 */
		if ( ! function_exists( 'wm_customizer_preview_enqueue_assets' ) ) {
			function wm_customizer_preview_enqueue_assets() {

				// Processing

					wp_enqueue_script(
							'wm-customizer-preview',
							get_theme_file_uri( 'assets/js/customize-preview.js' ),
							array( 'customize-preview' ),
							esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
							true
						);

			}
		} // /wm_customizer_preview_enqueue_assets

		add_action( 'customize_preview_init', 'wm_customizer_preview_enqueue_assets', 10 );



	/**
	 * HTML Body classes
	 *
	 * @since    1.0
	 * @version  2.7.1
	 *
	 * @param  array $classes
	 */
	if ( ! function_exists( 'wm_body_classes' ) ) {
		function wm_body_classes( $classes = array() ) {

			// Helper variables

				$classes = (array) $classes; // Just in case...

				$body_classes = array();

				$i = 0;


			// Processing

				// Is not front page?

					if ( ! is_front_page() ) {
						$body_classes['not-front-page'] = ++$i;
					}

				// Is site branding text displayed?

					if ( 'blank' === get_header_textcolor() ) {
						$body_classes['site-title-hidden'] = ++$i;
					}

				// Singular?

					if ( is_singular() ) {
						$body_classes['is-singular'] = ++$i;
					}

				// Has featured image?

					if ( is_singular() && has_post_thumbnail() ) {
						$body_classes['has-post-thumbnail'] = ++$i;
					}

				// Is posts list?

					if ( is_archive() || is_search() ) {
						$body_classes['is-posts-list'] = ++$i;
					}

				// Featured posts

					if (
							class_exists( 'NS_Featured_Posts' )
							&& (
									is_home()
									|| is_archive()
									|| is_search()
								)
						) {
						$body_classes['has-featured-posts'] = ++$i;
					}


			// Output

				$body_classes = array_filter( (array) apply_filters( 'wmhook_wm_body_classes_output', $body_classes ) );
				$classes      = array_merge( $classes, array_flip( $body_classes ) );

				asort( $classes );

				return $classes;

		}
	} // /wm_body_classes

	add_filter( 'body_class', 'wm_body_classes', 98 );



	/**
	 * Post classes
	 *
	 * @since    1.4
	 * @version  2.1.1
	 *
	 * @param  array $classes
	 */
	if ( ! function_exists( 'wm_post_classes' ) ) {
		function wm_post_classes( $classes ) {

			// Processing

				// A generic class for easy styling

					$classes[] = 'entry';

				// Sticky post

					/**
					 * On paginated posts list the sticky class is not
					 * being applied, so, we need to compensate.
					 */
					if ( is_sticky() ) {
						$classes[] = 'is-sticky';
					}

				// Featured post

					if (
							class_exists( 'NS_Featured_Posts' )
							&& get_post_meta( get_the_ID(), '_is_ns_featured_post', true )
						) {
						$classes[] = 'is-featured';
					}


			// Output

				return $classes;

		}
	} // /wm_post_classes

	add_filter( 'post_class', 'wm_post_classes', 98 );



	/**
	 * Add featured image as background image to post navs
	 *
	 * @since    1.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_post_nav_background' ) ) {
		function wm_post_nav_background() {

			// Requrements check

				if ( ! is_single() ) {
					return;
				}


			// Variables

				$output   = '';
				$previous = ( is_attachment() ) ? ( get_post( get_post()->post_parent ) ) : ( get_adjacent_post( false, '', true ) );
				$next     = get_adjacent_post( false, '', false );

				if (
					is_attachment()
					&& 'attachment' == $previous->post_type
				) {
					return;
				}


			// Processing

				if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
					$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'auberge_banner_small' );
					$output .= '.post-navigation .nav-previous { background-image: url(\'' . esc_url( $prevthumb[0] ) . '\'); }';
				}

				if ( $next && has_post_thumbnail( $next->ID ) ) {
					$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'auberge_banner_small' );
					$output .= '.post-navigation .nav-next { background-image: url(\'' . esc_url( $nextthumb[0] ) . '\'); }';
				}

				$output = apply_filters( 'wmhook_wm_post_nav_background_output', $output );


			// Output

				wp_add_inline_style(
					'auberge',
					apply_filters( 'wmhook_esc_css', $output ) . "\r\n"
				);

		}
	} // /wm_post_nav_background

	add_action( 'wp_enqueue_scripts', 'wm_post_nav_background', 110 );





/**
 * 40) Site global markup
 */

	/**
	 * Website DOCTYPE
	 *
	 * @since    1.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_doctype' ) ) {
		function wm_doctype() {

			// Output

				echo '<!DOCTYPE html>';

		}
	} // /wm_doctype

	add_action( 'tha_html_before', 'wm_doctype', 10 );



	/**
	 * Website HEAD
	 *
	 * @since    1.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_head' ) ) {
		function wm_head() {

			// Helper variables

				$output = array();


			// Processing

				$output[10] = '<meta charset="' . esc_attr( get_bloginfo( 'charset' ) ) . '" />';
				$output[20] = '<meta name="viewport" content="width=device-width, initial-scale=1" />';
				$output[30] = '<link rel="profile" href="http://gmpg.org/xfn/11" />';
				$output[40] = '<link rel="pingback" href="' . esc_attr( get_bloginfo( 'pingback_url' ) ) . '" />';

				// Filter output array

					$output = apply_filters( 'wmhook_wm_head_output_array', $output );


			// Output

				echo implode( "\r\n", $output ) . "\r\n";

		}
	} // /wm_head

	add_action( 'wp_head', 'wm_head', 1 );



	/**
	 * Body top
	 *
	 * @since    1.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_site_top' ) ) {
		function wm_site_top() {

			// Output

				echo '<div id="page" class="hfeed site">' . "\r\n";

		}
	} // /wm_site_top

	add_action( 'tha_body_top', 'wm_site_top', 10 );



		/**
		 * Body bottom
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_site_bottom' ) ) {
			function wm_site_bottom() {

				// Output

					echo "\r\n" . '</div><!-- /#page -->' . "\r\n\r\n";

			}
		} // /wm_site_bottom

		add_action( 'tha_body_bottom', 'wm_site_bottom', 100 );



	/**
	 * Header top
	 *
	 * @since    1.0
	 * @version  2.5.3
	 */
	if ( ! function_exists( 'wm_header_top' ) ) {
		function wm_header_top() {

			// Output

				echo "\r\n\r\n" . '<header id="masthead" class="site-header" ' . wm_schema_org( 'WPHeader' ) . '><div class="site-header-inner">' . "\r\n\r\n";

		}
	} // /wm_header_top

	add_action( 'tha_header_top', 'wm_header_top', 10 );



		/**
		 * Header bottom
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_header_bottom' ) ) {
			function wm_header_bottom() {

				// Output

					echo "\r\n\r\n" . '</div></header>' . "\r\n\r\n";

			}
		} // /wm_header_bottom

		add_action( 'tha_header_bottom', 'wm_header_bottom', 10 );



		/**
		 * Display social links.
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_menu_social' ) ) {
			function wm_menu_social() {

				// Output

					get_template_part( 'template-parts/menu', 'social' );

			}
		} // /wm_menu_social

		add_action( 'tha_header_top', 'wm_menu_social', 130 );



			/**
			 * Social menu args.
			 *
			 * @since    2.5.4
			 * @version  2.5.4
			 *
			 * @param  string $items_wrap
			 */
			function wm_social_menu_args( $items_wrap = '<ul data-id="%1$s" class="%2$s">%3$s</ul>' ) {

				// Output

					return array(
						'theme_location' => 'social',
						'container'      => false,
						'menu_class'     => 'social-links-items',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span><!--{{icon}}-->',
						'fallback_cb'    => false,
						'items_wrap'     => (string) $items_wrap,
					);

			} // /wm_social_menu_args



			/**
			 * Social menu cache key.
			 *
			 * @since    2.5.4
			 * @version  2.5.4
			 */
			function wm_social_cache_key() {

				// Output

					return 'auberge_social_links';

			} // /wm_social_cache_key



			/**
			 * Flush social menu cache.
			 *
			 * @since    2.5.0
			 * @version  2.5.4
			 */
			function wm_social_cache_flush() {

				// Processing

					wp_cache_delete(
						wm_social_cache_key(),
						'auberge_' . get_bloginfo( 'language' )
					);

			} // /wm_social_cache_flush

			add_action( 'wp_update_nav_menu',   'wm_social_cache_flush' );
			add_action( 'customize_save_after', 'wm_social_cache_flush' );
			add_action( 'wmhook_theme_upgrade', 'wm_social_cache_flush' );



			/**
			 * Social links supported icons.
			 *
			 * @since    2.5.0
			 * @version  2.7.1
			 */
			function wm_social_links_icons() {

				// Output

					return array(
						'behance.net'       => 'behance',
						'bitbucket.org'     => 'bitbucket',
						'codepen.io'        => 'codepen',
						'deviantart.com'    => 'deviantart',
						'digg.com'          => 'digg',
						'docker.com'        => 'dockerhub',
						'dribbble.com'      => 'dribbble',
						'dropbox.com'       => 'dropbox',
						'facebook.com'      => 'facebook',
						'flickr.com'        => 'flickr',
						'foursquare.com'    => 'foursquare',
						'plus.google.'      => 'google-plus',
						'google.'           => 'google',
						'github.com'        => 'github',
						'instagram.com'     => 'instagram',
						'linkedin.com'      => 'linkedin',
						'mailto:'           => 'envelope',
						'medium.com'        => 'medium',
						'paypal.com'        => 'paypal',
						'pscp.tv'           => 'periscope',
						'tel:'              => 'phone',
						'pinterest.com'     => 'pinterest',
						'getpocket.com'     => 'get-pocket',
						'reddit.com'        => 'reddit',
						'/feed'             => 'rss',
						'skype.com'         => 'skype',
						'skype:'            => 'skype',
						'slack.com'         => 'slack',
						'slideshare.net'    => 'slideshare',
						'snapchat.com'      => 'snapchat',
						'soundcloud.com'    => 'soundcloud',
						'spotify.com'       => 'spotify',
						'stackoverflow.com' => 'stack-overflow',
						'stumbleupon.com'   => 'stumbleupon',
						'trello.com'        => 'trello',
						'tripadvisor.'      => 'tripadvisor',
						'tumblr.com'        => 'tumblr',
						'twitch.tv'         => 'twitch',
						'twitter.com'       => 'twitter',
						'vimeo.com'         => 'vimeo',
						'vine.co'           => 'vine',
						'vk.com'            => 'vk',
						'wa.me'             => 'whatsapp',
						'wordpress.org'     => 'wordpress',
						'wordpress.com'     => 'wordpress',
						'xing.com'          => 'xing',
						'yelp.com'          => 'yelp',
						'youtube.com'       => 'youtube',
					);

			} // /wm_social_links_icons

			add_filter( 'wmhook_auberge_svg_get_social_icons', 'wm_social_links_icons' );



			/**
			 * Display SVG icons in social links menu.
			 *
			 * Note that the menu has to be set to output `<!--{{icon}}-->` placeholders!
			 *
			 * @since    2.5.0
			 * @version  2.5.4
			 *
			 * @param  string  $item_output The menu item output.
			 * @param  WP_Post $item        Menu item object.
			 * @param  int     $depth       Depth of the menu.
			 * @param  array   $args        wp_nav_menu() arguments.
			 */
			function wm_nav_menu_social_icons( $item_output, $item, $depth, $args ) {

				// Requirements check

					if ( false === strpos( $item_output, '<!--{{icon}}-->' ) ) {
						return $item_output;
					}


				// Variables

					$social_icons = Auberge_SVG::get_social_icons();
					$social_icon  = 'chain';


				// Processing

					foreach ( $social_icons as $url => $icon ) {
						if ( false !== strpos( $item_output, $url ) ) {
							$social_icon = $icon;
							break;
						}
					}

					$item_output = str_replace(
						'<!--{{icon}}-->',
						'<!--{{icon}}-->' . Auberge_SVG::get( array(
							'icon' => esc_attr( $social_icon ),
							'base' => 'social-icon',
						) ),
						$item_output
					);


				// Output

					return $item_output;

			} // /wm_nav_menu_social_icons

			add_filter( 'walker_nav_menu_start_el', 'wm_nav_menu_social_icons', 10, 4 );



			/**
			 * Sets Social menu args for menu in widget.
			 *
			 * Checks whether the menu:
			 * - is associated with `social` location,
			 * - or has "[soc]" in menu title/name (useful for forcing the menu args on any menu in widget).
			 *
			 * @since    2.5.0
			 * @version  2.5.4
			 *
			 * @param  array  $nav_menu_args  An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
			 * @param  string $nav_menu       Nav menu object for the current menu.
			 */
			function wm_social_widget( $nav_menu_args, $nav_menu ) {

				// Variables

					$locations = get_nav_menu_locations();

					$locations['social'] = ( isset( $locations['social'] ) ) ? ( $locations['social'] ) : ( false );


				// Requirements check

					if (
						! isset( $nav_menu->term_id )
						|| (
							false === stripos( $nav_menu->name, '[soc]' )
							&& $locations['social'] !== $nav_menu->term_id
						)
					) {
						return $nav_menu_args;
					}


				// Processing

					$menu_args = wm_social_menu_args();

					$nav_menu_args['container_class'] = 'social-links';
					$nav_menu_args['menu_class']      = 'social-links-items';
					$nav_menu_args['depth']           = $menu_args['depth'];
					$nav_menu_args['link_before']     = $menu_args['link_before'];
					$nav_menu_args['link_after']      = $menu_args['link_after'];
					$nav_menu_args['items_wrap']      = $menu_args['items_wrap'];


				// Output

					return $nav_menu_args;

			} // /wm_social_widget

			add_filter( 'widget_nav_menu_args', 'wm_social_widget', 10, 3 );



	/**
	 * Site navigation
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_menu_primary' ) ) {
		function wm_menu_primary() {

			// Output

				get_template_part( 'template-parts/menu', 'primary' );

		}
	} // /wm_menu_primary

	add_action( 'tha_header_top', 'wm_menu_primary', 120 );



		/**
		 * Menu item classes
		 *
		 * @since    1.0
		 * @version  2.0
		 *
		 * @param  array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param  object $item    The current menu item.
		 * @param  array  $args    An array of wp_nav_menu() arguments.
		 * @param  int    $depth   Depth of menu item. Used for padding. Since WordPress 4.1.
		 */
		if ( ! function_exists( 'wm_menu_item_classes' ) ) {
			function wm_menu_item_classes( $classes, $item, $args, $depth = 0 ) {

				// Requirements check

					if ( ! isset( $item->title ) ) {
						return $classes;
					}


				// Processing

					// Converting array to string for searching the specific class name parts

						$classes = implode( ' ', $classes );

					// General class for active menu

						if ( false !== strpos( $classes, 'current-menu' ) ) {
							$classes .= ' active-menu-item';
						}

					// Converting the string back to array

						$classes = explode( ' ', $classes );


				// Output

					return $classes;

			}
		} // /wm_menu_item_classes

		add_filter( 'nav_menu_css_class', 'wm_menu_item_classes', 10, 4 );



		/**
		 * Menu item modification: item description
		 *
		 * Primary menu only.
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  string $item_output Menu item output HTML (without closing `</li>`).
		 * @param  object $item        The current menu item.
		 * @param  int    $depth       Depth of menu item. Used for padding. Since WordPress 4.1.
		 * @param  array  $args        An array of wp_nav_menu() arguments.
		 */
		if ( ! function_exists( 'wm_menu_primary_item_description' ) ) {
			function wm_menu_primary_item_description( $item_output, $item, $depth, $args ) {

				// Processing

					if (
							isset( $args->theme_location )
							&& 'primary' == $args->theme_location
							&& trim( $item->description )
						) {

						$item_output = str_replace(
								$args->link_after . '</a>',
								'<span class="menu-item-description">' . trim( $item->description ) . '</span>' . $args->link_after . '</a>',
								$item_output
							);

					}


				// Output

					return $item_output;

			}
		} // /wm_menu_primary_item_description

		add_filter( 'walker_nav_menu_start_el', 'wm_menu_primary_item_description', 10, 4 );



		/**
		 * Menu item modification: submenu expander
		 *
		 * Primary menu only.
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  string $item_output Menu item output HTML (without closing `</li>`).
		 * @param  object $item        The current menu item.
		 * @param  int    $depth       Depth of menu item. Used for padding. Since WordPress 4.1.
		 * @param  array  $args        An array of wp_nav_menu() arguments.
		 */
		if ( ! function_exists( 'wm_menu_primary_item_expander' ) ) {
			function wm_menu_primary_item_expander( $item_output, $item, $depth, $args ) {

				// Processing

					if (
							isset( $args->theme_location )
							&& 'primary' == $args->theme_location
							&& in_array( 'menu-item-has-children', (array) $item->classes )
						) {

						$item_output = str_replace(
								$args->link_after . '</a>',
								$args->link_after . ' <span class="expander" aria-hidden="true"></span></a>', // Accessibility: on focus, no screen reader text required
								$item_output
							);

					}


				// Output

					return $item_output;

			}
		} // /wm_menu_primary_item_expander

		add_filter( 'walker_nav_menu_start_el', 'wm_menu_primary_item_expander', 20, 4 );



	/**
	 * Entry Schema.org meta
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_entry_container_schema_meta' ) ) {
		function wm_entry_container_schema_meta() {

			// Output

				echo '<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" />';

		}
	} // /wm_entry_container_schema_meta

	add_action( 'tha_entry_top', 'wm_entry_container_schema_meta', -10 );



	/**
	 * Post/page heading (title)
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  array $args Heading setup arguments
	 */
	if ( ! function_exists( 'wm_post_title' ) ) {
		function wm_post_title( $args = array() ) {

			// Requirements check

				if (
						! ( $title = get_the_title() )
						|| apply_filters( 'wmhook_wm_post_title_disable', false )
					) {
					return;
				}


			// Helper variables

				$output = '';

				$post_id = get_the_ID();

				$args = wp_parse_args( $args, apply_filters( 'wmhook_wm_post_title_defaults', array(
						'addon'           => '',
						'class'           => 'entry-title',
						'class_container' => 'entry-header',
						'link'            => esc_url( get_permalink() ),
						'output'          => '<header class="{class_container}"><{tag} class="{class}"' . wm_schema_org( 'headline' ) . '>{title}</{tag}>{addon}</header>',
						'tag'             => ( is_page( $post_id ) || is_single( $post_id ) ) ? ( 'h1' ) : ( 'h2' ),
						'title'           => '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>',
					) ) );

				// Singular title (no link applied)

					if ( is_page( $post_id ) || is_single( $post_id ) ) {

						if ( $suffix = wm_paginated_suffix( 'small' ) ) {
							$args['title'] .= $suffix;
						} else {
							$args['title'] = $title;
						}

					}

				// Food Menus CPT title

					if ( 'nova_menu_item' === get_post_type() ) {

						$args['class_container'] .= ' food-menu-item-header';

						// Food menu items title tag

							if (
									! is_single( $post_id )
									&& ! is_search()
								) {

								$args['tag'] = ( ! is_front_page() ) ? ( 'h3' ) : ( 'h4' );

							}

						// Check whether we have post content and set the link accordingly

							$permalink = array( '', '' );
							$content   = trim( strip_tags( get_the_content() ) );

							if ( $content ) {
								$permalink = array( '<a href="' . esc_url( get_permalink() ) . '">', '</a>' );
							}

							$permalink = apply_filters( 'wmhook_wm_post_title_nova_menu_item_permalink', $permalink );

						$args['title']  = $permalink[0];
						$args['title'] .= '<span class="food-menu-item-title">' . $title . '</span>';
						$args['title'] .= '<span class="food-menu-item-price"> ' . strip_tags( get_post_meta( get_the_ID(), 'nova_price', true ) ) . '</span>';
						$args['title'] .= $permalink[1];

					}

				// Filter processed $args

					$args = apply_filters( 'wmhook_wm_post_title_args', $args );

				// Output replacements

					$replacements = apply_filters( 'wmhook_wm_post_title_replacements', array(
							'{addon}'           => $args['addon'],
							'{class}'           => esc_attr( $args['class'] ),
							'{class_container}' => esc_attr( $args['class_container'] ),
							'{tag}'             => esc_attr( $args['tag'] ),
							'{title}'           => do_shortcode( $args['title'] ),
						), $args );


			// Output

				echo apply_filters( 'wmhook_wm_post_title_output', strtr( $args['output'], $replacements ), $args );

		}
	} // /wm_post_title

	add_action( 'tha_entry_top', 'wm_post_title', 10 );



		/**
		 * Alter post title tag: h3
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  array $args
		 */
		if ( ! function_exists( 'wm_post_title_tag_h3' ) ) {
			function wm_post_title_tag_h3( $args = array() ) {

				// Helper variables

					$args['tag'] = 'h3';

				// Output

					return $args;

			}
		} // /wm_post_title_tag_h3



		/**
		 * Single post title paged
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  string $title
		 * @param  object $post
		 */
		if ( ! function_exists( 'wm_single_post_title' ) ) {
			function wm_single_post_title( $title, $post ) {

				// Helper variables

					$suffix = wm_paginated_suffix();

					// Strip tags when using in `wp_head`

						if ( doing_action( 'wp_head' ) ) {
							$suffix = strip_tags( $suffix );
						}


				// Output

					return $title . $suffix;

			}
		} // /wm_single_post_title

		add_filter( 'single_post_title', 'wm_single_post_title', 10, 2 );



	/**
	 * Content top
	 *
	 * @since    1.0
	 * @version  2.5.3
	 */
	if ( ! function_exists( 'wm_content_top' ) ) {
		function wm_content_top() {

			// Output

				echo "\r\n\r\n" . '<div id="content" class="site-content">';

				do_action( 'wmhook_content_primary_before' );

				echo "\r\n\t" . '<div id="primary" class="content-area">';

				do_action( 'wmhook_content_main_before' );

				echo "\r\n\t\t" . '<main id="main" class="site-main clearfix" ' . wm_schema_org( 'mainContentOfPage' ) . '>' . "\r\n\r\n";

		}
	} // /wm_content_top

	add_action( 'tha_content_top', 'wm_content_top', 100 );



		/**
		 * Content bottom
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_content_bottom' ) ) {
			function wm_content_bottom() {

				// Output

					echo "\r\n\r\n\t\t" . '</main><!-- /#main -->';

					do_action( 'wmhook_content_main_after' );

					echo "\r\n\t" . '</div><!-- /#primary -->';

					do_action( 'wmhook_content_primary_after' );

					echo "\r\n" . '</div><!-- /#content -->' . "\r\n\r\n";

			}
		} // /wm_content_bottom

		add_action( 'tha_content_bottom', 'wm_content_bottom', 100 );



		/**
		 * Breadcrumbs
		 *
		 * @since    1.1
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_breadcrumbs' ) ) {
			function wm_breadcrumbs() {

				// Output

					if (
							function_exists( 'bcn_display' )
							&& ! is_404()
							&& ! is_front_page()
							&& apply_filters( 'wmhook_wm_breadcrumbs_enabled', true )
						) {

						$id_index = rand( 10, 99 );

						echo '<div class="breadcrumbs-container">'
						     . '<nav class="breadcrumbs" aria-labelledby="breadcrumbs-label-' . absint( $id_index ) . '"' . wm_schema_org( 'BreadcrumbList' ) . '>'
						     . '<h2 class="screen-reader-text" id="breadcrumbs-label-' . absint( $id_index ) . '">' . esc_attr__( 'Breadcrumbs navigation', 'auberge' ) . '</h2>'
						     . bcn_display( true )
						     . '</nav>'
						     . '</div>';

					}

			}
		} // /wm_breadcrumbs

		add_action( 'tha_content_before', 'wm_breadcrumbs', 10 );



		/**
		 * Front page widgets area
		 *
		 * @since    1.0
		 * @version  1.0
		 */
		if ( ! function_exists( 'wm_front_page_widgets' ) ) {
			function wm_front_page_widgets() {

				// Output

					if (
							is_front_page()
							&& ! is_paged()
						) {

						get_sidebar( 'front-page' );

					}

			}
		} // /wm_front_page_widgets

		add_action( 'tha_content_before', 'wm_front_page_widgets', 10 );




		/**
		 * Additional front page action hook - above page content
		 *
		 * @since    1.0
		 * @version  1.0
		 */
		if ( ! function_exists( 'wm_front_page_sections_top' ) ) {
			function wm_front_page_sections_top() {

				// Output

					if (
							is_front_page()
							&& ! is_paged()
						) {

						do_action( 'wmhook_front_page_sections_top' );

					}

			}
		} // /wm_front_page_sections_top

		add_action( 'wmhook_content_main_before', 'wm_front_page_sections_top', 10 );




			/**
			 * Additional front page action hook - below page content
			 *
			 * @since    1.0
			 * @version  1.0
			 */
			if ( ! function_exists( 'wm_front_page_sections_bottom' ) ) {
				function wm_front_page_sections_bottom() {

					// Output

						if (
								is_front_page()
								&& ! is_paged()
							) {

							do_action( 'wmhook_front_page_sections_bottom' );

						}

				}
			} // /wm_front_page_sections_bottom

			add_action( 'wmhook_content_main_after', 'wm_front_page_sections_bottom', 10 );




			/**
			 * Display Condensed Blog loop
			 *
			 * @since    1.0
			 * @version  2.0
			 */
			if ( ! function_exists( 'wm_loop_blog_condensed' ) ) {
				function wm_loop_blog_condensed() {

					// Output

						get_template_part( 'template-parts/loop', 'blog-condensed' );

				}
			} // /wm_loop_blog_condensed



			/**
			 * Condensed posts setup
			 */

				/**
				 * Post classes
				 *
				 * @since    1.4
				 * @version  2.0
				 *
				 * @param  array $classes
				 */
				if ( ! function_exists( 'wm_post_classes_condensed' ) ) {
					function wm_post_classes_condensed( $classes ) {

						// Processing

							// Condensed posts - remove format classes

								if ( is_front_page() && ! is_home() ) {
									$classes = explode( ' ', str_replace( 'format-', 'post-format-', implode( ' ', $classes ) ) );
								}


						// Output

							return $classes;

					}
				} // /wm_post_classes_condensed



				/**
				 * Setup entry display
				 *
				 * @since    2.0
				 * @version  2.0
				 */
				if ( ! function_exists( 'wm_entry_condensed_set' ) ) {
					function wm_entry_condensed_set() {

						// Processing

							// Set custom format classes

								add_filter( 'post_class', 'wm_post_classes_condensed' );

							// Force only image post media

								add_filter( 'wmhook_wm_post_media_post_format', '__return_empty_string' );

							// Set post title tag

								add_filter( 'wmhook_wm_post_title_args', 'wm_post_title_tag_h3' );

					}
				} // /wm_entry_condensed_set

				add_action( 'wmhook_loop_blog_condensed_postslist_top', 'wm_entry_condensed_set' );



					/**
					 * Remove setup entry display after loop end
					 *
					 * @since    2.0
					 * @version  2.0
					 */
					if ( ! function_exists( 'wm_entry_condensed_unset' ) ) {
						function wm_entry_condensed_unset() {

							// Processing

								// Set custom format classes

									remove_filter( 'post_class', 'wm_post_classes_condensed' );

								// Force only image post media

									remove_filter( 'wmhook_wm_post_media_post_format', '__return_empty_string' );

								// Set post title tag

									remove_filter( 'wmhook_wm_post_title_args', 'wm_post_title_tag_h3' );

						}
					} // /wm_entry_condensed_unset

					add_action( 'wmhook_loop_blog_condensed_postslist_bottom', 'wm_entry_condensed_unset' );



				/**
				 * Entry content wrapper: Open
				 *
				 * @since    2.0
				 * @version  2.0
				 */
				if ( ! function_exists( 'wm_entry_content_wrap_open' ) ) {
					function wm_entry_content_wrap_open() {

						// Requirements check

							if (
									! is_front_page()
									|| is_home()
									|| 'post' !== get_post_type()
								) {
								return;
							}


						// Output

							echo '<div class="entry-inner">';

					}
				} // /wm_entry_content_wrap_open

				add_action( 'tha_entry_top', 'wm_entry_content_wrap_open', 8 );



					/**
					 * Entry content wrapper: Close
					 *
					 * @since    2.0
					 * @version  2.0
					 */
					if ( ! function_exists( 'wm_entry_content_wrap_close' ) ) {
						function wm_entry_content_wrap_close() {

							// Requirements check

								if (
										! is_front_page()
										|| is_home()
										|| 'post' !== get_post_format()
									) {
									return;
								}


							// Output

								echo '</div>';

						}
					} // /wm_entry_content_wrap_close

					add_action( 'tha_entry_top', 'wm_entry_content_wrap_close', 100 );



			/**
			 * Display Food Menu loop
			 *
			 * @since    1.0
			 * @version  2.0
			 */
			if ( ! function_exists( 'wm_loop_food_menu' ) ) {
				function wm_loop_food_menu() {

					// Output

						get_template_part( 'template-parts/loop', 'food-menu' );

				}
			} // /wm_loop_food_menu



				/**
				 * Display Food Menu loop on page template
				 *
				 * @since    2.0
				 * @version  2.1
				 */
				if ( ! function_exists( 'wm_loop_food_menu_page_template' ) ) {
					function wm_loop_food_menu_page_template() {

						// Requirements check

							if (
									! is_page_template( 'page-template/_menu.php' )
									|| is_front_page()
								) {
								return;
							}


						// Output

							get_template_part( 'template-parts/loop', 'food-menu' );

					}
				} // /wm_loop_food_menu_page_template

				add_action( 'wmhook_content_main_after', 'wm_loop_food_menu_page_template', 10 );




			/**
			 * Setting up front page sections
			 *
			 * @since    1.0
			 * @version  2.0
			 */
			if ( ! function_exists( 'wm_front_page_sections' ) ) {
				function wm_front_page_sections() {

					// Requirements check

						if ( ! is_front_page() || is_home() ) {
							return;
						}


					// Helper variable

						$hooks = array(
								'blog-condensed' => array( '-' ),
								'food-menu'      => array( '-' ),
								'_customizer'    => array( get_theme_mod( 'layout-blog-condensed', 'top|10' ), get_theme_mod( 'layout-food-menu', 'bottom|10' ) ),
							);

						if ( $hooks['_customizer'][0] ) {
							$hooks['blog-condensed'] = array_filter( explode( '|', (string) $hooks['_customizer'][0] ) );
						}

						if ( $hooks['_customizer'][1] ) {
							$hooks['food-menu'] = array_filter( explode( '|', (string) $hooks['_customizer'][1] ) );
						}


					// Processing

						if ( '-' != $hooks['blog-condensed'][0] ) {
							add_action( 'wmhook_front_page_sections_' . $hooks['blog-condensed'][0], 'wm_loop_blog_condensed', $hooks['blog-condensed'][1] );
						}

						if ( '-' != $hooks['food-menu'][0] ) {
							add_action( 'wmhook_front_page_sections_' . $hooks['food-menu'][0], 'wm_loop_food_menu', $hooks['food-menu'][1] );
						}

				}
			} // /wm_front_page_sections

			add_action( 'tha_content_before', 'wm_front_page_sections', -10 );



		/**
		 * Entry container attributes
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_entry_container_atts' ) ) {
			function wm_entry_container_atts() {

				// Output

					return (string) wm_schema_org( 'entry' );

			}
		} // /wm_entry_container_atts

		add_filter( 'wmhook_entry_container_atts', 'wm_entry_container_atts', 10 );



		/**
		 * Post meta top
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_post_meta_top' ) ) {
			function wm_post_meta_top() {

				// Output

					if ( in_array( get_post_type(), apply_filters( 'wmhook_wm_post_meta_top_post_type', array( 'post', 'nova_menu_item' ) ) ) ) {

						if ( is_singular( 'nova_menu_item' ) ) {

							echo wm_post_meta( apply_filters( 'wmhook_wm_post_meta_top_args', array(
									'container' => 'footer',
									'class'     => 'entry-meta entry-meta-top',
									'meta'      => array( 'date', 'author', 'likes' ),
								) ) );

						} elseif ( is_single() ) {

							echo wm_post_meta( apply_filters( 'wmhook_wm_post_meta_top_args', array(
									'container' => 'footer',
									'class'     => 'entry-meta entry-meta-top',
									'meta'      => array( 'date', 'author', 'category', 'likes' ),
								) ) );

						}

					}

			}
		} // /wm_post_meta_top

		add_action( 'tha_entry_top', 'wm_post_meta_top', 20 );



		/**
		 * Post meta bottom
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_post_meta_bottom' ) ) {
			function wm_post_meta_bottom() {

				// Output

					if ( in_array( get_post_type(), apply_filters( 'wmhook_wm_post_meta_bottom_post_type', array( 'post', 'nova_menu_item' ) ) ) ) {

						if ( is_single() ) {

							echo wm_post_meta( apply_filters( 'wmhook_wm_post_meta_bottom_args', array(
									'container' => 'footer',
									'class'     => 'entry-meta entry-meta-bottom',
									'meta'      => array( 'tags' ),
								) ) );

						} else {

							echo wm_post_meta( apply_filters( 'wmhook_wm_post_meta_bottom_args', array(
									'container'   => 'footer',
									'class'       => 'entry-meta',
									'meta'        => array( 'date', 'author', 'comments', 'likes' ),
									'date_format' => 'j M Y',
								) ) );

						}

					}

			}
		} // /wm_post_meta_bottom

		add_action( 'tha_entry_bottom', 'wm_post_meta_bottom', 10 );



		/**
		 * Post navigation
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_post_navigation' ) ) {
			function wm_post_navigation() {

				// Output

					if (
							is_single( get_the_ID() )
							&& in_array( get_post_type(), (array) apply_filters( 'wmhook_wm_post_navigation_post_type', array( 'post' ) ) )
						) {

							the_post_navigation( array(
									'prev_text' => '<span class="label">' . esc_html__( 'Previous post', 'auberge' ) . '</span> <span class="title">%title</span>',
									'next_text' => '<span class="label">' . esc_html__( 'Next post', 'auberge' ) . '</span> <span class="title">%title</span>',
								) );

						}

			}
		} // /wm_post_navigation

		add_action( 'tha_entry_bottom', 'wm_post_navigation', 50 );



		/**
		 * Post comments
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_post_comments' ) ) {
			function wm_post_comments() {

				// Output

					comments_template( '', true );

			}
		} // /wm_post_comments

		add_action( 'tha_entry_bottom', 'wm_post_comments', 100 );



		/**
		 * Sticky post label
		 *
		 * @since    1.0
		 * @version  2.5.0
		 */
		if ( ! function_exists( 'wm_sticky_label' ) ) {
			function wm_sticky_label() {

				// Output

					if ( is_sticky() ) {
						echo '<div class="label-sticky" title="' . esc_attr__( 'This is sticky post', 'auberge' ) . '"><i class="genericons-neue genericons-neue-pinned"></i></div>';
					}

			}
		} // /wm_sticky_label

		add_action( 'tha_entry_bottom', 'wm_sticky_label', 20 );



		/**
		 * Excerpt
		 *
		 * Displays the excerpt properly.
		 * If the post is password protected, display a message.
		 * If the post has more tag, display the content appropriately.
		 *
		 * @since    1.0
		 * @version  2.7.0
		 *
		 * @param  string $excerpt
		 */
		if ( ! function_exists( 'wm_excerpt' ) ) {
			function wm_excerpt( $excerpt = '' ) {

				// Variables

					$post_id = get_the_ID();


				// Requirements check

					if ( post_password_required( $post_id ) ) {
						if ( ! is_single( $post_id ) ) {
							return esc_html__( 'This content is password protected.', 'auberge' )
							       . ' <a href="' . esc_url( get_permalink() ) . '">'
							       . esc_html__( 'Enter the password to view it.', 'auberge' )
							       . '</a>';
						}
						return;
					}


				// Processing

					if (
						! is_single( $post_id )
						&& wm_has_more_tag()
					) {

						if ( has_excerpt( $post_id ) ) {
							$excerpt = str_replace(
								'entry-summary',
								'entry-summary has-more-tag',
								$excerpt
							);
						} else {
							$excerpt = '';
						}

						$excerpt = apply_filters( 'the_content', $excerpt . get_the_content( '' ) . wm_get_continue_reading_html() );

					}


				// Output

					return $excerpt;

			}
		} // /wm_excerpt

		add_filter( 'the_excerpt', 'wm_excerpt', 20 );



			/**
			 * Wrap excerpt within a `div.entry-summary`.
			 *
			 * Line breaks are required for proper functionality of `wpautop()` later on.
			 *
			 * @since    2.7.0
			 * @version  2.7.0
			 *
			 * @param  string $post_excerpt
			 */
			if ( ! function_exists( 'wm_wrap_excerpt' ) ) {
				function wm_wrap_excerpt( $post_excerpt = '' ) {

					// Output

						return '<div class="entry-summary">' . PHP_EOL . $post_excerpt . PHP_EOL . '</div>';

				}
			} // /wm_wrap_excerpt

			add_filter( 'get_the_excerpt', 'wm_wrap_excerpt', 20 );



			/**
			 * Adding "Continue reading" link to excerpt
			 *
			 * @since    1.0.0
			 * @version  2.7.0
			 *
			 * @param  string  $post_excerpt  The post excerpt.
			 * @param  WP_Post $post          Post object.
			 */
			if ( ! function_exists( 'wm_excerpt_continue_reading' ) ) {
				function wm_excerpt_continue_reading( $post_excerpt = '', $post = null ) {

					// Variables

						$post_id = get_the_ID();


					// Processing

						if (
							! post_password_required( $post_id )
							&& ! is_single( $post_id )
							&& ! wm_has_more_tag()
							&& in_array(
								get_post_type( $post_id ),
								(array) apply_filters( 'wmhook_wm_excerpt_continue_reading_post_type', array( 'post', 'page' ) )
							)
						) {
							$post_excerpt .= wm_get_continue_reading_html( $post );
						}


					// Output

						return $post_excerpt;

				}
			} // /wm_excerpt_continue_reading

			add_filter( 'get_the_excerpt', 'wm_excerpt_continue_reading', 30, 2 );



			/**
			 * Get "Continue reading" HTML.
			 *
			 * @since    2.7.0
			 * @version  2.7.0
			 *
			 * @param  WP_Post $post   Post object.
			 * @param  string  $scope  Optional identification of specific "Continue reading" text for better filtering.
			 */
			if ( ! function_exists( 'wm_get_continue_reading_html' ) ) {
				function wm_get_continue_reading_html( $post = null, $scope = '' ) {

					// Pre

						$pre = apply_filters( 'wmhook_wm_get_continue_reading_html_pre', false, $post, $scope );

						if ( false !== $pre ) {
							return $pre;
						}


					// Variables

						$html     = '';
						$scope    = (string) $scope;
						$template = 'template-parts/component-link-more';


					// Processing

						ob_start();

						if ( $scope && locate_template( $template . '-' . $scope . '.php' ) ) {
							get_template_part( $template, $scope );
						} else {
							get_template_part( $template, get_post_type() );
						}

						/**
						 * Stripping all new line and tab characters to prevent `wpautop()` messing things up later.
						 *
						 * "\t" - a tab.
						 * "\n" - a new line (line feed).
						 * "\r" - a carriage return.
						 * "\x0B" - a vertical tab.
						 */
						$html = str_replace(
							array( "\t", "\n", "\r", "\x0B" ),
							'',
							ob_get_clean()
						);


					// Output

						return (string) apply_filters( 'wmhook_wm_get_continue_reading_html', $html, $post, $scope );

				}
			} // /wm_get_continue_reading_html



			/**
			 * Excerpt length
			 *
			 * @since    1.0
			 * @version  1.0
			 *
			 * @param  absint $length
			 */
			if ( ! function_exists( 'wm_excerpt_length' ) ) {
				function wm_excerpt_length( $length ) {

					// Output

						return 12;

				}
			} // /wm_excerpt_length

			add_filter( 'excerpt_length', 'wm_excerpt_length', 10 );



			/**
			 * Excerpt more
			 *
			 * @since    1.0
			 * @version  1.0
			 *
			 * @param  string $more
			 */
			if ( ! function_exists( 'wm_excerpt_more' ) ) {
				function wm_excerpt_more( $more ) {

					// Output

						return '&hellip;';

				}
			} // /wm_excerpt_more

			add_filter( 'excerpt_more', 'wm_excerpt_more', 10 );



			/**
			 * Display excerpt on single post page
			 *
			 * @since    2.0
			 * @version  2.0
			 */
			if ( ! function_exists( 'wm_excerpt_single_post' ) ) {
				function wm_excerpt_single_post() {

					// Helper variables

						$post_id = get_the_ID();


					// Requirements check

						if (
								! is_single( $post_id )
								|| ! has_excerpt( $post_id )
								|| wm_paginated_suffix()
								|| get_theme_mod( 'others-single-post-excerpt-disable' )
							) {
							return;
						}


					// Output

						the_excerpt();

				}
			} // /wm_excerpt_single_post

			add_action( 'tha_entry_content_before', 'wm_excerpt_single_post', 10 );



		/**
		 * Pagination
		 *
		 * @since    1.0
		 * @version  2.6.0
		 */
		if ( ! function_exists( 'wm_pagination' ) ) {
			function wm_pagination() {

				// Requirements check

					// Don't display pagination if Jetpack Infinite Scroll in use

						if ( class_exists( 'The_Neverending_Home_Page' ) ) {
							return;
						}


				// Helper variables

					$output = '';

					$pagination = array(
						'prev_text' => esc_html_x( '&laquo;', 'Pagination text (visible): previous.', 'auberge' ) . '<span class="screen-reader-text"> '
						               . esc_html_x( 'Previous page', 'Pagination text (hidden): previous.', 'auberge' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next page', 'Pagination text (hidden): next.', 'auberge' )
						               . ' </span>' . esc_html_x( '&raquo;', 'Pagination text (visible): next.', 'auberge' ),
					);


				// Processing

					if ( $output = paginate_links( $pagination ) ) {
						$output = '<nav class="pagination" aria-labelledby="pagination-label">'
						          . '<h2 class="screen-reader-text" id="pagination-label">' . esc_html__( 'Posts Navigation', 'auberge' ) . '</h2>'
						          . $output
						          . '</nav>';
					}


				// Output

					echo $output; // WPCS: XSS OK.

			}
		} // /wm_pagination

		add_action( 'wmhook_postslist_after', 'wm_pagination', 10 );



		/**
		 * Front page blog more link
		 *
		 * @since    1.0
		 * @version  1.0
		 */
		if ( ! function_exists( 'wm_blog_more_link' ) ) {
			function wm_blog_more_link() {

				// Output

					if ( $page_for_posts_id = absint( get_option( 'page_for_posts' ) ) ) {

						echo '<div class="archive-link"><a href="' . esc_url( get_permalink( $page_for_posts_id ) ) . '" class="button">' . esc_html__( 'All posts', 'auberge' ) . '</a></div>';

					}

			}
		} // /wm_blog_more_link

		add_action( 'wmhook_loop_blog_condensed_postslist_after', 'wm_blog_more_link', 10 );



			/**
			 * Front page food menu more link
			 *
			 * @since    1.0
			 * @version  2.0
			 */
			if ( ! function_exists( 'wm_food_menu_more_link' ) ) {
				function wm_food_menu_more_link() {

					// Helper variables

						$food_menu_page_id = intval( get_transient( 'auberge-page-template-food-menu' ) );

					// Output

						if (
								1 <= $food_menu_page_id
								&& ! is_page_template( 'page-template/_menu.php' )
							) {

							echo '<div class="archive-link"><a href="' . esc_url( get_permalink( $food_menu_page_id ) ) . '" class="button">' . get_the_title( $food_menu_page_id ) . '</a></div>';

						}

				}
			} // /wm_food_menu_more_link

			add_action( 'wmhook_loop_food_menu_postslist_after', 'wm_food_menu_more_link', 10 );



	/**
	 * Footer widgets
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_footer_widgets' ) ) {
		function wm_footer_widgets() {

			// Output

				get_sidebar( 'footer' );

		}
	} // /wm_footer_widgets

	add_action( 'tha_footer_top', 'wm_footer_widgets', 110 );



	/**
	 * Footer credits
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_footer_credits' ) ) {
		function wm_footer_credits() {

			// Output

				get_footer( 'credits' );

		}
	} // /wm_footer_credits

	add_action( 'tha_footer_top', 'wm_footer_credits', 120 );



		/**
		 * Footer top
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_footer_top' ) ) {
			function wm_footer_top() {

				// Output

					echo "\r\n\r\n" . '<footer id="colophon" class="site-footer"' . wm_schema_org( 'WPFooter' ) . '>' . "\r\n\r\n";

			}
		} // /wm_footer_top

		add_action( 'tha_footer_top', 'wm_footer_top', 10 );



		/**
		 * Footer bottom
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_footer_bottom' ) ) {
			function wm_footer_bottom() {

				// Output

					echo "\r\n\r\n" . '</footer>' . "\r\n\r\n";

			}
		} // /wm_footer_bottom

		add_action( 'tha_footer_bottom', 'wm_footer_bottom', 100 );





/**
 * 100) Other functions
 */

	/**
	 * Ignore sticky posts in main loop
	 *
	 * @since    1.0
	 * @version  1.4
	 *
	 * @param  obj $query
	 */
	if ( ! function_exists( 'wm_posts_query_ignore_sticky_posts' ) ) {
		function wm_posts_query_ignore_sticky_posts( $query ) {

			// Processing

				if ( $query->is_main_query() ) {
					$query->set( 'ignore_sticky_posts', 1 );
				}

		}
	} // /wm_posts_query_ignore_sticky_posts

	add_action( 'pre_get_posts', 'wm_posts_query_ignore_sticky_posts' );



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

			// Processing

				wp_enqueue_script( 'jquery-masonry' );


			// Output

				return $output;

		}
	} // /wm_shortcode_gallery_assets

	add_filter( 'post_gallery', 'wm_shortcode_gallery_assets', 10, 2 );



	/**
	 * Get the "Food Menu" page template page ID
	 *
	 * Returns -1 when no page ID with the page template found.
	 *
	 * @since    1.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_food_menu_page_template_id' ) ) {
		function wm_food_menu_page_template_id() {

			// Processing

				if ( false === ( $cached_page_id = get_transient( 'auberge-page-template-food-menu' ) ) ) {

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

					set_transient( 'auberge-page-template-food-menu', $cached_page_id );

				}


			// Output

				return $cached_page_id;

		}
	} // /wm_food_menu_page_template_id

	add_action( 'after_setup_theme', 'wm_food_menu_page_template_id', 20 );



		/**
		 * Flush out the transients used in wm_food_menu_page_template_id
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_food_menu_page_template_transient_flusher' ) ) {
			function wm_food_menu_page_template_transient_flusher() {

				// Processing

					delete_transient( 'auberge-page-template-food-menu' );

			}
		} // /wm_food_menu_page_template_transient_flusher

		add_action( 'save_post', 'wm_food_menu_page_template_transient_flusher', 10 );



	/**
	 * Get Google Fonts link
	 *
	 * Returns a string such as:
	 * https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400|Exo+2:400,700|Allan&subset=latin,latin-ext
	 *
	 * @since    1.0
	 * @version  2.6.0
	 *
	 * @param  array $fonts Fallback fonts.
	 */
	if ( ! function_exists( 'wm_google_fonts_url' ) ) {
		function wm_google_fonts_url( $fonts = array() ) {

			// Variables

				$output = '';
				$family = array();
				$subset = get_theme_mod( 'font-subset' );

				$fonts_setup = array_unique( array_filter( (array) apply_filters( 'wmhook_wm_google_fonts_url_fonts_setup', array() ) ) );

				if ( empty( $fonts_setup ) && ! empty( $fonts ) ) {
					$fonts_setup = (array) $fonts;
				}

				$http = ( is_ssl() ) ? ( 'https' ) : ( 'http' );


			// Requirements check

				if ( empty( $fonts_setup ) ) {
					return apply_filters( 'wmhook_wm_google_fonts_url_output', $output );
				}


			// Processing

				foreach ( $fonts_setup as $section ) {
					$font = trim( $section );
					if ( $font ) {
						$family[] = str_replace( ' ', '+', $font );
					}
				}

				if ( ! empty( $family ) ) {
					$output = esc_url_raw( add_query_arg( array(
						'family' => implode( '|', (array) array_unique( $family ) ),
						'subset' => implode( ',', (array) $subset ), //Subset can be array if multiselect Customizer input field used
					), $http . '://fonts.googleapis.com/css' ) );
				}


			// Output

				return apply_filters( 'wmhook_wm_google_fonts_url_output', $output );

		}
	} // /wm_google_fonts_url



	/**
	 * Schema.org markup on HTML tags
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param   string  $element
	 * @param   boolean $output_meta_tag
	 */
	if ( ! function_exists( 'wm_schema_org' ) ) {
		function wm_schema_org( $element = '', $output_meta_tag = false ) {

			// Pre

				$pre = apply_filters( 'wmhook_wm_schema_org_pre', false, $element, $output_meta_tag );

				if ( false !== $pre ) {
					return $pre;
				}


			// Requirements check

				if ( empty( $element ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$base    = apply_filters( 'wmhook_wm_schema_org_base', 'https://schema.org/', $element, $output_meta_tag );
				$post_id = ( is_home() ) ? ( get_option( 'page_for_posts' ) ) : ( null );
				$type    = get_post_meta( $post_id, 'schemaorg_type', true );

				// Add custom post types that describe a single item to this array

					$creative_work_array = (array) apply_filters( 'wmhook_schema_org_creative_work_array', array( 'jetpack-portfolio' ), $element, $output_meta_tag );


			// Processing

				switch ( $element ) {

				case 'author':
						$output = 'itemprop="author"';
					break;

				case 'BreadcrumbList':
						$output = 'itemscope itemtype="' . $base . 'BreadcrumbList"';
					break;

				case 'datePublished':
						$output = 'itemprop="datePublished"';
					break;

				case 'dateModified':
						$output = 'itemprop="dateModified"';
					break;

				case 'entry':
						$output = 'itemscope ';

						if ( is_page() ) {
							$output .= 'itemtype="' . $base . 'WebPage"';

						} elseif ( is_singular( $creative_work_array ) ) {
							$output .= 'itemprop="workExample" itemtype="' . $base . 'CreativeWork"';

						} else {
							$output .= ( is_single( get_the_ID() ) ) ? ( 'itemprop="blogPost"' ) : ( 'itemprop="itemListElement"' );
							$output .= ' itemtype="' . $base . 'BlogPosting"';

						}
					break;

				case 'entry_body':
						if ( ! is_single( get_the_ID() ) ) {
							$output = 'itemprop="description"';

						} else {
							$output = 'itemprop="articleBody"';

						}
					break;

				case 'headline':
						$output = 'itemprop="headline"';
					break;

				case 'height':
						$output = 'itemprop="height"';
					break;

				case 'image':
						$output = 'itemprop="image" itemscope itemtype="' . $base . 'ImageObject"';
					break;

				case 'ItemList':
						$output = 'itemscope itemtype="' . $base . 'ItemList"';
					break;

				case 'keywords':
						$output = 'itemprop="keywords"';
					break;

				case 'mainEntityOfPage':
						$output = 'itemprop="mainEntityOfPage"';
					break;

				case 'mainContentOfPage':
						$output = 'itemprop="mainContentOfPage"';
					break;

				case 'name':
						$output = 'itemprop="name"';
					break;

				case 'Person':
						$output = 'itemscope itemtype="' . $base . 'Person"';
					break;

				case 'ProfilePage':
						$output = 'itemscope itemtype="' . $base . 'ProfilePage"';
					break;

				case 'SiteNavigationElement':
						$output = 'itemscope itemtype="' . $base . 'SiteNavigationElement"';
					break;

				case 'url':
						$output = 'itemprop="url"';
					break;

				case 'WebPage':
						if ( ! is_singular() ) {
							$output .= 'itemscope itemtype="' . $base . 'WebPage"';
						}
					break;

				case 'width':
						$output = 'itemprop="width"';
					break;

				case 'WPFooter':
						$output = 'itemscope itemtype="' . $base . 'WPFooter"';
					break;

				case 'WPSideBar':
						$output = 'itemscope itemtype="' . $base . 'WPSideBar"';
					break;

				case 'WPHeader':
						$output = 'itemscope itemtype="' . $base . 'WPHeader"';
					break;

				default:
						$output = $element;
					break;

				}

				$output = ' ' . $output;

				// Output in <meta> tag

					if ( $output_meta_tag ) {
						if ( is_string( $output_meta_tag ) ) {
							$output .= ' content="' . esc_attr( trim( $output_meta_tag ) ) . '"';
						} else {
							$output .= ' content="true"';
						}
						$output = '<meta ' . trim( $output ) . ' />';
					}


			// Output

				return apply_filters( 'wmhook_wm_schema_org_output', $output, $element, $output_meta_tag );

		}
	} // /wm_schema_org





/**
 * 999) Plugins integration
 */

	// Advanced Custom Fields setup

		if ( function_exists( 'register_field_group' ) && is_admin() ) {
			require_once( get_template_directory() . '/includes/plugins/advanced-custom-fields/advanced-custom-fields.php' );
		}

	// Beaver Builder setup

		if ( class_exists( 'FLBuilder' ) ) {
			require_once( get_template_directory() . '/includes/plugins/beaver-builder/beaver-builder.php' );
		}

	// Jetpack setup

		if ( class_exists( 'Jetpack' ) ) {
			require_once( get_template_directory() . '/includes/plugins/jetpack/jetpack.php' );
		}

	// One Click Demo Import

		if ( ( class_exists( 'OCDI_Plugin' ) || class_exists( 'PT_One_Click_Demo_Import' ) ) && is_admin() ) {
			require_once( get_template_directory() . '/includes/plugins/one-click-demo-import/class-one-click-demo-import.php' );
		}
