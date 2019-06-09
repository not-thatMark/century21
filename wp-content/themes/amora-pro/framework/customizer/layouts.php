<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_layouts( $wp_customize ) {

	// Layout and Design
	$wp_customize->add_panel( 'amora_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','amora'),
	) );
	
	$wp_customize->add_section(
	    'amora_site_layout_sec',
	    array(
	        'title'     => __('Site Layout','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'amora_site_layout',
		array( 'sanitize_callback' => 'amora_sanitize_site_layout' )
	);
	
	function amora_sanitize_site_layout( $input ) {
		if ( in_array($input, array('full','boxed') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'amora_site_layout',array(
				'label' => __('Select Layout','amora'),
				'settings' => 'amora_site_layout',
				'section'  => 'amora_site_layout_sec',
				'type' => 'select',
				'choices' => array(
						'full' => __('Full Width Layout','amora'),
						'boxed' => __('Boxed','amora'),
						
					)
			)
	);
	
	$wp_customize->add_section(
	    'amora_portfolio_options',
	    array(
	        'title'     => __('Portfolio Layout','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'amora_portfolio_layout',
		array( 'sanitize_callback' => 'amora_sanitize_blog_layout' )
	);
	

	
	$wp_customize->add_control(
		'amora_portfolio_layout',array(
				'label' => __('Select Layout','amora'),
				'description' => __('Use this to Set the Layout for Portfolio Archive Pages.','amora'),
				'settings' => 'amora_portfolio_layout',
				'section'  => 'amora_portfolio_options',
				'type' => 'select',
				'choices' => array(
						'amora' => __('amora Layout','amora'),
						'grid' => __('Basic Blog Layout','amora'),
						'grid_2_column' => __('Grid - 2 Column','amora'),
						'grid_3_column' => __('Grid - 3 Column','amora'),
						'grid_4_column' => __('Grid - 4 Column','amora'),
						'photos_1_column' => __('Photography - 1 Column','amora'),
						'photos_2_column' => __('Photography - 2 Column','amora'),
						'photos_3_column' => __('Photography - 3 Column','amora'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'amora_design_options',
	    array(
	        'title'     => __('Blog Layout','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'amora_blog_layout',
		array( 'sanitize_callback' => 'amora_sanitize_blog_layout' )
	);
	
	function amora_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','amora','grid_2_column','grid_3_column','grid_4_column','photos_1_column','photos_2_column','photos_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'amora_blog_layout',array(
				'label' => __('Select Layout','amora'),
				'settings' => 'amora_blog_layout',
				'section'  => 'amora_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','amora'),
						'amora' => __('Amora Theme Layout','amora'),
						'grid_2_column' => __('Grid - 2 Column','amora'),
						'grid_3_column' => __('Grid - 3 Column','amora'),
						'grid_4_column' => __('Grid - 4 Column','amora'),
						'photos_1_column' => __('Photography - 1 Column','amora'),
						'photos_2_column' => __('Photography - 2 Column','amora'),
						'photos_3_column' => __('Photography - 3 Column','amora'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'amora_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_design_panel'
	    )
	);

    $wp_customize->add_setting(
        'amora_sidebar_style',
        array(
            'default' => 'default',
        )
    );

    $wp_customize->add_control(
        'amora_sidebar_style',
        array(
            'setting' => 'amora_sidebar_style',
            'section' => 'amora_sidebar_options',
            'label' => __('Sidebar Style', 'amora'),
            'type' => 'select',
            'choices' => array(
                'default' => __('Default', 'amora'),
                'sticky-sidebar' => __('Sticky', 'amora'),
            )
        )
    );
	
	$wp_customize->add_setting(
		'amora_disable_sidebar',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_disable_sidebar', array(
		    'settings' => 'amora_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'amora_disable_sidebar_home',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_disable_sidebar_home', array(
		    'settings' => 'amora_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'amora_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'amora_disable_sidebar_front',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_disable_sidebar_front', array(
		    'settings' => 'amora_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'amora_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'amora_disable_sidebar_archive',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_disable_sidebar_archive', array(
		    'settings' => 'amora_disable_sidebar_archive',
		    'label'    => __( 'Disable Sidebar on Archives(Categories/Tags/etc).','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'amora_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'amora_disable_sidebar_portfolio',
		array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'amora_disable_sidebar_portfolio', array(
		    'settings' => 'amora_disable_sidebar_portfolio',
		    'label'    => __( 'Disable Sidebar on Portfolio Pages.','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'amora_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'amora_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'amora_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'amora_sidebar_width', array(
		    'settings' => 'amora_sidebar_width',
		    'label'    => __( 'Sidebar Width','amora' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','amora'),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'amora_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	$wp_customize->add_setting(
		'amora_sidebar_loc',
		array(
			'default' => 'right',
		    'sanitize_callback' => 'amora_sanitize_sidebar_loc' )
	);
	
	$wp_customize->add_control(
			'amora_sidebar_loc', array(
		    'settings' => 'amora_sidebar_loc',
		    'label'    => __( 'Sidebar Location','amora' ),
		    'section'  => 'amora_sidebar_options',
		    'type'     => 'select',
		    'active_callback' => 'amora_show_sidebar_options',
		    'choices' => array(
		        'left'   => "Left",
		        'right'   => "Right",
		    ),
		)
	);
	
	/* sanitization */
	function amora_sanitize_sidebar_loc( $input ) {
		if (in_array($input, array('left','right') ) ) :
			return $input;
		else :
			return '';
		endif;		
	}
	
	
	/* Active Callback Function */
	function amora_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('amora_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	$wp_customize-> add_section(
    'amora_footer_columns',
    array(
    	'title'			=> __('Footer Settings','amora'),
    	'description'	=> __('Choose How Many Widget Area Columns Do you Want in the Footer. Default: 4.','amora'),
    	'priority'		=> 10,
    	'panel'			=> 'amora_design_panel'
    	)
    );
    
    $wp_customize->add_setting(
	'amora_footer_sidebar_columns',
	array(
		'default'		=> '4',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(
	'amora_footer_sidebar_columns', array(
		'label' => __('No. of Footer Columns','amora'),
		'section' => 'amora_footer_columns',
		'settings' => 'amora_footer_sidebar_columns',
		'type' => 'select',
		'choices' => array(
				'1' => __('1','amora'),
				'2' => __('2','amora'),
				'3' => __('3','amora'),
				'4' => __('4','amora'),
			)
	) );
	
    
	$wp_customize->add_setting(
	'amora_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'amora_footer_text',
	        array(
		        'label' => 'Custom Footer Text',
	            'section' => 'amora_footer_columns',
	            'settings' => 'amora_footer_text',
	            'type' => 'text'
	        )
	);	
	
	
	//WooCommerce Options
	$wp_customize->add_section(
	    'amora_woo_options',
	    array(
	        'title'     => __('WooCommerce Layout','amora'),
	        'priority'  => 0,
	        'panel'     => 'amora_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'amora_woo_layout', array( 'default' => '3' )
	);
	
	
	$wp_customize->add_control(
		'amora_woo_layout',array(
				'label' => __('Select Layout','amora'),
				'settings' => 'amora_woo_layout',
				'section'  => 'amora_woo_options',
				'type' => 'select',
				'default' => '3',
				'choices' => array(
						'2' => __('2 Columns','amora'),
						'3' => __('3 Columns','amora'),
						'4' => __('4 Columns','amora'),
					),
			)
	);
	
	$wp_customize->add_setting(
		'amora_woo_qty', array( 'default' => '12' )
	);
	
	
	$wp_customize->add_control(
		'amora_woo_qty',array(
				'description' => __('This Value may reflect after you save and re-load the page.','amora'),
				'label' => __('No of Products per Page','amora'),
				'settings' => 'amora_woo_qty',
				'section'  => 'amora_woo_options',
				'type' => 'number',
				'default' => '12'
				
			)
	);

}
	
add_action( 'customize_register', 'amora_customize_register_layouts' );