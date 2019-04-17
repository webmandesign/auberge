<?php
/**
 * Customizer options generator
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.5.2
 * @version  2.7.0
 *
 * Contents:
 *
 * 10) Assets
 * 20) Sanitize
 * 30) Customizer core
 * 40) CSS variables
 */





/**
 * 10) Assets
 */

	/**
	 * Customizer controls assets enqueue
	 *
	 * @since    2.0
	 * @version  2.2.0
	 */
	if ( ! function_exists( 'wm_theme_customizer_assets' ) ) {
		function wm_theme_customizer_assets() {

			// Processing

				wp_enqueue_style(
						'wm-customizer',
						get_template_directory_uri() . '/library/css/customize.css',
						false,
						esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
						'all'
					);

				wp_style_add_data( 'wm-customizer', 'rtl', 'replace' );

		}
	} // /wm_theme_customizer_assets

	add_action( 'customize_controls_enqueue_scripts', 'wm_theme_customizer_assets' );



	/**
	 * Outputs customizer JavaScript
	 *
	 * This function automatically outputs theme customizer preview JavaScript for each theme option,
	 * where the `preview_js` property is set.
	 *
	 * For CSS theme option change it works by inserting a `<style>` tag into a preview HTML head for
	 * each theme option separately. This is to prevent inline styles on elements when applied with
	 * pure JS.
	 * Also, we need to create the `<style>` tag for each option separately so way we gain control
	 * over the output. If we put all the CSS into a single `<style>` tag, it would be bloated with
	 * CSS styles for every single subtle change in the theme option(s).
	 *
	 * It is possible to set up a custom JS action, not just CSS styles change. That can be used
	 * to trigger a class on an element, for example.
	 *
	 * If `preview_js => false` set, the change of the theme option won't trigger the customizer
	 * preview refresh. This is useful to disable welcome page, for example.
	 *
	 * The actual JavaScript is outputted in the footer of the page.
	 *
	 * @example
	 *   'preview_js' => array(
	 *
	 *     // Setting CSS styles:
	 *     'css' => array(
	 *
	 *       // CSS variables (the `[[id]]` gets replaced with option ID)
	 * 			 ':root' => array(
	 *         '--[[id]]',
	 *       ),
	 * 			 ':root' => array(
	 *         array(
	 *           'property' => '--[[id]]',
	 *           'suffix'   => 'px',
	 *         ),
	 *       ),
	 *
	 *       // Sets the whole value to the `css-property-name` of the `selector`
	 *       'selector' => array(
	 *         'background-color',...
	 *       ),
	 *
	 *       // Sets the `css-property-name` of the `selector` with specific settings
	 *       'selector' => array(
	 *         array(
	 *           'property'         => 'text-shadow',
	 *           'prefix'           => '0 1px 1px rgba(',
	 *           'suffix'           => ', .5)',
	 *           'process_callback' => 'hexToRgb',
	 *           'custom'           => '0 0 0 1em [[value]] ), 0 0 0 2em transparent, 0 0 0 3em [[value]]',
	 *         ),...
	 *       ),
	 *
	 *       // Replaces "@" in `selector` for `selector-replace-value` (such as "@ h2, @ h3" to ".footer h2, .footer h3")
	 *       'selector' => array(
	 *         'selector_replace' => 'selector-replace-value',
	 *         'selector_before'  => '@media only screen and (min-width: 80em) {',
	 *         'selector_after'   => '}',
	 *         'background-color',...
	 *       ),
	 *
	 *     ),
	 *
	 *     // And/or setting custom JavaScript:
	 *     'custom' => 'JavaScript here', // Such as "jQuery( '.site-title.type-text' ).toggleClass( 'styled' );"
	 *
	 *   );
	 *
	 * @uses  `wmhook_theme_options` global hook
	 *
	 * @since    1.0
	 * @version  2.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_theme_customizer_js' ) ) {
		function wm_theme_customizer_js() {

			// Variables

				$theme_options = (array) apply_filters( 'wmhook_theme_options', array() );

				ksort( $theme_options );

				$output = $output_single = '';


			// Processing

				if (
					is_array( $theme_options )
					&& ! empty( $theme_options )
				) {

					foreach ( $theme_options as $theme_option ) {

						if (
							isset( $theme_option['preview_js'] )
							&& is_array( $theme_option['preview_js'] )
						) {

							$output_single  = "wp.customize("  . "\r\n";
							$output_single .= "\t" . "'" . $theme_option['id'] . "',"  . "\r\n";
							$output_single .= "\t" . "function( value ) {"  . "\r\n";
							$output_single .= "\t\t" . 'value.bind( function( to ) {' . "\r\n";

							// CSS

								if ( isset( $theme_option['preview_js']['css'] ) ) {
									$output_single .= "\t\t\t" . "var newCss = '';" . "\r\n\r\n";
									$output_single .= "\t\t\t" . "if ( jQuery( '#jscss-" . $theme_option['id'] . "' ).length ) { jQuery( '#jscss-" . $theme_option['id'] . "' ).remove() }" . "\r\n\r\n";

									foreach ( $theme_option['preview_js']['css'] as $selector => $properties ) {
										if ( is_array( $properties ) ) {
											$output_single_css = $selector_before = $selector_after = '';

											foreach ( $properties as $key => $property ) {

												// Selector setup

													if ( 'selector_replace' === $key ) {
														$selector = str_replace( '@', $property, $selector );
														continue;
													}

													if ( 'selector_before' === $key ) {
														$selector_before = $property;
														continue;
													}

													if ( 'selector_after' === $key ) {
														$selector_after = $property;
														continue;
													}

												// CSS properties setup

													if ( ! is_array( $property ) ) {
														$property = array( 'property' => (string) $property );
													}

													$property = wp_parse_args( (array) $property, array(
														'custom'           => '',
														'prefix'           => '',
														'process_callback' => '',
														'property'         => '',
														'suffix'           => '',
													) );

													// Replace `[[id]]` placeholder with option ID.
													$property['property'] = str_replace(
														'[[id]]',
														$theme_option['id'],
														$property['property']
													);

													$value = ( empty( $property['process_callback'] ) ) ? ( 'to' ) : ( trim( $property['process_callback'] ) . '( to )' );

													if ( empty( $property['custom'] ) ) {
														$output_single_css .= $property['property'] . ": " . $property['prefix'] . "' + " . $value . " + '" . $property['suffix'] . "; ";
													} else {
														$output_single_css .= $property['property'] . ": " . str_replace( '[[value]]', "' + " . $value . " + '", $property['custom'] ) . "; ";
													}

											}

											$output_single .= "\t\t\t" . "newCss += '" . $selector_before . $selector . " { " . $output_single_css . "}" . $selector_after . " ';" . "\r\n";

										}
									}

									$output_single .= "\r\n\t\t\t" . "jQuery( document ).find( 'head' ).append( jQuery( '<style id=\'jscss-" . $theme_option['id'] . "\'> ' + newCss + '</style>' ) );" . "\r\n";
								}

							// Custom JS

								if ( isset( $theme_option['preview_js']['custom'] ) ) {
									$output_single .= "\t\t" . $theme_option['preview_js']['custom'] . "\r\n";
								}

							$output_single .= "\t\t" . '} );' . "\r\n";
							$output_single .= "\t" . '}'. "\r\n";
							$output_single .= ');'. "\r\n";
							$output_single  = apply_filters( 'wmhook_wm_theme_customizer_js_option_' . $theme_option['id'], $output_single );

							$output .= $output_single;

						}

					}

				}


			// Output

				if ( $output = trim( $output ) ) {
					echo apply_filters( 'wmhook_wm_theme_customizer_js_output', '<!-- Theme custom scripts -->' . "\r\n" . '<script type="text/javascript"><!--' . "\r\n" . '( function( $ ) {' . "\r\n\r\n" . trim( $output ) . "\r\n\r\n" . '} )( jQuery );' . "\r\n" . '//--></script>' );
				}

		}
	} // /wm_theme_customizer_js





/**
 * 20) Sanitize
 */

	/**
	 * Sanitize checkbox
	 *
	 * @since    2.0
	 * @version  2.0
	 * @version  2.6.0
	 *
	 * @param  string               $value WP customizer value to sanitize.
	 * @param  WP_Customize_Setting $setting
	 */
	if ( ! function_exists( 'wm_sanitize_checkbox' ) ) {
		function wm_sanitize_checkbox( $value, $setting ) {

			// Output

				return ( isset( $value ) && true == $value ) ? ( true ) : ( false );

		}
	} // /wm_sanitize_checkbox



	/**
	 * Sanitize select/radio
	 *
	 * @since    2.0
	 * @version  2.0
	 * @version  2.6.0
	 *
	 * @param  string               $value WP customizer value to sanitize.
	 * @param  WP_Customize_Setting $setting
	 */
	if ( ! function_exists( 'wm_sanitize_select' ) ) {
		function wm_sanitize_select( $value, $setting ) {

			// Processing

				$value = esc_attr( $value );

				// Get list of choices from the control associated with the setting.

					$choices = $setting->manager->get_control( $setting->id )->choices;


			// Output

				return ( array_key_exists( $value, $choices ) ) ? ( $value ) : ( $setting->default );

		}
	} // /wm_sanitize_select



	/**
	 * No sanitization at all, simply return the value
	 *
	 * Useful for when the value may be of mixed type, such as array-or-string.
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  string               $value WP customizer value to sanitize.
	 * @param  WP_Customize_Setting $setting
	 */
	if ( ! function_exists( 'wm_sanitize_return_value' ) ) {
		function wm_sanitize_return_value( $value, $setting ) {

			// Helper variables

				$output = $value;


			// Processing

				if ( is_array( $value ) ) {
					$output = (array) $value;
				} elseif ( is_numeric( $value ) ) {
					$output = intval( $value );
				} elseif ( is_string( $value ) ) {
					$output = (string) $value;
				}


			// Output

				return apply_filters( 'wmhook_wm_sanitize_return_value_output', $output, $value, $setting );

		}
	} // /wm_sanitize_return_value





