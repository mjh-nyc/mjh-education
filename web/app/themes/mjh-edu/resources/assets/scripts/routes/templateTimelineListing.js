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
  },
};
