<?php class RT_Social_Links extends WP_Widget {
	
	///////////////////////////////////////////
	// Feature Posts
	///////////////////////////////////////////
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'rt-social-links', 'description' => __('Social media links.', 'rt') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'rt-social-links' );

		/* Create the widget. */
		parent::__construct( 'rt-social-links', __('RT - Social Links', 'rt'), $widget_ops, $control_ops );

	}

	///////////////////////////////////////////
	// Widget
	///////////////////////////////////////////
	function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/* Before widget (defined by themes). */
		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		//$data = rt_get_data();

		
		$icon_size = isset($instance['icon_size']) && '' != $instance['icon_size']? $instance['icon_size'] : 'icon-medium';
		
		echo '<ul class="social-links">';

				for ($i = 1; $i < 12; $i++) : 
					$social = get_theme_mod('amora_social_'.$i);
					if ( ($social != 'none') && ($social != '') ) : ?>
					<a class="<?php echo $icon_size; ?>" href="<?php echo get_theme_mod('amora_social_url'.$i); ?>">
						<i class="fa fa-fw fa-<?php echo $social; ?>"></i>
					</a>
					<?php endif;
				
				endfor;			
			echo '</ul>';
			
		

		/* After widget (defined by themes). */
		echo $args['after_widget'];
	}
	
	
	///////////////////////////////////////////
	// Update
	///////////////////////////////////////////
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = $new_instance['icon_size'];
		$instance['orientation'] = $new_instance['orientation'];

		return $instance;
	}
	
	///////////////////////////////////////////
	// Form
	///////////////////////////////////////////
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => '',
			
			'icon_size' => 'icon-medium',
			'orientation' => 'horizontal',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'rt'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php _e('Icon Size', 'rt'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>">
				<?php
				$sizes = array(
					'icon-small' => __( 'Small', 'rt' ),
					'icon-medium' => __( 'Medium', 'rt' ),
					'icon-large' => __( 'Large', 'rt' ),
				);
				foreach( $sizes as $size => $name ) {
					echo '<option value="' . esc_attr( $size ) . '"' . selected( isset( $instance['icon_size'] )? $instance['icon_size'] : 'icon-medium', $size, false ) . '>';
						echo esc_html( $name );
					echo '</option>';
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orientation' ) ); ?>"><?php _e('Orientation', 'rt'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orientation' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orientation' ) ); ?>">
				<?php
				$orientation_options = array(
					'vertical'   => __( 'Vertical', 'rt' ),
					'horizontal' => __( 'Horizontal', 'rt' ),
				);
				foreach( $orientation_options as $orientation => $name ) {
					echo '<option value="' . esc_attr( $orientation ) . '"' . selected( isset( $instance['orientation'] )? $instance['orientation'] : 'horizontal', $orientation, false ) . '>';
						echo esc_html( $name );
					echo '</option>';
				}
				?>
			</select>
		</p>
		
		<p>
			<?php echo wp_kses_post( sprintf( __( '<small>Configure links at <a href="%s">Appearance > Customize > Social Icons</a>.</small>', 'rt' ), esc_url( admin_url( 'customize.php' ) ) ) ); ?>
		</p>
		<?php
	}
}