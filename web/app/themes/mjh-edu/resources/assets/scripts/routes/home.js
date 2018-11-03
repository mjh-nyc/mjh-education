export default {
  init() {
    // JavaScript to be fired on the home page
      jQuery('.slider').slick({
          slidesToShow: 3,
          centerPadding: '0',
          slidesToScroll: 1,
          arrows: true,
          speed: 900,
          autoplaySpeed:5000,
          autoplay: true,
          centerMode: true,
          pauseOnHover: true,
          responsive: [{
              breakpoint: 768,
              settings: {
                  centerMode: true,
                  centerPadding: '150',
                  slidesToShow: 1,
              },
          },
              {
                  breakpoint: 576,
                  settings: {
                      arrows: false,
                      centerMode: true,
                      centerPadding: '0',
                      slidesToShow: 1,
                  },
              },
          ],
      });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
