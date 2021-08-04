<?php
/**
 * Header Search
 *
 * @package Radiant Business
 */

$radiant_business_phone      = radiant_business_gtm( 'radiant_business_header_phone' );
$radiant_business_email      = radiant_business_gtm( 'radiant_business_header_email' );
$radiant_business_address    = radiant_business_gtm( 'radiant_business_header_address' );
$radiant_business_open_hours = radiant_business_gtm( 'radiant_business_header_open_hours' );

if ( $radiant_business_phone || $radiant_business_email || $radiant_business_address || $radiant_business_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $radiant_business_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'radiant-business' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $radiant_business_phone ) ); ?>"><?php echo esc_html( $radiant_business_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $radiant_business_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'radiant-business' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $radiant_business_email ) ) ); ?>"><?php echo esc_html( antispambot( $radiant_business_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $radiant_business_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'radiant-business' ); ?></span><?php echo esc_html( $radiant_business_address ); ?></li>
			<?php endif; ?>

			<?php if ( $radiant_business_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'radiant-business' ); ?></span><?php echo esc_html( $radiant_business_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

