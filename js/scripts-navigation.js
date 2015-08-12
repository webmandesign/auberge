/**
 * Accessible navigation
 *
 * @link  http://a11yproject.com/
 * @link  https://codeable.io/community/wordpress-accessibility-creating-accessible-dropdown-menus/
 *
 * @package    Auberge
 * @copyright  2015 WebMan - Oliver Juhas
 *
 * @since    1.4.8
 * @version  1.4.8
 *
 * Contents:
 *
 * 10) Mobile navigation
 * 20) Accessibility
 */





jQuery( function() {





	/**
	 * 10) Mobile navigation
	 */

		/**
		 * Cache
		 */

			var $window           = jQuery( window ),
			    $siteNavigation   = jQuery( document.getElementById( 'site-navigation' ) ),
			    $menuToggleButton = jQuery( document.getElementById( 'menu-toggle' ) );



		/**
		 * Mobile navigation
		 */

			$menuToggleButton
				.on( 'click', function( e ) {

					e.preventDefault();

					$siteNavigation
						.toggleClass( 'active' );

					if ( $siteNavigation.hasClass( 'active' ) ) {

						$menuToggleButton
							.attr( 'aria-expanded', 'true' )
							.parent( '#site-navigation' )
								.find( '.main-navigation-inner ul' )
									.attr( 'aria-expanded', 'true' );

						jQuery( 'html, body' )
							.stop()
							.animate( { scrollTop : '0px' }, 0 );

					} else {

						$menuToggleButton
							.attr( 'aria-expanded', 'false' )
							.parent( '#site-navigation' )
								.find( '.main-navigation-inner ul' )
									.attr( 'aria-expanded', 'false' );

					}

				} );

			// Disable mobile navigation on wider screens

				$window
					.on( 'resize orientationchange', function( e ) {

						if ( 960 < document.body.clientWidth ) {

							$menuToggleButton
								.attr( 'aria-expanded', 'true' )
								.parent( '#site-navigation' )
									.find( '.main-navigation-inner ul' )
										.attr( 'aria-expanded', 'true' );

						} else {

							$menuToggleButton
								.attr( 'aria-expanded', 'false' )
								.parent( '#site-navigation' )
									.find( '.main-navigation-inner ul' )
										.attr( 'aria-expanded', 'false' );

						}

					} );





	/**
	 * 20) Accessibility
	 */



		/**
		 * ARIA haspopup
		 */

			// Applying `aria-haspopup` attribute

				$siteNavigation
					.find( '.menu-item-has-children' )
						.attr( 'aria-haspopup', 'true' );

			// Setting `aria-expanded` for menu `aria-haspopup` elements

				// Properly update the ARIA states on focus (keyboard) and mouse over events

					$siteNavigation
						.on( 'focus.aria mouseenter.aria', '[aria-haspopup="true"]', function ( e ) {

							jQuery( e.currentTarget )
								.attr( 'aria-expanded', true );

						} );

				// Properly update the ARIA states on blur (keyboard) and mouse out events

					$siteNavigation
						.on( 'blur.aria mouseleave.aria', '[aria-haspopup="true"]', function ( e ) {

							jQuery( e.currentTarget )
								.attr( 'aria-expanded', false );

						} );



		/**
		 * Touch-enabled
		 */

			$siteNavigation
				.on( 'click', '[aria-haspopup="true"] .expander', function( e ) {

					e.preventDefault();

					var $this = jQuery( this ).parent().parent();

					if ( ! $this.is( ':hover' ) ) {
						if ( false == $this.attr( 'aria-expanded' ) ) {
							$this.attr( 'aria-expanded', '2' );
						} else {
							$this.attr( 'aria-expanded', '3' );
						}
					}

				} );





} );
