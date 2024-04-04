<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travel_blog
 */

if ( !is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="widget-area col-sm-4 alignleft">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->