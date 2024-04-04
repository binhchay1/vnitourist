<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package travel_blog
 */
$class = 'list-item';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<?php
	do_action( 'travel_blog_entry_top' );
	?>
 	<div class="entry-list-content">
		<?php
		travel_blog_category_top();
		?>
		<header class="entry-header">
			<?php
			if ( has_post_format( 'link' ) ) {
				$url  = get_post_meta( get_the_ID(), 'url', true );
				$text = get_post_meta( get_the_ID(), 'text', true );
				if ( $url && $text ) {
					echo '<h2 class="entry-title"><a class="link" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></h2>';
				}
			} else {
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->
		<div class="entry-desc">
			<?php
			the_excerpt();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-blog' ),
				'after'  => '</div>',
			) );
			?>
		</div>
		<div class="entry-meta">
			<?php travel_blog_posted_on(); ?>
			<?php
			echo '<div class="post-share">';
			echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '" target="_blank" title="' . esc_html__( 'Share Facebook', 'travel-blog' ) . '"><i class="fa fa-facebook"></i></a>';
			echo '<a href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . urlencode( get_the_title() ) . '" target="_blank"  title="' . esc_html__( 'Share twitter', 'travel-blog' ) . '"><i class="fa fa-twitter"></i></a>';
			echo '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" target="_blank"  title="' . esc_html__( 'Share pinterest', 'travel-blog' ) . '"><i class="fa fa-pinterest"></i></a>';
			echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . urlencode( get_the_title() ) . '" target="_blank"  title="' . esc_html__( 'Share linkedin', 'travel-blog' ) . '"><i class="fa fa-linkedin"></i></a>';
			echo '</div>';
			?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->