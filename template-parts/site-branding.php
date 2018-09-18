<?php
/**
 * Displays header site branding
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.5.0
 * @version  2.5.0
 */





// Variables

	global $page, $paged;

	$paginated = max( absint( $page ), absint( $paged ) );


?>

<div class="site-branding">

	<?php the_custom_logo(); ?>

	<div class="site-branding-text">
		<?php

		if ( is_front_page() ) :
			if ( 1 < $paginated ) :
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title-text" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<?php
			else :
				?>
				<h1 class="site-title site-title-text"><?php bloginfo( 'name' ); ?></h1>
				<?php
			endif;
		else :
			?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title-text" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
			<?php
		endif;

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
		endif;

		?>
	</div>

</div>
