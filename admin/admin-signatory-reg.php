<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "User Management / Signatories";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["User Management", "admin-users.php", ""],
  ["Signatories", "admin-signatories.php", ""],
  ["New Signatory", "admin-signatory-reg.php", "active"],
];
if (isset($_SESSION['msg'])) {
  print_r($_SESSION['msg']); #display message
  unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
  <title>JRU Student Organizations Portal</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- Datatable Default-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <?php include("include/sidebar.php") ?>

    <div id="content">

      <!-- Navbar/Header  -->
      <?php include("include/header.php") ?>

      <!-- breadcrumb -->
      <?php include("include/breadcrumb.php") ?>

      <!-- Page content -->

      <div class="row justify-content-center align-items-center">
        <div class="col-11 col-lg-11 col-xl-11">
          <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
            <div class="card-body px-5 py-3 pt-4 ">
              <div class="row g-0 justify-content-center align-items-center ">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="form" name="form" data-parsley-validate data-parsley-trigger="keyup" data-parsley-validate class="requires-validation" novalidate>
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Signatory Registration Form</h3>

                  <!-- <form class="was-validated"> -->
                  <div class="row justify-content-start">
                    <div class="col-12 col-md-4  mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="schoolId" id="asterisk">JRU ID</label>
                        <input type="text" name="schoolId" id="schoolId" class="form-control" placeholder="##-###### " required />
                        <div class="valid-feedback"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-12 col-md-4  mb-4">
                      <label class="form-label" id="asterisk">Signatory Type</label>
                      <select class=" form-select" name="signatory_type" id="showme" onchange="showDiv(this)" required>
                        <option class="greyclr" selected disabled value="">Select Type</option>
                        <?php
                        $query = "SELECT signatory_id, signatory FROM tb_signatory_type";
                        $result = @mysqli_query($conn, $query);
                        while ($data = @mysqli_fetch_array($result)) {
                          echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4  mb-4" style='display:none;' id="orghide">
                      <label class="form-label" id="asterisk">College Department</label>
                      <select class="form-select" style="width:100%;" name="college_id" id="college_id">
                        <option class="greyclr" selected disabled value="">Select College</option>
                        <?php
                        $query = "SELECT * FROM tb_collegedept";
                        $result = @mysqli_query($conn, $query);
                        while ($data = @mysqli_fetch_array($result)) {
                          echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4  mb-4">
                      <label class="form-label">Organization</label>
                      <select class=" form-select" name="orgid" id="showme">
                        <option class="greyclr" selected disabled value="" text-muted>Select Organization</option>
                        <?php
                        $query = "SELECT ORG, ORG_ID FROM tb_orgs";
                        $result = @mysqli_query($conn, $query);
                        while ($data = @mysqli_fetch_array($result)) {
                          echo '<option value="' . $data[1] .  '" >' . $data[0] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="firstName" id="asterisk">First name</label>
                        <input type="text" name="firstName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="txtTest" class="form-control form-control-lg" required="" />
                        <div class="valid-feedback"></div>
                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                      </div>
                    </div>
                    <div class="col-12 col-md-6  mb-4">
                      <div class="form-outline">

                        <label class="form-label" for="lastName" id="asterisk">Last name</label>
                        <input type="text" name="lastName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" id="txtTest2" class="form-control form-control-lg" required />
                        <div class="valid-feedback"> </div>
                        <!--<div class="invalid-feedback">Last name field invalid!</div>-->
                      </div>
                    </div>
                  </div>
                  <div class="row mb-0">
                    <div class="col-12 col-md-4 mb-4">
                      <div class="form-outline">

                        <label class="form-label" for="email" id="asterisk">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="fname.lname@jru.edu" pattern=".+@jru\.edu" title="Please provide a Jose Rizal University e-mail address" style="background-color: #fff;">
                        <div class="valid-feedback"></div>
                      </div>
                    </div>

                    <div class="col-12 col-md-4 ">
                      <div class="form-outline">

                        <label class="form-label" for="password" id="asterisk">Password</label>
                        <input type="password" class="form-control password" name="password" id="txtNewPassword" data-parsley-minlength="8" maxlength="20" data-parsley-errors-container=".errorspannewpassinput" data-parsley-required-message="Please enter your password." data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required required />
                        <span class="errorspannewpassinput"></span>
                        <div class="valid-feedback"> </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                      <div class="form-outline">
                        <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                        <input type="password" class="form-control password" name="confirmpassword" id="txtConfirmPassword" maxlength="20" onChange="checkPasswordMatch();" data-parsley-minlength="8" data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your password." data-parsley-equalto="#txtNewPassword" data-parsley-required required />
                        <span class="errorspanconfirmnewpassinput"></span>
                        <div class="valid-feedback"> </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-12 col-md-12 mt-0 mb-4">
                    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Register</button>

                  </div>


                  <?php
                  if (isset($si) || isset($fn) || isset($ln) || isset($st) || isset($e) || isset($p) || isset($cd) || isset($oid) || isset($_POST['submit'])) {
                    $si =  $mysqli -> real_escape_string ($_POST['schoolId']);
                    $fn =  $mysqli -> real_escape_string ($_POST['firstName']);
                    $ln =  $mysqli -> real_escape_string ($_POST['lastName']);
                    $st =  $mysqli -> real_escape_string ($_POST['signatory_type']);
                    $e =  $mysqli -> real_escape_string ($_POST['email']);
                    $cd =  $mysqli -> real_escape_string ($_POST['college_id']);
                    $p =  $mysqli -> real_escape_string ($_POST['password']);
                    $oid =  $mysqli -> real_escape_string ($_POST['orgid']);
                    $pp = "img_avatar.png";
                    $ul = "3";
                    $duplicate = mysqli_query($conn, "SELECT * FROM tb_signatories WHERE school_id='$si' OR EMAIL='$e'");
                    if (mysqli_num_rows($duplicate) > 0) {
                      $_SESSION["sweetalert"] = [
                        "title" => "Error",
                        "text" => "Error in making an account.",
                        "icon" => "error", //success,warning,error,info
                        "redirect" => "admin-signatory-reg.php",
                      ];
                    } else {
                      try {
                        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO tb_signatories(school_id, first_name, last_name, signatorytype_id, email, password, college_dept, org_id, account_created, profile_pic, usertype_id)
                                    VALUES('$si', '$fn', '$ln', '$st', '$e', SHA('$p'), NULLIF('$cd',''), NULLIF('$oid',''), NOW(), '$pp', '$ul')";
                        $conn->exec($sql);
                                          $_SESSION["sweetalert"] = [
                                              "title" => "Signatory Created",
                                              "text" => "Successfully made an account.",
                                              "icon" => "success", //success,warning,error,info
                                              "redirect" => "admin-signatory-reg.php",
                                          ];
                      } catch (PDOException $e) {
                        echo $sql . "
                                              " . $e->getMessage();
                      }
                      $conn = null;
                    }
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>


        </div>
        <!--   <div class="col">
        Card with right text alignment
          <div class="card text-end">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some dummy text to make up the card's content. You can replace it anytime.</p>
              <a href="#" class="btn btn-primary">Know more</a>
            </div>
          </div>
        </div>
      </div> -->

        <!-- Footer -->
        <div id="layoutAuthentication_footer">
          <footer class="py-2 bg-light mt-3">
            <div class="container-fluid px-4">
              <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Modern Coders 2022</div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>

    <script>
      /*  document.getElementById('showme').addEventListener('change', function () {
          var style = this.value == "Student Adviser" ? 'block' : 'none';
          document.getElementById('orghide').style.display = style;
      });*/

      function showDiv(select) {
        if (select.value == "1") {
          document.getElementById('orghide').style.display = "none";
        } else {
          document.getElementById('orghide').style.display = "block";
        }
      }
    </script>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- Sidebar collapse -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('.btn-primary');
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
    </script>
    <!--email generator-->
    <script>
      $("#txtTest, #txtTest2").on('input', function() {
        var fname = $("#txtTest").val().toLowerCase().replace(/\s/g, '');
        var lname = $("#txtTest2").val().toLowerCase().replace(/\s/g, '');
        $("#email").attr("value", fname + "." + lname + "@jru.edu");
      });
    </script>
    <!--input mask-->
    <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../assets/js/inputmask-validation.js"></script>

    <!--Uppercase first letter !-->
    <script src="../assets/js/uppercase-firstletter.js"></script>

    <!--password validation!-->
    <script src="../assets/js/pass-validation.js"></script>

    <!-- age validation !-->
    <script src="../assets/js/age-validation.js"></script>
    <?php
      include('include/sweetalert.php');
    ?>
</body>

</html>