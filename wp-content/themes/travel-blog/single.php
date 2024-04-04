<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package travel_blog
 */

get_header();

do_action( 'travel_blog_wrapper_loop_start' );

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', 'single' );


	if ( travel_blog_get_option( 'show_next_preview_post', '1' ) == '1' ) {
		the_post_navigation();
	}

	if ( get_the_author_meta( 'description' ) ) { ?>
		<div class="post-author">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), '90' ); ?>
			</div>
			<div class="author-content">
				<h5><?php
					echo esc_html__( 'WRITTEN BY', 'travel-blog' ) . ' ';
					the_author_posts_link(); ?></h5>
				<p><?php the_author_meta( 'description' ); ?></p>

			</div>
		</div>
	<?php }
	if ( travel_blog_get_option( 'show_related_post' ) == 1 ) {
		get_template_part( 'inc/related_posts' );
	}
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.

do_action( 'travel_blog_wrapper_loop_end' );

get_footer();
?>
