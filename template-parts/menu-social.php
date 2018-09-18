<?php
/**
 * Social links menu template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.5.0
 */





// Requirements check

	if ( ! has_nav_menu( 'social' ) ) {
		return;
	}


// Variables

	$back_to_top  = '<li class="back-to-top-link">';
	$back_to_top .= '<a href="#page" class="back-to-top animated" title="' . esc_attr__( 'Back to top', 'auberge' ) . '">';
	$back_to_top .= '<span class="screen-reader-text">' . esc_html__( 'Back to top &uarr;', 'auberge' ) . '</span>';
	$back_to_top .= '</a>';
	$back_to_top .= '</li>';

	$social_menu_html = get_transient( 'auberge_social_links' );

	$social_menu_args = array(
		'theme_location' => 'social',
		'container'      => false,
		'menu_class'     => 'social-links-items',
		'depth'          => 1,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>',
		'fallback_cb'    => false,
		'items_wrap'     => '<ul data-id="%1$s" class="%2$s">%3$s' . $back_to_top . '</ul>',
	);


?>

<nav class="social-links" aria-label="<?php esc_attr_e( 'Social Menu', 'auberge' ); ?>">

	<?php

	if ( is_customize_preview() ) {

		/**
		 * If we want to enable customizer partial edit, we need to output the menu standard way.
		 *
		 * @subpackage  Customize
		 */
		wp_nav_menu( $social_menu_args );

	} else {

		/**
		 * Social menu cache gets refreshed when you save/update the menu in WordPress admin.
		 *
		 * @see  wm_social_cache_flush()
		 */
		if ( ! $social_menu_html ) {
			$social_menu_html = wp_nav_menu( array_merge( array( 'echo' => false ), $social_menu_args ) );
			$social_menu_html = str_replace( ' id=', ' data-id=', $social_menu_html ); // Fix for multiple displays
			set_transient( 'auberge_social_links', $social_menu_html );
		}

		echo $social_menu_html;

	}

	?>

</nav>
