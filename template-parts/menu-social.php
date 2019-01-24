<?php
/**
 * Social links menu template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.6.0
 */





// Requirements check

	if ( ! has_nav_menu( 'social' ) ) {
		return;
	}


// Variables

	$cache_key   = wm_social_cache_key();
	$cache_group = 'auberge_' . get_bloginfo( 'language' );

	$back_to_top  = '<li class="back-to-top-link">';
	$back_to_top .= '<a href="#page" class="back-to-top animated" title="' . esc_attr__( 'Back to top', 'auberge' ) . '">';
	$back_to_top .= '<span class="screen-reader-text">' . esc_html__( 'Back to top &uarr;', 'auberge' ) . '</span>';
	$back_to_top .= '</a>';
	$back_to_top .= '</li>';

	$social_menu_html = wp_cache_get( $cache_key, $cache_group );
	$social_menu_args = wm_social_menu_args( '<ul data-id="%1$s" class="%2$s">%3$s' . $back_to_top . '</ul>' );


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
			$social_menu_args['echo'] = false;

			$social_menu_html = wp_nav_menu( $social_menu_args );
			$social_menu_html = str_replace(
				' id=',
				' data-id=',
				$social_menu_html
			);

			wp_cache_set(
				$cache_key,
				$social_menu_html,
				$cache_group,
				7 * 24 * 60 * 60
			);
		}

		echo $social_menu_html; // WPCS: XSS OK.

	}

	?>

</nav>
