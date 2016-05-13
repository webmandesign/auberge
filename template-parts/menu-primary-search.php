<?php
/**
 * Primary menu search form template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.0
 */





/**
 * Requirements check
 */

	if ( apply_filters( 'wmhook_menu_primary_search_disable', false ) ) {
		return;
	}

?>

<div id="nav-search-form" class="nav-search-form">

	<a href="#" id="search-toggle" class="search-toggle">
		<span class="screen-reader-text">
			<?php echo esc_html_x( 'Search', 'Display search form button title.', 'auberge' ); ?>
		</span>
	</a>

	<?php get_search_form(); ?>

</div>
