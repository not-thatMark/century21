<?php
/*
**   Custom Modifcations in CSS depending on user settings.
*/
function amora_custom_css_mods() {
	echo "<style id='custom-css-mods'>";


	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('amora_disable_nav_desc') ) :
		echo "#site-navigation ul li a { padding: 16px 12px; }";
	endif;


	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('amora_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;

	if ( get_theme_mod('amora_title_font') ) :
		echo ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('amora_title_font','Bree Serif') )."; }";
	endif;

	if ( get_theme_mod('amora_body_font') ) :
		echo "body { font-family: ".esc_html( get_theme_mod('amora_body_font','Bitter') )."; }";
	endif;

	if ( get_theme_mod('amora_site_titlecolor', '#fff') ) :
		echo "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('amora_site_titlecolor', '#fff') )."; }";
	endif;


	if ( get_theme_mod('amora_header_desccolor','#fff') ) :
		echo "#masthead h2.site-description { color: ".esc_html( get_theme_mod('amora_header_desccolor','#fff') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		echo '.pagination { display: none; }';

	if ( get_theme_mod('amora_sidebar_loc') == 'left' ) :
		echo "#secondary { float: left; }#primary,#primary-mono { float: right; }";
	endif;

	if ( get_theme_mod('amora_site_layout') == 'boxed' ) :
		echo "#page { max-width: 1170px; margin: 20px auto; } @media screen and (min-width: 992px) { #top-bar { padding: 3px 10px; } #top-bar .social-icons { margin-right: 15px; } }";
	endif;

	wp_reset_postdata();
	if ( get_post_meta( get_the_ID(), 'hide-title', true ) ):
		echo "#primary-mono h1.entry-title, .template-entry-title { display: none; }";
	endif;
	wp_reset_postdata();

	if ( get_theme_mod('amora_woo_layout',3) ) :
		$c = get_theme_mod('amora_woo_layout',3);
		if ($c == 3)
			echo ".woocommerce ul.products li.product { width: 30.75%; }";

		if ($c == 4)
			echo ".woocommerce ul.products li.product { width: 22.05%; }";

		if ($c == 2)
			echo ".woocommerce ul.products li.product { width: 48%; }";
	endif;

	if ( get_theme_mod('amora_logo_resize') ) :
		$val = esc_html( get_theme_mod('amora_logo_resize') )/100;
		echo "#masthead .custom-logo { transform-origin: center; transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;



    //typography
    // page & post fontsize
    if(get_theme_mod('amora_content_page_post_fontsize_set')):
        $val = get_theme_mod('amora_content_page_post_fontsize_set');
        if($val=='small'):
            echo "#primary-mono .entry-content{ font-size:12px;}";
        elseif ($val=='medium'):
            echo "#primary-mono .entry-content{ font-size:16px;}";
        elseif ($val=='large'):
            echo "#primary-mono .entry-content{ font-size:18px;}";
        elseif ($val=='extra-large'):
            echo "#primary-mono .entry-content{ font-size:20px;}";
        endif;
    else:
        echo "#primary-mono .entry-content{ font-size:14px;}";
    endif;

    //site title font size
    //var_dump(get_theme_mod('amora_content_site_fontsize_set'));
    if(get_theme_mod('amora_content_site_title_fontsize_set')):
        $val=get_theme_mod('amora_content_site_title_fontsize_set');
        if($val != 'default'):
            echo "#masthead h1.site-title {font-size:".$val."px !important;}";
        else:
            echo "#masthead h1.site-title {font-size:48"."px;}";
        endif;
    endif;

    //site desc font size
    //var_dump(get_theme_mod('amora_content_site_desc_fontsize_set'));
    if(get_theme_mod('amora_content_site_desc_fontsize_set')):
        $val=get_theme_mod('amora_content_site_desc_fontsize_set');
        if($val != 'default'):
            echo "#masthead h2.site-description {font-size:".$val."px !important;}";
        else:
            echo "#masthead h2.site-description {font-size:15"."px;}";
        endif;
    endif;
		
		
		
		
		
		
		
		
		
		
		

	echo "</style>";
}

add_action('wp_head', 'amora_custom_css_mods');