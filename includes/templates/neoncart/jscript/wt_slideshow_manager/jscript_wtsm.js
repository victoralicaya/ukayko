/**
 * WT Slideshow for Zen Cart.
 *
 * @copyright Copyright 2021 WT Tech. Pvt. Ltd.
 * Version : WT Slideshow 1.0
 */

!function(i,o){var e,a=i.jQuery||i.Cowboy||(i.Cowboy={});a.throttle=e=function(i,e,t,n){function c(){function a(){r=+new Date,t.apply(c,p)}var c=this,s=+new Date-r,p=arguments;n&&!m&&a(),m&&clearTimeout(m),n===o&&s>i?a():!0!==e&&(m=setTimeout(n?function(){m=o}:a,n===o?i-s:i))}var m,r=0;return"boolean"!=typeof e&&(n=t,t=e,e=o),a.guid&&(c.guid=t.guid=t.guid||a.guid++),c},a.debounce=function(i,a,t){return t===o?e(i,a,!1):e(i,t,!1!==a)}}(this),window.mobileCheck=function(){var i,o=!1;return i=navigator.userAgent||navigator.vendor||window.opera,(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(i)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(i.substr(0,4)))&&(o=!0),o};

/* Jonathan Snook - MIT License - https://github.com/snookca/prepareTransition */
$.fn.prepareTransition=function(){return this.each(function(){var n=$(this);n.one("TransitionEnd webkitTransitionEnd transitionend oTransitionEnd",function(){n.removeClass("is-transitioning")});var i=0;$.each(["transition-duration","-moz-transition-duration","-webkit-transition-duration","-o-transition-duration"],function(t,o){i||(i=parseFloat(n.css(o)))}),0!=i&&(n.addClass("is-transitioning"),n[0].offsetWidth)})};

window.WTSlideshow = {};

function onYouTubeIframeAPIReady() {
	WTSlideshow.wtsliderVideo.loadVideos();
}

function keepScale(slider) {
	var $WTSlider = slider;
	var wW = $(window).width();
	var mobileBreikpoint = 480;
	if ($WTSlider.hasClass("keep-scale") && !$WTSlider.hasClass("wtslider--fullheight")) {
		$WTSlider.css({
			'height': '',
			'min-height': '',
			'width': '',
			'min-width': ''
		});
		var bnrH, bnrW;
		if ( parseInt($WTSlider.attr('data-width')) > 0 ) {
			var bnrW = parseInt($WTSlider.attr('data-width'), 10);
			$WTSlider.css({
				'width': bnrW + 'px',
				'min-width': bnrW + 'px'
			});
		}
		if ( parseInt($WTSlider.attr('data-height')) > 0 ) {
			var bnrH = parseInt($WTSlider.attr('data-height'), 10);
			$WTSlider.css({
				'height': bnrH + 'px',
				'min-height': bnrH + 'px'
			});
		}
	}
}

