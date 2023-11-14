<?php
/**
 * Admin "Welcome" page content component.
 *
 * Promo.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  2.9.0
 */

if ( ! class_exists( 'Auberge_Welcome' ) ) {
	return;
}

?>

<div class="welcome__section welcome__section--promo" id="welcome-promo">

	<h2>
		<span class="welcome__icon dashicons dashicons-superhero-alt"></span>
		<?php esc_html_e( 'Like the theme?', 'auberge' ); ?>
	</h2>

	<p>
		<?php esc_html_e( 'You are using a fully functional 100% free WordPress theme.', 'auberge' ); ?>
		<?php esc_html_e( 'If you find it helpful, please support its updates and technical support service with a donation at WebManDesign.eu.', 'auberge' ); ?>
		<?php esc_html_e( 'Thank you!', 'auberge' ); ?>
	</p>

	<p><a href="https://www.webmandesign.eu/contact/#donation"><strong><?php esc_html_e( 'Visit WebMan Design website now &rarr;', 'auberge' ); ?></strong></a></p>

	<p>
		<?php esc_html_e( 'Or, if you need recipes functionality, option to set up custom front page slider, post formats, and more theme options, check out the paid version Auberge Plus.', 'auberge' ); ?>
		<a href="https://www.webmandesign.eu/portfolio/auberge-plus-wordpress-theme/"><strong><?php esc_html_e( 'Auberge Plus info &rarr;', 'auberge' ); ?></strong></a>
	</p>

</div>
