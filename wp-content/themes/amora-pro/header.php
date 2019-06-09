<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package amora
 */
?>
<?php get_template_part('modules/header/head'); ?>
<?php wp_head(); ?>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'amora' ); ?></a>
    <?php get_template_part('modules/header/jumbosearch'); ?>
    <?php get_template_part('modules/header/top', 'bar'); ?>
    <?php get_template_part('modules/header/masthead'); ?>
	
	<div class="mega-container">
		<?php do_action('amora-before_content'); ?>
	
		<div id="content" class="site-content container">