<?php
/**
 * Front page food menu loop
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





/**
 * Requirements check
 */

	if (
			! class_exists( 'WM_Nova_Restaurant' )
			|| ! current_theme_supports( 'nova_menu_item' )
			|| get_theme_mod( 'disable-food-menu' )
		) {
		return;
	}



/**
 * Helper variables
 */

	$auberge_food_menu = new WP_Query( (array) apply_filters( 'wmhook_loop_food_menu_query', array(
			'post_type'           => 'nova_menu_item',
			'posts_per_page'      => 300,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		) ) );



/**
 * Loop
 */
if ( $auberge_food_menu->have_posts() ) :

	?>

	<section class="food-menu-items page-section">

		<?php if ( ! is_page_template( 'page-template/_menu.php' ) ) : ?>

		<header class="page-header">

			<h2 class="page-title"><?php

			$auberge_title_food_menu   = (string) apply_filters( 'wmhook_loop_food_menu_title_text', esc_html_x( 'Menu', 'Food menu title.', 'auberge' ) );
			$auberge_food_menu_page_id = intval( get_transient( 'auberge-page-template-food-menu' ) );

			if ( 1 <= $auberge_food_menu_page_id ) {
				$auberge_title_food_menu = '<a href="' . esc_url( get_permalink( $auberge_food_menu_page_id ) ) . '">' . $auberge_title_food_menu . '</a>';
			}

			echo (string) apply_filters( 'wmhook_loop_food_menu_title_text_html', $auberge_title_food_menu );

			?></h2>

		</header>

		<?php endif; ?>

		<?php do_action( 'wmhook_loop_food_menu_postslist_before' ); ?>

		<div class="items items-list clearfix"<?php echo wm_schema_org( 'ItemList' ); ?>>

			<?php

			do_action( 'wmhook_loop_food_menu_postslist_top' );

			while ( $auberge_food_menu->have_posts() ) : $auberge_food_menu->the_post();

				get_template_part( 'template-parts/content', apply_filters( 'wmhook_loop_food_menu_content_template', 'food-menu' ) );

			endwhile;

			do_action( 'wmhook_loop_food_menu_postslist_bottom' );

			?>

		</div>

		<?php do_action( 'wmhook_loop_food_menu_postslist_after' ); ?>

	</section>

	<?php

	// Reset query

		wp_reset_query();

endif;
