<?php
/**
 * Front page widgets area template
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

	if ( ! is_active_sidebar( 'front-page' ) ) {
		return;
	}



/**
 * Output
 */

	?>

	<div class="front-page-widgets-wrapper clearfix">

		<div id="front-page-widgets" class="front-page-widgets">

			<aside id="front-page-widgets-container" class="widget-area front-page-widgets-container" aria-labelledby="sidebar-front-page-label">

				<h2 class="screen-reader-text" id="sidebar-front-page-label"><?php echo esc_attr_x( 'Front page sidebar', 'Sidebar aria label', 'auberge' ); ?></h2>

				<?php dynamic_sidebar( 'front-page' ); ?>

			</aside>

		</div>

	</div>
