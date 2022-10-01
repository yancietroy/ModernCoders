<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} elseif (!isset($_SESSION['use'])) { // If session is not set then redirect to Login Page
    header("Location:../admin-login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JRU Student Organizations Portal</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
  <!-- calendar!-->
  <script src="../assets/js/main.min.js"></script>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/main.min.css">
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="admin-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
      <li>
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
              <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
            </li>
            <li>
              <a href="admin-signatories.php"><i class="bi bi-person-check-fill"></i> <span>Signatories</span></a>
            </li>
            <li>
              <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
            </li>
          </ul>
        </li>
        <li class="active">
          <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
          <ul class="collapse list-unstyled" id="orgsSubmenu">
            <li class="active">
              <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
          </li>
          <li>
              <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
          </li>
          <li>
              <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
            </li>
        </ul>
      </li>
      <li>
        <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
      </li>
      <li>
        <a href="admin-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
      </li>
      <li class="d-lg-none">
        <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>
      </li>

      </ul>
      <!-- nav footer?
      <ul class="list-unstyled CTAs">
        <li>
          <a>about</a>
        </li>
        <li>
          <a>logout</a>
        </li>
      </ul> -->
    </nav>
    <!-- Navbar  -->
    <div id="content">

      <nav class="navbar shadow navbar-expand navbar-light bg-light" aria-label="navbar" id="topbar">
        <div class="container-fluid">
          <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell me-lg-2 mt-2" style="width:  25px; height:  25px;"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle me-lg-2" src="../assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
$result = @mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
if ($row) {
    echo "$row[0]";
} ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="admin-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../admin-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="admin-orgs-comsoc.php"> <i class="bi bi-people-fill"></i> COMSOC</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"><i class="bi bi-calendar3"></i> Event Calendar</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7  mb-4">
          <h3>Event Calendar</h3>
        </div>
      <div class="container-fluid" id="page-container">
          <div class="row">
              <div class="col-md-12">
                  <div id="calendar"></div>
              </div>
            <!--<div class="col-md-3">
                  <div class="cardt rounded-0 shadow">
                      <div class="card-header bg-gradient bg-primary text-light">
                          <h5 class="card-title">Schedule Form</h5>
                      </div>
                      <div class="card-body">
                          <div class="container-fluid">
                              <form action="save_schedule.php" method="post" id="schedule-form">
                                  <input type="hidden" name="project_id" value="">
                                  <div class="form-group mb-2">
                                      <label for="project_name" class="control-label">Event Name</label>
                                      <input type="text" class="form-control form-control-sm rounded-0" name="project_name" id="project_name" required>
                                  </div>
                                  <div class="form-group mb-2">
                                      <label for="project_desc" class="control-label">Description</label>
                                      <textarea rows="3" class="form-control form-control-sm rounded-0" name="project_desc" id="project_desc" required></textarea>
                                  </div>
                                  <div class="form-group mb-2">
                                      <label for="start_date" class="control-label">Start Date</label>
                                      <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_date" id="start_date" required>
                                  </div>
                                  <div class="form-group mb-2">
                                      <label for="end_date" class="control-label">End Date</label>
                                      <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_date" id="end_date" required>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <div class="card-footer">
                          <div class="text-center">
                              <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                              <button class="btn btn-secondary border btn-sm rounded-0" type="reset" form="schedule-form"> Cancel</button>
                          </div>
                      </div>
                  </div>
              </div>-->
          </div>
      </div>
      <!-- Event Details Modal -->
      <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-0">
                  <div class="modal-header rounded-0">
                      <h5 class="modal-title">Schedule Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body rounded-0">
                      <div class="container-fluid">
                          <dl>
                              <dt class="text-muted">Event Name</dt>
                              <dd id="project_name" class="fw-bold fs-4"></dd>
                              <dt class="text-muted">Description</dt>
                              <dd id="project_desc" class=""></dd>
                              <dt class="text-muted">Start Date</dt>
                              <dd id="start" class=""></dd>
                              <dt class="text-muted">End Date</dt>
                              <dd id="end" class=""></dd>
                          </dl>
                      </div>
                  </div>
                  <div class="modal-footer rounded-0">
                      <div class="text-end">
                        <!--  <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>-->
                          <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                          <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Event Details Modal -->

    <?php
    $schedules = $conn->query("SELECT * FROM `tb_projectmonitoring` WHERE status='Approved' OR status='Ongoing'");
$sched_res = [];
foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_date']));
    $row['edate'] = date("F d, Y h:i A", strtotime($row['end_date']));
    $sched_res[$row['project_id']] = $row;
}
?>
    <?php
if (isset($conn)) {
    $conn->close();
}
?>
    </body>
    <script>
      var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
    <script src="../assets/js/eventcalendar.js"></script>


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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!--WAVES CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>

</body>

</html>
