<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<ul class="nav navbar-nav menu-main-menu side-nav" id="mobile-demo">
	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
		) );
	} else {
		wp_nav_menu( array(
			'theme_location' => '',
			'container'      => false,
			'items_wrap'     => '%3$s',
		) );
	}
	?>
</ul>