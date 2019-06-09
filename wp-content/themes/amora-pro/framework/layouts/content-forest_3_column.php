<?php
/**
 * @package Amora
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-4 grid grid_3_column amora-grid'); ?>>

		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('pop-thumb',array(  'alt' => trim(strip_tags( $post->post_title )))); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>" alt="<?php the_title()?>"></a>
			<?php endif; ?>
			
			<div class="postedon"><?php amora_posted_on_icon('date'); ?></div>
			
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-12">
			<header class="entry-header">
				<h3 class="entry-title title-font"><a class="hvr-underline-reveal" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<span class="entry-excerpt"><?php the_excerpt(); ?></span>
				<span class="readmore"><a href="<?php the_permalink() ?>"><?php _e('Read More','amora'); ?></a></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
					
</article><!-- #post-## -->