//pass weakness checker

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
      $("#divCheckPasswordMatch").html("Passwords do not match!").css('color', 'red');
  else
      $("#divCheckPasswordMatch").html("Passwords match.").css('color', 'green');
}

$(document).ready(function () {
 $("#txtConfirmPassword").keyup(checkPasswordMatch);
});
