<?php
/**
 * Website footer template
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



	if ( ! apply_filters( 'wmhook_disable_footer', false ) ) {

		/**
		 * Content
		 */

			wmhook_content_bottom();

			wmhook_content_after();



		/**
		 * Footer
		 */

			wmhook_footer_before();

			wmhook_footer_top();

			wmhook_footer();

			wmhook_footer_bottom();

			wmhook_footer_after();

	} // /wmhook_disable_footer



	/**
	 * Body and WordPress footer
	 */

		wmhook_body_bottom();

		wp_footer();

?>

</body>

</html>