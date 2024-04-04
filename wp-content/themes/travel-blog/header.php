<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travel_blog
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="ahrefs-site-verification" content="6696d4ed9ce3e44a9658b8dfe8ae27d2e90fce3365b23b65c226b8c5a97c1330">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<script data-cfasync="false"></script>
	<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</head>

<body <?php body_class(); ?>>
<?php
if ( travel_blog_get_option( 'show_preload' ) == '1' ) {
	echo '<div id="preload"><div class="preload-inner"></div></div>';
}
$class_header  = travel_blog_get_option( 'sticky_menu' ) == '1' ? ' sticky_header' : '';
$boxed         = travel_blog_get_option( 'box_layout' ) == 'boxed' ? ' boxed-area' : '';
$class_content = ' top_site_main';

if ( ( travel_blog_get_option( 'home_page_menu_overlay' ) == '1' ) && ( is_front_page() || is_home() ) ) {
	$class_content = '';
	if(travel_blog_get_option('sticky_menu_custom','0') == '1'){
		$class_header .= ' custom_bg_sticky';
	}
}
 ?>
<div class="wrapper-container<?php echo esc_attr( $boxed ); ?>">
	<header id="masthead" class="site-header affix-top<?php echo esc_attr( $class_header ) ?>">
		<div class="navigation-menu">
			<div class="container wrapper-top-logo">
				<?php
				if ( travel_blog_get_option( 'show_search' ) == '1' ) {
					echo '<div class="header-search">
							<div class="search-toggler-unit"><div class="search-toggler"><i class="fa fa-search"></i></div></div>';
					echo '<div class="search-menu search-overlay search-hidden"><div class="closeicon"></div>';
					get_search_form();
					echo '<div class="background-overlay"></div></div></div>';
				}
				?>
				<?php if ( travel_blog_get_option( 'show_social' ) == '1' ) : ?>
					<div class="top-social">
						<?php if ( travel_blog_get_option( 'facebook_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'facebook_url' ) ); ?>" target="_blank">
								<i class="fa fa-facebook"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'twitter_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'twitter_url' ) ); ?>" target="_blank">
								<i class="fa fa-twitter"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'instagram_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'instagram_url' ) ); ?>" target="_blank">
								<i class="fa fa-instagram"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'pinterest_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'pinterest_url' ) ); ?>" target="_blank">
								<i class="fa fa-pinterest"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'bloglovin_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'bloglovin_url' ) ); ?>" target="_blank">
								<i class="fa fa-heart"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'google_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'google_url' ) ); ?>" target="_blank">
								<i class="fa fa-google-plus"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'tumblr_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'tumblr_url' ) ); ?>" target="_blank">
								<i class="fa fa-tumblr"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'youtube_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'youtube_url' ) ); ?>" target="_blank">
								<i class="fa fa-youtube-play"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'dribbble_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'dribbble_url' ) ); ?>" target="_blank">
								<i class="fa fa-dribbble"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'linkedin_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'linkedin_url' ) ); ?>" target="_blank">
								<i class="fa fa-linkedin"></i></a><?php endif; ?>
						<?php if ( travel_blog_get_option( 'rss_url' ) ) : ?>
						<a href="<?php echo esc_url( travel_blog_get_option( 'rss_url' ) ); ?>" target="_blank">
								<i class="fa fa-rss"></i></a><?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="wrapper-logo-area">
					<div class="menu-mobile-effect navbar-toggle button-collapse" data-activates="mobile-demo">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>
					<div class="logo-area">
						<?php
						echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
						do_action( 'travel_blog_logo' );
						echo '</a>';
						?>
					</div>
				</div>
			</div>
			<div class="container">
				<nav class="width-navigation">
					<?php get_template_part( 'inc/header/main-menu' ); ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="site wrapper-content<?php echo esc_attr( $class_content ) ?>">
				<ins class="adsbygoogle"
     data-ad-client="ca-pub-2721372160560428"
     data-full-width-responsive="true"></ins>