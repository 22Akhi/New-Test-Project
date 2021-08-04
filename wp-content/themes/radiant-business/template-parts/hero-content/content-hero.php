<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Radiant Business
 */
if ( radiant_business_gtm( 'radiant_business_hero_content_page' ) ) {
	$radiant_business_args = array(
		'page_id'        => absint( radiant_business_gtm( 'radiant_business_hero_content_page' ) ),
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

	$radiant_business_subtitle = radiant_business_gtm( 'radiant_business_hero_content_custom_subtitle' );
	?>

	<div id="hero-content-section" class="hero-content-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<div class="featured-page-thumb-wrap">
							<?php the_post_thumbnail( 'radiant-business-hero', array( 'class' => 'alignnone' ) );?>
						</div>
					</div>
					<?php endif; ?>

					<!-- .ff-grid-6 -->
					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap">
								<?php if ( $radiant_business_subtitle ) : ?>
								<p class="section-top-subtitle"><?php echo esc_html( $radiant_business_subtitle ); ?></p>
								<?php endif; ?>

								<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

								<span class="divider"></span>
							</div>

							<?php radiant_business_display_content( 'hero_content' ); ?>
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
