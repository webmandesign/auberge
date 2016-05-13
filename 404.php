<?php
/**
 * Error 404 page template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





get_header();

	?>

	<section id="error-404" class="error-404 not-found">

		<header class="page-header">

			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'auberge' ); ?></h1>

		</header>

		<div class="page-content">

			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try the search below?', 'auberge' ); ?></p>

			<?php get_search_form(); ?>

		</div>

	</section>

	<?php

get_footer();
