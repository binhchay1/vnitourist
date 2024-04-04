<?php

/**
 * Get ThemeOptions
 * @return array|mixed|void
 */
function travel_blog_get_data_themeoptions() {
	global $travel_blog_theme_options;

	return $travel_blog_theme_options;
}

function travel_blog_get_option( $name = '', $value_default = '' ) {
	$data = travel_blog_get_data_themeoptions();
	if ( isset( $data[$name] ) ) {
		return $data[$name];
	} else {
		return $value_default;
	}
}

function travel_blog_current_blog() {
	global $current_blog;

	return $current_blog;
}

/**
 * Add action and add filter
 * Class travel_blog_theme_include
 */
class travel_blog_theme_include {
	public function __construct() {
		// Setup theme
		add_action( 'after_setup_theme', array( $this, 'travel_blog_setup_theme' ) );

		// change position comment field
		add_action( 'after_setup_theme', array( $this, 'travel_blog_change_field_message_comment' ) );

		//Process widget: add or remove
		add_action( 'widgets_init', array( $this, 'travel_blog_widgets_init' ) );

		//Set the content width in pixels
		add_action( 'after_setup_theme', array( $this, 'travel_blog_content_width' ), 0 );

		//Add Script
		add_action( 'wp_enqueue_scripts', array( $this, 'travel_blog_init_scripts' ) );
		//admin Script
		add_action( 'admin_enqueue_scripts', array( $this, 'travel_blog_admin_scripts' ) );
		//Remove filter and Add new filther
//		remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
//		add_filter( 'get_the_excerpt', array( $this, 'travel_blog_wp_new_excerpt' ) );


		add_filter( 'excerpt_length', array( $this, 'travel_blog_excerpt_length' ), 9 );

		/********************travel_blog_entry_top**********************/
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
		add_filter( 'embed_oembed_html', array( $this, 'travel_blog_custom_oembed_filter' ), 10, 4 );

		/********************travel_blog_entry_top**********************/
		add_action( 'travel_blog_entry_top', array( $this, 'travel_blog_post_formats' ) );
	}

	/**
	 * Override excerpt of post
	 *
	 * @param $text
	 *
	 * @return mixed|string|void
	 */

	public function travel_blog_excerpt_length( $length ) {
		global $travel_blog_theme_options;
		$length = 55;
		if ( isset( $travel_blog_theme_options['excerpt_length_blog'] ) && $travel_blog_theme_options['excerpt_length_blog'] ) {
			$length = $travel_blog_theme_options['excerpt_length_blog'];
		}

		return $length;
	}

