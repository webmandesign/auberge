<?php
/**
 * Front page blog posts loop
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
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

					if ( $page_for_posts_id = absint( get_option( 'page_for_posts' ) ) ) {
						echo apply_filters( 'wmhook_loop_blog_condensed_title_blog', '<a href="' . esc_url( get_permalink( $page_for_posts_id ) ) . '">' . __( 'News', 'wm_domain' ) . '</a>' );
					} else {
						echo apply_filters( 'wmhook_loop_blog_condensed_title_text', __( 'Blog', 'wm_domain' ) );
					}

				?></h1>

			</header>

			<?php

			do_action( 'wmhook_loop_blog_condensed_postslist_before' );

			echo '<div class="posts posts-list clearfix"' . wm_schema_org( 'ItemList' ) . '>';

				do_action( 'wmhook_loop_blog_condensed_postslist_top' );

				while ( $blog_posts->have_posts() ) :

					$blog_posts->the_post();

					get_template_part( 'content', get_post_format() );

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