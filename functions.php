<?php
/**
 * Auberge WordPress Theme
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() conditional) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * Auberge WordPress Theme, Copyright 2014 WebMan [http://www.webmandesign.eu/]
 * Auberge is distributed under the terms of the GNU GPL
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Alternatively you can use filter and action hooks applied.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package    Auberge
 * @author     WebMan
 * @license    GPL-2.0+
 * @link       http://www.webmandesign.eu
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
 */





/**
 * Constants
 */

	//Helper variables
		$theme_data = wp_get_theme();

	//Basic constants
		if ( ! defined( 'WM_THEME_NAME' ) )            define( 'WM_THEME_NAME',            $theme_data->Name                          );
		if ( ! defined( 'WM_THEME_SHORTNAME' ) )       define( 'WM_THEME_SHORTNAME',       str_replace( '-plus', '', get_template() ) );
		if ( ! defined( 'WM_THEME_VERSION' ) )         define( 'WM_THEME_VERSION',         $theme_data->Version                       );

		if ( ! defined( 'WM_SCRIPTS_VERSION' ) )       define( 'WM_SCRIPTS_VERSION',       esc_attr( trim( WM_THEME_VERSION ) )       );
		if ( ! defined( 'WM_WP_COMPATIBILITY' ) )      define( 'WM_WP_COMPATIBILITY',      4.0                                        );

	//Dir constants
		if ( ! defined( 'WM_INC_DIR' ) )               define( 'WM_INC_DIR',               trailingslashit( 'inc/' )                  );

	//URL constants
		if ( ! defined( 'WM_DEVELOPER_URL' ) )         define( 'WM_DEVELOPER_URL',         $theme_data->get( 'AuthorURI' )            );

	//Theme design constants
		if ( ! defined( 'WM_IMAGE_SIZE_ITEMS' ) )      define( 'WM_IMAGE_SIZE_ITEMS',      'thumbnail'                                );
		if ( ! defined( 'WM_IMAGE_SIZE_ITEMS_MENU' ) ) define( 'WM_IMAGE_SIZE_ITEMS_MENU', 'banner-small'                             );
		if ( ! defined( 'WM_IMAGE_SIZE_SINGULAR' ) )   define( 'WM_IMAGE_SIZE_SINGULAR',   'large'                                    );





/**
 * Required files
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

?>