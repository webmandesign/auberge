<?php
/**
 * Archives template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



get_header();

	?>

	<section class="archives-listing">

		<header class="page-header">

			<h1 class="page-title"><?php

				if ( is_category() ) {
					single_cat_title();

				} elseif ( is_tag() ) {
					single_tag_title();

				} elseif ( is_author() ) {
					printf( __( 'Author: %s', 'wm_domain' ), '<span class="vcard">' . get_the_author() . '</span>' );

				} elseif ( is_day() ) {
					printf( __( 'Day: %s', 'wm_domain' ), '<span>' . get_the_date() . '</span>' );

				} elseif ( is_month() ) {
					printf( __( 'Month: %s', 'wm_domain' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wm_domain' ) ) . '</span>' );

				} elseif ( is_year() ) {
					printf( __( 'Year: %s', 'wm_domain' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wm_domain' ) ) . '</span>' );

				} elseif ( is_tax() ) {

					if ( is_tax( 'post_format' ) ) {
						printf( __( 'Post format: %s', 'wm_domain' ), '<span>' . single_term_title( '', false ) . '</span>' );
					} else {
						single_term_title();
					}

				} elseif ( is_post_type_archive() ) {
					post_type_archive_title();

				} elseif ( is_archive() ) {
					_e( 'Archives', 'wm_domain' );

				}

				echo wm_paginated_suffix( 'small' );

			?></h1>

			<?php

			//Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) {
					printf( '<div class="taxonomy-description">%s</div>' . "\r\n", $term_description );
				}

			?>
		</header>

		<?php get_template_part( 'loop', 'archive' ); ?>

	</section>

	<?php

get_footer();

?>