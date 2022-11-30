<?php
ob_start();
session_start();

include('../router.php');
route(2);

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
    header('location:officer-orgs.php');
  }
}

$_SESSION['ORG'] = $orgName;
$_SESSION['ORG_ID'] = $orgid;

$logoPic = getOrgLogo($orgid);
$data_userid = $_SESSION['USER-ID'];
$data_orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  ["List", "", "bi bi-card-list"],
  ["$orgName", "", ""],
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
      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h4 id="rsotitle">Student Organizations Management</h4>
        </div>
      </div>
      <div class="row justify-content-center align-items-center text-align-center">
        <div class="col-12 col-lg-10 col-xl-11">
          <div class="card shadow border-0 rounded-lg mb-4 mx-4 w-80 justify-content-center align-items-center text-align-center">
            <div class="card-body p-4 mx-auto px-auto">
              <div class="row g-0 ">
                <div class="col-md-2 d-none d-sm-block text-center">
                  <img src="<?= $logoPic; ?>" class="rounded-circle logo_img " alt="...">
                </div>
                <div class='col-12 col-md-10 pt-4'>
                  <h3 class="justify-content-center align-items-center text-center"><?= "$orgName"; ?></h3>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="row ms-3 me-3">
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter primary">
            <div class="inner">
              <h2><i class="bi bi-file-person"></i></h2>
              <p>Members</p>
            </div>
            <div class="icon">
              <i class="bi bi-file-person"></i>
            </div>
            <a href="officer-orgs-rso-members.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-warning">
            <div class="inner">
              <h2><i class="bi bi-person-badge"></i></h2>
              <p>Officers</p>
            </div>
            <div class="icon">
              <i class="bi bi-person-badge"></i>
            </div>
            <a href="officer-orgs-rso-officers.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-info">
            <div class="inner">
              <h2><i class="bi bi-person-rolodex"></i></h2>
              <p>Signatories</p>
            </div>
            <div class="icon">
              <i class="bi bi-person-rolodex"></i>
            </div>
            <a href="officer-orgs-rso-signatories.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6" id="eventhide">
          <div class="card-counter events">
            <div class="inner">
              <h2><i class="bi bi-calendar3"></i></h2>
              <p>Event Calendar</p>
            </div>
            <div class="icon">
              <i class="bi bi-calendar3-fill"></i>
            </div>
            <a href="rso-event-calendar.php?id=<?= $orgid ?>" class=" card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-danger">
            <div class="inner">
              <h3><i class="bi bi-file-bar-graph"></i></h3>
              <p>Survey</p>
            </div>
            <div class="icon">
              <i class="bi bi-file-bar-graph-fill" aria-hidden="true"></i>
            </div>
            <a href="officer-rso-survey.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4 d-none">
          <div class="card-counter done">
            <div class="inner">
              <h3><i class="bi bi-inbox"></i></h3>
              <p>Forum</p>
            </div>
            <div class="icon">
              <i class="bi bi-inbox-fill"></i>
            </div>
            <a href="forum-user.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
          <div class="card-counter bg-success">
            <div class="inner">
              <h3><i class="bi bi-folder"></i></h3>
              <p>Projects</p>
            </div>
            <div class="icon">
              <i class="bi bi-folder-fill"></i>
            </div>
            <a href="officer-rso-projects.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter masterlist">
            <div class="inner">
              <h3> <i class="bi bi-card-heading"></i></h3>
              <p>Org Profile</p>
            </div>
            <div class="icon">
            <i class="bi bi-card-heading"></i>
            </div>
            <a href="officer-rso-profile.php?id=<?= $orgid ?>" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
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
    Waves.attach('.button');
    Waves.init();
  </script>
  <!-- JavaScript validation -->
  <script src="../assets/js/bootstrap-validation.js"></script>


</body>

</html>
