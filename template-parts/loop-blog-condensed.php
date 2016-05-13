<?php
/**
 * Front page condensed blog posts loop
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





/**
 * Helper variables
 */

	$auberge_blog_condensed = new WP_Query( apply_filters( 'wmhook_loop_blog_condensed_query', array(
			'post_type'           => 'post',
			'posts_per_page'      => 6,
			'paged'               => 1,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		) ) );



/**
 * Loop
 */
if ( $auberge_blog_condensed->have_posts() ) :

	?>

	<section class="blog-posts page-section">

		<header class="page-header">

			<h2 class="page-title"><?php

				$title_blog_condensed = (string) apply_filters( 'wmhook_loop_blog_condensed_title_text', esc_html__( 'News', 'auberge' ) );

				if ( $auberge_page_for_posts_id = absint( get_option( 'page_for_posts' ) ) ) {

					echo (string) apply_filters( 'wmhook_loop_blog_condensed_title_text_html', '<a href="' . esc_url( get_permalink( $auberge_page_for_posts_id ) ) . '">' . $title_blog_condensed . '</a>' );

				} else {

					echo (string) apply_filters( 'wmhook_loop_blog_condensed_title_text_html', $title_blog_condensed );

				}

			?></h2>

		</header>

		<?php do_action( 'wmhook_loop_blog_condensed_postslist_before' ); ?>

		<div class="posts posts-list clearfix"<?php echo wm_schema_org( 'ItemList' ); ?>>

			<?php

			do_action( 'wmhook_loop_blog_condensed_postslist_top' );

			while ( $auberge_blog_condensed->have_posts() ) : $auberge_blog_condensed->the_post();

				get_template_part( 'template-parts/content', apply_filters( 'wmhook_loop_blog_condensed_content_template', 'post-condensed' ) );

			endwhile;

			do_action( 'wmhook_loop_blog_condensed_postslist_bottom' );

			?>

		</div>

		<?php do_action( 'wmhook_loop_blog_condensed_postslist_after' ); ?>

	</section>

	<?php

	// Reset query

		wp_reset_query();

endif;
