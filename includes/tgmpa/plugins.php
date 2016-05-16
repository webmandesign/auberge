<?php
/**
 * Plugins suggestions
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0.2
 *
 * Contents:
 *
 * - 10) Funcions
 */





/**
 * 10) Funcions
 */

	/**
	 * Register the required plugins for the theme
	 *
	 * @link  https://github.com/thomasgriffin/TGM-Plugin-Activation/blob/master/example.php
	 */
	if ( ! function_exists( 'wm_plugins_suggestions' ) ) {
		function wm_plugins_suggestions() {

			/**
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = apply_filters( 'wmhook_wm_plugins_suggestions-plugins', array(

					/**
					 * WordPress Repository plugins
					 */

						// Recommended

							'jetpack' => array(
								'name'     => esc_html__( 'Jetpack by WordPress.com (adds theme features)', 'auberge' ),
								'slug'     => 'jetpack',
								'required' => false,
								'version'  => '4.0.2',
							),

				) );

			/**
			 * Recommend Beaver Builder Lite Version only if Pro version not active
			 */
			if ( ! class_exists( 'FLBuilder' ) ) {

				$plugins['beaver-builder'] = array(
						'name'     => esc_html__( 'Beaver Builder (easy page builder)', 'auberge' ),
						'slug'     => 'beaver-builder-lite-version',
						'required' => false,
						'version'  => '1.7.8',
					);

			}

			/**
			 * Recommend Advanced Custom Fields only if Pro version not active
			 */
			if ( ! function_exists( 'register_field_group' ) ) {

				$plugins['advanced-custom-fields'] = array(
						'name'     => esc_html__( 'Advanced Custom Fields (adds theme features)', 'auberge' ),
						'slug'     => 'advanced-custom-fields',
						'required' => false,
						'version'  => '4.4.7',
					);

			}



			/**
			 * Array of configuration settings
			 */
			$config = apply_filters( 'wmhook_wm_plugins_suggestions-config', array() );



			/**
			 * Actual action...
			 */
			tgmpa( $plugins, $config );

		}
	} // /wm_plugins_suggestions

	add_action( 'tgmpa_register', 'wm_plugins_suggestions' );
