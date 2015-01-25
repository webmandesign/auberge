<?php
/**
 * Custom Header feature
 *
 * The content of Custom Header will change, eventually.
 * By default a theme custom header image and text is displayed.
 * If you use Featured Content via Jetpack plugin, this will be displayed instead.
 *
 * Priority display:
 *   Image:
 *     1. If using Jetpack Featured Content, a post featured image is displayed.
 *     3. Fall back to Custom Header image.
 *   Caption:
 *     1. If using Jetpack Featured Content, a post title (or banner text) is displayed.
 *     3. Fall back to Custom Header text.
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 *
 * @uses  Jetpack -> Featured Content
 * @link  http://jetpack.me/support/featured-content/
 * @link  http://www.hongkiat.com/blog/wordpress-featured-content/
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

?>