<?php
/**
 * Front page widgets area template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * Helper variables
 */

	$sidebar_id = 'front-page';

	$widgets_count = wp_get_sidebars_widgets();
	if ( is_array( $widgets_count ) && isset( $widgets_count[ $sidebar_id ] ) ) {
		$widgets_count = $widgets_count[ $sidebar_id ];
	} else {
		$widgets_count = array();
	}
	$widgets_count = count( $widgets_count );

	$widgets_columns = 3;

	if ( $widgets_count < $widgets_columns ) {
		$widgets_columns = $widgets_count;
	}



/**
 * Output
 */

	if ( is_active_sidebar( $sidebar_id ) ) {

		echo '<div class="front-page-widgets-wrapper clearfix">';
			echo '<div id="front-page-widgets" class="front-page-widgets columns-' . $widgets_columns . '" data-columns="' . $widgets_columns . '">';

				echo "\r\n\r\n" . '<div id="front-page-widgets-container" class="widget-area front-page-widgets-container widgets-count-' . $widgets_count . '" data-widgets-count="' . $widgets_count . '">' . "\r\n";

					dynamic_sidebar( $sidebar_id );

				echo "\r\n" . '</div>' . "\r\n\r\n";

			echo '</div>';
		echo '</div>';

	}

?>