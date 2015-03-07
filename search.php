<?php
/**
 * Search results template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 * @version    1.0
 */



get_header();

	?>

	<section id="search-results" class="search-results">

		<header class="page-header">

			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wm_domain' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

		</header>

		<?php get_template_part( 'loop', 'search' ); ?>

	</section>

	<?php

get_footer();

?>