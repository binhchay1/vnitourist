<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package travel_blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'travel_blog_entry_top', 'full' ); ?>
	<div class="full-content-single">

		<div class="post-content">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
			<div class="entry-meta">
				<?php travel_blog_entry_top_single(); ?>
			</div>
			<?php the_content();
			?>
			<?php travel_blog_entry_footer(); ?>
		</div>
		<div class="left-content-single">
			<?php
			echo '<div class="share-block">';
			if ( travel_blog_get_option( 'comment_number', '1' ) == '1' ) {
				if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) {
					comments_popup_link( '0', '1', '%', 'comment-number' );
				}
			}
			if ( travel_blog_get_option( 'share_face', '1' ) == '1' ) {
				echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '" target="_blank" title="' . esc_html__( 'Share Facebook', 'travel-blog' ) . '"><i class="fa fa-facebook"></i></a>';
			}
			if ( travel_blog_get_option( 'share_twitter', '1' ) == '1' ) {
				echo '<a href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . urlencode( get_the_title() ) . '" target="_blank"  title="' . esc_html__( 'Share twitter', 'travel-blog' ) . '"><i class="fa fa-twitter"></i></a>';
			}
			if ( travel_blog_get_option( 'share_pinterest', '1' ) == '1' ) {
				echo '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" target="_blank"  title="' . esc_html__( 'Share pinterest', 'travel-blog' ) . '"><i class="fa fa-pinterest"></i></a>';
			}
			if ( travel_blog_get_option( 'share_linkedin', '1' ) == '1' ) {
				echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . urlencode( get_the_title() ) . '" target="_blank"  title="' . esc_html__( 'Share linkedin', 'travel-blog' ) . '"><i class="fa fa-linkedin"></i></a>';
			}
			echo '</div>';
			?>
		</div>
	</div>
</article><!-- #post-## -->

