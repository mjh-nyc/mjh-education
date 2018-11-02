export default {
  init() {
      // Image rollovers for survivor past and current
      $.each($('.survivor--image'), function( ) {
          $('img').hover(function() {
              //current
              $(this).attr('src', $(this).attr('data-attr-current'));
          }, function() {
              //past
              $(this).attr('src', $(this).attr('data-attr-past'));
          });
      });
  },
};
