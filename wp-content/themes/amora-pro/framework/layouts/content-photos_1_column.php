<?php
/**
 * @package amora
 */
?>
	<?php do_action('amora_before-article'); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 grid photos_2_column photos_1_column'); ?>>
	
			<div class="featured-thumb col-md-12">
				<?php if (has_post_thumbnail()) : ?>	
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('amora-pop-thumb',array(  'alt' => trim(strip_tags( $post->post_title )))); ?></a>
				<?php else: ?>
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.png"; ?>" alt="<?php the_title()?>"></a>
				<?php endif; ?>
				
				<div class="out-thumb col-md-12">
					<header class="entry-header">
						<h3 class="entry-title title-font hvr-buzz-out"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<span class="readmore"><a class="hvr-bounce-to-bottom" href="<?php the_permalink() ?>"><?php _e('View','amora'); ?></a></span>
					</header><!-- .entry-header -->
				</div><!--.out-thumb-->
					
			</div><!--.featured-thumb-->
				
			
							
	</article><!-- #post-## -->
	<?php do_action('amora_after-article'); ?>
	