<?php
/**
 * WP admin modifications
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 * @version  2.6.0
 *
 * Contents:
 *
 *  1) Required files
 * 10) Assets
 */





/**
 * 1) Required files
 */

	// Plugins suggestions

		if ( apply_filters( 'wmhook_enable_plugins_integration', true ) ) {
			require_once( get_template_directory() . '/includes/tgmpa/class-tgm-plugin-activation.php' );
			require_once( get_template_directory() . '/includes/tgmpa/plugins.php' );
		}





/**
 * 10) Assets
 */

	/**
	 * Admin HTML head assets enqueue
	 *
	 * @since    1.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_assets_admin' ) ) {
		function wm_assets_admin() {

			// Processing

				// Styles

					wp_enqueue_style(
						'wm-admin-styles',
						get_theme_file_uri( 'library/css/admin.css' ),
						false,
						esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
						'screen'
					);

		}
	} // /wm_assets_admin

	add_action( 'admin_enqueue_scripts', 'wm_assets_admin', 998 );
