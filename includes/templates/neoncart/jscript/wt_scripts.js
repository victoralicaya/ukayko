"use strict";
(function ($) {
	var WTWOK = WTWOK || {};
	
	$( window ).on('shown.bs.modal', function() { 
		WTWOK.initialization.wtDesignTemp();
	});	
	$( document ).ajaxComplete(function() {
		WTWOK.initialization.wtDesignTemp();
	});
	
	$('body').on('click', '[data-toggle="modal"].quickview-action', function(e) {
		e.preventDefault();
		var $this = $(this),
		datatarget = $this.attr("data-target"),
		dataurl = $this.attr("href");
		$this.addClass('wt-loading');
		if($('#ModalquickView').length > 0 ){
			$('.modal-backdrop').remove();
			$('#ModalquickView').remove();
		}
		datatarget.replace('#','');
		if($('#ModalquickView').length > 0 ){
			$("#ModalquickView .tt-modal-quickview").html('<div class="popup-loader" style="width:100%;min-height:400px;float:left;text-align:cener;" ><div id="loader-wrapper"><div id="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div></div>');
		}
		$.get(dataurl, function(data) {
			if($('#ModalquickView').length > 0 ){
				$("#ModalquickView .tt-modal-quickview").html(data);
				$('#ModalquickView').modal('open');
			} else {
				// inputCounter
				$('<div class="quickview_modal modal fade" id="ModalquickView" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content "><div class="modal-header"><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button></div><div class="modal-body"><div class="tt-modal-quickview desctope">' + data + '</div></div></div></div></div>').modal('show');
			}
			$this.removeClass('wt-loading');
		});
	});
	
	function calcScrollWidth() {
		var _ = $('<div style="width:100px;height:100px;overflow:scroll;visibility: hidden;"><div style="height:200px;"></div>');
		$('body').append(_);
		var w = (_[0].offsetWidth - _[0].clientWidth);
		$(_).remove();
		return (w);
	}

	function debouncer(func, wait, immediate) {
		var timeout;
		return function () {
			var context = this,
				args = arguments;
			var later = function () {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

	function extendDefaults(source, properties) {
		var property;
		for (property in properties) {
			if (properties.hasOwnProperty(property)) {
				source[property] = properties[property];
			}
		}
		return source;
	}
	
	function WTWOKModalPopup(e, data, modalClass = '' ) {
		if ( $('#wtWokModal').length > 0 ) {
				$("#wtWokModal .wok-modal-content").html(data);
				$("#wtWokModal[class*='wtWok']").removeClass (function (index, css) {
				   return (css.match (/(^|\s)ativo\S+/g) || []).join(' ');
				});
				$('#wtWokModal').modal('show');
				$('#wtWokModal').addClass(modalClass);
		} else {
			$('<div class="modal fade '+modalClass+'" id="wtWokModal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button></div><div class="modal-body"><div class="wok-modal-content desctope">' + data + '</div></div></div></div></div>').modal('show');
		}
	}
	WTWOK.initialization = {
		init: function () {
			this.wtGenralScript();
			this.wtDesignTemp();
		},
		wtGenralScript(){
			$('.cat-toggle').each(function(index, value) {
				$(this).find('li.has-sub > a + .arrow').on('click', function(){
					var element = $(this).parent('li');
					if (element.hasClass('open')) {
						element.removeClass('open');
						element.find('li').removeClass('open');
						element.find('ul').slideUp();
					}
					else {
						element.addClass('open');
						element.children('ul').slideDown();
						element.siblings('li').children('ul').slideUp();
						element.siblings('li').removeClass('open');
						element.siblings('li').find('li').removeClass('open');
						element.siblings('li').find('ul').slideUp();
					}
				});
			});
		},
		wtDesignTemp(){
			$('input[type="text"], input[type="password"], input[type="email"], input[type="tel"], textarea, input#state, select').not('.form-control').addClass('form-control');
		}
	};
	
	WTWOK.wtCompare = {
		init: function () {
			var $this = this;
			$body.on('click', '.compare-action', function(e) {
				e.preventDefault();
				var _ = $(this),
				opts = {},
				d= new FormData(),
				action = _.attr('data-action');
				d.append('compare_id', _.data('compare_id'));
				d.append('wt_action', action);
				opts.data = d;
				$this.setAjaxData(_, opts, action);				
			});
		},
		reinit: function () {
			this.init();
			return this;
		},
		setAjaxData: function ( e, options, action  ) {
			$(e).addClass('wt-loading');
			var ajaxDefault = {
				type: 'POST',
				url: 'ajax.php?act=ajaxWTAjaxCompare&method=ajaxCompare',
				dataType : 'json',
				contentType: false,
				cache: false,
				processData:false,
				data:'',
				success :function(data){
					WTWOK.wtCompare.compareResponse(e, data, action);
				},
				error: function(xhr, textStatus, errorThrown) {
					var err = eval("(" + xhr.responseText + ")");
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			}
			$.extend(ajaxDefault, options);
			try {
				$.ajax(ajaxDefault);
			} catch (e) {
			}
		},
		compareResponse: function ( e, data, action ) {
			if ( data.status == 'true' ) {
				$(e).toggleClass('active');
				var new_action = ( action == 'add' ) ? 'remove' : 'add';
				$(e).attr('data-tooltip', $(e).data(new_action) ).trigger('mouseout').trigger('mouseenter');
				$(e).attr('data-action', new_action);
				WTWOKModalPopup( e, data.message, 'wtWokSuccess wtWokCompare' );
				
			} else {
				WTWOKModalPopup( e, data.message, 'wtWokError wtWokCompare' );
			}
			if ( typeof data.compare_count != 'undefined' ) {
				$('.compareCount').removeClass('hide').html(data.compare_count);
			}
			$(e).removeClass('wt-loading');
		}
	};
	WTWOK.documentReady = {
		init: function () {
			WTWOK.wtCompare.init();
			WTWOK.initialization.init();
		}
	};
	WTWOK.documentLoad = {
		init: function () {
			w = window.innerWidth || $window.width();
		}
	};
	var $body = $('body'),
		$window = $(window),
		$document = $(document),
		w = window.innerWidth || $window.width();
		$document.ready(WTWOK.documentReady.init);
		$window.on('load', WTWOK.documentLoad.init);
})(jQuery);