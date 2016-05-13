<?php
/**
 * Customizer custom controls
 *
 * Customizer multi select field.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





class WM_Customizer_Multiselect extends WP_Customize_Control {

	public $type = 'multiselect';

	public function render_content() {
		if ( ! empty( $this->choices ) && is_array( $this->choices ) ) {
			?>

			<label>
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<?php if ( $this->description ) : ?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php endif; ?>

				<select name="<?php echo $this->id; ?>" multiple="multiple" <?php $this->link(); ?>>

					<?php

					foreach ( $this->choices as $value => $name ) {

						echo '<option value="' . $value . '" ' . selected( $this->value(), $value, false ) . '>' . $name . '</option>';

					}

					?>

				</select>
				<em><?php esc_html_e( 'Press CTRL key for multiple selection.', 'auberge' ); ?></em>
			</label>

			<?php
		}
	}

} // /WM_Customizer_Multiselect
