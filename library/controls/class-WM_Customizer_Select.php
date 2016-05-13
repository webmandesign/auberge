<?php
/**
 * Customizer custom controls
 *
 * Customizer select field (with optgroups).
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





class WM_Customizer_Select extends WP_Customize_Control {

	public $type = 'select';

	public function render_content() {
		if ( ! empty( $this->choices ) && is_array( $this->choices ) ) {
			?>

			<label>
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<?php if ( $this->description ) : ?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php endif; ?>
				<select name="<?php echo $this->id; ?>" <?php $this->link(); ?>>

					<?php

					foreach ( $this->choices as $value => $name ) {

						$value = esc_attr( $value );

						if ( 0 === strpos( $value, 'optgroup' ) ) {
							echo '<optgroup label="' . esc_attr( $name ) . '">';
						} elseif ( 0 === strpos( $value, '/optgroup' ) ) {
							echo '</optgroup>';
						} else {
							echo '<option value="' . $value . '" ' . selected( $this->value(), $value, false ) . '>' . $name . '</option>';
						}

					}

					?>

				</select>
			</label>

			<?php
		}
	}

} // /WM_Customizer_Select
