<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Site Management", "", ""],
  ["Organizations", "", ""],
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
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4 id="orgtitle">Student Organizations</h4>
        </div>
       <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
          <a class="btn btn-default btn-circle button px-3" href="admin-orgs-review.php" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">Applications </span></a>
          <a class="btn btn-secondary bg-secondary btn-circle button px-3 ms-2" href="admin-orgs-archive.php" role="button"><i class="bi bi-archive-fill"></i> <span id="btntitle"> Org Archive</span></a>
        </div>
      </div>

      <div class="row ms-3 me-3 mt-2 justify-content-between">
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-success">
            <div class="inner">
              <h2><?php $query = "SELECT COUNT(ORG) FROM tb_orgs WHERE org_type_id = 1";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h2>
              <p>Academic</p>
            </div>
            <div class="icon">
              <i class="bi bi-book-fill"></i>
            </div>
            <a href="admin-orgs-acad.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter done">
            <div class="inner">
              <h2><?php $query = "SELECT COUNT(ORG) FROM tb_orgs WHERE org_type_id = 2";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h2>
              <p>Non-Academic</p>
            </div>
            <div class="icon">
            <i class="bi bi-dice-5-fill"></i>
            </div>
            <a href="admin-orgs-non.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter masterlist">
            <div class="inner">
              <h2><?php $query = "SELECT COUNT(ORG) FROM tb_orgs";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h2>
              <p>Org Masterlist</p>
            </div>
            <div class="icon">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <a href="admin-orgs-master.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-info">
            <div class="inner">
              <h2><i class="bi bi-plus-circle"></i></h2>
              <p>Org Registration</p>
            </div>
            <div class="icon">
            <i class="bi bi-plus-circle-fill"></i>
            </div>
            <a href="admin-orgs-reg.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>


    </div>

  <?php @mysqli_close($conn); ?>
  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <!-- Sidebar collapse -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });
    });
  </script>

<?php
  include('include/sweetalert.php');
?>
</body>

</html>
