<?php
/**
 * Archives template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





get_header();

	?>

	<section class="archives-listing content-container">

		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php

			the_archive_title( '<h1 class="page-title">', wm_paginated_suffix( 'small' ) . '</h1>' );

			the_archive_description( '<div class="taxonomy-description">', '</div>' );

			?>
		</header>

		<?php endif; ?>

		<?php get_template_part( 'template-parts/loop', 'archive' ); ?>

	</section>

	<?php

get_footer();
