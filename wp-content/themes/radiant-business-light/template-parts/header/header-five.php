<?php
/**
 * Header Five Style Template
 *
 * @package Radiant Business
 */
$radiant_business_header_top_text = radiant_business_gtm( 'radiant_business_header_top_text' );
$radiant_business_phone      = radiant_business_gtm( 'radiant_business_header_phone' );
$radiant_business_email      = radiant_business_gtm( 'radiant_business_header_email' );
$radiant_business_address    = radiant_business_gtm( 'radiant_business_header_address' );
$radiant_business_open_hours = radiant_business_gtm( 'radiant_business_header_open_hours' );

$radiant_business_button_text   = radiant_business_gtm( 'radiant_business_header_button_text' );
$radiant_business_button_link   = radiant_business_gtm( 'radiant_business_header_button_link' );
$radiant_business_button_target = radiant_business_gtm( 'radiant_business_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-five<?php echo ! $radiant_business_button_text ? ' button-disabled' : ''; ?>">
	<div id="top-header" class="main-top-header-five <?php echo esc_attr( radiant_business_gtm( 'radiant_business_header_top_color_scheme' ) ); ?>">
		<?php if ( $radiant_business_header_top_text ) : ?>
			<div id="quick-info" class="mobile-on">
            	<p><?php echo esc_html( $radiant_business_header_top_text ); ?></p>
			</div>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/header/mobile-header-top' ); ?>

		<div class="site-top-header">
			<div class="container">
				<?php if ( $radiant_business_header_top_text ) : ?>
				<div id="quick-info" class="pull-left">
                	<p><?php echo esc_html( $radiant_business_header_top_text ); ?></p>
				</div>
				<?php endif; ?>
				<?php if ( $radiant_business_phone || $radiant_business_email || $radiant_business_address || $radiant_business_open_hours ) : ?>
				<div id="quick-contact" class="pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div>
				<?php endif; ?>

				<div class="top-head-right pull-right">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
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
						</div><!-- .social-nav -->
					</div><!-- #top-social -->
					<?php endif; ?>

					<?php if ( $radiant_business_button_text ) : ?>
					<a target="<?php echo esc_attr( $radiant_business_button_target );?>" href="<?php echo esc_url( $radiant_business_button_link );?>" class="ff-button header-button  pull-right"><?php echo esc_html( $radiant_business_button_text );?></a>
					<?php endif; ?>
				</div><!-- .top-head-right -->
			</div><!-- .container -->
		</div><!-- .site-top-header -->
	</div><!-- #top-header -->

	<header id="masthead" class="site-header main-header-five clear-fix<?php echo radiant_business_gtm( 'radiant_business_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->
				<?php if ( $radiant_business_button_text ) : ?>
					<a target="<?php echo esc_attr( $radiant_business_button_target );?>" href="<?php echo esc_url( $radiant_business_button_link );?>" class="ff-button mobile-on header-button  pull-right"><?php echo esc_html( $radiant_business_button_text );?></a>
				<?php endif; ?>
				<div class="right-head mobile-off pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div><!-- .main-nav -->

	                <div class="right-head-info pull-right">
						<div class="head-search-cart-wrap pull-left">
							<?php if ( function_exists( 'radiant_business_woocommerce_header_cart' ) ) : ?>
							<div class="cart-contents pull-left">
								<?php radiant_business_woocommerce_header_cart(); ?>
							</div>
							<?php endif; ?>

							<?php get_template_part( 'template-parts/header/header-search' ); ?>
						</div><!-- .head-search-cart-wrap -->

						<?php if ( $radiant_business_phone ) : ?>
						<div class="mobile-off no-margin pull-left">
							<div class="contact-wrapper">
								<div class="contact-icon pull-left"><i class="fas fa-comments-dollar"></i></div><!-- .contact-icon -->

								<div class="header-info">
									<h5><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $radiant_business_phone ) ); ?>"><?php echo esc_html( $radiant_business_phone ); ?></a></h5>
									<span><?php esc_html_e( 'Have any Questions?', 'radiant-business' ); ?></span>
		                    	</div><!-- .header-info -->
			                </div><!-- .contact-wrapper -->
						</div><!-- .mobile-off.ff-grid-2.no-margin -->
						<?php endif; ?>
					</div><!-- .right-head-info -->
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div><!-- .header-wrapper -->
