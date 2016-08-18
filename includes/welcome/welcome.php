<?php
/**
 * Welcome Page
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.1
 * @version  2.1
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Admin page
 */





/**
 * 1) Requirements check
 */

	if (
			! is_admin()
			|| ! get_theme_mod( 'others_welcome_page', true )
		) {
		return;
	}





/**
 * 10) Admin page
 */

	require_once( 'class-welcome.php' );
