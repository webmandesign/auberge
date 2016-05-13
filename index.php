<?php
/**
 * General index template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





get_header();

	?>

	<section class="content-container">

		<?php if ( is_home() && ! is_front_page() ) : ?>

		<header>

			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>

		</header>

		<?php endif; ?>

		<?php get_template_part( 'template-parts/loop', 'index' ); ?>

	</section>

	<?php

get_footer();
