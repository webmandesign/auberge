<?php
/**
 * WP admin modifications
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.4.8
 *
 * CONTENT:
 * - 10) Actions and filters
 * - 20) Assets
 * - 30) Posts list table
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
 * 20) Assets
 */

	/**
	 * Admin HTML head assets enqueue
	 *
	 * @since    1.0
	 * @version  1.4.8
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
								esc_attr( trim( wp_get_theme()->get( 'Version' ) ) ),
								'screen'
							);

				}
		}
	} // /wm_assets_admin





/**
 * 30) Posts list table
 */

	/**
	 * Register table columns
	 *
	 * @since    1.0
	 * @version  1.4.8
	 *
	 * @param  array $columns
	 */
	if ( ! function_exists( 'wm_post_columns_register' ) ) {
		function wm_post_columns_register( $columns ) {
			//Preparing output
				if ( 'jetpack-portfolio' == get_post_type() ) {
					unset( $columns['thumbnail'] );
				}

				$add             = array_slice( $columns, 0, 2 );
				$add['wm-thumb'] = __( 'Image', 'wm_domain' );

			//Output
				return apply_filters( 'wmhook_wm_post_columns_register_output', array_merge( $add, array_slice( $columns, 2 ) ) );
		}
	} // /wm_post_columns_register



	/**
	 * Admin post list columns content
	 *
	 * @since    1.0
	 * @version  1.3
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
						echo '<a href="' . esc_url( get_permalink() ) . '">' . $image . '</a>';
					}

					echo '</span>';

				}
		}
	} // /wm_post_columns_render

?>