/**
 * 30) Customizer core
 */

	/**
	 * Customizer renderer
	 *
	 * @since    1.0
	 * @version  2.5.0
	 * @version  2.6.0
	 *
	 * @param  object $wp_customize WP customizer object.
	 */
	if ( ! function_exists( 'wm_theme_customizer' ) ) {
		function wm_theme_customizer( $wp_customize ) {

			// Requirements check

				if ( ! isset( $wp_customize ) ) {
					return;
				}


			// Helper variables

				$theme_options = (array) apply_filters( 'wmhook_theme_options', array() );

				ksort( $theme_options );

				$allowed_option_types = apply_filters( 'wmhook_wm_theme_customizer_allowed_option_types', array(
						'checkbox',
						'color',
						'hidden',
						'html',
						'image',
						'multiselect',
						'number',
						'radio',
						'range',
						'section',
						'select',
						'text',
						'textarea',
					) );

				// To make sure our customizer sections start after WordPress default ones

					$priority = apply_filters( 'wmhook_wm_theme_customizer_priority', 0 );

				// Default section name in case not set (should be overwritten anyway)

					$customizer_panel   = '';
					$customizer_section = 'auberge';

				$type = apply_filters( 'wmhook_wm_theme_customizer_type', 'theme_mod' );


			// Processing

				// Set live preview for predefined controls

					$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
					$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
					$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

				// Remove header color in favor of theme options

					$wp_customize->remove_control( 'header_textcolor' );

				// Move background color setting alongside background image

					$wp_customize->get_control( 'background_color' )->section  = 'background_image';
					$wp_customize->get_control( 'background_color' )->priority = 20;

				// Change background image section title & priority

					$wp_customize->get_section( 'background_image' )->title    = esc_html_x( 'Background', 'Customizer section title.', 'auberge' );
					$wp_customize->get_section( 'background_image' )->priority = 30;

				// Change header image section title & priority

					$wp_customize->get_section( 'header_image' )->title    = esc_html_x( 'Header', 'Customizer section title.', 'auberge' );
					$wp_customize->get_section( 'header_image' )->priority = 25;

				// Custom controls

					/**
					 * @link  https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
					 * @link  http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
					 */

					require_once( trailingslashit( dirname( __FILE__ ) ) . 'controls/class-WM_Customizer_Hidden.php' );
					require_once( trailingslashit( dirname( __FILE__ ) ) . 'controls/class-WM_Customizer_HTML.php' );
					require_once( trailingslashit( dirname( __FILE__ ) ) . 'controls/class-WM_Customizer_Multiselect.php' );
					require_once( trailingslashit( dirname( __FILE__ ) ) . 'controls/class-WM_Customizer_Select.php' );

					do_action( 'wmhook_wm_theme_customizer_load_controls', $wp_customize );

				// Generate customizer options

					if ( is_array( $theme_options ) && ! empty( $theme_options ) ) {

						foreach ( $theme_options as $theme_option ) {

							if (
									is_array( $theme_option )
									&& isset( $theme_option['type'] )
									&& in_array( $theme_option['type'], $allowed_option_types )
								) {

								// Helper variables

									$priority++;

									$option_id = $default = $description = '';

									if ( isset( $theme_option['id'] ) ) {
										$option_id = $theme_option['id'];
									}
									if ( isset( $theme_option['default'] ) ) {
										$default = $theme_option['default'];
									}
									if ( isset( $theme_option['description'] ) ) {
										$description = $theme_option['description'];
									}

									$transport = ( isset( $theme_option['preview_js'] ) ) ? ( 'postMessage' ) : ( 'refresh' );



								/**
								 * Panels
								 *
								 * Panels are wrappers for customizer sections.
								 * Note that the panel will not display unless sections are assigned to it.
								 * Set the panel name in the section declaration with `in_panel`.
								 * Panel has to be defined for each section to prevent all sections within a single panel.
								 *
								 * @link  http://make.wordpress.org/core/2014/07/08/customizer-improvements-in-4-0/
								 */
								if ( isset( $theme_option['in_panel'] ) ) {

									$panel_type = 'theme-options';

									if ( is_array( $theme_option['in_panel'] ) ) {

										$panel_title = isset( $theme_option['in_panel']['title'] ) ? ( $theme_option['in_panel']['title'] ) : ( '&mdash;' );
										$panel_id    = isset( $theme_option['in_panel']['id'] ) ? ( $theme_option['in_panel']['id'] ) : ( $panel_type );
										$panel_type  = isset( $theme_option['in_panel']['type'] ) ? ( $theme_option['in_panel']['type'] ) : ( $panel_type );

									} else {

										$panel_title = $theme_option['in_panel'];
										$panel_id    = $panel_type;

									}

									$panel_id = apply_filters( 'wmhook_wm_theme_customizer_panel_id', $panel_id, $theme_option, $theme_options );

									if ( $customizer_panel !== $panel_id ) {

										$wp_customize->add_panel(
												$panel_id,
												array(
													'title'       => esc_html( $panel_title ),
													'description' => ( isset( $theme_option['in_panel-description'] ) ) ? ( $theme_option['in_panel-description'] ) : ( '' ), // Hidden at the top of the panel
													'priority'    => $priority,
													'type'        => $panel_type, // Sets also the panel class
												)
											);

										$customizer_panel = $panel_id;

									}

								}



								/**
								 * Sections
								 */
								if ( isset( $theme_option['create_section'] ) && trim( $theme_option['create_section'] ) ) {

									if ( empty( $option_id ) ) {
										$option_id = sanitize_title( trim( $theme_option['create_section'] ) );
									}

									$customizer_section = array(
											'id'    => $option_id,
											'setup' => array(
													'title'       => $theme_option['create_section'], // Section title
													'description' => ( isset( $theme_option['create_section-description'] ) ) ? ( $theme_option['create_section-description'] ) : ( '' ), // Displayed at the top of section
													'priority'    => $priority,
													'type'        => 'theme-options', // Sets also the section class
												)
										);

									if ( ! isset( $theme_option['in_panel'] ) ) {
										$customizer_panel = '';
									} else {
										$customizer_section['setup']['panel'] = $customizer_panel;
									}

									$wp_customize->add_section(
											$customizer_section['id'],
											$customizer_section['setup']
										);

									$customizer_section = $customizer_section['id'];

								}



								/**
								 * Options generator
								 */
								switch ( $theme_option['type'] ) {

									/**
									 * Checkbox, radio
									 */
									case 'checkbox':
									case 'radio':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( 'checkbox' === $theme_option['type'] ) ? ( 'wm_sanitize_checkbox' ) : ( 'wm_sanitize_select' ),
													'sanitize_js_callback' => ( 'checkbox' === $theme_option['type'] ) ? ( 'wm_sanitize_checkbox' ) : ( 'wm_sanitize_select' ),
												)
											);

										$wp_customize->add_control(
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'type'            => $theme_option['type'],
													'choices'         => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											);

									break;

									/**
									 * Color
									 */
									case 'color':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => trim( $default, '#' ),
													'transport'            => $transport,
													'sanitize_callback'    => 'sanitize_hex_color_no_hash',
													'sanitize_js_callback' => 'maybe_hash_hex_color',
												)
											);

										$wp_customize->add_control( new WP_Customize_Color_Control(
												$wp_customize,
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											) );

									break;

									/**
									 * Hidden
									 */
									case 'hidden':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
												)
											);

										$wp_customize->add_control( new WM_Customizer_Hidden(
												$wp_customize,
												$option_id,
												array(
													'label'    => 'HIDDEN FIELD',
													'section'  => $customizer_section,
													'priority' => $priority,
												)
											) );

									break;

									/**
									 * HTML
									 */
									case 'html':

										if ( empty( $option_id ) ) {
											$option_id = 'custom-title-' . $priority;
										}

										$wp_customize->add_setting(
												$option_id,
												array(
													'sanitize_callback'    => 'wp_filter_post_kses',
													'sanitize_js_callback' => 'wp_filter_post_kses',
												)
											);

										$wp_customize->add_control( new WM_Customizer_HTML(
												$wp_customize,
												$option_id,
												array(
													'label'           => ( isset( $theme_option['label'] ) ) ? ( $theme_option['label'] ) : ( '' ),
													'description'     => $description,
													'content'         => $theme_option['content'],
													'section'         => $customizer_section,
													'priority'        => $priority,
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											) );

									break;

									/**
									 * Image
									 */
									case 'image':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
												)
											);

										$wp_customize->add_control( new WP_Customize_Image_Control(
												$wp_customize,
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'context'         => $option_id,
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											) );

									break;

									/**
									 * Multiselect
									 */
									case 'multiselect':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'wm_sanitize_return_value' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'wm_sanitize_return_value' ),
												)
											);

										$wp_customize->add_control( new WM_Customizer_Multiselect(
												$wp_customize,
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'choices'         => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											) );

									break;

									/**
									 * Range & number
									 */
									case 'number':
									case 'range':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
												)
											);

										$wp_customize->add_control(
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'type'            => $theme_option['type'],
													'input_attrs'     => array(
														'min'  => ( isset( $theme_option['min'] ) ) ? ( $theme_option['min'] ) : ( 0 ),
														'max'  => ( isset( $theme_option['max'] ) ) ? ( $theme_option['max'] ) : ( 100 ),
														'step' => ( isset( $theme_option['step'] ) ) ? ( $theme_option['step'] ) : ( 1 ),
													),
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											);

									break;

									/**
									 * Select (with optgroups)
									 */
									case 'select':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => 'wm_sanitize_select',
													'sanitize_js_callback' => 'wm_sanitize_select',
												)
											);

										$wp_customize->add_control( new WM_Customizer_Select(
												$wp_customize,
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'choices'         => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											) );

									break;

									/**
									 * Text
									 */
									case 'text':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
												)
											);

										$wp_customize->add_control(
												$option_id,
												array(
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											);

									break;

									/**
									 * Textarea
									 *
									 * Since WordPress 4.0 this is native input field.
									 */
									case 'textarea':

										$wp_customize->add_setting(
												$option_id,
												array(
													'type'                 => $type,
													'default'              => $default,
													'transport'            => $transport,
													'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
													'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
												)
											);

										$wp_customize->add_control(
												$option_id,
												array(
													'type'            => 'textarea',
													'label'           => $theme_option['label'],
													'description'     => $description,
													'section'         => $customizer_section,
													'priority'        => $priority,
													'active_callback' => ( isset( $theme_option['active_callback'] ) ) ? ( $theme_option['active_callback'] ) : ( null ),
												)
											);

									break;

									/**
									 * Default
									 */
									default:
									break;

								} // /switch

							} // /if suitable option array

						} // /foreach

					} // /if skin options are non-empty array

				// Assets needed for customizer preview

					if ( $wp_customize->is_preview() ) {
						add_action( 'wp_footer', 'wm_theme_customizer_js', 99 );
					}

		}
	} // /wm_theme_customizer

	add_action( 'customize_register', 'wm_theme_customizer' );





