jQuery(document).ready(function($) {

    function time() {
        var timestamp = Math.floor(new Date().getTime() / 1000)
        return timestamp;
    }

    function check_ad(){
        var data = {
            action: 'full_screen_ad_action',
            security : TotalAD.security,
            now: time()
        };
        $.post(TotalAD.ajaxurl, data, function(response) {
            if(response == 1){
                /*location.reload();*/
				var scroll_top = parseInt( document.documentElement.scrollTop ); 
				window.location.href = window.location.protocol + "//" + window.location.host + window.location.pathname + '?scroll=' + scroll_top;
            }
        });
        setTimeout(function(){check_ad()}, 1000);
    }

    check_ad();
	
function check_scroll()
{
    var url_vars = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < url_vars.length; i++)
    {
        url_var = url_vars[i].split('=');
		var scroll_top = parseInt( url_var[1] ); 
		if(url_var[0] == 'scroll' && scroll_top) {
			$("html, body").animate({ scrollTop: scroll_top + 'px' }, 100);
		}
    }
}
	
	check_scroll()

});