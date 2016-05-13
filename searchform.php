<?php
/**
 * Search form template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





?>

<form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label for="search-field" class="screen-reader-text">
		<?php echo esc_html_x( 'Search', 'Search field label.', 'auberge' ); ?>
	</label>

	<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search field: type and press enter', 'auberge' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

</form>
