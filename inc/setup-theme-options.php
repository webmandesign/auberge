<?php
/**
 * Theme options
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.4.8
 *
 * CONTENT:
 * - 10) Actions and filters
 * - 20) Options functions
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Filters
	 */

		//Apply customizer options
			add_filter( 'wmhook_theme_options', 'wm_theme_options_array', 10 );
		//Theme custom styles to be outputed in HTML head
			add_filter( 'wmhook_custom_styles', 'wm_custom_css_template', 10 );





/**
 * 20) Options functions
 */

	/**
	 * Set theme options array
	 *
	 * @since    1.0
	 * @version  1.4.8
	 *
	 * @param  array $options
	 */
	if ( ! function_exists( 'wm_theme_options_array' ) ) {
		function wm_theme_options_array( $options = array() ) {
			//Preparing output

				/**
				 * Theme customizer options array
				 */

					$options = array(

						/**
						 * Colors
						 */
						100 . 'colors' => array(
							'id'                   => 'colors',
							'type'                 => 'section',
							'create_section'       => _x( 'Colors', 'Customizer section title.', 'wm_domain' ),
							'in_panel'             => _x( 'Theme', 'Customizer panel title.', 'wm_domain' ),
							'in_panel-description' => '<h3>' . __( 'Theme Credits', 'wm_domain' ) . '</h3><p class="description">' . sprintf(
									__( '%s is free WordPress theme developed by WebMan. You can obtain other professional WordPress themes at <strong><a href="%s" target="_blank">WebManDesign.eu</a></strong>. Thank you for using this awesome theme!', 'wm_domain' ),
									'<strong>' . wp_get_theme()->get( 'Name' ) . '</strong>',
									esc_url( wp_get_theme()->get( 'AuthorURI' ) )
								) . '</p><p><a href="' . esc_url( trailingslashit( wp_get_theme()->get( 'AuthorURI' ) ) . WM_THEME_SHORTNAME . '-wordpress-theme/#donate' ) . '" class="donation-link" target="_blank">Donate</a></p>',
						),

							100 . 'colors' . 100 => array(
								'type'    => 'html',
								'content' => '<h3>' . __( 'Accent color', 'wm_domain' ) . '</h3>',
							),
								100 . 'colors' . 110 => array(
									'type'        => 'color',
									'id'          => 'color' . '-accent',
									'label'       => __( 'Accent color', 'wm_domain' ),
									'description' => __( 'This color affects links, buttons and other elements of the website', 'wm_domain' ),
									'default'     => '#0aac8e',
								),
								100 . 'colors' . 120 => array(
									'type'        => 'color',
									'id'          => 'color' . '-accent-text',
									'label'       => __( 'Accent text color', 'wm_domain' ),
									'description' => __( 'Color of text over accent color background', 'wm_domain' ),
									'default'     => '#ffffff',
								),

							100 . 'colors' . 200 => array(
								'type'    => 'html',
								'content' => '<h3>' . __( 'Header', 'wm_domain' ) . '</h3>',
							),
								100 . 'colors' . 210 => array(
									'type'        => 'color',
									'id'          => 'color' . '-header',
									'label'       => __( 'Background color', 'wm_domain' ),
									'default'     => '#1a1c1e',
								),
								100 . 'colors' . 220 => array(
									'type'        => 'color',
									'id'          => 'color' . '-header-text',
									'label'       => __( 'Text color', 'wm_domain' ),
									'description' => __( 'Note that for certain header elements the color will be faded out a bit', 'wm_domain' ),
									'default'     => '#ffffff',
								),

							100 . 'colors' . 300 => array(
								'type'    => 'html',
								'content' => '<h3>' . __( 'Content', 'wm_domain' ) . '</h3>',
							),

								100 . 'colors' . 370 => array(
									'type'    => 'html',
									'content' => '<h4>' . __( 'Front page widgets', 'wm_domain' ) . '</h4>',
								),
									100 . 'colors' . 373 => array(
										'type'        => 'color',
										'id'          => 'color' . '-front-widgets',
										'label'       => __( 'Background color', 'wm_domain' ),
										'default'     => '#1a1c1e',
									),
									100 . 'colors' . 376 => array(
										'type'        => 'color',
										'id'          => 'color' . '-front-widgets-text',
										'label'       => __( 'Text color', 'wm_domain' ),
										'default'     => '#8a8c8e',
									),

							100 . 'colors' . 400 => array(
								'type'    => 'html',
								'content' => '<h3>' . __( 'Footer', 'wm_domain' ) . '</h3>',
							),
								100 . 'colors' . 410 => array(
									'type'        => 'color',
									'id'          => 'color' . '-footer',
									'label'       => __( 'Background color', 'wm_domain' ),
									'default'     => '#1a1c1e',
								),
								100 . 'colors' . 420 => array(
									'type'        => 'color',
									'id'          => 'color' . '-footer-text',
									'label'       => __( 'Text color', 'wm_domain' ),
									'default'     => '#8a8c8e',
								),



						/**
						 * Fonts
						 */
						200 . 'fonts' => array(
							'id'             => 'fonts',
							'type'           => 'section',
							'create_section' => _x( 'Fonts', 'Customizer section title.', 'wm_domain' ),
							'in_panel'       => _x( 'Theme', 'Customizer panel title.', 'wm_domain' ),
						),

							200 . 'fonts' . 100 => array(
								'type'    => 'html',
								'content' => '<p class="description">' . __( 'Set a Google Font to be used for website logo, headings and general text.', 'wm_domain' ) . '<br />' . sprintf( __( 'Font matches recommendations from <a%s>Google Web Fonts Typographic Project</a>.', 'wm_domain' ), ' href="http://femmebot.github.io/google-type/" target="_blank"' ) . '</p>',
							),

								200 . 'fonts' . 110 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-logo',
									'label'   => __( 'Logo (site title) font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								200 . 'fonts' . 120 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-headings',
									'label'   => __( 'Headings font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								200 . 'fonts' . 130 => array(
									'type'    => 'select',
									'id'      => 'font' . '-family-body',
									'label'   => __( 'General text font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),

								200 . 'fonts' . 140 => array(
									'type'    => 'multiselect',
									'id'      => 'font' . '-subset',
									'label'   => __( 'Font subset', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts-subset' ),
									'default' => 'latin',
								),

								200 . 'fonts' . 150 => array(
									'type'          => 'text',
									'id'            => 'font' . '-size-body',
									'label'         => __( 'Basic font size', 'wm_domain' ),
									'description'   => __( 'All other font sizes are calculated automatically from this basic font size', 'wm_domain' ),
									'default'       => 16,
									'validate'      => 'absint',
									'customizer_js' => array(
											'css' => array(
													'html' => array( array( 'font-size', 'px' ) ),
												),
										),
								),



						/**
						 * Layout
						 */
						300 . 'layout' => array(
							'id'             => 'layout',
							'type'           => 'section',
							'create_section' => _x( 'Layout', 'Customizer section title.', 'wm_domain' ),
							'in_panel'       => _x( 'Theme', 'Customizer panel title.', 'wm_domain' ),
						),

							300 . 'layout' . 100 => array(
								'type'    => 'html',
								'content' => '<h3>' . __( 'Front page layout', 'wm_domain' ) . '</h3>',
							),
								300 . 'layout' . 110 => array(
									'type'        => 'select',
									'id'          => 'layout' . '-blog-condensed',
									'label'       => __( 'Condensed blog posts', 'wm_domain' ),
									'description' => __( 'Select if and where to display this page section', 'wm_domain' ),
									'default'     => 'top|10',
									'options'     => array(
											'-'         => __( 'Disable section', 'wm_domain' ),
											'top|10'    => __( 'First section above page content', 'wm_domain' ),
											'top|20'    => __( 'Second section above page content', 'wm_domain' ),
											'bottom|10' => __( 'First section below page content', 'wm_domain' ),
											'bottom|20' => __( 'Second section below page content', 'wm_domain' ),
										),
								),
								300 . 'layout' . 120 => array(
									'type'        => 'select',
									'id'          => 'layout' . '-food-menu',
									'label'       => __( 'Food menu', 'wm_domain' ),
									'description' => __( 'Select if and where to display this page section', 'wm_domain' ),
									'default'     => 'bottom|10',
									'options'     => array(
											'-'         => __( 'Disable section', 'wm_domain' ),
											'top|10'    => __( 'First section above page content', 'wm_domain' ),
											'top|20'    => __( 'Second section above page content', 'wm_domain' ),
											'bottom|10' => __( 'First section below page content', 'wm_domain' ),
											'bottom|20' => __( 'Second section below page content', 'wm_domain' ),
										),
								),

					);

			//Output
				return apply_filters( 'wmhook_wm_theme_options_array_output', $options );
		}
	} // /wm_theme_options_array



	/**
	 * Basic custom CSS styles template
	 *
	 * Use a '[[skin-option-id]]' tags in your custom CSS styles string
	 * where the specific option value should be used.
	 *
	 * @since    1.0
	 * @version  1.1
	 *
	 * @param  string $styles
	 */
	if ( ! function_exists( 'wm_custom_css_template' ) ) {
		function wm_custom_css_template( $styles = '' ) {
			//Preparing output
				ob_start();

				locate_template( 'css/_custom.css',      true );
				locate_template( 'css/_custom-plus.css', true );

				$styles = ob_get_clean();

			//Output
				return apply_filters( 'wmhook_wm_custom_css_template_output', $styles );
		}
	} // /wm_custom_css_template

?>