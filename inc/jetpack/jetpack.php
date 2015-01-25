<?php
/**
 * Jetpack setup
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 *
 * @since    1.1
 * @version  1.2
 *
 * CONTENT:
 * -  10) Actions and filters
 * -  20) Jetpack integration
 */





/**
 * 10) Actions and filters
 */

	/**
	 * Actions
	 */

		//Jetpack
			add_action( 'after_setup_theme',     'wm_jetpack',                         30  );
			add_action( 'admin_enqueue_scripts', 'wm_jetpack_styles_admin',            100 );
			add_action( 'wp',                    'wm_jetpack_remove_food_menu_markup', 10  );



	/**
	 * Filters
	 */

		//Jetpack
			add_filter( 'sharing_show',                'wm_jetpack_sharing',             10, 2 );
			add_filter( 'infinite_scroll_js_settings', 'wm_jetpack_is_js_settings',      10    );
			add_filter( 'wp_insert_post_data',         'wm_jetpack_add_many_food_menus', 10, 2 );





/**
 * 20) Jetpack integration
 */

	/**
	 * Enables Jetpack features
	 *
	 * @since    1.0
	 * @version  1.2
	 */
	if ( ! function_exists( 'wm_jetpack' ) ) {
		function wm_jetpack() {
			//Responsive videos
				add_theme_support( 'jetpack-responsive-videos' );

			//Site logo
				add_theme_support( 'site-logo' );

			//Food menu post type
				add_theme_support( 'nova_menu_item' );
				add_post_type_support( 'nova_menu_item', array( 'comments' ) );

				/**
				 * Edit Food Menu output
				 *
				 * @link  https://github.com/Automattic/jetpack/blob/master/modules/custom-post-types/nova.php#L14
				 */
				if ( class_exists( 'Nova_Restaurant' ) ) {
					Nova_Restaurant::init( array( 'menu_title_tag' => 'h2' ) );
				}

			//Featured content
				add_theme_support( 'featured-content', apply_filters( 'wmhook_wm_jetpack_featured_content', array(
						'featured_content_filter' => 'wm_get_banner_posts',
						'max_posts'               => 6,
						'post_types'              => array( 'post' ),
					) ) );

			//Infinite scroll
				add_theme_support( 'infinite-scroll', apply_filters( 'wmhook_wm_jetpack_infinite_scroll', array(
						'container'      => 'posts',
						'footer'         => false,
						'posts_per_page' => 6,
						'render'         => 'wm_jetpack_is_render',
						'type'           => 'scroll',
						'wrapper'        => false,
					) ) );
		}
	} // /wm_jetpack



	/**
	 * Jetpack sharing buttons
	 */

		/**
		 * Jetpack sharing display
		 *
		 * @param  bool $show
		 * @param  obj  $post
		 */
		if ( ! function_exists( 'wm_jetpack_sharing' ) ) {
			function wm_jetpack_sharing( $show, $post ) {
				//Helper variables
					global $wp_current_filter;

				//Preparing output
					if ( in_array( 'the_excerpt', (array) $wp_current_filter ) ) {
						$show = false;
					}

				//Output
					return $show;
			}
		} // /wm_jetpack_sharing



	/**
	 * Jetpack infinite scroll
	 */

		/**
		 * Jetpack infinite scroll JS settings array modifier
		 *
		 * @param  array $settings
		 */
		if ( ! function_exists( 'wm_jetpack_is_js_settings' ) ) {
			function wm_jetpack_is_js_settings( $settings ) {
				//Helper variables
					$settings['text'] = esc_js( __( 'Load more&hellip;', 'wm_domain' ) );

				//Output
					return $settings;
			}
		} // /wm_jetpack_is_js_settings



		/**
		 * Jetpack infinite scroll posts renderer
		 */
		if ( ! function_exists( 'wm_jetpack_is_render' ) ) {
			function wm_jetpack_is_render() {
				while ( have_posts() ) :

					the_post();

					$content_type = get_post_format();

					if ( 'nova_menu_item' === get_post_type() ) {
						$content_type = 'food-menu';
					}

					get_template_part( 'content', $content_type );

				endwhile;
			}
		} // /wm_jetpack_is_render



	/**
	 * Jetpack Food Menus CPT
	 */

		/**
		 * Jetpack modify food menus Add Many Items post content/excerpt
		 *
		 * @param  array $data
		 * @param  array $postarr
		 */
		if ( ! function_exists( 'wm_jetpack_add_many_food_menus' ) ) {
			function wm_jetpack_add_many_food_menus( $data, $postarr ) {
				//Helper variables
					global $current_screen;

				//Requirements check
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

				//Preparing output
					if ( $postarr['post_content'] && empty( $postarr['post_excerpt'] ) ) {
						$data['post_excerpt'] = $data['post_content'];
						$data['post_content'] = '';
					}

				//Output
					return $data;
			}
		} // /wm_jetpack_add_many_food_menus



		/**
		 * Jetpack food menus Add Many Items styles
		 *
		 * @since    1.0
		 * @version  1.2
		 */
		if ( ! function_exists( 'wm_jetpack_styles_admin' ) ) {
			function wm_jetpack_styles_admin() {
				//Helper variables
					global $current_screen;

				//Enqueue (only on a specific admin page)
					if (
							isset( $current_screen->id )
							&& 'nova_menu_item_page_add_many_nova_items' === $current_screen->id
						) {
							wp_add_inline_style( 'nova-font', wm_esc_css( '.many-items-table input[name="nova_title[]"], .many-items-table textarea { width: 360px; max-width: 100%; } .many-items-table textarea { height: 50px; }' ) );
					}
			}
		} // /wm_jetpack_styles_admin



		/**
		 * Jetpack remove food menus singlular CPT page markup
		 *
		 * @link  https://wordpress.org/support/topic/novaphp-custom-post-type-single-post-view#post-6244588
		 */
		if ( ! function_exists( 'wm_jetpack_remove_food_menu_markup' ) ) {
			function wm_jetpack_remove_food_menu_markup() {
				if ( class_exists( 'Nova_Restaurant' ) && is_singular( 'nova_menu_item' ) ) {
					remove_filter( 'template_include', array( Nova_Restaurant::init(), 'setup_menu_item_loop_markup__in_filter' ) );
				}
			}
		} // /wm_jetpack_remove_food_menu_markup



		/**
		 * Display Menu Sections custom taxonomy anchor links to navigate through food menu
		 *
		 * @return  HTML Unordered list of taxonomy anchor links.
		 *
		 * @todo  This is being generated with JS for the time while Jetpack doesn't improve manipulation and sorting.
		 */
		if ( ! function_exists( 'wm_jetpack_menu_sections_taxonomy' ) ) {
			function wm_jetpack_menu_sections_taxonomy() {
				//Helper variables
					$output = '';

					$taxonomy_name = apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_name', 'nova_menu' );
					$taxonomy_args = (array) apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_args', array() );

				//Requirements check
					if (
							! class_exists( 'Nova_Restaurant' )
							|| ! taxonomy_exists( $taxonomy_name )
						) {
						return;
					}
				//Preparing output
					$terms = get_terms( $taxonomy_name, $taxonomy_args );
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						foreach ( $terms as $term ) {
							$term_link = '#' . strtolower( str_replace( ' ', '_', esc_html( $term->name ) ) );
							$output .= '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
						}
					}
				//Output
					echo apply_filters( 'wmhook_wm_jetpack_menu_sections_taxonomy_output', '<ul id="menu-group-links" class="taxonomy-links taxonomy-' . $taxonomy_name . '">' . $output . '</ul>' );
			}
		} // /wm_jetpack_menu_sections_taxonomy

?>