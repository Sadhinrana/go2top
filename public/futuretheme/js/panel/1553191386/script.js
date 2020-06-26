$(window).load(function(){
  //Active menu
   
        var activeLinks = location.pathname;
  		
  		if (activeLinks == '/'){
         	
		  $(".home-link").addClass('active');
        }else{
          $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').closest('li').addClass('active');
        }
});

$(function() {
  var loc = window.location.href; // returns the full URL
  if(/massorder/.test(loc)) {
    $(".home-link").addClass('active');
  }
});


$(document).ready(function () {
    var letCollapseWidth = false,
        paddingValue = 30,
        sumWidth = $('.navbar-right-block').width() + $('.navbar-left-block').width() + $('.navbar-brand').width() + paddingValue;

    $(window).on('resize', function () {
        navbarResizerFunc();
    });

    var navbarResizerFunc = function navbarResizerFunc() {
        if (sumWidth <= $(window).width()) {
            if (letCollapseWidth && letCollapseWidth <= $(window).width()) {
                $('#navbar').addClass('navbar-collapse');
                $('#navbar').removeClass('navbar-collapsed');
                $('nav').removeClass('navbar-collapsed-before');
                letCollapseWidth = false;
            }
        } else {
            $('#navbar').removeClass('navbar-collapse');
            $('#navbar').addClass('navbar-collapsed');
            $('nav').addClass('navbar-collapsed-before');
            letCollapseWidth = $(window).width();
        }
    };

    if ($(window).width() >= 768) {
        navbarResizerFunc();
    }
  
  	//Changed Header class on signup page
  	$(function() {
      var loc = window.location.href; // returns the full URL
      if(/signup/.test(loc)) {
        $('header').addClass('bg-blue');
      }
      if(/services/.test(loc)) {
        $('header').addClass('bg-blue');
      }
      if(/faq/.test(loc)) {
        $('header').addClass('bg-blue');
      }
      if(/api/.test(loc)) {
        $('header').addClass('bg-blue');
      }
      if(/terms/.test(loc)) {
        $('header').addClass('bg-blue');
      }
      if(/resetpassword/.test(loc)) {
        $('header').addClass('bg-blue');
      }
    });
  
  (function ($) {
    "use strict";
    // Auto-scroll
    $('#testimonials').carousel({
      interval: 5000
    });

    // Control buttons
    $('.next').click(function () {
      $('.carousel').carousel('next');
      return false;
    });
    $('.prev').click(function () {
      $('.carousel').carousel('prev');
      return false;
    });

    // On carousel scroll
    $("#testimonials").on("slide.bs.carousel", function (e) {
      var $e = $(e.relatedTarget);
      var idx = $e.index();
      var itemsPerSlide = 3;
      var totalItems = $(".carousel-item").length;
      if (idx >= totalItems - (itemsPerSlide - 1)) {
        var it = itemsPerSlide -
            (totalItems - idx);
        for (var i = 0; i < it; i++) {
          // append slides to end 
          if (e.direction == "left") {
            $(
              ".carousel-item").eq(i).appendTo(".carousel-inner");
          } else {
            $(".carousel-item").eq(0).appendTo(".carousel-inner");
          }
        }
      }
    });
  })
  (jQuery);
  
  
  
  
      
});

$(window).on('load resize', function () {
  var divHeight = $('.wave img').height(); 
  $('.wave').css('margin-top', -divHeight/1.4);
  $('.top-banner').css('padding-bottom', divHeight/1.4);
  $('.compare-panel').css('margin-bottom', divHeight/2.50);
  $('footer').css('margin-top', divHeight/4);
});


// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

$(window).scroll(function(){
  var scroll = $(window).scrollTop();
  if (scroll >= 500) {
    $('header').addClass('position-fixed');
  }else{
    $('header').removeClass('position-fixed');
  }

});


(function ($) {
  $(function () {
    $(document).off('click.bs.tab.data-api', '[data-hover="tab"]');
    $(document).on('mouseenter.bs.tab.data-api', '[data-hover="tab"]', function () {
      $(this).tab('show');
    });
  });
})(jQuery);


(function($){
    $(window).on("load",function(){
        $(document).scrollzipInit();
        $(document).rollerInit();
    });
    $(window).on("load scroll resize", function(){
        $('.numscroller').scrollzip({
            showFunction    :   function() {
                                    numberRoller($(this).attr('data-slno'));
                                },
            wholeVisible    :     false,
        });
    });
    $.fn.scrollzipInit=function(){
        $('body').prepend("<div style='position:fixed;top:0px;left:0px;width:0;height:0;' id='scrollzipPoint'></div>" );
    };
    $.fn.rollerInit=function(){
        var i=0;
        $('.numscroller').each(function() {
            i++;
           $(this).attr('data-slno',i); 
           $(this).addClass("roller-title-number-"+i);
        });        
    };
    $.fn.scrollzip = function(options){
        var settings = $.extend({
            showFunction    : null,
            hideFunction    : null,
            showShift       : 0,
            wholeVisible    : false,
            hideShift       : 0,
        }, options);
        return this.each(function(i,obj){
            $(this).addClass('scrollzip');
            if ( $.isFunction( settings.showFunction ) ){
                if(
                    !$(this).hasClass('isShown')&&
                    ($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.showShift)>($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))&&
                    ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))<($(this).outerHeight()+$(this).offset().top-settings.showShift)
                ){
                    $(this).addClass('isShown');
                    settings.showFunction.call( this );
                }
            }
            if ( $.isFunction( settings.hideFunction ) ){
                if(
                    $(this).hasClass('isShown')&&
                    (($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.hideShift)<($(this).offset().top+((settings.wholeVisible)?$(this).outerHeight():0))||
                    ($('#scrollzipPoint').offset().top+((settings.wholeVisible)?$(this).outerHeight():0))>($(this).outerHeight()+$(this).offset().top-settings.hideShift))
                ){
                    $(this).removeClass('isShown');
                    settings.hideFunction.call( this );
                }
            }
            return this;
        });
    };
    function numberRoller(slno){
            var min=$('.roller-title-number-'+slno).attr('data-min');
            var max=$('.roller-title-number-'+slno).attr('data-max');
            var timediff=$('.roller-title-number-'+slno).attr('data-delay');
            var increment=$('.roller-title-number-'+slno).attr('data-increment');
            var numdiff=max-min;
            var timeout=(timediff*1000)/numdiff;
            //if(numinc<10){
                //increment=Math.floor((timediff*1000)/10);
            //}//alert(increment);
            numberRoll(slno,min,max,increment,timeout);
            
    }
    function numberRoll(slno,min,max,increment,timeout){//alert(slno+"="+min+"="+max+"="+increment+"="+timeout);
        if(min<=max){
            $('.roller-title-number-'+slno).html(min);
            min=parseInt(min)+parseInt(increment);
            setTimeout(function(){numberRoll(eval(slno),eval(min),eval(max),eval(increment),eval(timeout))},timeout);
        }else{
            $('.roller-title-number-'+slno).html(max);
        }
    }
})(jQuery);


//Service-page-table

(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="service-container" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top - 57,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height() - 10;
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).on("load resize",resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };
})(jQuery);

$(document).ready(function(){
   $(".servie-data-panel table").fixMe();
});