	public function travel_blog_wp_new_excerpt( $text ) {
		global $travel_blog_theme_options;
		$length = 55;
		if ( isset( $travel_blog_theme_options['excerpt_length_blog'] ) && $travel_blog_theme_options['excerpt_length_blog'] ) {
			$length = $travel_blog_theme_options['excerpt_length_blog'];
		}
		if ( $text == '' ) {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
//			$text           = str_replace( ']]>', ']]>', $text );
//			$text           = strip_tags( $text );
//			$text           = nl2br( $text );
			$excerpt_length = apply_filters( 'excerpt_length', $length );
			$words          = explode( ' ', $text, $excerpt_length + 1 );
			if ( count( $words ) > $excerpt_length ) {
				array_pop( $words );
				array_push( $words, '' );
				$text = implode( ' ', $words );
			}
		}

		return $text;
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function travel_blog_init_scripts() {
		wp_deregister_style( 'open-sans' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'travel-blog-style', get_stylesheet_uri() );

		if ( is_file( TRAVEL_BLOG_UPLOADS_FOLDER . 'physcode_travel_blog.css' ) ) {
			wp_enqueue_style( 'physcode_travel_blog', TRAVEL_BLOG_UPLOADS_URL . 'physcode_travel_blog.css', array() );
		} else {
			wp_enqueue_style( 'physcode_travel_blog', get_template_directory_uri() . '/assets/css/physcode_travel_blog.css', array() );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'style-rtl', get_template_directory_uri() . '/rtl.css', array(), '1.0' );
		}
		$custom_css = "
                .mycolor{
                        background: #000;
                }";
		wp_add_inline_style( 'custom-style', $custom_css );
		//register script
		wp_register_script( 'travel_flexslider', get_template_directory_uri() . '/assets/js/flexslider.js', array( 'jquery' ), '2242017', true );
		wp_register_script( 'travel_owl-carousel', get_template_directory_uri() . '/assets/js/owl-carousel.js', array( 'jquery' ), '2242017', true );
		wp_register_script( 'travel_blog_bxslider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ), '201513', true );
		//enqueue script
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '20151215', true );
		wp_enqueue_script( 'travel_SideNav', get_template_directory_uri() . '/assets/js/SideNav.js', array( 'jquery' ), '2242017', true );
		wp_enqueue_script( 'travel_blog-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), '1.0.6', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Script in backend
	 */
	public function travel_blog_admin_scripts() {
		wp_enqueue_style( 'travel_blog_widget_upload_image', get_template_directory_uri() . '/assets/css/admin.css' );

		$screen = get_current_screen();
		if ( $screen->id == 'widgets' || $screen->id == 'customize' ) {
			wp_enqueue_media();
			wp_enqueue_script( 'travel_blog_widget_upload_image', get_template_directory_uri() . '/assets/js/widget_upload_image.js', array( 'jquery' ) );
		}
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function travel_blog_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'travel-blog' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Position on the left or right of content. It will not show on shop page.', 'travel-blog' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'travel-blog' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here.', 'travel-blog' ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Copyright Right', 'travel-blog' ),
			'id'            => 'copyright',
			'description'   => esc_html__( 'Add widgets here.', 'travel-blog' ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function travel_blog_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'travel_blog_content_width', 640 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function travel_blog_setup_theme() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on travel_blog, use a find and replace
		 * to change 'travel-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'travel-blog', TRAVEL_BLOG_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
 		 */
		add_theme_support( 'woocommerce' );

		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'travel-blog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link' ) );
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		$args = apply_filters(
			'travel_blog_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', $args );
		add_theme_support( "custom-header", $args );

		//update_option( 'medium_size_w', 370 );
		//update_option( 'medium_size_h', 260 );
	}

	public function travel_blog_change_field_message_comment() {
		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );
	}

	public function travel_blog_custom_oembed_filter( $html ) {
		$return = '<div class="video-container">' . $html . '</div>';

		return $return;
	}

