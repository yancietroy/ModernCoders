function getAge() {
  var dob = document.getElementById("birthDate").value;
  dob = new Date(dob);
  var today = new Date();
  var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
  document.getElementById("age").value = age;
}

$(function () {
  $("input[data-relmax]").each(function () {
    var oldVal = $(this).prop("value");
    var relmax = $(this).data("relmax");
    var max = new Date();
    max.setFullYear(max.getFullYear() + relmax);
    $.prop(this, "max", $(this).prop("valueAsDate", max).val());
    $.prop(this, "value", oldVal);
  });
});
