<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_fn( $wp_customize ) {

	//FEATURED NEWS	
	$wp_customize->add_panel( 'amora_fn_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured News Sections','amora'),
	) );
		
	
	for ($f = 1; $f < 4; $f++) {
		
		$wp_customize->add_section(
		    'amora_a_fn_boxes'.$f,
		    array(
		        'title'     => __('Featured News Area '.$f,'amora'),
		        'priority'  => 20,
		        'panel' => 'amora_fn_panel',
		    )
		);
		
		$wp_customize->add_setting(
			'amora_fn_enable'.$f,
			array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
		);
		
		$wp_customize->add_control(
				'amora_fn_enable'.$f, array(
			    'settings' => 'amora_fn_enable'.$f,
			    'label'    => __( 'Enable Featured News on Blog/Home.', 'amora' ),
			    'section'  => 'amora_a_fn_boxes'.$f,
			    'type'     => 'checkbox',
			)
		);
		
		$wp_customize->add_setting(
			'amora_fn_enable_posts'.$f,
			array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
		);
		
		$wp_customize->add_control(
				'amora_fn_enable_posts'.$f, array(
			    'settings' => 'amora_fn_enable_posts'.$f,
			    'label'    => __( 'Enable On All Posts', 'amora' ),
			    'section'  => 'amora_a_fn_boxes'.$f,
			    'type'     => 'checkbox',
			)
		);
		
		$wp_customize->add_setting(
			'amora_fn_enable_front'.$f,
			array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
		);
		
		$wp_customize->add_control(
				'amora_fn_enable_front'.$f, array(
			    'settings' => 'amora_fn_enable_front'.$f,
			    'label'    => __( 'Enable on Static Front Page', 'amora' ),
			    'section'  => 'amora_a_fn_boxes'.$f,
			    'type'     => 'checkbox',
			)
		);
		
	 
		$wp_customize->add_setting(
			'amora_fn_title'.$f,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'amora_fn_title'.$f, array(
			    'settings' => 'amora_fn_title'.$f,
			    'label'    => __( 'Title','amora' ),
			    'description'    => __( 'Leave Blank to disable','amora' ),
			    'section'  => 'amora_a_fn_boxes'.$f,
			    'type'     => 'text',
			)
		);
	 
	 	$wp_customize->add_setting(
		    'amora_fn_cat'.$f,
		    array( 'sanitize_callback' => 'amora_sanitize_product_category' )
		);
		
		$wp_customize->add_control(
		    new Amora_WP_Customize_Category_Control(
		        $wp_customize,
		        'amora_fn_cat'.$f,
		        array(
		            'label'    => __('Posts Category.','amora'),
		            'settings' => 'amora_fn_cat'.$f,
		            'section'  => 'amora_a_fn_boxes'.$f
		        )
		    )
		);
		
		$wp_customize->add_setting(
		'amora_fn'.$f.'_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'amora_fn'.$f.'_priority', array(
			    'settings' => 'amora_fn'.$f.'_priority',
			    'label'    => __( 'Priority', 'amora' ),
			    'section'  => 'amora_a_fn_boxes'.$f,
			    'type'     => 'number',
			    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
			)
		);
		
	} //endfor

}
	
add_action( 'customize_register', 'amora_customize_register_fn' );