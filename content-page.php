<?php
/**
 * Page content
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



$pagination_suffix = wm_paginated_suffix( 'small', 'post' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); wmhook_entry_container_atts(); ?>>

	<?php

	/**
	 * Page featured image
	 */
	if (
			has_post_thumbnail()
			&& ! $pagination_suffix
			&& apply_filters( 'wmhook-entry-featured-image-display', true )
		) :

		$image_link = array_filter( (array) apply_filters( 'wmhook-entry-image-link', wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ) );

		?>

		<div class="entry-media">

			<figure class="post-thumbnail"<?php echo wm_schema_org( 'image' ); ?>>

				<a href="<?php echo esc_url( $image_link[0] ); ?>" title="<?php the_title_attribute(); ?>">

					<?php the_post_thumbnail( WM_IMAGE_SIZE_SINGULAR ); ?>

				</a>

			</figure>

		</div>

		<?php

	endif;



	/**
	 * Page content
	 */

		echo '<div class="entry-inner">';

			wmhook_entry_top();

			echo '<div class="entry-content"' . wm_schema_org( 'entry_body' ) . '>';

				the_content();

			echo '</div>';

			wmhook_entry_bottom();

		echo '</div>';

	?>

</article>