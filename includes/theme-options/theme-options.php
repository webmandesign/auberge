<?php
/**
 * Theme options
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.2.0
 *
 * Contents:
 *
 * 10) Options functions
 */





/**
 * 10) Options functions
 */

	/**
	 * Set theme options array
	 *
	 * @since    1.0
	 * @version  2.2.0
	 *
	 * @param  array $options
	 */
	if ( ! function_exists( 'wm_theme_options_array' ) ) {
		function wm_theme_options_array( $options = array() ) {

			// Processing

				$options = array(



					// Theme credits

						'001' . 'placeholder' => array(
							'id'                   => 'placeholder',
							'type'                 => 'section',
							'create_section'       => '',
							'in_panel'             => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
							'in_panel-description' => '<h3>' . esc_html__( 'Theme Credits', 'auberge' ) . '</h3>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( '%1$s is a WordPress theme developed by %2$s.', '1: linked theme name, 2: theme author name.', 'auberge' ),
									'<a href="' . esc_url( wp_get_theme( get_template() )->get( 'ThemeURI' ) ) . '" target="_blank"><strong>' . esc_html( wp_get_theme( get_template() )->get( 'Name' ) ) . '</strong></a>',
									'<strong>' . esc_html( wp_get_theme( get_template() )->get( 'Author' ) ) . '</strong>'
								)
								. '</p>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( 'You can obtain other professional WordPress themes at %s.', '%s: theme author link.', 'auberge' ),
									'<strong><a href="http://www.webmandesign.eu" target="_blank">WebManDesign.eu</a></strong>'
								)
								. '</p>'
								. '<p class="description">'
								. esc_html__( 'Thank you for using this awesome theme!', 'auberge' )
								. '</p>',
						),



					// Colors

						100 . 'colors' . 10 => array(
							'id'             => 'colors-accents',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'auberge' ), esc_html_x( 'Accents', 'Customizer color section title', 'auberge' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							100 . 'colors' . 10 . 100 => array(
								'type'        => 'color',
								'id'          => 'color' . '-accent',
								'label'       => esc_html__( 'Accent color', 'auberge' ),
								'description' => esc_html__( 'This color affects links, buttons and other elements of the website', 'auberge' ),
								'default'     => '#0aac8e',
							),
							100 . 'colors' . 10 . 110 => array(
								'type'        => 'color',
								'id'          => 'color' . '-accent-text',
								'label'       => esc_html__( 'Accent text color', 'auberge' ),
								'description' => esc_html__( 'Color of text over accent color background', 'auberge' ),
								'default'     => '#ffffff',
							),

						100 . 'colors' . 20 => array(
							'id'             => 'colors-header',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'auberge' ), esc_html_x( 'Header', 'Customizer color section title', 'auberge' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							100 . 'colors' . 20 . 100 => array(
								'type'       => 'color',
								'id'         => 'color' . '-header',
								'label'      => esc_html__( 'Background color', 'auberge' ),
								'default'    => '#1a1c1e',
								'preview_js' => array(
										'css' => array(
												'.site-header' => array(
														'background-color'
													),
											),
									),
							),
							100 . 'colors' . 20 . 110 => array(
								'type'        => 'color',
								'id'          => 'color' . '-header-text',
								'label'       => esc_html__( 'Text color', 'auberge' ),
								'description' => esc_html__( 'Note that for certain header elements the color will be faded out a bit', 'auberge' ),
								'default'     => '#ffffff',
								'preview_js'  => array(
										'css' => array(
												'.site-header' => array(
														'color'
													),
											),
									),
							),

						100 . 'colors' . 30 => array(
							'id'             => 'colors-content',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'auberge' ), esc_html_x( 'Content', 'Customizer color section title', 'auberge' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							100 . 'colors' . 30 . 200 => array(
								'type'    => 'html',
								'content' => '<h3>' . esc_html__( 'Front page widgets', 'auberge' ) . '</h3>',
							),

								100 . 'colors' . 30 . 210 => array(
									'type'       => 'color',
									'id'         => 'color' . '-front-widgets',
									'label'      => esc_html__( 'Background color', 'auberge' ),
									'default'    => '#1a1c1e',
									'preview_js' => array(
											'css' => array(
													'.front-page-widgets-wrapper, .site-banner' => array(
															'background-color'
														),
													'.custom-banner:before, .site-banner-media:before' => array(
															array( 'background', ' )', 'linear-gradient( transparent, ' )
														),
												),
										),
								),
								100 . 'colors' . 30 . 220 => array(
									'type'       => 'color',
									'id'         => 'color' . '-front-widgets-text',
									'label'      => esc_html__( 'Text color', 'auberge' ),
									'default'    => '#8a8c8e',
									'preview_js' => array(
											'css' => array(
													'.front-page-widgets-wrapper' => array(
															'color'
														),
												),
										),
								),

						100 . 'colors' . 90 => array(
							'id'             => 'colors-footer',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'auberge' ), esc_html_x( 'Footer', 'Customizer color section title', 'auberge' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							100 . 'colors' . 90 . 100 => array(
								'type'       => 'color',
								'id'         => 'color' . '-footer',
								'label'      => esc_html__( 'Background color', 'auberge' ),
								'default'    => '#1a1c1e',
								'preview_js' => array(
										'css' => array(
												'.site-footer' => array(
														'background-color'
													),
											),
									),
							),
							100 . 'colors' . 90 . 110 => array(
								'type'       => 'color',
								'id'         => 'color' . '-footer-text',
								'label'      => esc_html__( 'Text color', 'auberge' ),
								'default'    => '#8a8c8e',
								'preview_js' => array(
										'css' => array(
												'.site-footer' => array(
														'color'
													),
											),
									),
							),



					// Layout

						200 . 'layout' => array(
							'id'             => 'layout',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Layout', 'Customizer section title.', 'auberge' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							200 . 'layout' . 100 => array(
								'type'    => 'html',
								'content' => '<h3>' . esc_html__( 'Front page layout', 'auberge' ) . '</h3>',
							),
								200 . 'layout' . 110 => array(
									'type'        => 'select',
									'id'          => 'layout' . '-blog-condensed',
									'label'       => esc_html__( 'Condensed blog posts', 'auberge' ),
									'description' => esc_html__( 'Select if and where to display this page section', 'auberge' ),
									'default'     => 'top|10',
									'options'     => array(
											'-'         => esc_html__( 'Disable section', 'auberge' ),
											'top|10'    => esc_html__( 'First section above page content', 'auberge' ),
											'top|20'    => esc_html__( 'Second section above page content', 'auberge' ),
											'bottom|10' => esc_html__( 'First section below page content', 'auberge' ),
											'bottom|20' => esc_html__( 'Second section below page content', 'auberge' ),
										),
								),
								200 . 'layout' . 120 => array(
									'type'        => 'select',
									'id'          => 'layout' . '-food-menu',
									'label'       => esc_html__( 'Food menu', 'auberge' ),
									'description' => esc_html__( 'Select if and where to display this page section', 'auberge' ),
									'default'     => 'bottom|10',
									'options'     => array(
											'-'         => esc_html__( 'Disable section', 'auberge' ),
											'top|10'    => esc_html__( 'First section above page content', 'auberge' ),
											'top|20'    => esc_html__( 'Second section above page content', 'auberge' ),
											'bottom|10' => esc_html__( 'First section below page content', 'auberge' ),
											'bottom|20' => esc_html__( 'Second section below page content', 'auberge' ),
										),
								),



					// Typography

						900 . 'typography' => array(
							'id'             => 'fonts',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Typography', 'Customizer section title.', 'auberge' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							900 . 'typography' . 100 => array(
								'type'    => 'html',
								'content' => '<p class="description">' . esc_html__( 'Set a Google Font to be used for website logo, headings and general text.', 'auberge' ) . '<br />' . sprintf( esc_html_x( 'Font matches recommendations from %s.', '%s: linked source website name.', 'auberge' ), '<a href="http://femmebot.github.io/google-type/" target="_blank">Google Web Fonts Typographic Project</a>' ) . '</p>',
							),

								900 . 'typography' . 110 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-logo',
									'label'   => esc_html__( 'Logo (site title) font', 'auberge' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								900 . 'typography' . 120 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-headings',
									'label'   => esc_html__( 'Headings font', 'auberge' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								900 . 'typography' . 130 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-body',
									'label'   => esc_html__( 'General text font', 'auberge' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),

								900 . 'typography' . 140 => array(
									'type'    => 'multiselect',
									'id'      => 'font' . '-subset',
									'label'   => esc_html__( 'Font subset', 'auberge' ),
									'options' => wm_helper_var( 'google-fonts-subset' ),
									'default' => 'latin',
								),

								900 . 'typography' . 150 => array(
									'type'        => 'number',
									'id'          => 'font' . '-size-body',
									'label'       => esc_html__( 'Basic font size', 'auberge' ),
									'description' => esc_html__( 'All other font sizes are calculated automatically from this basic font size', 'auberge' ),
									'default'     => 16,
									'min'         => 12,
									'max'         => 24,
									'preview_js'  => array(
											'css' => array(
													'html' => array(
														array( 'font-size', 'px' )
													),
												),
										),
								),



					// Others

						950 . 'others' => array(
							'id'             => 'others',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Others', 'Customizer section title.', 'auberge' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'auberge' ),
						),

							950 . 'others' . 100 => array(
								'type'        => 'checkbox',
								'id'          => 'others_welcome_page',
								'label'       => esc_html__( 'Show "Welcome" page', 'auberge' ),
								'description' => esc_html__( 'Under "Appearance" WordPress dashboard menu', 'auberge' ),
								'default'     => true,
								'preview_js'  => false, // This is to prevent customizer preview reload
							),

							950 . 'others' . 110 => array(
								'type'  => 'checkbox',
								'id'    => 'others-single-post-excerpt-disable',
								'label' => esc_html__( 'Disable excerpt on single post page', 'auberge' ),
							),



					// Food Menu

						960 . 'food_menu' => array(
							'id'             => 'food-menu',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Food Menu', 'Customizer section title.', 'auberge' ),
							'in_panel'       => esc_html_x( 'Theme', 'Customizer panel title.', 'auberge' ),
						),

							960 . 'food_menu' . 100 => array(
								'type'        => 'checkbox',
								'id'          => 'disable-food-menu',
								'label'       => esc_html__( 'Disable food menu', 'auberge' ),
								'description' => esc_html__( 'In case you want to use the theme for a business website or a recipe blog (only available with Auberge Plus), you can disable the Food Menu functionality here.', 'auberge' ),
							),

							960 . 'food_menu' . 110 => array(
								'type'        => 'checkbox',
								'id'          => 'food-menu-section-archive-link-disable',
								'label'       => esc_html__( 'Disable food section archive linking', 'auberge' ),
								'description' => esc_html__( 'By default, all food menu section titles are linked to corresponding archive page.', 'auberge' ) . ' ' . esc_html__( 'You can override this behavior here.', 'auberge' ),
							),



				);


			// Output

				return apply_filters( 'wmhook_wm_theme_options_array_output', $options );

		}
	} // /wm_theme_options_array

	add_filter( 'wmhook_theme_options', 'wm_theme_options_array', 10 );



	/**
	 * Basic custom CSS styles template
	 *
	 * Use a '[[customizer_option_id]]' tags in your custom CSS styles string
	 * where the specific option value should be used.
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  string $styles
	 */
	if ( ! function_exists( 'wm_custom_css_template' ) ) {
		function wm_custom_css_template( $styles = '' ) {

			// Processing

				ob_start();

				locate_template( 'assets/css/custom.css',       true );
				locate_template( 'assets/plus/css/custom.css',  true );
				locate_template( 'assets/css/custom-addon.css', true );


			// Output

				return apply_filters( 'wmhook_wm_custom_css_template_output', ob_get_clean() );

		}
	} // /wm_custom_css_template

	add_filter( 'wmhook_custom_styles', 'wm_custom_css_template', 10 );



	/**
	 * CSS generator replacements addon
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  array $replacements
	 */
	if ( ! function_exists( 'wm_custom_styles_replacements' ) ) {
		function wm_custom_styles_replacements( $replacements = array() ) {

			// Helper variables

				$addons = array(
						'/* End of file */'                => "\r\n\r\n",
						'/*[*/'                            => '/** ', // Open a comment
						'/*]*/'                            => ' **/', // Close a comment
						'/*//'                             => '', // Remove a comment opening
						'//*/'                             => '', // Remove a comment closing
						'[[get_template_directory]]'       => untrailingslashit( get_template_directory() ),
						'[[get_stylesheet_directory]]'     => untrailingslashit( get_stylesheet_directory() ),
						'[[get_template_directory_uri]]'   => str_replace( array( 'http:', 'https:' ), '', untrailingslashit( get_template_directory_uri() ) ),
						'[[get_stylesheet_directory_uri]]' => str_replace( array( 'http:', 'https:' ), '', untrailingslashit( get_stylesheet_directory_uri() ) ),
					);


			// Output

				return array_merge( $replacements, $addons );

		}
	} // /wm_custom_styles_replacements

	add_filter( 'wmhook_wm_custom_styles_replacements', 'wm_custom_styles_replacements', 10 );



	/**
	 * Customizer partial refresh
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  object $wp_customize  WP customizer object.
	 */
	if ( ! function_exists( 'wm_customizer_partial_refresh' ) ) {
		function wm_customizer_partial_refresh( $wp_customize ) {

			// Requirements check

				if ( ! isset( $wp_customize->selective_refresh ) ) {
					return;
				}


			// Processing

				$wp_customize->get_setting( 'custom_logo' )->transport = 'postMessage';

				$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
						'selector'            => '.site-branding',
						'container_inclusive' => false,
						'render_callback'     => 'wm_customizer_partial_refresh_logo',
					) );

		}
	} // /wm_customizer_partial_refresh

	add_filter( 'customize_register', 'wm_customizer_partial_refresh', 999 );



		/**
		 * Customizer partial refresh helper: site logo
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_customizer_partial_refresh_logo' ) ) {
			function wm_customizer_partial_refresh_logo() {

				// Output

					wm_logo( false );

			}
		} // /wm_customizer_partial_refresh_logo
