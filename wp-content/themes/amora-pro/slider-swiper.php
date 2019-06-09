<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
$count = get_theme_mod('amora_main_slider_count', 3);
//$slide_title = get_theme_mod('amora_slide_title'.$i);
?>
<div id="slider-bg" data-stellar-background-ratio="0.5">
	<div class="container-fluid slider-container-wrapper">
		<div class="slider-container featured-area container theme-default">
	            <div class="swiper-wrapper">
	            <?php
	            for ( $m = 1; $m <= $count; $m++ ) :

					$url = esc_url ( get_theme_mod('amora_slide_url'.$m) );
					$img = esc_url ( get_theme_mod('amora_slide_img'.$m) );
					$title = esc_html( get_theme_mod('amora_slide_title'.$m) );
					$desc = esc_html( get_theme_mod('amora_slide_desc'.$m) );
					 
					?>
					<div class="swiper-slide">
		            	<a href="<?php echo $url; ?>">
		            		<img src="<?php echo $img ?>" alt="<?php echo the_title() ?>"data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
		            	</a>
		            	<div class="slidecaption">
			                
			                <?php if ($title) : ?>
				                <div class="slide-title"><?php echo $title ?></div>
				                <div class="slide-desc"><span><?php echo $desc ?></span></div>
				            <?php endif; ?> 
						</div>
		            </div>
	             <?php endfor; ?>
	               
	            </div>
	            <?php if ( get_theme_mod('amora_slider_pager', true ) ) : ?>
	            <div class="swiper-pagination swiper-pagination-white"></div>
	            <?php endif; ?>
				
				 <?php if ( get_theme_mod('amora_slider_arrow', true ) ) : ?>
				<div class="swiper-button-next slidernext swiper-button-white"></div>
				<div class="swiper-button-prev sliderprev swiper-button-white"></div>
				<?php endif; ?>
	        </div>
	</div> 
</div>
 