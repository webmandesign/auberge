<?php
/**
 * Visual editor addons
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.2
 * @version  1.2
 *
 * CONTENT:
 * - 10) Actions and filters
 * - 20) Visual editor addons
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Filters
	 */

		//Visual Editor addons
			add_filter( 'mce_buttons',          'wm_add_buttons_row1'  );
			add_filter( 'mce_buttons_2',        'wm_add_buttons_row2'  );
			add_filter( 'tiny_mce_before_init', 'wm_custom_mce_format' );





/**
 * 20) Visual editor addons
 */

	/**
	 * Add buttons to visual editor
	 *
	 * First row.
	 *
	 * @since    1.2
	 * @version  1.2
	 *
	 * @param  array $buttons
	 */
	if ( ! function_exists( 'wm_add_buttons_row1' ) ) {
		function wm_add_buttons_row1( $buttons ) {
			//Inserting buttons after "more" button
				$pos = array_search( 'wp_more', $buttons, true );
				if ( false !== $pos ) {
					$add     = array_slice( $buttons, 0, $pos + 1 );
					$add[]   = 'wp_page';
					$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
				}

			//Output
				return $buttons;
		}
	} // /wm_add_buttons_row1



		/**
		 * Add buttons to visual editor
		 *
		 * Second row.
		 *
		 * @since    1.2
		 * @version  1.2
		 *
		 * @param  array $buttons
		 */
		if ( ! function_exists( 'wm_add_buttons_row2' ) ) {
			function wm_add_buttons_row2( $buttons ) {
				//Inserting buttons at the beginning of the row
					array_unshift( $buttons, 'styleselect' );

				//Output
					return $buttons;
			}
		} // /wm_add_buttons_row2



	/**
	 * Customizing format dropdown items
	 *
	 * @link  http://codex.wordpress.org/TinyMCE_Custom_Styles
	 *
	 * @since    1.2
	 * @version  1.2
	 *
	 * @param  array $init
	 */
	if ( ! function_exists( 'wm_custom_mce_format' ) ) {
		function wm_custom_mce_format( $init ) {
			//Preparing output
				//Merge old & new formats
					$init['style_formats_merge'] = true;

				//Add custom formats
					$init['style_formats'] = json_encode( apply_filters( 'wmhook_wm_custom_mce_format_style_formats', array(

							//Group: Quotes
								array(
									'title' => _x( 'Quotes', 'Visual editor blockquote formats group title.', 'wm_domain' ),
									'items' => array(

										array(
											'title' => __( 'Blockquote', 'wm_domain' ),
											'block' => 'blockquote',
										),
										array(
											'title'   => __( 'Pullquote - align left', 'wm_domain' ),
											'block'   => 'blockquote',
											'classes' => 'pullquote alignleft',
										),
										array(
											'title'   => __( 'Pullquote - align right', 'wm_domain' ),
											'block'   => 'blockquote',
											'classes' => 'pullquote alignright',
										),
										array(
											'title' => _x( 'Cite', 'Visual editor format label for HTML CITE tag used to set the blockquote source.', 'wm_domain' ),
											'block' => 'cite',
										),

									),
								),

							//Group: Text styles
								array(
									'title' => __( 'Text styles', 'wm_domain' ),
									'items' => array(

										array(
											'title'    => __( 'Uppercase heading or paragraph', 'wm_domain' ),
											'selector' => 'h1, h2, h3, h4, h5, h6, p',
											'classes'  => 'uppercase',
										),

										array(
											'title'  => __( 'Highlighted (marked) text', 'wm_domain' ),
											'inline' => 'mark',
										),

										array(
											'title'    => __( 'Button link', 'wm_domain' ),
											'selector' => 'a',
											'classes'  => 'button',
										),

									),
								),

						) ) );

			//Output
				return apply_filters( 'wmhook_wm_custom_mce_format_output', $init );
		}
	} // /wm_custom_mce_format

?>