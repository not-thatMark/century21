<?php function amora_customize_register_featposts_top( $wp_customize ) {	
	$wp_customize->add_section(
	    'amora_featposts_top',
	    array(
	        'title'     => __('Featured Posts (Below Header)','amora'),
	        'priority'  => 33,
	    )
	);
	
	$wp_customize->add_setting(
		'amora_featposts_top_enable',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_featposts_top_enable', array(
		    'settings' => 'amora_featposts_top_enable',
		    'label'    => __( 'Enable', 'amora' ),
		    'section'  => 'amora_featposts_top',
		    'type'     => 'checkbox',
		)
	);	
	
	$wp_customize->add_setting(
		    'amora_featposts_top_cat',
		    array( 'sanitize_callback' => 'amora_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Amora_WP_Customize_Category_Control(
	        $wp_customize,
	        'amora_featposts_top_cat',
	        array(
	            'label'    => __('Category For Featured Posts','amora'),
	            'settings' => 'amora_featposts_top_cat',
	            'section'  => 'amora_featposts_top'
	        )
	    )
	);

}

add_action( 'customize_register', 'amora_customize_register_featposts_top' );