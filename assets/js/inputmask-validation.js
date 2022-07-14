$(document).ready(function(){
  $("#studentid").inputmask("99-999999", {
    autoUnmask: true,
    onincomplete: function () {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function () {
      $("#errorstudid").hide();
    }
});
});
$(document).ready(function(){
  $("#section").inputmask("999A", {
    autoUnmask: true,
    onincomplete: function () {
      $("#errorsection").show();
    },

    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function () {
      $("#errorsection").hide();
    }
});
});
