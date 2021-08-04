<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Radiant Business
 */

$radiant_business_enable = radiant_business_gtm( 'radiant_business_hero_content_visibility' );

if ( ! radiant_business_display_section( $radiant_business_enable ) ) {
	return;
}

get_template_part( 'template-parts/hero-content/content-hero' );
