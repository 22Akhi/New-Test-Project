<?php
/**
 * Radiant Business Theme Customizer
 *
 * @package Radiant Business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function radiant_business_sections( $wp_customize ) {
	$wp_customize->add_panel( 'radiant_business_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'radiant-business' ),
		'priority'    => 150,
		'description' => esc_html__( 'Drag and drop sections for their order.', 'radiant-business' ),
	) );

	$default_sections = radiant_business_get_default_sections();

	$sortable_options = array();

	$sortable_order = radiant_business_gtm( 'radiant_business_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sections = array_unique( $sortable_options + array_keys( $default_sections ) );

	foreach ( $sections as $section ) {
		if ( isset( $default_sections[$section] ) ) {
			// Add sections.
			$wp_customize->add_section( 'radiant_business_ss_' . $section,
				array(
					'title' => $default_sections[$section],
					'panel' => 'radiant_business_sp_sortable'
				)
			);
		}

		unset($default_sections[$section]);
	}

	if ( count( $default_sections ) ) {
		foreach ($default_sections as $key => $value) {
			// Add new sections.
			$wp_customize->add_section( 'radiant_business_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'radiant_business_sp_sortable'
				)
			);
		}
	}

	// Add hidden section for saving sorted sections.
	Radiant_Business_Customizer_Utilities::register_option(
		array(
			'settings'          => 'radiant_business_ss_order',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Section layout', 'radiant-business' ),
			'section'           => 'radiant_business_ss_main_content',
		)
	);
}
add_action( 'customize_register', 'radiant_business_sections', 1 );

/**
 * Default sortable sections order
 * @return array
 */
function radiant_business_get_default_sections() {
	return $default_sections = array (
		'slider'               => esc_html__( 'Slider', 'radiant-business' ),
		'hero_content'         => esc_html__( 'Hero Content', 'radiant-business' ),
		'promotional_headline' => esc_html__( 'Promotion Headline', 'radiant-business' ),
		'wwd'                  => esc_html__( 'What We Do', 'radiant-business' ),
		'key_features'         => esc_html__( 'Key Features', 'radiant-business' ),
		'team'                 => esc_html__( 'Team', 'radiant-business' ),
		'featured_content'     => esc_html__( 'Featured Content', 'radiant-business' ),
	);
}
