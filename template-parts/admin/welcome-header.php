<?php
/**
 * Admin "Welcome" page content component.
 *
 * Header.
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

<div class="welcome__section welcome__header">

	<h1>
		<?php echo wp_get_theme( 'auberge' )->display( 'Name' ); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?>
		<small><?php echo esc_html( trim( wp_get_theme( get_template() )->get( 'Version' ) ) ) ?></small>
	</h1>

	<p class="welcome__intro">
		<?php

		printf(
			/* translators: 1: theme name, 2: theme developer link. */
			esc_html__( 'Congratulations and thank you for choosing %1$s theme by %2$s!', 'auberge' ),
			'<strong>' . wp_get_theme( 'auberge' )->display( 'Name' ) . '</strong>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'<a href="' . esc_url( wp_get_theme( 'auberge' )->get( 'AuthorURI' ) ) . '"><strong>WebMan Design</strong></a>'
		);

		?>
		<?php esc_html_e( 'Information on this page introduces the theme and provides useful tips.', 'auberge' ); ?>
	</p>

	<nav class="welcome__nav">
		<ul>
			<li><a href="#welcome-guide"><?php esc_html_e( 'Quickstart', 'auberge' ); ?></a></li>
			<li><a href="#welcome-demo"><?php esc_html_e( 'Demo content', 'auberge' ); ?></a></li>
			<li><a href="#welcome-promo"><?php esc_html_e( 'Upgrade', 'auberge' ); ?></a></li>
		</ul>
	</nav>

	<p>
		<a href="https://webmandesign.github.io/docs/auberge/" class="button button-hero button-primary"><?php esc_html_e( 'Documentation &rarr;', 'auberge' ); ?></a>
		<a href="https://support.webmandesign.eu/forums/forum/auberge/" class="button button-hero button-primary"><?php esc_html_e( 'Support Forum &rarr;', 'auberge' ); ?></a>
	</p>

	<p class="welcome__alert welcome__alert--tip">
		<strong class="welcome__badge"><?php echo esc_html_x( 'Tip:', 'Notice, hint.', 'auberge' ); ?></strong>
		<?php echo Auberge_Welcome::get_info_like(); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?>
	</p>

</div>

<div class="welcome-content">
