<?php 

$orig_post = $post;
global $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 2, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$related_posts = new wp_query( $args );
	if( $related_posts->have_posts() ) { ?>
		<div class="post-related"><p class="related-title"><?php esc_html_e('Related Posts', 'travel-blog'); ?></p>
		<div class="wrapper-blog-content content-blog-full_one_grid">
		<?php while( $related_posts->have_posts() ) {
			$related_posts->the_post();?>
				<article <?php post_class('grid-item'); ?>>
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
		<?php
		}
		echo '</div></div>';
	}
}
$post = $orig_post;
wp_reset_query();

?>