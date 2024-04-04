<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package travel_blog
 */

get_header();

get_template_part( 'template-parts/featured', 'slider' );

do_action( 'travel_blog_wrapper_loop_start' );

if ( have_posts() ) :
	$class_blog = '';
	$class_blog = travel_blog_get_option( 'archive_front_page_style' );
	if ( travel_blog_get_option( 'archive_front_page_style' ) == 'full_one_list' ) {
		$class_blog = 'list';
	}
	if ( travel_blog_get_option( 'archive_front_page_style' ) == 'full_one_grid' ) {
		$class_blog = 'grid';
	}
	?>
	<div class="wrapper-blog-content content-blog-<?php echo esc_attr( travel_blog_get_option( 'archive_front_page_style' ) ); ?>">
		<?php
		while ( have_posts() ) : the_post();
			$layout = $class_blog;
			if ( travel_blog_get_option( 'archive_front_page_style' ) == 'full_one_list' || travel_blog_get_option( 'archive_front_page_style' ) == 'full_one_grid' ) {
				if ( $wp_query->current_post == 0 && !is_paged() ) {
					$layout = '';
				}
			}
			get_template_part( 'template-parts/content', $layout );

		endwhile;
		?>
	</div>
	<?php

	travel_blog_paging_nav();

else :

	get_template_part( 'template-parts/content', 'none' );

endif;

do_action( 'travel_blog_wrapper_loop_end' );

get_footer();