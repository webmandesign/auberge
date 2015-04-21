<?php
/**
 * Comments list template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.4
 */



/**
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}



/**
 * Display comments container only if comments open
 * and there are some comments to display
 */
if (
		( is_single( get_the_ID() ) || is_page( get_the_ID() ) )
		&& ( comments_open() || have_comments() )
		&& ! is_attachment()
	) :

	wmhook_comments_before();

	?>

	<div id="comments" class="comments-area">

		<h2 id="comments-title" class="comments-title"><?php

			printf(
					_nx( '1 comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'Comments list title.', 'wm_domain' ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);

			echo '<a href="#respond" class="add-comment-link">' . _x( 'Add yours &rarr;', 'Add new comment link text.', 'wm_domain' ) . '</a>';

		?></h2>

		<?php

		/**
		 * Comments list
		 */
		if ( have_comments() ) :

			if ( ! comments_open() ) {

				?>

				<h3 class="comments-closed"><?php _e( 'Comments are closed. You can not add new comments.', 'wm_domain' ); ?></h3>

				<?php

			} // /! comments_open()

			//Actual comments list
				?>

				<ol class="comment-list">

					<?php wp_list_comments( array( 'avatar_size' => 240, 'style' => 'ol', 'short_ping' => true ) ); ?>

				</ol>

				<?php

			//Paginated comments
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {

					?>

					<nav id="comment-nav-below" class="comment-navigation" role="navigation">

						<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'wm_domain' ); ?></h3>

						<div class="nav-previous">
							<?php previous_comments_link( __( '&larr; Older comments', 'wm_domain' ) ); ?>
						</div>

						<div class="nav-next">
							<?php next_comments_link( __( 'Newer comments &rarr;', 'wm_domain' ) ); ?>
						</div>

					</nav>

					<?php

				} // /get_comment_pages_count() > 1 && get_option( 'page_comments' )

		endif; // /have_comments()



		/**
		 * Comments form only if comments open
		 */
		if ( comments_open() ) {

			comment_form();

		}

	?>

	</div><!-- #comments -->

	<?php

	wmhook_comments_after();

endif;

?>