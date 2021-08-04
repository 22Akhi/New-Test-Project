<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_featured_content_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}
?>
<div id="featured-content-section" class="section featured-content-section style-one page">
	<div class="section-latest-posts">
		<div class="container">
			<?php radiant_business_section_title( 'featured_content' ); ?>
			<div class="section-carousel-wrapper">
			    <?php get_template_part( 'template-parts/featured-content/post-type' ); ?>

				<?php
				$radiant_business_button_text   = radiant_business_gtm( 'radiant_business_featured_content_button_text' );
				$radiant_business_button_link   = radiant_business_gtm( 'radiant_business_featured_content_button_link' );
				$radiant_business_button_target = radiant_business_gtm( 'radiant_business_featured_content_button_target' ) ? '_blank' : '_self';

				if ( $radiant_business_button_text ) : ?>
					<div class="more-wrapper clear-fix">
						<a href="<?php echo esc_url( $radiant_business_button_link ); ?>" class="ff-button" target="<?php echo esc_attr( $radiant_business_button_target ); ?>"><?php echo esc_html( $radiant_business_button_text ); ?></a>
					</div><!-- .more-wrapper -->
				<?php endif; ?>
			</div>
		</div><!-- .container -->
	</div><!-- .latest-posts-section -->
</div><!-- .section-latest-posts -->

