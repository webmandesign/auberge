<?php
/**
 * WP admin modifications
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 *
 * Contents:
 *
 *  1) Required files
 * 10) Assets
 * 20) Messages
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
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_assets_admin' ) ) {
		function wm_assets_admin() {

			// Processing

				// Styles

					wp_enqueue_style(
							'wm-admin-styles',
							wm_get_stylesheet_directory_uri( 'library/css/admin.css' ),
							false,
							esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
							'screen'
						);

		}
	} // /wm_assets_admin

	add_action( 'admin_enqueue_scripts', 'wm_assets_admin', 998 );





/**
 * 20) Messages
 */

	/**
	 * WordPress admin notification messages
	 *
	 * Displays the message stored in `auberge_admin_notice` transient cache
	 * once or multiple times, than deletes the message cache.
	 *
	 * Transient structure:
	 *
	 * @example
	 *
	 *   set_transient(
	 *     'auberge_admin_notice',
	 *     array(
	 *       $text,
	 *       $class,
	 *       $capability,
	 *       $number_of_displays
	 *     )
	 *   );
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_admin_notices' ) ) {
		function wm_admin_notices() {

			// Requirements check

				if ( ! is_admin() ) {
					return;
				}


			// Helper variables

				$output = '';

				$class      = 'updated';
				$repeat     = 0;
				$capability = apply_filters( 'wmhook_wm_admin_notices_capability', 'switch_themes' );
				$message    = get_transient( 'auberge_admin_notice' );


			// Requirements check

				if ( empty( $message ) ) {
					return;
				}


			// Processing

				if ( ! is_array( $message ) ) {
					$message = array( $message, $class, $capability, $repeat );
				}
				if ( ! isset( $message[1] ) || empty( $message[1] ) ) {
					$message[1] = $class;
				}
				if ( ! isset( $message[2] ) || empty( $message[2] ) ) {
					$message[2] = $capability;
				}
				if ( ! isset( $message[3] ) ) {
					$message[3] = $repeat;
				}

				if ( $message[0] && current_user_can( $message[2] ) ) {
					$output .= '<div class="' . trim( 'wm-notice notice is-dismissible ' . $message[1] ) . '"><p>' . $message[0] . '</p></div>';
					delete_transient( 'auberge_admin_notice' );
				}

				// Delete the transient cache after specific number of displays

					if ( 1 < intval( $message[3] ) ) {
						$message[3] = intval( $message[3] ) - 1;
						set_transient( 'auberge_admin_notice', $message, ( 60 * 60 * 48 ) );
					}


			// Output

				if ( $output ) {
					echo $output;
				}

		}
	} // /wm_admin_notices

	add_action( 'admin_notices', 'wm_admin_notices', 998 );
