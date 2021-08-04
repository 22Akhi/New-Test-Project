<?php
/**
 * Site Top Bar for mobile
 *
 * @package Radiant Business
 */

$radiant_business_phone      = radiant_business_gtm( 'radiant_business_header_phone' );
$radiant_business_email      = radiant_business_gtm( 'radiant_business_header_email' );
$radiant_business_address    = radiant_business_gtm( 'radiant_business_header_address' );
$radiant_business_open_hours = radiant_business_gtm( 'radiant_business_header_open_hours' );
?>
<div class="site-top-header-mobile clear-fix">
	<div class="container">
		<div id="main-nav-mobile" class="pull-left mobile-on">
			<?php get_template_part( 'template-parts/navigation/navigation-primary-mobile' ); ?>
		</div><!-- .main-nav -->

		<div class="top-header-toggle-main pull-right">
			<div class="head-search-cart-wrap mobile-on pull-left">
				<?php get_template_part( 'template-parts/header/header-search' ); ?>

				<?php if ( function_exists( 'radiant_business_woocommerce_header_cart' ) ) : ?>
				<div class="cart-contents pull-left">
					<?php radiant_business_woocommerce_header_cart(); ?>
				</div>
				<?php endif; ?>
			</div><!-- .head-search-cart-wrap -->

			<?php if ( $radiant_business_phone || $radiant_business_email || $radiant_business_address || $radiant_business_open_hours || has_nav_menu( 'social' )  ) : ?>
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'radiant-business' ); ?></span>
				</button><!-- #header-top-toggle -->

				<div id="site-top-header-mobile-container">
					<?php if ( $radiant_business_phone || $radiant_business_email || $radiant_business_address || $radiant_business_open_hours ) : ?>
					<div id="quick-contact">
						<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
					<div id="top-social">
						<div class="social-nav no-border circle-icon">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'radiant-business' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>
				</div><!-- #site-top-header-mobile-container-->
			<?php endif; ?>
		</div> <!-- .top-header-toggle-wrapper -->
	</div><!-- .container -->
</div><!-- .site-top-header-mobile -->
