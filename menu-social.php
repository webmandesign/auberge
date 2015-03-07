<?php
/**
 * Social links menu template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 * @version    1.0
 */



if ( has_nav_menu( 'social' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => '',
			'container_class' => 'social-links',
			'menu_id'         => '',
			'menu_class'      => 'social-links-items',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

}

?>