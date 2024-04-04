<?php

add_filter( 'rwmb_meta_boxes', 'phys_register_meta_boxes' );
function phys_register_meta_boxes( $meta_boxes ) {
// Post Formats
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Gallery', 'travel-blog' ),
		'id'     => 'meta-box-post-format-gallery',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Images', 'travel-blog' ),
				'id'   => 'images',
				'type' => 'image_advanced',
			),
		),
	);
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Video', 'travel-blog' ),
		'id'     => 'meta-box-post-format-video',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'travel-blog' ),
				'id'   => 'video',
				'type' => 'textarea',
			),
		)
	);
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Audio', 'travel-blog' ),
		'id'     => 'meta-box-post-format-audio',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Audio URL or Embeded Code', 'travel-blog' ),
				'id'   => 'audio',
				'type' => 'textarea',
			),
		)
	);
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Quote', 'travel-blog' ),
		'id'     => 'meta-box-post-format-quote',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Quote', 'travel-blog' ),
				'id'   => 'quote',
				'type' => 'textarea',
			),
			array(
				'name' => esc_html__( 'Author', 'travel-blog' ),
				'id'   => 'author',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Author URL', 'travel-blog' ),
				'id'   => 'author_url',
				'type' => 'url',
			),
		)
	);
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Link', 'travel-blog' ),
		'id'     => 'meta-box-post-format-link',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'URL', 'travel-blog' ),
				'id'   => 'url',
				'type' => 'url',
			),
			array(
				'name' => esc_html__( 'Text', 'travel-blog' ),
				'id'   => 'text',
				'type' => 'text',
			),
		)
	);

	// Display Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Display Settings', 'travel-blog' ),
		'pages'  => get_post_types(), // All custom post types
		'fields' => array(
			array(
				'name'  => esc_html__( 'Use Custom Layout?', 'travel-blog' ),
				'id'    => 'phys_custom_layout',
				'type'  => 'checkbox',
				'class' => 'checkbox-toggle',
				'desc'  => esc_html__( 'This will overwrite page layout settings in Theme Options', 'travel-blog' ),
			),
			array(
				'name'    => esc_html__( 'Select Layout', 'travel-blog' ),
				'id'      => 'layout',
				'type'    => 'image_select',
				'std'     => 'sidebar-left',
				'options' => array(
					'full-content'  => TRAVEL_BLOG_THEME_URI . '/images/layout/body-full.png',
					'sidebar-left'  => TRAVEL_BLOG_THEME_URI . '/images/layout/sidebar-left.png',
					'sidebar-right' => TRAVEL_BLOG_THEME_URI . '/images/layout/sidebar-right.png',
				),
			),
		)
	);
	$meta_boxes[] = array(
		'title'    => esc_html__( 'Feature Image Hover', 'travel-blog' ),
		'id'       => 'feature_image_hover',
		'pages'    => array( 'post' ),
		'context'  => 'side',
		'priority' => 'low',
		'fields'   => array(
			array(
				'class'            => 'wrapper-feature_image',
				'name'             => esc_html__( 'Upload Image', 'travel-blog' ),
				'id'               => 'image_hover',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'desc'             => esc_html__( 'Upload image hover', 'travel-blog' ),
			),
		),
	);

	return $meta_boxes;
}

add_action( 'admin_enqueue_scripts', 'phys_admin_script_meta_box' );

/**
 * Enqueue script for handling actions with meta boxes
 *
 * @return void
 * @since 1.0
 */
function phys_admin_script_meta_box() {
	wp_enqueue_script( 'travel_blog-meta-box', TRAVEL_BLOG_THEME_URI . '/assets/js/admin/meta-boxes.js', array( 'jquery' ), '3022016', true );
}