/**
 * 40) CSS variables
 */

	/**
	 * Ensure compatibility with older browsers.
	 *
	 * @link  https://github.com/jhildenbiddle/css-vars-ponyfill
	 *
	 * @since    2.6.0
	 * @version  2.7.0
	 */
	if ( ! function_exists( 'wm_css_vars_compatibility' ) ) {
		function wm_css_vars_compatibility() {

			// Processing

				wp_enqueue_script(
					'css-vars-ponyfill',
					trailingslashit( get_template_directory_uri() ) . 'library/js/vendor/css-vars-ponyfill/css-vars-ponyfill.min.js',
					array(),
					'1.16.1'
				);

				wp_add_inline_script(
					'css-vars-ponyfill',
					'window.onload = function() {' . PHP_EOL .
					"\t" . 'cssVars( {' . PHP_EOL .
					"\t\t" . 'onlyVars: true,' . PHP_EOL .
					"\t\t" . 'exclude: \'link:not([href^="' . esc_url_raw( get_theme_root_uri() ) . '"])\'' . PHP_EOL .
					"\t" . '} );' . PHP_EOL .
					'};'
				);

		}
	} // /wm_css_vars_compatibility

	add_action( 'wp_enqueue_scripts', 'wm_css_vars_compatibility', 0 );



	/**
	 * Get CSS vars from theme options.
	 *
	 * @since    2.6.0
	 * @version  2.7.0
	 */
	if ( ! function_exists( 'wm_get_css_vars_from_theme_options' ) ) {
		function wm_get_css_vars_from_theme_options() {

			// Variables

				$is_customize_preview = is_customize_preview();
				$cache_transient      = wm_get_transient_key( 'css-vars' );

				$css_vars = (string) get_transient( $cache_transient );


			// Requirements check

				if (
					! empty( $css_vars )
					&& ! $is_customize_preview
				) {
					return (string) $css_vars;
				}


			// Processing

				foreach ( (array) apply_filters( 'wmhook_theme_options', array() ) as $option ) {
					if ( ! isset( $option['css_var'] ) ) {
						continue;
					}

					if ( isset( $option['default'] ) ) {
						$value = $option['default'];
					} else {
						$value = '';
					}

					$mod = get_theme_mod( $option['id'] );
					if (
						isset( $option['validate'] )
						&& is_callable( $option['validate'] )
					) {
						$mod = call_user_func( $option['validate'], $mod );
					}
					if (
						! empty( $mod )
						|| 'checkbox' === $option['type']
					) {
						if ( 'color' === $option['type'] ) {
							$value_check = maybe_hash_hex_color( $value );
							$mod         = maybe_hash_hex_color( $mod );
						} else {
							$value_check = $value;
						}
						// No need to output CSS var if it is the same as default.
						if ( $value_check === $mod ) {
							continue;
						}
						$value = $mod;
					} else {
						// No need to output CSS var if it was not changed in customizer.
						continue;
					}

					// Array value to string. Just in case.
					if ( is_array( $value ) ) {
						$value = (string) implode( ',', (array) $value );
					}

					if ( is_callable( $option['css_var'] ) ) {
						$value = call_user_func( $option['css_var'], $value );
					} else {
						$value = str_replace(
							'[[value]]',
							$value,
							(string) $option['css_var']
						);
					}

					// Do not apply `esc_attr()` as it will escape quote marks, such as in background image URL.
					$css_vars .= ' --' . sanitize_title( $option['id'] ) . ': ' . $value . ';';
				}

				// Cache the results.
				if ( ! $is_customize_preview ) {
					set_transient( $cache_transient, $css_vars );
				}


			// Output

				return (string) $css_vars;

		}
	} // /wm_get_css_vars_from_theme_options



	/**
	 * Customized styles.
	 *
	 * @since    2.6.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_customized_styles' ) ) {
		function wm_customized_styles() {

			// Processing

				if ( $css_vars = wm_get_css_vars_from_theme_options() ) {

					$css_vars = (string) apply_filters( 'wmhook_wm_customized_styles',
						'/* START CSS variables */'
						. PHP_EOL
						. ':root { '
						. PHP_EOL
						. $css_vars
						. PHP_EOL
						. '}'
						. PHP_EOL
						. '/* END CSS variables */'
					);

					wp_add_inline_style(
						'auberge',
						apply_filters( 'wmhook_esc_css', $css_vars )
					);

				}

		}
	} // /wm_customized_styles

	add_action( 'wp_enqueue_scripts', 'wm_customized_styles', 110 );



	/**
	 * Customized styles: editor.
	 *
	 * Ajax callback for outputting custom styles for content editor.
	 *
	 * @see  https://github.com/justintadlock/stargazer/blob/master/inc/custom-colors.php
	 *
	 * @since    2.6.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_customized_styles_editor' ) ) {
		function wm_customized_styles_editor() {

			// Processing

				if ( $css_vars = wm_get_css_vars_from_theme_options() ) {
					header( 'Content-type: text/css' );

					$css_vars = (string) apply_filters( 'wmhook_wm_customized_styles_editor',
						'/* START CSS variables */'
						. PHP_EOL
						. ':root { '
						. PHP_EOL
						. $css_vars
						. PHP_EOL
						. '}'
						. PHP_EOL
						. '/* END CSS variables */'
					);

					echo (string) apply_filters( 'wmhook_esc_css', $css_vars );
				}

				die();

		}
	} // /wm_customized_styles_editor

	add_action( 'wp_ajax_auberge_editor_styles',         'wm_customized_styles_editor' );
	add_action( 'wp_ajax_no_priv_auberge_editor_styles', 'wm_customized_styles_editor' );



		/**
		 * Enqueue customized styles as editor stylesheet.
		 *
		 * @since    2.6.0
		 * @version  2.6.0
		 *
		 * @param  array $visual_editor_css
		 */
		if ( ! function_exists( 'wm_customized_styles_editor_enqueue' ) ) {
			function wm_customized_styles_editor_enqueue( $visual_editor_css = array() ) {

				// Processing

					/**
					 * @see  `stargazer_get_editor_styles` https://github.com/justintadlock/stargazer/blob/master/inc/stargazer.php
					 */
					$visual_editor_css[] = esc_url_raw( add_query_arg(
						array(
							'action' => 'auberge_editor_styles',
							'ver'    => wp_get_theme( get_template() )->get( 'Version' ) . '.' . get_theme_mod( '__customize_timestamp' ),
						),
						admin_url( 'admin-ajax.php' )
					) );


				// Output

					return $visual_editor_css;

			}
		} // /wm_customized_styles_editor_enqueue

		add_filter( 'wmhook_wm_setup_visual_editor_css', 'wm_customized_styles_editor_enqueue' );



	/**
	 * Customizer save timestamp.
	 *
	 * @since    2.6.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_customize_timestamp' ) ) {
		function wm_customize_timestamp() {

			// Processing

				set_theme_mod( '__customize_timestamp', esc_attr( gmdate( 'ymdHis' ) ) );

		}
	} // /wm_customize_timestamp

	add_action( 'customize_save_after', 'wm_customize_timestamp' );



	/**
	 * Cache: Flush CSS vars.
	 *
	 * @since    2.6.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_cache_flush_css_vars' ) ) {
		function wm_cache_flush_css_vars() {

			// Processing

				delete_transient( wm_get_transient_key( 'css-vars' ) );

		}
	} // /wm_cache_flush_css_vars

	add_action( 'switch_theme',         'wm_cache_flush_css_vars' );
	add_action( 'customize_save_after', 'wm_cache_flush_css_vars' );
	add_action( 'wmhook_theme_upgrade', 'wm_cache_flush_css_vars' );
