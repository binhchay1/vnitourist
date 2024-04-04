<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
        <?php echo (get_option('ad_css') ? '<style>'.get_option('ad_css').'</style>' : '' );?>
    </head>
    <body>
        <div class="total-ad-notice"<?php echo (get_option('ad_notice_bg') ? ' style="background-color: '.get_option('ad_notice_bg').'"' : '' );?>><?php echo (get_option('ad_text') ? get_option('ad_text') : __('Skip this ad in...', 'total-ad-string') );?> <button class="skip-ad-button"><?php echo (get_option('ad_button') ? get_option('ad_button') : __('Skip >', 'total-ad-string') );?></button></div>
        <div class="ad-content">
            <?php echo do_shortcode(get_option('ad_content'));?>
        </div>
        <?php wp_footer(); ?>
        <script>
            jQuery(document).ready(function($) {

                var button_text = $( ".skip-ad-button" ).html();

                function time() {
                    var timestamp = Math.floor(new Date().getTime() / 1000)
                    return timestamp;
                }

                function check_ad(){
                    var timer = <?php echo ($_SESSION['start'] + get_option('ad_duration'));?> - time();

                    if(timer >= 0){
						$( ".skip-ad-button" ).html(timer);
                        setTimeout(function(){check_ad()}, 1000);
                    } else {
                        <?php if(get_option('ad_autoclose') != 1){ ?>
                        $( ".skip-ad-button" ).html(button_text);
                        $( ".skip-ad-button" ).attr('onclick', 'location.reload();');
                        <?php } else { ?>
                        location.reload();
                        <?php } ?>
                    }

                }

                check_ad();

            });
        </script>
        <?php echo (get_option('ad_js') ? '<script>'.get_option('ad_js').'</script>' : '' );?>
    </body>
</html>
