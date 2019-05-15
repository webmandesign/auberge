<?php
/**
 * Admin "Welcome" page content component
 *
 * Header.
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
	<br>
	<?php echo Auberge_Welcome::get_info_like(); ?>
</div>

<p class="wm-actions">

	<a href="https://webmandesign.github.io/docs/auberge/" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Theme Documentation', 'auberge' ); ?></a>

	<a href="https://support.webmandesign.eu" class="button button-hero" target="_blank"><?php esc_html_e( 'Support Center', 'auberge' ); ?></a>

</p>

<hr>

<div class="welcome-content">
