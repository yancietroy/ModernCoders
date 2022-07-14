//pass weakness checker
/*
$(document).ready(function() {
$('#txtNewPassword').keyup(function() {
$('#result').html(checkStrength($('#txtNewPassword').val()))
})
function checkStrength(password) {
var strength = 0
if (password.length < 8) {
$('#result').removeClass()
$('#result').addClass('short').css('color', 'red');
return 'Must be at least 8 characters'
}
if (password.length > 9) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('weak').css('color', 'red');
return 'Weak'
event.preventDefault();
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('good').css('color', '#ffc107');
return 'Good'
} else {
$('#result').removeClass()
$('#result').addClass('strong').css('color', 'green');
return 'Strong'
}
}
});

//  <!-- Confirm Password !-->

function checkPasswordMatch() {
  var password = $("#txtNewPassword").val();
  var confirmPassword = $("#txtConfirmPassword").val();

  if (password != confirmPassword)
      $("#divCheckPasswordMatch").text("Passwords do not match!").css('color', 'red');
  else
      $("#divCheckPasswordMatch").text("Passwords match.").css('color', 'green');
}

$(document).ready(function () {
 $("#txtConfirmPassword").keyup(checkPasswordMatch);
});*/

//has uppercase
window.Parsley.addValidator('uppercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var uppercases = value.match(/[A-Z]/g) || [];
    return uppercases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) uppercase letter.'
  }
});

//has lowercase
window.Parsley.addValidator('lowercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var lowecases = value.match(/[a-z]/g) || [];
    return lowecases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) lowercase letter.'
  }
});

//has number
window.Parsley.addValidator('number', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var numbers = value.match(/[0-9]/g) || [];
    return numbers.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) number.'
  }
});

//has special char
window.Parsley.addValidator('special', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var specials = value.match(/[^a-zA-Z0-9]/g) || [];
    return specials.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) special characters.'
  }
});
