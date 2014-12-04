<?php
/**
 * Skinning System
 *
 * Customizer custom HTML.
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * Custom HTML (set as label)
 */
class WM_Customizer_HTML extends WP_Customize_Control {

	public function render_content() {
		echo $this->label;
	}

} // /WM_Customizer_HTML

?>