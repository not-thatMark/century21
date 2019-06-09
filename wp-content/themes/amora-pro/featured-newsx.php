<?php if ( get_theme_mod('amora_fn_enable') && is_front_page() ) : ?>
<div id="featured-news-2" class="container">
	
	<div class="col-md-12">
	<?php if (get_theme_mod('amora_fn_title')) : ?>
		<div class="section-title title-font">
			<?php echo esc_html( get_theme_mod('amora_fn_title' ) ) ?>
		</div>
	<?php endif; ?>
	    <div class="featured-news-container">
	        <div class="fg-wrapper solid-hover">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 4, 
			        	'cat'  => esc_html( get_theme_mod('amora_fn_cat',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        
				        	$loop->the_post(); 
				        	
				        	if ( has_post_thumbnail() ) :
				        		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'amora-thumb');
								$image_url = $image_data[0]; 
							endif;		
				        	
				        ?>
						<div class="image-container image-container-disintegrate col-md-3 col-sm-3 col-xs-6">
							<div class="disintegrate-container disintegrate-h-up">
								<img src="<?php echo $image_url; ?>" alt="<?php the_title()?>" class="image-clip-1">
								<img src="<?php echo $image_url; ?>" alt="<?php the_title()?>" class="image-clip-2">
								<img src="<?php echo $image_url; ?>" alt="<?php the_title()?>" class="image-clip-3">
								<img src="<?php echo $image_url; ?>"  alt="<?php the_title()?>"class="image-clip-4">
								<img src="<?php echo $image_url; ?>" alt="<?php the_title()?>" class="image-clip-5">
							</div>	
							
							<div class="fg-item image-overlay-container">
								
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
									<div class="product-details">
										<h3><?php the_title(); ?></h3>
									</div>
								</a>
								</div>
						</div>					
						 <?php 
							 $count++;
							 endwhile; ?>
						 <?php wp_reset_query(); ?>	
						
		        </div>	        
	    </div>
	</div>     
</div>
<?php endif; ?>