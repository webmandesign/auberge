<?php
/**
 * Customizer options generator
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.4.8
 *
 * CONTENT:
 * -  1) Required files
 * - 10) Actions and filters
 * - 20) Helpers
 * - 30) Sanitizing functions
 * - 40) Main customizer function
 * - 50) CSS styles
 */





/**
 * 1) Required files
 */

	//Theme options arrays
		locate_template( WM_INC_DIR . 'setup-theme-options.php', true );





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Register customizer
			add_action( 'customize_register', 'wm_theme_customizer' );
		//Save Customizer options
			add_action( 'customize_save_after', 'wm_custom_styles_cache' );
		//Flushing transients
			add_action( 'switch_theme',         'wm_custom_styles_transient_flusher' );
			add_action( 'wmhook_theme_upgrade', 'wm_custom_styles_transient_flusher' );



	/**
	 * Filters
	 */

		//Minify custom CSS
			add_filter( 'wmhook_wm_custom_styles_output_cache', 'wm_minify_css' );





/**
 * 20) Helpers
 */

	/**
	 * Outputs customizer JavaScript in footer
	 *
	 * Use this structure for customizer_js property:
	 * 'customizer_js' => array(
	 * 			'css'    => array(
	 * 					'.selector'         => array( 'css-property-name' ),
	 * 					'.another-selector' => array( array( 'padding-left', 'px' ) ),
	 * 				),
	 * 			'custom' => 'your_custom_JavaScript_here',
	 * 		)
	 *
	 * @since    1.0
	 * @version  1.3
	 */
	if ( ! function_exists( 'wm_theme_customizer_js' ) ) {
		function wm_theme_customizer_js() {
			//Helper variables
				$theme_options = apply_filters( 'wmhook_theme_options', array() );

				ksort( $theme_options );

				$output = $output_single = '';

			//Preparing output
				if ( is_array( $theme_options ) && ! empty( $theme_options ) ) {

					foreach ( $theme_options as $theme_option ) {

						if ( isset( $theme_option['customizer_js'] ) ) {

							$output_single  = "wp.customize( '" . $theme_option['id'] . "', function( value ) {"  . "\r\n";
							$output_single .= "\t" . 'value.bind( function( newval ) {' . "\r\n";

							if ( ! isset( $theme_option['customizer_js']['custom'] ) ) {

								foreach ( $theme_option['customizer_js']['css'] as $selector => $properties ) {

									if ( is_array( $properties ) ) {

										$output_single_css = '';

										foreach ( $properties as $property ) {

											if ( ! is_array( $property ) ) {
												$property = array( $property, '' );
											}
											if ( ! isset( $property[1] ) ) {
												$property[1] = '';
											}
											if ( trim( $property[1] ) ) {
												$property[1] = ' + "' . $property[1] . '"';
											}

											$output_single_css .= '.css( "' . $property[0] . '", newval' . $property[1] . ' )';

										} // /foreach

									}

									$output_single .= "\t\t" . '$( "' . $selector . '" )' . $output_single_css . ";\r\n";

								} // /foreach

							} else {

								$output_single .= "\t\t" . $theme_option['customizer_js']['custom'] . "\r\n";

							}

							$output_single .= "\t" . '} );' . "\r\n";
							$output_single .= '} );'. "\r\n";
							$output_single  = apply_filters( 'wmhook_wm_theme_customizer_js_option_' . $theme_option['id'], $output_single );

							$output .= $output_single;

						}

					} // /foreach

				}

			//Output
				if ( $output = trim( apply_filters( 'wmhook_wm_theme_customizer_js_output', $output ) ) ) {
					echo '<!-- Theme custom scripts -->' . "\r\n" . '<script type="text/javascript"><!--' . "\r\n" . '( function( $ ) {' . "\r\n\r\n" . $output . "\r\n\r\n" . '} )( jQuery );' . "\r\n" . '//--></script>';
				}
		}
	} // /wm_theme_customizer_js





