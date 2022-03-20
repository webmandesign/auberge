<?php
/**
 * Plugins suggestions
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.8.0
 *
 * Contents:
 *
 * - 10) Functions
 */





/**
 * 10) Functions
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
							),

							'beaver-builder' => array(
								'name'        => esc_html__( 'Beaver Builder (easy page builder)', 'auberge' ),
								'slug'        => 'beaver-builder-lite-version',
								'required'    => false,
								'is_callable' => 'FLBuilder::init',
							),

							'advanced-custom-fields' => array(
								'name'        => esc_html__( 'Advanced Custom Fields (easy page setup)', 'auberge' ),
								'slug'        => 'advanced-custom-fields',
								'required'    => false,
								'is_callable' => 'register_field_group',
							),

							'one-click-demo-import' => array(
								'name'     => esc_html__( 'One Click Demo Import (for installing theme demo content)', 'auberge' ),
								'slug'     => 'one-click-demo-import',
								'required' => false,
							),

							'classic-widgets' => array(
								'name'        => esc_html_x( 'Classic Widgets', 'Plugin name.', 'auberge' ),
								'description' => esc_html__( 'Improves widgets management screen.', 'auberge' ) . ' ' . esc_html__( 'Restores the previous WordPress widgets settings screens.', 'auberge' ) . ' ' . esc_html__( 'Sidebars and widgets are not going to be used in fully block themes in the future, so if your website still uses sidebars, it is better to use this plugin to enable classic user interface.', 'auberge' ),
								'slug'        => 'classic-widgets',
								'required'    => false,
							),

				) );



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