WTSlideshow.wtslider = (function () {
	this.$wtslider = null;
	var classes = {
		wrapper: 'wtslider-wrapper',
		wtslider: 'wtslider',
		currentSlide: 'slick-current',
		video: 'wtslider-video',
		videoBackground: 'wtslider-video--background',
		closeVideoBtn: 'wtslider-video-control--close',
		pauseButton: 'wtslider-pause',
		isPaused: 'is-paused',
		animatedText: "[class^='wtslider-text'],[class*=' wtslider-text'],.btn-wrap,.btn-decor,.btn-line"
	};
	function wtslider(el) {
		this.$wtslider = $(el);
		this.wtslider = el;
		this.$wrapper = this.$wtslider.closest('.' + classes.wrapper);
		this.$pause = this.$wrapper.find('.' + classes.pauseButton);
		var $textBlock = $(classes.animatedText, $wtslider);
		$textBlock.each(function () {
			var $this = $(this),
				thisInlineStyle = '';
			var thisStyle = $this.data();
			for (data in thisStyle) {
				if (data == 'fontcolor') {
					thisInlineStyle += 'color:' + $this.data('fontcolor') + ';'
				}
				if (data == 'fontfamily') {
					thisInlineStyle += 'font-family:' + $this.data('fontfamily') + ';'
				}
				if (data == 'fontsize') {
					thisInlineStyle += 'font-size:' + $this.data('fontsize') + 'px;'
				}
				if (data == 'fontline') {
					thisInlineStyle += 'line-height:' + $this.data('fontline') + 'em;'
				}
				if (data == 'fontweight') {
					thisInlineStyle += 'font-weight:' + $this.data('fontweight') + ';'
				}
				if (data == 'bgcolor') {
					thisInlineStyle += 'background-color:' + $this.data('bgcolor') + ';'
				}
				if (data == 'ypos') {
					var ypos = $this.data('ypos');
					if (ypos == 'center') {
						$this.addClass('vertical-align')
					} else thisInlineStyle += 'top:' + $this.data('ypos') + '%;'
				}
				if (data == 'xpos') {
					var xpos = $this.data('xpos');
					if (xpos == 'center') {
						$this.addClass('horisontal-align')
					} else if (xpos == 'left') {
						thisInlineStyle += 'left:0;right:auto;'
					} else if (xpos == 'right') {
						thisInlineStyle += 'left:auto;right:0;'
					} else thisInlineStyle += 'left:' + $this.data('xpos') + '%;'
				}
				if (data == 'otherstyle') {
					thisInlineStyle += $this.data("otherstyle") + ';';

				}
			}
			if (thisInlineStyle.length > 0) {
				$this.attr('style', thisInlineStyle).addClass('data-ini');
			}
		})

		this.$wtslider.on('beforeChange', beforeChange.bind(this));
		this.$wtslider.on('init', wtsliderA11y.bind(this));
		this.settings = {
			accessibility: true,
			draggable: true,
			touchThreshold: 20,
			dots: this.$wtslider.data('dots'),
			autoplay: this.$wtslider.data('autoplay'),
			autoplaySpeed: this.$wtslider.data('autoplay-speed'),
			speed: this.$wtslider.data('speed'),
			pauseOnHover: this.$wtslider.data('onhoverpause'),
			fade: this.$wtslider.data('fade'),
			infinite: this.$wtslider.data('infinite'),
			adaptiveHeight: this.$wtslider.data('height') == 0 ? true : false,
			prevArrow: ".main_left_arrow",
			nextArrow: ".main_right_arrow",
			customPaging: function (slider, i) {
			  console.log(slider);
			  var slideNumber   = (i + 1),
			  totalSlides = slider.slideCount;
			  return '<a class="custom-dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '</span></a>';
			}
		};
		this.$wtslider.slick(this.settings);
		this.$pause.on('click', this.togglePause.bind(this));
	}

	function wtsliderA11y(event, obj, currentSlide, nextSlide) {
		var $slider = obj.$slider;
		var $header = $('.page-header');
		var $list = obj.$list;
		var $wrapper = this.$wrapper;
		var autoplay = this.settings.autoplay;
		var $currentSlide = $slider.find('.' + classes.currentSlide);
		var $animatingElements = $currentSlide.find('[data-animation]');

		if (isVideoInSlide($currentSlide)) {
			var $video = $currentSlide.find('.' + classes.video);
			var videoId = $video.attr('id');
			var isBackground = $video.hasClass(classes.videoBackground);
			if (isBackground) {
				WTSlideshow.wtsliderVideo.playVideo(videoId);
			} else {
				$video.attr('tabindex', '0');
			}
		}
		keepScale($slider);
		doAnimations($animatingElements);
		$slider.closest('.block').addClass('block--loaded');
		if ($header.hasClass('.hdr-transparent')) {
			$header.addClass('visible')
		}
		$slider.find("[data-bg-color]").each(function () {
			$(this).css("background", $(this).attr("data-bg-color"))
		});
		
		$wrapper.on('focusin', function (evt) {
			if (!$wrapper.has(evt.target).length) {
				return;
			}
			$list.attr('aria-live', 'polite');
			if (autoplay) {
				$slider.slick('slickPause');
			}
		});
		$wrapper.on('focusout', function (evt) {
			if (!$wrapper.has(evt.target).length) {
				return;
			}
			$list.removeAttr('aria-live');
			if (autoplay) {
				if ($(evt.target).hasClass(classes.closeVideoBtn)) {
					return;
				}
				$slider.slick('slickPlay');
			}
		});
	}

	// Slider Animation
	function doAnimations(elements) {
		var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		elements.each(function () {
			var $this = $(this);
			var $animationDelay = $this.data('delay');
			var $animationType = 'animated ' + $this.data('animation');
			$this.css({
				'animation-delay': $animationDelay,
				'-webkit-animation-delay': $animationDelay
			});
			$this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			});
			if ($this.hasClass('animate')) {
				$this.removeClass('animation');
			}
		});
	}

	function beforeChange(event, slick, currentSlide, nextSlide) {
		var $slider = slick.$slider;
		var $currentSlide = $slider.find('.' + classes.currentSlide);
		var $nextSlide = $slider.find('.wtslider-slide[data-slick-index="' + nextSlide + '"]');
		if (isVideoInSlide($currentSlide)) {
			var $currentVideo = $currentSlide.find('.' + classes.video);
			var currentVideoId = $currentVideo.attr('id');
			WTSlideshow.wtsliderVideo.pauseVideo(currentVideoId);
			$currentVideo.attr('tabindex', '-1');
		}
		if (isVideoInSlide($nextSlide)) {
			var $video = $nextSlide.find('.' + classes.video);
			var videoId = $video.attr('id');
			var isBackground = $video.hasClass(classes.videoBackground);
			if (isBackground) {
				WTSlideshow.wtsliderVideo.playVideo(videoId);
			} else {
				$video.attr('tabindex', '0');
			}
		}
		doAnimations($nextSlide.find('[data-animation]'));
	}

	function isVideoInSlide($slide) {
		return $slide.find('.' + classes.video).length;
	}

	wtslider.prototype.togglePause = function () {
		var wtsliderSelector = getwtsliderId(this.$pause);
		if (this.$pause.hasClass(classes.isPaused)) {
			this.$pause.removeClass(classes.isPaused);
			$(wtsliderSelector).slick('slickPlay');
		} else {
			this.$pause.addClass(classes.isPaused);
			$(wtsliderSelector).slick('slickPause');
		}
	};

	function getwtsliderId($el) {
		return '#wtslider-' + $el.data('id');
	}

	return wtslider;
})();

