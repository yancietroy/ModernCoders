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
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg-admin">

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form" name="form" data-parsley-validate data-parsley-trigger="keyup" data-parsley-validate class="requires-validation" novalidate>
    <section class="h-100">
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-9">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body px-5 py-3 pt-4 ">
                <div class="row g-0 justify-content-center align-items-center ">
                  <div class="col-xs-12 col-md-2 col-md-offset-3 mb-4 d-none d-sm-block">
                    <!--	<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4  d-none d-sm-block">
                        <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
                      </div>-->
                    <div class="col-xs-12 col-md-4 col-md-offset-3 mb-2 justify-content-center text-center align-items-center">
                      <img class="mb-2 mx-auto text-center" src="assets/img/jru-logo.png" alt="" width="110" height="110">
                    </div>
                    <!--		<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4 d-none d-sm-block">
                        <img class="mb-3 mx-auto d-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
                      </div>-->
                  </div>
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Signatory Registration Form</h3>

                  <!-- <form class="was-validated"> -->
                      <div class="row justify-content-start">
                  <div class="col-12 col-md-4  mb-4">
                    <div class="form-outline">

                      <label class="form-label" for="schoolId" id="asterisk">ID</label>
                      <input type="text" name="schoolId" id="schoolId" class="form-control" placeholder="##-###### " required />
                      <div class="valid-feedback"> </div>
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-12 col-md-4 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="firstName" id="asterisk">First name</label>
                        <input type="text" name="firstName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="firstName" class="form-control form-control-lg" required="" />
                        <div class="valid-feedback"></div>
                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                      </div>
                    </div>
                    <div class="col-12 col-md-4  mb-4">
                      <div class="form-outline">

                        <label class="form-label" for="lastName" id="asterisk">Last name</label>
                        <input type="text" name="lastName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="lastName" class="form-control form-control-lg" required />
                        <div class="valid-feedback"> </div>
                        <!--<div class="invalid-feedback">Last name field invalid!</div>-->
                      </div>
                    </div>
                    <div class="col-12  col-md-4   mb-4">
                      <label class="form-label select-label" id="asterisk">Signatory Type</label>
                      <select class=" form-select" name="signatory_type" id="select-group" required>
                        <option class="greyclr" selected disabled value="">Select Type</option>
                        <option value="Student Adviser">Student Adviser</option>
                        <option value="SDO">SDO</option>
                      </select>
                      <div class="valid-feedback"> </div>
                    </div>
                  </div>
                  <div class="row mb-0">
                    <div class="col-12 col-md-4 mb-4">
                      <div class="form-outline">

                        <label class="form-label" for="email" id="asterisk">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="fname.lname@my.jru.edu" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" style="background-color: #fff;"
                          >
                        <div class="valid-feedback"></div>
                      </div>
                    </div>

                    <div class="col-12 col-md-4 ">
                      <div class="form-outline">

                        <label class="form-label" for="password" id="asterisk">Password</label>
                        <input type="password" class="form-control password" name="password" id="txtNewPassword" data-parsley-minlength="8" maxlength="20" data-parsley-errors-container=".errorspannewpassinput"
                          data-parsley-required-message="Please enter your password." data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required required />
                        <span class="errorspannewpassinput"></span>
                        <div class="valid-feedback"> </div>
                    </div>
                </div>
                    <div class="col-12 col-md-4">
                      <div class="form-outline">
                        <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                        <input type="password" class="form-control password" name="confirmpassword" id="txtConfirmPassword" maxlength="20" onChange="checkPasswordMatch();" data-parsley-minlength="8"
                          data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your password." data-parsley-equalto="#txtNewPassword" data-parsley-required required />
                        <span class="errorspanconfirmnewpassinput"></span>
                        <div class="valid-feedback"> </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-12 col-md-12 mt-0 mb-4">
                    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Register</button>

                  </div>

                  <hr class="my-4">
                  <p class="mt-3 text-center">Already have an account? <a href="signatory-login.php" class="text-blue-50 fw-bold">Login</a>
                  </p>
                  <?php
              if (isset($si) || isset($fn) || isset($ln) || isset($st) || isset($e) || isset($p) || isset($_POST['submit']))
                {
                  $si = $_POST['schoolId'];
                  $fn = $_POST['firstName'];
                  $ln = $_POST['lastName'];
                  $st = $_POST['signatory_type'];
                  $e = $_POST['email'];
                  $p = $_POST['password'];

                      $query = "INSERT INTO tb_signatories(school_id, first_name, last_name, signatory_type, email, password) VALUES('$si', '$fn', '$ln', '$st', '$e', SHA('$p'))";
                      $result = @mysqli_query($conn, $query);

                      echo "<script type='text/javascript'>
                            window.location = 'signatory-login.php'
                            alert('You are now registered!')
                            </script>";
                      //header("location:signatory-login.php");
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
                  Waves.attach('.btn-primary');
                  Waves.init();
                </script>
                <!-- JavaScript validation -->
                <script src="assets/js/bootstrap-validation.js"></script>
                <!-- <script src="js/form-validation.js"></script>
                Prevent Cut Copy Paste -->
                <script>
                  $(document).ready(function() {
                    $('input:text').bind('cut copy paste', function(e) {
                      e.preventDefault();
                      return false;
                    });

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
