<?php
/**
 * WP admin modifications
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 *
 * CONTENT:
 * -  10) Actions and filters
 * -  20) Assets
 * -  30) Posts list table
 * - 100) Other functions
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Styles and scripts
			add_action( 'admin_enqueue_scripts', 'wm_assets_admin' );
		//Posts list table
			//Posts
				add_action( 'manage_post_posts_columns',                    'wm_post_columns_register', 10    );
				add_action( 'manage_post_posts_custom_column',              'wm_post_columns_render',   10, 2 );
			//Pages
				add_action( 'manage_pages_columns',                         'wm_post_columns_register', 10    );
				add_action( 'manage_pages_custom_column',                   'wm_post_columns_render',   10, 2 );
			//Jetpack Portfolio posts
				add_action( 'manage_edit-jetpack-portfolio_columns',        'wm_post_columns_register', 10    );
				add_action( 'manage_jetpack-portfolio_posts_custom_column', 'wm_post_columns_render',   10, 2 );



	/**
	 * Filters
	 */
		//Post visual editor
			add_filter( 'mce_buttons',          'wm_add_buttons_row1'  );
			add_filter( 'mce_buttons_2',        'wm_add_buttons_row2'  );
			add_filter( 'tiny_mce_before_init', 'wm_custom_mce_format' );





/**
 * 20) Assets
 */

	/**
	 * Admin HTML head assets enqueue
	 */
	if ( ! function_exists( 'wm_assets_admin' ) ) {
		function wm_assets_admin() {
			//Helper variables
				global $current_screen;

				$custom_styles = '';

			//Enqueue (only on specific admin pages)
				if ( in_array( $current_screen->base, array( 'edit', 'post' ) ) ) {
					//Styles
						wp_enqueue_style(
								'wm-admin-styles',
								wm_get_stylesheet_directory_uri( 'css/admin.css' ),
								false,
								WM_SCRIPTS_VERSION,
								'screen'
							);

					//Styles - inline
						$custom_styles .= '#post-' . get_option( 'page_on_front' ) . ' { background: #d7eef4; }';
						$custom_styles .= '#post-' . get_option( 'page_for_posts' ) . ' { background: #d7f4e3; }';

						wp_add_inline_style( 'wm-admin-styles', $custom_styles );

				}
		}
	} // /wm_assets_admin





/**
 * 30) Posts list table
 */

	/**
	 * Register table columns
	 *
	 * @param  array $columns
	 */
	if ( ! function_exists( 'wm_post_columns_register' ) ) {
		function wm_post_columns_register( $columns ) {
			//Preparing output
				if ( 'jetpack-portfolio' == get_post_type() ) {
					unset( $columns['thumbnail'] );
				}

				$add             = array_slice( $columns, 0, 1 );
				$add['wm-thumb'] = __( 'Image', 'wm_domain' );

			//Output
				return apply_filters( 'wmhook_wm_post_columns_register_output', array_merge( $add, array_slice( $columns, 1 ) ) );
		}
	} // /wm_post_columns_register



	/**
	 * Admin post list columns content
	 *
	 * @param  string $column
	 * @param  absint $post_id
	 */
	if ( ! function_exists( 'wm_post_columns_render' ) ) {
		function wm_post_columns_render( $column, $post_id ) {
			//Thumbnail renderer
				if ( 'wm-thumb' === $column ) {

					$size = ( class_exists( 'Jetpack_Portfolio' ) ) ? ( 'jetpack-portfolio-admin-thumb' ) : ( 'thumbnail' );
					$size = apply_filters( 'wmhook_wm-thumb_size', $size );

					$image = ( has_post_thumbnail() ) ? ( get_the_post_thumbnail( $post_id, $size ) ) : ( '' );

					$thumb_class  = ( $image ) ? ( ' has-thumb' ) : ( ' no-thumb' );
					$thumb_class .= ' size-' . $size;

					echo '<span class="wm-image-container' . $thumb_class . '">';

					if ( get_edit_post_link() ) {
						edit_post_link( $image );
					} else {
						echo '<a href="' . get_permalink() . '">' . $image . '</a>';
					}

					echo '</span>';

				}
		}
	} // /wm_post_columns_render





/**
 * 100) Other functions
 */

	/**
	 * Add buttons to visual editor
	 *
	 * First row.
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
		 * @param  array $buttons
		 */
		if ( ! function_exists( 'wm_add_buttons_row2' ) ) {
			function wm_add_buttons_row2( $buttons ) {
				//Inserting buttons at the beginning of the row
					$buttons = array_merge( array( 'styleselect' ), $buttons );

				//Output
					return $buttons;
			}
		} // /wm_add_buttons_row2



		/**
		 * Customizing format dropdown items
		 *
		 * @link  http://codex.wordpress.org/TinyMCE_Custom_Styles
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
										'title' => __( 'Quotes', 'wm_domain' ),
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
												'title' => __( 'Cite', 'wm_domain' ),
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