<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package travel_blog
 */
$class = 'grid-item';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<?php
	do_action( 'travel_blog_entry_top' );
	?>
	<div class="entry-content">
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
			<div class="entry-meta">
				<?php
				echo '<span class="posted-on">' . get_the_date() . '</span>';
				?>
			</div><!-- .entry-meta -->
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->