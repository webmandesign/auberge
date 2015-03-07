<?php
/**
 * Archives template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.2
 */



get_header();

	?>

	<section class="archives-listing">

		<header class="page-header">
			<?php

				the_archive_title( '<h1 class="page-title">', wm_paginated_suffix( 'small' ) . '</h1>' );

				the_archive_description( '<div class="taxonomy-description">', '</div>' );

			?>
		</header>

		<?php get_template_part( 'loop', 'archive' ); ?>

	</section>

	<?php

get_footer();

?>