<?php
/**
 * Welcome Page Class
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.1
 * @version  2.1
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
		 * @version  2.1
		 */
		public static function render() {

			// Output

				?>

				<div class="wrap welcome-wrap about-wrap">

					<!-- Header -->

						<h1>
							<?php

							printf(
								esc_html_x( 'Welcome to %1$s %2$s', '1: theme name, 2: theme version number.', 'auberge' ),
								'<strong>' . wp_get_theme( get_template() )->get( 'Name' ) . '</strong>',
								'<small>' . wp_get_theme( get_template() )->get( 'Version' ) . '</small>'
							);

							?>
						</h1>

						<div class="welcome-text about-text">
							<?php

							printf(
								esc_html_x( 'Thank you for using %1$s WordPress theme by %2$s!', '1: theme name, 2: theme developer link.', 'auberge' ),
								'<strong>' . wp_get_theme( get_template() )->get( 'Name' ) . '</strong>',
								'<a href="' . esc_url( wp_get_theme( get_template() )->get( 'AuthorURI' ) ) . '" target="_blank"><strong>WebMan Design</strong></a>'
							);

							?>
							<br>
							<?php esc_html_e( 'Please take time to read the steps below to set up your website.', 'auberge' ); ?>
						</div>

						<!-- Action links / buttons -->

							<p class="wm-actions">

								<a href="<?php echo esc_url( 'http://www.webmandesign.eu/manual/auberge/' ); ?>" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Theme Documentation', 'auberge' ); ?></a>

								<a href="<?php echo esc_url( 'https://support.webmandesign.eu' ); ?>" class="button button-hero" target="_blank"><?php esc_html_e( 'Support Forum', 'auberge' ); ?></a>

							</p>

					<!-- Content -->

						<div class="welcome-content">

						<!-- Quickstart steps -->

							<hr />

							<h2 class="screen-reader-text"><?php esc_html_e( 'Quickstart Guide', 'auberge' ); ?></h2>

							<div class="feature-section three-col">

								<div class="first-feature col">

									<span class="dropcap">1</span>

									<h3><?php esc_html_e( 'WebMan Amplifier', 'auberge' ); ?></h3>

									<p>
										<?php printf( esc_html_x( 'To use the recipes functionality please install and activate the %s plugin.', '%s: plugin name.', 'auberge' ), '<a href="https://wordpress.org/plugins/webman-amplifier/" target="_blank"><strong>WebMan Amplifier</strong></a>' ); ?>
									</p>
									<p>
										<strong>
											<?php printf( esc_html_x( 'Please note that this functionality is only available in paid version of the theme, the %s theme!', '%s: linked theme name.', 'auberge' ), '<a href="https://www.webmandesign.eu/auberge-wordpress-theme/#donate" target="_blank"><em>Auberge Plus</em></a>' ); ?>
										</strong>
									</p>

									<?php if ( ! class_exists( 'WM_Amplifier' ) ) : ?>

										<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-hero"><?php printf( esc_html_x( 'Install %s &raquo;', '%s: plugin name.', 'auberge' ), '<strong>WebMan Amplifier</strong>' ); ?></a>

									<?php endif; ?>

								</div>

								<div class="feature col">

									<span class="dropcap">2</span>

									<h3><?php esc_html_e( 'The WordPress settings', 'auberge' ); ?></h3>

									<p>
										<?php esc_html_e( 'Do not forget to set up your WordPress in "Settings" section of the WordPress dashboard.', 'auberge' ); ?>
										<?php esc_html_e( 'Please go through all the subsections and options.', 'auberge' ); ?>
										<?php esc_html_e( 'This step is required for all WordPress websites.', 'auberge' ); ?>
									</p>

									<a class="button button-hero" href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>"><?php esc_html_e( 'Set Up WordPress &raquo;', 'auberge' ); ?></a>

								</div>

								<div class="last-feature col">

									<span class="dropcap">3</span>

									<h3><?php esc_html_e( 'Customize the theme', 'auberge' ); ?></h3>

									<p>
										<?php esc_html_e( 'You can customize the theme using live-preview editor.', 'auberge' ); ?>
										<?php esc_html_e( 'Customization changes will go live only after you save them!', 'auberge' ); ?>
									</p>

									<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary button-hero"><?php esc_html_e( 'Customize the Theme &raquo;', 'auberge' ); ?></a>

								</div>

							</div>

						<!-- Special note -->

							<div class="wm-notes special">

								<h2 class="mt0"><strong><?php esc_html_e( 'Installing the theme demo content', 'auberge' ); ?></strong></h2>

								<p>
									<?php esc_html_e( 'You can install the theme demo content including pages, posts, custom post types, layouts, menus and widgets directly from your WordPress dashboard by clicking the button bellow.', 'auberge' ); ?>
								</p>

								<p>
									<?php esc_html_e( 'Alternatively (such as when the automated installation fails) you can follow theme documentation instructions for manual demo content installation.', 'auberge' ); ?>
									<a href="<?php echo esc_url( 'http://www.webmandesign.eu/manual/auberge/#demo-content' ); ?>" target="_blank"><?php esc_html_e( 'Read the instructions &raquo;', 'auberge' ); ?></a>
								</p>

								<?php if ( ! class_exists( 'PT_One_Click_Demo_Import' ) ) : ?>

									<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-hero"><strong><?php esc_html_e( 'Install and run "One Click Demo Import" plugin', 'auberge' ); ?></strong></a>

								<?php else : ?>

									<a href="<?php echo esc_url( 'themes.php?page=pt-one-click-demo-import' ); ?>" class="button button-hero button-primary"><strong><?php esc_html_e( 'Install theme demo content', 'auberge' ); ?></strong></a>

									<br>
									<small><em>
										<?php esc_html_e( 'Or head over to Appearance &raquo; Import Demo Data to start the import process.', 'auberge' ); ?>
									</em></small>

								<?php endif; ?>

							</div>

						</div>

					<!-- Footer note -->

						<p><small><em><?php esc_html_e( 'You can disable this page in Appearance &raquo; Customize &raquo; Theme &raquo; Others.', 'auberge' ); ?></em></small></p>

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
		 * @version  2.1
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
						'auberge-welcome',
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
		 * @version  2.1
		 *
		 * @param  string $hook_suffix
		 */
		public static function assets( $hook_suffix = '' ) {

			// Requirements check

				if ( $hook_suffix !== get_plugin_page_hookname( 'auberge-welcome', 'themes.php' ) ) {
					return;
				}


			// Processing

				// Styles

					wp_enqueue_style(
							'auberge-welcome',
							wm_get_stylesheet_directory_uri( 'assets/css/welcome.css' ),
							false,
							esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ),
							'screen'
						);

		} // /assets





} // /Auberge_Welcome

add_action( 'after_setup_theme', 'Auberge_Welcome::init' );
