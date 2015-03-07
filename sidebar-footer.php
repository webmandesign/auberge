<?php
/**
 * Footer widgets area template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.2
 */



/**
 * Helper variables
 */

	$sidebar_id = 'footer';

	$widgets_count = wp_get_sidebars_widgets();
	if ( is_array( $widgets_count ) && isset( $widgets_count[ $sidebar_id ] ) ) {
		$widgets_count = $widgets_count[ $sidebar_id ];
	} else {
		$widgets_count = array();
	}
	$widgets_count = count( $widgets_count );

	$widgets_columns = absint( apply_filters( 'wmhook_widgets_columns', 3, $sidebar_id ) );

	if ( $widgets_count < $widgets_columns ) {
		$widgets_columns = $widgets_count;
	}



/**
 * Output
 */

	if ( is_active_sidebar( $sidebar_id ) ) {

		echo '<div class="site-footer-area footer-area-footer-widgets">';
			echo '<div id="footer-widgets" class="footer-widgets clearfix columns-' . $widgets_columns . '" data-columns="' . $widgets_columns . '">';

				echo "\r\n\r\n" . '<div id="footer-widgets-container" class="widget-area footer-widgets-container widgets-count-' . $widgets_count . '" data-widgets-count="' . $widgets_count . '">' . "\r\n";

					dynamic_sidebar( $sidebar_id );

				echo "\r\n" . '</div>' . "\r\n\r\n";

			echo '</div>';
		echo '</div>';

	}

?>