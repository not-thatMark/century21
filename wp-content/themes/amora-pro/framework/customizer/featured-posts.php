<?php
//FEATURED POSTS
// CREATE THE FCA PANEL
function amora_customize_register_fp( $wp_customize ) {
    $wp_customize->add_section(
        'amora_featposts',
        array(
            'title'     => __('Featured Posts','amora'),
            'priority'  => 36,
        )
    );
//enable on home page
    $wp_customize->add_setting(
        'amora_featposts_home_enable',
        array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'amora_featposts_home_enable', array(
            'settings' => 'amora_featposts_home_enable',
            'label'    => __( 'Enable Showcase on Home/Blog.', 'amora' ),
            'section'  => 'amora_featposts',
            'type'     => 'checkbox',
        )
    );
//enable on frontpage  page
    $wp_customize->add_setting(
        'amora_featposts_fp_enable',
        array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'amora_featposts_fp_enable', array(
            'settings' => 'amora_featposts_fp_enable',
            'label'    => __( 'Enable Showcase on Front Page.', 'amora' ),
            'section'  => 'amora_featposts',
            'type'     => 'checkbox',
        )
    );

  //enable on all posts
    $wp_customize->add_setting(
        'amora_featposts_posts_enable',
        array( 'sanitize_callback' => 'amora_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'amora_featposts_posts_enable', array(
            'settings' => 'amora_featposts_posts_enable',
            'label'    => __( 'Enable Showcase on All Posts.', 'amora' ),
            'section'  => 'amora_featposts',
            'type'     => 'checkbox',
        )
    );

    //title
    $wp_customize->add_setting(
        'amora_featposts_title',
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'amora_featposts_title', array(
            'settings' => 'amora_featposts_title',
            'label'    => __( 'Title', 'amora' ),
            'section'  => 'amora_featposts',
            'type'     => 'text',
        )
    );




    $wp_customize->add_setting(
        'amora_featposts_cat',
        array( 'sanitize_callback' => 'amora_sanitize_category' )
    );


    $wp_customize->add_control(
        new Amora_WP_Customize_Category_Control(
            $wp_customize,
            'amora_featposts_cat',
            array(
                'label'    => __('Category For Featured Posts','amora'),
                'settings' => 'amora_featposts_cat',
                'section'  => 'amora_featposts'
            )
        )
    );


    $wp_customize->add_setting(
        'amora_featposts_priority',
        array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
    );

    $wp_customize->add_control(
        'amora_featposts_priority', array(
            'settings' => 'amora_featposts_priority',
            'label'    => __( 'Priority', 'amora' ),
            'section'  => 'amora_featposts',
            'type'     => 'number',
            'description' => __('Elements with Low Value of Priority will appear first.','amora'),
        )
    );
}
add_action( 'customize_register', 'amora_customize_register_fp' );