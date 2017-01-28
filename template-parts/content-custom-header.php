<?php
/**
 * Custom Header content
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.2.0
 */





// Requirements check

	if ( ! $image_url = get_header_image() ) {
		return;
	}


?>

<div class="site-banner-content">

	<div class="site-banner-media">

		<figure class="site-banner-thumbnail">

			<?php

			echo '<img src="' . esc_url( $image_url ) . '" width="' . esc_attr( get_custom_header()->width ) . '" height="' . esc_attr( get_custom_header()->height ) . '" alt="" />';

			?>

		</figure>

	</div>

	<div class="site-banner-header">

		<h3 class="entry-title site-banner-title">
			<span class="highlight">
				<?php

				if (
						get_option( 'page_on_front' )
						&& $custom_title = trim( get_post_meta( get_the_ID(), 'banner_text', true ) )
					) {

					// If there is a front page, display 'banner_text' custom field if set

						echo $custom_title;

				} else {

					// Display site description

						bloginfo( 'description' );

				}

				?>
			</span>
		</h3>

	</div>

</div>
