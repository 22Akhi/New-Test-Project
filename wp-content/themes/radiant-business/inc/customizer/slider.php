<?php
/**
 * Slider Options
 *
 * @package Radiant Business
 */

class Radiant_Business_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_slider_visibility' => 'disabled',
			'radiant_business_slider_number'     => 2,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'radiant-business' ),
				'section'           => 'radiant_business_ss_slider',
				'choices'           => Radiant_Business_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'radiant_business_slider_visibility', array(
			'selector' => '#slider-section',
		) );

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'radiant_business_slider_number',
				'label'             => esc_html__( 'Number', 'radiant-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'radiant-business' ),
				'section'           => 'radiant_business_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = radiant_business_gtm( 'radiant_business_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Radiant_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'radiant_business_slider_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'radiant-business' ) . ' ' . $j,
					'section'           => 'radiant_business_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
					'input_attrs'       => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( radiant_business_display_section( $control->manager->get_setting( 'radiant_business_slider_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$radiant_business_ss_slider = new Radiant_Business_Slider_Options();
