<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Radiant Business
 */

class Radiant_Business_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );

		// Add default options.
		add_filter( 'radiant_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'radiant_business_header_image_visibility' => 'entire-site',

			// Breadcrumb
			'radiant_business_breadcrumb_show' => 1,

			// Layout Options.
			'radiant_business_default_layout'          => 'right-sidebar',
			'radiant_business_homepage_archive_layout' => 'no-sidebar-full-width',
			'radiant_business_woocommerce_layout'      => 'no-sidebar-full-width',

			// Excerpt Options
			'radiant_business_excerpt_length'    => 30,
			'radiant_business_excerpt_more_text' => esc_html__( 'Continue reading', 'radiant-business' ),

			// Footer Options.
			'radiant_business_footer_color_scheme'      => 'footer-color-scheme-dark',
			'radiant_business_footer_editor_style'      => 'one-column',
			'radiant_business_footer_editor_text'       => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'radiant-business' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html__( 'Radiant Business by', 'radiant-business' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',
			'radiant_business_footer_editor_text_left'  => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'radiant-business' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ),
			'radiant_business_footer_editor_text_right' => esc_html__( 'Radiant Business by', 'radiant-business' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',

			// Homepage/Frontpage Options.
			'radiant_business_front_page_category'   => '',
			'radiant_business_show_homepage_content' => 1,

			// Search Options.
			'radiant_business_search_text'         => esc_html__( 'Search...', 'radiant-business' ),
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'radiant_business_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'radiant-business' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'radiant_business_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'radiant-business' ),
				'panel' => 'radiant_business_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Radiant_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Radiant_Business_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'radiant-business' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'radiant-business' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_breadcrumb_show',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'radiant-business' ),
				'section'           => 'radiant_business_breadcrumb_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_breadcrumb_show_home',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Show on homepage?', 'radiant-business' ),
				'section'           => 'radiant_business_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'radiant_business_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'radiant-business' ),
				'panel' => 'radiant_business_theme_options'
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'radiant_business_default_layout',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'radiant-business' ),
				'section'           => 'radiant_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'radiant-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'radiant-business' ),
				),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'radiant_business_homepage_archive_layout',
				'sanitize_callback' => 'radiant_business_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'radiant-business' ),
				'section'           => 'radiant_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'radiant-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'radiant-business' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'radiant_business_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'radiant-business' ),
				'panel' => 'radiant_business_theme_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'radiant_business_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'radiant-business' ),
				'section'           => 'radiant_business_excerpt_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'radiant_business_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'radiant-business' ),
				'section'           => 'radiant_business_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'settings'          => 'radiant_business_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'radiant-business' ),
				'label'             => esc_html__( 'Categories', 'radiant-business' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'radiant-business' ) => Radiant_Business_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Radiant_Business_Toggle_Switch_Custom_control',
				'settings'          => 'radiant_business_show_homepage_content',
				'sanitize_callback' => 'radiant_business_switch_sanitization',
				'label'             => esc_html__( 'Show Home Content/Blog', 'radiant-business' ),
				'section'           => 'static_front_page',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'radiant_business_search',
			array(
				'title' => esc_html__( 'Search', 'radiant-business' ),
				'panel' => 'radiant_business_theme_options',
			)
		);

		Radiant_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'radiant_business_search_text',
				'sanitize_callback' => 'radiant_business_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'radiant-business' ),
				'section'           => 'radiant_business_search',
				'type'              => 'text',
			)
		);
	}
}

/**
 * Initialize class
 */
$radiant_business_theme_options = new Radiant_Business_Theme_Options();
