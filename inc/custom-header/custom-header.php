<?php
/**
 * Custom Header feature
 *
 * The content of Custom Header will change, eventually.
 * By default a theme custom header image and text is displayed.
 * If you use Featured Content via Jetpack plugin, this will be displayed instead.
 * If you use NS Featured Posts plugin, this will be override all of the above.
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.3
 *
 * @uses  Jetpack -> Featured Content
 * @link  http://jetpack.me/support/featured-content/
 * @link  http://www.hongkiat.com/blog/wordpress-featured-content/
 *
 * @uses  NS Featured Posts plugin
 * @link  https://wordpress.org/plugins/ns-featured-posts/
 *
 * CONTENT:
 * - 10) Actions and filters
 * - 20) Custom Header functions
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Display the featured area
			add_action( 'wmhook_header_after', 'wm_banner_area', 10 );



	/**
	 * Filters
	 */

		//NS Featured Posts plugin support
			add_filter( 'wm_get_banner_posts', 'wm_nsfp_get_banner_posts', 98 );





/**
 * 20) Custom Header functions
 */

	/**
	 * Getter function
	 *
	 * IMPORTANT:
	 * Filter hook name has to match the function name,
	 * so do not use the 'wmhook_' prefix.
	 */
	if ( ! function_exists( 'wm_get_banner_posts' ) ) {
		function wm_get_banner_posts() {
			return apply_filters( 'wm_get_banner_posts', array() );
		}
	} // /wm_get_banner_posts



	/**
	 * Conditional function
	 *
	 * IMPORTANT:
	 * Filter hook name has to match the function name,
	 * so do not use the 'wmhook_' prefix.
	 */
	if ( ! function_exists( 'wm_has_banner_posts' ) ) {
		function wm_has_banner_posts( $minimum = 1 ) {
			if ( is_paged() ) {
				return false;
			}

			$minimum        = absint( $minimum );
			$featured_posts = apply_filters( 'wm_get_banner_posts', array() );

			if ( ! is_array( $featured_posts ) || $minimum > count( $featured_posts ) ) {
				return false;
			}

			return true;
		}
	} // /wm_has_banner_posts



	/**
	 * Featured area
	 */
	if ( ! function_exists( 'wm_banner_area' ) ) {
		function wm_banner_area() {
			if ( is_front_page() && ! is_paged() ) {
				get_template_part( 'loop', 'banner' );
			}
		}
	} // /wm_banner_area



	/**
	 * NS Featured Posts plugin support
	 *
	 * @since  1.3
	 */

		/**
		 * Getter function
		 *
		 * @since    1.3
		 * @version  1.3
		 *
		 * @param  array $featured_posts
		 */
		if ( ! function_exists( 'wm_nsfp_get_banner_posts' ) ) {
			function wm_nsfp_get_banner_posts( $featured_posts ) {
				//Requirements check
					if ( ! class_exists( 'NS_Featured_Posts' ) ) {
						return $featured_posts;
					}

				//Helper variables
					$nsfp_plugin_options = get_option( 'nsfp_plugin_options' );

					if (
							isset( $nsfp_plugin_options['nsfp_posttypes'] )
							&& ! empty( $nsfp_plugin_options['nsfp_posttypes'] )
						) {
						$post_type = array_keys( $nsfp_plugin_options['nsfp_posttypes'] );
					} else {
						$post_type = 'post';
					}

				//Preparing output
					$nsfp_featured_posts = get_posts( array(
						'numberposts' => 6, //Max posts count
						'post_type'   => $post_type,
						'meta_key'    => '_is_ns_featured_post',
						'meta_value'  => 'yes',
					) );

					if ( ! empty( $nsfp_featured_posts ) ) {
						$featured_posts = $nsfp_featured_posts;
					}

				//Output
					return $featured_posts;
			}
		} // /wm_nsfp_get_banner_posts

?>