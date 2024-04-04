<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Display Settings', 'travel-blog' ),
	'icon'  => 'el el-eye-open',
	'id'    => 'display_settings',
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Front Page Settings', 'travel-blog' ),
	'id'         => 'front_page_display_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'archive_front_page_cate_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Select Layout Default', 'travel-blog' ),
			'options' => array(
				'full-content'  => array(
					'alt' => 'body-full',
					'img' => get_template_directory_uri() . '/images/layout/body-full.png'
				),
				'sidebar-left'  => array(
					'alt' => 'sidebar-left',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-left.png'
				),
				'sidebar-right' => array(
					'alt' => 'sidebar-right',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-right.png'
				),
			),
			'default' => 'sidebar-left'
		),
		array(
			'id'      => 'archive_front_page_style',
			'type'    => 'select',
			'title'   => esc_html__( 'Select Style', 'travel-blog' ),
			'options' => array(
				'full'          => esc_html__( 'Full Post Layout', 'travel-blog' ),
				'grid'          => esc_html__( 'Grid Post Layout', 'travel-blog' ),
				'full_one_grid' => esc_html__( '1 Full Post then Grid Layout', 'travel-blog' ),
				'list'          => esc_html__( 'List Post Layout', 'travel-blog' ),
				'full_one_list' => esc_html__( '1 Full Post then List Layout', 'travel-blog' ),

			),
			'default' => 'full',
			'select2' => array( 'allowClear' => false )
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Archive Settings', 'travel-blog' ),
	'id'         => 'archive_display_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'archive_cate_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Select Layout Default', 'travel-blog' ),
			'options' => array(
				'full-content'  => array(
					'alt' => 'body-full',
					'img' => get_template_directory_uri() . '/images/layout/body-full.png'
				),
				'sidebar-left'  => array(
					'alt' => 'sidebar-left',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-left.png'
				),
				'sidebar-right' => array(
					'alt' => 'sidebar-right',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-right.png'
				),
			),
			'default' => 'sidebar-left'
		),
		array(
			'id'      => 'archive_cat_style',
			'type'    => 'select',
			'title'   => esc_html__( 'Select Style', 'travel-blog' ),
			'options' => array(
				'full'          => esc_html__( 'Full Post Layout', 'travel-blog' ),
				'grid'          => esc_html__( 'Grid Post Layout', 'travel-blog' ),
				'full_one_grid' => esc_html__( '1 Full Post then Grid Layout', 'travel-blog' ),
				'list'          => esc_html__( 'List Post Layout', 'travel-blog' ),
				'full_one_list' => esc_html__( '1 Full Post then List Layout', 'travel-blog' ),

			),
			'default' => 'full',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'id'      => 'excerpt_length_blog',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Excerpt Length', 'travel-blog' ),
			'desc'    => esc_html__( 'Enter the number of words you want to cut from the content to be the excerpt of search and archive', 'travel-blog' ),
			'default' => '30',
			'min'     => '20',
			'step'    => '1',
			'max'     => '100',
		),
		array(
			"title"   => esc_html__( "Show Text Read more", "travel-blog" ),
			"id"      => "show_text_read_more",
			"default" => 0,
			"folds"   => 1,
			"on"      => esc_html__( "show", "travel-blog" ),
			"off"     => esc_html__( "hide", "travel-blog" ),
			"type"    => "switch"
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Post & Page Settings', 'travel-blog' ),
	'id'         => 'single_display_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'archive_single_layout',
			'type'    => 'image_select',
			'title'   => esc_html__( 'Select Layout Default', 'travel-blog' ),
			'options' => array(
				'full-content'  => array(
					'alt' => 'body-full',
					'img' => get_template_directory_uri() . '/images/layout/body-full.png'
				),
				'sidebar-left'  => array(
					'alt' => 'sidebar-left',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-left.png'
				),
				'sidebar-right' => array(
					'alt' => 'sidebar-right',
					'img' => get_template_directory_uri() . '/images/layout/sidebar-right.png'
				),
			),
			'default' => 'sidebar-left'
		),
		array(
			"title"   => esc_html__( "Related Post", "travel-blog" ),
			"id"      => "show_related_post",
			"default" => 0,
			"folds"   => 1,
			"on"      => esc_html__( "show", "travel-blog" ),
			"off"     => esc_html__( "hide", "travel-blog" ),
			"type"    => "switch"
		),
		array(
			"title"   => esc_html__( "Show Next and Preview Post", "travel-blog" ),
			"id"      => "show_next_preview_post",
			"default" => 1,
			"folds"   => 1,
			"on"      => esc_html__( "show", "travel-blog" ),
			"off"     => esc_html__( "hide", "travel-blog" ),
			"type"    => "switch"
		),
		array(
			'id'   => 'sub_menu',
			'type' => 'info',
			'raw'  => esc_html__( 'Share Social', 'travel-blog' )
		),
		array(
			'id'      => 'comment_number',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Comment Number', 'travel-blog' ),
			'default' => '1'// 1 = on | 0 = off,
		),
		array(
			'id'      => 'share_face',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Share Facebook', 'travel-blog' ),
			'default' => '1'// 1 = on | 0 = off,
		),
		array(
			'id'      => 'share_twitter',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Share twitter', 'travel-blog' ),
			'default' => '1'// 1 = on | 0 = off,
		),
		array(
			'id'      => 'share_pinterest',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Share pinterest', 'travel-blog' ),
			'default' => '1'// 1 = on | 0 = off,
		),
		array(
			'id'      => 'share_linkedin',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Share linkedin', 'travel-blog' ),
			'default' => '1'// 1 = on | 0 = off,
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Featured area', 'travel-blog' ),
	'id'     => 'featured_slider',
	'fields' => array(
		array(
			'id'    => 'show_featured_slider',
			'type'  => 'checkbox',
			'title' => esc_html__( 'Show Featured area', 'travel-blog' ),
		),
		array(
			'id'       => 'feature_option',
			'type'     => 'switch',
			'title'    => esc_html__( 'Featured Area Option', 'travel-blog' ),
			'default'  => 0,
			'on'       => esc_html__( 'Hero Banner', 'travel-blog' ),
			'off'      => esc_html__( 'Feature Slider', 'travel-blog' ),
			'required' => array( 'show_featured_slider', '=', '1' ),
		),
		array(
			'id'       => 'select_post_hero',
			'type'     => 'select',
			'data'     => 'post',
			'args'     => array(
				'posts_per_page' => - 1,
			),
			'title'    => __( 'Select One Post Feature', 'travel-blog' ),
			'required' => array( 'feature_option', '=', '1' ),
		),
		array(
			'id'       => 'image_hero',
			'type'     => 'media',
			'title'    => esc_html__( 'Upload Image', 'travel-blog' ),
			'required' => array( 'feature_option', '=', '1' ),
		),
		array(
			'id'       => 'select_post_slider',
			'type'     => 'select',
			'data'     => 'post',
			'multi'    => true,
			'args'     => array(
				'posts_per_page' => - 1,
			),
			'title'    => __( 'Select Post', 'travel-blog' ),
			'required' => array( 'feature_option', '=', '0' ),
		),
		array(
			'id'   => 'highlight_info_heading',
			'type' => 'info',
			'raw'  => esc_html__( 'Highlight', 'travel-blog' )
		),
		array(
			'id'    => 'show_highlight',
			'type'  => 'checkbox',
			'title' => esc_html__( 'Show Highlight', 'travel-blog' ),
		),
		array(
			'id'       => 'title_slider',
			'type'     => 'text',
			'default'  => esc_html__( 'The Highlight', 'travel-blog' ),
			'title'    => esc_html__( 'Title Highlight', 'travel-blog' ),
			'required' => array( 'show_highlight', '=', '1' ),

		),
		array(
			'id'       => 'select_categories',
			'type'     => 'select',
			'data'     => 'categories',
			'multi'    => false,
			'title'    => __( 'Select Category', 'travel-blog' ),
			'required' => array( 'show_highlight', '=', '1' ),
		),
		array(
			'id'       => 'select_id',
			'type'     => 'select',
			'data'     => 'post',
			'multi'    => true,
			'args'     => array(
				'posts_per_page' => - 1,
			),
			'title'    => __( 'Select Highlight Post', 'travel-blog' ),
			'required' => array( 'show_highlight', '=', '1' ),
		),

		array(
			'id'       => 'amount_slider',
			'type'     => 'spinner',
			'title'    => esc_html__( 'Amount of Slides', 'travel-blog' ),
			'default'  => '3',
			'min'      => '1',
			'step'     => '1',
			'max'      => '10',
			'required' => array( 'show_highlight', '=', '1' ),
		),
	)
) );