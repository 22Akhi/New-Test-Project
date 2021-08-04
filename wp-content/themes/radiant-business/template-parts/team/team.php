<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_team_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}
?>
<div id="team-section" class="team-section section style-one page">
	<div class="section-teams">
		<div class="container">
			<?php radiant_business_section_title( 'team' ); ?>

			<div class="section-carousel-wrapper">
			<?php get_template_part( 'template-parts/team/post-type' ); ?>
			</div>
		</div><!-- .container -->
	</div><!-- .section-teams  -->
</div><!-- .section -->
