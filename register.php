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
  <!-- our custom css -->
  <link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">
  <!-- waves css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg">


    <section class="h-100">
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-11 col-lg-9 col-xl-9">
            <div class="card shadow-2-strong card-registration mb-4" style="border-radius: 15px;">
              <div class="card-body px-5 py-3 pt-4 ">
                <div class="row g-0 justify-content-center align-items-center ">
                  <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                    <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
                  </div>
                  <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                    <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
                  </div>
                  <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block d-sm-block">
                    <img class="mb-3 mx-auto d-none d-sm-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
                  </div>
                </div>
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Student Registration Form</h3>

                <h4 class="mb-4 pb-2 pb-md-0 mb-md-4">Personal details</h4>

                <?php
              if (isset($fn) || isset($ln) || isset($mn) || isset($date) || isset($date) || isset($age) || isset($g) || isset($si) || isset($yl) || isset($course) || isset($course) || isset($morg)
               || isset($section) || isset($e) || isset($pass) || isset($cd) || isset($_POST['submit']))
                {
                  $fn = $_POST['first_name'];
                  $ln = $_POST['last_name'];
                  $mn = $_POST['middle_name'];
                  $date = $_POST['birthdate'];
                  $age = $_POST['age'];
                  $g = $_POST['gender'];
                  $si = $_POST['studentid'];
                  $yl = $_POST['school_year'];
                  $cd = $_POST['college_dept'];
                  $course = $_POST['course'];
                  $morgid = $_POST['org'];
                  $section = $_POST['section'];
                  $e = $_POST['email'];
                  $pass = $_POST['password'];
                  $pp = "none";

                  $duplicate=mysqli_query($conn,"SELECT * FROM tb_students WHERE STUDENT_ID='$si' OR EMAIL='$e'");
                  if (mysqli_num_rows($duplicate)>0)
                  {
                    echo "
                          <div class='callout bs-callout-warning pb-0' id='box'>
                            <h4>Error!</h4>
                            <p>student id or email already exists in the database!</p>
                          </div>
                          ";
                  }
                  else{
                  try {
                  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL, COLLEGE_DEPT, COURSE, MORG_ID, SECTION, EMAIL, PASSWORD, ACCOUNT_CREATED, PROFILE_PIC)
                  VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$cd', '$course', '$morgid', '$section', '$e', SHA('$pass'), NOW(), '$pp')";
                  $conn->exec($sql);
                  echo "
                  <div class='callout bs-callout-success pb-0'>
                    <h4>Successfuly registered!</h4>
                    <p>please wait for approval in your email. <a href='index.php' class='text-blue-50 fw-bold'> Back to login</a></p>
                  </div>";
                  }
                     catch(PDOException $e)
                      {
                            echo $sql . "
                            " . $e->getMessage();
                      }
                  $conn = null;
                  }
                  }
                  ?>
                <!-- <form class="was-validated"> -->
                <form method="post" action="register.php" id="form" name="form"  data-parsley-validate data-parsley-trigger="keyup">
                <div class="row">
                  <div class="col-12 col-md-4 col-sm-3 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="firstName" id="asterisk">First name</label>
                      <input type="text" name="first_name" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="txtTest" class="form-control form-control-lg" required="" />
                      <div class="valid-feedback"></div>
                      <!--<div class="invalid-feedback">First name field invalid!</div>-->
                    </div>
                  </div>
                  <div class="col-12 col-md-4  mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="middleName">Middle name</label>
                      <input type="text" name="middle_name" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="txtTest2" class="form-control form-control-lg" />
                      <div class="valid-feedback"> </div>
                      <!--<div class="invalid-feedback">Middle name field invalid!</div>-->

                    </div>

                  </div>
                  <div class="col-12 col-md-4  mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="lastName" id="asterisk">Last name</label>
                      <input type="text" name="last_name" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="txtTest3" class="form-control form-control-lg" required />
                      <div class="valid-feedback"> </div>
                      <!--<div class="invalid-feedback">Last name field invalid!</div>-->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="bday" id="asterisk">Birthdate</label>
                      <input id="birthDate" class="form-control form-control-lg" placeholder="mm/dd/yyyy" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old" required />
                      <div class="valid-feedback"> </div>
                      <!--  <div class="invalid-feedback">Birthdate field invalid!</div>-->
                    </div>
                  </div>
                  <div class="col-6 col-md-4 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="age">Age</label>
                      <input type="text" name="age" id="age" maxlength="2" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                      <div class="valid-feedback"> </div>
                      <div class="invalid-feedback">Age field cannot be blank!</div>
                    </div>
                  </div>
                  <div class="col-6 col-md-4 mb-4 ">
                    <label class="mb-3 me-5 min-vw-100" for="gender" id="asterisk">Gender </label>
                    <div class="btn-group">

                      <input type="radio" class="btn-check" name="gender" id="male" value="Male" autocomplete="off" required>
                      <label class="btn btn-sm me-2 btn-outline-secondary" for="male">Male</label>

                      <input type="radio" class="btn-check" name="gender" id="female" value="Female" autocomplete="off" required>
                      <label class="btn btn-sm me-2 btn-outline-secondary" for="female">Female</label>
                      <!--<div class="valid-feedback check"> &#x2713;</div>
                      <div class="invalid-feedback mv-up">Please select a gender!</div>-->
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <h4 class="mb-4 pb-2 pb-md-0 mb-md-4 mt-4">Academic Profile</h4>
                  <div class="col-12 col-md-4  col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="studentid" id="asterisk">Student ID</label>
                      <input type="text" name="studentid" id="studentid" class="form-control" placeholder="##-######" required />
                      <div class="valid-feedback"> </div>
                      <!--   <div class="invalid-feedback" id="errorstudid">student id field invalid!</div>-->
                    </div>
                  </div>
                  <div class="col-7 col-md-4   mb-4">
                    <label class="form-label select-label" id="asterisk">Year Level</label>
                    <select class=" form-select" name="school_year" id="select-group" required>
                      <option class="greyclr" selected disabled value="">Select Year</option>
                      <option value="1">Year 1</option>
                      <option value="2">Year 2</option>
                      <option value="3">Year 3</option>
                      <option value="4">Year 4</option>
                    </select>
                    <div class="valid-feedback"> </div>
                    <!-- <div class="invalid-feedback">year field cannot be blank!</div>-->
                  </div>
                  <div class="col-5 col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="section" id="asterisk">Section</label>
                      <input type="text" name="section" id="section" class="form-control" placeholder="####" required />
                      <div class="valid-feedback"> </div>
                      <!--<div class="invalid-feedback" id="errorsection">section field invalid!</div>-->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-4   mb-4">

                    <label class="form-label select-label" id="asterisk">College</label>
                    <select class="form-select form-select-sm" name="college_dept" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select College</option>
                      <?php
                                    $query = "SELECT college_id, college FROM tb_collegedept";
                                    $result = @mysqli_query($conn, $query);
                                    while($data = @mysqli_fetch_array($result)) {
                                        echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                    }
                                ?>
                    </select>
                    <!--<div class="invalid-feedback">Please select a college program</div>-->
                  </div>

                  <div class="col-12 col-md-4  mb-4">

                    <label class="form-label select-label" size="5" id="asterisk">Course</label>
                    <select class="form-select form-select-sm" style="width:100%;" name="course" id="select-group" required>
                      <option class="greyclr" selected disabled value="" text-muted>Select Course</option>
                      <?php
                            $query = "SELECT course FROM tb_course";
                            $result = @mysqli_query($conn, $query);
                            while($data = @mysqli_fetch_array($result)) {
                                echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                            }
                                            ?>
                    </select>
                    <!--<div class="invalid-feedback">Please select a course</div>-->
                  </div>
                  <div class="col-12 col-md-4  mb-4">

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
                    <!--<div class="invalid-feedback">Please select a organization</div>-->
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-4 mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="email" id="asterisk">Student Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="fname.lname@my.jru.edu" pattern=".+@my.jru\.edu" data-parsley-trigger="change" title="Please provide a Jose Rizal University e-mail address" style="background-color: #fff;"
                        readonly>
                      <div class="valid-feedback"></div>
                      <!--<div class="invalid-feedback">Student ID field invalid</div>-->
                    </div>
                  </div>

                  <div class="col-12 col-md-4 mb-0">
                    <div class="form-outline">

                      <label class="form-label" for="password" id="asterisk">Password</label>
                      <input type="password" class="form-control password" name="password" id="txtNewPassword" data-parsley-trigger="keyup" data-parsley-minlength="8" maxlength="20" data-parsley-errors-container=".errorspannewpassinput"
                        data-parsley-required-message="Please enter your password." data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required required />
                      <span class="errorspannewpassinput"></span>
                      <div class="valid-feedback"> </div>
                      <!--<div class="invalid-feedback">Must be at least 8 characters long &#013;
                Must contain at least one number &#013;
                      Must contain at least one special character &#013;
                      and must contain at least one uppercase and lowercase letter!</div>
                    </div>
                      <span id="result"></span>!-->
                    </div>
                  </div>
                  <div class="col-12 col-md-4 mb-2">
                    <div class="form-outline">
                      <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                      <input type="password" class="form-control password" name="confirmpassword" id="txtConfirmPassword" maxlength="20" data-parsley-trigger="keyup" onChange="checkPasswordMatch();" data-parsley-minlength="8"
                        data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your password." data-parsley-equalto="#txtNewPassword" data-parsley-required required />
                      <span class="errorspanconfirmnewpassinput"></span>
                      <div class="valid-feedback"> </div>
                      <!--  <div class="invalid-feedback">Invalid Field!</div>-->
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 mb-4">
                  <button class="w-100 btn btn-lg btn-primary button" type="submit" name="submit" value="submit" onClick="javascript:$('#form').parsley( 'validate' );">Register</button>
                </div>

                <hr class="my-4">
                <p class="mt-3 text-center">Already have an account? <a href="index.php" class="text-blue-50 fw-bold">Login</a>
                </p>


  </form>

  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>

  <!-- JQUERY -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>!-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
  <!-- Popover
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script> <!-- JavaScript validation -->
  <script type="text/javascript">
    Waves.attach('.button');
    Waves.init();
  </script>
  <!-- JavaScript validation -->
  <script src="../assets/js/bootstrap-validation.js"></script>

  <!-- <script src="js/form-validation.js"></script>
Prevent Cut Copy Paste -->
  <script>
    $(document).ready(function() {
      $('input:text').bind('cut copy paste', function(e) {
        e.preventDefault();
        return false;
      });

    });

    document.addEventListener('click', function handleClickOutsideBox(event) {
  const box = document.getElementById('box');

  if (!box.contains(event.target)) {
    box.style.display = 'none';
  }
});
  </script>

  <!--email generator-->
  <script>
    $("#txtTest, #txtTest3").on('input', function() {
      var fname = $("#txtTest").val().toLowerCase().replace(/\s/g, '');
      var lname = $("#txtTest3").val().toLowerCase().replace(/\s/g, '');
      $("#email").attr("value", fname + "." + lname + "@my.jru.edu");
    });
  </script>
  <!--input mask-->
  <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
  <script src="assets/js/inputmask-validation.js"></script>

  <!--Uppercase first letter !-->
  <script src="assets/js/uppercase-firstletter.js"></script>

  <!--password validation!-->
  <script src="assets/js/pass-validation.js"></script>

  <!-- age validation !-->
  <script src="assets/js/age-validation.js"></script>

</body>

</html>
