<?php
/**
 * WWD Options
 *
 * @package Radiant Business
 */

class Radiant_Business_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'radiant_business_wwd_visibility' => 'disabled',
			'radiant_business_wwd_number'     => 4,
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
				'settings'          => 'radiant_business_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'choices'           => Radiant_Business_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'radiant_business_wwd_visibility', array(
			'selector' => '#wwd-section',
		) );

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'settings'          => 'radiant_business_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_wwd_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'WP_Customize_Image_Control',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'radiant_business_wwd_bg_image',
				'label'             => esc_html__( 'Background Image', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'radiant-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_wwd_display_feat_image',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Display Featured Image/Post Thumbnail', 'radiant-business' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'radiant_business_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'radiant-business' ),
				'description'       =>  sprintf( esc_html__( 'Icon takes Priority Over Image. If you want camera icon, save "fas fa-camera". For more classs, check %1$sthis%2$s. ', 'radiant-business' ), '<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">', '</a>' ),
				'section'           => 'radiant_business_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = radiant_business_gtm( 'radiant_business_wwd_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Radiant_Business_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'radiant_business_text_sanitization',
					'settings'          => 'radiant_business_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'radiant-business' )  . $j,
					'section'           => 'radiant_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Radiant_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'radiant_business_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'radiant-business' ),
					'section'           => 'radiant_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);

			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'radiant_business_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'radiant-business' ),
					'section'           => 'radiant_business_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);
		}
	}

	/**
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( radiant_business_display_section( $control->manager->get_setting( 'radiant_business_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$radiant_business_ss_wwd = new Radiant_Business_WWD_Options();
