<?php
/**
 * Radiant Business functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Radiant Business
 */

/**
 * Returns theme mod value saved for option merging with default option if available.
 * @since 1.0
 */
function radiant_business_gtm( $option ) {
	// Get our Customizer defaults
	$defaults = apply_filters( 'radiant_business_customizer_defaults', true );

	return isset( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );
}

if ( ! function_exists( 'radiant_business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function radiant_business_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Radiant Business, use a find and replace
		 * to change 'radiant-business' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'radiant-business', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in archive content, featured content.
		set_post_thumbnail_size( 825, 620, false );

		// Used in slider.
		add_image_size( 'radiant-business-slider', 1920, 1000, false );

		// Used in hero content.
		add_image_size( 'radiant-business-hero', 600, 650, false );

		// Used in portfolio, team.
		add_image_size( 'radiant-business-portfolio', 400, 450, false );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary Menu', 'radiant-business' ),
			'social' => esc_html__( 'Social Menu', 'radiant-business' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'radiant_business_custom_background_args', array(
			'default-color' => '151c25',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add theme editor style
		add_editor_style( array( 'css/editor-style.css' ) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'radiant_business_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function radiant_business_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'radiant_business_content_width', 1230 );
}
add_action( 'after_setup_theme', 'radiant_business_content_width', 0 );

if ( ! function_exists( 'radiant_business_custom_content_width' ) ) :
	/**
	 * Custom content width.
	 *
	 * @since 1.0
	 */
	function radiant_business_custom_content_width() {
		$layout  = radiant_business_get_theme_layout();

		if ( 'no-sidebar-full-width' !== $layout ) {
			$GLOBALS['content_width'] = apply_filters( 'radiant_business_content_width', 890 );
		}
	}
endif;
add_filter( 'template_redirect', 'radiant_business_custom_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function radiant_business_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'radiant-business' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'radiant-business' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'radiant-business' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'radiant-business' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'radiant-business' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'radiant-business' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'radiant-business' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'radiant-business' ),
		) + $args
	);

}
add_action( 'widgets_init', 'radiant_business_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since 1.0
 */
function radiant_business_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-6' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
		case '5':
			$class = 'five';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'radiant_business_fonts_url' ) ) :
	/**
	 * Register Google fonts for FF Multipurpose
	 *
	 * Create your own radiant_business_fonts_url() function to override in a child theme.
	 *
	 * @return string Google fonts URL for the theme.
	 *
	 * @since 0.1
	 */
	function radiant_business_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Heebo, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$work_sans = _x( 'on', 'Work Sans font: on or off', 'radiant-business' );
		$poppins = _x( 'on', 'Poppins font: on or off', 'radiant-business' );

		if ( 'off' !== $work_sans && 'off' !== $poppins ) {
			$font_families = array();

			if ( 'off' !== $work_sans ) {
				$font_families[] = 'Work Sans:300,400,500,600,700,800,900';
			}

			if ( 'off' !== $poppins ) {
				$font_families[] = 'Poppins:300,400,500,600,700,800,900';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function radiant_business_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// FontAwesome.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/all' . $min . '.css', array(), '5.15.3', 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'radiant-business-style', get_stylesheet_uri(), array(), radiant_business_get_file_mod_date( 'style.css' ) );

	// Add google fonts.
	wp_enqueue_style( 'radiant-business-fonts', radiant_business_fonts_url(), array(), null );

	$color_style = radiant_business_gtm( 'radiant_business_color_style' );

	if ( 'light' === $color_style ) {
		// Light color scheme.
		wp_enqueue_style( 'radiant-business-light-style', get_template_directory_uri() . '/css/light' . $min . '.css', array( 'radiant-business-style' ), radiant_business_get_file_mod_date( '/css/light' . $min . '.css' ) );
	}

	// Theme block stylesheet.
	wp_enqueue_style( 'radiant-business-block-style', get_template_directory_uri() . '/css/blocks' . $min . '.css', array( 'radiant-business-style' ), radiant_business_get_file_mod_date( 'css/blocks' . $min . '.css' ) );

	$scripts = array(
		'radiant-business-skip-link-focus-fix' => array(
			'src'      => '/js/skip-link-focus-fix' . $min . '.js',
			'deps'      => array(),
			'in_footer' => true,
		),
		'radiant-business-keyboard-image-navigation' => array(
			'src'      => '/js/keyboard-image-navigation' . $min . '.js',
			'deps'      => array(),
			'in_footer' => true,
		),
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps = array( 'jquery' );

	$scripts['radiant-business-script'] = array(
		'src'       => '/js/functions' . $min . '.js',
		'deps'      => $deps,
		'in_footer' => true,
	);

	// Slider Scripts.
	$enable_slider = radiant_business_gtm( 'radiant_business_slider_visibility' );

	if ( radiant_business_display_section( $enable_slider )	) {
		wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/css/swiper' . $min . '.css', array(), radiant_business_get_file_mod_date( '/css/swiper' . $min . '.css' ), false );

		$scripts['swiper'] = array(
			'src'      => '/js/swiper' . $min . '.js',
			'deps'      => null,
			'in_footer' => true,
		);

		$scripts['swiper-custom'] = array(
			'src'      => '/js/swiper-custom' . $min . '.js',
			'deps'      => array( 'swiper' ),
			'in_footer' => true,
		);
	}

	foreach ( $scripts as $handle => $script ) {
		wp_enqueue_script( $handle, get_theme_file_uri( $script['src'] ), $script['deps'], radiant_business_get_file_mod_date( $script['src'] ), $script['in_footer'] );
	}

	wp_localize_script( 'radiant-business-script', 'radiantBusinessScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'radiant-business' ),
		'collapse' => esc_html__( 'collapse child menu', 'radiant-business' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'radiant_business_scripts' );

/**
 * Get file modified date
 */
function radiant_business_get_file_mod_date( $file ) {
	return date( 'Ymd-Gis', filemtime( get_theme_file_path( $file ) ) );
}

/**
 * Enqueue editor styles for Gutenberg
 */
function radiant_business_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'radiant-business-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'radiant-business-fonts', radiant_business_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'radiant_business_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_theme_file_path( '/inc/custom-header.php' );

/**
 * Breadcrumb.
 */
require get_theme_file_path( '/inc/breadcrumb.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/theme-about.php' );
