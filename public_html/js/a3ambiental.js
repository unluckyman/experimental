// fonte: https://developer.mozilla.org/en-US/docs/Web/Events/scroll#Example
;(function() {
  var throttle = function(type, name, obj) {
    var obj = obj || window;
    var running = false;
    var func = function() {
      if (running) { return; }
      running = true;
      requestAnimationFrame(function() {
        obj.dispatchEvent(new CustomEvent(name));
        running = false;
      });
    };
    obj.addEventListener(type, func);
  };

  /* init - you can init any event */
  throttle ("scroll", "optimizedScroll");
})();

// handle event
window.addEventListener("optimizedScroll", function() {
  var $nav = $('#navigation');

  if ($(this).scrollTop() > 42 && !$nav.hasClass('navbar-fixed-top')){
    $nav.find('.header-top').addClass('hidden');
    $nav.addClass('navbar-fixed-top');
  }

  if ($(this).scrollTop() <= 42 && $nav.hasClass('navbar-fixed-top')) {
    $nav.removeClass('navbar-fixed-top');
    $nav.find('.header-top').removeClass('hidden').addClass('show');
  }

});

// quando o DOM está pronto
jQuery(function(){
  $('#main').find('.bg-parallax').height(screen.height);

  // variáveis globais
  var $root = $('html, body');

  // scroll down da página
  $('#header').on('click', 'a' , function(e) {
    e.preventDefault;

    var href = $.attr(this, 'href'),
        nav = $('#navigation'),
        scrollValue = $(href).offset().top,
        fix = nav.outerHeight() - nav.find('.header-top').outerHeight();

    nav.find('li').removeClass();
    $(this).parent().addClass('active');

    if(href === '#inicio') {
      scrollValue = 0;
    } else {
      scrollValue -= fix;
    }

    $root.animate({
      scrollTop: scrollValue
    }, 500, function () {
      window.location.hash = href;
    });

    return false;
  });

  $('#slider').royalSlider({
    arrowsNav: true,
    loop: true,
    keyboardNavEnabled: true,
    controlsInside: false,
    imageScaleMode: 'fill',
    arrowsNavAutoHide: false,
    autoScaleSlider: true,
    autoScaleSliderWidth: 960,
    autoScaleSliderHeight: 350,
    controlNavigation: 'bullets',
    thumbsFitInViewport: false,
    navigateByClick: true,
    startSlideId: 0,
    autoPlay: {
      enabled: true,
      pauseOnHover: false,
      delay: 3000
    },
    transitionType:'move',
    globalCaption: false,
    deeplinking: {
      enabled: true,
      change: false
    },
    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
    imgWidth: 1400,
    imgHeight: 680
  });

});