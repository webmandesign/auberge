<?php
/**
 * Default WordPress posts loop
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.3
 */



if ( have_posts() ) {

	wmhook_postslist_before();

	if ( is_archive() && is_tax( 'nova_menu' ) ) {
		echo '<div id="items" class="items items-list clearfix"' . wm_schema_org( 'ItemList' ) . '>';
	} else {
		echo '<div id="posts" class="posts posts-list clearfix"' . wm_schema_org( 'ItemList' ) . '>';
	}

		wmhook_postslist_top();

		while ( have_posts() ) :

			the_post();

			$content_type = get_post_format();

			if ( 'nova_menu_item' === get_post_type() ) {
				$content_type = 'food-menu';
			}

			get_template_part( 'content', $content_type );

		endwhile;

		wmhook_postslist_bottom();

	echo '</div>';

	wmhook_postslist_after();

} else {

	get_template_part( 'content', 'none' );

}

wp_reset_query();

?>