<?php
/**
 * amora Theme Customizer
 *
 * @package amora
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amora_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
}
add_action( 'customize_register', 'amora_customize_register' );

//Load All Individual Settings Based on Sections/Panels.
require_once get_template_directory().'/framework/customizer/sanitization.php';
require_once get_template_directory().'/framework/customizer/basic.php';
require_once get_template_directory().'/framework/customizer/layouts.php';
require_once get_template_directory().'/framework/customizer/slider.php';
require_once get_template_directory().'/framework/customizer/showcase.php';
require_once get_template_directory().'/framework/customizer/featured-posts.php';

//require_once get_template_directory().'/framework/customizer/featposts-top.php';
require_once get_template_directory().'/framework/customizer/featured-news.php';
require_once get_template_directory().'/framework/customizer/header-image.php';

//require_once get_template_directory().'/framework/customizer/featured-hposts.php';
//require_once get_template_directory().'/framework/customizer/wp-featured.php';
//require_once get_template_directory().'/framework/customizer/wc-featured.php';
require_once get_template_directory().'/framework/customizer/skins.php';
require_once get_template_directory().'/framework/customizer/social-icons.php';
require_once get_template_directory().'/framework/customizer/googlefonts.php';
require_once get_template_directory().'/framework/customizer/misc-scripts.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function amora_customize_preview_js() {
	if(is_customize_preview()) {
		wp_enqueue_script( 'amora_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
	}	
}
add_action( 'customize_preview_init', 'amora_customize_preview_js' );
