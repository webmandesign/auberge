<?php
/**
 * Website header template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.2
 */



/**
 * HTML
 */

	wmhook_html_before();

?>

<html class="no-js" <?php language_attributes(); ?>>

<head>

<?php

	/**
	 * HTML head
	 */

	wmhook_head_top();

	wmhook_head_bottom();

	wp_head();

?>

</head>


<body id="top" <?php body_class(); ?>>

<?php

	/**
	 * Body
	 */

		wmhook_body_top();



	if ( ! apply_filters( 'wmhook_disable_header', false ) ) {

		/**
		 * Header
		 */

			wmhook_header_before();

			wmhook_header_top();

			wmhook_header();

			wmhook_header_bottom();

			wmhook_header_after();



		/**
		 * Content
		 */

			wmhook_content_before();

			wmhook_content_top();

	} // /wmhook_disable_header

?>