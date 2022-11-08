<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Projects";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
  ["Discussion Board", "forum-user.php", ""],
  ["Create New Topic", "create-topic.php", "bi-plus-circle-fill"],
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
      <form action="" method="post" class="requires-validation" enctype="multipart/form-data" autocomplete="off" data-parsley-validate data-parsley-trigger="keyup" data-parsley-errors-messages-disabled parsley-use-html5-constraints>
        <div class="row ms-3 me-3 mt-2">
          <div class="col-lg-6 col-6  mb-4">
            <h4>Create New Topic</h4>
          </div>
        </div>
        <div class="wrap shadow px-5 py-4 mx-auto mb-4">
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4 mt-4">
              <div class="form-outline">
                <label class="form-label" for="project_name" id="asterisk">Topic name:</label>
                <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" maxlength="50" required />
                <div class="valid-feedback"></div>

              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <label class="form-label select-label" for="project_type" id="asterisk">Topic Icon:</label>
              <select class="mt-0 ms-0 form-select" name="project_type" id="project_type" required>
                <option value="bi bi-chat-square-dots-fill">Discussion</option>
                <option value="bi bi-clipboard-fill">Reminder</option>
                <option value="bi bi-megaphone-fill">Announcement</option>
                <option value="bi bi-lightning-charge-fill">Introduction</option>
              </select>
              <div class="valid-feedback"> </div>

            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <label class="form-label select-label" for="project_category" id="asterisk">Category:</label>
              <select class="mt-0 ms-0 form-select" name="project_category" id="project_category" required>
                <option value="1">General</option>
                <option value="2">Organization</option>
                <option value="3">Officers</option>
              </select>
              <div class="valid-feedback"> </div>
            </div>


          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="objectives" id="asterisk">Description:</label>
                <textarea class="form-control" name="objectives" id="objectives" rows="3" placeholder="Enter topic description" required></textarea>
                <div class="valid-feedback"></div>
              </div>
            </div>
          <!--  <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="budget_req" id="asterisk">Budget Request:</label>
                <textarea class="form-control" name="budget_req" id="budget_req" rows="6" placeholder="Enter details of budget breakdown." required></textarea>
                <div class="valid-feedback"></div>
              </div>
            </div>
              <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="estimated_budget" id="asterisk">Estimated Budget:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" pattern="[0-9.,]+" class="form-control" name="estimated_budget" id="estimated_budget" required data-type="number" data-parsley-errors-container=".invalid-feedback" data-parsley-required required/>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback"></div>
                </div>

              </div>
            </div>-->
          </div>

          <!--<div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label mb-2" for="attachments" id="asterisk">Upload Attachments:</label>
                <input class="form-control mt-3" name="attachments" id="attachments" type="file" accept=".zip,.rar,.7zip" id="formFileMultiple" required>
                <div class="valid-feedback"></div>
              </div>
            </div>
            <div class="col-12 col-md-8 col-sm-3 mb-4">
              <small class="text-muted">*Note: Upload a zip file containing necessary documents in this form that will support your request
                (invitation letter, quotation of provider, Program of the Activity etc.) <br>

                *Note: Please attach other request form/ file
                (Facility Request, Announcement Request, Service/ Guest Pass, etc.) <br>
                *Note: Please be mindful about submitting project proposals during exam week</small>
            </div>-->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <input class="btn btn-lg btn-outline-info" type="reset" value="Reset">
              <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit">
            </div>
          </div>
        </div>
        <?php
        $mysqli = new mysqli("$servername","$username","$password","$database");

        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }

        if (isset($pn) || isset($vn) || isset($pt) || isset($sdate) || isset($edate) || isset($o) || isset($pc)   || isset($p) || isset($obj) ||  isset($br) || isset($eb) || isset($_POST['submit'])) {
        // Escape special characters, if any
          $pn = $mysqli -> real_escape_string ($_POST['project_name']);
          $o = $mysqli -> real_escape_string ($_POST['organizer']);
          $vn = $mysqli -> real_escape_string ($_POST['venue']);
          $pt = $mysqli -> real_escape_string ($_POST['project_type']);
          $sdate = $mysqli -> real_escape_string ($_POST['start_date']);
          $edate = $mysqli -> real_escape_string ($_POST['end_date']);
          $pc = $mysqli -> real_escape_string ($_POST['project_category']);
          $p = $mysqli -> real_escape_string ($_POST['participants']);
          $obj = $mysqli -> real_escape_string ($_POST['objectives']);
          $br = $mysqli -> real_escape_string ($_POST['budget_req']);
          $eb = $mysqli -> real_escape_string ($_POST['estimated_budget']);
          $s = "Pending";
          $aid = '1';
          $userName = $_SESSION['USER-NAME'];
          $posID = $_SESSION['USER-POS'];

          $pname = rand(1000, 100000) . "-" . $_FILES['attachments']['name'];
          $destination = 'attachments/' . $pname;
          $tname = $_FILES['attachments']['tmp_name'];
          move_uploaded_file($tname, $destination);

          $query = "INSERT INTO tb_projectmonitoring(project_name, organizer, venue, project_type, start_date, end_date, project_category, participants, objectives, budget_req, estimated_budget, date_submitted, status, attachments, status_date, requested_by, org_id, position_id, approval_id) VALUES('$pn', '$o', '$vn', '$pt', '$sdate', '$edate', '$pc', '$p', '$obj', '$br', '$eb', NOW(), '$s', '$pname', NOW(), '$userName', '$orgid', '$posID', '$aid')";
          $result = @mysqli_query($conn, $query);

          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Project Created',
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
