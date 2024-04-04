<?php
// footer
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Footer', 'travel-blog' ),
	'id'     => 'footer',
	'icon'   => 'el el-graph',
	'fields' => array(

		array(
			'id'          => 'bg_copyright',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Copyright Color', 'travel-blog' ),
			'default'     => '#414b4f',
			'transparent' => false,
		),
		array(
			'id'          => 'text_color_copyright',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'travel-blog' ),
			'default'     => '#ccc',
			'transparent' => false,
		),

		array(
			'id'      => 'copyright_text',
			'type'    => 'editor',
			'title'   => esc_html__( 'Copyright Text', 'travel-blog' ),
			'args'    => array(
				'wpautop' => false,
				'teeny'   => true
			),
			'default' => 'Copyright &copy; 2017 Travel Blog. All Rights Reserved.'
		),
		array(
			"title" => esc_html__( "Back To Top", "travel-blog" ),
			"id"    => "totop_show",
			"std"   => 1,
			"folds" => 1,
			"on"    => esc_html__( "show", "travel-blog" ),
			"off"   => esc_html__( "hide", "travel-blog" ),
			"type"  => "switch"
		)
	)
) );