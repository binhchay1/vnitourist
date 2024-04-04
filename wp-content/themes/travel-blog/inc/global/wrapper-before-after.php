<?php
if ( !function_exists( 'travel_blog_wrapper_layout' ) ) :
	function travel_blog_wrapper_layout() {
		global $travel_blog_theme_options, $wp_query;
		$wrapper_layout = $cat_ID = '';
		$class_col      = 'col-sm-8 alignleft';

		if ( is_front_page() || is_home() ) {
			$prefix = 'archive_front_page';
		} else {
			$prefix = 'archive';
		}

		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}
		// get layout
		if ( is_page() || is_single() ) {
			if ( isset( $travel_blog_theme_options[$prefix . '_single_layout'] ) ) {
				$wrapper_layout = $travel_blog_theme_options[$prefix . '_single_layout'];
			}
			/***********custom layout*************/
			$wrapper_layout = get_post_meta( get_the_ID(), 'phys_custom_layout', true ) ? get_post_meta( get_the_ID(), 'layout', true ) : $wrapper_layout;
		} else {
			if ( isset( $travel_blog_theme_options[$prefix . '_cate_layout'] ) ) {
				$wrapper_layout = $travel_blog_theme_options[$prefix . '_cate_layout'];
			}
			/***********custom layout*************/

			$using_custom_layout = get_tax_meta( $cat_ID, 'phys_layout', true );
			if ( $using_custom_layout <> '' ) {
				$wrapper_layout = get_tax_meta( $cat_ID, 'phys_layout', true );
			}
		}

		if ( $wrapper_layout == 'full-content' ) {
			$class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$class_col = "col-sm-8 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$class_col = 'col-sm-8 alignright';
		}

		return $class_col;
	}
endif;
add_action( 'travel_blog_wrapper_loop_start', 'travel_blog_wrapper_loop_start' );

if ( !function_exists( 'travel_blog_wrapper_loop_start' ) ) :
	function travel_blog_wrapper_loop_start() {
		$class_col = travel_blog_wrapper_layout();
		echo '<div class="content-area"><div class="container"><div class="row"><div class="site-main ' . $class_col . '">';
	}
endif;

add_action( 'travel_blog_wrapper_loop_end', 'travel_blog_wrapper_loop_end' );
if ( !function_exists( 'travel_blog_wrapper_loop_end' ) ) :
	function travel_blog_wrapper_loop_end() {
		$class_col = travel_blog_wrapper_layout();
		echo '</div>';
		if ( $class_col != 'col-sm-12 full-width' ) {
			get_sidebar();
		}
		echo '</div></div></div>';
	}
endif;
