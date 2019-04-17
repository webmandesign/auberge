<?php
/**
 * Food menu post content
 *
 * The link to single post page will be applied only if the
 * post has some content.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.7.0
 */





/**
 * Requirements check
 */

	if ( ! current_theme_supports( 'nova_menu_item' ) ) {
		return;
	}



/**
 * Helper variables
 */

	$pagination_suffix = wm_paginated_suffix( 'small', 'nova_menu_item' );

	$wrapper_tag = ( is_single( get_the_ID() ) ) ? ( 'div' ) : ( 'aside' );



?>

<?php do_action( 'tha_entry_before' ); ?>

<<?php echo tag_escape( $wrapper_tag ); ?> id="post-<?php the_ID(); ?>" <?php post_class(); echo apply_filters( 'wmhook_entry_container_atts', '' ); ?>>

	<?php do_action( 'tha_entry_top' ); ?>

	<div class="entry-content"<?php echo wm_schema_org( 'entry_body' ); ?>>

		<?php do_action( 'tha_entry_content_before' ); ?>

		<?php

		if ( is_single() ) {
			the_content();
		} else {
			the_excerpt();
		}

		?>

		<?php do_action( 'tha_entry_content_after' ); ?>

	</div>

	<?php do_action( 'tha_entry_bottom' ); ?>

</<?php echo tag_escape( $wrapper_tag ); ?>>

<?php do_action( 'tha_entry_after' ); ?>
