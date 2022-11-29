<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_username = $_SESSION['USER-NAME'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Projects";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
  ["Projects", "officer-projects.php", ""],
  ["Budget Codes", "budget-codes.php", ""],
    ["New", "", ""],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- waves CSS CDN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datebicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimebicker/2.5.20/jquery.datetimebicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
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
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">New Budget Code</h3>

                  <!-- <form class="was-validated"> -->
                  <!--   <div class="row justify-content-between">
                                    <div class="col-12 col-md-4  mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" for="schoolId" id="asterisk">Org ID</label>
                                        <input type="text" name="schoolId" id="schoolId" class="form-control" placeholder="##-###### " required />
                                        <div class="valid-feedback"> </div>
                                      </div> college id is auto increment
                                    </div>


                                    <div class="col-12 col-md-4  mb-4">
                                      <label class="form-label" id="asterisk">Organization Type</label>
                                      <select class=" form-select" name="signatory_type" id="showme" required>
                                        <option class="greyclr" selected disabled value="">Select Type</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Non-Academic">Non-Academic</option>
                                      </select>
                                  </div>

                                  <div class="col-12 col-md-4  mb-4" style='display:none;' id="orghide">
                                  <label class="form-label" id="asterisk">Assign Position</label>
                                  <select class="form-select" style="width:100%;" name="COURSE" id="COURSE" >
                                    <option class="greyclr" selected disabled value="">Select Position</option>
                                    <? php/*
                                          $query = "SELECT course FROM tb_course";
                                          $result = @mysqli_query($conn, $query);
                                          while($data = @mysqli_fetch_array($result)) {
                                              echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                          }
                                    */ ?>
                                  </select>
                              </div>
                                    </div>-->
                  <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="code" id="asterisk">Budget Code</label>
                        <input type="text" name="code" ="code" onkeypress=\"return /[0-9]/i.test(event.key)\" maxlength="5" class="form-control" required />
                        <div class="valid-feedback"></div>
                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="description" id="asterisk">Budget Description</label>
                        <input type="text" name="description" id="description"    maxlength="50" class="form-control" required />
                        <div class="valid-feedback"></div>
                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                      </div>
                    </div>
                    <!--  <div class="col-12 col-md-12  mb-4">
                                    <label class="form-label" id="asterisk">Assign College</label>
                                    <select class="form-select" style="width:100%;" name="college_id" id="college_id">
                                      <option class="greyclr" selected disabled value="">Select College</option>
                                      <? php/*
                                           $query = "SELECT * FROM tb_collegedept";
                                           $result = @mysqli_query($conn, $query);
                                           while($data = @mysqli_fetch_array($result)) {
                                               echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                            }
                                      */ ?>
                                    </select>
                                </div>
                                    <div class="col-12 col-md-6  mb-4">
                                      <div class="form-outline">

                                        <label class="form-label" for="lastName" id="asterisk">Abbreviation</label>
                                        <input type="text" name="lastName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="10"  oninput="this.value = this.value.toUpperCase()" class="form-control form-control-lg" required />
                                        <div class="valid-feedback"> </div>
                                        <div class="invalid-feedback">Last name field invalid!</div>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="row mb-0">
                                      <div class="col-12 col-md-6 col-sm-3 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" for="orgname" id="asterisk">Assign Student Adviser</label>
                                          <select class="form-select" style="width:100%;" name="Signatory" id="Signatory" >
                                            <option class="greyclr" selected disabled value="">Select Adviser</option>
                                            <? php/*
                                                  $query = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM tb_signatories WHERE signatory_type='Adviser'";
                                                  $result = @mysqli_query($conn, $query);
                                                  while($data = @mysqli_fetch_array($result)) {
                                                      echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                                  }
                                          */  ?>
                                          </select>
                                      </div>
                                    </div>
                                      <div class="col-12 col-md-6  mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" for="lastName" id="asterisk">Organization Logo</label>
                                          <input class="form-control" name="attachments" id="orgpic" type="file" accept="image/*"/ id="orgpic" required single>
                                          <div class="valid-feedback"> </div>
                                        </div>-->
                    <!--<div class="invalid-feedback">Last name field invalid!</div>    </div>-->

                  </div>
                  <div class="col-12 col-md-12 mt-0 mb-4">
                    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Create</button>

                  </div>


                  <?php
                  if (isset($code) || isset($desc) || isset($_POST['submit'])) {
                    $code =  $mysqli -> real_escape_string ($_POST['code']);
                      $desc =  $mysqli -> real_escape_string ($_POST['description']);

                    /*$duplicate=mysqli_query($conn,"SELECT * FROM tb_orgs WHERE ORG='$org'");
                                  $mDuplicate=mysqli_query($conn,"SELECT * FROM tb_morg WHERE MOTHER_ORG='$org'");
                                  if (mysqli_num_rows($duplicate)>0)
                                  {
                                    echo "<script type='text/javascript'>
                                          alert('Organization already exists!')
                                          window.location.href='admin-orgs-reg.php'
                                          </script>";
                                  }else if (mysqli_num_rows($mduplicate)>0)
                                  {
                                    echo "<script type='text/javascript'>
                                          alert('Organization already exists!')
                                          window.location.href='admin-orgs-reg.php'
                                          </script>";
                                  }
                                  else{*/
                    try {
                      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = "INSERT INTO tb_budget_codes(code,description) VALUES('$code','$desc')";
                      $conn->exec($sql);
                      echo "<script type='text/javascript'>
                                        Swal.fire({
                                             icon: 'success',
                                             title: 'Budget Code Created',
                                             confirmButtonColor: '#F2AC1B'

                                         })
                                          </script>";
                    } catch (PDOException $e) {
                      echo $sql . "
                                              " . $e->getMessage();
                    }
                    $conn = null;
                    //}
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

</body>

</html>