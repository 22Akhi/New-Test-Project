<?php
/**
 * Displays header site branding
 *
 * @package Radiant Business
 */

$radiant_business_enable = radiant_business_gtm( 'radiant_business_header_image_visibility' );

if ( radiant_business_display_section( $radiant_business_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php radiant_business_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
