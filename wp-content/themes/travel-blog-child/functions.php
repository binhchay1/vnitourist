<?php
define( 'TRAVEL_BLOG_UPLOADS_FOLDER', trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode/' );
define( 'TRAVEL_BLOG_UPLOADS_URL', trailingslashit( WP_CONTENT_URL ) . 'uploads/physcode/' );

function travel_blog_child_enqueue_styles() {
	wp_deregister_style( 'travel-blog-style' );

	$parent_style = 'parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( $parent_style ) );
	if ( is_file( TRAVEL_BLOG_UPLOADS_FOLDER . 'physcode_travel_blog.css' ) ) {
		wp_deregister_style( 'physcode_travel_blog' );
		wp_enqueue_style( 'physcode_travel_blog_child', TRAVEL_BLOG_UPLOADS_URL . 'physcode_travel_blog.css', array() );
	}
}

add_action( 'wp_enqueue_scripts', 'travel_blog_child_enqueue_styles', 11 );
 