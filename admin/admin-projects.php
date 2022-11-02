<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = "";
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
  if ($orgRes->num_rows > 0) {
    $row = $orgRes->fetch_assoc();
    $orgName = $row['ORG'];
  } else {
    header('location:admin-orgs.php');
  }
}

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Site Management", "admin-users.php", ""],
  ["Organizations", "admin-orgs.php", ""],
  [$orgName, "admin-orgs-rso.php?id=$orgid", ""],
  ["Projects", "", ""],
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
  <!-- waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4>Project Monitoring</h4>
        </div>

        <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
          <a class="btn btn-secondary bg-secondary btn-circle button px-3 ms-2" href="admin-project-archive.php" role="button"><i class="bi bi-archive-fill"></i> <span id="btntitle"> Project Archive</span></a>
        </div>
      </div>
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter primary">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Pending') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Pending</p>
            </div>
            <div class="icon">
              <i class="bi bi-hourglass-top" aria-hidden="true"></i>
            </div>
            <a href="admin-pending.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card-counter success">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Approved') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Approved</p>
            </div>
            <div class="icon">
              <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
            </div>
            <a href="admin-approved.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card-counter danger">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Rejected') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Rejected</p>
            </div>
            <div class="icon">
              <i class="bi bi-trash-fill"></i>
            </div>
            <a href="admin-rejected.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-secondary">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Reschedule') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Reschedule</p>
            </div>
            <div class="icon">
              <i class="bi bi-clock-fill"></i>
            </div>
            <a href="admin-reschedule.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-info">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Ongoing') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Ongoing</p>
            </div>
            <div class="icon">
              <i class="bi bi-play-circle-fill" aria-hidden="true"></i>
            </div>
            <a href="admin-ongoing.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter done">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('Done') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>Done</p>
            </div>
            <div class="icon">
              <i class="bi bi-hand-thumbs-up-fill" aria-hidden="true"></i>
            </div>
            <a href="admin-done.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-sm-6 ">
          <div class="card-counter events">
            <div class="inner">
              <h3><?php $query = "SELECT COUNT(status) FROM tb_projectmonitoring WHERE status IN('For Revision') AND ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array($result);
                  if ($row) {
                    echo "$row[0]";
                  } ?></h3>
              <p>For Revision</p>
            </div>
            <div class="icon">
              <i class="bi bi-pencil-square"></i>
            </div>
            <a href="admin-revision.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-sm-6">
          <div class="card-counter masterlist">
            <div class="inner">
              <h3><i class="bi bi-list-ul"></i></h3>
              <p>Masterlist</p>
            </div>
            <div class="icon">
              <i class="bi bi-card-list" aria-hidden="true"></i>
            </div>
            <a href="admin-masterlist.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.attach('.button');
      Waves.init();
    </script>
</body>

</html>