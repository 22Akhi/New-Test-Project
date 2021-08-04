<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Radiant Business
 */

class Radiant_Business_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_header_style'            => 'header-one',
			'radiant_business_header_top_color_scheme' => 'dark-top-header', 
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'radiant_business_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'radiant-business' ),
				'panel' => 'radiant_business_theme_options'
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'radio',
				'settings'          => 'radiant_business_header_top_color_scheme',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Header Top Color', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
				'choices'           => array(
					'dark-top-header'  => esc_html__( 'Dark', 'radiant-business' ),
					'light-top-header' => esc_html__( 'Light', 'radiant-business' ),
				),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_top_text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Text', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_phone',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Phone', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_address',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Address', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_open_hours',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_header_button_text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'radiant_business_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_header_button_target',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'radiant-business' ),
				'section'           => 'radiant_business_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$radiant_business_theme_options = new Radiant_Business_Header_Options();
