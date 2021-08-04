<?php
/**
 * Child Theme functions and definitions.
 * This theme is a child theme for Jetblack.
 *
 * @package Radiant Business Light
 * @author  FireflyThemes https://fireflythemes.com
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

/**
 * Theme functions and definitions.
 */
function radiant_business_light_child_enqueue_styles() {
    wp_enqueue_style( 'radiant-business-style' , get_template_directory_uri() . '/style.css' );
    
    wp_enqueue_style( 'radiant-business-light-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'radiant-business-style' ),
        wp_get_theme()->get('Version')
    );
}
add_action(  'wp_enqueue_scripts', 'radiant_business_light_child_enqueue_styles' );

/**
 * Loads the child theme textdomain.
 */
function radiant_business_light_setup() {
    load_child_theme_textdomain( 'radiant-business-light', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'radiant_business_light_setup', 11 );

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Radiant Business
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function radiant_business_light_body_classes( $classes ) {
    // Add header Style Class.
    $classes['header-class'] = radiant_business_gtm( 'radiant_business_header_style' );

    return $classes;
}
add_filter( 'body_class', 'radiant_business_light_body_classes', 20 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function radiant_business_light_widgets_init() {
    $args = array(
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );

    register_sidebar( array(
        'name'        => esc_html__( 'Footer 4', 'radiant-business' ),
        'id'          => 'sidebar-5',
        'description' => esc_html__( 'Add widgets here to appear in your footer.', 'radiant-business-light' ),
        ) + $args
    );

}
add_action( 'widgets_init', 'radiant_business_light_widgets_init', 20 );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/radiant-business-header-options.php' );


/**
 * Add Social Widget
 */
require get_theme_file_path( '/inc/widgets/social-menu.php' );
