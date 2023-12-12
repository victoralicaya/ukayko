jQuery(function($){
    $.fn.extend({
        scrollToMe: function(){
            if($(this).length){
                var top = $(this).offset().top - 0;
                $('html,body').animate({scrollTop: top}, 300);
            }
        },
        scrollToJustMe: function(){
            if($(this).length){
                var top = jQuery(this).offset().top;
                $('html,body').animate({scrollTop: top}, 300);
            }
        }
    });
    
    $(".bs-docs-sidebar a").not('.toggle').off("click").on("click", function(){
        var url = $(this).attr("href");
        if(url.indexOf("#") > -1) {
            $(url).scrollToMe();
            return false;
        }
    });
});
jQuery(document).ready(function() {
        $('section').magnificPopup({
          delegate: '.img-lnk',
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
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
              return element.find('img');
            }
          }
          
        });
      });