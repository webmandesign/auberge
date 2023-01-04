<?php
/**
 * Admin "Welcome" page content component.
 *
 * Quickstart guide.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0.0
 * @version  2.9.0
 */

if ( ! class_exists( 'Auberge_Welcome' ) ) {
	return;
}

?>

<div class="welcome__section welcome__section--guide" id="welcome-guide">

	<h2><?php esc_html_e( 'Quickstart Guide', 'auberge' ); ?></h2>

	<div class="welcome__column welcome__guide--settings">
		<h3>
			<span class="welcome__icon dashicons dashicons-admin-settings"></span>
			<?php esc_html_e( 'Set up', 'auberge' ); ?>
		</h3>
		<p>
			<?php esc_html_e( 'Make sure to tweak "Settings" section of your site.', 'auberge' ); ?>
			<?php esc_html_e( '(Pay attention to image size setup under Settings &rarr; Media.)', 'auberge' ); ?>
		</p>
		<p><a class="button button-hero" href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>"><?php esc_html_e( 'Settings', 'auberge' ); ?></a></p>
	</div>

	<div class="welcome__column welcome__guide--customize">
		<h3>
			<span class="welcome__icon dashicons dashicons-admin-customizer"></span>
			<?php esc_html_e( 'Customize', 'auberge' ); ?>
		</h3>
		<p>
			<?php esc_html_e( 'You can customize your website using a live-preview editor.', 'auberge' ); ?>
			<?php esc_html_e( 'Customization changes apply only after you publish them.', 'auberge' ); ?>
		</p>
		<p><a class="button button-hero" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Customize', 'auberge' ); ?></a></p>
	</div>

	<div class="welcome__column welcome__guide--wordpress">
		<h3>
			<span class="welcome__icon dashicons dashicons-wordpress-alt"></span>
			<?php esc_html_e( 'New to WordPress?', 'auberge' ); ?>
		</h3>
		<p><?php esc_html_e( 'If you are new to WordPress check out info in theme documentation.', 'auberge' ); ?></p>
		<p><a href="https://webmandesign.github.io/docs/auberge/#wordpress"><?php esc_html_e( 'Get to know WordPress &rarr;', 'auberge' ); ?></a></p>
	</div>

</div>
