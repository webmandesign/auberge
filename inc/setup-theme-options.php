<?php
/**
 * Theme options
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
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
			add_filter( 'wmhook_theme_options_skin_array', 'wm_theme_options_skin_array', 10 );
		//Theme custom styles to be outputed in HTML head
			add_filter( 'wmhook_wm_custom_styles_output_preprocess', 'wm_custom_css_template', 10 );





/**
 * 20) Options functions
 */

	/**
	 * Set $wm_skin_design array
	 *
	 * @param  array $wm_skin_design
	 */
	if ( ! function_exists( 'wm_theme_options_skin_array' ) ) {
		function wm_theme_options_skin_array( $wm_skin_design = array() ) {
			//Preparing output

				/**
				 * Theme customizer options array
				 */

					$prefix = '';

					$wm_skin_design = array(

						/**
						 * Layout
						 */
						'layout' => array(
							'type'                     => 'section',
							'theme-customizer-section' => __( 'Layout', 'wm_domain' )
						),

							'layout' . 5 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Front page layout', 'wm_domain' ) . '</h3>',
							),
								'layout' . 10 => array(
									'type'        => 'select',
									'id'          => $prefix . 'layout' . '-blog-condensed',
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
								'layout' . 20 => array(
									'type'        => 'select',
									'id'          => $prefix . 'layout' . '-food-menu',
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



						/**
						 * Colors
						 */
						'colors' => array(
							'type'                     => 'section',
							'theme-customizer-section' => __( 'Colors', 'wm_domain' )
						),

							'colors' . 5 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Accent color', 'wm_domain' ) . '</h3>',
							),
								'colors' . 10 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-accent',
									'label'       => __( 'Accent color', 'wm_domain' ),
									'description' => __( 'This color affects links, buttons and other elements of the website', 'wm_domain' ),
									'default'     => '#0aac8e',
								),
								'colors' . 20 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-accent-text',
									'label'       => __( 'Accent text color', 'wm_domain' ),
									'description' => __( 'Color of text over accent color background', 'wm_domain' ),
									'default'     => '#ffffff',
								),

							'colors' . 25 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Header color', 'wm_domain' ) . '</h3>',
							),
								'colors' . 30 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-header',
									'label'       => __( 'Header background color', 'wm_domain' ),
									'default'     => '#1a1c1e',
								),
								'colors' . 40 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-header-text',
									'label'       => __( 'Header text color', 'wm_domain' ),
									'description' => __( 'Note that for certain header elements the color will be faded out a bit', 'wm_domain' ),
									'default'     => '#ffffff',
								),

							'colors' . 45 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Footer color', 'wm_domain' ) . '</h3>',
							),
								'colors' . 50 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-footer',
									'label'       => __( 'Footer background color', 'wm_domain' ),
									'default'     => '#1a1c1e',
								),
								'colors' . 60 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-footer-text',
									'label'       => __( 'Footer text color', 'wm_domain' ),
									'default'     => '#8a8c8e',
								),

							'colors' . 65 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Front page widgets color', 'wm_domain' ) . '</h3>',
							),
								'colors' . 70 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-front-widgets',
									'label'       => __( 'Front widgets background color', 'wm_domain' ),
									'default'     => '#1a1c1e',
								),
								'colors' . 80 => array(
									'type'        => 'color',
									'id'          => $prefix . 'color' . '-front-widgets-text',
									'label'       => __( 'Front widgets text color', 'wm_domain' ),
									'default'     => '#8a8c8e',
								),



						/**
						 * Fonts
						 */
						'fonts' => array(
							'type'                     => 'section',
							'theme-customizer-section' => __( 'Fonts', 'wm_domain' )
						),

							'fonts' . 10 => array(
								'type'    => 'theme-customizer-html',
								'content' => '<p class="description">' . __( 'Set a Google Font to be used for website logo, headings and general text.', 'wm_domain' ) . '<br />' . sprintf( __( 'Font matches recommendations from <a%s>Google Web Fonts Typographic Project</a>.', 'wm_domain' ), ' href="http://femmebot.github.io/google-type/" target="_blank"' ) . '</p>',
							),

								'fonts' . 20 => array(
									'type'    => 'select',
									'id'      => $prefix . 'font' . '-family-logo',
									'label'   => __( 'Logo (site title) font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								'fonts' . 30 => array(
									'type'    => 'select',
									'id'      => $prefix . 'font' . '-family-headings',
									'label'   => __( 'Headings font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),
								'fonts' . 40 => array(
									'type'    => 'select',
									'id'      => $prefix . 'font' . '-family-body',
									'label'   => __( 'General text font', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts' ),
									'default' => 'Ubuntu:400,300',
								),

								'fonts' . 50 => array(
									'type'    => 'multiselect',
									'id'      => $prefix . 'font' . '-subset',
									'label'   => __( 'Font subset', 'wm_domain' ),
									'options' => wm_helper_var( 'google-fonts-subset' ),
									'default' => 'latin',
								),

								'fonts' . 60 => array(
									'type'          => 'text',
									'id'            => $prefix . 'font' . '-size-body',
									'label'         => __( 'Basic font size', 'wm_domain' ),
									'description'   => __( 'All other font sizes are calculated automatically from this basic font size', 'wm_domain' ),
									'default'       => 16,
									'validate'      => 'absint',
									'customizer_js' => array(
											'css' => array(
													'body' => array( array( 'font-size', 'px' ) ),
												),
										),
								),



						/**
						 * Credits
						 */
						'credits' => array(
							'id'                       => 'credits',
							'type'                     => 'section',
							'theme-customizer-section' => 'Credits',
						),

							'credits' . 10 => array(
								'id'      => 'credits-text',
								'type'    => 'theme-customizer-html',
								'content' => '<h3>' . __( 'Theme Credits', 'wm_domain' ) . '</h3><p class="description">' . sprintf( __( '%s is free WordPress theme developed by WebMan. You can buy other professional WordPress themes at <strong><a href="%s" target="_blani">WebManDesign.eu</a></strong>. Thank you for using this awesome theme!', 'wm_domain' ), '<strong>' . WM_THEME_NAME . '</strong>', add_query_arg( array( 'utm_source' => WM_THEME_SHORTNAME . '-theme-credits' ), esc_url( WM_DEVELOPER_URL ) ) ) . '</p><p><a href="' . esc_url( trailingslashit( WM_DEVELOPER_URL ) . WM_THEME_SHORTNAME . '-wordpress-theme/donate' ) . '" class="donation-link" target="_blank">Donate</a></p>',
							),

					);

			//Output
				return apply_filters( 'wmhook_wm_theme_options_skin_array_output', $wm_skin_design );
		}
	} // /wm_theme_options_skin_array



	/**
	 * Basic custom CSS styles template
	 *
	 * Use a '[[skin-option-id]]' tags in your custom CSS styles string
	 * where the specific option value should be used.
	 *
	 * @param  string $styles
	 */
	if ( ! function_exists( 'wm_custom_css_template' ) ) {
		function wm_custom_css_template( $styles = '' ) {
			//Preparing output
				ob_start();

				locate_template( 'css/_custom.css', true );

				$styles = ob_get_clean();

			//Output
				return apply_filters( 'wmhook_wm_custom_css_template_output', $styles );
		}
	} // /wm_custom_css_template

?>