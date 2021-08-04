<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_wwd_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}

$radiant_business_bg_image = radiant_business_gtm( 'radiant_business_wwd_bg_image' );
?>
<div id="wwd-section" class="wwd-section section page style-one" <?php echo $radiant_business_bg_image ? 'style="background-image: url( ' . esc_url( $radiant_business_bg_image ) . ' )"' : ''; ?>>
	<div class="section-wwd">
		<div class="container">
			<?php radiant_business_section_title( 'wwd' ); ?>

			<div class="section-carousel-wrapper">
				<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
			</div>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
