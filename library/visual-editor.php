<?php
/**
 * Visual editor addons
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.2
 * @version  2.0
 *
 * Contents:
 *
 * 10) Buttons
 * 20) Custom formats
 */





/**
 * 10) Buttons
 */

	/**
	 * Add buttons to visual editor
	 *
	 * First row.
	 *
	 * @since    1.2
	 * @version  2.0
	 *
	 * @param  array $buttons
	 */
	if ( ! function_exists( 'wm_add_buttons_row1' ) ) {
		function wm_add_buttons_row1( $buttons ) {

			// Processing

				// Inserting buttons after "more" button

					$pos = array_search( 'wp_more', $buttons, true );

					if ( false !== $pos ) {
						$add     = array_slice( $buttons, 0, $pos + 1 );
						$add[]   = 'wp_page';
						$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
					}


			// Output

				return $buttons;

		}
	} // /wm_add_buttons_row1

	add_filter( 'mce_buttons', 'wm_add_buttons_row1' );



	/**
	 * Add buttons to visual editor
	 *
	 * Second row.
	 *
	 * @since    1.2
	 * @version  2.0
	 *
	 * @param  array $buttons
	 */
	if ( ! function_exists( 'wm_add_buttons_row2' ) ) {
		function wm_add_buttons_row2( $buttons ) {

			// Processing

				// Inserting buttons at the beginning of the row

					array_unshift( $buttons, 'styleselect' );


			// Output

				return $buttons;

		}
	} // /wm_add_buttons_row2

	add_filter( 'mce_buttons_2', 'wm_add_buttons_row2' );





/**
 * 20) Custom formats
 */

	/**
	 * Customizing format dropdown items
	 *
	 * @link  http://codex.wordpress.org/TinyMCE_Custom_Styles
	 * @link  http://www.tinymce.com/wiki.php/Configuration:style_formats
	 *
	 * @since    1.2
	 * @version  2.0
	 *
	 * @param  array $init
	 */
	if ( ! function_exists( 'wm_custom_mce_format' ) ) {
		function wm_custom_mce_format( $init ) {

			// Processing

				// Add custom formats

					$style_formats = (array) apply_filters( 'wmhook_wm_custom_mce_format', array(

							// Group: Text styles

								100 . 'text_styles' => array(
									'title' => esc_html__( 'Text styles', 'auberge' ),
									'items' => array(

										100 . 'text_styles' . 100 => array(
											'title'    => __( 'Dropcap text', 'auberge' ),
											'selector' => 'p',
											'classes'  => 'dropcap-text',
										),

										100 . 'text_styles' . 110 => array(
											'title'    => esc_html__( 'Uppercase heading or paragraph', 'auberge' ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'uppercase',
										),

										100 . 'text_styles' . 120 => array(
											'title'  => esc_html__( 'Highlighted (marked) text', 'auberge' ),
											'inline' => 'mark',
											'icon'   => 'backcolor',
										),

										100 . 'text_styles' . 130 => array(
											'title'  => esc_html__( 'Small text', 'auberge' ),
											'inline' => 'small',
										),

										100 . 'text_styles' . 140 => array(
											'title'  => esc_html__( 'Superscript', 'auberge' ),
											'icon'   => 'superscript',
											'format' => 'superscript',
										),

										100 . 'text_styles' . 150 => array(
											'title'  => esc_html__( 'Subscript', 'auberge' ),
											'icon'   => 'subscript',
											'format' => 'subscript',
										),

										100 . 'text_styles' . 160 => array(
											'title'    => sprintf( esc_html_x( 'Heading %d text style', '%d = HTML heading size number.', 'auberge' ), 1 ),
											'selector' => 'h2, h3, h4, h5, h6, p',
											'classes'  => 'h1',
										),

										100 . 'text_styles' . 170 => array(
											'title'    => sprintf( esc_html_x( 'Heading %d text style', '%d = HTML heading size number.', 'auberge' ), 2 ),
											'selector' => 'h1, h3, h4, h5, h6, p',
											'classes'  => 'h2',
										),

										100 . 'text_styles' . 180 => array(
											'title'    => sprintf( esc_html_x( 'Heading %d text style', '%d = HTML heading size number.', 'auberge' ), 3 ),
											'selector' => 'h1, h2, h4, h5, h6, p',
											'classes'  => 'h3',
										),

									),
								),

							// Group: Text size

								200 . 'text_sizes' => array(
									'title' => esc_html__( 'Text sizes', 'auberge' ),
									'items' => array(

										200 . 'text_sizes' . 100 => array(
											'title'    => sprintf( esc_html_x( 'Display %d', '%d: Display text size number.', 'auberge' ), 1 ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'display-1',
										),

										200 . 'text_sizes' . 110 => array(
											'title'    => sprintf( esc_html_x( 'Display %d', '%d: Display text size number.', 'auberge' ), 2 ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'display-2',
										),

										200 . 'text_sizes' . 120 => array(
											'title'    => sprintf( esc_html_x( 'Display %d', '%d: Display text size number.', 'auberge' ), 3 ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'display-3',
										),

										200 . 'text_sizes' . 130 => array(
											'title'    => sprintf( esc_html_x( 'Display %d', '%d: Display text size number.', 'auberge' ), 4 ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'display-4',
										),

									),
								),

							// Group: Quotes

								300 . 'quotes' => array(
									'title' => esc_html_x( 'Quotes', 'Visual editor blockquote formats group title.', 'auberge' ),
									'items' => array(

										300 . 'quotes' . 100 => array(
											'title' => esc_html__( 'Blockquote', 'auberge' ),
											'block' => 'blockquote',
											'icon'  => 'blockquote',
										),

										300 . 'quotes' . 110 => array(
											'title'   => esc_html__( 'Pullquote - align left', 'auberge' ),
											'block'   => 'blockquote',
											'classes' => 'pullquote alignleft',
											'icon'    => 'alignleft',
										),

										300 . 'quotes' . 120 => array(
											'title'   => esc_html__( 'Pullquote - align right', 'auberge' ),
											'block'   => 'blockquote',
											'classes' => 'pullquote alignright',
											'icon'    => 'alignright',
										),

										300 . 'quotes' . 130 => array(
											'title'  => esc_html_x( 'Cite', 'Visual editor format label for HTML CITE tag used to set the blockquote source.', 'auberge' ),
											'inline' => 'cite',
										),

									),
								),

						) );

					ksort( $style_formats );

					foreach ( $style_formats as $group_key => $group ) {
						if ( isset( $group['items'] ) ) {
							ksort( $group['items'] );
							$style_formats[ $group_key ]['items'] = $group['items'];
						}
					}

					if ( ! empty( $style_formats ) ) {

						// Merge old & new formats

							$init['style_formats_merge'] = true;

						// New formats

							$init['style_formats'] = json_encode( array_values( $style_formats ) );

					}

				// Removing obsolete tags (this is localized already)

					$heading_1 = ( ! is_admin() ) ? ( 'Heading 1=h1;' ) : ( '' ); // Accounting for page builders front-end editing when page title is disabled

					$init['block_formats'] = 'Paragraph=p;' . $heading_1 . 'Heading 2=h2;Heading 3=h3;Heading 4=h4;Address=address;Preformatted=pre;Code=code';


			// Output

				return apply_filters( 'wmhook_wm_custom_mce_format_output', $init );

		}
	} // /wm_custom_mce_format

	add_filter( 'tiny_mce_before_init', 'wm_custom_mce_format' );
