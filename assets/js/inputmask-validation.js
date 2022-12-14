$(document).ready(function() {
  $("#studentid").inputmask("99-999999", {
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});

$(document).ready(function() {
  $("#estimated_budget").inputmask({
   'alias':          'decimal',
    'groupSeparator': ',',
    'autoGroup':      true, 
    'digits':         2, 
    'digitsOptional': false,
    'placeholder':    '0.00'
  });
});

$(document).ready(function() {
  $("#payment-").inputmask({
   'alias':          'decimal',
    'groupSeparator': ',',
    'autoGroup':      true, 
    'digits':         2, 
    'digitsOptional': false,
    'placeholder':    '0.00'
  });
});


$(document).ready(function() {
  $("#schoolId").inputmask("99-999999", {
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});

$(document).ready(function() {
  $("#schoolyear").inputmask("9999-9999", {
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});

$(document).ready(function() {
  $("#schoolYear").inputmask("9999-9999", {
    onincomplete: function() {
      $("#errorstudid").show();
    },
    clearIncomplete: true,
    showMaskOnFocus: false,
    showMaskOnHover: false,
    oncomplete: function() {
      $("#errorstudid").hide();
    }
  });
});
