<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_promotional_headline_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}

if ( 'custom-pages' === $radiant_business_visibility ) {
	// Bail if custom pages is selected, and current page is not in list.
	if (  ! in_array( get_the_ID(), explode( ',', radiant_business_gtm( 'radiant_business_promotional_headline_custom_pages' ) ) ) ) {
		return;
	}
}

$hero_type = radiant_business_gtm( 'radiant_business_promotional_headline_type' );

if ( 'custom' === $hero_type ) {
	get_template_part( 'template-parts/promotional-headline/custom-type' );
} else {
	get_template_part( 'template-parts/promotional-headline/post-type' );
}
