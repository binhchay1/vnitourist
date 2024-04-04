<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package travel_blog
 */
?>
</div><!-- #content -->

<div class="wrapper-footer">
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="main-top-footer">
			<div class="container-fluid">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="wrapper-copyright">
		<div class="container">
			<div class="row">

				<div class="col-sm-<?php if ( is_active_sidebar( 'copyright' ) ) {
					echo '6';
				} else {
					echo '12 text-center';
				} ?>">
					<?php
					if ( travel_blog_get_option( 'copyright_text' ) ) {
						echo '<div>' . wp_kses( travel_blog_get_option( 'copyright_text' ), array(
								'a'      => array(
									'href'  => array(),
									'title' => array()
								),
								'br'     => array(),
								'p'      => array(),
								'em'     => array(),
								'strong' => array(),
							) ) . '</div>';
					} else {
						echo '<div><p>' . esc_html__( 'Copyright &copy; 2017 Travel Blog. All Rights Reserved.', 'travel-blog' ) . '</p></div>';
					}
					?>
				</div> <!-- col-sm-3 -->
				<?php if ( is_active_sidebar( 'copyright' ) ) : ?>
					<div class="col-sm-6">
						<?php dynamic_sidebar( 'copyright' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</div>
<?php
if ( travel_blog_get_option( 'totop_show' ) == 1 ) {
	?>
	<a href="#" class="footer__arrow-top" title="<?php esc_attr_e( 'Go To Top', 'travel-blog' ); ?>">
		<span></span><i class="fa fa-angle-up"></i></a>
<?php } ?>

<?php wp_footer();
?>
</body>
</html>
