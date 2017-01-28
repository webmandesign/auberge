<?php
/**
 * Customizer options generator
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.2.0
 *
 * Contents:
 *
 *  1) Required files
 * 10) Assets
 * 20) Sanitize
 * 30) Customizer core
 * 40) CSS functions
 */





/**
 * 1) Required files
 */

	// Theme options arrays

		locate_template( 'includes/theme-options/theme-options.php', true );





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
	 * preview refresh. This is useful to disable "about theme page", for example.
	 *
	 * The actual JavaScript is outputted in the footer of the page.
	 *
	 * Use this structure for `preview_js` property:
	 *
	 * @example
	 *
	 *   'preview_js' => array(
	 *
	 *     // Setting CSS styles:
	 *
	 *       'css' => array(
	 *
	 *           // Sets the whole value to the `css-property-name` of the `selector`
	 *
	 *             'selector' => array(
	 *                 'css-property-name',...
	 *               ),
	 *
	 *           // Sets the `css-property-name` of the `selector` with value followed by the `suffix` (such as "px")
	 *
	 *             'selector' => array(
	 *                 array( 'css-property-name', 'suffix' ),...
	 *               ),
	 *
	 *           // Replaces "@" in `selector` for `selector-replace-value` (such as "@ h2, @ h3" to ".footer h2, .footer h3")
	 *
	 *             'selector' => array(
	 *                 'selector_replace' => 'selector-replace-value', // Must be the first array item
	 *                 'css-property-name',...
	 *               ),
	 *
	 *         ),
	 *
	 *     // Or setting custom JavaScript:
	 *
	 *       'custom' => 'JavaScript here', // Such as "jQuery( '.site-title.type-text' ).toggleClass( 'styled' );"
	 *
	 *   );
	 *
	 * @since    1.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_theme_customizer_js' ) ) {
		function wm_theme_customizer_js() {

			// Helper variables

				$theme_options = apply_filters( 'wmhook_theme_options', array() );

				ksort( $theme_options );

				$output = $output_single = '';


			// Processing

				if ( is_array( $theme_options ) && ! empty( $theme_options ) ) {

					foreach ( $theme_options as $theme_option ) {

						if ( isset( $theme_option['preview_js'] ) && is_array( $theme_option['preview_js'] ) ) {

							$output_single  = "wp.customize("  . "\r\n";
							$output_single .= "\t" . "'" . $theme_option['id'] . "',"  . "\r\n";
							$output_single .= "\t" . "function( value ) {"  . "\r\n";
							$output_single .= "\t\t" . 'value.bind( function( to ) {' . "\r\n";

							if ( isset( $theme_option['preview_js']['css'] ) ) {

								$output_single .= "\t\t\t" . "var newCss = '';" . "\r\n\r\n";
								$output_single .= "\t\t\t" . "if ( jQuery( '#jscss-" . $theme_option['id'] . "' ).length ) { jQuery( '#jscss-" . $theme_option['id'] . "' ).remove() }" . "\r\n\r\n";

								foreach ( $theme_option['preview_js']['css'] as $selector => $properties ) {

									if ( is_array( $properties ) ) {

										$output_single_css = '';

										foreach ( $properties as $key => $property ) {

											if ( 'selector_replace' === $key ) {
												$selector = str_replace( '@', $property, $selector );
												continue;
											}

											if ( ! is_array( $property ) ) {
												$property = array( $property, '' );
											}
											if ( ! isset( $property[1] ) ) {
												$property[1] = '';
											}
											if ( ! isset( $property[2] ) ) {
												$property[2] = '';
											}

											/**
											 * $property[0] = CSS style property
											 * $property[1] = suffix (such as CSS unit)
											 * $property[2] = prefix (such as CSS linear gradient)
											 */

											$output_single_css .= $property[0] . ": " . $property[2] . "' + to + '" . $property[1] . "; ";

										} // /foreach

										$output_single .= "\t\t\t" . "newCss += '" . $selector . " { " . $output_single_css . "} ';" . "\r\n";

									}

								} // /foreach

								$output_single .= "\r\n\t\t\t" . "jQuery( document ).find( 'head' ).append( jQuery( '<style id=\'jscss-" . $theme_option['id'] . "\'> ' + newCss + '</style>' ) );" . "\r\n";

							} elseif ( isset( $theme_option['preview_js']['custom'] ) ) {

								$output_single .= "\t\t" . $theme_option['preview_js']['custom'] . "\r\n";

							}

							$output_single .= "\t\t" . '} );' . "\r\n";
							$output_single .= "\t" . '}'. "\r\n";
							$output_single .= ');'. "\r\n";
							$output_single  = apply_filters( 'wmhook_wm_theme_customizer_js_option_' . $theme_option['id'], $output_single );

							$output .= $output_single;

						}

					} // /foreach

				}


			// Output

				if ( $output = trim( apply_filters( 'wmhook_wm_theme_customizer_js_output', $output ) ) ) {
					echo '<!-- Theme custom scripts -->' . "\r\n" . '<script type="text/javascript"><!--' . "\r\n" . '( function( $ ) {' . "\r\n\r\n" . trim( $output ) . "\r\n\r\n" . '} )( jQuery );' . "\r\n" . '//--></script>';
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
	 *
	 * @param  string               $value WP customizer value to sanitize.
	 * @param  WP_Customize_Setting $setting
	 */
	if ( ! function_exists( 'wm_sanitize_checkbox' ) ) {
		function wm_sanitize_checkbox( $value, $setting ) {

			// Output

				return apply_filters( 'wmhook_wm_sanitize_checkbox_output', ( ( isset( $value ) && true == $value ) ? ( true ) : ( false ) ), $value, $setting );

		}
	} // /wm_sanitize_checkbox



	/**
	 * Sanitize select/radio
	 *
	 * @since    2.0
	 * @version  2.0
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

				return apply_filters( 'wmhook_wm_sanitize_checkbox_output', ( array_key_exists( $value, $choices ) ? ( $value ) : ( $setting->default ) ), $value, $setting );

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
	 * @version  2.2.0
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

					$priority = apply_filters( 'wmhook_wm_theme_customizer_priority', 200 );

				// Default section name in case not set (should be overwritten anyway)

					$customizer_panel   = '';
					$customizer_section = 'auberge';

				/**
				 * @todo  Consider switching from 'type' => 'theme_mod' to 'option' for better theme upgradability.
				 */
				$type = apply_filters( 'wmhook_wm_theme_customizer_type', 'theme_mod' );


			// Processing

				// Moving "Widgets" panel after the custom "Theme" panel
				// @link  https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections

					if ( $wp_customize->get_panel( 'widgets' ) ) {
						$wp_customize->get_panel( 'widgets' )->priority = $priority + 10;
					}

				// Set live preview for predefined controls

					$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
					$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
					$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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

	add_action( 'customize_register', 'wm_theme_customizer', 100 ); // After Jetpack logo action





/**
 * 40) CSS styles
 */

	/**
	 * Outputs custom CSS styles set via Customizer
	 *
	 * This function allows you to hook your custom CSS styles string
	 * onto 'wmhook_custom_styles' filter hook.
	 * Then just use a '[[customizer_option_id]]' tags in your custom CSS
	 * styles string where the specific option value should be used.
	 *
	 * Caching $replacement into 'auberge-customizer-values' transient.
	 * Caching $output into 'auberge-custom-css' transient.
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  bool $set_cache  Determines whether the results should be cached or not.
	 * @param  bool $return     Whether to return a value or just run the process.
	 */
	if ( ! function_exists( 'wm_custom_styles' ) ) {
		function wm_custom_styles( $set_cache = false, $return = true ) {

			// Helper variables

				global $wp_customize;

				if ( ! isset( $wp_customize ) || ! is_object( $wp_customize ) ) {
					$wp_customize = null;
				}

				$output        = (string) apply_filters( 'wmhook_custom_styles', '' );
				$theme_options = (array) apply_filters( 'wmhook_theme_options', array() );
				$alphas        = array_filter( (array) apply_filters( 'wmhook_wm_custom_styles_alphas', array() ) );

				$replacements  = array_filter( array_filter( (array) get_transient( 'auberge-customizer-values' ) ) ); // There have to be values (defaults) set!

				/**
				 * Force caching during the first theme display when no cache set (default
				 * values will be used).
				 * Cache is being set only after saving Customizer.
				 */
				if ( empty( $replacements ) ) {
					$set_cache = true;
				}


			// Processing

				/**
				 * Setting up replacements array when no cache exists.
				 * Also, creates a new cache for replacements values.
				 * The cache is being created only when saving the Customizer settings.
				 */

					if (
							! empty( $theme_options )
							&& (
								( $wp_customize && $wp_customize->is_preview() )
								|| empty( $replacements )
							)
						) {

						foreach ( $theme_options as $theme_option ) {

							// Reset variables

								$option_id = $value = '';

							// Set option ID

								if ( isset( $theme_option['id'] ) ) {
									$option_id = $theme_option['id'];
								}

							// If no option ID set, jump to next option

								if ( empty( $option_id ) ) {
									continue;
								}

							// If we have an ID, get the default value if set

								if ( isset( $theme_option['default'] ) ) {
									$value = $theme_option['default'];
								}

							// Get the option value saved in database and apply it when exists

								if ( $mod = get_theme_mod( $option_id ) ) {
									$value = $mod;
								}

							// Make sure the color value contains '#'

								if ( 'color' === $theme_option['type'] ) {
									$value = wm_maybe_hash_hex_color( $value );
								}

							// Make sure the image URL is used in CSS format

								if ( 'image' === $theme_option['type'] ) {
									if ( is_array( $value ) && isset( $value['id'] ) ) {
										$value = absint( $value['id'] );
									}
									if ( is_numeric( $value ) ) {
										$value = wp_get_attachment_image_src( absint( $value ), 'full' );
										$value = $value[0];
									}
									if ( ! empty( $value ) ) {
										$value = "url('" . esc_url( $value ) . "')";
									} else {
										$value = 'none';
									}
								}

							// Value filtering

								$value = apply_filters( 'wmhook_wm_custom_styles_value', $value, $theme_option );

							// Convert array to string as otherwise the strtr() function throws error

								if ( is_array( $value ) ) {
									$value = (string) implode( ',', (array) $value );
								}

							// Finally modify the output string

								$replacements[ '[[' . str_replace( '-', '_', $option_id ) . ']]' ] = $value;

								// Add also rgba() color interpratation

									if ( 'color' === $theme_option['type'] && ! empty( $alphas ) ) {
										foreach ( $alphas as $alpha ) {
											$replacements[ '[[' . str_replace( '-', '_', $option_id ) . '(' . absint( $alpha ) . ')]]' ] = wm_color_hex_to_rgba( $value, absint( $alpha ) );
										} // /foreach
									}

						} // /foreach

						// Add WordPress Custom Background and Header support

							// Background color

								if ( $value = get_background_color() ) {
									$replacements['[[background_color]]'] = wm_maybe_hash_hex_color( $value );

									if ( ! empty( $alphas ) ) {
										foreach ( $alphas as $alpha ) {
											$replacements[ '[[background_color(' . absint( $alpha ) . ')]]' ] = wm_color_hex_to_rgba( $value, absint( $alpha ) );
										} // /foreach
									}
								}

							// Background image

								if ( $value = get_background_image() ) {
									$replacements['[[background_image]]'] = "url('" . esc_url( $value ) . "')";
								} else {
									$replacements['[[background_image]]'] = 'none';
								}

							// Header text color

								if ( $value = get_header_textcolor() ) {
									$replacements['[[header_textcolor]]'] = wm_maybe_hash_hex_color( $value );

									if ( ! empty( $alphas ) ) {
										foreach ( $alphas as $alpha ) {
											$replacements[ '[[header_textcolor(' . absint( $alpha ) . ')]]' ] = wm_color_hex_to_rgba( $value, absint( $alpha ) );
										} // /foreach
									}
								}

							// Header image

								if ( $value = get_header_image() ) {
									$replacements['[[header_image]]'] = "url('" . esc_url( $value ) . "')";
								} else {
									$replacements['[[header_image]]'] = 'none';
								}

						$replacements = (array) apply_filters( 'wmhook_wm_custom_styles_replacements', $replacements, $theme_options, $output );

						if (
								$set_cache
								&& ! empty( $replacements )
							) {
							set_transient( 'auberge-customizer-values', $replacements );
						}

					}

				// Prepare output and cache

					$output_cached = (string) get_transient( 'auberge-custom-css' );

					// Debugging set (via "debug" URL parameter)

						if ( isset( $_GET['debug'] ) ) {
							$output_cached = (string) get_transient( 'auberge-custom-css-debug' );
						}

					if (
							empty( $output_cached )
							|| ( $wp_customize && $wp_customize->is_preview() )
						) {

						// Replace tags in custom CSS strings with actual values

							$output = strtr( $output, $replacements );

						if ( $set_cache ) {
							set_transient( 'auberge-custom-css-debug', apply_filters( 'wmhook_wm_custom_styles_output_cache_debug', $output ) );
							set_transient( 'auberge-custom-css', apply_filters( 'wmhook_wm_custom_styles_output_cache', $output ) );
						}

					} else {

						$output = $output_cached;

					}


			// Output

				if ( $output && $return ) {
					return (string) apply_filters( 'wmhook_wm_custom_styles_output', trim( $output ) );
				}

		}
	} // /wm_custom_styles



		/**
		 * Flush out the transients used in wm_custom_styles
		 *
		 * @since    1.0
		 * @version  1.1
		 */
		if ( ! function_exists( 'wm_custom_styles_transient_flusher' ) ) {
			function wm_custom_styles_transient_flusher() {

				// Processing

					delete_transient( 'auberge-customizer-values' );
					delete_transient( 'auberge-custom-css-debug' );
					delete_transient( 'auberge-custom-css' );

			}
		} // /wm_custom_styles_transient_flusher

		add_action( 'switch_theme',         'wm_custom_styles_transient_flusher' );
		add_action( 'wmhook_theme_upgrade', 'wm_custom_styles_transient_flusher' );



	/**
	 * Force cache only for the above function
	 *
	 * Useful to pass into the action hooks.
	 *
	 * @since    1.0
	 * @version  1.0
	 */
	if ( ! function_exists( 'wm_custom_styles_cache' ) ) {
		function wm_custom_styles_cache() {

			// Processing

				// Set cache, do not return

					wm_custom_styles( true, false );

		}
	} // /wm_custom_styles_cache

	add_action( 'customize_save_after', 'wm_custom_styles_cache' );



	/**
	 * Hex color to RGBA
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @link  http://php.net/manual/en/function.hexdec.php
	 *
	 * @param  string $hex
	 * @param  absint $alpha [0-100]
	 *
	 * @return  string Color in rgb() or rgba() format to use in CSS.
	 */
	if ( ! function_exists( 'wm_color_hex_to_rgba' ) ) {
		function wm_color_hex_to_rgba( $hex, $alpha = 100 ) {

			// Helper variables

				$alpha = absint( $alpha );

				$output = ( 100 === $alpha ) ? ( 'rgb(' ) : ( 'rgba(' );

				$rgb = array();

				$hex = preg_replace( '/[^0-9A-Fa-f]/', '', $hex );
				$hex = substr( $hex, 0, 6 );


			// Processing

				// Converting hex color into rgb

					$color = (int) hexdec( $hex );

					$rgb['r'] = (int) 0xFF & ( $color >> 0x10 );
					$rgb['g'] = (int) 0xFF & ( $color >> 0x8 );
					$rgb['b'] = (int) 0xFF & $color;

					$output .= implode( ',', $rgb );

				// Using alpha (rgba)?

					if ( 100 > $alpha ) {
						$output .= ',' . ( $alpha / 100 );
					}

				// Closing opening bracket

					$output .= ')';


			// Output

				return apply_filters( 'wmhook_wm_color_hex_to_rgba_output', $output, $hex, $alpha );

		}
	} // /wm_color_hex_to_rgba



	/**
	 * CSS minifier
	 *
	 * @since    1.0
	 * @version  1.3
	 *
	 * @param  string $css Code to minify
	 */
	if ( ! function_exists( 'wm_minify_css' ) ) {
		function wm_minify_css( $css ) {

			// Requirements check

				if (
						! is_string( $css )
						&& ! apply_filters( 'wmhook_wm_minify_css_disable', false )
					) {
					return $css;
				}


			// Processing

				$css = apply_filters( 'wmhook_wm_minify_css_pre', $css );

				// Remove CSS comments

					$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

				// Remove tabs, spaces, line breaks, etc.

					$css = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $css );
					$css = str_replace( array( '  ', '   ', '    ', '     ' ), ' ', $css );
					$css = str_replace( array( ' { ', ': ', '; }' ), array( '{', ':', '}' ), $css );


			// Output

				return apply_filters( 'wmhook_wm_minify_css_output', $css );

		}
	} // /wm_minify_css

	add_filter( 'wmhook_wm_custom_styles_output_cache', 'wm_minify_css' );


	/**
	 * Duplicating WordPress native function in case it does not exist yet
	 *
	 * @since    1.0
	 * @version  1.0
	 *
	 * @link  https://developer.wordpress.org/reference/functions/maybe_hash_hex_color/
	 * @link  https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
	 *
	 * @param  string $color
	 */
	if ( ! function_exists( 'wm_maybe_hash_hex_color' ) ) {
		function wm_maybe_hash_hex_color( $color ) {

			// Requirements check

				if (
						function_exists( 'maybe_hash_hex_color' )
						&& function_exists( 'sanitize_hex_color_no_hash' )
					) {
					return maybe_hash_hex_color( $color );
				}


			// Helper variables

				// 3 or 6 hex digits, or the empty string.

					if ( preg_match( '|([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
						$color = ltrim( $color, '#' );
					} else {
						$color = '';
					}


			// Processing

				if ( $color ) {
					$color = '#' . $color;
				}


			// Output

				return $color;

		}
	} // /wm_maybe_hash_hex_color
