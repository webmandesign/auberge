<?php
/**
 * Skinning System
 *
 * Customizer image insert.
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * Add uploaded images tab to Image control
 */
class WM_Customizer_Image extends WP_Customize_Image_Control {

	/**
	 * Adding an .ico into supported image file formats
	 */
	public $extensions = array( 'ico', 'jpg', 'jpeg', 'gif', 'png' );

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Search for images within the defined context
	 */
	public function tab_uploaded() {
		$wm_context_uploads = get_posts( array(
				'post_type'  => 'attachment',
				'meta_key'   => '_wp_attachment_context',
				'meta_value' => $this->context,
				'orderby'    => 'post_date',
				'nopaging'   => true,
			) );
		?>

		<div class="uploaded-target"></div>

		<?php
		if ( empty( $wm_context_uploads ) ) {
			return;
		}

		foreach ( (array) $wm_context_uploads as $wm_context_upload ) {
			$this->print_tab_image( esc_url_raw( $wm_context_upload->guid ) );
		}
	}

} // /WM_Customizer_Image

?>