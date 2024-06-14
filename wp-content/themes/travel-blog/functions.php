<?php
/**
 * travel_blog functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package travel_blog
 */

// Constants: Folder directories/uri's
define( 'TRAVEL_BLOG_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'TRAVEL_BLOG_THEME_URI', trailingslashit( get_template_directory_uri() ) );
/**
 * Remove the strange [OBJ] character in the post slug
 * See: https://github.com/WordPress/gutenberg/issues/38637

/**
 * Theme Includes
 */




add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
/**
 * Remove Gutenberg CSS
 */
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'init', function(){
	if (  ! is_admin()) {
		if( is_ssl() ){
			$protocol = 'https';
		}else {
			$protocol = 'http';
		}

		/** @var WP_Scripts $wp_scripts */
		global  $wp_scripts;
		/** @var _WP_Dependency $core */

		if ( WP_DEBUG ) {
			/** @var _WP_Dependency $migrate */
			$migrate         = $wp_scripts->registered[ 'jquery-migrate' ];
			$migrate_version = $migrate->ver;
			$migrate->src    = "$protocol://cdn.jsdelivr.net/jquery.migrate/$migrate_version/jquery-migrate.min.js";
		}else{
			/** @var _WP_Dependency $jquery */
			$jquery = $wp_scripts->registered[ 'jquery' ];
			$jquery->deps = [ 'jquery-core' ];
		}

    }


},11 );

require_once TRAVEL_BLOG_THEME_DIR . '/inc/init.php';
