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
 * @version  2.2.0
 *
 * Contents:
 *
 * 10) Accessibility
 * 20) Mobile navigation
 */





( function( $ ) {





	/**
	 * Cache
	 */

		var $aubergeSiteNavigation   = $( document.getElementById( 'site-navigation' ) ),
		    $aubergeSiteMenuPrimary  = $( document.getElementById( 'menu-primary' ) ),
		    $aubergeMenuToggleButton = $( document.getElementById( 'menu-toggle' ) );





	/**
	 * 10) Accessibility
	 */

		/**
		 * Adding ARIA attributes
		 */

			$aubergeSiteNavigation
				.find( 'li' )
					.attr( 'role', 'menuitem' );

			$aubergeSiteNavigation
				.find( '.menu-item-has-children' )
					.attr( 'aria-haspopup', 'true' );

			$aubergeSiteNavigation
				.find( '.sub-menu' )
					.attr( 'role', 'menu' );



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
				.on( 'touchstart click', '.menu-item-has-children > a .expander', function( e ) {

					// Helper variables

						var $this = $( this ).parent().parent(); // Get the LI element


					// Processing

						e.preventDefault();

						$this
							.toggleClass( 'focus' )
							.siblings()
								.removeClass( 'focus' );

				} );



		/**
		 * Menu navigation with arrow keys
		 */

			$aubergeSiteNavigation
				.on( 'keydown', 'a', function( e ) {

					// Helper variables

						var $this = $( this );


					// Processing

						if ( e.which === 37 ) {

							// Left key

								e.preventDefault();

								$this
									.parent()
									.prev()
										.children( 'a' )
											.focus();

						} else if ( e.which === 39 ) {

							// Right key

								e.preventDefault();

								$this
									.parent()
									.next()
										.children( 'a' )
											.focus();

						} else if ( e.which === 40 ) {

							// Down key

								e.preventDefault();

								if ( $this.next().length ) {

									$this
										.next()
											.find( 'li:first-child a' )
											.first()
												.focus();

								} else {

									$this
										.parent()
										.next()
											.children( 'a' )
												.focus();

								}

						} else if ( e.which === 38 ) {

							// Up key

								e.preventDefault();

								if ( $this.parent().prev().length ) {

									$this
										.parent()
										.prev()
											.children( 'a' )
												.focus();

								} else {

									$this
										.parents( 'ul' )
										.first()
										.prev( 'a' )
											.focus();

								}

						}

				} );





	/**
	 * 20) Mobile navigation
	 */

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
