<?php
if ( !function_exists( 'travel_blog_the_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 */
	function travel_blog_the_posts_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		if ( !$next && !$previous ) {
			return;
		}
		?>
		<div class="links-next-post">
			<?php
			previous_post_link( '<div class="nav-previous">%link</div>', '<i class="fa fa-long-arrow-left"></i>' . esc_html__( 'Previous post', 'travel-blog' ) );
			next_post_link( '<div class="nav-next">%link</div>', esc_html__( 'Next post', 'travel-blog' ) . '<i class="fa fa-long-arrow-right"></i>' );
			?>
		</div>
		<!-- .nav-links -->
		<?php
	}
endif;

if ( !function_exists( 'travel_blog_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function travel_blog_paging_nav() {
		?>
		<div class="nav_pagination">
			<div class="newer_post"><?php previous_posts_link( '<i class="fa fa-angle-double-left"></i>' . __( 'Newer Posts', 'travel-blog' ) ); ?></div>
			<div class="older_post"><?php next_posts_link( __( 'Older Posts', 'travel-blog' ) . '<i class="fa fa-angle-double-right"></i>' ); ?></div>
		</div>
	<?php }
endif;
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package travel_blog
 */

if ( !function_exists( 'travel_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function travel_blog_posted_on() {

		$time_string = '<span class="entry-date published updated">%2$s</span>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span class="entry-date published">%2$s</span>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date() ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date() ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'travel-blog' ), $time_string );

		$byline = sprintf(
			esc_html_x( 'By %s', 'post author', 'travel-blog' ),
			'<a class="author url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<a href="' . esc_url( get_permalink() ) . '">' . $posted_on . '</a>' . '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( !function_exists( 'travel_blog_category_top' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function travel_blog_category_top() {
		$categories_list = get_the_category_list( ', ' );
		printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
	}
endif;

if ( !function_exists( 'travel_blog_entry_top_single' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function travel_blog_entry_top_single() {
		/* translators: used between list items, there is a space after the comma */
		$time_string = '<span class="entry-date published updated">%2$s</span>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span class="entry-date published">%2$s</span>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date() ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date() ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf( esc_html_x( '%s', 'post date', 'travel-blog' ), $time_string );
		echo ent2ncr( $posted_on );
		echo '<span class="entry-author">' . esc_html__( 'By', 'travel-blog' ) . ' ' . '<a class="author url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';


		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && travel_blog_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'travel-blog' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}


	}
endif;

if ( !function_exists( 'travel_blog_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function travel_blog_entry_footer() {
		// Hide category and tag text for pages.

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'travel-blog' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'travel-blog' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}

	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function travel_blog_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'travel_blog_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'travel_blog_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so travel_blog_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so travel_blog_categorized_blog should return false.
		return false;
	}
}

if ( !function_exists( 'travel_blog_the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function travel_blog_the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( esc_html__( '%s', 'travel-blog' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( '%s', 'travel-blog' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( 'Author: %s', 'travel-blog' ), get_the_author()  );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', 'travel-blog' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'travel-blog' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', 'travel-blog' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'travel-blog' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', 'travel-blog' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'travel-blog' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = esc_html_x( 'Asides', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = esc_html_x( 'Galleries', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = esc_html_x( 'Images', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = esc_html_x( 'Videos', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = esc_html_x( 'Quotes', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = esc_html_x( 'Links', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = esc_html_x( 'Statuses', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = esc_html_x( 'Audio', 'post format archive title', 'travel-blog' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = esc_html_x( 'Chats', 'post format archive title', 'travel-blog' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( '%s', 'travel-blog' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			if ( get_queried_object()->taxonomy == 'pa_destination' ) {
				/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
				$title = sprintf( esc_html__( '%1$s %2$s', 'travel-blog' ), esc_html__( 'Tourist', 'travel-blog' ), single_term_title( '', false ) );
			} else {
				/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
				$title = sprintf( esc_html__( '%1$s: %2$s', 'travel-blog' ), $tax->labels->singular_name, single_term_title( '', false ) );
			}

		} else {
			$title = esc_html__( 'Archives', 'travel-blog' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( !empty( $title ) ) {
			echo esc_attr( $title );
		}
	}
endif;

/**
 * Flush out the transients used in travel_blog_categorized_blog.
 */
function travel_blog_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'travel_blog_categories' );
}

add_action( 'edit_category', 'travel_blog_category_transient_flusher' );
add_action( 'save_post', 'travel_blog_category_transient_flusher' );
