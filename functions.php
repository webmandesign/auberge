<?php
/**
 * Auberge WordPress Theme
 *
 * Auberge WordPress Theme, Copyright 2015 WebMan [http://www.webmandesign.eu/]
 * Auberge is distributed under the terms of the GNU GPL
 *
 * @package    Auberge
 * @author     WebMan
 * @license    GPL-2.0+
 * @link       http://www.webmandesign.eu
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.3
 *
 * @link  http://www.webmandesign.eu
 *
 * CONTENT:
 * - 0) Constants
 * - 1) Required files
 */





/**
 * 0) Constants
 */

	//Helper variables
		$theme_data = wp_get_theme();

	//Basic constants
		if ( ! defined( 'WM_THEME_NAME' ) )            define( 'WM_THEME_NAME',            $theme_data->get( 'Name' )                                   );
		if ( ! defined( 'WM_THEME_SHORTNAME' ) )       define( 'WM_THEME_SHORTNAME',       str_replace( array( '-lite', '-plus' ), '', get_template() ) );
		if ( ! defined( 'WM_THEME_VERSION' ) )         define( 'WM_THEME_VERSION',         $theme_data->get( 'Version' )                                );

		if ( ! defined( 'WM_SCRIPTS_VERSION' ) )       define( 'WM_SCRIPTS_VERSION',       esc_attr( trim( WM_THEME_VERSION ) )                         );
		if ( ! defined( 'WM_WP_COMPATIBILITY' ) )      define( 'WM_WP_COMPATIBILITY',      4.1                                                          );

	//Dir constants
		if ( ! defined( 'WM_INC_DIR' ) )               define( 'WM_INC_DIR',               trailingslashit( 'inc/' )                                    );

	//URL constants
		if ( ! defined( 'WM_THEME_AUTHOR_URI' ) )      define( 'WM_THEME_AUTHOR_URI',      esc_url( $theme_data->get( 'AuthorURI' ) )                   );

	//Theme design constants
		if ( ! defined( 'WM_IMAGE_SIZE_ITEMS' ) )      define( 'WM_IMAGE_SIZE_ITEMS',      'thumbnail'                                                  );
		if ( ! defined( 'WM_IMAGE_SIZE_ITEMS_MENU' ) ) define( 'WM_IMAGE_SIZE_ITEMS_MENU', 'banner-small'                                               );
		if ( ! defined( 'WM_IMAGE_SIZE_SINGULAR' ) )   define( 'WM_IMAGE_SIZE_SINGULAR',   'large'                                                      );





/**
 * 1) Required files
 */

	//Global functions
		locate_template( WM_INC_DIR . 'lib/core.php', true );

	//Theme setup
		locate_template( WM_INC_DIR . 'setup.php', true );

	//Custom header
		locate_template( WM_INC_DIR . 'custom-header/custom-header.php', true );

	//Customizer
		locate_template( WM_INC_DIR . 'customizer/customizer.php', true );

	//Jetpack setup
		locate_template( WM_INC_DIR . 'jetpack/jetpack.php', true );

	//Beaver Builder setup
		locate_template( WM_INC_DIR . 'beaver-builder/beaver-builder.php', true );

?>