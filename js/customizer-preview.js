/**
 * Customizer preview scripts
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.2.5
 */





jQuery( function() {



	/**
	 * Site title and description.
	 */

		wp.customize( 'blogname', function( value ) {

			value.bind( function( to ) {
				jQuery( '.site-title a' ).text( to );
			} );

		} ); // /blogname

		wp.customize( 'blogdescription', function( value ) {

			value.bind( function( to ) {
				jQuery( '.site-description, .site-banner-header .highlight' ).text( to );
			} );

		} ); // /blogdescription



} );