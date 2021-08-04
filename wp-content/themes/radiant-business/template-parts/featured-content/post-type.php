<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_args = radiant_business_get_section_args( 'featured_content' );

$radiant_business_loop = new WP_Query( $radiant_business_args );

if ( $radiant_business_loop->have_posts() ) :
	?>
	<div class="featured-content-block-list">
		<div class="row">
			<?php
			while ( $radiant_business_loop->have_posts() ) :
				$radiant_business_loop->the_post();
				?>
				<div class="latest-posts-item ff-grid-4">
					<div class="latest-posts-wrapper inner-block-shadow">
						<?php
						$radiant_business_cats = radiant_business_get_featured_content_cats();

						if ( has_post_thumbnail() || $radiant_business_cats ) : ?>
						<div class="latest-posts-thumb">
							<?php if ( has_post_thumbnail() ) : ?>
							<a class="image-hover-zoom" href="<?php the_permalink(); ?>" >
								<?php the_post_thumbnail(); ?>
							</a>
							<?php endif; ?>

								<?php
								if ( $radiant_business_cats ) {
									echo $radiant_business_cats;
								}
								?>
						</div><!-- latest-posts-thumb  -->
						<?php endif; ?>

						<div class="latest-posts-text-content-wrapper">
							<div class="latest-posts-text-content">
								<?php the_title( '<h3 class="latest-posts-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
								
								<?php radiant_business_featured_content_meta();  ?>

								<?php radiant_business_display_content( 'featured_content' ); ?>
							</div><!-- .latest-posts-text-content -->
						</div><!-- .latest-posts-text-content-wrapper -->
					</div><!-- .latest-posts-wrapper -->
				</div><!-- .latest-posts-item -->
			<?php endwhile; ?>
		</div><!-- .row -->
	</div><!-- .featured-content-block-list -->
<?php
endif;

wp_reset_postdata();