	public function travel_blog_post_formats( $size ) {
		$html = $schema = '';
		switch ( get_post_format() ) {
			case 'image':
				$imageID = get_post_meta( get_the_ID(), 'image_hover', true );
				$image   = wp_get_attachment_image_src( $imageID, $size );
				if ( has_post_thumbnail() ) {
					if ( is_single() ) {
						$html .= get_the_post_thumbnail( get_the_ID(), $size );
					} else {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '" title ="' . the_title_attribute( 'echo=0' ) . '">';
						$html .= get_the_post_thumbnail( get_the_ID(), $size );
						if ( $image ) {
							$html .= '<img src="' . $image[0] . '" alt="' . the_title_attribute( 'echo=0' ) . '"  class="image_responsive">';
						}
						$html .= '</a>';
					}
				}
				break;
			case 'gallery':
				wp_enqueue_script( 'travel_flexslider' );
				$images = get_post_meta( get_the_ID(), 'images', false );
				if ( empty( $images ) ) {
					if ( has_post_thumbnail() ) {
						if ( !is_single() ) {
							$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						}
						$html .= get_the_post_thumbnail( get_the_ID(), $size );
						if ( !is_single() ) {
							$html .= '</a>';
						}
					}
				} else {
					$html .= '<div class="flexslider">';
					$html .= '<ul class="slides">';
					foreach ( $images as $image ) {
						$image = wp_get_attachment_image_src( $image, $size );
						$html  .= sprintf( '<li class="item-slider"><img src="%s" alt="%2$s"></li>', esc_url( $image[0] ), the_title_attribute( 'echo=0' ) );
					}
					$html .= '</ul>';
					$html .= '</div>';
				}

				break;
			case 'audio':
				$audio = get_post_meta( get_the_ID(), 'audio', true );
				if ( !$audio ) {
					break;
				}
				// If URL: show oEmbed HTML or jPlayer
				if ( filter_var( $audio, FILTER_VALIDATE_URL ) ) {
					if ( $oembed = @wp_oembed_get( $audio ) ) {
						$html .= $oembed;
					}
				} // If embed code: just display
				else {
					$html .= $audio;
				}
				break;
			case 'video':
				$video = get_post_meta( get_the_ID(), 'video', true );
				if ( !$video ) {
					break;
				}
				// If URL: show oEmbed HTML
				if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
					if ( $oembed = @wp_oembed_get( $video ) ) {
						$html .= '<div class="video-container">' . $oembed . '</div>';
					}
				} // If embed code: just display
				else {
					$html .= '<div class="video-container">' . $video . '</div>';
				}
				break;
			case 'link':
				$url   = get_post_meta( get_the_ID(), 'url', true );
				$thumb = get_the_post_thumbnail( get_the_ID(), $size );
				if ( $url ) {
					$html .= '<a class="post-image" href="' . esc_url( $url ) . '">';
				}
				$html .= $thumb;
				if ( $url ) {
					$html .= '</a/>';
				}

				break;
			default:
				$imageID = get_post_meta( get_the_ID(), 'image_hover', true );
				$image   = wp_get_attachment_image_src( $imageID, $size );
				$thumb   = get_the_post_thumbnail( get_the_ID(), $size );

				if ( $thumb ) {

					if ( is_single() ) {
						$html .= $thumb;

					} else {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						$html .= $thumb;
						if ( $image ) {
							$html .= '<img src="' . $image[0] . '" alt="' . the_title_attribute( 'echo=0' ) . '"  class="image_responsive">';
						}
						$html .= '</a>';
					}
				}
		}
		if ( $html ) {
			echo '<div class="post-formats-wrapper">' . $html . '</div>';
		}
	}
}


new travel_blog_theme_include();

add_action( 'init', 'travel_blog_get_option_options_backend' );
function travel_blog_get_option_options_backend() {
	if ( travel_blog_get_option( 'show_text_read_more', '0' ) == '1' ) {
		add_filter( 'excerpt_more', 'travel_blog_excerpt_more' );
		function travel_blog_excerpt_more( $more ) {
			if ( !is_single() ) {
				$more = sprintf( ' <a class="read-more" href="%1$s">%2$s</a>',
					get_permalink( get_the_ID() ),
					__( 'Read More', 'travel-blog' )
				);
			}
 			return $more;
		}
	}
}

//////////////////////////////////////////////////////////////////
/////////// Enable shortcodes in text widgets
//////////////////////////////////////////////////////////////////

add_filter( 'widget_text', 'do_shortcode' );
/**
 * Remove section in customize
 */
