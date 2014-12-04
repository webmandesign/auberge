<?php
/**
 * Front page food menu loop
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * Food Menu
 */
if ( class_exists( 'Nova_Restaurant' ) ) :

	//Query setup
		$food_menu = new WP_Query( apply_filters( 'wmhook_loop_food_menu_query', array(
				'post_type'           => 'nova_menu_item',
				'posts_per_page'      => -1,
				'ignore_sticky_posts' => true,
			) ) );

	//Loop
		if ( $food_menu->have_posts() ) {

		?>

		<section class="food-menu-items page-section">

			<?php if ( ! is_page_template( 'page-template/_menu.php' ) ) : ?>

			<header class="page-header">

				<h1 class="page-title"><?php

				$title_food_menu = __( 'Menu', 'wm_domain' );

				$food_menu_page_id = intval( get_transient( 'wm-page-template-food-menu' ) );

				if ( 1 <= $food_menu_page_id ) {
					$title_food_menu = '<a href="' . esc_url( get_permalink( $food_menu_page_id ) ) . '">' . $title_food_menu . '</a>';
				}

				echo apply_filters( 'wmhook_loop_food_menu_title_text', $title_food_menu );

				?></h1>

			</header>

			<?php

			endif;

			do_action( 'wmhook_loop_food_menu_postslist_before' );

			echo '<div class="items items-list clearfix"' . wm_schema_org( 'ItemList' ) . '>';

				do_action( 'wmhook_loop_food_menu_postslist_top' );

				while ( $food_menu->have_posts() ) :

					$food_menu->the_post();

					get_template_part( 'content', 'food-menu' );

				endwhile;

				do_action( 'wmhook_loop_food_menu_postslist_bottom' );

			echo '</div>';

			do_action( 'wmhook_loop_food_menu_postslist_after' );

			?>

		</section>

		<?php

		}

		wp_reset_query();

		endif;

?>