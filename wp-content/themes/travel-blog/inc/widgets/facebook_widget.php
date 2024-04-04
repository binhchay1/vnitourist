<?php

class Travel_Blog_Facebook_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'travel_blog_facebook_widget',
			'description' => esc_html__( 'A widget that displays a Facebook Like Box', 'travel-blog' )
		);
		parent::__construct( 'Travel_Blog_Facebook_Widget', 'Travel Blog: Facebook Like Box', $widget_ops );
	}

	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Find us on Facebook', 'cover' => 'on', 'faces' => 'on', 'page_url' => '', 'stream' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title', 'travel-blog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<!-- Page url -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_url' ) ); ?>"><?php echo esc_html__( 'Facebook Page URL', 'travel-blog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_url' ) ); ?>" value="<?php echo esc_url( $instance['page_url'] ); ?>" />
			<small><?php echo esc_html__( 'EG. http://www.facebook.com/envato', 'travel-blog' ); ?></small>
		</p>

		<!-- Faces -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>"><?php echo esc_html__( 'Show Faces', 'travel-blog' ); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'faces' ) ); ?>" <?php checked( (bool) $instance['faces'], true ); ?> />
		</p>

		<!-- Stream -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'stream' ) ); ?>"><?php echo esc_html__( 'Show Stream', 'travel-blog' ); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'stream' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stream' ) ); ?>" <?php checked( (bool) $instance['stream'], true ); ?> />
		</p>

		<!-- Cover -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cover' ) ); ?>"><?php echo esc_html__( 'Show Page Cover Image', 'travel-blog' ); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'cover' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cover' ) ); ?>" <?php checked( (bool) $instance['cover'], true ); ?> />
		</p>


		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		$instance['faces']    = strip_tags( $new_instance['faces'] );
		$instance['stream']   = strip_tags( $new_instance['stream'] );
		$instance['cover']    = strip_tags( $new_instance['cover'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$page_url = $instance['page_url'];
		$faces    = $instance['faces'];
		$stream   = $instance['stream'];
		$cover    = $instance['cover'];

		/* Before widget (defined by themes). */
		echo ent2ncr( $before_widget );

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) {
			echo ent2ncr( $before_title . $title . $after_title );
		}

		?>
		
		<?php

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}
}

register_widget( 'Travel_Blog_Facebook_Widget' );
?>