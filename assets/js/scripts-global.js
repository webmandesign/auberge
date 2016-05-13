/**
 * Theme frontend scripts
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 *
 * Contents:
 *
 *  10) Basics
 *  20) Site header
 *  30) Banner
 *  40) Posts
 *  50) Site footer
 * 100) Others
 */





jQuery( function() {





	/**
	 * 10) Basics
	 */

		/**
		 * Tell CSS that JS is enabled...
		 */

			jQuery( '.no-js' )
				.removeClass( 'no-js' );



		/**
		 * Fixing Recent Comments widget multiple appearances
		 */

			jQuery( '.widget_recent_comments ul' )
				.attr( 'id', '' );



		/**
		 * Back to top buttons
		 */

			if ( 1280 < window.innerWidth ) {

				jQuery( '.back-to-top' )
					.on( 'click', function( e ) {

						// Processing

							e.preventDefault();

							jQuery( 'html, body' )
								.animate( {
									scrollTop: 0
								}, 600 );

					} );

			}



		/**
		 * Clear floats after columns
		 */

			jQuery( '.column.last' )
				.after( '<div class="clear" />' );





	/**
	 * 20) Site header
	 */

		/**
		 * Sticky header
		 */

			jQuery( window )
				.on( 'scroll', function() {

					// Helper variables

						var $documentScrollTop = jQuery( document ).scrollTop(),
						    $headerHeight      = jQuery( '#masthead' ).outerHeight();


					// Processing

						if ( $documentScrollTop >= ( 3 * $headerHeight ) ) {

							jQuery( 'body' )
								.removeClass( 'hide-sticky-header' )
								.addClass( 'sticky-header' );

						} else if ( $documentScrollTop < ( 3 * $headerHeight ) && $documentScrollTop > ( 1 * $headerHeight ) ) {

							jQuery( 'body.sticky-header' )
								.removeClass( 'sticky-header' )
								.addClass( 'hide-sticky-header' );

						} else {

							jQuery( 'body' )
								.removeClass( 'sticky-header hide-sticky-header' );

						}

				} );



		/**
		 * Header search form
		 */

			jQuery( '#search-toggle' )
				.on( 'click', function( e ) {

					// Processing

						e.preventDefault();

						jQuery( this )
							.parent()
								.toggleClass( 'active' )
								.find( '.search-field' )
									.focus();

				} );





	/**
	 * 30) Banner
	 */

		/**
		 * Banner slider
		 */

			if ( jQuery().slick ) {

				jQuery( '#site-banner.enable-slider .site-banner-inner' )
					.on( 'init', function( event, slick ) {

						// Processing

							jQuery( '.slider-nav-next' )
								.before( jQuery( '.slider-nav-prev' ) );

					} )
					.slick( {
						'adaptiveHeight' : true,
						'autoplay'       : true,
						'autoplaySpeed'  : ( ! jQuery( '#site-banner' ).data( 'speed' ) ) ? ( 5400 ) : ( jQuery( '#site-banner' ).data( 'speed' ) ),
						'cssEase'        : 'ease-in-out',
						'dots'           : true,
						'draggable'      : false,
						'easing'         : 'easeInOutBack',
						'fade'           : true,
						'pauseOnHover'   : true,
						'slide'          : 'article',
						'speed'          : 600,
						'swipeToSlide'   : true,
						'prevArrow'      : '<div class="slider-nav slider-nav-prev"><button type="button" class="slick-prev"><span class="genericon genericon-previous"></span></button></div>',
						'nextArrow'      : '<div class="slider-nav slider-nav-next"><button type="button" class="slick-next"><span class="genericon genericon-next"></span></button></div>'
					} );

			} // /slick





	/**
	 * 40) Posts
	 */

		/**
		 * Masonry layout
		 */

			if ( jQuery().masonry ) {



				/**
				 * Posts list
				 */

					var $postsContainers = jQuery( '.posts' );

					$postsContainers
						.imagesLoaded( function() {

							// Processing

								$postsContainers.masonry( {
										itemSelector : '.hentry'
									} );

						} );



				/**
				 * [gallery] shortcode Masonry layout
				 */

					var $galleryContainers = jQuery( '.gallery' );

					$galleryContainers
						.imagesLoaded( function() {

							// Processing

								$galleryContainers.masonry( {
										itemSelector : '.gallery-item'
									} );

						} );



			} // /masonry





	/**
	 * 50) Site footer
	 */

		/**
		 * Masonry footer widgets
		 */

			if (
					jQuery().masonry
					&& 3 < jQuery( '#footer-widgets .widget' ).length
				) {



				var $footerWidgets = jQuery( '#footer-widgets-container' );

				$footerWidgets
					.imagesLoaded( function() {

						// Processing

							$footerWidgets.masonry( {
									itemSelector : '.widget'
								} );

					} );



			} // /masonry





	/**
	 * 100) Others
	 */

		/**
		 * On-page anchor smooth scrolling
		 */

			jQuery( 'body' )
				.on( 'click', 'a[href^="#"]', function( e ) {

					// Requirements check

						// Do nothing when editing page with Beaver Builder

							if ( jQuery( 'html' ).hasClass( 'fl-builder-edit' ) ) {
								e.preventDefault();
								return;
							}


					// Helper variables

						var $this         = jQuery( this ),
						    $anchor       = $this.not( '.add-comment-link, .toggle-mobile-sidebar, .search-toggle, .back-to-top, .skip-link' ).attr( 'href' ),
						    $scrollObject = jQuery( 'html, body' ),
						    $scrollSpeed  = ( 1280 >= window.innerWidth ) ? ( 0 ) : ( 600 );


					// Processing

						if (
								$anchor
								&& '#' !== $anchor
								&& ! $this.parent().parent().hasClass( 'wm-tab-links' )
								&& ! $this.parent().parent().hasClass( 'tabs' )
								&& ! $this.hasClass( 'no-smooth-scroll' )
							) {

							e.preventDefault();

							var $scrollOffset = jQuery( '#masthead' ).outerHeight() + jQuery( '#menu-group-nav' ).outerHeight();

							$scrollObject
								.stop()
								.animate( {
									scrollTop : jQuery( $anchor ).offset().top - $scrollOffset + 'px'
								}, $scrollSpeed );

						}

				} );



		/**
		 * Sidebar mobile toggle
		 */

			// Disable sidebar toggle on wider screens

				jQuery( window )
					.on( 'resize orientationchange', function( e ) {

						// Processing

							if ( 880 < window.innerWidth ) {

								jQuery( '#toggle-mobile-sidebar' )
									.attr( 'aria-expanded', 'true' )
									.siblings( '.widget' )
										.show();

							}

					} );

			// Clicking the toggle sidebar widgets button

				jQuery( '#toggle-mobile-sidebar' )
					.on( 'click', function( e ) {

						// Processing

							e.preventDefault();

							var $this                 = jQuery( this ),
							    mobileSidebarExpanded = $this.attr( 'aria-expanded' );

							if ( 'false' == mobileSidebarExpanded ) {
								mobileSidebarExpanded = 'true';
							} else {
								mobileSidebarExpanded = 'false';
							}

							$this
								.attr( 'aria-expanded', mobileSidebarExpanded )
								.siblings( '.widget' )
									.slideToggle();

					} );



		/**
		 * Food menu groups navigation
		 */

		 	var $aubergeFoodMenuGroupHeaders = jQuery( '.items-list .menu-group-header' ).length;

			if ( 1 < $aubergeFoodMenuGroupHeaders ) {

				var $menuGroups = [];

				// Set class on items list

					jQuery( '.items-list' )
						.addClass( 'menu-group-count-' + $aubergeFoodMenuGroupHeaders );

				// Set menu groups IDS

					jQuery( '.menu-group-header' )
						.each( function( index, val ) {

							// Helper variables

								var $this      = jQuery( this ),
								    $thisTitle = $this.find( '> .menu-group-title' ).text(),
								    $thisID    = $this.attr( 'id' );


							// Processing

								$menuGroups[ $thisID ] = $thisTitle;

								$this
									.append( '<a href="#menu-group-nav" class="menu-group-nav-link">' + $scriptsInline.text_menu_group_nav + '</a>' )
									.parent()
										.addClass( $thisID );

						} );

				// Create a navigation

					jQuery( '<div class="menu-group-nav-container"><ul id="menu-group-nav" class="menu-group-nav"></ul></div>' )
						.prependTo( '.items-list' );

					for ( var $menuGroupID in $menuGroups ) {
					// @link  http://stackoverflow.com/questions/921789/how-to-loop-through-javascript-object-literal-with-objects-as-members

						if ( $menuGroups.hasOwnProperty( $menuGroupID ) ) {

							jQuery( '<li class="goto-' + $menuGroupID.replace( /(\r\n|\n|\r)/gm, '' ) + '"><a href="#' + $menuGroupID.replace( /(\r\n|\n|\r)/gm, '' ) + '">' + $menuGroups[ $menuGroupID ].replace( /(\r\n|\n|\r)/gm, '' ) + '</a></li>' )
								.appendTo( '#menu-group-nav' );

						}

					}

				// Make navigation sticky once scrolled to it

					jQuery( '#page' )
						.imagesLoaded( function() {

							// Helper variables

								var $menuGroupNav    = jQuery( '#menu-group-nav' ),
								    $menuGroupNavTop = $menuGroupNav.offset().top;


							// Processing

								$menuGroupNav
									.parent()
									.css( { 'height' : $menuGroupNav.outerHeight() } );

								jQuery( window )
									.scroll( function() {

										// Processing

											if ( jQuery( document ).scrollTop() > ( $menuGroupNavTop - jQuery( '#masthead' ).outerHeight() ) ) {

												jQuery( 'body' )
													.addClass( 'sticky-menu-group-nav' );

											} else {

												jQuery( 'body' )
													.removeClass( 'sticky-menu-group-nav' );

											}

									} );

						} );

			}



		/**
		 * Restaurant Reservations plugin support
		 *
		 * @link  https://wordpress.org/plugins/restaurant-reservations/
		 */

			var $aubergeRtbContact = jQuery( '.rtb-booking-form .contact' ).hide();

			jQuery( '#rtb-time' )
				.on( 'change', function() {

					// Helper variables

						var $this = jQuery( this );


					// Processing

						if ( $this.attr( 'value' ) ) {

							$aubergeRtbContact
								.slideDown();

						} else {

							$aubergeRtbContact
								.slideUp();

						}

				} );



		/**
		 * Jetpack Infinite Scroll posts loading
		 *
		 * @link  http://wptheming.com/2013/04/jetpack-infinite-scroll-masonry/
		 */

			jQuery( document.body )
				.on( 'post-load', function() {

					// Processing

						/**
						 * Masonry posts and footer widgets
						 */

							if ( jQuery().masonry ) {

								var $postsContainers = jQuery( '.posts' );

								$postsContainers
									.imagesLoaded( function() {

										$postsContainers
											.masonry( 'reload' );

										setTimeout( function() {

											jQuery( '#footer-widgets-container' )
												.masonry( 'reload' );

										}, 600 );

									} );

							} // /masonry

				} );





} );
