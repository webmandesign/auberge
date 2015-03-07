<?php
/**
 * Front page blog posts loop
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.3
 */



/**
 * Blog posts
 */

	//Query setup
		$blog_posts = new WP_Query( apply_filters( 'wmhook_loop_blog_condensed_query', array(
				'post_type'           => 'post',
				'posts_per_page'      => 6,
				'paged'               => 1,
				'ignore_sticky_posts' => true,
			) ) );

	//Loop
		if ( $blog_posts->have_posts() ) :

		?>

		<section class="blog-posts page-section">

			<header class="page-header">

				<h1 class="page-title"><?php

					$title_blog_condensed = (string) apply_filters( 'wmhook_loop_blog_condensed_title_text', __( 'News', 'wm_domain' ) );

					if ( $page_for_posts_id = absint( get_option( 'page_for_posts' ) ) ) {
						echo apply_filters( 'wmhook_loop_blog_condensed_title_text_html', '<a href="' . esc_url( get_permalink( $page_for_posts_id ) ) . '">' . $title_blog_condensed . '</a>' );
					} else {
						echo apply_filters( 'wmhook_loop_blog_condensed_title_text_html', $title_blog_condensed );
					}

				?></h1>

			</header>

			<?php

			do_action( 'wmhook_loop_blog_condensed_postslist_before' );

			echo '<div class="posts posts-list clearfix"' . wm_schema_org( 'ItemList' ) . '>';

				do_action( 'wmhook_loop_blog_condensed_postslist_top' );

				while ( $blog_posts->have_posts() ) :

					$blog_posts->the_post();

					get_template_part( 'content', apply_filters( 'wmhook_loop_blog_condensed_content_template', '' ) );

				endwhile;

				do_action( 'wmhook_loop_blog_condensed_postslist_bottom' );

			echo '</div>';

			do_action( 'wmhook_loop_blog_condensed_postslist_after' );

			?>

		</section>

		<?php

		wp_reset_query();

		endif;

?>