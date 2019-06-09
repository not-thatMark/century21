<div id="featured-news" class="container featured-area">
	
	<div class="col-md-12">
	<?php if (get_theme_mod('amora_fn_title1')) : ?>
		<div class="section-title title-font">
			<?php echo esc_html( get_theme_mod('amora_fn_title1' ) ) ?>
		</div>
	<?php endif; ?>
	    <div class="featured-news-container">
	        <div class="fg-wrapper">
	            <?php
		            	$count = 1;
				        $args = array( 
			        	'post_type' => 'post',
			        	'posts_per_page' => 4, 
			        	'cat'  => esc_html( get_theme_mod('amora_fn_cat1',0) ),
			        	'ignore_sticky_posts' => 1,
			        	);
				        $loop = new WP_Query( $args );
				        while ( $loop->have_posts() ) : 
				        
				        	$loop->the_post(); 
				        	
				        	if ( has_post_thumbnail() ) :
				        		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID), 'amora-thumb' ); 
								$image_url = $image_data[0];
                                 else : ?>
                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder.png"; ?>" alt="<?php the_title()?>"></a>

                            <?php endif; ?>
				        	

						<div class="fg-item-container col-md-3 col-sm-3 col-xs-6 hvr-grow-shadow">
							<div class="fg-item">
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
									<img src="<?php echo $image_url; ?>" alt="<?php the_title() ?>">
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
