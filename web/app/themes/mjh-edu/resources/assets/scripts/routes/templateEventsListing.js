export default {
  init() {
      $( "#event-listing-form #event-category" ).change(function() {
          this.form.submit();
      });
  },
};
