export default {
  init() {
      $( "#survivor-timeline-form .survivor-select" ).change(function() {
          var formAction = $("#survivor-timeline-form").attr('action');
          var slug = $('[name="survivor-story"]').val();
          if(slug){
              window.location.href = formAction+"survivor-story/"+slug;
          }else{
              window.location.href = formAction;
          }
      });

      //Sticky years
      var stick = function(stickies) {
        //var $thisRowHeight = 0;
        stickies.each(function() {
          //var $thisSticky = $(this).wrap('<div class="year-wrapper" />'); //moved wrapper into html
          var $thisSticky = $(this);
          //console.log($thisSticky);
          //stick for Desktop experience only
          //if (WURFL.form_factor === 'Desktop') {
            $thisSticky.stick_in_parent({
              offset_top: 100,
            }).on("sticky_kit:stick", function() {
                //console.log("has stuck!", e.target);
            }).on("sticky_kit:unstick", function() {
              //console.log("has unstuck!", e.target);
            });
          //}
        });
      };
      stick($('.year-section h3.year'));
  },
};
