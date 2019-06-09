<?php
/**
 * Amora Theme Customizer
 *
 * @package amora
 */
 
function amora_customize_register_social( $wp_customize ) {

	// Social Icons
	$wp_customize->add_section('amora_social_section', array(
			'title' => __('Social Icons','amora'),
			'priority' => 44 ,
	));

    $social_icon_styles = array(
        'hvr-ripple-out' => __('Default', 'amora'),
        'hvr-buzz-out' => __('Style 1', 'amora'),
        'hvr-radial-in' => __('Style 2', 'amora'),
        'hvr-wobble-to-bottom-right' => __('Style 3', 'amora')
    );

    $wp_customize->add_setting('amora_social_icon_style', array(
        'default' => 'hvr-ripple-out',
        'sanitize_callback' => 'amora_sanitize_social_style'
    ) );

    function amora_sanitize_social_style($input) {
        $social_icon_styles = array(
            'hvr-ripple-out',
            'hvr-buzz-out',
            'hvr-radial-in',
            'hvr-wobble-to-bottom-right',
        );
        if ( in_array($input, $social_icon_styles))
            return $input;
        else
            return '';
    }

    $wp_customize->add_control('amora_social_icon_style', array(
            'setting' => 'amora_social_icon_style',
            'section' => 'amora_social_section',
            'label' => __('Social Icon Effects', 'amora'),
            'type' => 'select',
            'choices' => $social_icon_styles,
        )
    );

	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','amora'),
					'facebook' => __('Facebook','amora'),
					'twitter' => __('Twitter','amora'),
					'google-plus' => __('Google Plus','amora'),
					'instagram' => __('Instagram','amora'),
					'rss' => __('RSS Feeds','amora'),
					'vine' => __('Vine','amora'),
					'vimeo-square' => __('Vimeo','amora'),
					'youtube' => __('Youtube','amora'),
					'flickr' => __('Flickr','amora'),
					'android' => __('Android','amora'),
					'apple' => __('Apple','amora'),
					'dribbble' => __('Dribbble','amora'),
					'foursquare' => __('FourSquare','amora'),
					'git' => __('Git','amora'),
					'linkedin' => __('Linked In','amora'),
					'paypal' => __('PayPal','amora'),
					'pinterest-p' => __('Pinterest','amora'),
					'reddit' => __('Reddit','amora'),
					'skype' => __('Skype','amora'),
					'soundcloud' => __('SoundCloud','amora'),
					'tumblr' => __('Tumblr','amora'),
					'windows' => __('Windows','amora'),
					'wordpress' => __('WordPress','amora'),
					'yelp' => __('Yelp','amora'),
					'vk' => __('VK.com','amora'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= 10 ; $x++) :
			
		$wp_customize->add_setting(
			'amora_social_'.$x, array(
				'sanitize_callback' => 'amora_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'amora_social_'.$x, array(
					'settings' => 'amora_social_'.$x,
					'label' => __('Icon ','amora').$x,
					'section' => 'amora_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'amora_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'amora_social_url'.$x, array(
					'settings' => 'amora_social_url'.$x,
					'description' => __('Icon ','amora').$x.__(' Url','amora'),
					'section' => 'amora_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function amora_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr',
					'android',
					'apple',
					'dribbble',
					'foursquare',
					'git',
					'linkedin',
					'paypal',
					'pinterest-p',
					'reddit',
					'skype',
					'soundcloud',
					'tumblr',
					'windows',
					'wordpress',
					'yelp',
					'vk'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
}
	
add_action( 'customize_register', 'amora_customize_register_social' );	