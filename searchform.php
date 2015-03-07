<?php
/**
 * Search form template
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
 */

?>

<form method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field" class="screen-reader-text"><?php _ex( 'Search', 'Search field label.', 'wm_domain' ); ?></label>
	<input type="search" value="" placeholder="<?php _e( 'Search field: type and press enter', 'wm_domain' ); ?>" name="s" class="search-field" id="search-field" />
</form>