<?php
ob_start();
session_start();

include('../router.php');
route(1);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(1, $data_userid);
$nav_selected = "Home";
$nav_breadcrumbs = [
  ["Home", "student-index.php", "bi-house-fill"],
  ["Join Org", "", ""],
];

$checkq = mysqli_query($conn, "SELECT * FROM tb_requests WHERE student_id = '$data_userid'");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datepicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
      <?php
        if (mysqli_num_rows($checkq) > 0 ) {
          echo "<script type='text/javascript'>
                Swal.fire({
                          icon: 'error',
                          title: 'Side Organization Exists',
                          text: 'You cannot join another student organization',
                          confirmButtonColor: '#F2AC1B'
                         }).then(function(){
                            window.location = 'student-index.php';
                          });
                          </script>";
          }else{
      ?>
      <form action="" method="post" class="requires-validation" enctype="multipart/form-data" autocomplete="off" data-parsley-validate data-parsley-trigger="keyup" data-parsley-errors-messages-disabled parsley-use-html5-constraints>
        <div class="wrap shadow px-5 py-4 mx-auto mb-4">
          <div class="row ms-3 me-3 text-center ">
            <div class="col-lg-12 col-12">
              <h7 id="titlejru">Jose Rizal University</h7>
            </div>
          </div>
          <div class="row ms-3 me-3 text-center mb-2">
            <div class="col-lg-12 col-12  mb-4">
              <h3 id="titleproj">Organization Application Form</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <label class="form-label select-label" id="asterisk">Organization</label>
              <select class="form-select form-select-md" name="org_id" id="org_id" required>
                <option class="greyclr" selected disabled value="" text-muted>Select Organization</option>
                <?php
                  $query = "SELECT ORG, ORG_ID FROM tb_orgs WHERE org_type_id = 2";
                  $result = @mysqli_query($conn, $query);
                  while ($data = @mysqli_fetch_array($result)) {
                    echo '<option value="' . $data[1] .  '" >' . $data[0] . '</option>';
                }
                ?>
              </select>
            </div>
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="reason" id="asterisk">Reason to join org:</label>
                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Why do you want to join this organization?" required></textarea>
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-10 col-sm-3 mb-4">
              <small class="text-muted">*Note: Submitting this form will include your current student details and is subject for approval <br>
              </small>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <input class="btn btn-lg btn-outline-info" type="reset" value="Reset">
              <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit">
            </div>
          </div>
        </div>
        <?php
          }
        $mysqli = new mysqli("$servername","$username","$password","$database");
        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }
        if (isset($sorg_id) || isset($r) ||  isset($_POST['submit'])) {
        // Escape special characters, if any
          $sorg_id = $_POST['org_id'];
          //$sorg_id = ',[' . $_POST['org_id'] . ']';
          $r = $mysqli -> real_escape_string ($_POST['reason']);
          $rq = "Pending";
          $userName = $_SESSION['USER-NAME'];

          //$query = "UPDATE tb_students SET `ORG_IDS` = '$sorg_id' WHERE STUDENT_ID = '$data_userid'";
          //$result = @mysqli_query($conn, $query);

          $query = "INSERT INTO tb_requests(org_id, student_id, name, reason, req_status, date_submitted) VALUES('$sorg_id', '$data_userid', '$userName', '$r', '$rq', NOW())";
          $result = @mysqli_query($conn, $query);

          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Application Submited!',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";

          @mysqli_close($conn);
        }
        ?>
      </form>
      <!-- Footer -->
      <div id="layoutAuthentication_footer">
        <footer class="py-2 bg-light">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Modern Coders 2022</div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
    <script src="../assets/js/date.js"></script>
    <!-- Datepicker cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(document).ready(function() {
        $('#start_date').datetimepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          formatTime: 'H:i',
          formatDate: 'm.d.Y',
          minDate: new Date()
        });

        $('#end_date').datetimepicker({
          dateFormat: "dd-M-yy",
          minDate: 0
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $('#start_date').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });
        $('#end_date').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });
      });
    </script>
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }

    $('#estimated_budget').keydown(function(e) {
  setTimeout(() => {
    let parts = $(this).val().split(".");
    let v = parts[0].replace(/\D/g, ""),
      dec = parts[1]
    let calc_num = Number((dec !== undefined ? v + "." + dec : v));
    // use this for numeric calculations
    // console.log('number for calculations: ', calc_num);
    let n = new Intl.NumberFormat('en-EN').format(v);
    n = dec !== undefined ? n + "." + dec : n;
    $(this).val(n);
  })
})
    </script>
</body>

</html>
