<?php
/**
 * The template for displaying Testimonials.
 * Template Name: Testimonials
 *
 * @package amora
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php do_action('amora_primary-width') ?>">
		<main id="main" class="site-main" role="main">
		<header class="entry-header">
			<?php the_title( '<h1 class="template-entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php wp_reset_query(); 
			  wp_reset_postdata();
			  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
			$qa = array (
				'post_type'              => 'testimonial',
				'ignore_sticky_posts'    => false,
				'paged' 				 => $paged,
			);
		
		// The Query
		$recent_articles = new WP_Query( $qa );
		if ( $recent_articles->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $recent_articles->have_posts() ) : $recent_articles->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					get_template_part('framework/layouts/content', 'testimonial');  
					
				?>

			<?php endwhile; ?>
			<?php amora_pagination_queried( $recent_articles ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
