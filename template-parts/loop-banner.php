<?php
/**
 * Banner / Featured content loop
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.2.0
 */





// Helper variables

	$output = '';

	$auberge_banner_container_class = ( is_front_page() && wm_has_banner_posts( 2 ) ) ? ( 'enable-slider' ) : ( 'no-slider' );


// Output

	ob_start();

		if ( $banner = apply_filters( 'wmhook_custom_banner', '' ) ) {

			// Display custom banner first

				echo $banner;

		} elseif ( is_front_page() && wm_has_banner_posts( 1 ) ) {

			// Display featured posts (only on front page)

				$featured_posts = wm_get_banner_posts();

				foreach ( (array) $featured_posts as $order => $post ) {

					setup_postdata( $post );
					get_template_part( 'template-parts/content', 'featured-post' );

				}

				wp_reset_postdata();

		} else {

			// Fall back to Custom Header

				get_template_part( 'template-parts/content', 'custom-header' );

		}

	$output = ob_get_clean();


// Requirements check

	if ( empty( $output ) ) {
		return;
	}


?>

<div id="site-banner" class="site-banner <?php echo esc_attr( $auberge_banner_container_class ) ?>"<?php do_action( 'wmhook_site_banner_container_atts' ); ?>>

	<aside class="site-banner-inner">

		<h2 class="screen-reader-text"><?php echo esc_attr__( 'Site banner', 'auberge' ); ?></h2>

		<?php

		do_action( 'wmhook_banner_content_top' );

		echo $output;

		do_action( 'wmhook_banner_content_bottom' );

		?>

	</aside>

</div>
