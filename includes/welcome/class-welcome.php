<?php
/**
 * Welcome Page Class.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.1
 * @version  2.9.0
 */
class Auberge_Welcome {

	/**
	 * Initialization.
	 *
	 * @since    2.1
	 * @version  2.9.0
	 */
	public static function init() {

		// Processing

			// Hooks

				// Actions

					add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles' );

					add_action( 'admin_menu', __CLASS__ . '::admin_menu' );

					add_action( 'load-themes.php', __CLASS__ . '::activation_notice_display' );

	} // /init

	/**
	 * Render the screen content.
	 *
	 * @since    2.1
	 * @version  2.9.0
	 */
	public static function render() {

		// Variables

			$sections = (array) apply_filters( 'wmhook_auberge_welcome_render_sections', array(
				0   => 'header',
				20  => 'guide',
				30  => 'demo',
				40  => 'promo',
				100 => 'footer',
			) );

			ksort( $sections );


		// Output

			?>

			<div class="wrap welcome__container">

				<?php

				do_action( 'wmhook_auberge_welcome_render_top' );

				foreach ( $sections as $section ) {
					get_template_part( 'template-parts/admin/welcome', $section );
				}

				do_action( 'wmhook_auberge_welcome_render_bottom' );

				?>

			</div>

			<?php

	} // /render

	/**
	 * Welcome screen CSS styles.
	 *
	 * @since    2.1
	 * @version  2.9.0
	 *
	 * @param  string $hook
	 *
	 * @return  void
	 */
	public static function styles( $hook = '' ) {

		// Requirements check

			if ( 'appearance_page_auberge-welcome' !== $hook ) {
				return;
			}


		// Processing

			// Styles

				wp_enqueue_style(
					'auberge-welcome',
					get_theme_file_uri( 'assets/css/welcome.css' ),
					array( 'about' ),
					'v' . esc_attr( trim( wp_get_theme( get_template() )->get( 'Version' ) ) )
				);

	} // /styles

	/**
	 * Add screen to WordPress admin menu.
	 *
	 * @since    2.1
	 * @version  2.9.0
	 */
	public static function admin_menu() {

		// Processing

			add_theme_page(
				// $page_title
				esc_html__( 'Welcome', 'auberge' ),
				// $menu_title
				esc_html__( 'Welcome', 'auberge' ),
				// $capability
				'edit_theme_options',
				// $menu_slug
				'auberge-welcome',
				// $function
				__CLASS__ . '::render'
			);

	} // /admin_menu

	/**
	 * Initiate "Welcome" admin notice after theme activation.
	 *
	 * @since  2.9.0
	 *
	 * @return  void
	 */
	public static function activation_notice_display() {

		// Processing

			global $pagenow;

			if (
				is_admin()
				&& 'themes.php' == $pagenow
				&& isset( $_GET['activated'] )
			) {
				add_action( 'admin_notices', __CLASS__ . '::activation_notice_content', 99 );
			}

	} // /activation_notice_display

	/**
	 * Display "Welcome" admin notice after theme activation.
	 *
	 * @since  2.9.0
	 *
	 * @return  void
	 */
	public static function activation_notice_content() {

		// Processing

			get_template_part( 'template-parts/admin/notice', 'welcome' );

	} // /activation_notice_content

	/**
	 * Info text: Rate the theme.
	 *
	 * @since    2.7.0
	 * @version  2.9.0
	 */
	public static function get_info_like() {

		// Output

			return sprintf(
				/* translators: %1$s: heart icon, %2$s: star icons. */
				esc_html__( 'If you %1$s love this theme don\'t forget to rate it %2$s.', 'auberge' ),
				'<span class="dashicons dashicons-heart" style="color: red; vertical-align: middle;"></span>',
				'<a href="https://wordpress.org/support/theme/auberge/reviews/#new-post" style="display: inline-block; color: goldenrod; text-decoration-style: wavy; vertical-align: middle;"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></span></a>'
			)
			. ' '
			. '<br>'
			. '<a href="https://www.webmandesign.eu/contact/#donation">'
			. esc_html__( 'And/or please consider a donation.', 'auberge' )
			. '</a>'
			. ' '
			. esc_html__( 'Thank you!', 'auberge' );

	} // /get_info_like

	/**
	 * Info text: Contact support.
	 *
	 * @since    2.7.0
	 * @version  2.9.0
	 */
	public static function get_info_support() {

		// Output

			return
				esc_html__( 'Have a suggestion for improvement or something is not working as it should?', 'auberge' )
				. ' <a href="https://support.webmandesign.eu/forums/forum/auberge/">'
				. esc_html__( '&rarr; Contact support', 'auberge' )
				. '</a>';

	} // /get_info_support

} // /Auberge_Welcome

add_action( 'after_setup_theme', 'Auberge_Welcome::init' );
