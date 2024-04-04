<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_template_part( 'inc/admin/sassphp/scss.inc' );

if ( is_multisite() ) {
	if ( !file_exists( trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . travel_blog_current_blog()->blog_id . '/physcode' ) ) {
		wp_mkdir_p( trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . travel_blog_current_blog()->blog_id . '/physcode', 0777, true );
	};
	define( 'TRAVEL_BLOG_UPLOADS_FOLDER', trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . travel_blog_current_blog()->blog_id . '/physcode/' );
	define( 'TRAVEL_BLOG_UPLOADS_URL', trailingslashit( WP_CONTENT_URL ) . 'uploads/sites/' . travel_blog_current_blog()->blog_id . '/physcode/' );
} else {
	if ( !file_exists( trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode' ) ) {
		wp_mkdir_p( trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode', 0777, true );
	}
	if ( !defined( 'TRAVEL_BLOG_UPLOADS_FOLDER' ) ) {
		define( 'TRAVEL_BLOG_UPLOADS_FOLDER', trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode/' );
	}

	if ( !defined( 'TRAVEL_BLOG_UPLOADS_URL' ) ) {
		define( 'TRAVEL_BLOG_UPLOADS_URL', trailingslashit( WP_CONTENT_URL ) . 'uploads/physcode/' );
	}
}

if ( !defined( 'TRAVEL_BLOG_FILE_NAME' ) ) {
	define( 'TRAVEL_BLOG_FILE_NAME', 'physcode_travel_blog.css' );
}

class sass2css {
	function __construct() {
		add_action( 'redux/options/travel_blog_theme_options/saved', array( $this, 'sass_to_css' ) );
	}

	function sass_to_css() {
		WP_Filesystem();
		global $wp_filesystem, $travel_blog_theme_options; /* already initialised the Filesystem API previously */
		$scss = new scssc();
		$scss->setFormatter( "scss_formatter_compressed" );
		$fileout = get_template_directory() . "/scss/getoption.scss";

		// put content
		$theme_options      = array(
			// hearder
			'bg_header_color_home'               => 'rgba',
			'width_logo'                         => '0',
			'text_menu_color_home'               => '0',
			'text_menu_active_color_home'        => '0',
			'bg_header_color'                    => 'rgba',
			'text_menu_color'                    => '0',
			'text_menu_active_color'             => '0',
			// custom bg sticky home page
			'bg_header_color_home_sticky'        => 'rgba',
			'text_menu_color_home_sticky'        => '0',
			'text_menu_active_color_home_sticky' => '0',
			'font_size_main_menu'                => '0',
			'font_weight_main_menu'              => '0',
			'sub_menu_bg_color'                  => '0',
			'sub_menu_text_color'                => '0',
			'sub_menu_text_hover_color'          => '0',
			'mobile_menu_bg_color'               => '0',
			'mobile_menu_text_color'             => '0',
			'mobile_menu_text_hover_color'       => '0',
			//styling
			'body_color_primary'                 => '0',
			//			//typography
			'font_size_h1'                       => '0',
			'font_weight_h1'                     => '0',
			'font_size_h2'                       => '0',
			'font_weight_h2'                     => '0',
			'font_size_h3'                       => '0',
			'font_weight_h3'                     => '0',
			'font_size_h4'                       => '0',
			'font_weight_h4'                     => '0',
			'font_size_h5'                       => '0',
			'font_weight_h5'                     => '0',
			'font_size_h6'                       => '0',
			'font_weight_h6'                     => '0',
			//footer
			'bg_copyright'                       => '0',
			'text_color_copyright'               => '0',
		);
		$theme_options_data = '';
		foreach ( $theme_options AS $key => $val ) {
			if ( $val == '0' ) {
				$data = $travel_blog_theme_options[$key];
			} else {
				$data = $travel_blog_theme_options[$key][$val];
			}
			$theme_options_data .= "\${$key}: {$data}!default;\n";
		}
		// font body
		$theme_options_data .= $travel_blog_theme_options['font_body']['color'] ? '$body_color:' . $travel_blog_theme_options['font_body']['color'] . ';' : '$body_color:#3333;';
		$theme_options_data .= $travel_blog_theme_options['font_body']['font-family'] ? '$body-font-family: ' . $travel_blog_theme_options['font_body']['font-family'] . ',Helvetica,Arial,sans-serif;' : '$body-font-family:Helvetica,Arial,sans-serif;';
		$theme_options_data .= $travel_blog_theme_options['font_body']['font-weight'] ? '$font_weight_body: ' . $travel_blog_theme_options['font_body']['font-weight'] . ';' : '$font_weight_body:Normal;';
		$theme_options_data .= $travel_blog_theme_options['font_body']['font-size'] ? '$body_font_size: ' . $travel_blog_theme_options['font_body']['font-size'] . ';' : '$body_font_size:13px;';
		$theme_options_data .= $travel_blog_theme_options['font_body']['line-height'] ? '$body_line_height: ' . $travel_blog_theme_options['font_body']['line-height'] . ';' : '$body_line_height:24px';

		// font heading
		$theme_options_data .= $travel_blog_theme_options['font_title']['font-family'] ? '$heading-font-family: ' . $travel_blog_theme_options['font_title']['font-family'] . ',Helvetica,Arial,sans-serif;' : '$heading-font-family:Helvetica,Arial,sans-serif;';
		$theme_options_data .= $travel_blog_theme_options['font_title']['color'] ? '$heading-color: ' . $travel_blog_theme_options['font_title']['color'] . ';' : '$heading-color:#333;';
		$theme_options_data .= $travel_blog_theme_options['font_title']['font-weight'] ? '$heading-font-weight: ' . $travel_blog_theme_options['font_title']['font-weight'] . ';' : '$heading-font-weight:Normal;';

		$theme_options_data .= $wp_filesystem->get_contents( $fileout );

		$css              = '';
		$background_color = $travel_blog_theme_options['body_background']['background-color'] ? ' background-color: ' . $travel_blog_theme_options['body_background']['background-color'] : '';

		if ( $background_color ) {
			$css .= '.wrapper-container{' . $background_color . '}';
		}
		if ( isset( $travel_blog_theme_options['box_layout'] ) && $travel_blog_theme_options['box_layout'] == 'boxed' ) {
			$background_image = '';
			if ( $travel_blog_theme_options['body_background']['background-image'] ) {
				$background_image .= $travel_blog_theme_options['body_background']['background-image'] ? 'background-image: url( ' . $travel_blog_theme_options['body_background']['background-image'] . ');' : '';
			} elseif ( isset( $travel_blog_theme_options['background_pattern'] ) ) {
				$background_image .= $travel_blog_theme_options['background_pattern'] ? 'background-image: url( ' . $travel_blog_theme_options['background_pattern'] . ');' : '';
			}
			$background_image .= $travel_blog_theme_options['body_background']['background-repeat'] ? 'background-repeat: ' . $travel_blog_theme_options['body_background']['background-repeat'] . ';' : '';
			$background_image .= $travel_blog_theme_options['body_background']['background-size'] ? 'background-size: ' . $travel_blog_theme_options['body_background']['background-size'] . ';' : '';
			$background_image .= $travel_blog_theme_options['body_background']['background-attachment'] ? 'background-attachment: ' . $travel_blog_theme_options['body_background']['background-attachment'] . ';' : '';
			$background_image .= $travel_blog_theme_options['body_background']['background-position'] ? 'background-position: ' . $travel_blog_theme_options['body_background']['background-position'] . ';' : '';
			if ( $background_image ) {
				$css .= 'body{' . $background_image . '}';
			}
		}
		$css .= $scss->compile( $theme_options_data );
		// custom css
		$css .= $travel_blog_theme_options['opt-ace-editor-css'];
		if ( !$wp_filesystem->put_contents( TRAVEL_BLOG_UPLOADS_FOLDER . TRAVEL_BLOG_FILE_NAME, $css, FS_CHMOD_FILE ) ) {
			$wp_filesystem->put_contents( TRAVEL_BLOG_UPLOADS_FOLDER . TRAVEL_BLOG_FILE_NAME, $css, FS_CHMOD_FILE );
		}
	}
}

new sass2css();