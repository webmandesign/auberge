<?php
/**
 * Website header template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.7.1
 */





do_action( 'tha_html_before' );

?>

<html class="no-js" <?php language_attributes(); ?>>

<head>

<?php

do_action( 'tha_head_top' );
do_action( 'tha_head_bottom' );

wp_head();

?>

</head>


<body id="top" <?php body_class(); echo wm_schema_org( 'WebPage' ); ?>>

<?php

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}

do_action( 'tha_body_top' );

if ( ! apply_filters( 'wmhook_disable_header', false ) ) {
	do_action( 'tha_header_before' );
	do_action( 'tha_header_top' );
	do_action( 'tha_header_bottom' );
	do_action( 'tha_header_after' );
}

do_action( 'tha_content_before' );
do_action( 'tha_content_top' );
