export default {
  init() {
    // JavaScript to be fired on the home page
      jQuery('.slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        adaptiveHeight: true,
        autoplaySpeed:5000,
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

      //get offset for lesson position from left
      /*var $referenceContainer = $( '.wrap.container'),
          $carousel = $( '.carousel' ),
          offset = $referenceContainer.offset();

      var setCarouselPadding = function() {
        offset = $referenceContainer.offset();
        $carousel.css('padding-left', offset.left);
        $carousel.css('padding-right', offset.left);
      }
      var resizeTimer;
      $(window).on('resize', function() {

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          // Run code here, resizing has "stopped"
          setCarouselPadding();  
        }, 250);
      });
      setCarouselPadding();
      

      //scroll lesson plans left when we scrollup
      //and right when we scrolldown
      var Waypoint = window.Waypoint;
      var inview = new Waypoint.Inview({
        element: $carousel[0],
        enter: function(direction) {
          console.log('Enter triggered with direction ' + direction);
          if (direction == "down"){
            // The element is visible, scrollleft
          }
        },
      })
      inview.options.enabled = true;*/

      //add rollover to lesson cards
      $(".slide-card").on({
          mouseenter: function () {
            $( this ).animate({
              backgroundColor: "#2C4D53",
            }, 200 );
            $( this ).find('h4').css('color','white');
            $( this ).find('.cta').css('visibility','visible');
          },
          mouseleave: function () {
            //stuff to do on mouse leave
            $( this ).animate({
              backgroundColor: "transparent",
            }, 200 );
            $( this ).find('h4').css('color','#222');
            $( this ).find('.cta').css('visibility','hidden');
          },
      });

    


  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
