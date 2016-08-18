<?php
/**
 * Jetpack Food Menu modifications
 *
 * @link  https://wordpress.org/plugins/jetpack/
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Class
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'Nova_Restaurant' ) ) {
		return;
	}





/**
 * 10) Class
 */

	/**
	 * Jetpack Food Menu modifications class
	 *
	 * @since    2.0
	 * @version  2.1
	 *
	 * Contents:
	 *
	 *   0) Init
	 *  10) Admin
	 *  20) Processors
	 *  30) Outputs
	 */
	class WM_Nova_Restaurant extends Nova_Restaurant {





		/**
		 * 0) Init
		 */

			/**
			 * Init
			 *
			 * @since    2.0
			 * @version  2.0
			 *
			 * @param  array $menu_item_loop_markup  Class settings.
			 */
			public static function init( $menu_item_loop_markup = array() ) {

				// Helper variables

					static $instance = false;


				// Processing

					if ( !$instance ) {
						$instance = new WM_Nova_Restaurant;
					}

					if ( $menu_item_loop_markup ) {
						$instance->menu_item_loop_markup = wp_parse_args( $menu_item_loop_markup, $instance->default_menu_item_loop_markup );
					}


				// Output

					return $instance;

			} // /init





		/**
		 * 10) Admin
		 */

			/**
			 * Add menu title rows to the list table
			 *
			 * @since    2.0
			 * @version  2.0
			 *
			 * @param  object $post
			 */
			public function show_menu_titles_in_menu_item_list( $post ) {

				// Helper variables

					global $wp_list_table;

					static $last_term_id = false;

					$term = $this->get_menu_item_menu_leaf( $post->ID );

					if ( false !== $last_term_id && $last_term_id === $term->term_id ) {
						return;
					}

					$last_term_id = $term->term_id;
					$parents      = array();
					$current_term = $term;

					while ( $current_term->parent ) {
						$current_term = get_term( $current_term->parent, self::MENU_TAX );
						$parents[]    = esc_html( sanitize_term_field( 'name', $current_term->name, $current_term->term_id, self::MENU_TAX, 'display' ) );
					}

					krsort( $parents );

					$non_order_column_count = $wp_list_table->get_column_count() - 1;

					$screen = get_current_screen();

					$url = admin_url( $screen->parent_file );

					$up_url = add_query_arg( array(
						'action'  => 'move-menu-up',
						'term_id' => (int) $term->term_id,
					), wp_nonce_url( $url, 'nova_move_menu_up_' . $term->term_id ) );

					$down_url = add_query_arg( array(
						'action'  => 'move-menu-down',
						'term_id' => (int) $term->term_id,
					), wp_nonce_url( $url, 'nova_move_menu_down_' . $term->term_id ) );


				// Output

					?>

					<tr class="no-items menu-label-row" data-term_id="<?php echo esc_attr( $term->term_id ) ?>">

						<td class="colspanchange" colspan="<?php echo (int) $non_order_column_count; ?>">
							<h3><?php

								if ( ! empty( $parents ) ) {
									echo implode( ' / ', (array) $parents ) . ' / ';
								}

								if ( ! is_wp_error( $term ) ) {

									echo esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, self::MENU_TAX, 'display' ) );

									edit_term_link( esc_html__( 'edit', 'auberge' ), '<span class="edit-nova-section"><span class="dashicon dashicon-edit"></span>', '</span>', $term );

								} else {

									esc_html_e( 'Uncategorized' , 'auberge' );

								}

							?></h3>
						</td>

						<td>
							<?php if ( ! is_wp_error( $term ) ) : ?>
							<a class="nova-move-menu-up" title="<?php esc_attr_e( 'Move menu section up', 'auberge' ); ?>" href="<?php echo esc_url( $up_url ); ?>"><?php esc_html_e( 'UP', 'auberge' ); ?></a><br>
							<a class="nova-move-menu-down" title="<?php esc_attr_e( 'Move menu section down', 'auberge' ); ?>" href="<?php echo esc_url( $down_url ); ?>"><?php esc_html_e( 'DOWN', 'auberge' ); ?></a>
							<?php endif; ?>
						</td>

					</tr>

					<?php

			} // /show_menu_titles_in_menu_item_list





		/**
		 * 20) Processors
		 */

			/**
			 * Sets up the loop markup
			 *
			 * Attached to the 'template_include' *filter*, which fires only
			 * during a real blog view (not in admin, feeds, etc.).
			 *
			 * Making sure the markup of single Food Menu post is not altered.
			 *
			 * @since    2.0
			 * @version  2.0
			 *
			 * @param  string $template  Template file.
			 */
			function setup_menu_item_loop_markup__in_filter( $template ) {

				// Requirements check

					if ( is_singular( 'nova_menu_item' ) ) {
						return $template;
					}


				// Processing

					add_action( 'loop_start', array( $this, 'start_menu_item_loop' ) );


				// Output

					return $template;

			} // /setup_menu_item_loop_markup__in_filter



			/**
			 * Sets the current Food Menu section being outputted in the loop
			 *
			 * @since    2.0
			 * @version  2.0
			 *
			 * @param  int $post_id
			 */
			public function get_menu_item_menu_leaf( $post_id ) {

				// Helper variables

					// Get first menu taxonomy "leaf"

						$term_ids = wp_get_object_terms( $post_id, self::MENU_TAX, array( 'fields' => 'ids' ) );


				// Processing

					foreach ( $term_ids as $term_id ) {

						// Display top level parent only if enabled

							$parents = (array) get_ancestors( $term_id, self::MENU_TAX );

							if (
									apply_filters( 'jetpack_food_section_parent_only', false )
									&& ! empty( $parents )
								) {
								$term_id = end( $parents );
								break;
							}

						// Or check out children

							$children = (array) get_term_children( $term_id, self::MENU_TAX );

							if ( empty( $children ) ) {
								break;
							}

					} // /foreach


				// Output

					if ( ! isset( $term_id ) ) {
						return false;
					}

					return get_term( $term_id, self::MENU_TAX );

			} // /get_menu_item_menu_leaf





		/**
		 * 30) Outputs
		 */

			/**
			 * Loop markup setup
			 *
			 * @since    2.0
			 * @version  2.0
			 *
			 * @param  string $field
			 */
			function get_menu_item_loop_markup( $field = null ) {

				// Helper variables

					$markup = $this->menu_item_loop_markup;


				// Processing

					if ( is_front_page() ) {
						$markup['menu_title_tag'] = str_replace(
								array(
									'h1',
									'h2',
								),
								array(
									'h2',
									'h3',
								),
								$markup['menu_title_tag']
							);
					}


				// Output

					return $markup;

			} // /get_menu_item_loop_markup



			/**
			 * Outputs the Menu Group Header
			 *
			 * Allowing HTML tags in taxonomy description.
			 *
			 * @since    2.0
			 * @version  2.1
			 */
			public function menu_item_loop_header() {

				// Helper variables

					$term_link = '';

					if ( apply_filters( 'jetpack_food_section_archive_link', true ) ) {
						$term_link = get_term_link( $this->menu_item_loop_current_term, 'nova_menu' );
					}


				// Output

					$this->menu_item_loop_open_element( 'menu_header' );

						$this->menu_item_loop_open_element( 'menu_title' );

							if ( $term_link && ! is_wp_error( $term_link ) ) {
								echo '<a href="' . get_term_link( $this->menu_item_loop_current_term, 'nova_menu' ) . '">';
							}

							echo esc_html( $this->menu_item_loop_current_term->name );

							if ( $term_link && ! is_wp_error( $term_link ) ) {
								echo '</a>';
							}

						$this->menu_item_loop_close_element( 'menu_title' );

						if ( $this->menu_item_loop_current_term->description ) {

							$this->menu_item_loop_open_element( 'menu_description' );
								echo wp_kses_post( $this->menu_item_loop_current_term->description );
							$this->menu_item_loop_close_element( 'menu_description' );

						}

					$this->menu_item_loop_close_element( 'menu_header' );

			} // /menu_item_loop_header



			/**
			 * Outputs a Menu Item Markup element opening tag
			 *
			 * @since    2.0
			 * @version  2.1
			 *
			 * @param string $field - Menu Item Markup settings field
			 */
			public function menu_item_loop_open_element( $field ) {

				// Helper variables

					$id = '';

					$markup = $this->get_menu_item_loop_markup();


				// Processing

					if (
							'menu_header' == $field
							&& $this->menu_item_loop_current_term->slug
						) {
						$id = ' id="' . sanitize_title( $this->menu_item_loop_current_term->slug . '-' . rand( 10, 99 ) ) . '"';
					}


				// Output

					echo '<' . tag_escape( $markup["{$field}_tag"] ) . $this->menu_item_loop_class( $markup["{$field}_class"] ) . $id . ">\n";

			} // /menu_item_loop_open_element





	} // /WM_Nova_Restaurant

	add_action( 'init', array( 'WM_Nova_Restaurant', 'init' ) );
