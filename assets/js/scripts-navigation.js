/**
 * Accessible navigation
 *
 * @link  http://a11yproject.com/
 * @link  https://codeable.io/community/wordpress-accessibility-creating-accessible-dropdown-menus/
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.4.8
 * @version  2.7.0
 */

( function( $ ) {

	'use strict';





	/**
	 * Variables
	 */

		var
			$aubergeSiteNavigation   = $( document.getElementById( 'site-navigation' ) ),
			$aubergeSiteMenuPrimary  = $( document.getElementById( 'menu-primary' ) ),
			$aubergeMenuToggleButton = $( document.getElementById( 'menu-toggle' ) );



	/**
	 * Adding ARIA attributes
	 */

		$aubergeSiteNavigation
			.find( '.menu-item-has-children' )
				.attr( 'aria-haspopup', 'true' );



	/**
	 * Setting `.focus` class for menu parent
	 */

		$aubergeSiteNavigation
			.on( 'focus.aria mouseenter.aria', '.menu-item-has-children', function ( e ) {

				// Processing

					$( e.currentTarget )
						.addClass( 'focus' );

			} );

		$aubergeSiteNavigation
			.on( 'blur.aria mouseleave.aria', '.menu-item-has-children', function ( e ) {

				// Processing

					$( e.currentTarget )
						.removeClass( 'focus' );

			} );



	/**
	 * Touch-enabled
	 */

		$aubergeSiteNavigation
			.on( 'touchstart', '.menu-item-has-children > a', function( e ) {

				// Variables

					var
						el = $( this ).parent( 'li' );


				// Processing

					/**
					 * First touch does not trigger the link, only opens the submenu.
					 * Second touch does trigger the link.
					 */
					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();

						el
							.toggleClass( 'focus' )
							.siblings( '.focus' )
								.removeClass( 'focus' );
					}

			} );



	/**
	 * Mobile navigation
	 */

		/**
		 * Mobile menu actions
		 */
		function aubergeMobileMenuActions() {

			// Processing

				if ( ! $aubergeSiteNavigation.hasClass( 'active' ) ) {

					$aubergeSiteMenuPrimary
						.attr( 'aria-hidden', 'true' );

					$aubergeMenuToggleButton
						.attr( 'aria-expanded', 'false' );

				}

				$aubergeSiteNavigation
					.on( 'keydown', function( e ) {

						// Processing

							if ( e.which === 27 ) {

								// ESC key

									e.preventDefault();

									$aubergeSiteNavigation
										.removeClass( 'active' );

									$aubergeSiteMenuPrimary
										.attr( 'aria-hidden', 'true' );

									$aubergeMenuToggleButton
										.focus();

							}

					} );

		} // /aubergeMobileMenuActions

		// Default mobile menu setup

			if ( 880 >= window.innerWidth ) {

				$aubergeSiteNavigation
					.removeClass( 'active' );

				aubergeMobileMenuActions();

			}

		// Clicking the menu toggle button

			$aubergeMenuToggleButton
				.on( 'click', function( e ) {

					// Processing

						e.preventDefault();

						$aubergeSiteNavigation
							.toggleClass( 'active' );

						if ( $aubergeSiteNavigation.hasClass( 'active' ) ) {

							$aubergeSiteMenuPrimary
								.attr( 'aria-hidden', 'false' );

							$aubergeMenuToggleButton
								.attr( 'aria-expanded', 'true' );

							$( 'html, body' )
								.stop()
								.animate( { scrollTop : '0px' }, 0 );

						} else {

							$aubergeSiteMenuPrimary
								.attr( 'aria-hidden', 'true' );

							$aubergeMenuToggleButton
								.attr( 'aria-expanded', 'false' );

						}

				} );

		// Refocus to menu toggle button once the end of the menu is reached

			$aubergeSiteNavigation
				.on( 'focus.aria', '.menu-toggle-skip-link', function( e ) {

					// Processing

						$aubergeMenuToggleButton
							.focus();

				} );

		// Disable mobile navigation on wider screens

			$( window )
				.on( 'resize orientationchange', function( e ) {

					// Processing

						if ( 880 < window.innerWidth ) {

							// On desktops

							$aubergeSiteNavigation
								.removeClass( 'active' );

							$aubergeSiteMenuPrimary
								.attr( 'aria-hidden', 'false' );

							$aubergeMenuToggleButton
								.attr( 'aria-expanded', 'true' );

						} else {

							// On mobiles

							aubergeMobileMenuActions();

						}

				} );





} )( jQuery );
