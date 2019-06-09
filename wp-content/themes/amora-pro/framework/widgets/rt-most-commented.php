<?php class RT_Most_Commented extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'rt-most-commented', 'description' => __('A list with the most commented posts.', 'rt') );
		$control_ops = array( 'id_base' => 'rt-most-commented' );
		parent::__construct( 'rt-most-commented', __('RT - Most Commented', 'rt'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : 10;
		$show_excerpt = isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : false;
		$show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : false;
		$thumb_width = isset( $instance['thumb_width'] ) ? $instance['thumb_width'] : 50;
		$thumb_height = isset( $instance['thumb_height'] ) ? $instance['thumb_height'] : 50;
		$excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 55;
		$hide_title = isset( $instance['hide_title'] ) ? $instance['hide_title'] : false;
		$show_comment_count = isset( $instance['show_comment_count'] ) ? $instance['show_comment_count'] : false;

		$loop = get_posts( array(
			'numberposts' => $show_count,
			'orderby' => 'comment_count',
			'post_type' => 'post',
			'order' => 'DESC',
			'suppress_filters' => false,
		) );

		if ( $loop ) {
			
			/* Before widget (defined by themes). */
			echo $before_widget;
			
			/* Title of widget (before and after defined by themes). */
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}	
		
			echo '<ul class="feature-posts-list">';
			global $post;
			foreach ( $loop as $post ) {
				setup_postdata( $post );
				
				echo '<li>';
				
				if ( $show_thumb ) {
					$im = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
						if (!has_post_thumbnail()) {
							$im[0] = get_template_directory_uri()."/framework/widgets/images/nthumb.png";
						}
						echo "<a href='".get_the_permalink()."'><img class='post-img' src='".$im[0]."' width=".$instance['thumb_width']." height=".$instance['thumb_height']." alt='".get_the_title()."'></a>";
				}

				if( !$hide_title ){
					echo '<a style="max-width: calc( 98% - '.$instance['thumb_width'].'px);" href="' . esc_url( get_permalink() ) . '" class="feature-posts-title">' . get_the_title() . '</a>';
				}
				
				if ( $show_comment_count ){
					$comment_string = (get_comments_number() > 1)? __('comments', 'rt') : __('comment', 'rt');
					echo '<br/><small>' . get_comments_number() . ' ' . $comment_string . '</small> <br />';
				}					
				echo '</li>';
				wp_reset_postdata();
			}
			echo '</ul>';

			echo $after_widget;
		}
		
	}
	
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_count'] = $new_instance['show_count'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['thumb_width'] = $new_instance['thumb_width'];
		$instance['thumb_height'] = $new_instance['thumb_height'];
		$instance['show_excerpt'] = $new_instance['show_excerpt'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['hide_title'] = $new_instance['hide_title'];
		$instance['show_comment_count'] = $new_instance['show_comment_count'];
		
		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Most Commented Posts', 'rt'),
			'show_count' => 5,
			'show_excerpt'	=> false,
			'show_thumb' => false,
			'thumb_width' => 50,
			'thumb_height' => 50,
			'excerpt_length' => 55,
			'hide_title' => false,
			'show_comment_count' => false
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'rt'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" class="widefat" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['hide_title'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_title' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>"><?php _e('Hide post title', 'rt'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_comment_count'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comment_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comment_count' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_comment_count' ) ); ?>"><?php _e('Display comment count', 'rt'); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php _e('Number of posts:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" value="<?php echo esc_attr( $instance['show_count'] ); ?>" size="2" type="text" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_thumb'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumb' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>"><?php _e('Display post thumbnail', 'rt'); ?></label>
		</p>
		
		<?php
		// only allow thumbnail dimensions if GD library supported
		if ( function_exists('imagecreatetruecolor') ) {
		?>
		<p>
		   <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>"><?php _e('Thumbnail size', 'rt'); ?></label> <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" value="<?php echo esc_attr( $instance['thumb_width'] ); ?>" size="3" /> x <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" value="<?php echo esc_attr( $instance['thumb_height'] ); ?>" size="3" />
		</p>
		<?php
		}
		?>

		<?php
	}
}