<?php
/**
 * Plugin integration
 *
 * Beaver Builder
 *
 * @link  https://www.wpbeaverbuilder.com/
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.2
 * @version  2.6.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */


	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	/**
	 * Upgrade link URL
	 *
	 * @since    1.3
	 * @version  1.4.3
	 *
	 * @param  string $url
	 */
	if ( ! function_exists( 'wm_bb_upgrade_url' ) ) {
		function wm_bb_upgrade_url( $url ) {

			// Output

				return esc_url( add_query_arg( 'fla', '67', $url ) );

		}
	} // /wm_bb_upgrade_url

	add_filter( 'fl_builder_upgrade_url', 'wm_bb_upgrade_url' );



	/**
	 * Is page builder used on the post?
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_bb_is_active' ) ) {
		function wm_bb_is_active() {

			// Requirements check

				if ( ! class_exists( 'FLBuilderModel' ) ) {
					return false;
				}


			// Helper variables

				$post_id = get_the_ID();


			// Processing

				if ( is_page( $post_id ) || is_single( $post_id ) ) {
					return ( FLBuilderModel::is_builder_active() || get_post_meta( $post_id, '_fl_builder_enabled', true ) );
				}


			// Output

				return false;

		}
	} // /wm_bb_is_active



	/**
	 * Global settings
	 *
	 * @since    1.2
	 * @version  2.6.0
	 *
	 * @param  array  $defaults
	 * @param  string $form_type
	 */
	if ( ! function_exists( 'wm_bb_global_settings' ) ) {
		function wm_bb_global_settings( $defaults, $form_type ) {

			// Processing

				if ( 'global' === $form_type ) {

					// "Default Page Heading" section

						$defaults->show_default_heading     = '1';
						$defaults->default_heading_selector = '.entry-header';

					// "Rows" section

						$defaults->row_padding       = 0;
						$defaults->row_width         = $GLOBALS['content_width'];
						$defaults->row_width_default = 'full';

					// "Modules" section

						$defaults->module_margins = 0;

					// "Responsive Layout" section

						$defaults->auto_spacing          = 0;
						$defaults->medium_breakpoint     = 1280;
						$defaults->responsive_breakpoint = 880;

				}


			// Output

				return $defaults;

		}
	} // /wm_bb_global_settings

	add_filter( 'fl_builder_settings_form_defaults', 'wm_bb_global_settings', 10, 2 );



	/**
	 * Disable page title when page builder used
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  bool $disable
	 */
	if ( ! function_exists( 'wm_bb_post_title_disable' ) ) {
		function wm_bb_post_title_disable( $disable ) {

			// Processing

				if (
						wm_bb_is_active()
						&& (
							is_page_template( 'page-template/_fullwidth.php' )
							|| is_page_template( 'page-template/_menu.php' )
						)
					) {
					return true;
				}


			// Output

				return $disable;

		}
	} // /wm_bb_post_title_disable

	add_filter( 'wmhook_wm_post_title_disable', 'wm_bb_post_title_disable' );
