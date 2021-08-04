<?php
/**
 * Promotional Headline Options
 *
 * @package Radiant Business
 */

class Radiant_Business_Promotional_Headline_Options {
	public function __construct() {
		// Register Promotion Headline Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_promotional_headline_visibility'      => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_promotional_headline_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'radiant-business' ),
				'section'           => 'radiant_business_ss_promotional_headline',
				'choices'           => Radiant_Business_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'radiant_business_pricing_visibility', array(
			'selector' => '#promotional-headline-section',
		) );

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'radiant_business_promotional_headline_page',
				'label'             => esc_html__( 'Select Page', 'radiant-business' ),
				'section'           => 'radiant_business_ss_promotional_headline',
				'active_callback'   => array( $this, 'is_promotional_headline_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);
	}

	/**
	 * Promotion Headline visibility active callback.
	 */
	public function is_promotional_headline_visible( $control ) {
		return ( radiant_business_display_section( $control->manager->get_setting( 'radiant_business_promotional_headline_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$radiant_business_ss_promotional_headline = new Radiant_Business_Promotional_Headline_Options();
