<?php class RT_Feature_Posts extends WP_Widget {
	
	///////////////////////////////////////////
	// Feature Posts
	///////////////////////////////////////////
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'feature-posts', 'description' => __('A list of posts, optionally filter by category.', 'rt') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'rt-feature-posts' );

		/* Create the widget. */
		parent::__construct( 'rt-feature-posts', __('RT - Feature Posts', 'rt'), $widget_ops, $control_ops );
	}
	
	///////////////////////////////////////////
	// Widget
	///////////////////////////////////////////
	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$category 		= isset( $instance['category'] ) ? $instance['category'] : 0;
		$show_count 	= isset( $instance['show_count'] ) ? $instance['show_count'] : 5;
		$show_date 		= isset( $instance['show_date'] ) ? true : false;
		$show_thumb 	= isset( $instance['show_thumb'] ) ? true : false;
		$display 		= isset( $instance['display'] )? $instance['display'] : false;
		$show_excerpt 	= isset( $instance['show_excerpt'] ) && $instance['show_excerpt'] ? true : false;
		$excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 55;
		$show_title 	= isset( $instance['hide_title'] ) ? false : true;
		$orderby 		= isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
		$order 			= isset( $instance['order'] ) ? $instance['order'] : 'DESC';

		$query_opts = apply_filters( 'rt_query', array(
			'posts_per_page' => $show_count,
			'post_type' => 'post',
			'orderby' => $orderby,
			'order' => $order,
			'suppress_filters' => false,
		), $instance, $this->id_base );
		if ( $category ) $query_opts['cat'] = $category;
		
		$loop = get_posts($query_opts);
		
		if($loop) {
			
			/* Before widget (defined by themes). */
			echo $before_widget;
			
			/* Title of widget (before and after defined by themes). */
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo '<ul class="feature-posts-list">';

			// Save current post
			global $post;
			$saved_post = $post;

			foreach ($loop as $post) {
				setup_postdata($post);
				echo '<li>';

					$link = get_post_meta( $post->ID, 'external_link', true );
					if ( ! isset( $link ) || '' == $link ) {
						$link = get_permalink();
					}

					if ( $show_thumb ) {
						$im = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
						if (!has_post_thumbnail()) {
							$im[0] = get_template_directory_uri()."/framework/widgets/images/nthumb.png";
						}
						echo "<a href='".$link."'><img class='post-img' src='".$im[0]."' width=".$instance['thumb_width']." height=".$instance['thumb_height']." alt='". get_the_title()."'></a>";
					}
					if (!isset($instance['thumb_width'])) { $instance['thumb_width'] = 50; }
					if ( $show_title ) echo '<a style="max-width: calc( 95% - '.$instance['thumb_width'].'px);" href="' . esc_url( $link ) . '" class="feature-posts-title">' . get_the_title() . '</a> <br />';

					if ( $show_date ) echo '<small>' . get_the_date( apply_filters( 'rt_filter_widget_date', '' ) ) . '</small> <br />';

				echo '</li>';
			} //end for each

			// Restore current post
			wp_reset_postdata();
			setup_postdata( $saved_post );

			echo '</ul>';

			/* After widget (defined by themes). */
			echo $after_widget;
			
		}//end if $loop
		
	}
	
	///////////////////////////////////////////
	// Update
	///////////////////////////////////////////
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = $new_instance['category'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_thumb'] = $new_instance['show_thumb'];
		$instance['display'] = $new_instance['display'];
		$instance['hide_title'] = $new_instance['hide_title'];
		$instance['thumb_width'] = $new_instance['thumb_width'];
		$instance['thumb_height'] = $new_instance['thumb_height'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];

		return $instance;
	}
	
	///////////////////////////////////////////
	// Form
	///////////////////////////////////////////
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title'          => __( 'Recent Posts', 'rt' ),
			'category'       => 0,
			'show_count'     => 5,
			'show_date'      => false,
			'show_thumb'     => false,
			'display'        => 'none',
			'hide_title'     => false,
			'thumb_width'    => 50,
			'thumb_height'   => 50,
			'excerpt_length' => 55,
			'orderby' => 'date',
			'order' => 'DESC',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'rt'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" width="100%" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php _e('Category:', 'rt'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
				<option value="0" <?php if ( !$instance['category'] ) echo 'selected="selected"'; ?>><?php _e('All', 'rt'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				
				foreach( $categories as $cat ) {
					echo '<option value="' . esc_attr( $cat->cat_ID ) . '"';
					
					if ( $cat->cat_ID == $instance['category'] ) echo  ' selected="selected"';
					
					echo '>' . esc_html( $cat->cat_name . ' (' . $cat->category_count . ')' );
					
					echo '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php _e( 'Order By', 'rt' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<?php
				$orderby_options = apply_filters( 'rt_posts_widget_orderby', array(
						'date'          => __( 'Date (default)', 'rt' ),
						'rand'          => __( 'Random', 'rt' ),
						'author'        => __( 'Author', 'rt' ),
						'title'         => __( 'Post Title', 'rt' ),
						'comment_count' => __( 'Comments Number', 'rt' ),
						'modified'      => __( 'Modified Date', 'rt' ),
						'name'          => __( 'Post Slug', 'rt' ),
						'ID'            => __( 'Post ID', 'rt' )
					)
				);
				foreach ( $orderby_options as $criteria => $name ) {
					echo '<option value="' . esc_attr( $criteria ) . '"' . selected( isset( $instance['orderby'] ) ? $instance['orderby'] : 'date', $criteria, false ) . '>';
					echo esc_html( $name );
					echo '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e( 'Order', 'rt' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<?php
				$order_options = array(
					'DESC'	=> __( 'Descending (default)', 'rt' ),
					'ASC'  => __( 'Ascending', 'rt' ),
				);
				foreach ( $order_options as $criteria => $name ) {
					echo '<option value="' . esc_attr( $criteria ) . '"' . selected( isset( $instance['order'] ) ? $instance['order'] : 'date', $criteria, false ) . '>';
					echo esc_html( $name );
					echo '</option>';
				}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php _e('Show:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" value="<?php echo esc_attr( $instance['show_count'] ); ?>" size="2" /> <?php _e('posts', 'rt'); ?>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['hide_title'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_title' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>"><?php _e('Hide post title', 'rt'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e('Display post date', 'rt'); ?></label>
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