<?php
/**
 * Plugin integration
 *
 * Advanced Custom Fields
 *
 * @link  https://wordpress.org/plugins/advanced-custom-fields/
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.5.4
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! function_exists( 'acf_add_local_field_group' ) || ! is_admin() ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	/**
	 * Add custom metaboxes
	 *
	 * @link  https://www.advancedcustomfields.com/resources/register-fields-via-php/
	 *
	 * @since    2.0
	 * @version  2.5.4
	 */
	function wm_acf_register_field_group() {

		// Processing

			// Register metabox: Menu page template

				acf_add_local_field_group( array(
					'id'     => 'wm_page_template_menu',
					'title'  => esc_html__( 'Food menu page template options', 'auberge' ),
					'fields' => array(

						array(
							'key'             => 'wm_food_menu_section',
							'label'           => esc_html__( 'Food menu section', 'auberge' ),
							'name'            => 'food_menu_section',
							'type'            => 'taxonomy',
							'instructions'    => esc_html__( 'Set this if you want to display a specific food menu section on the page.', 'auberge' ),
							'default_value'   => '',
							'taxonomy'        => 'nova_menu',
							'field_type'      => 'select',
							'allow_null'      => 1,
							'load_save_terms' => 0,
							'return_format'   => 'id',
							'multiple'        => 0,
						),

					),
					'location' => array(

						array(

							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'page',
							),

							array(
								'param'    => 'page_template',
								'operator' => '==',
								'value'    => 'page-template/_menu.php',
							),

						),

					),
					'menu_order'     => 0,
					'position'       => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'          => 'default',
				) );



			// Register metabox: Quote post format

				acf_add_local_field_group( array(
					'id'     => 'wm_post_format_quote',
					'title'  => esc_html__( 'Quote post format options', 'auberge' ),
					'fields' => array(

						array(
							'key'           => 'wm_quote_source',
							'label'         => esc_html__( 'Quote source', 'auberge' ),
							'name'          => 'quote_source',
							'type'          => 'text',
							'instructions'  => esc_html__( 'In case you have not provided the quote source in using the "cite" HTML tag in post content, you can set it here.', 'auberge' ),
							'default_value' => '',
							'placeholder'   => esc_html__( 'John Doe', 'auberge' ),
							'prepend'       => '',
							'append'        => '',
							'formatting'    => 'none',
							'maxlength'     => '',
						),

					),
					'location' => array(

						array(

							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'post',
							),

							array(
								'param'    => 'post_format',
								'operator' => '==',
								'value'    => 'quote',
							),

						),

					),
					'menu_order' => 0,
					'position'   => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'      => 'default',
				) );



			// Register metabox: Front page

				acf_add_local_field_group( array(
					'id'     => 'wm_page_front',
					'title'  => esc_html__( 'Front page options', 'auberge' ),
					'fields' => array(

						array(
							'key'           => 'wm_banner_text',
							'label'         => esc_html__( 'Banner text', 'auberge' ),
							'name'          => 'banner_text',
							'type'          => 'text',
							'instructions'  => esc_html__( 'This text will override the default text displayed in your website front page banner.', 'auberge' ),
							'default_value' => '',
							'placeholder'   => '',
							'prepend'       => '',
							'append'        => '',
							'formatting'    => 'none',
							'maxlength'     => '',
						),

					),
					'location' => array(

						array(

							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'page',
							),

							array(
								'param'    => 'page_type',
								'operator' => '==',
								'value'    => 'front_page',
							),

						),

					),
					'menu_order' => 0,
					'position'   => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'      => 'default',
				) );



			// Register metabox: Featured post

				acf_add_local_field_group( array(
					'id'     => 'wm_post_featured',
					'title'  => esc_html__( 'Featured post options', 'auberge' ),
					'fields' => array(

						array(
							'key'           => 'wm_banner_text',
							'label'         => esc_html__( 'Banner text', 'auberge' ),
							'name'          => 'banner_text',
							'type'          => 'text',
							'instructions'  => esc_html__( 'This text will override the default text displayed in your website front page banner.', 'auberge' ),
							'default_value' => '',
							'placeholder'   => '',
							'prepend'       => '',
							'append'        => '',
							'formatting'    => 'none',
							'maxlength'     => '',
						),

					),
					'location' => array(

						array(

							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'post',
							),

						),

					),
					'menu_order' => 1,
					'position'   => ( function_exists( 'has_blocks' ) ) ? ( 'side' ) : ( 'normal' ),
					'style'      => 'default',
				) );

	} // /wm_acf_register_field_group

	add_action( 'init', 'wm_acf_register_field_group', 100 );