WTSlideshow.wtsliderVideo = (function () {
	var autoplayCheckComplete = false;
	var autoplayAvailable = false;
	var playOnClickChecked = false;
	var playOnClick = false;
	var youtubeLoaded = false;
	var videos = {};
	var videoPlayers = [];
	var videoOptions = {
		ratio: 16 / 9,
		playerVars: {
			// eslint-disable-next-line camelcase
			iv_load_policy: 3,
			modestbranding: 1,
			autoplay: 0,
			controls: 0,
			showinfo: 0,
			wmode: 'opaque',
			branding: 0,
			autohide: 0,
			rel: 0
		},
		events: {
			onReady: onPlayerReady,
			onStateChange: onPlayerChange
		}
	};
	var classes = {
		playing: 'video-is-playing',
		paused: 'video-is-paused',
		loading: 'video-is-loading',
		loaded: 'video-is-loaded',
		wtsliderWrapper: 'wtslider-wrapper',
		slide: 'wtslider-slide',
		slideBackgroundVideo: 'wtslider-slide--background-video',
		slideDots: 'slick-dots',
		videoBox: 'wtslider-video--box',
		videoBackground: 'wtslider-video--background',
		playVideoBtn: 'wtslider-video-control--play',
		closeVideoBtn: 'wtslider-video-control--close',
		currentSlide: 'slick-current',
		slickClone: 'slick-cloned',
		supportsAutoplay: 'autoplay',
		supportsNoAutoplay: 'no-autoplay'
	};

	function init($video) {
		if (!$video.length) {
			return;
		}
		videos[$video.attr('id')] = {
			id: $video.attr('id'),
			videoId: $video.data('id'),
			type: $video.data('type'),
			status: $video.data('type') === 'box' ? 'closed' : 'background', // closed, open, background
			videoSelector: $video.attr('id'),
			$parentSlide: $video.closest('.' + classes.slide),
			$parentwtsliderWrapper: $video.closest('.' + classes.wtsliderWrapper),
			controls: $video.data('type') === 'background' ? 0 : 1,
			wtslider: $video.data('wtslider')
		};
		if (!youtubeLoaded) {
			// This code loads the IFrame Player API code asynchronously.
			var tag = document.createElement('script');
			tag.src = 'https://www.youtube.com/iframe_api';
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		}
	}

	function customPlayVideo(playerId) {
		// Do not autoplay just because the wtslider asked you to.
		// If the wtslider asks to play a video, make sure
		// we have done the playOnClick check first
		if (!playOnClickChecked && !playOnClick) {
			return;
		}
		if (playerId && typeof videoPlayers[playerId].playVideo === 'function') {
			privatePlayVideo(playerId);
		}
	}

	function pauseVideo(playerId) {
		if (videoPlayers[playerId] && typeof videoPlayers[playerId].pauseVideo === 'function') {
			videoPlayers[playerId].pauseVideo();
		}
	}

	function loadVideos() {
		for (var key in videos) {
			if (videos.hasOwnProperty(key)) {
				var args = $.extend({}, videoOptions, videos[key]);
				args.playerVars.controls = args.controls;
				videoPlayers[key] = new YT.Player(key, args);
			}
		}
		initEvents();
		youtubeLoaded = true;
	}

	function loadVideo(key) {
		if (!youtubeLoaded) {
			return;
		}
		var args = $.extend({}, videoOptions, videos[key]);
		args.playerVars.controls = args.controls;
		videoPlayers[key] = new YT.Player(key, args);
		initEvents();
	}

	function privatePlayVideo(id, clicked) {
		var videoData = videos[id];
		var player = videoPlayers[id];
		var $slide = videos[id].$parentSlide;
		if (!autoplayCheckComplete) {
			autoplayCheckFunction(player, $slide);
		}
		if (playOnClick) {
			setAsPlaying(videoData);
		} else if (clicked || (autoplayCheckComplete && autoplayAvailable)) {
			$slide.removeClass(classes.loading);
			setAsPlaying(videoData);
			player.playVideo();
			return;
		}
	}

	function setAutoplaySupport(supported) {
		var supportClass = supported ? classes.supportsAutoplay : classes.supportsNoAutoplay;
		$(document.documentElement).addClass(supportClass);
		if (!supported) {
			playOnClick = true;
		}
		autoplayCheckComplete = true;
	}

	function autoplayCheckFunction(player, $slide) {
		var supports_video_autoplay = function (callback) {
			if (typeof callback !== "function") return false;
			var v = document.createElement("video");
			v.paused = true;
			var p = "play" in v && v.play();
			callback(!v.paused || ("Promise" in window && p instanceof Promise));
		};
		supports_video_autoplay(function (supported) {
			autoplayCheckComplete = true;
			$slide.removeClass(classes.loading);
			if (supported) {
				setAutoplaySupport(true);
				autoplayAvailable = true;
			} else {
				setAutoplaySupport(false);
				player.stopVideo();
			}
		});
	}

	function autoplayTest(player) {
		var deferred = $.Deferred();
		var wait;
		var timeout;
		wait = setInterval(function () {
			if (player.getCurrentTime() <= 0) {
				return;
			}
			autoplayAvailable = true;
			clearInterval(wait);
			clearTimeout(timeout);
			deferred.resolve();
		}, 500);
		timeout = setTimeout(function () {
			clearInterval(wait);
			deferred.reject();
		}, 4000);
		return deferred;
	}

	function playOnClickCheck() {
		if (playOnClickChecked) {
			return;
		}
		if ($(window).width() < 750) {
			playOnClick = true;
		} else if (window.mobileCheck()) {
			playOnClick = true;
		}
		if (playOnClick) {
			setAutoplaySupport(false);
		}
		playOnClickChecked = true;
	}

	function onPlayerReady(evt) {
		evt.target.setPlaybackQuality('hd1080');
		var videoData = getVideoOptions(evt);
		playOnClickCheck();
		$('#' + videoData.id).attr('tabindex', '-1');
		sizeBackgroundVideos();
		switch (videoData.type) {
			case 'background-box':
			case 'background':
				evt.target.mute();
				// Only play the video if it is in the active slide
				if (videoData.$parentSlide.hasClass(classes.currentSlide)) {
					privatePlayVideo(videoData.id);
				}
				break;
		}
		videoData.$parentSlide.addClass(classes.loaded);
	}

	function onPlayerChange(evt) {
		var videoData = getVideoOptions(evt);
		switch (evt.data) {
			case 0: // ended
				setAsFinished(videoData);
				break;
			case 1: // playing
				setAsPlaying(videoData);
				break;
			case 2: // paused
				setAsPaused(videoData);
				break;
		}
	}

	function setAsFinished(videoData) {
		switch (videoData.type) {
			case 'background':
				videoPlayers[videoData.id].seekTo(0);
				break;
			case 'background-box':
				videoPlayers[videoData.id].seekTo(0);
				closeVideo(videoData.id);
				break;
			case 'box':
				closeVideo(videoData.id);
				break;
		}
	}

	function setAsPlaying(videoData) {
		var $wtslider = videoData.$parentwtsliderWrapper;
		var $slide = videoData.$parentSlide;
		$slide.removeClass(classes.loading);
		if (videoData.status === 'background') {
			return;
		}
		$('#' + videoData.id).attr('tabindex', '0');
		switch (videoData.type) {
			case 'box':
			case 'background-box':
				$wtslider
					.removeClass(classes.paused)
					.addClass(classes.playing);
				$slide
					.removeClass(classes.paused)
					.addClass(classes.playing);
				break;
		}
		$slide.find('.' + classes.closeVideoBtn).focus();
	}

	function setAsPaused(videoData) {
		var $wtslider = videoData.$parentwtsliderWrapper;
		var $slide = videoData.$parentSlide;
		if (videoData.type === 'background-box') {
			closeVideo(videoData.id);
			return;
		}
		if (videoData.status !== 'closed' && videoData.type !== 'background') {
			$wtslider.addClass(classes.paused);
			$slide.addClass(classes.paused);
		}
		if (videoData.type === 'box' && videoData.status === 'closed') {
			$wtslider.removeClass(classes.paused);
			$slide.removeClass(classes.paused);
		}
		$wtslider.removeClass(classes.playing);
		$slide.removeClass(classes.playing);
	}

	function closeVideo(playerId) {
		var videoData = videos[playerId];
		var $wtslider = videoData.$parentwtsliderWrapper;
		var $slide = videoData.$parentSlide;
		var classesToRemove = [classes.pause, classes.playing].join(' ');
		$('#' + videoData.id).attr('tabindex', '-1');
		videoData.status = 'closed';
		switch (videoData.type) {
			case 'background-box':
				videoPlayers[playerId].mute();
				setBackgroundVideo(playerId);
				break;
			case 'box':
				videoPlayers[playerId].stopVideo();
				setAsPaused(videoData); // in case the video is already paused
				break;
		}
		$wtslider.removeClass(classesToRemove);
		$slide.removeClass(classesToRemove);
	}

	function getVideoOptions(evt) {
		return videos[evt.target.h.id];
	}

	function startVideoOnClick(playerId) {
		var videoData = videos[playerId];
		// add loading class to slide
		videoData.$parentSlide.addClass(classes.loading);
		videoData.status = 'open';
		switch (videoData.type) {
			case 'background-box':
				unsetBackgroundVideo(playerId, videoData);
				videoPlayers[playerId].unMute();
				privatePlayVideo(playerId, true);
				break;
			case 'box':
				privatePlayVideo(playerId, true);
				break;
		}
		$(document).on('keydown.videoPlayer', function (evt) {
			if (evt.keyCode === 27) {
				closeVideo(playerId);
			}
		});
	}

	function sizeBackgroundVideos() {
		$('.' + classes.videoBackground).each(function (index, el) {
			sizeBackgroundVideo($(el));
		});
	}

	function sizeBackgroundVideo($player) {
		var $slide = $player.closest('.' + classes.slide);
		// Ignore cloned slides
		if ($slide.hasClass(classes.slickClone)) {
			return;
		}
		var slideWidth = $slide.width();
		var playerWidth = $player.width();
		var playerHeight = $player.height();
		if (slideWidth / videoOptions.ratio < playerHeight) {
			playerWidth = Math.ceil(playerHeight * videoOptions.ratio);
			if ($('body').hasClass('rtl')) {
				$player.width(playerWidth).height(playerHeight).css({
					right: (slideWidth - playerWidth) / 2,
					top: 0
				});
			} else {
				$player.width(playerWidth).height(playerHeight).css({
					left: (slideWidth - playerWidth) / 2,
					top: 0
				});
			}

		} else {
			playerHeight = Math.ceil(slideWidth / videoOptions.ratio);
			$player.width(slideWidth).height(playerHeight).css({
				left: 0,
				right: '',
				top: (playerHeight - playerHeight) / 2
			});
		}
		$player
			.prepareTransition()
			.addClass(classes.loaded);
	}

	function unsetBackgroundVideo(playerId) {
		$('#' + playerId)
			.removeAttr('style')
			.removeClass(classes.videoBackground)
			.addClass(classes.videoBox);

		videos[playerId].$parentwtsliderWrapper
			.removeClass(classes.slideBackgroundVideo)
			.addClass(classes.playing);

		videos[playerId].$parentSlide
			.removeClass(classes.slideBackgroundVideo)
			.addClass(classes.playing);

		videos[playerId].status = 'open';
	}

	function setBackgroundVideo(playerId) {
		var $player = $('#' + playerId)
			.addClass(classes.videoBackground)
			.removeClass(classes.videoBox);

		videos[playerId].$parentSlide
			.addClass(classes.slideBackgroundVideo);

		videos[playerId].status = 'background';
		sizeBackgroundVideo($player);
	}

	function initEvents() {
		$(document).on('click.videoPlayer', '.' + classes.playVideoBtn, function (evt) {
			var playerId = $(evt.currentTarget).data('controls');
			startVideoOnClick(playerId);
		});

		$(document).on('click.videoPlayer', '.' + classes.closeVideoBtn, function (evt) {
			var playerId = $(evt.currentTarget).data('controls');
			closeVideo(playerId);
		});

		$(window).on('resize.videoPlayer', $.debounce(250, function () {
			if (youtubeLoaded) {
				sizeBackgroundVideos();
			}
		}));
	}

	function removeEvents() {
		$(document).off('.videoPlayer');
		$(window).off('.videoPlayer');
	}

	return {
		init: init,
		loadVideos: loadVideos,
		loadVideo: loadVideo,
		playVideo: customPlayVideo,
		pauseVideo: pauseVideo,
		removeEvents: removeEvents
	};
})();

$(function () {
	WTSlideshow.wtsliders = {};
	$('.wtslider-video').each(function () {
		var $el = $(this);
		WTSlideshow.wtsliderVideo.init($el);
		WTSlideshow.wtsliderVideo.loadVideo($el.attr('id'));
	});
	$('.wtslider').each(function () {
		var $el = $(this);
		var wtslider = "#" + $el.attr('id');
		WTSlideshow.wtsliders[wtslider] = new WTSlideshow.wtslider(wtslider);
	});
	$( window ).on('resize', $.debounce(250, function () {
		$('.wtslider').each(function () {
			keepScale($(this));
		});
	}));
});