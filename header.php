<?php
/**
 * Website header template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * HTML
 */

	wmhook_html_before();

?>

<!--[if IE 9]><html class="ie ie9 lie9 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>

<?php

	/**
	 * HTML head
	 */

	wmhook_head_top();

	if ( ! function_exists( '_wp_render_title_tag' ) ) :
	?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php
	endif;

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