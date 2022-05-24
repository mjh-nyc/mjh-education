import ScrollMagic from 'scrollmagic/scrollmagic/minified/ScrollMagic.min';
export default {
  init() {
    

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
    // JavaScript to be fired on the home page


    // Hero slider element
    //****************************
    var $heroSlides = jQuery('.hero-carousel-container');
    //first swap out data-lazy value if it's a mobile device
    if (jQuery( window ).width() < 768 && jQuery( window ).width() > 375) {
      jQuery('.hero-carousel-container img').each(function () {
        var data_src_md = jQuery(this).attr('data-src-md');
        jQuery(this).attr('data-lazy',data_src_md);
      });
    } else if(jQuery( window ).width() > 768) {
      jQuery('.hero-carousel-container img').each(function () {
        var data_src_lg = jQuery(this).attr('data-src-lg');
        jQuery(this).attr('data-lazy',data_src_lg);
      });
    }

    function sliderHero() {
      $heroSlides.slick({
        dots: false,
        arrows: true,
        pauseOnHover: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        responsive: [{
          breakpoint: 992,
          settings: {
            arrows: true,
          },
        },
        {
          breakpoint: 768,
          settings: {
          },
        }],
      });
      //https://github.com/kenwheeler/slick/issues/248
      $heroSlides.on('lazyLoaded', function (e, slick, image, imageSource) {
        image.parent().css('opacity','0');
        image.parent().css('background-image', 'url("' + imageSource + '")');
        image.parent().fadeTo( 'slow', 1 );
        image.hide();
      });
    }
    if($heroSlides.length > 0) {
      sliderHero();
    }

    //**********************************
    //END Hero Slider


     // Lessons slider element
    //****************************
    var $lessonsSlider = jQuery('.lessons-slider');
    if($lessonsSlider.length > 0) {
      $lessonsSlider.slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        adaptiveHeight: true,
        autoplaySpeed:10000,
        autoplay: true,
        pauseOnHover: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });
    }

    //add rollover to lesson cards
    var lessonCardRollover = function() {
        jQuery('.lesson-card').on({
            mouseenter: function () {
                $(this).animate({
                    backgroundColor: "#2C4D53",
                }, 200);
                $(this).find('h4').css('color', 'white');
                $(this).find('.cta').css('visibility', 'visible');
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                $(this).animate({
                    backgroundColor: "transparent",
                }, 200);
                $(this).find('h4').css('color', '#222');
                $(this).find('.cta').css('visibility', 'hidden');
            },
        });
    }
    // Call rollover function to call rollover function again since breakpoints slick event kills js events
    lessonCardRollover();
    // Slick slider on breakpoint trigger
    $lessonsSlider.on('breakpoint', function(){
        lessonCardRollover();
    });
    
    //**********************************
    //END Lessons Slider




    // Custom sliders
    //**********************************
    function customSlider(elementId) {
      //Custom slider
      var $sliderCustom = jQuery('#'+elementId);
      $sliderCustom.slick({
        slidesToShow: 3,
        centerPadding: '0',
        slidesToScroll: 3,
        arrows: true,
        speed: 900,
        autoplaySpeed: 5000,
        autoplay: true,
        centerMode: false,
        pauseOnHover: true,
        lazyLoad: 'ondemand',
        rows: 0,
        responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
          {
            breakpoint: 576,
            settings: {
              centerPadding: '0',
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });

      //https://github.com/kenwheeler/slick/issues/248
      $sliderCustom.on('lazyLoaded', function (e, slick, image, imageSource) {
        image.parent().css('opacity','0');
        image.parent().css('background-image', 'url("' + imageSource + '")');
        image.parent().fadeTo( 'slow', 1 );
        image.hide();
      });
    }

    //for all sliders, choose desktop or mobile version of image
    //first swap out data-lazy value if it's a mobile device
    if (jQuery( window ).width() < 768) {
      jQuery('.mjh-slider img').each(function () {
        var mobilesrc = jQuery(this).attr('data-mobilesrc');
        jQuery(this).attr('data-lazy',mobilesrc);
      });
    }
      
    //Scroll magic snippet to load sliders when in viewport
    // Initiate the controller
    var controller = new ScrollMagic.Controller();
    //Loop through all custom sliders and add scene
    jQuery( ".slider-custom" ).each(function() {
      var elementId = jQuery( this ).attr('ID');
      new ScrollMagic.Scene({
        triggerElement: '#'+elementId,
      }).addTo(controller)
        .on('enter', function () {
          customSlider(elementId);
        });
    });
    //**********************************
    //END Custom Sliders



  },
};
