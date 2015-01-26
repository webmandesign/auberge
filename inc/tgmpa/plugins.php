<?php
/**
 * Plugins suggestions
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.2.5
 *
 * CONTENT:
 * - 10) Actions and filters
 * - 20) Funcions
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Include the TGM_Plugin_Activation class.
			add_action( 'tgmpa_register', 'wm_plugins_suggestions' );





/**
 * 20) Funcions
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

						//Recommended

							'bb' => array(
								'name'     => 'Beaver Builder',
								'slug'     => 'beaver-builder-lite-version',
								'required' => false,
							),

							'bn' => array(
								'name'     => 'Breadcrumb NavXT',
								'slug'     => 'breadcrumb-navxt',
								'required' => false,
							),

							'jp' => array(
								'name'     => 'Jetpack by WordPress.com',
								'slug'     => 'jetpack',
								'required' => false,
								'version'  => '3.3',
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

?>