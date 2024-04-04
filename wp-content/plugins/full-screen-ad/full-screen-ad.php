<?php
/*
Plugin Name: Full screen ad
Plugin URI: https://www.andreadegiovine.it/download/full-screen-ad/?utm_source=wordpress_org&utm_medium=plugin_link&utm_campaign=full_screen_ad
Description: The only plugin that allows you to easily create a timed full-screen ad.
Author: Andrea De Giovine
Author URI: https://www.andreadegiovine.it/?utm_source=wordpress_org&utm_medium=plugin_details&utm_campaign=full_screen_ad
Text Domain: full-screen-ad
Domain Path: /languages/
Version: 1.0.1
*/


if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

if ( ! class_exists( 'adg_full_screen_ad' ) ) {
    class adg_full_screen_ad {
        public $priority = PHP_INT_MAX;

        public $bot = '';

        public function __construct(){
            $this->bot = apply_filters('full_screen_ad_bot', 'bot|crawl|spider|mediapartners|slurp|patrol');
            add_action('admin_menu', array( $this, 'init_options_page' ));
            add_action('admin_enqueue_scripts', array( $this, 'codemirror_enqueue_scripts' ));
            if(get_option('ad_enabled') == 1){
                add_action('init', array( $this, 'init_ad' ), -1);
                add_action( 'wp_enqueue_scripts', array( $this, 'full_screen_ad_ajax_script' ));
                add_action( 'wp_ajax_full_screen_ad_action', array( $this, 'full_screen_ad_ajax_callback' ));
                add_action( 'wp_ajax_nopriv_full_screen_ad_action', array( $this, 'full_screen_ad_ajax_callback' ));
            } else {
                session_start();
                if(array_key_exists('start',$_SESSION) || !empty($_SESSION['start'])){
                    $_SESSION['start'] = '';
                }
			}
            add_filter( 'plugin_action_links', array( $this, 'init_plugin_action_links' ), $this->priority, 2);
        }

        public function init_load_textdomain() {
            load_plugin_textdomain( 'full-screen-ad', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
        }

        public function init_options_page(){
            add_menu_page(__('Manage full screen ad', 'full-screen-ad-string'), __('Full screen ad', 'full-screen-ad-string'), 'administrator', 'full-screen-ad', array( $this, 'render_options_page' ) , 'dashicons-welcome-view-site' );
            add_action( 'admin_init', array( $this, 'settings_options_page' ) );
        }

        public function settings_options_page(){
            register_setting( 'full-screen-ad-settings', 'ad_enabled' );
            register_setting( 'full-screen-ad-settings', 'ad_autoclose' );
            register_setting( 'full-screen-ad-settings', 'ad_frequency' );
            register_setting( 'full-screen-ad-settings', 'ad_duration' );
            register_setting( 'full-screen-ad-settings', 'ad_content' );
            register_setting( 'full-screen-ad-settings', 'ad_css' );
            register_setting( 'full-screen-ad-settings', 'ad_js' );
            register_setting( 'full-screen-ad-settings', 'ad_text' );
            register_setting( 'full-screen-ad-settings', 'ad_notice_bg' );
            register_setting( 'full-screen-ad-settings', 'ad_button' );
        }

        public function codemirror_enqueue_scripts($hook) {
            wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
            wp_enqueue_script( 'js-code-editor', plugin_dir_url( __FILE__ ) . 'assets/code-editor.js', array( 'jquery' ), '', true );
        }

        public function render_options_page(){ ?>
<div class="wrap">
    <h1><?php _e('Full screen ad settings', 'full-screen-ad-string');?></h1>

    <form method="post" action="options.php">
        <?php settings_fields( 'full-screen-ad-settings' ); ?>
        <?php do_settings_sections( 'full-screen-ad-settings' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Enable', 'full-screen-ad-string');?></th>
                <td><label><input type="checkbox" name="ad_enabled" value="1" <?php checked( get_option('ad_enabled'), 1 ); ?> /> <?php _e('Check to activate', 'full-screen-ad-string');?></label></td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><?php _e('Auto close', 'full-screen-ad-string');?></th>
                <td><label><input type="checkbox" name="ad_autoclose" value="1" <?php checked( get_option('ad_autoclose'), 1 ); ?> /> <?php _e('Check to automatically close the ad page after the countdown', 'full-screen-ad-string');?></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Frequency', 'full-screen-ad-string');?></th>
                <td><label><input type="number" name="ad_frequency" value="<?php echo ( get_option('ad_frequency') ? esc_attr( get_option('ad_frequency') ) : 10 ); ?>" min="5" style="width: 100%" required /><small><?php _e('Time in seconds before showing the ad again.', 'full-screen-ad-string');?> - <a href="https://www.timecalculator.net/minutes-to-seconds" target="_blank" rel="nofollow"><?php _e('Minutes to seconds conversion', 'full-screen-ad-string');?></a></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Timer', 'full-screen-ad-string');?></th>
                <td><label><input type="number" name="ad_duration" value="<?php echo ( get_option('ad_duration') ? esc_attr( get_option('ad_duration') ) : 10 ); ?>" min="5" style="width: 100%" required /><small><?php _e('
Time in seconds of the ad duration.', 'full-screen-ad-string');?> - <a href="https://www.timecalculator.net/minutes-to-seconds" target="_blank" rel="nofollow"><?php _e('Minutes to seconds conversion', 'full-screen-ad-string');?></a></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Notice', 'full-screen-ad-string');?></th>
                <td><label><input type="text" name="ad_text" value="<?php echo esc_attr( get_option('ad_text') ); ?>" placeholder="<?php _e('Skip this ad in...', 'full-screen-ad-string');?>" style="width: 100%" /><small><?php _e('Text to show in the top bar while waiting.', 'full-screen-ad-string');?></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Notice background', 'full-screen-ad-string');?></th>
                <td><label><input type="text" name="ad_notice_bg" value="<?php echo esc_attr( get_option('ad_notice_bg') ); ?>" placeholder="<?php _e('#000', 'full-screen-ad-string');?>" style="width: 100%" /><small><?php _e('Background color of the top bar, allowable values HEX, RGB and RGBA.', 'full-screen-ad-string');?> - <a href="https://www.w3schools.com/colors/colors_hexadecimal.asp" target="_blank" rel="nofollow"><?php _e('HEX colors tool', 'full-screen-ad-string');?></a></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Skip button', 'full-screen-ad-string');?></th>
                <td><label><input type="text" name="ad_button" value="<?php echo esc_attr( get_option('ad_button') ); ?>" placeholder="<?php _e('Skip >', 'full-screen-ad-string');?>" style="width: 100%" /><small><?php _e('Text to show on the button after the end of the timer.', 'full-screen-ad-string');?></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Content', 'full-screen-ad-string');?></th>
                <td><?php wp_editor( get_option('ad_content'), 'ad_content' );?><small><?php _e('This is the body of the ad, you can use text, images, HTML, shortcode and whatever you want to show.', 'full-screen-ad-string');?></small></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Custom style', 'full-screen-ad-string');?></th>
                <td><label><textarea class="css-editor" name="ad_css"><?php echo esc_attr( get_option('ad_css') ); ?></textarea><small><?php _e('This code will be included in the &lt;head&gt; of the ad page, inside the &lt;style&gt;...&lt;/style&gt; tags.', 'full-screen-ad-string');?></small></label></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Custom script', 'full-screen-ad-string');?></th>
                <td><label><textarea class="js-editor" name="ad_js"><?php echo esc_attr( get_option('ad_js') ); ?></textarea><small><?php _e('This code will be included before the &lt;/body&gt; tag of the ad page, inside the &lt;script&gt;...&lt;/script&gt; tags.', 'full-screen-ad-string');?></small></label></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>
<?php }

        public function init_ad() {
            if(!is_admin()){
                session_start();
                if(!array_key_exists('start',$_SESSION) || empty($_SESSION['start'])){
                    $_SESSION['start'] = time();
                }
                $now = time();
                $end = $_SESSION['start'] + get_option('ad_duration');
                if($now >= $_SESSION['start'] && $now <= $end && !$this->isBot()){
                    include(plugin_dir_path( __FILE__ ).'assets/template.php');
                    die();
                } elseif($now > $end) {
                    $_SESSION['start'] = $now + get_option('ad_frequency');
                }
            }
        }

        public function full_screen_ad_ajax_script() {
            $now = time();
            $end = $_SESSION['start'] + get_option('ad_duration');
            if($now < $_SESSION['start'] || $now > $end){
                wp_enqueue_script( 'full-screen-ad-script', plugin_dir_url( __FILE__ ) . 'assets/script.js', array('jquery'), '1.0.0', true );
            } else {
                wp_enqueue_style('full-screen-ad-css', plugin_dir_url( __FILE__ ) . 'assets/style.css', array(), '1.0.0', 'all');
                wp_enqueue_script("jquery");
            }
            wp_localize_script( 'full-screen-ad-script', 'TotalAD', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'security' => wp_create_nonce( 'fs-ad-nonce' )
            ));
        }

        public function full_screen_ad_ajax_callback() {
            session_start();
            check_ajax_referer( 'fs-ad-nonce', 'security' );
            $now = intval( $_POST['now'] );
            $end = $_SESSION['start'] + get_option('ad_duration');
            if($now >= $_SESSION['start'] && $now <= $end){
                echo 1;
            } else {
                echo 0;
            }
            die();
        }

        public function isBot() {
            return (
                isset($_SERVER['HTTP_USER_AGENT']) // check if the user agent header key exists
                && preg_match('/'.$this->bot.'/i', $_SERVER['HTTP_USER_AGENT'])
            );
        }

        public function init_plugin_action_links($links, $file){
            if ( $file == 'full-screen-ad/full-screen-ad.php' ) {
                $links[] = sprintf( '<a href="%s"> %s </a>', menu_page_url( 'full-screen-ad', false ), __( 'Settings', 'full-screen-ad-string' ) );
            }
            return $links;
        }

    }

    new adg_full_screen_ad();
}

