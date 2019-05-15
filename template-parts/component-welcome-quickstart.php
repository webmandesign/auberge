<?php
/**
 * Admin "Welcome" page content component
 *
 * Quickstart guide.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.2.0
 * @version  2.7.1
 */





// Requirements check

	if ( ! class_exists( 'Auberge_Welcome' ) ) {
		return;
	}


?>

<h2 class="screen-reader-text"><?php esc_html_e( 'Quickstart Guide', 'auberge' ); ?></h2>

<div class="feature-section two-col has-2-columns" style="max-width: none;">

	<div class="first-feature col column">

		<span class="dropcap">1</span>

		<h3><?php esc_html_e( 'The WordPress settings', 'auberge' ); ?></h3>

		<p>
			<?php esc_html_e( 'Do not forget to set up your WordPress in "Settings" section of the WordPress dashboard.', 'auberge' ); ?>
			<?php esc_html_e( 'Please go through all the subsections and options.', 'auberge' ); ?>
			<?php esc_html_e( 'This step is required for all WordPress websites.', 'auberge' ); ?>
		</p>

		<p>
			<strong><?php esc_html_e( 'Please, pay special attention to image sizes settings under Settings &raquo; Media.', 'auberge' ); ?></strong>
		</p>

		<a class="button button-hero" href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>"><?php esc_html_e( 'Set Up WordPress &raquo;', 'auberge' ); ?></a>

	</div>

	<div class="last-feature col column">

		<span class="dropcap">2</span>

		<h3><?php esc_html_e( 'Customize the theme', 'auberge' ); ?></h3>

		<p>
			<?php esc_html_e( 'You can customize the theme using live-preview editor.', 'auberge' ); ?>
			<?php esc_html_e( 'Customization changes will go live only after you save them!', 'auberge' ); ?>
		</p>

		<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary button-hero"><?php esc_html_e( 'Customize the Theme &raquo;', 'auberge' ); ?></a>

	</div>

</div>
