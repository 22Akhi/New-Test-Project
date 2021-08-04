<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package JetBlack
 */

class Radiant_Business_Light_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ), 100 );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_header_style'            => 'header-five',
			'radiant_business_header_top_color_scheme' => 'dark-top-header', 
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Image_Radio_Button_Custom_Control',
				'settings'          => 'radiant_business_header_style',
				'sanitize_callback' => 'radiant_business_radio_sanitization',
				'label'             => esc_html__( 'Header Style', 'radiant-business-light' ),
				'section'           => 'radiant_business_header_options',
				'choices'           => array(
					'header-five'   => array(
						'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/header-5.png',
						'name'  => esc_html__( 'Header Style Default', 'radiant-business-light' ),
					),
					'header-one'   => array(
						'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/header-1.png',
						'name'  => esc_html__( 'Header Style - Parent Theme', 'radiant-business-light' ),
					),
				),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'radio',
				'settings'          => 'radiant_business_header_top_color_scheme',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Header Top Color', 'radiant-business-light' ),
				'section'           => 'radiant_business_header_options',
				'choices'           => array(
					'dark-top-header'  => esc_html__( 'Dark', 'radiant-business-light' ),
					'light-top-header' => esc_html__( 'Light', 'radiant-business-light' ),
				),
			)
		);
	}
}

/**
 * Initialize class
 */
$radiant_business_light_header_options = new Radiant_Business_Light_Header_Options();
