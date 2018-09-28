<?php
/**
 * Primary menu template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.5.3
 */





?>

<nav id="site-navigation" class="main-navigation" aria-labelledby="site-navigation-label"<?php echo wm_schema_org( 'SiteNavigationElement' ); ?>>

	<h2 class="screen-reader-text" id="site-navigation-label"><?php esc_html_e( 'Primary Menu', 'auberge' ); ?></h2>

	<?php get_template_part( 'template-parts/menu', 'mobile' ); ?>

	<div id="main-navigation-inner" class="main-navigation-inner">

		<?php

		wp_nav_menu( array(
				'theme_location'  => 'primary',
				'container'       => 'div',
				'container_class' => 'menu',
				'menu_class'      => 'menu', // Fallback for pagelist
				'depth'           => 3,
				'items_wrap'      => '<ul>%3$s</ul>',
			) );

		?>

		<?php get_template_part( 'template-parts/menu', 'primary-search' ); ?>

	</div>

	<button id="menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><?php echo esc_html_x( 'Menu', 'Mobile navigation toggle button title.', 'auberge' ); ?></button>

</nav>