/**
 * 30) Sanitizing functions
 */

	/**
	 * Sanitize texts
	 *
	 * @since    1.0
	 * @version  1.0
	 *
	 * @param  mixed $value WP customizer value to sanitize.
	 */
	if ( ! function_exists( 'wm_sanitize_text' ) ) {
		function wm_sanitize_text( $value ) {
			return apply_filters( 'wmhook_wm_sanitize_text_output', wp_kses_post( force_balance_tags( $value ) ) );
		}
	} // /wm_sanitize_text



	/**
	 * No sanitization at all, simply return the value
	 *
	 * Useful for when the value may be of mixed type, such as array-or-string.
	 *
	 * @since    1.0
	 * @version  1.3
	 *
	 * @param  mixed $value WP customizer value to sanitize.
	 */
	if ( ! function_exists( 'wm_sanitize_return_value' ) ) {
		function wm_sanitize_return_value( $value ) {
			//Preparing output
				if ( is_array( $value ) ) {
					$value = (array) $value;
				} elseif ( is_numeric( $value ) ) {
					$value = intval( $value );
				} elseif ( is_string( $value ) ) {
					$value = (string) $value;
				}

			//Output
				return apply_filters( 'wmhook_wm_sanitize_return_value_output', $value );
		}
	} // /wm_sanitize_return_value





