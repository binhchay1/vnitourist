<?php

get_template_part( 'inc/admin/Tax-meta-class/Tax-meta-class' );

if ( is_admin() ) {
	$prefix = 'phys_';

	function travel_blog_my_meta( $my_meta ) {
		$prefix = 'phys_';
		$my_meta->addSelect(
			$prefix . 'layout', array(
			''              => esc_html__( 'Using in Theme Option', 'travel-blog' ),
			'full-content'  => esc_html__( 'No Sidebar', 'travel-blog' ),
			'sidebar-left'  => esc_html__( 'Left Sidebar', 'travel-blog' ),
			'sidebar-right' => esc_html__( 'Right Sidebar', 'travel-blog' )
		),
			array( 'name' => esc_html__( 'Custom Layout ', 'travel-blog' ), 'std' => array( '' ) )
		);

		$my_meta->addColor( $prefix . 'cat_color', array( 'name' => esc_html__( 'Category Primary Color', 'travel-blog' ) ) );
	}

	/*
		  * configure your meta box
		  */
	$config = array(
		'id'             => 'category__meta_box',
		// meta box id, unique per meta box
		'title'          => 'Category Meta Box',
		// meta box title
		'pages'          => array( 'category', 'post_tag' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$my_meta_post = new Tax_Meta_Class( $config );
	travel_blog_my_meta( $my_meta_post );
	/*Add custom style*/
	$my_meta_post->Finish();


}
