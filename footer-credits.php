<?php
/**
 * Theme credits
 *
 * It is completely optional, but if you like this WordPress theme,
 * I would appreciate it if you keep the credit link in the footer.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.6.0
 */





/**
 * Helper variables
 */

	$custom_credits = trim( (string) apply_filters( 'wmhook_wm_credits_output', '' ) );



/**
 * Requirements check
 */

	if ( '-' === $custom_credits ) {
		return;
	}



?>

<div class="site-footer-area footer-area-site-info">
	<div class="site-info-container">

		<div class="site-info" role="contentinfo">
			<?php if ( empty( $custom_credits ) ) : ?>

				&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<span class="sep"> | </span>
				<?php

				printf(
					esc_html_x( 'Using %1$s %2$s theme.', '1: theme name, 2: linked "WordPress" word.', 'auberge' ),
					'<a href="' . esc_url( wp_get_theme( get_template() )->get( 'ThemeURI' ) ) . '"><strong>' . wp_get_theme( get_template() )->get( 'Name' ) . '</strong></a>',
					'<a href="' . esc_url( __( 'https://wordpress.org/', 'auberge' ) ) . '">WordPress</a>'
				);

				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '<span class="sep"> | </span>' );
				}

				?>
				<span class="sep"> | </span>
				<a href="#top" id="back-to-top" class="back-to-top"><?php esc_html_e( 'Back to top &uarr;', 'auberge' ); ?></a>

			<?php else : ?>

				<?php

				// This is already validated/sanitized when stored in customizer (with wp_kses_post()).
				echo $custom_credits; // WPCS: XSS OK.

				?>

			<?php endif; ?>
		</div>

		<?php get_template_part( 'template-parts/menu', 'social' ); ?>

	</div>
</div>
