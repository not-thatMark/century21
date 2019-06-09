<?php class RT_Twitter extends WP_Widget {
	
	///////////////////////////////////////////
	// Twitter
	///////////////////////////////////////////
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter', 'description' => __('A list of latest tweets', 'rt') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'rt-twitter' );

		/* Create the widget. */
		parent::__construct( 'rt-twitter', __('RT - Twitter', 'rt'), $widget_ops, $control_ops );
	}
	
	///////////////////////////////////////////
	// Widget
	///////////////////////////////////////////
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : 5;
		$hide_timestamp = isset( $instance['hide_timestamp'] ) ? 'false' : 'true';
		$show_follow = isset( $instance['show_follow'] ) ? ''.$instance['show_follow'] : 'false';
		$follow_text = isset( $instance['follow_text'] ) ? $instance['follow_text'] : '';
		$include_retweets = isset( $instance['include_retweets'] ) ? 'true' : 'false';
		$exclude_replies = isset( $instance['exclude_replies'] ) ? 'true' : 'false';
		$widget_id = $this->id;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		/* remove twitter.com from Twitter ID */
		$username = preg_replace( '/^(https?:\/\/)?twitter.com\//', '', $username );

		echo rt_shortcode_twitter(array(
			'username' => $username,
			'show_count' => $show_count,
			'show_timestamp' => $hide_timestamp,
			'show_follow' => $show_follow,
			'follow_text' => $follow_text,
			'include_retweets' => $include_retweets,
			'exclude_replies' => $exclude_replies,
			'is_widget' => 'true',
			'widget_id' => $widget_id
		));

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
		$instance['hide_timestamp'] = $new_instance['hide_timestamp'];
		$instance['show_follow'] = $new_instance['show_follow'];
		$instance['follow_text'] = $new_instance['follow_text'];
		$instance['include_retweets'] = $new_instance['include_retweets'];
		$instance['exclude_replies'] = $new_instance['exclude_replies'];

		// delete transient
		delete_transient( $this->id . '_rt_tweets' );

		return $instance;
	}
	
	///////////////////////////////////////////
	// Form
	///////////////////////////////////////////
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Latest Tweets', 'rt'),
			'username' => '',
			'show_count' => 5,
			'hide_timestamp' => false,
			'show_follow' => true,
			'follow_text' => __('&rarr; Follow me', 'rt'),
			'include_retweets' => false,
			'exclude_replies' => true
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'rt'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e('Twitter ID:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" type="text"/>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php _e('Show:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" value="<?php echo esc_attr( $instance['show_count'] ); ?>" size="3" type="text" /> <?php _e('tweets', 'rt'); ?>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['hide_timestamp'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_timestamp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_timestamp' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_timestamp' ) ); ?>"><?php _e('Hide timestamp', 'rt'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_follow'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_follow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_follow' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_follow' ) ); ?>"><?php _e('Display follow me button', 'rt'); ?></label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>"><?php _e('Follow me text:', 'rt'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'follow_text' ) ); ?>" value="<?php echo esc_attr( $instance['follow_text'] ); ?>" type="text" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['include_retweets'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'include_retweets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_retweets' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'include_retweets' ) ); ?>"><?php _e('Include retweets', 'rt'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['exclude_replies'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_replies' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>"><?php _e('Exclude replies', 'rt'); ?></label>
		</p>
		
		<p>
			<?php echo sprintf(__('<small>Twitter access token is required at <a href="%s">RT > Settings > Twitter</a>.</small>', 'rt'), admin_url('admin.php?page=rt#setting')); ?>
		</p>
		
		<?php
	}
}