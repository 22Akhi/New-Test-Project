<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radiant Business
 */

$radiant_business_visibility = radiant_business_gtm( 'radiant_business_key_features_visibility' );

if ( ! radiant_business_display_section( $radiant_business_visibility ) ) {
	return;
}

$main_image = radiant_business_gtm( 'radiant_business_key_features_main_image' );
?>
<div id="key-features-section" class="section key-features-section style-one" <?php echo $main_image ? 'style="background-image: url( ' . esc_url( $main_image ) . ' )"' : ''; ?>>
	<div class="container">
		<?php
		$radiant_business_type = radiant_business_gtm( 'radiant_business_key_features_type' );

		get_template_part( 'template-parts/key-features/post-type-style-1' );
		?>
	</div><!-- .container -->
</div><!-- .section -->
