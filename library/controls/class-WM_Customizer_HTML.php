<?php
/**
 * Customizer custom controls
 *
 * Customizer custom HTML.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 * @version  2.6.0
 */





class WM_Customizer_HTML extends WP_Customize_Control {

	public $type = 'html';

	public $content = '';

	public function render_content() {
		if ( isset( $this->label ) && ! empty( $this->label ) ) {
			echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( isset( $this->content ) ) {
			echo wp_kses_post( $this->content );
		} else {
			esc_html_e( 'Please set the `content` parameter for the HTML control.', 'auberge' );
		}

		if ( isset( $this->description ) && ! empty( $this->description ) ) {
			echo '<span class="description customize-control-description">' . wp_kses_post( $this->description ) . '</span>';
		}
	}

} // /WM_Customizer_HTML
