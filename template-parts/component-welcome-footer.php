<?php
/**
 * Admin "Welcome" page content component
 *
 * Footer.
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

</div> <!-- /.welcome-content -->

<p>
	<?php echo Auberge_Welcome::get_info_support(); ?>
	<br>
	<?php echo Auberge_Welcome::get_info_like(); ?>
</p>

<p><small><em><?php esc_html_e( 'You can disable this page in Appearance &raquo; Customize &raquo; Theme Options &raquo; Others.', 'auberge' ); ?></em></small></p>
