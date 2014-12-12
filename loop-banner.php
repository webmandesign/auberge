<?php
/**
 * Banner / Featured content loop
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
 */

?>

<div id="site-banner" class="site-banner<?php if ( is_front_page() && wm_has_banner_posts( 2 ) ) { echo ' enable-slider'; } else { echo ' no-slider'; } ?>"<?php do_action( 'wmhook_site_banner_container_atts' ); ?>>

	<div class="site-banner-inner">

		<?php

		do_action( 'wmhook_banner_content_top' );

		if ( $banner = apply_filters( 'wmhook_custom_banner', '' ) ) {

			//Display custom banner first
				echo $banner;

		} elseif ( is_front_page() && wm_has_banner_posts( 1 ) ) {

			//Display featured posts (only on homepage)
				$featured_posts = wm_get_banner_posts();

				foreach ( (array) $featured_posts as $order => $post ) {

					setup_postdata( $post );
					get_template_part( 'content', 'featured-post' );

				}

				wp_reset_postdata();

		} else {

			//Fall back to Custom Header
				get_template_part( 'content', 'custom-header' );

		}

		do_action( 'wmhook_banner_content_bottom' );

		?>

	</div>

</div>