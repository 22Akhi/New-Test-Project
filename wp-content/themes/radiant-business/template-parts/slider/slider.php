<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_slider_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}
?>
<div id="slider-section" class="section style-one zoom-disabled overlay-enabled slider-section no-padding">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->

	<div class="swiper-pagination"></div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div><!-- .main-slider -->
