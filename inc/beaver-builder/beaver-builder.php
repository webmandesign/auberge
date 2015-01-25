<?php
/**
 * Beaver Builder setup
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.2
 * @version  1.2
 *
 * CONTENT:
 * -  1) Requirements check
 * - 10) Actions and filters
 * - 20) Jetpack integration
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
			add_filter( 'option_' . '_fl_builder_settings', 'wm_bb_global_settings' );





/**
 * 20) Beaver Builder integration
 */

	/**
	 * Global settings
	 */
	if ( ! function_exists( 'wm_bb_global_settings' ) ) {
		function wm_bb_global_settings( $value ) {
			//Preparing output
				//"Default Page Heading" section
					$value['show_default_heading']     = 0;
					$value['default_heading_selector'] = '.entry-header-disabled';

				//"Rows" section
					$value['row_padding'] = 0;

				//"Modules" section
					$value['module_margins'] = 0;

				//"Responsive Layout" section
					$value['responsive_enabled']    = 1;
					$value['medium_breakpoint']     = 960;
					$value['responsive_breakpoint'] = 680;

			//Output
				return $value;
		}
	} // /wm_bb_global_settings

?>