/**
 * 40) Main customizer function
 */

	/**
	 * Registering sections and options for WP Customizer
	 *
	 * @since    1.0
	 * @version  1.4.8
	 *
	 * @param  object $wp_customize WP customizer object.
	 */
	if ( ! function_exists( 'wm_theme_customizer' ) ) {
		function wm_theme_customizer( $wp_customize ) {

			//Make predefined controls use live preview JS
				$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
				$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
				$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



			/**
			 * Custom customizer controls
			 *
			 * @link  https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
			 * @link  http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
			 */

				locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_Hidden.php',      true );
				locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_HTML.php',        true );
				locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_Image.php',       true );
				locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_Multiselect.php', true );
				locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_Select.php',      true );
				if ( ! wm_check_wp_version( 4 ) ) {
					locate_template( WM_INC_DIR . 'customizer/controls/class-WM_Customizer_Textarea.php', true );
				}

				do_action( 'wmhook_wm_theme_customizer_load_controls', $wp_customize );



			//Helper variables
				$theme_options = (array) apply_filters( 'wmhook_theme_options', array() );

				ksort( $theme_options );

				$allowed_option_types = apply_filters( 'wmhook_wm_theme_customizer_allowed_option_types', array(
						'checkbox',
						'color',
						'hidden',
						'html',
						'image',
						'multiselect',
						'radio',
						'range', //This does not display the value indicator, only the slider, unfortunatelly...
						'select',
						'text',
						'textarea',
					) );

				//To make sure our customizer sections start after WordPress default ones
					$priority = apply_filters( 'wmhook_wm_theme_customizer_priority', 900 );
				//Default section name in case not set (should be overwritten anyway)
					$customizer_panel   = '';
					$customizer_section = WM_THEME_SHORTNAME;

				/**
				 * @todo  Consider switching from 'type' => 'theme_mod' to 'option' for better theme upgradability.
				 */

			//Generate customizer options
				if ( is_array( $theme_options ) && ! empty( $theme_options ) ) {

					foreach ( $theme_options as $theme_option ) {

						if (
								is_array( $theme_option )
								&& isset( $theme_option['type'] )
								&& (
										in_array( $theme_option['type'], $allowed_option_types )
										|| isset( $theme_option['create_section'] )
									)
							) {

							//Helper variables
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

								$transport = ( isset( $theme_option['customizer_js'] ) ) ? ( 'postMessage' ) : ( 'refresh' );



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

								$panel_id = sanitize_title( trim( $theme_option['in_panel'] ) );

								if ( $customizer_panel !== $panel_id ) {

									$wp_customize->add_panel(
											$panel_id,
											array(
												'title'       => $theme_option['in_panel'], // Panel title
												'description' => ( isset( $theme_option['in_panel-description'] ) ) ? ( $theme_option['in_panel-description'] ) : ( '' ), // Hidden at the top of the panel
												'priority'    => $priority,
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
								 * Color
								 */
								case 'color':

									$wp_customize->add_setting(
											$option_id,
											array(
												'type'                 => 'theme_mod',
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
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
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
												'type'                 => 'theme_mod',
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
												'sanitize_callback'    => 'wm_sanitize_text',
												'sanitize_js_callback' => 'wm_sanitize_text',
											)
										);

									$wp_customize->add_control( new WM_Customizer_HTML(
											$wp_customize,
											$option_id,
											array(
												'label'    => $theme_option['content'],
												'section'  => $customizer_section,
												'priority' => $priority,
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
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'wm_sanitize_return_value' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'wm_sanitize_return_value' ),
											)
										);

									$wp_customize->add_control( new WM_Customizer_Image(
											$wp_customize,
											$option_id,
											array(
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
												'context'     => $option_id,
											)
										) );

								break;

								/**
								 * Checkbox, radio
								 */
								case 'checkbox':
								case 'radio':

									$wp_customize->add_setting(
											$option_id,
											array(
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
											)
										);

									$wp_customize->add_control(
											$option_id,
											array(
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
												'type'        => $theme_option['type'],
												'choices'     => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
											)
										);

								break;

								/**
								 * Multiselect
								 */
								case 'multiselect':

									$wp_customize->add_setting(
											$option_id,
											array(
												'type'                 => 'theme_mod',
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
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
												'choices'     => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
											)
										) );

								break;

								/**
								 * Range
								 */
								case 'range':

									$wp_customize->add_setting(
											$option_id,
											array(
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'absint' ),
											)
										);

									if ( wm_check_wp_version( 4 ) ) {

										$wp_customize->add_control(
												$option_id,
												array(
													'label'       => $theme_option['label'],
													'description' => $description,
													'section'     => $customizer_section,
													'priority'    => $priority,
													'type'        => 'range',
													'input_attrs' => array(
														'min'  => ( isset( $theme_option['min'] ) ) ? ( intval( $theme_option['min'] ) ) : ( 0 ),
														'max'  => ( isset( $theme_option['max'] ) ) ? ( intval( $theme_option['max'] ) ) : ( 100 ),
														'step' => ( isset( $theme_option['step'] ) ) ? ( intval( $theme_option['step'] ) ) : ( 1 ),
													),
												)
											);

									} else {

										$wp_customize->add_control(
												$option_id,
												array(
													'label'       => $theme_option['label'],
													'description' => $description,
													'section'     => $customizer_section,
													'priority'    => $priority,
												)
											);

									}

								break;

								/**
								 * Select (with optgroups)
								 */
								case 'select':

									$wp_customize->add_setting(
											$option_id,
											array(
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_attr' ),
											)
										);

									$wp_customize->add_control( new WM_Customizer_Select(
											$wp_customize,
											$option_id,
											array(
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
												'choices'     => ( isset( $theme_option['options'] ) ) ? ( $theme_option['options'] ) : ( '' ),
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
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
											)
										);

									$wp_customize->add_control(
											$option_id,
											array(
												'label'       => $theme_option['label'],
												'description' => $description,
												'section'     => $customizer_section,
												'priority'    => $priority,
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
												'type'                 => 'theme_mod',
												'default'              => $default,
												'transport'            => $transport,
												'sanitize_callback'    => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
												'sanitize_js_callback' => ( isset( $theme_option['validate'] ) ) ? ( $theme_option['validate'] ) : ( 'esc_textarea' ),
											)
										);

									if ( wm_check_wp_version( 4 ) ) {

										$wp_customize->add_control(
												$option_id,
												array(
													'type'        => 'textarea',
													'label'       => $theme_option['label'],
													'description' => $description,
													'section'     => $customizer_section,
													'priority'    => $priority,
												)
											);

									} else {

										$wp_customize->add_control( new WM_Customizer_Textarea(
												$wp_customize,
												$option_id,
												array(
													'label'       => $theme_option['label'],
													'description' => $description,
													'section'     => $customizer_section,
													'priority'    => $priority,
												)
											) );

									}

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

			//Assets needed for customizer preview
				if ( $wp_customize->is_preview() ) {
					add_action( 'wp_footer', 'wm_theme_customizer_js', 99 );
				}
		}
	} // /wm_theme_customizer





/**
 * 50) CSS styles
 */

	/**
	 * Outputs custom CSS styles set via Customizer
	 *
	 * This function allows you to hook your custom CSS styles string
	 * onto 'wmhook_custom_styles' filter hook.
	 * Then just use a '[[skin-option-id]]' tags in your custom CSS
	 * styles string where the specific option value should be used.
	 *
	 * Caching $replacement into 'WM_THEME_SHORTNAME-customizer-values' transient.
	 * Caching $output into 'WM_THEME_SHORTNAME-custom-css' transient.
	 *
	 * @since    1.0
	 * @version  1.3
	 *
	 * @param  bool $set_cache  Determines whether the results should be cached or not.
	 * @param  bool $return     Whether to return a value or just run the process.
	 */
	if ( ! function_exists( 'wm_custom_styles' ) ) {
		function wm_custom_styles( $set_cache = false, $return = true ) {
			//Helper variables
				global $wp_customize;

				if ( ! isset( $wp_customize ) || ! is_object( $wp_customize ) ) {
					$wp_customize = null;
				}

				$output        = (string) apply_filters( 'wmhook_custom_styles', '' );
				$theme_options = (array) apply_filters( 'wmhook_theme_options', array() );

				$replacements  = array_filter( (array) get_transient( WM_THEME_SHORTNAME . '-customizer-values' ) ); //There have to be values (defaults) set!

				/**
				 * Force caching during the first theme display when no cache set (default
				 * values will be used).
				 * Cache is being set only after saving Customizer.
				 */
				if ( empty( $replacements ) ) {
					$set_cache = true;
				}

			//Preparing output
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

							//Reset variables
								$option_id = $value = '';

							//Set option ID
								if ( isset( $theme_option['id'] ) ) {
									$option_id = $theme_option['id'];
								}

							//If no option ID set, jump to next option
								if ( empty( $option_id ) ) {
									continue;
								}

							//If we have an ID, get the default value if set
								if ( isset( $theme_option['default'] ) ) {
									$value = $theme_option['default'];
								}

							//Get the option value saved in database and apply it when exists
								if ( $mod = get_theme_mod( $option_id ) ) {
									$value = $mod;
								}

							//Make sure the color value contains '#'
								if ( 'color' === $theme_option['type'] ) {
									$value = '#' . trim( $value, '#' );
								}

							//Make sure the image URL is used in CSS format
								if ( 'image' === $theme_option['type'] ) {
									if ( is_array( $value ) && isset( $value['id'] ) ) {
										$value = absint( $value['id'] );
									}
									if ( is_numeric( $value ) ) {
										$value = wp_get_attachment_image_src( $value, 'full' );
										$value = $value[0];
									}
									if ( ! empty( $value ) ) {
										$value = "url('" . esc_url( $value ) . "')";
									} else {
										$value = 'none';
									}
								}

							//Value filtering
								$value = apply_filters( 'wmhook_wm_custom_styles_value', $value, $theme_option );

							//Make array to string as otherwise the strtr() function throws error
								if ( is_array( $value ) ) {
									$value = (string) implode( ',', (array) $value );
								}

							//Finally modify the output string
								$replacements['[[' . $option_id . ']]'] = $value;

								/**
								 * Add also rgba() color interpratation
								 *
								 * Note that only alpha=0 is added as replacement option.
								 * Other alpha values has to be added via custom function
								 * hooked onto the $replacements filter below.
								 */
								if ( 'color' === $theme_option['type'] ) {
									$replacements['[[' . $option_id . '|alpha=0]]'] = wm_color_hex_to_rgba( $value, 0 );
								}

						} // /foreach

						//Add WordPress Custom Background and Header support
							//Background color
								if ( $value = get_background_color() ) {
									$replacements['[[background_color]]'] = '#' . trim( $value, '#' );
									$replacements['[[background_color|alpha=0]]'] = wm_color_hex_to_rgba( $value, 0 );
								}
							//Background image
								if ( $value = esc_url( get_background_image() ) ) {
									$replacements['[[background_image]]'] = "url('" . $value . "')";
								} else {
									$replacements['[[background_image]]'] = 'none';
								}
							//Header text color
								if ( $value = get_header_textcolor() ) {
									$replacements['[[header_textcolor]]'] = '#' . trim( $value, '#' );
									$replacements['[[header_textcolor|alpha=0]]'] = wm_color_hex_to_rgba( $value, 0 );
								}
							//Header image
								if ( $value = esc_url( get_header_image() ) ) {
									$replacements['[[header_image]]'] = "url('" . $value . "')";
								} else {
									$replacements['[[header_image]]'] = 'none';
								}

						$replacements = apply_filters( 'wmhook_wm_custom_styles_replace_replacements', $replacements, $theme_options, $output );

						if (
								$set_cache
								&& ! empty( $replacements )
							) {
							set_transient( WM_THEME_SHORTNAME . '-customizer-values', $replacements );
						}

					}

				//Replace tags in custom CSS strings with actual values
					$output_cached = (string) get_transient( WM_THEME_SHORTNAME . '-custom-css' );

					//When debugging set
						if ( isset( $_GET['debug'] ) ) {
							$output_cached = (string) get_transient( WM_THEME_SHORTNAME . '-custom-css-debug' );
						}

					if (
							empty( $output_cached )
							|| ( $wp_customize && $wp_customize->is_preview() )
						) {

						//Replace tags in custom CSS strings with actual values
							$output = strtr( $output, $replacements );

						if ( $set_cache ) {
							set_transient( WM_THEME_SHORTNAME . '-custom-css-debug', apply_filters( 'wmhook_wm_custom_styles_output_cache_debug', $output ) );
							set_transient( WM_THEME_SHORTNAME . '-custom-css', apply_filters( 'wmhook_wm_custom_styles_output_cache', $output ) );
						}

					} else {

						$output = $output_cached;

					}

			//Output
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
				delete_transient( WM_THEME_SHORTNAME . '-customizer-values' );
				delete_transient( WM_THEME_SHORTNAME . '-custom-css-debug' );
				delete_transient( WM_THEME_SHORTNAME . '-custom-css' );
			}
		} // /wm_custom_styles_transient_flusher



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
			//Set cache, do not return
				wm_custom_styles( true, false );
		}
	} // /wm_custom_styles_cache



	/**
	 * Hex color to RGBA
	 *
	 * @since    1.0
	 * @version  1.3
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
			//Helper variables
				$alpha = absint( $alpha );

				$output = ( 100 === $alpha ) ? ( 'rgb(' ) : ( 'rgba(' );

				$rgb = array();

				$hex = trim( $hex, '#' );
				$hex = preg_replace( '/[^0-9A-Fa-f]/', '', $hex );
				$hex = substr( $hex, 0, 6 );

			//Preparing output
				//Converting hex color into rgb
					$color = (int) hexdec( $hex );

					$rgb['r'] = (int) 0xFF & ( $color >> 0x10 );
					$rgb['g'] = (int) 0xFF & ( $color >> 0x8 );
					$rgb['b'] = (int) 0xFF & $color;

				//Using alpha (rgba)?
					$output .= implode( ',', $rgb );

					if ( 100 > $alpha ) {
						$output .= ',' . ( $alpha / 100 );
					}

			//Output
				return apply_filters( 'wmhook_wm_color_hex_to_rgba_output', $output . ')', $hex, $alpha );
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
			//Requirements check
				if (
						! is_string( $css )
						&& ! apply_filters( 'wmhook_wm_minify_css_disable', false )
					) {
					return $css;
				}

			//Praparing output
				$css = apply_filters( 'wmhook_wm_minify_css_pre', $css );

				//Remove CSS comments
					$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
				//Remove tabs, spaces, line breaks, etc.
					$css = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $css );
					$css = str_replace( array( '  ', '   ', '    ', '     ' ), ' ', $css );
					$css = str_replace( array( ' { ', ': ', '; }' ), array( '{', ':', '}' ), $css );

			//Output
				return apply_filters( 'wmhook_wm_minify_css_output', $css );
		}
	} // /wm_minify_css

?>