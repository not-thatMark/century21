<?php
/**
 * @package amora
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		
		<div class="entry-meta">
			<?php amora_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( !get_theme_mod('amora_disable_featimg') ) : ?>
		<div id="featured-image">
			<?php the_post_thumbnail('full'); ?>
		</div>
	<?php endif; ?>			
			
	<div class="entry-content">
		<?php the_content(); ?>
     <p> English Entry Requirement: <?php echo get_post_meta($post->ID,'english_requirement',true); ?> </p>
       <p> Course Fee: <?php echo get_post_meta($post->ID,'course_fee',true); ?></p>
       <p>Course Duration: <?php echo get_post_meta($post->ID,'course_duration',true); ?></p>
       <p>Potential Positions: <?php echo get_post_meta($post->ID,'potential_positions',true); ?></p>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'amora' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php amora_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
		<?php if (!get_theme_mod('amora_disable_nextprev',false) ): 
				amora_post_nav();
		  endif; ?>

</article><!-- #post-## -->
