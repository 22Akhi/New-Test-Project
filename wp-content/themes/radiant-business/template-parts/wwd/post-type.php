<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_wwd_args = radiant_business_get_section_args( 'wwd' );

$radiant_business_loop = new WP_Query( $radiant_business_wwd_args );

if ( $radiant_business_loop->have_posts() ) :
	?>
	<div class="wwd-block-list">
		<div class="row">
		<?php

		while ( $radiant_business_loop->have_posts() ) :
			$radiant_business_loop->the_post();

			$count = absint( $radiant_business_loop->current_post );
			$icon  = radiant_business_gtm( 'radiant_business_wwd_custom_icon_' . $count );
			?>
			<div class="wwd-block-item<?php echo ( radiant_business_gtm( 'radiant_business_wwd_display_feat_image' ) && has_post_thumbnail() ) ? ' featured-image-enabled' : ''; ?> post-type ff-grid-3">
				<div class="featured-background-img" <?php echo ( radiant_business_gtm( 'radiant_business_wwd_display_feat_image' ) && has_post_thumbnail() ) ? 'style="background-image: url( ' .esc_url( get_the_post_thumbnail_url() ) . ' )"' : ''; ?>>
				<div class="wwd-block-wrapper inner-block-shadow" >
					<div class="wwd-block-inner">
						<?php if ( $icon ) : ?>
						<a class="wwd-fonts-icon" href="<?php the_permalink(); ?>" >
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						</a>
						<?php endif; ?>

						<div class="wwd-block-inner-content">
							<?php the_title( '<h3 class="wwd-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

							<?php radiant_business_display_content( 'wwd' ); ?>
						</div><!-- .wwd-block-inner-content -->

					</div><!-- .wwd-block-inner -->
				</div>
				</div><!-- .wwd-block-wrapper -->
			</div><!-- .wwd-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .row -->
	</div><!-- .wwd-block-list -->
<?php
endif;

wp_reset_postdata();
