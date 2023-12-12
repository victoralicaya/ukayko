(function ($) {
		"use strict";

		var $document = $(document),
				$window = $(window),
				$body = $('body'),
				$html = $('html'),
				$ttPageContent = $('#tt-pageContent'),
				$stucknav = $('.header_section'),
		blocks = {
				ttInputCounter: $('.tt-input-counter'),
				ttMobileProductSlider: $('.tt-mobile-product-slider'),
				ttCarouselProducts: $('.tt-carousel-products'),
				ttProductSingleBtnZomm: $ttPageContent.find('.tt-product-single-img .tt-btn-zomm'),
		};

		var ttwindowWidth = window.innerWidth || $window.width();
		
		$(window).scroll(function() {
			if ($(this).scrollTop() > 200) {
			  $('.backtotop:hidden').stop(true, true).fadeIn();
			} else {
			  $('.backtotop').stop(true, true).fadeOut();
			}
		  });
		  $(function() {
			$(".scroll").on('click', function() {
			  $("html,body").animate({
				scrollTop: $("#thetop").offset().top
			  }, "slow");
			  return false
			})
		});
		
		$('.search_btn').on('click', function() {
			$('.search_btn > .fa-search').toggleClass('fa-times');
		});
		
		$("[data-text-color]").each(function () {
			$(this).css("color", $(this).attr("data-text-color"))
		});

		$("[data-bg-color]").each(function () {
			$(this).css("background", $(this).attr("data-bg-color"))
		});
	  
		$('[data-background]').each(function() {
			$(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
		});
		
		$(document).ready(function () {
			$('.close_btn, .overlay').on('click', function () {
			  $('.sidebar_mobile_menu, .filter_sidebar, .cart_sidebar').removeClass('active');
			  $('.overlay').removeClass('active');
			});

			$('.mobile_menu_btn').on('click', function () {
			  $('.sidebar_mobile_menu').addClass('active');
			  $('.overlay').addClass('active');
			});
			
			$('.cart_btn').on('click', function () {
			  $('.cart_sidebar').addClass('active');
			  $('.overlay').addClass('active');
			});
			
			$('.dropdown-menu .dropdown > a').on('click', function(e) {
				if (!$(this).next().hasClass('show')) {
				  $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				var $subMenu = $(this).next(".dropdown-menu");
				$subMenu.toggleClass('show');
				$(this).parents('li.dropdown.show').on('.dropdown', function(e) {
				  $('.dropdown-menu > .dropdown .show').removeClass("show");
				});
				$('.dropdown-menu li a.dropdown-toggle').removeClass("show_dropdown");
				if ($(this).next().hasClass('show')) {
				  $(this).addClass("show_dropdown");
				}
				return false;
			  });
			  
			$('.countdown_timer').each(function(){
				$('[data-countdown]').each(function() {
				  var $this = $(this), finalDate = $(this).data('countdown');
				  $this.countdown(finalDate, function(event) {
					var $this = $(this).html(event.strftime(''
					  + '<li class="days_count"><strong>%D</strong><span>Days</span></li>'
					  + '<li class="hours_count"><strong>%H</strong><span>Hours</span></li>'
					  + '<li class="minutes_count"><strong>%M</strong><span>Mins</span></li>'
					  + '<li class="seconds_count"><strong>%S</strong><span>Secs</span></li>'));
				  });
				});
			});
			
			$('.zoom-gallery').magnificPopup({
				delegate: '.popup_image',
				type: 'image',
				closeOnContentClick: false,
				closeBtnInside: false,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				image: {
				  verticalFit: true,
				  titleSrc: function(item) {
					return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
				  }
				},
				gallery: {
				  enabled: true
				},
				zoom: {
				  enabled: true,
				  duration: 300,
				  opener: function(element) {
					return element.find('img');
				  }
				}
			  });

			  $('.play_btn, .play_btn_1, .play_btn_2').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				preloader: false,
				removalDelay: 160,
				mainClass: 'mfp-fade',
				fixedContentPos: false
			  });
			
		});
		
		
		function wowAnimation() {
			new WOW({
			  offset: 100,
			  mobile: true
			}).init()
		  }
		  wowAnimation();
		  
		var $grid = $('.grid').imagesLoaded( function() {
			$grid.masonry({
			  itemSelector: '.grid-item',
			  percentPosition: true,
			  columnWidth: '.grid-sizer'
			}); 
		  });
		  
		function portfolioMasonry() {
			var portfolio = $(".element-grid");
			if (portfolio.length) {
			  portfolio.imagesLoaded(function () {
				portfolio.isotope({
				  itemSelector: ".element-item",
				  layoutMode: 'masonry',
				  filter: "*",
				  animationOptions: {
					duration: 1000
				  },
				  transitionDuration: '0.5s',
				  masonry: {

				  }
				});

				$(".filters-button-group button").on('click', function () {
				  $(".filters-button-group button").removeClass("active");
				  $(this).addClass("active");

				  var selector = $(this).attr("data-filter");
				  portfolio.isotope({
					filter: selector,
					animationOptions: {
					  animationDuration: 750,
					  easing: 'linear',
					  queue: false
					}
				  })
				  return false;
				})
			  });
			}
		  }
		  portfolioMasonry();
  
		initStuck();
		
		 // carusel
		if (blocks.ttCarouselProducts.length) {
			blocks.ttCarouselProducts.each( function() {
					var slick = $(this),
						item =  $(this).data('item'),
						itemXL =  $(this).data('item-xl'),
						itemLG =  $(this).data('item-lg'),
						itemMD =  $(this).data('item-md'),
						itemSM =  $(this).data('item-sm'),
						itemXS =  $(this).data('item-xs'),
						vertical =  $(this).data('slider-vertical');
					slick.slick({
						vertical: vertical,
						verticalSwiping: vertical,
						dots: ( $(this).data('dots') === true ) ? true : false,
						arrows: ( $(this).data('arrows') === false ) ? false : true,
						infinite: ( $(this).data('infinite') === false ) ? false : true,
						pauseOnHover: ( $(this).data('pauseOnHover') === true ) ? true : false,
						autoplay: ( $(this).data('autoplay') === true ) ? true : false,
						AutoplaySpeed: ( $(this).data('autoplaySpeed')!='' ) ? $(this).data('autoplaySpeed') : 300,
						speed: ( $(this).data('speed') ) ? $(this).data('speed') : 300,
						centerMode: false,
						slidesToShow: item || 5,
						slidesToScroll: item || 5,
						adaptiveHeight: true,
							responsive: [{
								breakpoint: 1400,
								settings: {
									slidesToShow: itemXL || 4,
									slidesToScroll: itemXL || 4
								}
							},
							{
								breakpoint: 1200,
								settings: {
									slidesToShow: itemLG || 4,
									slidesToScroll: itemLG || 4
								}
							},
							{
								breakpoint: 992,
								settings: {
									slidesToShow: itemMD || 3,
									slidesToScroll: itemMD || 3
								}
							},
							{
								breakpoint: 768,
								settings: {
									slidesToShow: itemSM || 2,
									slidesToScroll: itemSM || 2
								}
							},
							{
								breakpoint: 576,
								settings: {
									slidesToShow: itemXS || 1,
									slidesToScroll: itemXS || 1
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
									dots:true
								}
							}]
					});
					
					//button
					var custSlick = $('.cust-slick-slider');
					if (custSlick) {
						custSlick.find('.cslick-prev').on('click',function(e) {
							$($(this).parents(custSlick).data('target')).find('.slick-slider').slick('slickPrev');
						});
						custSlick.find('.cslick-next').on('click',function(e) {
							$($(this).parents(custSlick).data('target')).find('.slick-slider').slick('slickNext');
						});
					};
			});
		};
		
		ttInputCounter();
		
		if (blocks.ttProductSingleBtnZomm.length) {
				ttProductSingleBtnZomm();
		};
		
		$window.on('load', function () {
				var ttwindowWidth = window.innerWidth || $window.width();
				if ($body.length) {
						$body.addClass('loaded');
				};				
		});
		
		// identify touch device
		function is_touch_device() {
				return !!('ontouchstart' in window) || !!('onmsgesturechange' in window);
		};
		if (is_touch_device()) {
				$body.addClass('touch-device');
				$html.addClass('touch-device');
		};
		if (/Edge/.test(navigator.userAgent)) {
			$html.addClass('edge');
		};
		
		//blog listing slider
		if (blocks.ttMobileProductSlider.length) {
				blocks.ttMobileProductSlider.slick({
					dots: false,
					arrows: true,
					infinite: true,
					speed: 300,
					slidesToShow: 1,
					adaptiveHeight: true,
					 lazyLoad: 'progressive',
				});
				if($html.hasClass('ie')){
					blocks.ttModalQuickView.each(function() {
							blocks.ttMobileProductSlider.slick("slickSetOption", "infinite", false);
					});
				};
		};

		//input-counter
		function ttInputCounter() {
				$body.on('click', '.minus-btn, .plus-btn',function(e) {
						var $input = $(this).parent().find('input'),
						step = parseInt( (typeof $input.attr('step') !== 'undefined') ? $input.attr('step') : 1),
						count = parseInt($input.val(), 10) + parseInt(e.currentTarget.className === 'plus-btn' ? step : -step, 10);
						$input.val(count).change();
				});
				$body.on('change', '.tt-input-counter input', function() {
						var _ = $(this),
						min = parseInt( (typeof _.attr('min') !== 'undefined') ? _.attr('min') : 1),
						val = parseInt(_.val(), 10),
						max = parseInt( (typeof _.attr('max') !== 'undefined') ? _.attr('max') : _.val(), 10),
						val = Math.min(val, max),
						val = Math.max(val, min);
						_.val(val).trigger('keyup');
				})
		};
	
		//product pages
		var elevateZoomWidget = {
			scroll_zoom: true,
			class_name: '.zoom-product',
			thumb_parent: $('#smallGallery'),
			scrollslider_parent: $('.slider-scroll-product'),
			checkNoZoom: function(){
				return $(this.class_name).parent().parent().hasClass('no-zoom');
			},
			init: function(type){
				var _ = this;
				var currentW = window.innerWidth || $(window).width();
				var zoom_image = $(_.class_name);
				var _thumbs = _.thumb_parent;
				_.initBigGalleryButtons();
				_.scrollSlider();

				if(zoom_image.length == 0) return false;
				if(!_.checkNoZoom()){
					var attr_scroll = zoom_image.parent().parent().attr('data-scrollzoom');
					attr_scroll = attr_scroll ? attr_scroll : _.scroll_zoom;
					_.scroll_zoom = attr_scroll == 'false' ? false : true;
					currentW > 575 && _.configureZoomImage();
					_.resize();
				}

				if(_thumbs.length == 0) return false;
				var thumb_type = _thumbs.parent().attr('class').indexOf('-vertical') > -1 ? 'vertical' : 'horizontal';
				_[thumb_type](_thumbs);
				_.setBigImage(_thumbs);
			},
			configureZoomImage: function(){
				var _ = this;
				$('.zoomContainer').remove();
				var zoom_image = $(this.class_name);
				zoom_image.each(function(){
					var _this = $(this);
					var clone = _this.removeData('elevateZoom').clone();
					_this.after(clone).remove();
				});
				setTimeout(function(){
					$(_.class_name).elevateZoom({
						gallery: _.thumb_parent.attr('id'),
						zoomType: "inner",
						scrollZoom: Boolean(_.scroll_zoom),
						cursor: "crosshair",
						zoomWindowFadeIn: 300,
						zoomWindowFadeOut: 300
					});
				}, 100);
			},
			resize: function(){
				var _ = this;
				$(window).resize(function(){
					var currentW = window.innerWidth || $(window).width();
					if(currentW <= 575) return false;
					_.configureZoomImage();
				});
			},
			horizontal: function(_parent){
				_parent.slick({
					infinite: true,
					dots: false,
					arrows: true,
					slidesToShow: 5,
					slidesToScroll: 1,
					responsive: [{
						breakpoint: 1200,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					}]
				});
			},
			vertical: function(_parent){
				_parent.slick({
					vertical: true,
					infinite: true,
					slidesToShow: 5,
					slidesToScroll: 1,
					verticalSwiping: true,
					arrows: true,
					dots: false,
					centerPadding: "0px",
					customPaging: "0px",
					responsive: [{
						breakpoint: 1200,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1
						}
					}]
				});
			},
			 initBigGalleryButtons: function(){
							var bigGallery = $('.bigGallery');
							if(bigGallery.length == 0) return false;
							$( 'body' ).on( 'mouseenter', '.zoomContainer',
											function(){        bigGallery.find('button').addClass('show');        }
							).on( 'mouseleave', '.zoomContainer',
											function(){ bigGallery.find('button').removeClass('show'); }
							);
			},
			scrollSlider: function(){
				var _scrollslider_parent = this.scrollslider_parent;
				if(_scrollslider_parent.length == 0) return false;
				_scrollslider_parent.on('init', function(event, slick) {
					_scrollslider_parent.css({ 'opacity': 1 });
				});
				_scrollslider_parent.css({ 'opacity': 0 }).slick({
					infinite: false,
					vertical: true,
					verticalScrolling: true,
					dots: true,
					arrows: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					responsive: [{
						breakpoint: 1200,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}]
				}).mousewheel(function(e) {
					e.preventDefault();
					e.deltaY < 0 ? $(this).slick('slickNext') : $(this).slick('slickPrev');
				});
			},
			setBigImage: function(_parent){
				var _ = this;
				_parent.find('a').on('click',function(e) {
					_.checkNoZoom() && e.preventDefault();
					var zoom_image = $(_.class_name);
					var getParam = _.checkNoZoom() ? 'data-image' : 'data-zoom-image';
					var setParam = _.checkNoZoom() ? 'src' : 'data-zoom-image';
					var big_image = $(this).attr(getParam);
					zoom_image.attr(setParam, big_image);

					if(!_.checkNoZoom()) return false;
					_parent.find('.zoomGalleryActive').removeClass('zoomGalleryActive');
					$(this).addClass('zoomGalleryActive');
				});
			}
		};
		elevateZoomWidget.init();

		// product single tt-btn-zomm(*magnific popup)
		function ttProductSingleBtnZomm() {
			$body.on('click', '.tt-product-single-img .tt-btn-zomm', function (e) {
					var objSmallGallery = $('#smallGallery');
					objSmallGallery.find('a').each(function(){
							var dataZoomImg = $(this).attr('data-zoom-image');
							if(dataZoomImg.length){
								$(this).closest('li').append("<a class='link-magnific-popup' href='#'></a>").find('.link-magnific-popup').attr('href', dataZoomImg);
								if($(this).hasClass('zoomGalleryActive')){
									$(this).closest('li').find('.link-magnific-popup').addClass('zoomGalleryActive');
								};
							};
					});
					objSmallGallery.addClass('tt-magnific-popup').find('.link-magnific-popup').magnificPopup({
						type: 'image',
							gallery: {
									enabled: true,
									tCounter: '<span class="mfp-counter"></span>'
							},
							callbacks: {
								close: function() {
									setTimeout(function() {
											objSmallGallery.removeClass('tt-magnific-popup').find('.link-magnific-popup').remove();
									}, 200);

								}
							}
					});
					objSmallGallery.find('.link-magnific-popup.zoomGalleryActive').trigger('click');
			});
		};

		/**
		 * Stuck init. Properties: on/off
		 * @value = 'off', default empty
		 */
		function initStuck() {
			if($stucknav.hasClass('disabled')) return;
			$window.scroll(function() {
				var HeaderTop = $('header').innerHeight();
				if ($window.scrollTop() > HeaderTop) {
					$stucknav.addClass('stuck');
				} else {
					$stucknav.removeClass('stuck');
				}
			});
		}
		
		$document.ready(function(){
			newsletterModal('.js-newslettermodal', '#newsLetterCheckBox');
		});
		
		function newsletterModal(modal, checkbox) {
			
			var $newsletter = $(modal),
				$checkBox = $(checkbox);

			function checkCookie() {
				if ($.cookie('neoncartNewsLetter') != 'yes' || $('body').hasClass('demo')) {
					openNewsletterPopup();
				}
			}

			function openNewsletterPopup() {
				var pause = $newsletter.attr('data-pause') > 0 ? $newsletter.attr('data-pause') : 2000;
				setTimeout(function () {
					$('#ModalNewsletter').modal('show');
				}, pause);
			}

			$checkBox.change(function () {
				if ($(this).is(':checked')) {
					$.cookie('neoncartNewsLetter', 'yes', {
						expires: parseInt($newsletter.attr('data-expires'), 10)
					});
				} else {
					$.cookie('neoncartNewsLetter', null, {
						path: '/'
					});
				}
			});
			if ($('body[class*="home-page"]').length || $('body[class*="page-index"]').length) {
				checkCookie();
			}
		}
		
})(jQuery);

/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		module.exports = factory(require('jquery'));
	} else {
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		if (arguments.length > 1 && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		var result = key ? undefined : {},
			cookies = document.cookie ? document.cookie.split('; ') : [],
			i = 0,
			l = cookies.length;

		for (; i < l; i++) {
			var parts = cookies[i].split('='),
				name = decode(parts.shift()),
				cookie = parts.join('=');

			if (key === name) {
				result = read(cookie, value);
				break;
			}

			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));