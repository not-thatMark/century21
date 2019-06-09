<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_wc( $wp_customize ) {

	//WOOCOMMERCE ENABLED STUFF
	if ( class_exists('woocommerce') ) :
	// CREATE THE fcp PANEL
	$wp_customize->add_panel( 'amora_fcp_panel', array(
	    'priority'       => 36,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Product Showcase',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'amora_fc_boxes',
	    array(
	        'title'     => __('Square Boxes','amora'),
	        'priority'  => 10,
	        'panel'     => 'amora_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'amora_box_enable',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_box_enable', array(
		    'settings' => 'amora_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider.', 'amora' ),
		    'section'  => 'amora_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_box_enable_front',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_box_enable_front', array(
		    'settings' => 'amora_box_enable_front',
		    'label'    => __( 'Enable on Static Front Page', 'amora' ),
		    'section'  => 'amora_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'amora_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_box_title', array(
		    'settings' => 'amora_box_title',
		    'label'    => __( 'Title for the Boxes','amora' ),
		    'section'  => 'amora_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'amora_box_cat',
	    array( 'sanitize_callback' => 'amora_sanitize_product_category' )
	);
	
	$wp_customize->add_control(
	    new Amora_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'amora_box_cat',
	        array(
	            'label'    => __('Product Category.','amora'),
	            'settings' => 'amora_box_cat',
	            'section'  => 'amora_fc_boxes'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'amora_box_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_box_priority', array(
		    'settings' => 'amora_box_priority',
		    'label'    => __( 'Priority', 'amora' ),
		    'section'  => 'amora_fc_boxes',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
		)
	);
	
		
	//SLIDER
	$wp_customize->add_section(
	    'amora_fc_slider',
	    array(
	        'title'     => __('3D Cube Products Slider','amora'),
	        'priority'  => 10,
	        'panel'     => 'amora_fcp_panel',
	        'description' => 'This is the Posts Slider, displayed left to the square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'amora_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_slider_title', array(
		    'settings' => 'amora_slider_title',
		    'label'    => __( 'Title for the Slider', 'amora' ),
		    'section'  => 'amora_fc_slider',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'amora_slider_count',
		array( 'sanitize_callback' => 'amora_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'amora_slider_count', array(
		    'settings' => 'amora_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'amora' ),
		    'section'  => 'amora_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'amora_slider_cat',
		    array( 'sanitize_callback' => 'amora_sanitize_product_category' )
		);
		
	$wp_customize->add_control(
	    new Amora_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'amora_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','amora'),
	            'settings' => 'amora_slider_cat',
	            'section'  => 'amora_fc_slider'
	        )
	    )
	);
	
	
	
	//COVERFLOW
	
	$wp_customize->add_section(
	    'amora_fc_coverflow',
	    array(
	        'title'     => __('Top CoverFlow Slider','amora'),
	        'priority'  => 5,
	        'panel'     => 'amora_fcp_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'amora_coverflow_enable',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_coverflow_enable', array(
		    'settings' => 'amora_coverflow_enable',
		    'label'    => __( 'Enable', 'amora' ),
		    'section'  => 'amora_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_coverflow_enable_front',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_coverflow_enable_front', array(
		    'settings' => 'amora_coverflow_enable_front',
		    'label'    => __( 'Enable on Static Front Page', 'amora' ),
		    'section'  => 'amora_fc_coverflow',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'amora_coverflow_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_coverflow_title', array(
		    'settings' => 'amora_coverflow_title',
		    'label'    => __( 'Title for the Coverflow', 'amora' ),
		    'section'  => 'amora_fc_coverflow',
		    'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		    'amora_coverflow_cat',
		    array( 'sanitize_callback' => 'amora_sanitize_product_category' )
		);
	
		
	$wp_customize->add_control(
	    new Amora_WP_Customize_Product_Category_Control(
	        $wp_customize,
	        'amora_coverflow_cat',
	        array(
	            'label'    => __('Category For Image Grid','amora'),
	            'settings' => 'amora_coverflow_cat',
	            'section'  => 'amora_fc_coverflow'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'amora_coverflow_pc',
		array( 'sanitize_callback' => 'amora_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'amora_coverflow_pc', array(
		    'settings' => 'amora_coverflow_pc',
		    'label'    => __( 'Max No. of Posts in the Grid. Min: 5.', 'amora' ),
		    'section'  => 'amora_fc_coverflow',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	$wp_customize->add_setting(
		'amora_coverflow_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_coverflow_priority', array(
		    'settings' => 'amora_coverflow_priority',
		    'label'    => __( 'Priority', 'amora' ),
		    'section'  => 'amora_fc_coverflow',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
		)
	);
	
	endif; //end class exists woocommerce

}
	
add_action( 'customize_register', 'amora_customize_register_wc' );