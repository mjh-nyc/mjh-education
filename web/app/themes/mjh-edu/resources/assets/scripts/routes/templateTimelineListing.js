export default {
  init() {
      $( "#survivor-form .survivor-select" ).change(function() {
          this.form.submit();
      });
  },
};
