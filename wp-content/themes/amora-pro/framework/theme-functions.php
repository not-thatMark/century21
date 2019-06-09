<?php
/*
 * @package amora, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
 
 
class Amora_Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="menu-desc">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

class Amora_Menu_With_Icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/*
 * Pagination Function. Implements core paginate_links function.
 */
function amora_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

//Quick Fixes for Custom Post Types.
function amora_pagination_queried( $query ) {
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . __(' of ', 'amora') . $query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class Amora_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'amora' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
} 

if ( class_exists('WP_Customize_Control') && class_exists('woocommerce') ) {
	class Amora_WP_Customize_Product_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'amora' ),
                    'option_none_value' => '0',
                    'taxonomy'          => 'product_cat',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}    
if (class_exists('WP_Customize_Control')) {
	class Amora_WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}

/*
** Function to Trim the length of Excerpt and More
*/
function amora_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'amora_excerpt_length', 999 );

function amora_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'amora_excerpt_more' );


/*
** Function to check if Sidebar is enabled on Current Page 
*/
function amora_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('amora_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('amora_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('amora_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('amora_disable_sidebar_archive') && is_archive() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('amora_disable_sidebar_portfolio') && (get_post_type() == 'portfolio') ) :
		$load_sidebar = false;			
	elseif ( get_post_meta( get_the_ID(), 'enable-full-width', true ) )	:
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Load Footer Sidebar
*/
function amora_load_footer_sidebar() {
	$cols = get_theme_mod('amora_footer_sidebar_columns','4');
	get_template_part('footer/footer', $cols );
}

/*
**	Determining Sidebar and Primary Width
*/
function amora_primary_class() {
	$sw = esc_html( get_theme_mod('amora_sidebar_width',4) );
	$class = "col-md-".(12-$sw);
	
	if ( !amora_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('amora_primary-width', 'amora_primary_class');

function amora_secondary_class() {
	$sw = esc_html( get_theme_mod('amora_sidebar_width',4) );
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('amora_secondary-width', 'amora_secondary_class');

/*
**	Helper Function to Convert Colors
*/
function amora_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function amora_fade($color, $val) {
	return "rgba(".amora_hex2rgb($color).",". $val.")";
}



/*
** Function to Set Main Class 
*/
function amora_get_main_class(){
	
	$layout = get_theme_mod('amora_blog_layout');
	$template = get_post_meta( get_the_id(), '_wp_page_template', true );
	if ( $template == 'templates/template-blog-amora.php' ) {
		$mason = true;
	} else { 
		$mason = false;
	}
	if ($layout == 'amora' || $mason) {
	    	echo 'masonry-main';
	}		
}
add_action('amora_main-class', 'amora_get_main_class');


/*
** Function to Get Theme Layout 
*/
function amora_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('amora_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('amora_blog_layout') );
	else :
		get_template_part( $ldir ,'grid');	
	endif;	
}
add_action('amora_blog_layout', 'amora_get_blog_layout');

/*
** Function to Get Portfolio Archive Layout 
*/
function amora_get_portfolio_layout(){
	static $amora_post_count = 0;
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('amora_portfolio_layout') ) :
		get_template_part( $ldir , get_theme_mod('amora_portfolio_layout') );
	else :
		get_template_part( $ldir ,'amora');	
	endif;	
}
add_action('amora_portfolio_layout', 'amora_get_portfolio_layout');

/*
** Function to Render Featured Category Area for Front Page
*/
function amora_featured_posts( $title, $category_id = 0, $icon = "fa-star"  ) { ?>
	
	<div class="featured-section">
		
		<div class="section-title">
			<i class="fa <?php echo esc_attr($icon); ?>"></i><span><?php echo esc_html($title); ?></span>
		</div>
		
		<?php /* Start the Loop */  
		$args = array( 
			'posts_per_page' => 3,
			'cat' => $category_id,
			'ignore_sticky_posts' => true,
		);
		
		$lastposts = new WP_Query($args);
		
		while ( $lastposts->have_posts() ) :
		  $lastposts->the_post(); 
		  
		  global $amora_fpost_ids;
		  $amora_fpost_ids[] = get_the_id(); 
		  
		 	
		
		  ?> 	
				
		<article id="post-<?php the_ID(); ?>" <?php post_class('item col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-4'); ?>>
			<div class="item-container">
					<?php if (has_post_thumbnail()) : ?>	
						<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('amora-thumb'); ?></a>
					<?php else : ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/featpostthumb.jpg"; ?>"></a>

					<?php endif; ?>
					<div class="featured-caption">
						<a class="post-title" href="<?php the_permalink() ?>"><?php echo the_title(); ?></a>
						<span class="postdate title-font"><?php the_time(__('M j, Y','amora')); ?></span>
					</div>
					
			</div>		
				
		</article><!-- #post-## -->
			
		<?php endwhile; 
		wp_reset_postdata();?>
			
	</div>	
	
<?php }
//Create an Array to Store Post Ids of all posts that have been displayed already.
$amora_fpost_ids = array();
			
//Function to Exclude already displayed posts form the Homepage.
for ($i = 1; $i < 3; $i++ ) :
	if (get_theme_mod('amora_featposts_enable'.$i) && get_theme_mod('amora_featposts_cat'.$i) ) :
		
		$args = array( 
			'posts_per_page' => 3,
			'cat' => get_theme_mod('amora_featposts_cat'.$i),
			'ignore_sticky_posts' => true,
		);
		
		$lastposts = new WP_Query($args);
		
		while ( $lastposts->have_posts() ) :
		  $lastposts->the_post(); 
		  
		  global $amora_fpost_ids;
		  $amora_fpost_ids[] = get_the_id(); 
		  
		 endwhile; 
	endif;	
	
	wp_reset_postdata();
		
endfor;
		
function amora_exclude_single_posts_home($query) {		
global $amora_fpost_ids;
if ($query->is_home() && $query->is_main_query()) {
    $query->set('post__not_in', $amora_fpost_ids);
  }
}	
add_action('pre_get_posts', 'amora_exclude_single_posts_home');


/*
** Function to Deal with Elements of Inequal Heights, Enclose them in a bootstrap row.
*/
function amora_open_div_row() {
	echo "<div class='row grid-row col-md-12'>";
}
function amora_close_div_row() {
	echo "</div><!--.grid-row-->";
}


function amora_before_article() {

	global $amora_post_count;
	$array_2_3_4 = array('grid_2_column',
							'grid_3_column',
							'grid_4_column',
							'photos_3_column',
							'photos_2_column',
							'amora',	//2 col		
							'amora_3_column',	
							'templates/template-blog-amora.php',	
							'templates/template-blog-amora3c.php',			
							'templates/template-blog-grid3c.php',
							'templates/template-blog-grid2c.php', 
							'templates/template-blog-grid4c.php',
							'templates/template-blog-photos3c.php',
							'templates/template-blog-photos2c.php'
						);
	//wp_reset_postdata();	- Don't Reset any Data, because we are not using get_post_meta	
	//See what the get_queried_object_id() function does. Though, the Query is reset in template files.			
	//For 2,3,4 Column Posts
	$page_template = get_post_meta( get_queried_object_id(), '_wp_page_template', true );
	$amora_layout = get_theme_mod('amora_blog_layout'); //BUG FIXER
	if (is_page_template() ) : //Disable input from amora Layout if we are in a page template.
		$amora_layout = 'none';
	endif;
	
	if ( in_array( $amora_layout, $array_2_3_4 ) || in_array( $page_template, $array_2_3_4 ) ) : 
			 if ( $amora_post_count  == 0 ) {
			  	amora_open_div_row();
			  }
	endif;	  	
}
add_action('amora_before-article', 'amora_before_article');

/* Pre and Post Article Hooking */
function amora_after_article() {
	global $amora_post_count;
	//echo $amora_post_count;
	wp_reset_postdata();
	$template = get_post_meta( get_the_id(), '_wp_page_template', true );
	$amora_layout = get_theme_mod('amora_blog_layout'); //BUG FIXER
	
	if (is_page_template() ) : //Disable input from amora Layout if we are in a page template.
		$amora_layout = 'none';
	endif;
	
		
	//For 3 Column Posts
	if (   ( $amora_layout == 'grid_3_column' ) 
		|| ( $amora_layout == 'photos_3_column' )
		|| ( $amora_layout == 'amora_3_column' )
 		|| ( $template == 'templates/template-blog-grid3c.php' )
 		|| ( $template == 'templates/template-blog-amora3c.php' )
 		|| ( $template == 'templates/template-blog-photos3c.php' ) ):
		
		

		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	amora_close_div_row();
		else :
			if ( ( $amora_post_count ) == 2 ) {
			 	amora_close_div_row();
				$amora_post_count = 0;
				}
			else {
				$amora_post_count++;
			}
		endif;		
		
	//For 2 Column Posts
	elseif ( ( $amora_layout == 'grid_2_column' )
		|| ( $amora_layout == 'photos_2_column' )
		|| ( $amora_layout == 'amora' )
		|| ( $template == 'templates/template-blog-grid2c.php' )
		|| ( $template == 'templates/template-blog-amora.php' )
		|| ( $template == 'templates/template-blog-photos2c.php' ) ):
		
		
		
		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	amora_close_div_row();
			 	$amora_post_count = 0;
		else :
			if ( ( $amora_post_count ) == 1 ) {
			 	amora_close_div_row();
				$amora_post_count = 0;
				}
			else {
				$amora_post_count++;
			}
		endif;		
	
	elseif ( ( $amora_layout == 'grid_4_column' )
		|| ( $template == 'templates/template-blog-grid4c.php' ) ):
		
		
		
		global $wp_query;
		if (($wp_query->current_post +1) == ($wp_query->post_count)) :
			 	amora_close_div_row();
		else :
			if ( ( $amora_post_count ) == 3 ) {
			 	amora_close_div_row();
				$amora_post_count = 0;
				}
			else {
				$amora_post_count++;
			}
		endif;		
	endif;
	
}
add_action('amora_after-article', 'amora_after_article');



/*
** Function to check if Component is Enabled.
*/
function amora_is_enabled( $component ) {
	
	wp_reset_postdata();
	$return_val = false;
	
	switch ($component) {
        case 'featposts':
            if ( ( get_theme_mod('amora_featposts_home_enable' ) && is_home() )
                || ( get_theme_mod('amora_featposts_fp_enable' ) && is_front_page() )
                || ( get_theme_mod('amora_featposts_posts_enable' ) && is_single() )
                ||( get_post_meta( get_the_ID(), 'enable-fp-posts', true ) ) ) :
                $return_val = true;
            endif;
            break;
		case 'slider' :
		
			if ( ( get_theme_mod('amora_main_slider_enable' ) && is_home() )
				|| ( get_theme_mod('amora_main_slider_enable_front' ) && is_front_page() )
				|| ( get_theme_mod('amora_main_slider_enable_posts' ) && is_single() )
				|| ( get_theme_mod('amora_main_slider_enable_pages' ) && is_page() )
				||( get_post_meta( get_the_ID(), 'enable-slider', true ) ) ) :
					$return_val = true;
			endif;
			break;
		
		case 'featured-products' :
		
			if ( ( get_theme_mod('amora_box_enable') && ( is_home() ) )
				|| ( get_theme_mod('amora_box_enable_front') && ( is_front_page() ) )
				|| ( get_post_meta( get_the_ID(), 'enable-sqbx', true ) ) ) :
					$return_val = true;
				endif;
				break;
		
		case 'coverflow-products' :
		
			 if ( ( get_theme_mod('amora_coverflow_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_coverflow_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-coverflow', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'featured-posts' :
		
			 if ( ( get_theme_mod('amora_a_box_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_a_box_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-sqbx-posts', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'coverflow-posts' :
		
			 if ( ( get_theme_mod('amora_a_coverflow_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_a_coverflow_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-coverflow-posts', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;
			 	
		case 'showcase' :
		
			 if ( ( get_theme_mod('amora_showcase_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_showcase_enable_posts') && ( is_single() ) )
			 	|| ( get_theme_mod('amora_showcase_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-showcase', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;
			 	
		case 'grid' :
		
			 if ( ( get_theme_mod('amora_grid_enable') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_grid_enable_posts') && ( is_single() ) )
			 	|| ( get_theme_mod('amora_grid_enable_front') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-grid', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'fn1' :
		
			 if ( ( get_theme_mod('amora_fn_enable1') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_fn_enable_posts1') && ( is_single() ) )
			 	|| ( get_theme_mod('amora_fn_enable_front1') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-fn1', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
		case 'fn2' :
		
			 if ( ( get_theme_mod('amora_fn_enable2') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_fn_enable_posts2') && ( is_single() ) )
			 	|| ( get_theme_mod('amora_fn_enable_front2') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-fn2', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;	
			 	
			 	
		case 'fn3' :
		
			 if ( ( get_theme_mod('amora_fn_enable3') && ( is_home() ) )
			 	|| ( get_theme_mod('amora_fn_enable_posts3') && ( is_single() ) )
			 	|| ( get_theme_mod('amora_fn_enable_front3') && ( is_front_page() ) )
			 	|| ( get_post_meta( get_the_ID(), 'enable-fn3', true ) ) ) : 
			 		$return_val = true;
			 	endif;
			 	break;		 		 		 	 			 		 	 		 		
									
	}//endswitch
	
	return $return_val;
	
}

/*
**	Hook Just before content. To Display Featured Content and Slider.
*/
function amora_display_fc() {
	
		//Nested Function
		function show($s) {
			switch ($s) {
                case 'featposts':
                    if  ( amora_is_enabled( 'featposts' ) )
                        get_template_part('featured','posts');
                    break;
                case 'main_slider' :
					if  ( amora_is_enabled( 'slider' ) )
						get_template_part('slider', 'swiper' );
					break;
				case 'showcase':
					if  ( amora_is_enabled( 'showcase' ) )
						get_template_part('featured','showcase' );
					break;
				case 'a_coverflow':
					if  ( amora_is_enabled( 'coverflow-posts' ) )
						get_template_part('coverflow', 'posts');
					break;
				case 'fn1':
					if  ( amora_is_enabled( 'fn1' ) )
						get_template_part('featured', 'news');
					break;		
				case 'fn2':
					if  ( amora_is_enabled( 'fn2' ) )
						get_template_part('featured', 'news2');
					break;
				case 'fn3':
					if  ( amora_is_enabled( 'fn3' ) )
						get_template_part('featured', 'news3');
					break;
				case 'box' :
					if  ( amora_is_enabled( 'featured-products' ) )
						get_template_part('featured', 'products');
					break;
				case 'coverflow';
					if  ( amora_is_enabled( 'coverflow-products' ) )
						get_template_part('coverflow', 'product'); 
					break;
				case 'topad':
					if ( get_theme_mod('amora_topad') )
						get_template_part('topad');
					break;	
			}	
					
		}	
		
		//get order of components
		$list = array('main_slider','showcase','featposts','fn1','fn2','fn3','coverflow','box','a_coverflow','a_box','topad'); //Write Them in their Default Order of Appearance.
		$order = array();
		
		$x = 0;
		foreach ($list as $i) {
			if( get_theme_mod('amora_'.$i.'_priority') == 10 ) : //Customizer Defaults Loaded
				$order[] = 10 + $x;

			else :		
				$order[] = get_theme_mod('amora_'.$i.'_priority' , 10 + $x);
			endif;	
			$x += 0.01; //Use Decimel Because users can set priority as 11 too.
		}
		
		$sorted = array_combine($order, $list);
		ksort($sorted); //Sort on the Value of Keys

    $sorted = array_values($sorted); //Fetch only the values, get rid of keys.

    //Display the Components
		foreach($sorted as $s) {
				show($s);
		}	
		
}
add_action('amora-before_content', 'amora_display_fc');


/*
** amora Render Slider
*/
function amora_render_slider() {
	$amora_slider = array(
		'speed' => get_theme_mod('amora_slider_speed', 500 ),
		'autoplay' => get_theme_mod('amora_slider_pause', 5000 ), //Autoplay = 0 to disable, else time between slides
		'effect' => get_theme_mod('amora_slider_effect', 'fade' )
	);
	wp_localize_script( 'amora-custom-js', 'slider_object', $amora_slider );
}
add_action('wp_enqueue_scripts', 'amora_render_slider', 20);


/*
** Header custom js
*/
function amora_header_js() {
	if ( get_theme_mod('amora_custom_js') ) 
		echo "<script>".get_theme_mod('amora_custom_js')."</script>";
		
}
add_action('wp_head', 'amora_header_js');

/*
** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
	require get_template_directory() . '/framework/woocommerce.php';
endif;


/*
** Load Custom Widgets
*/
require get_template_directory() . '/framework/widgets/recent-posts.php';
//require get_template_directory() . '/framework/widgets/video.php'; BUGGED
//require get_template_directory() . '/framework/widgets/featured-posts.php'; BUGGED
require get_template_directory() . '/framework/widgets/rt-featured-posts.php';
require get_template_directory() . '/framework/widgets/rt-flickr.php';
require get_template_directory() . '/framework/widgets/rt-most-commented.php';
require get_template_directory() . '/framework/widgets/rt-recent-comments.php';
require get_template_directory() . '/framework/widgets/rt-social.php';

function rt_register_widgets() {
	register_widget('RT_Feature_Posts');
	register_widget('RT_Recent_Comments');
	register_widget('RT_Social_Links');
	register_widget('RT_Flickr');
	register_widget('RT_Most_Commented');
}
add_action('widgets_init', 'rt_register_widgets', 1);


/**
 * Include Meta Boxes.
 */
 
require get_template_directory() . '/framework/metaboxes/page-attributes.php';
require get_template_directory() . '/framework/metaboxes/display-options.php';


