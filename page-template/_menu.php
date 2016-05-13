<?php
/**
 * Custom page template
 *
 * Template Name: Food menu
 *
 * Displays page content followed by food menu items.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */

/* translators: Custom page template name. */
__( 'Food menu', 'auberge' );





get_header();

	while ( have_posts() ) : the_post();

		if ( get_the_content() ) {
			get_template_part( 'template-parts/content', 'page' );
		}

	endwhile;

get_footer();
