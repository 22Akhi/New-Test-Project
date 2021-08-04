<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$team_args = radiant_business_get_section_args( 'team' );

$radiant_business_loop = new WP_Query( $team_args );

if ( $radiant_business_loop->have_posts() ) :
	?>
	<div class="teams-section">
		<div class="inner-wrapper">
		<?php

		while ( $radiant_business_loop->have_posts() ) :
			$radiant_business_loop->the_post();
			?>
			<!-- .team-item  -->
			<div class="ff-grid-4 team-item">
				<div class="thumb-summary-wrap">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="team-thumb">
						<a class="image-hover-zoom" href="<?php the_permalink(); ?>" >
							<?php the_post_thumbnail( 'radiant-business-portfolio' ); ?>
						</a>
						<div class="team-social-icons">
						<?php
						$social_icons = radiant_business_gtm( 'radiant_business_team_custom_social_' . $radiant_business_loop->current_post );

						if ( $social_icons ) : ?>
						<div class="social-nav brand-bg">
							<ul>
							<?php foreach ( explode( ',', $social_icons ) as $social_icon  ): ?>
								<li><a href="<?php echo esc_url( $social_icon ); ?>" target="_blank"></a></li>
							<?php endforeach; ?>
							</ul>
						</div><!-- .social-nav -->
						<?php endif; ?>
					</div>
					</div><!-- .team-thumb-->
					<?php endif; ?>

					<div class="team-text-wrap">
						<?php the_title( '<h3 class="team-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>


					</div><!-- .team-text-wrap -->
				</div><!-- .team-block-inner -->
			</div><!-- .team-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .inner-wrapper -->
	</div><!-- .teams-section -->
<?php
endif;

wp_reset_postdata();
