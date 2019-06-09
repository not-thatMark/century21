<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package amora
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php do_action('amora_primary-width') ?>">
		
		<?php			
		for ($i = 1; $i < 3; $i++ ) :
			if (get_theme_mod('amora_featposts_enable'.$i) ) :
				//Call the Function to Display the Featured Posts
				amora_featured_posts( 
					get_theme_mod('amora_featposts_title'.$i,
					__("Section Title","amora")),
					get_theme_mod('amora_featposts_cat'.$i,0),
					get_theme_mod('amora_featposts_icon'.$i,'fa-star')
				); 
				
			endif;	
		endfor;
		?>

		<?php if ( is_home() ) : ?>
			<div class="section-title"><span><?php echo esc_html(get_theme_mod('amora_blog_title',__('Latest Blog Posts','amora'))); ?></span></div> <?php
		endif; ?>
		<main id="main" class="site-main <?php do_action('amora_main-class') ?>" role="main">
		
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					do_action('amora_blog_layout'); 
					
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'modules/content/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
		<?php if ( have_posts() ) { amora_pagination(); } ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
