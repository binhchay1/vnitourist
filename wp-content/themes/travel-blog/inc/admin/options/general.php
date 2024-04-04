<?php
$logo = get_template_directory_uri( 'template_directory' ) . '/images/';
// -> START Media Uploads

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'General Settings', 'travel-blog' ),
	'id'    => 'general_settings',
	'icon'  => 'el el-cogs',
) );
// Main Menu Home Page
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Main Menu Home Page', 'travel-blog' ),
	'id'         => 'home_page_general_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'home_page_menu_overlay',
			'type'    => 'switch',
			'title'   => esc_html__( 'Menu Overlay', 'travel-blog' ),
			'default' => 0,
			'on'      => 'Enable',
			'off'     => 'Disable'
		),
		array(
			'id'       => 'travel_blog_logo_home',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Home Page', 'travel-blog' ),
			'desc'     => esc_html__( 'Enter URL or Upload an image file as your logo.', 'travel-blog' ),
			'required' => array( 'home_page_menu_overlay', '=', '1' ),
		),
		array(
			'id'       => 'bg_header_color_home',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background header', 'travel-blog' ),
			'required' => array( 'home_page_menu_overlay', '=', '1' ),
		),
		array(
			'id'          => 'text_menu_color_home',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Color', 'travel-blog' ),
			'transparent' => false,
			'required'    => array( 'home_page_menu_overlay', '=', '1' ),
		),
		array(
			'id'          => 'text_menu_active_color_home',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Active Color', 'travel-blog' ),
			'transparent' => false,
			'required'    => array( 'home_page_menu_overlay', '=', '1' ),
		),
		array(
			'id'      => 'sticky_menu_custom',
			'type'    => 'switch',
			'title'   => esc_html__( 'Menu Overlay Sticky', 'travel-blog' ),
			'default' => 0,
			'on'      => esc_html__( 'Custom', 'travel-blog' ),
			'off'     => esc_html__( 'Default', 'travel-blog' )
		),
		array(
			'id'       => 'travel_blog_logo_home_sticky',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Home Page Sticky', 'travel-blog' ),
			'desc'     => esc_html__( 'Enter URL or Upload an image file as your logo.', 'travel-blog' ),
			'required' => array( 'sticky_menu_custom', '=', '1' ),
		),
		array(
			'id'       => 'bg_header_color_home_sticky',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background header Sticky', 'travel-blog' ),
			'required' => array( 'sticky_menu_custom', '=', '1' ),
		),
		array(
			'id'          => 'text_menu_color_home_sticky',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Color Sticky', 'travel-blog' ),
			'transparent' => false,
			'required'    => array( 'sticky_menu_custom', '=', '1' ),
		),
		array(
			'id'          => 'text_menu_active_color_home_sticky',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Active Color Sticky', 'travel-blog' ),
			'transparent' => false,
			'required'    => array( 'sticky_menu_custom', '=', '1' ),
		),
	)
) );
// Main Menu
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Main Menu', 'travel-blog' ),
	'id'         => 'all_page_general_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'travel_blog_logo',
			'type'    => 'media',
			'title'   => esc_html__( 'Header Logo', 'travel-blog' ),
			'desc'    => esc_html__( 'Enter URL or Upload an image file as your logo.', 'travel-blog' ),
			'default' => array( 'url' => $logo . 'logo.png' ),
		),
		array(
			'id'      => 'width_logo',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Width Logo', 'travel-blog' ),
			'default' => '200',
			'min'     => '100',
			'step'    => '1',
			'max'     => '500',
		),
		array(
			'id'    => 'bg_header_color',
			'type'  => 'color_rgba',
			'title' => esc_html__( 'Background header', 'travel-blog' ),
		),
		array(
			'id'          => 'text_menu_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'          => 'text_menu_active_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Menu Active Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'      => 'font_size_main_menu',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size (px)', 'travel-blog' ),
			'default' => '13',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),
		array(
			'id'      => 'font_weight_main_menu',
			'type'    => 'select',
			'title'   => esc_html__( 'Font Weight', 'travel-blog' ),
			'options' => array(
				'normal'  => 'Normal',
				'bold'    => 'Bold',
				'lighter' => 'Lighter',
				'100'     => '100',
				'200'     => '200',
				'300'     => '300',
				'400'     => '400',
				'500'     => '500',
				'600'     => '600',
				'700'     => '700',
				'800'     => '800',
				'900'     => '900',
			),
			'default' => 'normal',
			'select2' => array( 'allowClear' => false )
		),
		array(
			"title" => esc_html__( "Search Icon", "travel-blog" ),
			"type"  => "switch",
			"id"    => "show_search",
			"std"   => 0,
			"on"    => esc_html__( "show", "travel-blog" ),
			"off"   => esc_html__( "hide", "travel-blog" ),
		),
		array(
			"title" => esc_html__( "Social Link", "travel-blog" ),
			"type"  => "switch",
			"id"    => "show_social",
			"std"   => 0,
			"on"    => esc_html__( "show", "travel-blog" ),
			"off"   => esc_html__( "hide", "travel-blog" ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Sticky Menu', 'travel-blog' ),
	'id'         => 'sticky_menu_general_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'sticky_menu',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Sticky Menu', 'travel-blog' ),
			'default' => 0,
			'on'      => esc_html__( 'Yes', 'travel-blog' ),
			'off'     => esc_html__( 'No', 'travel-blog' )
		),

	)
) );
// Sub Menu
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Sub Menu', 'travel-blog' ),
	'id'         => 'sub_menu_general_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'          => 'sub_menu_bg_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'          => 'sub_menu_text_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'          => 'sub_menu_text_hover_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Hover Color', 'travel-blog' ),
			'transparent' => false,
		),
	)
) );

// Mobile Menu
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Mobile Menu', 'travel-blog' ),
	'id'         => 'mobile_menu_general_settings',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'          => 'mobile_menu_bg_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'          => 'mobile_menu_text_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'travel-blog' ),
			'transparent' => false,
		),
		array(
			'id'          => 'mobile_menu_text_hover_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Hover Color', 'travel-blog' ),
			'transparent' => false,
		),
	)
) );