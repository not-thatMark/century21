<?php
/**
 * amora Theme Customizer
 *
 * @package amora
 */

function amora_customize_register_misc( $wp_customize ) {

	// Advertisement	
	class amora_Custom_Ads_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	                <textarea rows="10" style="width:100%;" <?php $this->link(); ?>><?php echo $this->value(); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize->add_section('amora_ads', array(
			'title' => __('Advertisement','amora'),
			'priority' => 44 ,
	));
	
	$wp_customize->add_setting(
	'amora_topad',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'amora_sanitize_ads'
		)
	);
	
	$wp_customize->add_control(
	    new amora_Custom_Ads_Control(
	        $wp_customize,
	        'amora_topad',
	        array(
	            'section' => 'amora_ads',
	            'settings' => 'amora_topad',
	            'label'   => __('Top Ad','amora'),
	            'description' => __('Enter your Responsive Adsense Code. For Other Ads use 468x60px Banner.','amora')
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'amora_topad_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'amora_topad_priority', array(
		    'settings' => 'amora_topad_priority',
		    'label'    => __( 'Priority', 'amora' ),
		    'section'  => 'amora_ads',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','amora'),
		)
	);
	
	function amora_sanitize_ads( $input ) {
		  global $allowedposttags;
	      $custom_allowedtags["script"] = array();
	      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	      $output = wp_kses( $input, $custom_allowedtags);
	      return $output;
	}
	
	class Amora_Custom_JS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;background: #222; color: #eee;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	//Analytics
	$wp_customize-> add_section(
    'amora_analytics_js',
    array(
    	'title'			=> __('Google Analytics','amora'),
    	'description'	=> __('Enter your Analytics Code. It will be Included in Footer of the Site. Do NOT Include &lt;script&gt; and &lt;/script&gt; tags.','amora'),
    	'priority'		=> 45,
    	)
    );
    
	$wp_customize->add_setting(
	'amora_analytics',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'amora_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new Amora_Custom_JS_Control(
	        $wp_customize,
	        'amora_analytics',
	        array(
	            'section' => 'amora_analytics_js',
	            'settings' => 'amora_analytics'
	        )
	    )
	);
	
	$wp_customize->add_section(
	    'amora_sec_upgrade',
	    array(
	        'title'     => __('Want to Rank Well on Google?','amora'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'amora_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Amora_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'amora_upgrade',
	        array(
	            'label' => __('Hello, How are you?','amora'),
	            'description' => __('I hope you are enjoying this theme. If you need us to work on your website and increase your Google traffic, then visit inkhive.com and contact us. We are exceptionally skilled SEO experts. If you don\'t believe us. You can check the Authority of InkHive on Moz or Majestic.','amora'),
	            'section' => 'amora_sec_upgrade',
	            'settings' => 'amora_upgrade',			       
	        )
		)
	);
	
	$wp_customize->add_section(
	    'amora_sec_premsupport',
	    array(
	        'title'     => __('Premium Support','amora'),
	        'priority'  => 1,
	    )
	);
	
	$wp_customize->add_setting(
			'amora_premsupport',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Amora_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'amora_premsupport',
	        array(
	            'label' => __('Amora Premium Support Options','amora'),
	            'description' => __('Amora WordPress Theme comes with Top Notch Premium Support. For any query visit www.inkhive.com and click on Contact Us > Premium Users. Fill out the form with your issue and we will get back to you in less than a day. We also have Live Chat support during daytime hours (Indian Standard Time). <br/> <br/> But Before that, please refer once to the <a href="#">Theme Documentation</a>','amora'),
	            'section' => 'amora_sec_premsupport',
	            'settings' => 'amora_premsupport',			       
	        )
		)
	);
	
	$wp_customize-> add_section(
    'amora_custom_codes_js',
    array(
    	'title'			=> __('Custom JS','amora'),
    	'description'	=> __('Enter your Custom JS Code. It will be Included in Head of the Site. Do NOT Include &lt;script&gt; and &lt;/script&gt; tags.','amora'),
    	'priority'		=> 11,
    	'panel'			=> 'amora_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'amora_custom_js',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'amora_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new Amora_Custom_JS_Control(
	        $wp_customize,
	        'amora_custom_js',
	        array(
	            'section' => 'amora_custom_codes_js',
	            'settings' => 'amora_custom_js'
	        )
	    )
	);
	
	
}
add_action( 'customize_register', 'amora_customize_register_misc' );