<?php
/**
 * Sidebar template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.5.3
 */





/**
 * Requirements check
 */

	if ( ! is_active_sidebar( 'sidebar' ) ) {
		return;
	}



/**
 * Output
 */

	do_action( 'tha_sidebars_before' );

	?>

	<aside id="secondary" class="widget-area sidebar" aria-labelledby="sidebar-label"<?php echo wm_schema_org( 'WPSideBar' ); ?>>

		<h2 class="screen-reader-text" id="sidebar-label"><?php echo esc_attr_x( 'Sidebar', 'Sidebar aria label', 'auberge' ); ?></h2>

		<a href="#" id="toggle-mobile-sidebar" class="toggle-mobile-sidebar button" aria-controls="secondary" aria-expanded="false"><?php esc_html_e( 'Toggle sidebar', 'auberge' ); ?></a>

		<?php

		do_action( 'tha_sidebar_top' );

		dynamic_sidebar( 'sidebar' );

		do_action( 'tha_sidebar_bottom' );

		?>

	</aside>

	<?php

	do_action( 'tha_sidebars_after' );
