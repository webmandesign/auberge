<?php
/**
 * Skinning System
 *
 * Customizer textarea field.
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */



/**
 * Textarea
 */
class WM_Customizer_Textarea extends WP_Customize_Control {

	public $type = 'textarea';

	public function render_content() {
		?>

		<label>
			<span class="customize-control-title"><?php echo $this->label; ?></span>
			<?php if ( $this->description ) : ?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php endif; ?>
			<textarea name="<?php echo $this->id; ?>" cols="20" rows="4" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>

		<?php
	}

} // /WM_Customizer_Textarea

?>