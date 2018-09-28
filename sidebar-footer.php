<?php
/**
 * Footer widgets area template
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

	if ( ! is_active_sidebar( 'footer' ) ) {
		return;
	}



/**
 * Output
 */

	?>

	<div class="site-footer-area footer-area-footer-widgets">

		<div id="footer-widgets" class="footer-widgets clearfix">

			<aside id="footer-widgets-container" class="widget-area footer-widgets-container" aria-labelledby="sidebar-footer-label">

				<h2 class="screen-reader-text" id="sidebar-footer-label"><?php echo esc_attr_x( 'Footer sidebar', 'Sidebar aria label', 'auberge' ); ?></h2>

				<?php dynamic_sidebar( 'footer' ); ?>

			</aside>

		</div>

	</div>
