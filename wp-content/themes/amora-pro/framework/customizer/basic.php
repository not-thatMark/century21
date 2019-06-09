<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_basic( $wp_customize ) {
	
	//Basic Theme Settings
	$wp_customize->add_section( 'amora_basic_settings' , array(
	    'title'      => __( 'Basic Settings', 'amora' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'amora_blog_title' , array(
	    'default'     => 'Latest Posts',
	    'sanitize_callback' => 'amora_sanitize_text',
	) );
	
	$wp_customize->add_control(	   
        'amora_blog_title',
        array(
            'label' => __('Title For Blog Posts on Homepage.','amora'),
            'section' => 'amora_basic_settings',
            'settings' => 'amora_blog_title',
            'priority' => 5,
            'type' => 'text',
        )
	);
	
	$wp_customize->add_setting( 'amora_menu_text' , array(
	    'default'     => 'Browse...',
	    'sanitize_callback' => 'amora_sanitize_text',
	) );
	
	$wp_customize->add_control(	   
        'amora_menu_text',
        array(
            'label' => __('Title Menu Button on Mobile Phones.','amora'),
            'section' => 'amora_basic_settings',
            'settings' => 'amora_menu_text',
            'priority' => 5,
            'type' => 'text',
        )
	);
	
	
	$wp_customize->add_setting( 'amora_disable_featimg' , array(
	    'default'     => false,
	    'sanitize_callback' => 'amora_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(	   
        'amora_disable_featimg',
        array(
            'label' => 'Disable Featured Images on Posts.',
            'description' => 'This will Remove the Featured Images from Showing up on Individual Posts, however, it will not remove it from homepage and other elements.',
            'section' => 'amora_basic_settings',
            'settings' => 'amora_disable_featimg',
            'priority' => 5,
            'type' => 'checkbox',
        )
	);
	
	$wp_customize->add_setting( 'amora_disable_nextprev' , array(
	    'default'     => true,
	    'sanitize_callback' => 'amora_sanitize_checkbox',
	) );
	
	
	
	$wp_customize->add_control(	   
        'amora_disable_nextprev',
        array(
            'label' => 'Disable Next/Prev Posts on Single Posts.',
            'description' => 'This will Remove the the link to next and previous posts on all posts.',
            'section' => 'amora_basic_settings',
            'settings' => 'amora_disable_nextprev',
            'priority' => 5,
            'type' => 'checkbox',
        )
	);
	
	//Logo Section Related
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Title, Tagline & Logo', 'amora' );
	
}
add_action( 'customize_register', 'amora_customize_register_basic' );
