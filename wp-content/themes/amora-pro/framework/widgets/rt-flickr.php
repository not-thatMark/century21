<?php class RT_Flickr extends WP_Widget {
	
	///////////////////////////////////////////
	// Flickr
	///////////////////////////////////////////
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'flickr', 'description' => __('A reel of latest photos from Flickr', 'rt') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'rt-flickr' );

		/* Create the widget. */
		parent::__construct( 'rt-flickr', __('RT - Flickr', 'rt'), $widget_ops, $control_ops );
	}
	
	///////////////////////////////////////////
	// Widget
	///////////////////////////////////////////
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : '10';
		$show_link = isset( $instance['show_link'] ) ? $instance['show_link'] : false;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}	
		
		echo '<div id="flickr_badge_wrapper" class="clearfix">
				<script type="text/javascript" src="' . esc_url(  'http://www.flickr.com/badge_code_v2.gne'  . '?count=' . $show_count . '.&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $username ) . '"></script>
			</div>';
		if( $show_link )
			echo '<a class="myprofile" href="' . esc_url( 'http://www.flickr.com/photos/' . $username . '/' ) . '">' . __( 'View my Flickr photostream', 'rt' ) . '</a>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	///////////////////////////////////////////
	// Update
	///////////////////////////////////////////
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = $new_instance['username'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['show_link'] = $new_instance['show_link'];
		return $instance;
	}
	
	///////////////////////////////////////////
	// Form
	///////////////////////////////////////////
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Recent Photos', 'rt'),
			'username' => '',
			'show_count' => 10,
			'show_link' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'rt'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" width="100%" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e('Flickr ID:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" /><br />
			<small><?php printf( __( '* Find your Flickr ID: <a href="%s" target="_blank">idGettr</a>', 'rt' ), 'http://www.idgettr.com' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php _e('Show:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" value="<?php echo esc_attr( $instance['show_count'] ); ?>" size="2" /> <?php _e('photos', 'rt'); ?>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_link'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_link' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_link' ) ); ?>"><?php _e('Show link to account', 'rt'); ?></label>
		</p>

		<?php
	}
}