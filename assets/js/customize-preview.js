/**
 * Customizer preview scripts
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.5.0
 */





( function( $ ) {

	'use strict';





	/**
	 * Site title and description.
	 */

		wp.customize( 'blogname', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						$( '.site-title' )
							.text( to );

					} );

		} ); // /blogname

		wp.customize( 'blogdescription', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						$( '.site-description, .site-banner-header .highlight' )
							.text( to );

					} );

		} ); // /blogdescription

		wp.customize( 'header_textcolor', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						if ( 'blank' === to ) {

							$( '.site-title, .site-description' )
								.css( {
									'clip'     : 'rect(1px, 1px, 1px, 1px)',
									'position' : 'absolute',
								} );

							$( 'body' )
								.addClass( 'site-title-hidden' );

						} else {

							$( '.site-title, .site-description' )
								.css( {
									'clip'     : 'auto',
									'position' : 'relative',
								} );

							$( 'body' )
								.removeClass( 'site-title-hidden' );

						}

					} );

		} ); // /header_textcolor





} )( jQuery );
