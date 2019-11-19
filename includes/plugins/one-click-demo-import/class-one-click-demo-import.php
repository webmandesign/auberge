<?php
/**
 * One Click Demo Import Class
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.1
 * @version  2.7.2
 *
 * Contents:
 *
 *   0) Init
 *  10) Texts
 *  20) Setup
 * 100) Helpers
 */
class Auberge_One_Click_Demo_Import {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    2.1
		 * @version  2.7.2
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles', 99 );

						add_action( 'pt-ocdi/before_widgets_import', __CLASS__ . '::before_widgets_import' );

						add_action( 'pt-ocdi/after_import', __CLASS__ . '::after' );

					// Filters

						add_filter( 'pt-ocdi/plugin_intro_text', __CLASS__ . '::info' );

						add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

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
	 * 10) Texts
	 */

		/**
		 * Info texts
		 *
		 * @since    2.1
		 * @version  2.7.2
		 *
		 * @param  string $text  Default intro text.
		 */
		public static function info( $text = '' ) {

			// Processing

				$text .= '<div class="manual-import-info">';

					$text .= '<h2>';
					$text .= esc_html__( 'Manual import procedure', 'auberge' );
					$text .= '</h2>';

					$text .= '<p>';
					$text .= esc_html__( 'By importing this demo content you get the exact copy of the theme demo website.', 'auberge' );
					$text .= ' (<a href="https://themedemos.webmandesign.eu/auberge/">' . esc_html__( 'Preview the theme demo website &raquo;', 'auberge' ) . '</a>)';

					$text .= '<br>';

					$text .= esc_html__( 'For instructions on importing theme demo content please visit GitHub repository.', 'auberge' );
					$text .= ' (<a href="https://github.com/webmandesign/demo-content/blob/master/auberge/readme.md#what-is-this">' . esc_html__( 'GitHub repository instructions &raquo;', 'auberge' ) . '</a>)';
					$text .= '</p>';

				$text .= '</div>';

				$text .= '<div class="media-files-quality-info">';

					$text .= '<h3>';
					$text .= esc_html__( 'Media files quality', 'auberge' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please note that imported media files (such as images, video and audio files) are of low quality to prevent copyright infringement.', 'auberge' );
					$text .= ' ' . esc_html__( 'Please read "Credits" section of theme documentation for reference where the demo media files were obtained from.', 'auberge' );
					$text .= ' <a href="https://webmandesign.github.io/docs/auberge/#credits">' . esc_html__( 'Get media for your website &raquo;', 'auberge' ) . '</a>';
					$text .= '</p>';

				$text .= '</div>';

				$text .= '<div class="ocdi__demo-import-notice">';

					$text .= '<h3>';
					$text .= esc_html__( 'Install demo required plugins!', 'auberge' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please read the information about the theme demo required plugins first.', 'auberge' );
					$text .= ' ' . esc_html__( 'If you do not install and activate demo required plugins, some of the content will not be imported.', 'auberge' );
					$text .= ' <a href="https://github.com/webmandesign/demo-content/blob/master/auberge/readme.md#required-plugins" title="' . esc_attr__( 'Read the information before you run the theme demo content import process.', 'auberge' ) . '"><strong>';
					$text .= esc_html__( 'View the list of required plugins &raquo;', 'auberge' );
					$text .= '</strong></a>';
					$text .= '</p>';

					$text .= '<p>';
					$text .= '<em>';
					$text .= esc_html__( '(Note that this set of plugins may differ from plugins recommended under Appearance &rarr; Install Plugins!)', 'auberge' );
					$text .= '</em>';
					$text .= '</p>';

				$text .= '</div>';


			// Output

				return $text;

		} // /info





	/**
	 * 20) Setup
	 */

		/**
		 * After import actions
		 *
		 * @since    2.1
		 * @version  2.1
		 *
		 * @param  string $selected_import
		 */
		public static function after( $selected_import = '' ) {

			// Processing

				// Front and blog page

					self::front_and_blog_page();

				// Menu locations

					self::menu_locations();

		} // /after



		/**
		 * Setup front and blog page
		 *
		 * @since    2.1
		 * @version  2.1
		 */
		public static function front_and_blog_page() {

			// Processing

				update_option( 'show_on_front', 'page' );

				// Front page

					$page_front = get_page_by_path( 'sample-page-2' );

					update_option( 'page_on_front', $page_front->ID );

				// Blog page

					$page_blog = get_page_by_path( 'blog' );

					update_option( 'page_for_posts', $page_blog->ID );

		} // /front_and_blog_page



		/**
		 * Setup navigation menu locations
		 *
		 * @since    2.1
		 * @version  2.1.1
		 */
		public static function menu_locations() {

			// Helper variables

				$menu            = array();
				$menu['primary'] = get_term_by( 'slug', 'main-navigation', 'nav_menu' );
				$menu['social']  = get_term_by( 'slug', 'social-links', 'nav_menu' );


			// Processing

				set_theme_mod( 'nav_menu_locations', array(
						'primary' => ( isset( $menu['primary']->term_id ) ) ? ( $menu['primary']->term_id ) : ( null ),
						'social' => ( isset( $menu['social']->term_id ) ) ? ( $menu['social']->term_id ) : ( null ),
					) );

		} // /menu_locations



		/**
		 * Remove all widgets from sidebars first
		 *
		 * @since    2.1
		 * @version  2.1.1
		 */
		public static function before_widgets_import() {

			// Processing

				delete_option( 'sidebars_widgets' );

		} // /before_widgets_import





	/**
	 * 100) Helpers
	 */

		/**
		 * OCDI plugin admin page styles
		 *
		 * @since    2.1.1
		 * @version  2.1.1
		 */
		public static function styles() {

			// Processing

				// OCDI 2.0 styling fix

					wp_add_inline_style(
							'ocdi-main-css',
							'.ocdi.about-wrap { max-width: 66em; }'
						);

		} // /styles





} // /Auberge_One_Click_Demo_Import

add_action( 'after_setup_theme', 'Auberge_One_Click_Demo_Import::init', 5 );
