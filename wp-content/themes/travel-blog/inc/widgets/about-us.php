<?php

class Travel_Blog_About_Us extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Travel_Blog_About_Us',
			'description' => 'about us'
		);
		parent::__construct( 'Travel_Blog_About_Us', 'Travel Blog: About Us', $widget_ops );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'     => 'About Me',
			'image_url' => '',
			'name'      => '',
			'desc'      => '',
			'signature' => '',
		);
		@$instance = wp_parse_args( (array) $instance, $defaults );
		$desc      = $instance['desc'];
		$title     = $instance['title'];
		$name      = $instance['name'];
		$image     = new WidgetImageField( ent2ncr( $this->get_field_name( 'image_url' ) ), '', $instance['image_url'] );
		$signature = new WidgetImageField( ent2ncr( $this->get_field_name( 'signature' ) ), '', $instance['signature'] );
		/*Get Product category*/
		?>
		<p>
			<label><?php echo esc_html__( 'Title', 'travel-blog' ); ?></label>
			<input class="widefat" name="<?php echo ent2ncr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label><?php echo esc_html__( 'Upload Image', 'travel-blog' ); ?></label>
		</p>
		<?php echo ent2ncr( $image->get_field() ) ?>
		<p>
			<label><?php echo esc_html__( 'Name', 'travel-blog' ); ?></label>
			<input class="widefat" name="<?php echo ent2ncr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<label><?php echo esc_html__( 'Description', 'travel-blog' ); ?></label>
			<textarea class="widefat" name="<?php echo ent2ncr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_html( $desc ); ?></textarea>
		</p>
		<p>
			<label><?php echo esc_html__( 'Upload Signature', 'travel-blog' ); ?></label>
			<?php echo ent2ncr( $signature->get_field() ) ?>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['image_url'] = sanitize_text_field( $new_instance['image_url'] );
		$instance['name']      = sanitize_text_field( $new_instance['name'] );
		$instance['desc']      = sanitize_text_field( $new_instance['desc'] );
		$instance['signature'] = sanitize_text_field( $new_instance['signature'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo ent2ncr( $before_widget );
		$name      = isset( $instance['name'] ) ? $instance['name'] : '';
		$signature = isset( $instance['signature'] ) ? $instance['signature'] : '';
		$image_url = isset( $instance['image_url'] ) ? $instance['image_url'] : '';
		$title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$desc      = isset( $instance['desc'] ) ? trim( $instance['desc'] ) : '';
		if ( $title ) {
			echo ent2ncr( $before_title . $title . $after_title );
		} ?>
		<div class="about-us-inner">
			<?php
			if ( $image_url ) {
				$src = wp_get_attachment_image_src( $image_url, 'full' );
				echo '<div class="about-avatar"><img  src="' . esc_url( $src[0] ) . '" alt=""></div>';
			}
			echo '<div class="content-inner">';
			if ( $name ) {
				echo '<h3 class="name">' . $name . '</h3>';
			}
			if ( $desc ) {
				echo '<div class="desc"><p>' . $desc . '</p></div>';
			}
			if ( $signature ) {
				$src_signature = wp_get_attachment_image_src( $signature, 'full' );
				echo '<div class="signature"><img  src="' . esc_url( $src_signature[0] ) . '" alt=""></div>';
			}
			echo '</div>';
			?>
		</div>
		<?php echo ent2ncr( $after_widget );
	}
}

register_widget( 'Travel_Blog_About_Us' );