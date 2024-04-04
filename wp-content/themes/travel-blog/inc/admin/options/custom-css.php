<?php
// css custom
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Custom Css', 'travel-blog' ),
	'id'     => 'custom_css',
	'icon'   => 'el el-css',
	'fields' => array(
		array(
			'id'       => 'opt-ace-editor-css',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'CSS Code', 'travel-blog' ),
			'subtitle' => esc_html__( 'Paste your CSS code here.', 'travel-blog' ),
			'mode'     => 'css',
			'theme'    => 'monokai',
			'default'  => ".custom_class{\n   margin: 0 auto;\n}"
		)
	)
) );