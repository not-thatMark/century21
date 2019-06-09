<?php
//Settings for Header Image
function amora_customize_register_header( $wp_customize ) {
    $wp_customize->add_setting( 'amora_himg_style' , array(
        'default'     => 'cover',
        'sanitize_callback' => 'amora_sanitize_himg_style'
    ) );

    /* Sanitization Function */
    function amora_sanitize_himg_style( $input ) {
        if (in_array( $input, array('contain','cover') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'amora_himg_style', array(
        'label' => __('Header Image Arrangement','amora'),
        'section' => 'header_image',
        'settings' => 'amora_himg_style',
        'type' => 'select',
        'choices' => array(
            'contain' => __('Contain','amora'),
            'cover' => __('Cover Completely (Recommended)','amora'),
        )
    ) );

    $wp_customize->add_setting( 'amora_himg_align' , array(
        'default'     => 'center',
        'sanitize_callback' => 'amora_sanitize_himg_align'
    ) );

    /* Sanitization Function */
    function amora_sanitize_himg_align( $input ) {
        if (in_array( $input, array('center','left','right') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'amora_himg_align', array(
        'label' => __('Header Image Alignment','amora'),
        'section' => 'header_image',
        'settings' => 'amora_himg_align',
        'type' => 'select',
        'choices' => array(
            'center' => __('Center','amora'),
            'left' => __('Left','amora'),
            'right' => __('Right','amora'),
        )
    ) );

    $wp_customize->add_setting( 'amora_himg_repeat' , array(
        'default'     => true,
        'sanitize_callback' => 'amora_sanitize_checkbox'
    ) );

    $wp_customize->add_control(
        'amora_himg_repeat', array(
        'label' => __('Repeat Header Image','amora'),
        'section' => 'header_image',
        'settings' => 'amora_himg_repeat',
        'type' => 'checkbox',
    ) );
}
add_action( 'customize_register', 'amora_customize_register_header' );