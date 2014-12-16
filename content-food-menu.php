<?php
/**
 * Food menu post content
 *
 * The link to single post page will be applied only if the
 * post has some content.
 *
 * Post lists display:
 * - featured image
 * - title with price
 * - excerpt
 *
 * Single post page display:
 * - featured image
 * - title with price
 * - excerpt
 * - content
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
 */



/**
 * Requirements check
 */

	if ( ! current_theme_supports( 'nova_menu_item' ) ) {
		return;
	}



$pagination_suffix = wm_paginated_suffix( 'small', 'nova_menu_item' );

//Wrapper tag setup
	$tag = ( is_single() ) ? ( 'array' ) : ( 'aside' );

?>

<<?php echo $tag; ?> id="post-<?php the_ID(); ?>" <?php post_class(); wmhook_entry_container_atts(); ?>>

	<?php

	/**
	 * Post media
	 */
	if (
			has_post_thumbnail()
			&& ! $pagination_suffix
			&& apply_filters( 'wmhook_entry_featured_image_display', true )
		) :

		$image_size = ( is_single() ) ? ( WM_IMAGE_SIZE_SINGULAR ) : ( WM_IMAGE_SIZE_ITEMS_MENU );
		$image_link = ( ! is_single() && trim( strip_tags( get_the_content() ) ) ) ? ( array( get_permalink() ) ) : ( wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) );
		$image_link = array_filter( (array) apply_filters( 'wmhook_entry_image_link', $image_link ) );

		?>

		<div class="entry-media">

			<figure class="post-thumbnail"<?php echo wm_schema_org( 'image' ); ?>>

				<?php

				if ( ! empty( $image_link ) ) {
					echo '<a href="' . esc_url( $image_link[0] ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
				}

				the_post_thumbnail( $image_size );

				if ( ! empty( $image_link ) ) {
					echo '</a>';
				}

				?>

			</figure>

		</div>

		<?php

	endif;



	/**
	 * Post content
	 */

		echo '<div class="entry-inner">';

			wmhook_entry_top();

			echo '<div class="entry-content"' . wm_schema_org( 'entry_body' ) . '>';

				if ( has_excerpt() && ! $pagination_suffix ) {

					echo '<div class="food-menu-item-description"' . wm_schema_org( 'itemprop="description"' ) . '>';

						the_excerpt();

					echo '</div>';

				}

				if ( is_single() ) {
					the_content( apply_filters( 'wmhook_wm_excerpt_continue_reading', '' ) );
				}

			echo '</div>';

			wmhook_entry_bottom();

		echo '</div>';

	?>

</<?php echo $tag; ?>>