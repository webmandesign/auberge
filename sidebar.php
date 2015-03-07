<?php
/**
 * Sidebar template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.3
 */



if ( is_active_sidebar( 'sidebar' ) ) {

	wmhook_sidebars_before();

	?>

	<div id="secondary" class="widget-area sidebar" role="complementary"<?php echo wm_schema_org( 'WPSideBar' ); ?>>

		<a href="#" id="toggle-mobile-sidebar" class="toggle-mobile-sidebar button" aria-controls="secondary" aria-expanded="false"><?php _e( 'Toggle sidebar', 'wm_domain' ); ?></a>

		<?php

		wmhook_sidebar_top();

		dynamic_sidebar( 'sidebar' );

		wmhook_sidebar_bottom();

		?>

	</div>

	<?php

	wmhook_sidebars_after();

}

?>