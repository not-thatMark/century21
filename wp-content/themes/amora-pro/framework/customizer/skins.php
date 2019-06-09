<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_skins( $wp_customize ) {

	//Replace Header Text Color with, separate colors for Title and Description
	//Override amora_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_setting('header_textcolor');

	$wp_customize->add_setting('amora_site_titlecolor', array(
	    'default'     => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'amora_site_titlecolor', array(
			'label' => __('Site Title Color','amora'),
			'section' => 'amora_skin_options',
			'settings' => 'amora_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('amora_header_desccolor', array(
	    'default'     => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'amora_header_desccolor', array(
			'label' => __('Site Tagline Color','amora'),
			'section' => 'amora_skin_options',
			'settings' => 'amora_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'amora_skin_options',
	    array(
	        'title'     => __('Theme Skin & Colors','amora'),
	        'priority'  => 39,
	    )
	);
	
	$wp_customize->add_setting(
		'amora_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'amora_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(Blue)','amora'),
					'orange' =>  __('Orange','amora'),
					'green' => __('Green','amora'),
					'brown' => __('Brown','amora'),
					'darkblue' => __('Dark Blue','amora'),
					'grayscale' => __('Grayscale','amora'),
					'yellow' => __('Yellow','amora'),
					'slick' => __('Slick','amora'),
					'brie' => __('Brie','amora'),
					'custom' => __('BUILD CUSTOM SKIN','amora'),
					);
	
	$wp_customize->add_control(
		'amora_skin',array(
				'settings' => 'amora_skin',
				'section'  => 'amora_skin_options',
				'label' => __('Choose from the Skins Below','amora'),
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function amora_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','brown','green','grayscale','custom', 'blue', 'darkblue','yellow','slick','brie','custom') ) )
			return $input;
		else
			return '';
	}
	
	//CUSTOM SKIN BUILDER
	
	$wp_customize->add_setting('amora_skin_var_background', array(
	    'default'     => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'amora_skin_var_background', array(
			'label' => __('Primary Background','amora'),
			'section' => 'amora_skin_options',
			'settings' => 'amora_skin_var_background',
			'active_callback' => 'amora_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	
	$wp_customize->add_setting('amora_skin_var_accent', array(
	    'default'     => '#8890d5',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'amora_skin_var_accent', array(
			'label' => __('Primary Accent','amora'),
			'description' => __('For Most Users, Changing this only color is sufficient.','amora'),
			'section' => 'amora_skin_options',
			'settings' => 'amora_skin_var_accent',
			'type' => 'color',
			'active_callback' => 'amora_skin_custom',
		) ) 
	);	
	
	$wp_customize->add_setting('amora_skin_var_content', array(
	    'default'     => '#444',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'amora_skin_var_content', array(
			'label' => __('Content Color','amora'),
			'description' => __('Must be Dark, like Black or Dark grey. Any darker color is acceptable.','amora'),
			'section' => 'amora_skin_options',
			'settings' => 'amora_skin_var_content',
			'active_callback' => 'amora_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	function amora_skin_custom( $control ) {
		$option = $control->manager->get_setting('amora_skin');
	    return $option->value() == 'custom' ;
	}

}
	
add_action( 'customize_register', 'amora_customize_register_skins' );