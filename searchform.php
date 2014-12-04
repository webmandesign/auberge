<?php
/**
 * Search form template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */

?>

<form method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field" class="screen-reader-text"><?php _e( 'Search', 'wm_domain' ); ?></label>
	<input type="search" value="" placeholder="<?php _e( 'Search field: type and press enter', 'wm_domain' ); ?>" name="s" class="search-field" id="search-field" />
</form>