<?php
if ( travel_blog_get_option( 'show_featured_slider' ) == '1' || travel_blog_get_option( 'show_highlight' ) == '1' ) {
	?>
	<div class="featured-area">
		<?php
		if ( travel_blog_get_option( 'show_featured_slider' ) == '1' ) {
			// featured top
			if ( travel_blog_get_option( 'feature_option' ) == '1' ) {
				$background_image = $featured_top_ID = '';
				if ( travel_blog_get_option( 'select_post_hero' ) ) {
					$featured_top_ID = get_post( travel_blog_get_option( 'select_post_hero' ) );
				}

				$travel_blog_theme_options = travel_blog_get_data_themeoptions();
				$url                       = $travel_blog_theme_options['image_hero']['url'];

				if ( $featured_top_ID || $url ) {
					if ( $url ) {
						$background_image = ' style="background-image:url(' . $url . ')"';
					}
					echo '<div class="hero-banner"' . $background_image . '>';
					echo '<div class="content-inner"><div class="container">';
					if ( $featured_top_ID ) {
						$cat_list = get_the_category_list( ', ','',$featured_top_ID );
						if ( $cat_list ) {
							echo '<span class="cat-links"> ' . $cat_list . '</span>';
						}
						echo '<h2><a href="' . get_the_permalink( $featured_top_ID ) . '" title="' . get_the_title( $featured_top_ID ) . '">' . get_the_title( $featured_top_ID ) . '</a></h2>';

					}
					echo '</div></div>';
					echo '</div>';

				}
			} else {
				wp_enqueue_script( 'travel_blog_bxslider' );
				echo '<div class="wrapper-hero-banner">';
				$slider_id = travel_blog_get_option( 'select_post_slider' );
				if ( $slider_id ) {
					$args_area         = array( 'post_type' => array( 'post' ), 'post__in' => $slider_id, 'orderby' => 'post__in' );
					$query_slider_area = new WP_Query( $args_area );
					if ( $query_slider_area->have_posts() ) : while ( $query_slider_area->have_posts() ) : $query_slider_area->the_post();
						$background_image = '';
						if ( has_post_thumbnail() ) {
							$image            = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$background_image = ' style="background-image:url(' . $image[0] . ')"';
						}
						echo '<div class="hero-banner"' . $background_image . '>';
						echo '<div class="content-inner"><div class="container">';
						$cat_list_slider = get_the_category_list( ', ' );
						if ( $cat_list_slider ) {
							echo '<span class="cat-links"> ' . $cat_list_slider . '</span>';
						}
						if ( has_post_format( 'link' ) ) {
							$url       = get_post_meta( get_the_ID(), 'url', true );
							$text      = get_post_meta( get_the_ID(), 'text', true );
							$read_more = '<a href=' . esc_url( $url ) . '" title="' . esc_html( $text ) . '">' . esc_html__( 'Read More', 'travel-blog' ) . '</a>';
							if ( $url && $text ) {
								echo '<h2><a class="link" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></h2>';
							}
						} else {
							the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
						}
						echo '</div></div>';
						echo '</div>';
					endwhile;
						wp_reset_query();
					endif;
				}
				echo '</div>';
			}
			// featured Slider
		}

		if ( travel_blog_get_option( 'show_highlight' ) == '1' ) {
			wp_enqueue_script( 'travel_owl-carousel' );
			?>
			<div class="wrapper-featured-slider container">
				<?php
				$cats     = travel_blog_get_option( 'select_categories' );
				$posts_id = travel_blog_get_option( 'select_id' );
				$number   = travel_blog_get_option( 'amount_slider' );
				if ( $posts_id ) {
					$args = array( 'showposts' => $number, 'post_type' => array( 'post' ), 'post__in' => $posts_id, 'orderby' => 'post__in' );
				} else {
					$args = array( 'showposts' => $number, 'post_type' => array( 'post' ), 'post__in' => $posts_id, 'orderby' => 'post__in', 'cat' => $cats );
				}
				$query_slider = new WP_Query( $args );
				if ( travel_blog_get_option( 'title_slider' ) ) {
					echo '<h2>' . esc_attr( travel_blog_get_option( 'title_slider' ) ) . '</h2>';
				}
				?>
				<div class="feature-slider">
					<?php if ( $query_slider->have_posts() ) : while ( $query_slider->have_posts() ) : $query_slider->the_post(); ?>
						<div <?php post_class( 'wrapper-content-item' ); ?>>
							<?php do_action( 'travel_blog_entry_top', 'medium' ); ?>
							<div class="content-inner">
								<?php
								$categories_list = get_the_category_list( ', ' );
								if ( $categories_list ) {
									echo '<span class="cat-links"> ' . $categories_list . '</span>';
								}
								if ( has_post_format( 'link' ) ) {
									$url  = get_post_meta( get_the_ID(), 'url', true );
									$text = get_post_meta( get_the_ID(), 'text', true );
									if ( $url && $text ) {
										echo '<h3><a class="link" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></h3>';
									}
								} else {
									the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
								}
								echo '<span class="date">' . get_the_date() . '</span>';
								?>
							</div>
						</div>
					<?php endwhile;
						wp_reset_query();
					endif; ?>
				</div>
			</div>
		<?php }
		?>
	</div>
	<?php
}
?>