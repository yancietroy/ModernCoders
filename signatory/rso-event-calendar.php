<?php
ob_start();
session_start();

include('../router.php');
route(3);

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
    header('location:signatory-orgs.php');
  }
}

$data_userid = $_SESSION['USER-ID'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
$data_orgid = $_SESSION['USER-ORG'];
$data_collegeid = $_SESSION['USER-COLLEGE'];
$collName = "";
$_SESSION['college'] = $collName;
$query = "SELECT college FROM tb_collegedept WHERE college_id='$data_collegeid'";
if ($collRes = @mysqli_query($conn, $query)) {
  if ($collRes->num_rows > 0) {
    $row = $collRes->fetch_assoc();
    $collName = $row['college'];
  }
}
$data_picture = getProfilePicture(3, $data_userid);
$nav_selected = "Organizations/ Organization";
$nav_breadcrumbs = [
  ["Home", "signatory-index.php", "bi-house-fill"],
  ["Organizations", "", "bi bi-diagram-3-fill"],
  ["$orgName", "signatory-orgs-rso.php?id=$orgid", ""],
  ["Event Calendar", "", ""],
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
  <!-- calendar!-->
  <script src="../assets/js/main.min.js"></script>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../assets/css/main.min.css">
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
        if($data_orgid == NULL)
        {
          $schedules = $conn->query("SELECT project_id,project_name,start_date, end_date  FROM `tb_projectmonitoring` WHERE status='Approved'");
        }
        else
        {
          $schedules = $conn->query("SELECT project_id,project_name,start_date, end_date  FROM `tb_projectmonitoring` WHERE org_id='$orgid' AND status='Approved'");
        }
        $sched_res = [];
        foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
          $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_date']));
          $row['edate'] = date("F d, Y h:i A", strtotime($row['end_date']));
          $sched_res[$row['project_id']] = $row;
        }
        ?>
        <?php
        if (isset($conn)) $conn->close();
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
