<?php
/**
 * Admin "Welcome" page content component
 *
 * Demo content installation.
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

<div class="wm-notes special">

	<h2 class="mt0"><strong><?php esc_html_e( 'Installing the theme demo content', 'auberge' ); ?></strong></h2>

	<p>
		<?php esc_html_e( 'You can install the theme demo content including pages, posts, custom post types, layouts, menus and widgets directly from your WordPress dashboard by clicking the button bellow.', 'auberge' ); ?>
	</p>

	<p>
		<?php esc_html_e( 'Alternatively (such as when the automated installation fails) you can follow theme documentation instructions for manual demo content installation.', 'auberge' ); ?>
		<a href="https://webmandesign.github.io/docs/auberge/#demo-content" target="_blank"><?php esc_html_e( 'Read the instructions &raquo;', 'auberge' ); ?></a>
	</p>

	<?php if ( ! ( class_exists( 'OCDI_Plugin' ) || class_exists( 'PT_One_Click_Demo_Import' ) ) ) : ?>

		<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-hero"><strong><?php esc_html_e( 'Install and run "One Click Demo Import" plugin', 'auberge' ); ?></strong></a>

	<?php else : ?>

		<a href="<?php echo esc_url( 'themes.php?page=pt-one-click-demo-import' ); ?>" class="button button-hero button-primary"><strong><?php esc_html_e( 'Install theme demo content', 'auberge' ); ?></strong></a>

		<br>
		<small><em>
			<?php esc_html_e( 'Or head over to Appearance &raquo; Import Demo Data to start the import process.', 'auberge' ); ?>
		</em></small>

	<?php endif; ?>

</div>
