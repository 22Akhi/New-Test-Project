<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

?>
<div class="key-features-wrapper">
	<div class="key-features-wrapper-style-one clear-fix">
		<?php
		$radiant_business_key_features_args = radiant_business_get_section_args( 'key_features' );

		$radiant_business_loop = new WP_Query( $radiant_business_key_features_args );

		if ( $radiant_business_loop->have_posts() ) : ?>
		<div class="key-features-items ff-grid-6 no-padding pull-right no-margin">
			<div class="key-feature-item-wrraper">
						<?php radiant_business_section_title( 'key_features' ); ?>
			<?php
			while ( $radiant_business_loop->have_posts() ) :
				$radiant_business_loop->the_post();

				$count = absint( $radiant_business_loop->current_post );

				$icon  = radiant_business_gtm( 'radiant_business_key_features_icon_' . $count );
				?>
				<div class="icon-left">
					<div class="key-features-block-inner">
						<?php if ( $icon ) : ?>
							<a class="key-features-icon" href="<?php the_permalink(); ?>" >
								<i class="<?php echo esc_attr( $icon ); ?>"></i>
							</a>
						<?php endif; ?>

						<div class="key-features-block-inner-content">
							<?php the_title( '<h3 class="key-features-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

							<?php radiant_business_display_content( 'key_features' ); ?>
						</div><!-- .key-features-block-inner-content -->
					</div><!-- .key-features-block-inner -->
				</div><!-- .ff-grid-6 -->
				<?php
			endwhile;
			?>
		</div>
		</div><!-- .key-features-items -->
		<?php
		endif;

		wp_reset_postdata();
		?>
	</div><!-- .row -->
</div><!-- .key-features-wrapper -->

