$(document).ready(function() {
  $("#studentid").inputmask("99-999999", {
    autoUnmask: true,
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});



$(document).ready(function() {
  $("#schoolId").inputmask("99-999999", {
    autoUnmask: true,
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});

$(document).ready(function() {
  $("#schoolyear").inputmask("9999-9999", {
    autoUnmask: true,
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});

$(document).ready(function() {
  $("#schoolYear").inputmask("9999-9999", {
    autoUnmask: true,
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});
