<?php
/**
 * Admin "Welcome" page content component
 *
 * Demo content installation.
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

<div class="welcome__section welcome__section--demo" id="welcome-demo">

	<h2>
		<span class="welcome__icon dashicons dashicons-database-add"></span>
		<?php esc_html_e( 'Theme Demo Content', 'auberge' ); ?>
	</h2>

	<div class="welcome__section--child">
		<h3><?php esc_html_e( 'Full theme demo content', 'auberge' ); ?></h3>

		<p>
			<?php esc_html_e( 'You can install a full theme demo content to match the theme demo website.', 'auberge' ); ?>
			<a href="https://themedemos.webmandesign.eu/auberge/"><?php esc_html_e( '(Preview the demo &rarr;)', 'auberge' ); ?></a>
			<?php esc_html_e( 'This provides a comprehensive start for building your own website.', 'auberge' ); ?>
		</p>

		<p>
			<?php esc_html_e( 'Please check out these information:', 'auberge' ); ?>
			<br><a href="https://webmandesign.github.io/docs/auberge/#demo-content"><?php esc_html_e( 'Information about theme demo content &rarr;', 'auberge' ); ?></a>
			<br><a href="https://github.com/webmandesign/demo-content/tree/master/auberge/"><?php esc_html_e( 'Specific instructions on how to install theme demo content &rarr;', 'auberge' ); ?></a>
		</p>

		<?php if ( class_exists( 'OCDI_Plugin' ) ) : ?>
			<p>
				<a class="button button-hero" href="<?php echo esc_url( 'themes.php?page=pt-one-click-demo-import' ); ?>"><?php esc_html_e( 'Install demo content', 'auberge' ); ?></a>
				&ensp;
				<small><em><?php esc_html_e( '(Appearance &rarr; Import Demo Data)', 'auberge' ); ?></em></small>
			</p>
		<?php else : ?>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>"><?php esc_html_e( 'Use "One Click Demo Import" plugin &rarr;', 'auberge' ); ?></a></p>
		<?php endif; ?>
	</div>

</div>
