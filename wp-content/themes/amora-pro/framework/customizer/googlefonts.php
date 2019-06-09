<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_fonts( $wp_customize ) {

	$wp_customize->add_section(
	    'amora_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','amora'),
	        'priority'  => 41,
	        'description' => __('Fonts are Sorted in Order of Popularity. Defaults: Lato, Open Sans.','amora')
	    )
	);
	
	/**
	 * A class to create a dropdown for all google fonts
	 */
	 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
	 {
	    private $fonts = false;
	
	    public function __construct($manager, $id, $args = array(), $options = array())
	    {
	        $this->fonts = $this->get_fonts();
	        parent::__construct( $manager, $id, $args );
	    }

	    /**
	     * Render the content of the category dropdown
	     *
	     * @return HTML
	     */
	    public function render_content()
	    {
	        if(!empty($this->fonts))
	        {
	            ?>
	                <label>
	                    <span class="customize-category-select-control" style="font-weight: bold; display: block; padding: 5px 0px;"><?php echo esc_html( $this->label ); ?><br /></span>
	                    
	                    <select <?php $this->link(); ?>>
	                        <?php
	                            foreach ( $this->fonts as $k => $v )
	                            {
	                               printf('<option value="%s" %s>%s</option>', $v->family, selected($this->value(), $k, false), $v->family);
	                            }
	                        ?>
	                    </select>
	                </label>
	            <?php
	        }
	    }
	
	    /**
	     * Get the google fonts from the API or in the cache
	     *
	     * @param  integer $amount
	     *
	     * @return String
	     */
	    public function get_fonts( $amount = 'all' )
	    {
	        $fontFile = get_template_directory().'/inc/cache/google-web-fonts.txt';
	
	        //Total time the file will be cached in seconds, set to a week
	        $cachetime = 86400 * 30;
	
	        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
	        {
	            $content = json_decode(file_get_contents($fontFile));
	           
	        } else {
	
	            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyCnUNuE7iJyG-tuhk24EmaLZSC6yn3IjhQ';
	
	            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
	
	            $fp = fopen($fontFile, 'w');
	            fwrite($fp, $fontContent['body']);
	            fclose($fp);
	
	            $content = json_decode($fontContent['body']);
	            
	        }
	
	        if($amount == 'all')
	        {
	            return $content->items;
	        } else {
	            return array_slice($content->items, 0, $amount);
	        }
	        
	    }
	 }
	
	
	
	$wp_customize->add_setting(
		'amora_title_font' ,array('default' => 'Bree Serif')
	);
	
	$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control(
		$wp_customize,
		'amora_title_font',array(
				'label' => __('Title Font','amora'),
				'settings' => 'amora_title_font',
				'section'  => 'amora_typo_options',
			)
		)
	);
	
	
	$wp_customize->add_setting(
		'amora_body_font', array('default' => 'Bitter')
	);
	
	$wp_customize->add_control(
		new Google_Font_Dropdown_Custom_Control(
		$wp_customize,
		'amora_body_font',array(
				'label' => __('Body Font','amora'),
				'settings' => 'amora_body_font',
				'section'  => 'amora_typo_options'
			)
		)	
	);






    //typography
    //Page and Post content Font size start
    $wp_customize->add_setting(
        'amora_content_page_post_fontsize_set',
        array(
            'default' => 'default',
            'sanitize_callback' => 'amora_sanitize_content_size'
        )
    );
    function amora_sanitize_content_size( $input ) {
        if ( in_array($input, array('default','small','medium','large','extra-large') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'amora_content_page_post_fontsize_set', array(
            'settings' => 'amora_content_page_post_fontsize_set',
            'label'    => __( 'Page/Post Font Size','amora' ),
            'description' => __('Choose your font size. This is only for Posts and Pages. It wont affect your blog page.','amora'),
            'section'  => 'amora_typo_options',
            'type'     => 'select',
            'choices' => array(
                'default'   => 'Default',
                'small' => 'Small',
                'medium'   => 'Medium',
                'large'  => 'Large',
                'extra-large' => 'Extra Large',
            ),
        )
    );

    //Page and Post content Font size end


    //site title Font size start
    $wp_customize->add_setting(
        'amora_content_site_title_fontsize_set',
        array(
            'default' => '48',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'amora_content_site_title_fontsize_set', array(
            'settings' => 'amora_content_site_title_fontsize_set',
            'label'    => __( 'Site Title Font Size','amora' ),
            'description' => __('Choose your font size. This is only for Site Title.','amora'),
            'section'  => 'amora_typo_options',
            'type'     => 'number',
        )
    );
    //site title Font size end

    //site description Font size start
    $wp_customize->add_setting(
        'amora_content_site_desc_fontsize_set',
        array(
            'default' => '15',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'amora_content_site_desc_fontsize_set', array(
            'settings' => 'amora_content_site_desc_fontsize_set',
            'label'    => __( 'Site Description Font Size','amora' ),
            'description' => __('Choose your font size. This is only for Site Description.','amora'),
            'section'  => 'amora_typo_options',
            'type'     => 'number',
        )
    );
    //site description Font size end
	
	
	
	
	
	
	
	
}
	
add_action( 'customize_register', 'amora_customize_register_fonts' );	