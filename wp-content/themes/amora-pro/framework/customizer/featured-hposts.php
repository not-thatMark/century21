<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_fhp( $wp_customize ) {

	//FEATURED POSTS for Homepage
	$wp_customize->add_panel( 'amora_featposts', array(
	    'priority'       => 34,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured Posts (Homepage Only, Above Blog)','amora'),
	) );
	
	for ($i = 1; $i < 3; $i++) :
	
	$wp_customize->add_section(
	    'amora_featposts'.$i,
	    array(
	        'title'     => __('Featured Category ','amora').$i,
	        'priority'  => 35,
	        'panel' => 'amora_featposts',
	    )
	);
	
	$wp_customize->add_setting(
		'amora_featposts_enable'.$i,
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_featposts_enable'.$i, array(
		    'settings' => 'amora_featposts_enable'.$i,
		    'label'    => __( 'Enable', 'amora' ),
		    'section'  => 'amora_featposts'.$i,
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'amora_featposts_title'.$i,
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_featposts_title'.$i, array(
		    'settings' => 'amora_featposts_title'.$i,
		    'label'    => __( 'Title', 'amora' ),
		    'section'  => 'amora_featposts'.$i,
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'amora_featposts_icon'.$i,
		array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'fa-star' )
	);
	
	$wp_customize->add_control(
			'amora_featposts_icon'.$i, array(
		    'settings' => 'amora_featposts_icon'.$i,
		    'label'    => __( 'Title Icon', 'amora' ),
		    'section'  => 'amora_featposts'.$i,
		    'type'     => 'text',
		    'description' => __('Icon Class should be entered in this format: <strong>fa-video, fa-star, fa-envelope-o</strong>. List of Support Icons and Classes <a href="http://fontawesome.io/cheatsheet/" target="_blank">Available Here.</a>','amora'),
		)
	);
	
	$wp_customize->add_setting(
		    'amora_featposts_cat'.$i,
		    array( 'sanitize_callback' => 'amora_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Amora_WP_Customize_Category_Control(
	        $wp_customize,
	        'amora_featposts_cat'.$i,
	        array(
	            'label'    => __('Category For Featured Posts','amora'),
	            'settings' => 'amora_featposts_cat'.$i,
	            'section'  => 'amora_featposts'.$i,
	        )
	    )
	);
	
	
	
	endfor;

}
	
add_action( 'customize_register', 'amora_customize_register_fhp' );