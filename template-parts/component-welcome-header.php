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
 * @version  2.2.0
 */





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
</div>

<p class="wm-actions">

	<a href="https://www.webmandesign.eu/manual/auberge/" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Theme Documentation', 'auberge' ); ?></a>

	<a href="https://www.webmandesign.eu/projects-references/#links-support" class="button button-hero" target="_blank"><?php esc_html_e( 'Support Center', 'auberge' ); ?></a>

</p>

<hr>

<div class="welcome-content">
