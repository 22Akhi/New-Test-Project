<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-content-wraper">
		<?php radiant_business_post_thumbnail(); ?>
		
		<div class="entry-content-wrapper">
			<?php
			$radiant_business_enable = radiant_business_gtm( 'radiant_business_header_image_visibility' );

			if ( ! radiant_business_display_section( $radiant_business_enable ) ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-meta">
				<?php radiant_business_entry_header(); ?>
			</div>
			<?php endif;?>
			
			<div class="entry-content">
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'radiant-business' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'radiant-business' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
		</div><!-- .entry-content-wrapper -->
	</div><!-- .single-content-wraper -->
</article><!-- #post-<?php the_ID(); ?> -->
