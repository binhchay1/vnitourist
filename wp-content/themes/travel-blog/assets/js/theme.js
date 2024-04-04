(function ($) {
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());
	/* Smartresize */
	(function ($, sr) {
		var debounce = function (func, threshold, execAsap) {
			var timeout;
			return function debounced() {
				var obj = this, args = arguments;

				function delayed() {
					if (!execAsap)
						func.apply(obj, args);
					timeout = null;
				}

				if (timeout)
					clearTimeout(timeout);
				else if (execAsap)
					func.apply(obj, args);
				timeout = setTimeout(delayed, threshold || 100);
			}
		}
		// smartresize
		jQuery.fn[sr] = function (fn) {
			return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
		};
	})(jQuery, 'smartresize');
	
	let a = jQuery('.read-more');
	for(let i = 0; i < a.length; i++){
		a[i].innerHTML = 'Finding out';
	}
	
	let s = jQuery('.hero-banner');
	for(let k = 0; k < s.length; k++) {
		s[k].removeAttribute('aria-hidden');
	}
	
	let j = jQuery('.top-social a');
	for(let l = 0; l < j.length; l++) {
		j[l].setAttribute('aria-label', 'Social');
	}
	
	let v = jQuery('.ecosystem-info img');
	for(let u = 0; u < v.length; u++) {
		v[u].setAttribute('width', '1000');
		v[u].setAttribute('height', '1000');
	}
	
	let k = jQuery('.hero-banner a');
	for(let x = 0; x < k.length; x++) {
		k[x].setAttribute('style', 'display: block !important');
		k[x].setAttribute('aria-hidden', 'false');
	}
	
	let z = jQuery('.post-thumbnail');
	for(let u = 0; u < z.length; u++) {
		z[u].setAttribute('aria-label', 'Thumbnail');
	}
	
	jQuery('.full-content-single').attr('style', 'margin-top: 0 !important');
	jQuery('.featured-area').attr('style', 'margin-top: 0 !important');

})(jQuery);

var custom_js = {
	init            : function () {
		// button mobile menu
		jQuery(".button-collapse").sideNav();
	},
	full_height     : function () {
		var height_window = jQuery(window).height();
		// button mobile menu
		jQuery(".hero-banner").css({"height": height_window + 'px'});
	},
	search          : function () {
		jQuery('.search-toggler').on('click', function (e) {
			jQuery('.search-overlay').addClass("search-show");
		});
		jQuery('.closeicon,.background-overlay').on('click', function (e) {
			jQuery('.search-overlay').removeClass("search-show");
		});
		jQuery(document).keyup(function (e) {
			if (e.keyCode == 27) {
				jQuery('.search-overlay').removeClass("search-show");
			}
		});
	},
	generateCarousel: function () {
		if (jQuery().owlCarousel) {
			jQuery(".wrapper-featured-slider").each(function () {
				var $this = jQuery(this), $rtl = false
				owl = $this.find('.feature-slider');
				if (jQuery('html').attr('dir') == 'rtl') {
					$rtl = true;
				}
				owl.owlCarousel({
					nav       : true,
					dots      : false,
					rtl       : $rtl,
					loop      : true,
					navText   : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
					responsive: {
						"0"   : {"items": 1, "margin": 0},
						"480" : {"items": 2, "margin": 15},
						"768" : {"items": 2, "margin": 20},
						"992" : {"items": 3, "margin": 20},
						"1200": {"items": 4, "margin": 25}
					}
				});
			})
		}
	},
	scrollToTop     : function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.footer__arrow-top').css({bottom: "15px"});
			} else {
				jQuery('.footer__arrow-top').css({bottom: "-100px"});
			}
		});
		jQuery('.footer__arrow-top').on('click', function () {
			jQuery('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	},
	stickyHeaderInit: function () {
		//Add class for masthead
		var $header = jQuery('.sticky_header');
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 2) {
				$header.removeClass('affix-top').addClass('affix');
			} else {
				$header.removeClass('affix').addClass('affix-top');
			}
		});
	},
	post_gallery    : function () {
		if (jQuery().flexslider) {
			jQuery('.flexslider').flexslider({
				slideshow     : true,
				animation     : 'fade',
				pauseOnHover  : true,
				animationSpeed: 400,
				smoothHeight  : true,
				directionNav  : true,
				controlNav    : false,
				prevText      : '',
				nextText      : ''
			});
		}
	},
	feature_slider  : function () {
		if (jQuery().bxSlider) {
			jQuery('.wrapper-hero-banner').bxSlider({
				pager       : false,
				controls    : false,
				auto        : true,
				touchEnabled: false,
				pause       : 5000, //The amount of time (in ms) between each auto transition
				nextText    : '<i class="fa fa-angle-right"></i>',
				prevText    : '<i class="fa fa-angle-left"></i>',
			});
		}
	},
	stickyShare     : function () {
		if (jQuery('.full-content-single .post-content').length) {
			var a = jQuery(".full-content-single .post-content"), b = jQuery(".left-content-single"),
				c = a.offset().top, d = jQuery(window).scrollTop();
			d >= c ? a.height() + c - d <= b.height() + 78 ? jQuery(".site-main").removeClass("element-fixed").addClass("element-abs-bottom") : jQuery(".site-main").removeClass("element-abs-bottom").addClass("element-fixed") : jQuery(".site-main").removeClass("element-fixed")
		}
	},
	removePositionBanner: function() {
		let b = jQuery('.hero-banner');
		for(let c = 0; c < b.length; b++) {
			b[c].style.position = "relative";
		}
	}
}

jQuery(window).load(function () {
	custom_js.init();
	custom_js.removePositionBanner();
	custom_js.full_height();
	custom_js.search();
	custom_js.generateCarousel();
	custom_js.scrollToTop();
	custom_js.stickyHeaderInit();
	custom_js.post_gallery();
	custom_js.feature_slider();
	jQuery('#preload').delay(100).fadeOut(500, function () {
		jQuery(this).remove();
	});

});

jQuery(window).resize(function () {
	custom_js.full_height();
});
