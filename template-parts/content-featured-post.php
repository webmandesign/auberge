<?php
/**
 * Featured post content
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.2.0
 */





// Requirements check

	if (
			! has_post_thumbnail()
			&& ! $image_url = get_header_image()
		) {
		return;
	}


?>

<article data-id="post-<?php the_ID(); ?>" <?php post_class(); echo apply_filters( 'wmhook_entry_container_atts', '' ); ?>>

	<div class="site-banner-media">

		<figure class="site-banner-thumbnail" title="<?php the_title(); ?>"<?php echo wm_schema_org( 'image' ); ?>>

			<?php

			if ( has_post_thumbnail() ) {

				// Post featured image

					the_post_thumbnail( 'auberge_banner' );

			} else {

				// Fallback to Custom Header image

					echo '<img src="' . esc_url( $image_url ) . '" width="' . esc_attr( get_custom_header()->width ) . '" height="' . esc_attr( get_custom_header()->height ) . '" alt="" />';

			}

			?>

		</figure>

	</div>

	<div class="site-banner-header">

		<h3 class="entry-title site-banner-title"<?php echo wm_schema_org( 'name' ); ?>>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="highlight" rel="bookmark"><?php

			if ( $custom_title = trim( get_post_meta( get_the_ID(), 'banner_text', true ) ) ) {

				// Display 'banner_text' custom field if set

					echo $custom_title;

			} else {

				// If no 'banner_text' custom field set, fall back to post title

					the_title();

			}

			?></a>
		</h3>

	</div>

</article>
