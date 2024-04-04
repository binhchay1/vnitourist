<?php

/**
 * Class Travel_Blog_Widget_Posts
 * List  posts
 */
class Travel_Blog_Widget_Posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array( 'classname' => 'Widget_Posts', 'description' => 'Show list posts' );
		parent::__construct( 'Travel_Blog_Widget_Posts', 'Travel Blog: List Posts', $widget_ops );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'   => '',
			'limit'   => 3,
			'order'   => 'DESC',
			'orderby' => 'post_date',
			'col'     => 3
		);
		@$instance = wp_parse_args( (array) $instance, $defaults );
		$title   = $instance['title'];
		$limit   = $instance['limit'];
		$order   = $instance['order'];
		$orderby = $instance['orderby'];
		?>

		<p>
			<label><?php echo esc_html__( 'Title', 'travel-blog' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label><?php echo esc_html__( 'Limit', 'travel-blog' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>

		<p>
			<label><?php echo esc_html__( 'Order', 'travel-blog' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ) ?>><?php esc_html_e( 'DESC', 'travel-blog' ) ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ) ?>><?php esc_html_e( 'ASC', 'travel-blog' ) ?></option>
			</select>
		</p>
		<p>
			<label><?php echo esc_html__( 'Display', 'travel-blog' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<option value="rand" <?php selected( $orderby, 'rand' ) ?>><?php esc_html_e( 'Random', 'travel-blog' ) ?></option>
				<option value="comment_count" <?php selected( $orderby, 'comment_count' ) ?>><?php esc_html_e( 'Popular', 'travel-blog' ) ?></option>
				<option value="post_date" <?php selected( $orderby, 'post_date' ) ?>><?php esc_html_e( 'Date', 'travel-blog' ) ?></option>
			</select>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['limit']   = sanitize_text_field( $new_instance['limit'] );
		$instance['order']   = sanitize_text_field( $new_instance['order'] );
		$instance['orderby'] = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo ent2ncr( $before_widget );
		$title   = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$limit   = isset( $instance['limit'] ) ? $instance['limit'] : 3;
		$order   = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'post_date';
		if ( $title ) {
			echo ent2ncr( $before_title . $title . $after_title );
		}

		$args = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'posts_per_page' => $limit,
			'order'          => $order,
			'orderby'        => $orderby
		);

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			?>
			<div class="widget-list-posts">
				<ul class="list-unstyled">
					<?php while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<li>
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="feature-image">
									<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="post-thumbnail">
										<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) ?>
									</a>
								</div>
							<?php } ?>
							<div class="post-description">
								<?php
								$categories_list = get_the_category_list( ', ' );
								if ( $categories_list ) {
									echo '<span class="cat-links"> ' . $categories_list . '</span>';
								}
								?>
								<h2>
									<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="post-link"><?php the_title() ?></a>
								</h2>
								<div class="post-excerpt">
									<?php
									echo '<span class="date">' . get_the_date() . '</span>';
									?>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>

		<?php }
		wp_reset_postdata();
		echo ent2ncr( $after_widget );
	}
}

register_widget( 'Travel_Blog_Widget_Posts' );
?>