<?php
/**
 * Plugin integration
 *
 * Jetpack
 *
 * @link  https://wordpress.org/plugins/jetpack/
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.1
 * @version  2.2.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'Jetpack' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	/**
	 * Enables Jetpack features
	 *
	 * @since    1.0
	 * @version  2.2.0
	 */
	if ( ! function_exists( 'wm_jetpack' ) ) {
		function wm_jetpack() {

			// Processing

				// Site logo

					add_theme_support( 'site-logo' );

				// Responsive videos

					add_theme_support( 'jetpack-responsive-videos' );

				// Infinite scroll

					add_theme_support( 'infinite-scroll', apply_filters( 'wmhook_wm_jetpack_infinite_scroll', array(
							'container'      => 'posts',
							'footer'         => false,
							'posts_per_page' => 6,
							'render'         => 'wm_jetpack_is_render',
							'type'           => 'scroll',
							'wrapper'        => false,
						) ) );

				// Featured content

					add_theme_support( 'featured-content', apply_filters( 'wmhook_wm_jetpack_featured_content', array(
							'featured_content_filter' => 'wm_get_banner_posts',
							'max_posts'               => 6,
							'post_types'              => array( 'post' ),
						) ) );

				// Food menu support

					if ( ! get_theme_mod( 'disable-food-menu', false ) ) {

						add_theme_support( 'nova_menu_item' );

						add_post_type_support( 'nova_menu_item', array( 'comments' ) );

						// Food Menu output

							if ( class_exists( 'WM_Nova_Restaurant' ) ) {

								// Remove original Food Menu class as we replace it with enhanced one

									remove_action( 'init', array( 'Nova_Restaurant', 'init' ) );

								WM_Nova_Restaurant::init( array(
										'menu_title_tag' => 'h2',
									) );

							}

					}

		}
	} // /wm_jetpack

	add_action( 'after_setup_theme', 'wm_jetpack', 30 );



	/**
	 * Accessibility fixes
	 */

		/**
		 * Level up heading tags
		 *
		 * Levels up the HTML headings in single post/page view.
		 * Transforms H3 to H2 and H4 to H3.
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  string $html
		 */
		if ( ! function_exists( 'wm_headings_level_up' ) ) {
			function wm_headings_level_up( $html ) {

				// Helper variables

					$post_id = get_the_ID();


				// Requirements check

					if (
							! is_page( $post_id )
							&& ! is_single( $post_id )
						) {
						return $html;
					}


				// Processing

					switch ( $html ) {

						case 'h3':
								$html = tag_escape( 'h2' );
							break;

						case 'h4':
								$html = tag_escape( 'h3' );
							break;

						default:
								$html = str_replace(
										array(
											'<h3', '</h3', // 1) H3...
											'<h4', '</h4', // 2) H4...
										),
										array(
											'<h2', '</h2', // 1) ...to H2
											'<h3', '</h3', // 2) ...to H3
										),
										$html
									);
							break;

					} // /switch


				// Output

					return $html;

			}
		} // /wm_headings_level_up

		add_filter( 'jetpack_sharing_display_markup',           'wm_headings_level_up', 999 );
		add_filter( 'jetpack_relatedposts_filter_headline',     'wm_headings_level_up', 999 );
		add_filter( 'jetpack_relatedposts_filter_post_heading', 'wm_headings_level_up', 999 );



	/**
	 * Jetpack sharing buttons
	 */

		/**
		 * Jetpack sharing display
		 *
		 * @since    1.0
		 * @version  1.0
		 *
		 * @param  bool $show
		 * @param  obj  $post
		 */
		if ( ! function_exists( 'wm_jetpack_sharing' ) ) {
			function wm_jetpack_sharing( $show, $post ) {

				// Helper variables

					$post_id = get_the_ID();


				// Processing

					if (
							in_array( 'the_excerpt', (array) $GLOBALS['wp_current_filter'] )
							|| ! ( is_page( $post_id ) || is_single( $post_id ) )
						) {

						$show = false;

					}


				// Output

					return $show;

			}
		} // /wm_jetpack_sharing

		add_filter( 'sharing_show', 'wm_jetpack_sharing', 10, 2 );



	/**
	 * Jetpack infinite scroll
	 */

		/**
		 * Jetpack infinite scroll JS settings array modifier
		 *
		 * @since    1.0
		 * @version  1.0
		 *
		 * @param  array $settings
		 */
		if ( ! function_exists( 'wm_jetpack_is_js_settings' ) ) {
			function wm_jetpack_is_js_settings( $settings ) {

				// Helper variables

					$settings['text'] = esc_js( esc_html__( 'Load more&hellip;', 'auberge' ) );


				// Output

					return $settings;

			}
		} // /wm_jetpack_is_js_settings

		add_filter( 'infinite_scroll_js_settings', 'wm_jetpack_is_js_settings', 10 );



		/**
		 * Jetpack infinite scroll posts renderer
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_jetpack_is_render' ) ) {
			function wm_jetpack_is_render() {

				// Output

					while ( have_posts() ) :

						the_post();

						$content_type = get_post_format();

						if ( 'nova_menu_item' === get_post_type() ) {
							$content_type = 'food-menu';
						}

						get_template_part( 'template-parts/content', $content_type );

					endwhile;

			}
		} // /wm_jetpack_is_render



	/**
	 * Jetpack Food Menus CPT
	 */
	if ( ! get_theme_mod( 'disable-food-menu', false ) ) {

		/**
		 * Food Menu class modifications
		 */
		require_once( trailingslashit( dirname( __FILE__ ) ) . 'class-nova-restaurant.php' );



		/**
		 * Jetpack modify food menus Add Many Items post
		 *
		 * Making sure the data are stored as post excerpt, not as post content.
		 *
		 * @since    1.0
		 * @version  1.0
		 *
		 * @param  array $data
		 * @param  array $postarr
		 */
		if ( ! function_exists( 'wm_jetpack_add_many_food_menus' ) ) {
			function wm_jetpack_add_many_food_menus( $data, $postarr ) {

				// Helper variables

					global $current_screen;


				// Requirements check

					if (
							'nova_menu_item' !== $data['post_type']
							|| ! isset( $current_screen->id )
							|| 'nova_menu_item_page_add_many_nova_items' !== $current_screen->id
						) {
						return $data;
					}

					if ( ! empty( $_POST['ajax'] ) ) {
						check_ajax_referer( 'nova_many_items' );
					} else {
						check_admin_referer( 'nova_many_items' );
					}


				// Processing

					if ( $postarr['post_content'] && empty( $postarr['post_excerpt'] ) ) {
						$data['post_excerpt'] = $data['post_content'];
						$data['post_content'] = '';
					}


				// Output

					return $data;

			}
		} // /wm_jetpack_add_many_food_menus

		add_filter( 'wp_insert_post_data', 'wm_jetpack_add_many_food_menus', 10, 2 );



		/**
		 * Jetpack food menus Add Many Items styles
		 *
		 * @since    1.0
		 * @version  1.3
		 */
		if ( ! function_exists( 'wm_jetpack_styles_admin' ) ) {
			function wm_jetpack_styles_admin() {

				// Helper variables

					global $current_screen;

					$styles  = '.many-items-table input[name="nova_title[]"], .many-items-table textarea { width: 360px; max-width: 100%; }';
					$styles .= '.many-items-table textarea { height: 50px; }';


				// Processing

					if (
							isset( $current_screen->id )
							&& 'nova_menu_item_page_add_many_nova_items' === $current_screen->id
						) {

							wp_add_inline_style(
									'nova-font',
									apply_filters( 'wmhook_esc_css', $styles )
								);

					}

			}
		} // /wm_jetpack_styles_admin

		add_action( 'admin_enqueue_scripts', 'wm_jetpack_styles_admin', 100 );



		/**
		 * Jetpack food menus taxonomy body class
		 *
		 * @since    2.0
		 * @version  2.0.1
		 *
		 * @param  array $classes
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_body_class' ) ) {
			function wm_jetpack_food_menu_body_class( $classes = array() ) {

				// Requirements check

					if ( ! class_exists( 'WM_Nova_Restaurant' ) ) {
						return $classes;
					}


				// Helper variables

					$classes = (array) $classes;

					$taxonomy = WM_Nova_Restaurant::MENU_TAX;


				// Processing

					if ( is_tax( $taxonomy ) ) {

						$term     = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
						$children = get_term_children( (int) $term->term_id, $taxonomy );

						if ( empty( $children ) ) {
							$classes[] = 'no-tax-children';
						} else {
							$classes[] = 'has-tax-children';
						}

					}


				// Output

					return $classes;

			}
		} // /wm_jetpack_food_menu_body_class

		add_action( 'body_class', 'wm_jetpack_food_menu_body_class' );



		/**
		 * Jetpack food menus loop content type
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  string $content_type
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_loop_content_type' ) ) {
			function wm_jetpack_food_menu_loop_content_type( $content_type = '' ) {

				// Processing

					if ( 'nova_menu_item' === get_post_type() ) {
						$content_type = 'food-menu';
					}


				// Output

					return $content_type;

			}
		} // /wm_jetpack_food_menu_loop_content_type

		add_action( 'wmhook_loop_content_type', 'wm_jetpack_food_menu_loop_content_type' );



		/**
		 * Query args: Food menu section archive
		 *
		 * @since    2.0
		 * @version  2.1.1
		 *
		 * @param  obj $query
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_section_query' ) ) {
			function wm_jetpack_food_menu_section_query( $query ) {

				// Requirements check

					if ( ! is_tax( 'nova_menu' ) ) {
						return;
					}


				// Processing

					if ( $query->is_main_query() ) {
						$query->set( 'nopaging', true );
						$query->set( 'orderby', 'menu_order' );
						$query->set( 'order', 'ASC' );
					}

			}
		} // /wm_jetpack_food_menu_section_query

		add_filter( 'pre_get_posts', 'wm_jetpack_food_menu_section_query' );



		/**
		 * Query args: Food menu page template
		 *
		 * @since    2.0
		 * @version  2.0
		 *
		 * @param  array $query
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_query' ) ) {
			function wm_jetpack_food_menu_query( $query ) {

				// Requirements check

					if ( ! is_page_template( 'page-template/_menu.php' ) ) {
						return $query;
					}


				// Helper variables

					$food_menu_section = get_post_meta( get_the_ID(), 'food_menu_section', true );


				// Processing

					if ( $food_menu_section ) {

						$query['tax_query'] = array(
								array(
									'taxonomy' => 'nova_menu',
									'field'    => ( is_numeric( $food_menu_section ) ) ? ( 'term_id' ) : ( 'slug' ),
									'terms'    => esc_html( $food_menu_section ),
								),
							);

					}


				// Output

					return $query;

			}
		} // /wm_jetpack_food_menu_query

		add_filter( 'wmhook_loop_food_menu_query', 'wm_jetpack_food_menu_query' );



		/**
		 * Display only parent food menu sections: Food Menu page template
		 *
		 * @since    2.0
		 * @version  2.0.1
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_loop_section_display_menu_page' ) ) {
			function wm_jetpack_food_menu_loop_section_display_menu_page() {

				// Requirements check

					if ( ! is_page_template( 'page-template/_menu.php' ) ) {
						return;
					}


				// Processing

					if ( ! get_post_meta( get_the_ID(), 'food_menu_section', true ) ) {
						add_filter( 'jetpack_food_section_parent_only', '__return_true' );
					}

			}
		} // /wm_jetpack_food_menu_loop_section_display_menu_page

		add_action( 'wmhook_loop_food_menu_postslist_before', 'wm_jetpack_food_menu_loop_section_display_menu_page' );



		/**
		 * Display only parent food menu sections: Front page
		 *
		 * @since    2.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_jetpack_food_menu_loop_section_display_front_page' ) ) {
			function wm_jetpack_food_menu_loop_section_display_front_page() {

				// Processing

					if ( is_front_page() ) {
						add_filter( 'jetpack_food_section_parent_only', '__return_true' );
					}

			}
		} // /wm_jetpack_food_menu_loop_section_display_front_page

		add_action( 'wmhook_loop_food_menu_postslist_before', 'wm_jetpack_food_menu_loop_section_display_front_page' );



		/**
		 * Disable food menu section archive links
		 *
		 * @since    2.2.0
		 * @version  2.2.0
		 *
		 * @param  bool $enabled
		 */
		if ( ! function_exists( 'wm_food_menu_section_archive_link' ) ) {
			function wm_food_menu_section_archive_link( $enabled ) {

				// Output

					return ! get_theme_mod( 'food-menu-section-archive-link-disable', false );

			}
		} // /wm_food_menu_section_archive_link

		add_filter( 'jetpack_food_section_archive_link', 'wm_food_menu_section_archive_link' );

	} else {

		/**
		 * Remove obsolete page templates when Food Menu is disabled
		 *
		 * @since    2.2.0
		 * @version  2.2.0
		 *
		 * @param  array $page_templates
		 */
		if ( ! function_exists( 'wm_page_templates_remove_menu' ) ) {
			function wm_page_templates_remove_menu( $page_templates ) {

			// Processing

				unset( $page_templates['page-template/_menu.php'] );


			// Output

				return $page_templates;

			}
		} // /wm_page_templates_remove_menu

		add_filter( 'theme_page_templates', 'wm_page_templates_remove_menu' );

	} // /disable-food-menu?
