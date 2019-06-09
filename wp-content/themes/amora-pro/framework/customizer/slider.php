<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_slider( $wp_customize ) {

	// SLIDER PANEL
	$wp_customize->add_panel( 'amora_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'amora_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'amora_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'amora_main_slider_enable',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_main_slider_enable', array(
		    'settings' => 'amora_main_slider_enable',
		    'label'    => __( 'Enable Slider on HomePage.', 'amora' ),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_main_slider_enable_front',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_main_slider_enable_front', array(
		    'settings' => 'amora_main_slider_enable_front',
		    'label'    => __( 'Enable Slider on Static Front Page.', 'amora' ),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_main_slider_enable_posts',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_main_slider_enable_posts', array(
		    'settings' => 'amora_main_slider_enable_posts',
		    'label'    => __( 'Enable Slider on All Posts.', 'amora' ),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_main_slider_enable_pages',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_main_slider_enable_pages', array(
		    'settings' => 'amora_main_slider_enable_pages',
		    'label'    => __( 'Enable Slider on All Pages.', 'amora' ),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	
	
	
	$wp_customize->add_setting(
		'amora_main_slider_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_main_slider_priority', array(
		    'settings' => 'amora_main_slider_priority',
		    'label'    => __( 'Priority', 'amora' ),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
		)
	);
	
	//Slider Config
	$wp_customize->add_section(
	    'amora_slider_config',
	    array(
	        'title'     => __('Configure Slider','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_slider_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'amora_slider_pause',
			array(
				'default' => 5000,
				'sanitize_callback' => 'amora_sanitize_positive_number'
			)
	);
	
	$wp_customize->add_control(
			'amora_slider_pause', array(
		    'settings' => 'amora_slider_pause',
		    'label'    => __( 'Time Between Each Slide.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'number',
		    'description' => __('Value in Milliseconds. Default: 5000.','amora'),
		    
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_speed',
			array(
				'default' => 500,
				'sanitize_callback' => 'amora_sanitize_positive_number'
			)
	);
	
	$wp_customize->add_control(
			'amora_slider_speed', array(
		    'settings' => 'amora_slider_speed',
		    'label'    => __( 'Animation Speed.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'number',
		    'description' => __('Value in Milliseconds. Default: 500.','amora'),
		    
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_random',
			array(
				'default' => false,
				'sanitize_callback' => 'amora_sanitize_checkbox'
			)
	);
	
	$wp_customize->add_control(
			'amora_slider_random', array(
		    'settings' => 'amora_slider_random',
		    'label'    => __( 'Start Slider from Random Slide.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'checkbox',		    
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_pager',
			array(
				'default' => true,
				'sanitize_callback' => 'amora_sanitize_checkbox'
			)
	);
	
	$wp_customize->add_control(
			'amora_slider_pager', array(
		    'settings' => 'amora_slider_pager',
		    'label'    => __( 'Enable Pager.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'checkbox',
		    'description' => __('Pager is the Circles at the bottom, which represent current slide.','amora'),		    
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_autoplay',
			array(
				'default' => true, //Because, in nivo its Force Manual Transitions.
				'sanitize_callback' => 'amora_sanitize_checkbox'
			)
	);
	
	$wp_customize->add_control(
			'amora_slider_autoplay', array(
		    'settings' => 'amora_slider_autoplay',
		    'label'    => __( 'Enable Autoplay.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_effect',
			array(
				'default' => 'fade',
			)
	);
	
	$earray=array('fade','slide');
		$earray = array_combine($earray, $earray);
	
/*
	$wp_customize->add_control(
			'amora_slider_effect', array(
		    'settings' => 'amora_slider_effect',
		    'label'    => __( 'Slider Animation Effect.' ,'amora'),
		    'section'  => 'amora_slider_config',
		    'type'     => 'select',
		    'choices' => $earray,
	) );
*/
	
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_setting(
		'amora_main_slider_count',
			array(
				'default' => '3',
				'sanitize_callback' => 'amora_sanitize_positive_number'
			)
	);	
	
	$wp_customize->add_control(
			'amora_main_slider_count', array(
		    'settings' => 'amora_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 30)' ,'amora'),
		    'section'  => 'amora_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','amora'),
		    
		)
	);
		
	
	if ( get_theme_mod('amora_main_slider_count',3) > 0 ) :
		$slides = get_theme_mod('amora_main_slider_count', 3);
		
		for ( $i = 1 ; $i <= $slides ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			$wp_customize->add_section(
			    'amora_slide_sec'.$i,
			    array(
			        'title'     => 'Slide '.$i,
			        'priority'  => $i,
			        'panel'     => 'amora_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'amora_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'amora_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'amora_slide_sec'.$i,
			            'settings' => 'amora_slide_img'.$i,			       
			        )
				)
			);
			
			
			
			
			$wp_customize->add_setting(
				'amora_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'amora_slide_title'.$i, array(
				    'settings' => 'amora_slide_title'.$i,
				    'label'    => __( 'Slide Title','amora' ),
				    'section'  => 'amora_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'amora_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'amora_slide_desc'.$i, array(
				    'settings' => 'amora_slide_desc'.$i,
				    'label'    => __( 'Slide Description','amora' ),
				    'section'  => 'amora_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			
			$wp_customize->add_setting(
				'amora_slide_CTA_button'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'amora_slide_CTA_button'.$i, array(
				    'settings' => 'amora_slide_CTA_button'.$i,
				    'label'    => __( 'Custom Call to Action Button Text(Optional)','amora' ),
				    'section'  => 'amora_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'amora_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'amora_slide_url'.$i, array(
				    'settings' => 'amora_slide_url'.$i,
				    'label'    => __( 'Target URL','amora' ),
				    'section'  => 'amora_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	
	endif;

	

}
	
add_action( 'customize_register', 'amora_customize_register_slider' );