<?php
/**
 * Featured Content Options
 *
 * @package Radiant Business
 */

class Radiant_Business_Featured_Content_Options {
	public function __construct() {
		// Register Featured Content Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_featured_content_visibility'  => 'disabled',
			'radiant_business_featured_content_number'      => 3,
			'radiant_business_featured_content_button_link' => '#',
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
				'settings'          => 'radiant_business_featured_content_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'choices'           => Radiant_Business_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'radiant_business_featured_content_visibility', array(
			'selector' => '#featured-content-section',
		) );


		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'settings'          => 'radiant_business_featured_content_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_featured_content_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_featured_content_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_featured_content_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'radiant-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		$numbers = radiant_business_gtm( 'radiant_business_featured_content_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Radiant_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'radiant_business_featured_content_page_' . $i,
					'label'             => esc_html__( 'Page', 'radiant-business' ) . ' ' . $j,
					'section'           => 'radiant_business_ss_featured_content',
					'active_callback'   => array( $this, 'is_section_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'settings'          => 'radiant_business_featured_content_button_text',
				'label'             => esc_html__( 'Button Text', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'radiant_business_featured_content_button_link',
				'label'             => esc_html__( 'Button Link', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_featured_content_button_target',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'radiant-business' ),
				'section'           => 'radiant_business_ss_featured_content',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);
	}

	/**
	 * Featured Content visibility active callback.
	 */
	public function is_section_visible( $control ) {
		return ( radiant_business_display_section( $control->manager->get_setting( 'radiant_business_featured_content_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$radiant_business_ss_featured_content = new Radiant_Business_Featured_Content_Options();
