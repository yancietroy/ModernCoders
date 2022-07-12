<?php 
session_start(); 
include('mysql_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>JRU Student Organizations Portal</title>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="bg">

        <form action="register.php" method="post" class="requires-validation" novalidate>
  <section class="h-100">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-9">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body px-5 py-3 pt-4 ">
                <div class="row g-0 justify-content-center align-items-center ">
                    <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                        <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
                          </div>
                        <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                        <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
                            </div>
                            <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                        <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
                          </div>
            </div>
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Student Registration Form</h3>

              <h4 class="mb-4 pb-2 pb-md-0 mb-md-4">Personal details</h4>
            <!-- <form class="was-validated"> -->
                <div class="row">
                  <div class="col-4 col-md-4 col-sm-3 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="firstName" id="asterisk">First name</label>
                      <input type="text" name="first_name" onkeypress="return /[a-z, ]/i.test(event.key)" maxlength="20" id="txtTest" class="form-control form-control-lg" required />
                      <div class="valid-feedback"></div>
                      <div class="invalid-feedback">First name field cannot be blank!</div>
                    </div>
                  </div>
                  <div class="col-4 col-md-4  mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="middleName">Middle name</label>
                      <input type="text" name="middle_name" onkeypress="return /[a-z, ]/i.test(event.key)"   maxlength="20" id="txtTest2" class="form-control form-control-lg" />
                      <div class="valid-feedback">
                      </div>
                    </div>

                  </div>
                  <div class="col-4 col-md-4  mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="lastName" id="asterisk">Last name</label>
                      <input type="text" name="last_name" onkeypress="return /[a-z, ]/i.test(event.key)"  maxlength="20"  id="txtTest3" class="form-control form-control-lg" required />
                      <div class="valid-feedback">  </div>
                      <div class="invalid-feedback">Last name field cannot be blank!</div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4 col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="bday" id="asterisk">Birthdate</label>
                      <input id="birthDate" class="form-control form-control-lg" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old" required />
                      <div class="valid-feedback">  </div>
                      <div class="invalid-feedback">Birthdate field invalid!</div>
                    </div>
                  </div>
                  <div class="col-3 col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="age">Age</label>
                      <input type="text" name="age" id="age" maxlength="2" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                      <div class="valid-feedback">  </div>
                      <div class="invalid-feedback">Age field cannot be blank!</div>
                    </div>
                  </div>
                  <div class="col-4 col-md-4 mb-4 ">
                    <label class="mb-3 me-5 min-vw-100" for="gender" id="asterisk">Gender </label>

                    <input type="radio" class="btn-check" name="gender" id="male" value="Male" autocomplete="off" required>
                    <label class="btn btn-sm me-2 btn-outline-secondary" for="male">Male</label>

                    <input type="radio" class="btn-check" name="gender" id="female" value="Female" autocomplete="off" required>
                    <label class="btn btn-sm me-2 btn-outline-secondary" for="female">Female</label>
                               <div class="valid-feedback check"> &#x2713;</div>
                                <div class="invalid-feedback mv-up">Please select a gender!</div>
                            </div>

                </div>
                <hr>
              <div class="row">
                  <h4 class="mb-4 pb-2 pb-md-0 mb-md-4 mt-2">Academic Profile</h4>
                  <div class="col-4 col-md-4  col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="studentid" id="asterisk">Student ID</label>
                      <input type="text" name="studentid" id="studentid" class="form-control" placeholder="##-######" required />
                      <div class="valid-feedback">  </div>
                      <div class="invalid-feedback">student id field cannot be blank!</div>
                    </div>
                  </div>
                      <div class="col-4 col-md-4   mb-4">
                        <label class="form-label select-label" id="asterisk">Year Level</label>
                        <select class=" form-select" name="school_year" id="select-group" required>
                          <option class="greyclr" selected disabled value="" >Select Year</option>
                          <option value="1">First Year</option>
                          <option value="2">Second Year</option>
                          <option value="3">Third Year</option>
                          <option value="4">Fourth Year</option>
                        </select>
                        <div class="valid-feedback">  </div>
                        <div class="invalid-feedback">year field cannot be blank!</div>
                      </div>
                      <div class="col-3 col-md-4 mb-4">
                        <div class="form-outline">

                          <label class="form-label" for="section" id="asterisk">Section</label>
                          <input type="text" name="section" id="section" class="form-control" placeholder="####" required />
                          <div class="valid-feedback">  </div>
                          <div class="invalid-feedback">section field cannot be blank!</div>
                        </div>
                      </div>
                  </div>
                <div class="row">
                  <div class="col-3 col-md-4   mb-4">

                    <label class="form-label select-label" id="asterisk">College</label>
                    <select class="form-select form-select-sm" name="college" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select College</option>
                      <?php
                           $query = "SELECT college FROM tb_collegedept";
                           $result = @mysqli_query($conn, $query);
                           while($data = @mysqli_fetch_array($result)) {
                               echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                           }
                                           ?>
                    </select>
                    <div class="invalid-feedback">
                      Please select a college program
                    </div>
                  </div>

                  <div class="col-3 col-md-4  mb-4">

                    <label class="form-label select-label" size="5" id="asterisk">Course</label>
                    <select class="form-select form-select-sm"  style="width:100%;" name="course" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select Course</option>
                      <?php
                            $query = "SELECT course FROM tb_course";
                            $result = @mysqli_query($conn, $query);
                            while($data = @mysqli_fetch_array($result)) {
                                echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                            }
                                            ?>
                    </select>
                    <div class="invalid-feedback">
                      Please select a Course
                    </div>
                  </div>
                  <div class="col-5 col-md-4  mb-4">

                    <label class="form-label select-label" id="asterisk">Organization</label>
                    <select class="form-select form-select-sm" name="org" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select Organization</option>
                      <?php
                           $query = "SELECT MOTHER_ORG, MORG_ID FROM tb_morg";
                           $result = @mysqli_query($conn, $query);
                           while($data = @mysqli_fetch_array($result)) {
                               echo '<option value="' . $data[1] .  '" >'. $data[0] . '</option>';
                                           }
                                           ?>
                    </select>
                    <div class="invalid-feedback">
                      Please select a Organization
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="email" id="asterisk">Student Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="fname.lname@my.jru.edu" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" required>
                      <div class="valid-feedback">Email field is valid!</div>
                      <div class="invalid-feedback">Email field invalid!</div>
                    </div>
                  </div>

                  <div class="col-6 col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="password" id="asterisk">Password</label>
                      <input type="password" class="form-control" name="password" id="txtNewPassword" minlength="8" required>
                      <div class="valid-feedback"> </div>
                      <div class="invalid-feedback">Must be at least 8 characters long &#013;
                Must contain at least one number &#013;
                      Must contain at least one special character &#013;
                      and must contain at least one uppercase and lowercase letter!</div>
                    </div>
                  </div>
                  <div class="col-6 col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                      <input type="password" class="form-control" name="confirmpassword" id="txtConfirmPassword" minlength="8" onChange="checkPasswordMatch();" required>
                    </div>
                        <div class="registrationFormAlert" id="divCheckPasswordMatch">
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-12 mb-4">
                  <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Register</button>

                </div>

              <hr class="my-4">
              <p class="mt-3 text-center">Already have an account? <a href="login.php" class="text-blue-50 fw-bold">Login</a>
              </p>
              <?php
              if (isset($_POST['password']) !== isset($_POST['confirmpassword']))
              {
              	echo '<script>alert("Password must match!")</script>';
              }
                else if (isset($fn) || isset($ln) || isset($mn) || isset($date) || isset($date) || isset($age) || isset($g) || isset($si) || isset($yl) || isset($course) || isset($course) || isset($morg) || isset($section) || isset($e) || isset($pass) || isset($_POST['submit']))
                {
                  $fn = $_POST['first_name'];
                  $ln = $_POST['last_name'];
                  $mn = $_POST['middle_name'];
                  $date = $_POST['birthdate'];
                  $age = $_POST['age'];
                  $g = $_POST['gender'];
                  $si = $_POST['studentid'];
                  $yl = $_POST['school_year'];
                  $course = $_POST['course'];
                  $morgid = $_POST['org'];
                  $section = $_POST['section'];
                  $e = $_POST['email'];
                  $pass = $_POST['password'];

                      $query = "INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL, COURSE, MORG_ID, SECTION, EMAIL, PASSWORD) VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$course', '$morgid', '$section', '$e', SHA('$pass'))";
                      $result = @mysqli_query($conn, $query);

                      echo "<script type='text/javascript'>
                            window.location = 'login.php'
                            alert('You are now registered!')
                            </script>";
                      //header("location:login.php");
                      die;
                          @mysqli_close($conn);
                }
              ?>
          </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>
  <!-- JavaScript validation -->

  <script>
  (function () {
'use strict'
const forms = document.querySelectorAll('.requires-validation')
Array.from(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>

  <!--input mask-->
  <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
    $("#studentid").inputmask("99-999999", {
      autoUnmask: true,
      removeMaskOnSubmit: true,
      showMaskOnFocus: false,
      showMaskOnHover: false,
      onincomplete: function () {
        alert('student id field incomplete');
      }
  });
});
  $(document).ready(function(){
    $("#section").inputmask("999a", {
      autoUnmask: true,
      removeMaskOnSubmit: true,
      showMaskOnFocus: false,
      showMaskOnHover: false,
      onincomplete: function () {
        alert('section field incomplete');
      }
  });
});

  </script>

  <!--Uppercase first letter !-->
  <script>
  // Get a reference to the input and wire it up to an input event handler that
// calls the fixer function
document.getElementById("txtTest").addEventListener("input", forceLower);
document.getElementById("txtTest2").addEventListener("input", forceLower);
document.getElementById("txtTest3").addEventListener("input", forceLower);
// Event handling functions are automatically passed a reference to the
// event that triggered them as the first argument (evt)
function forceLower(evt) {
  // Get an array of all the words (in all lower case)
  var words = evt.target.value.toLowerCase().split(/\s+/g);

  // Loop through the array and replace the first letter with a cap
  var newWords = words.map(function(element){
    // As long as we're not dealing with an empty array element, return the first letter
    // of the word, converted to upper case and add the rest of the letters from this word.
    // Return the final word to a new array
    return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
  });

 // Replace the original value with the updated array of capitalized words.
 evt.target.value = newWords.join(" ");
}
  </script>

  <!-- Confirm Password !-->
  <script>
  function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Passwords do not match!");
    else
        $("#divCheckPasswordMatch").html("Passwords match.");
}

$(document).ready(function () {
   $("#txtConfirmPassword").keyup(checkPasswordMatch);
});

  </script>


  <!-- age validation !-->
  <script type="text/javascript">

  function getAge(){
      var dob = document.getElementById('birthDate').value;
      dob = new Date(dob);
      var today = new Date();
      var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
      document.getElementById('age').value=age;
  }

  $(function () {
      $('input[data-relmax]').each(function () {
          var oldVal = $(this).prop('value');
          var relmax = $(this).data('relmax');
          var max = new Date();
          max.setFullYear(max.getFullYear() + relmax);
          $.prop(this, 'max', $(this).prop('valueAsDate', max).val());
          $.prop(this, 'value', oldVal);
      });
  });

  </script>
</body>

</html>
