<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_showcase( $wp_customize ) {

	//CUSTOM SHOWCASE
	$wp_customize->add_panel( 'amora_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Custom Showcase','amora'),
	) );
	
	$wp_customize->add_section(
	    'amora_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_showcase_panel'
	    )
	);
		
	$wp_customize->add_setting(
		'amora_showcase_enable',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_showcase_enable', array(
		    'settings' => 'amora_showcase_enable',
		    'label'    => __( 'Enable Showcase on Home/Blog.', 'amora' ),
		    'section'  => 'amora_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_showcase_enable_front',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_showcase_enable_front', array(
		    'settings' => 'amora_showcase_enable_front',
		    'label'    => __( 'Enable Showcase on Front Page.', 'amora' ),
		    'section'  => 'amora_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_showcase_enable_posts',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_showcase_enable_posts', array(
		    'settings' => 'amora_showcase_enable_posts',
		    'label'    => __( 'Enable Showcase on All Posts.', 'amora' ),
		    'section'  => 'amora_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	//title
    //title
    $wp_customize->add_setting(
        'amora_showcase_title',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'amora_showcase_title', array(
            'settings' => 'amora_showcase_title',
            'label'    => __( 'Title', 'amora' ),
            'section'  => 'amora_sec_showcase_options',
            'type'     => 'text',
        )
    );




	$wp_customize->add_setting(
		'amora_showcase_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_showcase_priority', array(
		    'settings' => 'amora_showcase_priority',
		    'label'    => __( 'Priority', 'amora' ),
		    'section'  => 'amora_sec_showcase_options',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
		)
	);
	
	for ( $i = 1 ; $i <= 3 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		$wp_customize->add_section(
		    'amora_showcase_sec'.$i,
		    array(
		        'title'     => __('ShowCase ','amora').$i,
		        'priority'  => $i,
		        'panel'     => 'amora_showcase_panel',
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'amora_showcase_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'amora_showcase_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'amora_showcase_sec'.$i,
		            'settings' => 'amora_showcase_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'amora_showcase_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'amora_showcase_title'.$i, array(
			    'settings' => 'amora_showcase_title'.$i,
			    'label'    => __( 'Showcase Title','amora' ),
			    'section'  => 'amora_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'amora_showcase_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'amora_showcase_desc'.$i, array(
			    'settings' => 'amora_showcase_desc'.$i,
			    'label'    => __( 'Showcase Description','amora' ),
			    'section'  => 'amora_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'amora_showcase_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'amora_showcase_url'.$i, array(
			    'settings' => 'amora_showcase_url'.$i,
			    'label'    => __( 'Target URL','amora' ),
			    'section'  => 'amora_showcase_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;	

}
	
add_action( 'customize_register', 'amora_customize_register_showcase' );