function travel_blog_remove_styles_sections() {
	global $wp_customize;
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

//Remove section in customize
add_action( 'customize_register', 'travel_blog_remove_styles_sections' );

if ( !function_exists( 'travel_blog_excerpt' ) ) {
	function travel_blog_excerpt( $limit ) {
		$text  = get_the_content( '' );
		$text  = strip_shortcodes( $text );
		$text  = apply_filters( 'the_content', $text );
		$text  = str_replace( ']]>', ']]>', $text );
		$text  = strip_tags( $text );
		$text  = nl2br( $text );
		$words = explode( ' ', $text, $limit + 1 );
		if ( count( $words ) > $limit ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}

		return $text;
	}
}

if ( !function_exists( 'travel_blog_comment' ) ) :
	function travel_blog_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php _e( 'Pingback:', 'travel-blog' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'travel-blog' ), '<span class="edit-link">', '</span>' ); ?></p>
				</li>
				<?php
				break;
			default :
				?>

				<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

					<div class="wrapper-comment">
						<?php
						if ( $args['avatar_size'] != 0 ) {
							echo '<div class="wrapper_avatar">' . get_avatar( $comment, $args['avatar_size'] ) . '</div>';
						}
						?>
						<div class="comment-right">
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'travel-blog' ) ?></em>
							<?php endif; ?>

							<div class="comment-extra-info">
								<div
									class="author"><?php printf( '<span class="author-name"><i class="fa fa-user"></i> %s</span>', get_comment_author_link() ) ?></div>
								<div class="date">
									<i class="fa fa-calendar"></i> <?php printf( get_comment_date(), get_comment_time() ) ?>
								</div>

								<?php edit_comment_link( esc_html__( 'Edit', 'travel-blog' ), '', '' ); ?>
								<span class="reply">
									<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'travel-blog' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID ); ?>
 								</span>
							</div>

							<div class="content-comment">
								<?php comment_text() ?>
							</div>
						</div>
					</div>
				</li>
				<?php
				break;
		endswitch;
	}
endif; // ends check for travel-blog_comment()


/*
 * end list comment
 */

add_editor_style();

function travel_blog_get_wp_query() {
	global $wp_query;

	return $wp_query;
}


/*
 * breadcrumb
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * logo
 */
require get_template_directory() . '/inc/global/logo.php';

/**
 * Display Setting front end
 */
require_once get_template_directory() . '/inc/global/wrapper-before-after.php';
/**
 * Add Tax Meta
 */
require get_template_directory() . '/inc/admin/tax-meta.php';
/**
 * Add Meta box
 */
require get_template_directory() . '/inc/admin/meta-boxes.php';
/**
 * widget
 */
require get_template_directory() . '/inc/widgets.php';

/*
	required plugin
*/

require get_template_directory() . '/inc/admin/required-plugins/plugins-require.php';
/*
	Theme Option
*/

require get_template_directory() . '/inc/admin/options-config.php';
/*
	Generator CSS from Theme Option
*/
require get_template_directory() . '/inc/admin/sassphp/sass2css.php';

// Hard Crop
if ( false === get_option( "medium_crop" ) ) {
	add_option( "medium_crop", "1" );
} else {
	update_option( "medium_crop", "1" );
}
if ( false === get_option( "large_crop" ) ) {
	add_option( "large_crop", "1" );
} else {
	update_option( "large_crop", "1" );
}


function travel_blog_custom_styles() {
	echo '<style type="text/css">';
	$categorys = get_categories( array(
		'pad_counts'         => 1,
		'show_counts'        => 1,
		'hierarchical'       => 1,
		'hide_empty'         => 1,
		'show_uncategorized' => 1,
		'orderby'            => 'name',
		'menu_order'         => false
	) );
	foreach ( $categorys as $category ) {
		$color = get_tax_meta( $category->term_id, 'phys_cat_color', true );
		if ( $color == '#' ) {
			$color = '';
		}
		if ( $color <> '' ) {
			?>
			.wrapper-content-item.category-<?php echo esc_attr( $category->slug ) ?> .content-inner .cat-links a,
			.wrapper-content-item.category-<?php echo esc_attr( $category->slug ) ?> .content-inner .cat-links,
			.wrapper-content-item.category-<?php echo esc_attr( $category->slug ) ?>:hover .content-inner h4 a,
			.wrapper-blog-content article.category-<?php echo esc_attr( $category->slug ) ?>:hover .entry-content .entry-header a
			{color: <?php echo esc_attr( $color ) ?>}
			.wrapper-blog-content article.category-<?php echo esc_attr( $category->slug ) ?> .entry-content .cat-links:before{background-color: <?php echo esc_attr( $color ) ?>}
			<?php
		}
	}
	echo '</style>';
}

add_action( 'wp_head', 'travel_blog_custom_styles' );