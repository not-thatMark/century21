<?php
/*
*
* Dynamically Design the theme using Less Compiler for PHP
* Compiler Runs only when Customizer is Loaded, not for users. So no effect on site performance.
*
*/	

//Compatibility with plugins using the Less Compile
if (!class_exists('lessc')) : 
require get_template_directory() ."/framework/designer/lessc.inc.php";
endif; 

function amora_exec_less() {
	$less = new lessc;
	$inputFile = get_template_directory() ."/assets/theme-styles/skins/custom.less";
	$outputFile = get_template_directory() ."/assets/theme-styles/css/custom.css";

	$less->setVariables(array(
		"accent" => get_theme_mod('amora_skin_var_accent','#8890d5'),
		"background" => get_theme_mod('amora_skin_var_background','#fff'),
		"header-color" => get_theme_mod('amora_skin_var_headercolor','#eee'),
		"onaccent" => get_theme_mod('amora_skin_var_onaccent','#fff'),
		"content" => get_theme_mod('amora_skin_var_content','#444'),
	  
	));
	
	
	if ( is_customize_preview() )  {
		try {
			$less->compileFile( $inputFile, $outputFile ); 
		} catch(exception $e) {
			echo "fatal error: " . $e->getMessage();
		}
		
	} 
	else {
		$less->checkedCompile( $inputFile, $outputFile );
	}

}	
add_action('wp_head','amora_exec_less', 1);