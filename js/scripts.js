/**
 * Theme frontend scripts
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.0
 * @version  1.1
 *
 * CONTENT:
 * -  10) Basics
 * -  20) Site header
 * -  30) Banner
 * -  40) Posts
 * -  50) Site footer
 * - 100) Others
 */





jQuery( function() {



	/**
	 * 10) Basics
	 */

		/**
		 * Tell CSS that JS is enabled...
		 */

			jQuery( '.no-js' ).removeClass( 'no-js' );



		/**
		 * Clear floats after columns
		 */

			jQuery( '.column.last' ).after( '<div class="clear" />' );



		/**
		 * Back to top buttons
		 */

			if ( 960 < document.body.clientWidth ) {
				jQuery( '.back-to-top' ).on( 'click', function( e ) {
						e.preventDefault();

						jQuery( 'html, body' ).animate( { scrollTop: 0 }, 400 );
					} );
			}



		/**
		 * YouTube embed fix (prevent video being on top of elements)
		 */

			jQuery( 'iframe[src*="youtube.com"]' ).each( function( item ) {

				var srcAtt = jQuery( this ).attr( 'src' );

				if ( -1 == srcAtt.indexOf( '?' ) ) {
					srcAtt += '?wmode=transparent';
				} else {
					srcAtt += '&amp;wmode=transparent';
				}

				jQuery( this ).attr( 'src', srcAtt );

			} );



	/**
	 * 20) Site header
	 */

		/**
		 * Sticky header
		 */

			jQuery( window ).scroll( function() {
				var $documentScrollTop = jQuery( document ).scrollTop(),
				    $headerHeight      = jQuery( '#masthead' ).outerHeight();

				if ( $documentScrollTop >= ( 2.62 * $headerHeight ) ) {

					jQuery( 'body' )
						.removeClass( 'hide-sticky-header' )
						.addClass( 'sticky-header' );

				} else if ( $documentScrollTop < ( 2.62 * $headerHeight ) && $documentScrollTop > ( 1 * $headerHeight ) ) {

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

			jQuery( '#search-toggle' ).on( 'click', function( e ) {
				e.preventDefault();

				jQuery( this )
					.parent()
						.toggleClass( 'active' )
						.find( '.search-field' )
							.focus();
			} );



		/**
		 * Mobile navigation
		 */

			jQuery( '#menu-toggle' ).on( 'click', function( e ) {
				e.preventDefault();

				jQuery( this )
					.parent( '#site-navigation' )
						.toggleClass( 'active' )
						.find( '.main-navigation-inner' )
							.slideToggle();
			} );


			//Disable mobile navigation on wider screens
				jQuery( window ).on( 'resize orientationchange', function( e ) {
					if ( 960 < document.body.clientWidth ) {
						jQuery( '#site-navigation .main-navigation-inner' ).show();
					}
				} );



	/**
	 * 30) Banner
	 */

		/**
		 * Banner slider
		 */

			if ( jQuery().slick ) {

				jQuery( '#site-banner.enable-slider .site-banner-inner' ).slick( {
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

					$postsContainers.imagesLoaded( function() {

						$postsContainers.masonry( {
								itemSelector : '.hentry'
							} );

					} );



				/**
				 * [gallery] shortcode Masonry layout
				 */

					var $galleryContainers = jQuery( '.gallery' );

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
					jQuery().masonry
					&& 1 < jQuery( '#footer-widgets' ).data( 'columns' ) //Doesn't make sense for 1 column layout
				) {

				var $footerWidgets = jQuery( '#footer-widgets-container' );

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

			jQuery( 'body' ).on( 'click', 'a[href^="#"]', function( e ) {
				var $this         = jQuery( this ),
				    $anchor       = $this.not( '.add-comment-link, .toggle-mobile-sidebar, .search-toggle, .back-to-top, .skip-link' ).attr( 'href' ),
				    $scrollObject = jQuery( 'html, body' ),
				    $scrollSpeed  = ( 960 >= document.body.clientWidth ) ? ( 0 ) : ( 600 );

				if (
						$anchor
						&& '#' !== $anchor
						&& ! $this.hasClass( 'no-smooth-scroll' )
					) {
					e.preventDefault();

					$scrollObject.stop().animate( {
							scrollTop : jQuery( $anchor ).offset().top - jQuery( '#masthead' ).outerHeight() + 'px'
						}, $scrollSpeed );
				}
			} );



		/**
		 * Sidebar mobile toggle
		 */

			//Disable sidebar toggle on wider screens
				jQuery( window ).on( 'resize orientationchange', function( e ) {
					if ( 960 < document.body.clientWidth ) {
						jQuery( '#toggle-mobile-sidebar' )
							.siblings( '.widget' )
								.show();
					}
				} );

			//Clicking the toggle sidebar widgets button
				jQuery( '#toggle-mobile-sidebar' ).on( 'click', function( e ) {
					e.preventDefault();

					jQuery( this )
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

			if ( jQuery( '.items-list .menu-group-header' ).length ) {

				var $menuGroups = [];

				//Set menu groups IDS
					jQuery( '.menu-group-header' ).each( function( index, val ) {
						var $this      = jQuery( this ),
						    $thisTitle = $this.find( '> .menu-group-title' ).text(),
						    $thisID    = $thisTitle.replace( ' ', '_' ).toLowerCase().replace( /(\r\n|\n|\r)/gm, '' );

						$menuGroups[ $thisID ] = $thisTitle;

						$this.attr( 'id', $thisID ).append( '<a href="#menu-group-nav" class="menu-group-nav-link">' + $scriptsInline.text_menu_group_nav + '</a>' );
					} );

				//Create a navigation
					jQuery( '<ul id="menu-group-nav" class="menu-group-nav" />' ).prependTo( '.items-list' );

					for ( var $menuGroupID in $menuGroups ) {
					//@link  http://stackoverflow.com/questions/921789/how-to-loop-through-javascript-object-literal-with-objects-as-members
						if ( $menuGroups.hasOwnProperty( $menuGroupID ) ) {
							jQuery( '<li><a href="#' + $menuGroupID.replace( /(\r\n|\n|\r)/gm, '' ) + '">' + $menuGroups[ $menuGroupID ].replace( /(\r\n|\n|\r)/gm, '' ) + '</a></li>' ).appendTo( '#menu-group-nav' );
						}
					}

			}



		/**
		 * Jetpack Infinite Scroll posts loading
		 */

			jQuery( document.body ).on( 'post-load', function() {

				/**
				 * Masonry posts list
				 */

					if ( jQuery().masonry ) {

						var $postsContainers = jQuery( '.posts' );

						$postsContainers.imagesLoaded( function() {

							$postsContainers.masonry( 'reload' );

						} );

					} // /masonry

			} );



} );