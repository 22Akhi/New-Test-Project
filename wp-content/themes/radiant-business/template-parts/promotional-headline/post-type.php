<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Radiant Business
 */
$promotional_headline_type = radiant_business_gtm( 'radiant_business_promotional_headline_type' );

if ( radiant_business_gtm( 'radiant_business_promotional_headline_page' ) ) {
	$radiant_business_args = array(
		'page_id'        => absint( radiant_business_gtm( 'radiant_business_promotional_headline_page' ) ),
		'posts_per_page' => 1,
	);
}

// If $radiant_business_args is empty return false
if ( empty( $radiant_business_args ) ) {
	return;
}

$radiant_business_loop = new WP_Query( $radiant_business_args );

while ( $radiant_business_loop->have_posts() ) :
	$radiant_business_loop->the_post();

	$overlay       = radiant_business_gtm( 'radiant_business_promotional_headline_overlay' ) ? ' overlay-enabled' : '';
	?>

	<div id="promotional-headline-section" class="section promotional-headline-section text-aligncenter overlay-enabled" <?php echo has_post_thumbnail() ? 'style="background-image: url( ' .esc_url( get_the_post_thumbnail_url() ) . ' )"' : ''; ?>>
	<div class="promotion-inner-wrapper section-promotion">
		<div class="container">
			<div class="promotion-content">
				<div class="promotion-description">
					<?php the_title( '<h2>', '</h2>' ); ?>

					<?php radiant_business_display_content( 'promotional_headline' ); ?>
				</div><!-- .promotion-description -->
			</div><!-- .promotion-content -->
		</div><!-- .container -->
	</div><!-- .promotion-inner-wrapper" -->
</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
