<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WidgetImageField {
	var $field_name;
	var $default = '';
	var $current_val = '';

	public function __construct( $field_name, $default, $current_val ) {
		$this->field_name  = $field_name;
		$this->default     = $default;
		$this->current_val = $current_val;
	}

	public function get_field() {
		$field_name  = $this->field_name;
		$current_val = intval( $this->current_val ) ? intval( $this->current_val ) : intval( $this->default );
		ob_start(); ?>
		<script type="text/javascript"> upload_image_file_bindings(); </script>
		<div class="widget-media-field">
			<div class="option">
				<div class="controls">
					<input value="<?php echo ent2ncr( $current_val ) ?>" name="<?php echo ent2ncr( $field_name ) ?>" class=" upload of-input" type="hidden">
					<div class="screenshot">
						<?php if ( $current_val ) {
							$src = wp_get_attachment_link( $current_val, 'thumbnail', false );
							?>
							<?php echo ent2ncr( $src ) ?>
						<?php } ?>
					</div>
					<div class="upload_button_div">
						<span class="button media_upload_button"><?php esc_html_e( 'Select', 'travel-blog' ) ?></span>
						<span title="<?php echo esc_attr( $field_name ) ?>" id="reset_<?php echo esc_attr( $field_name ) ?>" class="button remove-image "><?php esc_html_e( 'Remove', 'travel-blog' ) ?></span>
					</div>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
		$html = ob_get_clean();

		return $html;
	}
}

add_action( 'widgets_init', array( 'Travel_Blog_Widget_Attributes', 'setup' ) );

class Travel_Blog_Widget_Attributes {
	const VERSION = '0.2.2';

	/**
	 * Initialize plugin
	 */
	public static function setup() {
		if ( is_admin() ) {
			// Add necessary input on widget configuration form
			add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );
			// Save widget attributes
			add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );
		} else {
			// Insert attributes into widget markup
			add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
		}
	}


	/**
	 * Inject input fields into widget configuration form
	 *
	 * @since   0.1
	 * @wp_hook action in_widget_form
	 *
	 * @param object $widget Widget object
	 *
	 * @return NULL
	 */
	public static function _input_fields( $widget, $return, $instance ) {
		$instance = self::_get_attributes( $instance );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				if (jQuery().wpColorPicker) {
					jQuery('.widget-custom-color').wpColorPicker();
				}
			})
		</script>
		<p>
			<?php printf(
				'<label for="%s">%s</label><br/>',
				esc_attr( $widget->get_field_id( 'extra-color' ) ),
				esc_html__( 'Border & Background Title Color', 'travel-blog' )
			) ?>
			<?php
			printf(
				'<input type="text" class="widefat widget-custom-color" id="%s" name="%s" value="%s" />',
				esc_attr( $widget->get_field_id( 'extra-color' ) ),
				esc_attr( $widget->get_field_name( 'extra-color' ) ),
				esc_attr( $instance['extra-color'] )
			);
			?>
		</p>
		<p>
			<?php printf(
				'<label for="%s">%s</label>',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_html__( 'Extra Class', 'travel-blog' )
			) ?>
			<?php
			printf(
				'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_attr( $widget->get_field_name( 'widget-class' ) ),
				esc_attr( $instance['widget-class'] )
			);
			?>
		</p>
		<?php
		return null;
	}


	/**
	 * Get default attributes
	 *
	 * @since 0.1
	 *
	 * @param array $instance Widget instance configuration
	 *
	 * @return array
	 */
	private static function _get_attributes( $instance ) {
		$instance = wp_parse_args(
			$instance,
			array(
				'extra-color'  => '',
				'widget-class' => '',
			)
		);

		return $instance;
	}


	/**
	 * Save attributes upon widget saving
	 *
	 * @since   0.1
	 * @wp_hook filter widget_update_callback
	 *
	 * @param array  $instance     Current widget instance configuration
	 * @param array  $new_instance New widget instance configuration
	 * @param array  $old_instance Old Widget instance configuration
	 * @param object $widget       Widget object
	 *
	 * @return array
	 */
	public static function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
		$instance['extra-color']  = '';
		$instance['widget-class'] = '';

		// Color
		if ( !empty( $new_instance['extra-color'] ) ) {
			$instance['extra-color'] = apply_filters(
				'widget_attribute_extra-color',
				implode(
					' ',
					array_map(
						'sanitize_hex_color',
						explode( ' ', $new_instance['extra-color'] )
					)
				)
			);
		} else {
			$instance['extra-color'] = '';
		}
		// Classes
		if ( !empty( $new_instance['widget-class'] ) ) {
			$instance['widget-class'] = apply_filters(
				'widget_attribute_classes',
				implode(
					' ',
					array_map(
						'sanitize_html_class',
						explode( ' ', $new_instance['widget-class'] )
					)
				)
			);
		} else {
			$instance['widget-class'] = '';
		}

		return $instance;
	}


	/**
	 * Insert attributes into widget markup
	 *
	 * @since  0.1
	 * @filter dynamic_sidebar_params
	 *
	 * @param array $params Widget parameters
	 *
	 * @return Array
	 */
	public static function _insert_attributes( $params ) {
		global $wp_registered_widgets;

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[$widget_id];

		if (
			!isset( $widget_obj['callback'][0] )
			|| !is_object( $widget_obj['callback'][0] )
		) {
			return $params;
		}

		$widget_options = get_option( $widget_obj['callback'][0]->option_name );
		if ( empty( $widget_options ) ) {
			return $params;
		}

		$widget_num = $widget_obj['params'][0]['number'];
		if ( empty( $widget_options[$widget_num] ) ) {
			return $params;
		}

		$instance = $widget_options[$widget_num];
		// Classes
		if ( !empty( $instance['widget-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-class'] ),
				$params[0]['before_widget'],
				1
			);
		}
		if ( !empty( $instance['extra-color'] ) ) {
			$params[0]['before_widget'] .= '<style type="text/css">';
			$params[0]['before_widget'] .= sprintf( '#%s .widget-title span { background-color: %s; }', $widget_id, $instance['extra-color'] );
			$params[0]['before_widget'] .= sprintf( '#%s{ border-color: %s; }', $widget_id, $instance['extra-color'] );
			$params[0]['before_widget'] .= sprintf( '#%s a:hover{ color: %s; }', $widget_id, $instance['extra-color'] );
			$params[0]['before_widget'] .= '</style>';
		}

		return $params;
	}
}

require_once TRAVEL_BLOG_THEME_DIR . 'inc/widgets/about-us.php';
require_once TRAVEL_BLOG_THEME_DIR . 'inc/widgets/list-post.php';
require_once TRAVEL_BLOG_THEME_DIR . 'inc/widgets/facebook_widget.php';