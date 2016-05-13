<?php
/**
 * Theme Hook Alliance
 *
 * @link  https://github.com/zamoose/themehookalliance
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */






/**
 * Theme Hook Alliance hook stub list.
 *
 * @package  themehookalliance
 * @version  1.0-draft
 * @since    1.0-draft
 * @license  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */



	/**
	 * Define the version of THA support, in case that becomes useful down the road.
	 */
	define( 'THA_HOOKS_VERSION', '1.0-draft' );



	/**
	 * Themes and Plugins can check for tha_hooks using current_theme_supports( 'tha_hooks', $hook )
	 * to determine whether a theme declares itself to support this specific hook type.
	 *
	 * Example:
	 * <code>
	 * 		// Declare support for all hook types
	 * 		add_theme_support( 'tha_hooks', array( 'all' ) );
	 *
	 * 		// Declare support for certain hook types only
	 * 		add_theme_support( 'tha_hooks', array( 'header', 'content', 'footer' ) );
	 * </code>
	 */
	add_theme_support( 'tha_hooks', array( 'all' ) );



	/**
	 * Determines, whether the specific hook type is actually supported.
	 *
	 * Plugin developers should always check for the support of a <strong>specific</strong>
	 * hook type before hooking a callback function to a hook of this type.
	 *
	 * Example:
	 * <code>
	 * 		if ( current_theme_supports( 'tha_hooks', 'header' ) )
	 * 	  		add_action( 'tha_head_top', 'prefix_header_top' );
	 * </code>
	 *
	 * @param   bool  $bool       True
	 * @param   array $args       The hook type being checked
	 * @param   array $registered All registered hook types
	 *
	 * @return  bool
	 */
	function tha_current_theme_supports( $bool, $args, $registered ) {
		return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
	} // /tha_current_theme_supports

	add_filter( 'current_theme_supports-tha_hooks', 'tha_current_theme_supports', 10, 3 );
