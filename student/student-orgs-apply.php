<?php
ob_start();
session_start();

include('../router.php');
route(1);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(1, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
  ["Home", "student-index.php", "bi-house-fill"],
  ["Organizations", "student-orgs.php", ""],
  ["Application", "", ""],
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
  <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico" />
  <title>JRU Student Organizations Portal</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="form" name="form" data-parsley-validate data-parsley-trigger="keyup" data-parsley-validate class="requires-validation" enctype="multipart/form-data" novalidate>
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Application for Student Organization</h3>

                  <!-- <form class="was-validated"> -->
                  <div class="row justify-content-between">
                    <!-- <div class="col-12 col-md-4  mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" for="schoolId" id="asterisk">Org ID</label>
                                        <input type="text" name="schoolId" id="schoolId" class="form-control" placeholder="##-###### " required />
                                        <div class="valid-feedback"> </div>
                                      </div>
                                    </div>-->


                    <div class="col-12 col-md-4  mb-4">
                      <label class="form-label" id="asterisk">Organization Type</label>
                      <select class=" form-select" name="org_type" id="showme" required>
                        <option class="greyclr" selected disabled value="">Select Type</option>
                        <option value="Academic">Academic</option>
                        <option value="Non-Academic">Non-Academic</option>
                      </select>
                    </div>

                    <div class="col-12 col-md-6  mb-4">
                      <label class="form-label" id="asterisk">School Year</label>
                    <input type="text" name="schoolyear" id="schoolyear" placeholder="####-####" class="form-control"  required="" />
                    </div>
                  </div>
                  <div class="row justify-content-between">
                    <div class="col-12 col-md-12 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="orgname" id="asterisk">Organization name</label>
                        <input type="text" name="orgname" id="orgname" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="100" class="form-control form-control-lg" required="" />
                        <div class="valid-feedback"></div>
                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                      </div>
                    </div>
                  <!--    <div class="col-12 col-md-6  mb-4">
                      <div class="form-outline">

                        <label class="form-label" for="lastName">Abbreviation</label>
                        <input type="text" name="abbrev" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="10" oninput="this.value = this.value.toUpperCase()" class="form-control form-control-lg" />
                        <div class="valid-feedback"> </div>
                      <div class="invalid-feedback">Last name field invalid!</div>
                      </div>
                    </div>-->
                  </div>
                  <div class="row mb-0">
                    <div class="col-12 col-md-12 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="reqfiles">Requirements</label>
                        <input class="form-control mt-2" name="reqfiles" id="reqfiles" type="file" accept=".zip,.rar,.7zip" required>
                      </div>
                    </div>
                      <!--<div class="col-12 col-md-6  mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="lastName" id="asterisk">Organization Logo</label>
                        <input class="form-control mt-2" name="orgpic" id="orgpic" type="file" accept="image/*" id="orgpic" required single>
                        <div class="valid-feedback"> </div>
                    <div class="invalid-feedback">Last name field invalid!</div>
                      </div>-->
                    </div>

                    <div class="col-12 col-md-10 col-sm-3 mb-4">
                      <small class="text-muted">*Note: Upload a zip file containing necessary documents in this form that will support your request <br>
                        1. Application for student organization form<br>
                        2. Certified true copy of constitution and by-laws for new organizations/reviewed by-laws by organizations renewing their recognition<br>
                        3. Certificate of good standing and performance of incumbent officers signed by the advisers and department chair <br>
                        4. List of Ad-Hoc committee for the coming school year <br>
                        5. Recommendation of Advisers (maximum of three);<br>
                          a. Academic Organizations cleared by the Department Chair and approved by the Dean of the College<br>
                          b. Non-Academic Organization and approved by Director of Student Development Office.<br>
                      </small>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 mt-0 mb-4">
                    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Apply Organization</button>

                  </div>

                  <?php
                  if (isset($ot) || isset($sy) || isset($org) || isset($destination) || isset($_POST['submit'])) {
                    $st = "Pending";
                    $org =  $mysqli -> real_escape_string ($_POST['orgname']);
                    $duplicate=mysqli_query($conn,"SELECT * FROM tb_org_application WHERE org_name='$org' AND status = '$st'");
                                    if (mysqli_num_rows($duplicate)>0)
                                    {
                                      $_SESSION["sweetalert"] = [
                                          "title" => "Fail Request",
                                          "text" => "Organization already Requested!",
                                          "icon" => "error", //success,warning,error,info
                                          "redirect" => null,
                                      ];
                                    }
                                    else{
                    $ot =  $mysqli -> real_escape_string ($_POST['org_type']);
                    $sy = $_POST['schoolyear'];

                    $pname = rand(1000, 100000) . "-" . $_FILES['reqfiles']['name'];
                    $destination = '../admin/attachments/' . $pname;
                    $tname = $_FILES['reqfiles']['tmp_name'];
                    $rq = $_SESSION['USER-NAME'];
                    move_uploaded_file($tname, $destination);
                    try {
                      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      if ($ot == "Non-Academic") {
                        $otid = 2;
                        $st = "Pending";
                        $sql = "INSERT INTO tb_org_application(org_name, org_type, school_year, requirements, status, requested_by, date_requested) VALUES('$org', '$otid', '$sy', '$pname', '$st', '$rq', NOW())";
                        $conn->exec($sql);
                        $_SESSION["sweetalert"] = [
                          "title" => "Organization Requested",
                          "text" => "Successfully requested Renewal of Organization",
                          "icon" => "success", //success,warning,error,info
                          "redirect" => null,
                        ];
                      } else {
                        $otid = 1;
                        $st = "Pending";
                        $sql = "INSERT INTO tb_org_application(org_name, org_type, school_year, requirements, status, requested_by, date_requested) VALUES('$org', '$otid', '$sy', '$pname', '$st', '$rq', NOW())";
                        $conn->exec($sql);
                        $_SESSION["sweetalert"] = [
                          "title" => "Organization Requested",
                          "text" => "Successfully requested Renewal of Organization",
                          "icon" => "success", //success,warning,error,info
                          "redirect" => null,
                        ];
                      }
                    } catch (PDOException $e) {
                      echo $sql . "
                                              " . $e->getMessage();
                    }
                    $conn = null;
                    //}
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
      document.getElementById('showme').addEventListener('change', function() {
        var style = this.value == "Academic" ? 'block' : 'none';
        document.getElementById('orghide').style.display = style;
      });
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
    Prevent Cut Copy Paste
    <script>
      $(document).ready(function() {
        $('input:text').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });

      });
    </script>-->
    <!--input mask-->
    <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../assets/js/inputmask-validation.js"></script>

    <!--Uppercase first letter !-->
    <script src="../assets/js/uppercase-firstletter.js"></script>

    <!--password validation!-->
    <script src="../assets/js/pass-validation.js"></script>

    <!-- age validation !-->
    <script src="../assets/js/age-validation.js"></script>
    <?php include("include/sweetalert.php") ?>
    </body>

    </html>
