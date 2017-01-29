<?php
/**
 * Welcome Page Class
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.1
 * @version  2.2.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Renderer
 * 20) Admin menu
 * 30) Assets
 */
class Auberge_Welcome {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    2.1
		 * @version  2.1
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_menu', __CLASS__ . '::admin_menu' );

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::assets' );

		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    2.1
		 * @version  2.1
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





	/**
	 * 10) Renderer
	 */

		/**
		 * Render the screen content
		 *
		 * @since    2.1
		 * @version  2.2.0
		 */
		public static function render() {

			// Helper variables

				$sections = (array) apply_filters( 'wmhook_auberge_welcome_render_sections', array(
						0   => 'header',
						10  => 'quickstart',
						20  => 'demo',
						100 => 'footer',
					) );

				ksort( $sections );


			// Output

				?>

				<div class="wrap welcome-wrap about-wrap">

					<?php

					do_action( 'wmhook_auberge_welcome_render_top' );

					foreach ( $sections as $section ) {
						get_template_part( 'template-parts/component-welcome', $section );
					}

					do_action( 'wmhook_auberge_welcome_render_bottom' );

					?>

				</div>

				<?php

		} // /render





	/**
	 * 20) Admin menu
	 */

		/**
		 * Add screen to WordPress admin menu
		 *
		 * @since    2.1
		 * @version  2.2.0
		 */
		public static function admin_menu() {

			// Processing

				add_theme_page(
						// $page_title
						esc_html__( 'Welcome', 'auberge' ),
						// $menu_title
						esc_html__( 'Welcome', 'auberge' ),
						// $capability
						'switch_themes',
						// $menu_slug
						get_template() . '-welcome',
						// $function
						__CLASS__ . '::render'
					);

		} // /admin_menu





	/**
	 * 30) Assets
	 */

		/**
		 * Styles and scripts
		 *
		 * @since    2.1
		 * @version  2.2.0
		 *
		 * @param  string $hook_suffix
		 */
		public static function assets( $hook_suffix = '' ) {

			// Requirements check

				if ( $hook_suffix !== get_plugin_page_hookname( get_template() . '-welcome', 'themes.php' ) ) {
					return;
				}


			// Processing

				// Styles

					wp_enqueue_style(
							get_template() . '-welcome',
							wm_get_stylesheet_directory_uri( 'assets/css/welcome.css' ),
							false,
							esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
							'screen'
						);

				// RTL setup

					wp_style_add_data( get_template() . '-welcome', 'rtl', 'replace' );

		} // /assets





} // /Auberge_Welcome

add_action( 'after_setup_theme', 'Auberge_Welcome::init' );
