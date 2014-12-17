<?php
/**
 * Archives template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
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
					printf( _x( 'Author: %s', 'Archive page title.', 'wm_domain' ), '<span class="vcard">' . get_the_author() . '</span>' );

				} elseif ( is_day() ) {
					printf( _x( 'Day: %s', 'Archive page title.', 'wm_domain' ), '<span>' . get_the_date() . '</span>' );

				} elseif ( is_month() ) {
					printf( _x( 'Month: %s', 'Archive page title.', 'wm_domain' ), '<span>' . get_the_date( _x( 'F Y', 'Monthly archives date format.', 'wm_domain' ) ) . '</span>' );

				} elseif ( is_year() ) {
					printf( _x( 'Year: %s', 'Archive page title.', 'wm_domain' ), '<span>' . get_the_date( _x( 'Y', 'Yearly archives date format.', 'wm_domain' ) ) . '</span>' );

				} elseif ( is_tax() ) {

					if ( is_tax( 'post_format' ) ) {
						printf( _x( 'Post format: %s', 'Archive page title.', 'wm_domain' ), '<span>' . single_term_title( '', false ) . '</span>' );
					} else {
						single_term_title();
					}

				} elseif ( is_post_type_archive() ) {
					post_type_archive_title();

				} elseif ( is_archive() ) {
					_ex( 'Archives', 'Archive page title.', 'wm_domain' );

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