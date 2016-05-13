<?php
/**
 * Default WordPress posts loop
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





// Helper variables

	$auberge_list_type = ( is_archive() && is_tax( 'nova_menu' ) ) ? ( 'items' ) : ( 'posts' );



if ( have_posts() ) :

	do_action( 'wmhook_postslist_before' );

	?>

	<div id="<?php echo esc_attr( $auberge_list_type ); ?>" class="<?php echo esc_attr( $auberge_list_type ); ?> <?php echo esc_attr( $auberge_list_type ); ?>-list clearfix"<?php echo wm_schema_org( 'ItemList' ); ?>>

		<?php

		do_action( 'tha_content_while_before' );

		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 *
			 * Or, you can use the filter hook below to modify which content file to load.
			 */
			get_template_part( 'template-parts/content', apply_filters( 'wmhook_loop_content_type', get_post_format() ) );

		endwhile;

		do_action( 'tha_content_while_after' );

		?>

	</div>

	<?php

	do_action( 'wmhook_postslist_after' );

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
