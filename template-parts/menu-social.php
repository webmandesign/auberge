<?php
/**
 * Social links menu template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





// Helper variables

	$auberge_social_menu_id = rand( 10, 99 );



if ( has_nav_menu( 'social' ) ) :

	?>

	<nav class="social-links" role="navigation" aria-labelledby="social-links-label-<?php echo absint( $auberge_social_menu_id ); ?>">

		<h2 class="screen-reader-text" id="social-links-label-<?php echo absint( $auberge_social_menu_id ); ?>"><?php esc_html_e( 'Social Menu', 'auberge' ); ?></h2>

		<?php

		wp_nav_menu( array(
				'theme_location' => 'social',
				'container'      => false,
				'menu_class'     => 'social-links-items',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'fallback_cb'    => false,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s<li class="back-to-top-link"><a href="#" class="back-to-top" title="' . esc_attr__( 'Back to top', 'auberge' ) . '"><span class="screen-reader-text">' . esc_html__( 'Back to top &uarr;', 'auberge' ) . '</span></a></li></ul>',
			) );

		?>

	</nav>

	<?php

endif;
