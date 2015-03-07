<?php
/**
 * Plugin integration
 *
 * Beaver Builder
 *
 * @link  https://www.wpbeaverbuilder.com/
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.2
 * @version  1.3
 *
 * CONTENT:
 * -  1) Requirements check
 * - 10) Actions and filters
 * - 20) Plugin integration
 */





/**
 * 1) Requirements check
 */


	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}





/**
 * 10) Actions and filters
 */

	/**
	 * Filters
	 */

		//Beaver Builder global settings option
			add_filter( 'fl_builder_settings_form_defaults', 'wm_bb_global_settings', 10, 2 );
		//Upgrade link
			add_filter( 'fl_builder_upgrade_url', 'wm_bb_upgrade_url' );





/**
 * 20) Plugin integration
 */

	/**
	 * Upgrade link URL
	 *
	 * @since    1.3
	 * @version  1.3
	 *
	 * @param   $paramname description
	 */
	if ( ! function_exists( 'wm_bb_upgrade_url' ) ) {
		function wm_bb_upgrade_url( $url ) {
			//Output
				return $url . '&fla=67';
		}
	} // /wm_bb_upgrade_url



	/**
	 * Global settings
	 *
	 * @since    1.2
	 * @version  1.3
	 *
	 * @param  array  $defaults
	 * @param  string $form_type
	 */
	if ( ! function_exists( 'wm_bb_global_settings' ) ) {
		function wm_bb_global_settings( $defaults, $form_type ) {
			//Preparing output
				if ( 'global' === $form_type ) {

					//"Default Page Heading" section
						$defaults->show_default_heading     = 0;
						$defaults->default_heading_selector = '.entry-header';

					//"Rows" section
						$defaults->row_padding       = 0;
						$defaults->row_width         = $GLOBALS['content_width'];
						$defaults->row_width_default = 'full';

					//"Modules" section
						$defaults->module_margins = 0;

					//"Responsive Layout" section
						$defaults->medium_breakpoint     = 960;
						$defaults->responsive_breakpoint = 680;

				}

			//Output
				return $defaults;
		}
	} // /wm_bb_global_settings

?>