<?php
/**
 * Custom page template
 *
 * Template Name: Food menu
 *
 * Displays page content followed by food menu items.
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 * @version    1.0
 */



get_header();



	/**
	 * Page content
	 */

		wp_reset_query();

		wmhook_entry_before();

		if (
				have_posts()
				&& $page_content = get_the_content()
			) {

			the_post();

			get_template_part( 'content', 'page' );

			wp_reset_query();

		}

		wmhook_entry_after();



	/**
	 * Food Menu
	 */

	get_template_part( 'loop', 'food-menu' );



get_footer();

?>