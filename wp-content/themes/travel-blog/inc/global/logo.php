<?php
add_action( 'travel_blog_logo', 'travel_blog_logo', 1 );
// logo
if ( !function_exists( 'travel_blog_logo' ) ) :
	function travel_blog_logo() {
		global $travel_blog_theme_options;

		if ( ( travel_blog_get_option( 'home_page_menu_overlay' ) == '1' ) && ( is_front_page() || is_home() ) ) {
			if ( isset( $travel_blog_theme_options['travel_blog_logo_home'] ) && $travel_blog_theme_options['travel_blog_logo_home']['url'] <> '' ) {
				$url        = $travel_blog_theme_options['travel_blog_logo_home']['url'];
				$width      = $travel_blog_theme_options['travel_blog_logo_home']['width'];
				$height     = $travel_blog_theme_options['travel_blog_logo_home']['height'];
				$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
				echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_home_page"/>';
			} else {
				if ( isset( $travel_blog_theme_options['travel_blog_logo'] ) && $travel_blog_theme_options['travel_blog_logo']['url'] <> '' ) {
					$url        = $travel_blog_theme_options['travel_blog_logo']['url'];
					$width      = $travel_blog_theme_options['travel_blog_logo']['width'];
					$height     = $travel_blog_theme_options['travel_blog_logo']['height'];
					$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
					echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo"/>';
				} else {
					echo esc_attr( get_bloginfo( 'name' ) );
				}
			}
			if ( travel_blog_get_option( 'sticky_menu_custom', '0' ) == '1' &&  isset( $travel_blog_theme_options['travel_blog_logo_home_sticky'] ) && $travel_blog_theme_options['travel_blog_logo_home_sticky']['url'] <> '' ) {
				$url        = $travel_blog_theme_options['travel_blog_logo_home_sticky']['url'];
				$width      = $travel_blog_theme_options['travel_blog_logo_home_sticky']['width'];
				$height     = $travel_blog_theme_options['travel_blog_logo_home_sticky']['height'];
				$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
				echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo_home_page_custom_sticky"/>';
			}
		} else {
			if ( isset( $travel_blog_theme_options['travel_blog_logo'] ) && $travel_blog_theme_options['travel_blog_logo']['url'] <> '' ) {
				$url        = $travel_blog_theme_options['travel_blog_logo']['url'];
				$width      = $travel_blog_theme_options['travel_blog_logo']['width'];
				$height     = $travel_blog_theme_options['travel_blog_logo']['height'];
				$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
				echo '<img src="' . $url . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" class="logo"/>';
			} else {
				echo esc_attr( get_bloginfo( 'name' ) );
			}
		}

	}
endif;