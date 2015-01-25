/**
 * Theme frontend scripts
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.2
 *
 * CONTENT:
 * -  10) Basics
 * -  20) Site header
 * -  30) Banner
 * -  40) Posts
 * -  50) Site footer
 * - 100) Others
 */





( function( $ ) {



	"use strict";



	/**
	 * 10) Basics
	 */

		/**
		 * Tell CSS that JS is enabled...
		 */

			$( '.no-js' ).removeClass( 'no-js' );



		/**
		 * Clear floats after columns
		 */

			$( '.column.last' ).after( '<div class="clear" />' );



		/**
		 * Back to top buttons
		 */

			if ( 960 < document.body.clientWidth ) {
				$( '.back-to-top' ).on( 'click', function( e ) {
						e.preventDefault();

						$( 'html, body' ).animate( { scrollTop: 0 }, 400 );
					} );
			}



	/**
	 * 20) Site header
	 */

		/**
		 * Sticky header
		 */

			$( window ).scroll( function() {
				var $documentScrollTop = $( document ).scrollTop(),
				    $headerHeight      = $( '#masthead' ).outerHeight();

				if ( $documentScrollTop >= ( 2.62 * $headerHeight ) ) {

					$( 'body' )
						.removeClass( 'hide-sticky-header' )
						.addClass( 'sticky-header' );

				} else if ( $documentScrollTop < ( 2.62 * $headerHeight ) && $documentScrollTop > ( 1 * $headerHeight ) ) {

					$( 'body.sticky-header' )
						.removeClass( 'sticky-header' )
						.addClass( 'hide-sticky-header' );

				} else {

					$( 'body' )
						.removeClass( 'sticky-header hide-sticky-header' );

				}
			} );


		/**
		 * Header search form
		 */

			$( '#search-toggle' ).on( 'click', function( e ) {
				e.preventDefault();

				$( this )
					.parent()
						.toggleClass( 'active' )
						.find( '.search-field' )
							.focus();
			} );



		/**
		 * Mobile navigation
		 */

			$( '#site-navigation .main-navigation-inner ul' ).attr( 'aria-expanded', 'false' );

			$( '#menu-toggle' ).on( 'click', function( e ) {
				e.preventDefault();

				$( this )
					.parent( '#site-navigation' )
						.toggleClass( 'active' )
						.find( '.main-navigation-inner' )
							.slideToggle();

				if ( $( this ).parent( '#site-navigation' ).hasClass( 'active' ) ) {
					$( this )
						.attr( 'aria-expanded', 'true' )
						.parent( '#site-navigation' )
							.find( '.main-navigation-inner ul' )
								.attr( 'aria-expanded', 'true' );
				} else {
					$( this )
						.attr( 'aria-expanded', 'false' )
						.parent( '#site-navigation' )
							.find( '.main-navigation-inner ul' )
								.attr( 'aria-expanded', 'false' );
				}
			} );


			//Disable mobile navigation on wider screens
				$( window ).on( 'resize orientationchange', function( e ) {
					if ( 960 < document.body.clientWidth ) {
						$( '#site-navigation .main-navigation-inner' ).show();
					}
				} );



	/**
	 * 30) Banner
	 */

		/**
		 * Banner slider
		 */

			if ( $().slick ) {

				$( '#site-banner.enable-slider .site-banner-inner' ).slick( {
						'adaptiveHeight' : true,
						'autoplay'       : true,
						'autoplaySpeed'  : ( ! $( '#site-banner' ).data( 'speed' ) ) ? ( 5400 ) : ( $( '#site-banner' ).data( 'speed' ) ),
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

			if ( $().masonry ) {

				/**
				 * Posts list
				 */

					var $postsContainers = $( '.posts' );

					$postsContainers.imagesLoaded( function() {

						$postsContainers.masonry( {
								itemSelector : '.hentry'
							} );

					} );



				/**
				 * [gallery] shortcode Masonry layout
				 */

					var $galleryContainers = $( '.gallery' );

					$galleryContainers.imagesLoaded( function() {

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
					$().masonry
					&& 1 < $( '#footer-widgets' ).data( 'columns' ) //Doesn't make sense for 1 column layout
				) {

				var $footerWidgets = $( '#footer-widgets-container' );

				$footerWidgets.imagesLoaded( function() {

					$footerWidgets.masonry( {
							itemSelector : '.widget'
						} );

				} );

			} // /masonry



	/**
	 * 100) Others
	 */

		/**
		 * Smooth scrolling
		 */

			$( 'body' ).on( 'click', 'a[href^="#"]', function( e ) {
				var $this         = $( this ),
				    $anchor       = $this.not( '.add-comment-link, .toggle-mobile-sidebar, .search-toggle, .back-to-top, .skip-link' ).attr( 'href' ),
				    $scrollObject = $( 'html, body' ),
				    $scrollSpeed  = ( 960 >= document.body.clientWidth ) ? ( 0 ) : ( 600 );

				if (
						$anchor
						&& '#' !== $anchor
						&& ! $this.hasClass( 'no-smooth-scroll' )
					) {
					e.preventDefault();

					$scrollObject.stop().animate( {
							scrollTop : $( $anchor ).offset().top - $( '#masthead' ).outerHeight() + 'px'
						}, $scrollSpeed );
				}
			} );



		/**
		 * Sidebar mobile toggle
		 */

			//Disable sidebar toggle on wider screens
				$( window ).on( 'resize orientationchange', function( e ) {
					if ( 960 < document.body.clientWidth ) {
						$( '#toggle-mobile-sidebar' )
							.siblings( '.widget' )
								.show();
					}
				} );

			//Clicking the toggle sidebar widgets button
				$( '#toggle-mobile-sidebar' ).on( 'click', function( e ) {
					e.preventDefault();

					$( this )
						.siblings( '.widget' )
							.slideToggle();
				} );



		/**
		 * Food menu groups navigation
		 *
		 * Pure JS solution. Waiting for Jetpack to improve HTML output control.
		 * @todo  Create with PHP after Jetpack improves modifications. Possibly
		 *        use Jetpack's get_option( 'nova_menu_order' ).
		 */

			if ( $( '.items-list .menu-group-header' ).length ) {

				var $menuGroups = [];

				//Set menu groups IDS
					$( '.menu-group-header' ).each( function( index, val ) {
						var $this      = $( this ),
						    $thisTitle = $this.find( '> .menu-group-title' ).text(),
						    $thisID    = $thisTitle.replace( ' ', '_' ).toLowerCase().replace( /(\r\n|\n|\r)/gm, '' );

						$menuGroups[ $thisID ] = $thisTitle;

						$this.attr( 'id', $thisID ).append( '<a href="#menu-group-nav" class="menu-group-nav-link">' + $scriptsInline.text_menu_group_nav + '</a>' );
					} );

				//Create a navigation
					$( '<ul id="menu-group-nav" class="menu-group-nav" />' ).prependTo( '.items-list' );

					for ( var $menuGroupID in $menuGroups ) {
					//@link  http://stackoverflow.com/questions/921789/how-to-loop-through-javascript-object-literal-with-objects-as-members
						if ( $menuGroups.hasOwnProperty( $menuGroupID ) ) {
							$( '<li><a href="#' + $menuGroupID.replace( /(\r\n|\n|\r)/gm, '' ) + '">' + $menuGroups[ $menuGroupID ].replace( /(\r\n|\n|\r)/gm, '' ) + '</a></li>' ).appendTo( '#menu-group-nav' );
						}
					}

			}



		/**
		 * Jetpack Infinite Scroll posts loading
		 */

			$( document.body ).on( 'post-load', function() {

				/**
				 * Masonry posts list
				 */

					if ( $().masonry ) {

						var $postsContainers = $( '.posts' );

						$postsContainers.imagesLoaded( function() {

							$postsContainers.masonry( 'reload' );

						} );

					} // /masonry

			} );



} )( jQuery );