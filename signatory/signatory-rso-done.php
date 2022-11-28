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
$nav_selected = "Organizations / Organization";
$nav_breadcrumbs = [
  ["Home", "signatory-index.php", "bi-house-fill"],
  ["Organizations", "", "bi bi-diagram-3-fill"],
  ["$orgName", "signatory-orgs-rso.php?id=$orgid", ""],
  ["Projects", "signatory-rso-projects.php?id=$orgid", ""],
  ["Done", "", ""],
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

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
          <h4>Officer Projects Done List</h4>
        </div>
      </div>
      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-2 pb-4">
          <div class="row g-0 mt-4 justify-content-center">
            <div class="table-responsive-md ms-0">
              <?php
              if ($data_signatorytype == 1) {
                $query = "SELECT * FROM tb_projectmonitoring WHERE status IN('Done') AND org_id = '$orgid'";
              } elseif ($data_signatorytype == 2) {
                $query = "SELECT * FROM tb_projectmonitoring WHERE status IN('Done') AND college_id = '$data_collegeid' AND org_id = '$orgid'";
              } elseif ($data_signatorytype == 3) {
                $query = "SELECT * FROM tb_projectmonitoring WHERE status IN('Done') AND college_id = '$data_collegeid' AND org_id = '$orgid'";
              } elseif ($data_signatorytype == 4) {
                $query = "SELECT * FROM tb_projectmonitoring WHERE status IN('Done') AND org_id = '$orgid'";
              }
              $result = @mysqli_query($conn, $query);
              $i = 0;
              $ds = " ";
              $pi = " ";
              $pn = " ";
              $v = " ";
              $s = " ";
              $pt = " ";
              $pc = " ";
              $pd = " ";
              $sd = " ";
              $ed = " ";
              $p = " ";
              $np = " ";
              $b = " ";
              $nb = " ";
              $bs = " ";
              $eb = " ";
              $a = " ";
              $r = " ";
              $or = " ";
              $std = " ";
              $rb = " ";
              $br = " ";
              $oid = " ";
              $pst = " ";
              echo "<table id='example' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                            <th class='desktop'>Project ID</th>
                            <th class='desktop'>Project Name</th>
                             <th class='none'>Venue</th>
                            <th class='desktop'>Status</th>
                            <th class='desktop'>Date Submitted</th>
                            <th class='desktop'>Actions</th>
                            <th class='none'>Date Done</th>
                            <th class='none'>Objectives</th>
                            <th class='none'>Project Category</th>
                            <th class='none'>Project Type</th>
                            <th class='none'>Start Date</th>
                            <th class='none'>End Date</th>
                            <th class='none'>Participants</th>
                            <th class='none'>Organizer</th>
                            <th class='none'>Requested By</th>
                            <th class='none'>Budget Request</th>
                            <th class='none'>Organization</th>
                            <th class='none'>Position</th>
                            <th class='none'>Estimated Budget</th>
                            <th class='none'>Attachment</th>
                            <th class='none'>Remarks</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
              if ($result !== false && $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $ds = $row['date_submitted'];
                  $pi = $row['project_id'];
                  $pn = $row['project_name'];
                  $v = $row['venue'];
                  $s = $row['status'];
                  $pt = $row['project_type'];
                  $obj = $row['objectives'];
                  $pd = $row['project_desc'];
                  $sd = $row['start_date'];
                  $ed = $row['end_date'];
                  $p = $row['participants'];
                  $or = $row['organizer'];
                  $std = $row['status_date'];
                  $rb = $row['requested_by'];
                  $br = $row['budget_req'];
                  $oid = $row['org_id'];
                  $pst = $row['position_id'];
                  $a = $row['attachments'];
                  $r = $row['remarks'];
                  $eb = $row['estimated_budget'];

                  echo "<tr>
                              <td> $pi  </td>
                              <td> $pn  </td>
                              <td> $v  </td>
                              <td> $s  </td>
                              <td> $ds </td>
                              <td>
                                <button type='button' title='project details' class='btn btn-success btn-sm editbtn' id='" . $pi . "'> <i class='bi bi-list-ul'></i> </button>
                                <button type='button' title='audit trail' class='btn btn-warning btn-sm text-white logbtn' id='" . $pi . "'> <i class='bi bi-clock-history'></i> </button>
                                <a type='button' class='btn btn-primary btn-sm' title='download attachment/s' href='downloadFiles.php?project_id=" . $pi . "'>  <i class='bi bi-download'></i> </a>
                              </td>
                              <td> $std  </td>
                              <td> $obj  </td>
                              <td> $pc  </td>
                              <td> $pt  </td>
                              <td> $sd </td>
                              <td> $ed </td>
                              <td> $p  </td>
                              <td> $or  </td>
                              <td> $rb  </td>
                              <td> $br  </td>
                              <td> $oid  </td>
                              <td> $pst  </td>
                              <td> $eb  </td>
                              <td> $a  </td>
                              <td> $r  </td>
                              </tr>
                          ";
                }
                echo "</tbody>
                        <tfoot>
                            <tr>
                            <th class='desktop'>Project ID</th>
                            <th class='desktop'>Project Name</th>
                             <th class='none'>Venue</th>
                            <th class='desktop'>Status</th>
                            <th class='desktop'>Date Submitted</th>
                            <th class='desktop'>Actions</th>
                            <th class='none'>Date Done</th>
                            <th class='none'>Objectives</th>
                            <th class='none'>Project Category</th>
                            <th class='none'>Project Type</th>
                            <th class='none'>Start Date</th>
                            <th class='none'>End Date</th>
                            <th class='none'>Participants</th>
                            <th class='none'>Organizer</th>
                            <th class='none'>Requested By</th>
                            <th class='none'>Budget Request</th>
                            <th class='none'>Organization</th>
                            <th class='none'>Position</th>
                            <th class='none'>Estimated Budget</th>
                            <th class='none'>Attachment</th>
                            <th class='none'>Remarks</th>
                            </tr>
                        </tfoot>
                        </table>";
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>
      </div>
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

  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Project Details: </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="signatory-update-button.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-4 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_id">Project ID:</label>
                    <input type="text" name="project_id" id="project_id" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
               </div>
                <div class="col-4 col-md-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="date_submitted">Date Submitted:</label>
                    <input type="text" name="date_submitted" id="date_submitted" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-4 col-md-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="status_date">Date Done:</label>
                    <input type="text" name="status_date" id="status_date" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_name">Project name:</label>
                    <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="organizer" id="asterisk">Organizer:</label>
                    <input type="text" name="organizer" id="organizer" class="form-control" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Project name field cannot be blank!</div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="venue">Venue:</label>
                    <input type="text" name="venue" id="venue" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="venue">Project Status:</label>
                    <input type="text" name="status" id="status" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <label class="form-label" for="status">Project status updated by:</label>
                  <input type="text" name="status" id="status_by" class="form-control" style="background-color: #fff;" readonly />
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="project_type">Project Type:</label>
                  <input type="text" name="project_type" id="project_type" class="form-control" style="background-color: #fff;" readonly />
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="project_category">Category:</label>
                  <input type="text" name="project_category" id="project_category" class="form-control " style="background-color: #fff;" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="start_date">Start Date:</label>
                    <input type="text" class="form-control" name="start_date" id="start_date" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="end_date">End Date:</label>
                    <input type="text" class="form-control" name="end_date" id="end_date" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="participants">Participants:</label>
                    <input type="text" name="participants" id="participants" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <!--<div class="col-12 col-md-6 col-sm-3 mb-4">
                             <div class="form-outline d-grid">
                               <label class="form-label">Download Attachment/s:</label>
                             <button type="button" class="btn btn-secondary btn-md">Download</button>
                             </div>
                           </div>

                           <div class="col-12 col-md-4 col-sm-3 mb-2">
                             <label class="form-label" for="budget_source" >Budget Source:</label>
                             <input type="text" name="budget_source" id="budget_source" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                           </div>
                           <div class="col-12 col-md-6 col-sm-3 mb-4">
                             <div class="form-outline">
                               <label class="form-label" for="beneficiary">Beneficiary:</label>
                               <input type="text" name="beneficiary" id="beneficiary" class="form-control form-control-md" style="background-color: #fff;" readonly/>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-12 col-md-3 col-sm-3 mb-4">
                             <div class="form-outline">
                               <label class="form-label" for="no_of_participants" >No. of Participants:</label>
                               <input type="text" name="no_of_participants" maxlength="4" id="no_of_participants" class="form-control" style="background-color: #fff;" readonly />
                             </div>
                             </div>
                             <div class="col-12 col-md-3 col-sm-3 mb-4">
                               <div class="form-outline">
                                 <label class="form-label" for="no_of_beneficiary">No. of Beneficiary:</label>
                                 <input type="text" name="no_of_beneficiary" maxlength="4" id="no_of_beneficiary" class="form-control" style="background-color: #fff;" readonly/>
                               </div>
                             </div>

                             <div class="col-12 col-md-3 col-sm-3 mb-4">
                               <div class="form-outline">
                                 <label class="form-label" for="estimated_budget" >Estimated Budget:</label>
                               <input type="text" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control currency" style="background-color: #fff;" readonly />
                               </div>
                             </div>-->

              </div>
              <div class="row">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG">Name of Organization:</label>
                    <input type="text" name="ORG" id="ORG" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline d-grid">
                    <label class="form-label" for="requested_by">Requested By:</label>
                    <input type="text" name="requested_by" id="requested_by" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline d-grid">
                    <label class="form-label" for="position_id">Position:</label>
                    <!--<select class="form-select" name="position_id" id="position_id" style="background-color: #fff;" readonly>
                               <1? php
                               /**
                                 $query = "SELECT position_id, position FROM tb_position";
                                 $result = @mysqli_query($conn, $query);
                                         while($data = @mysqli_fetch_array($result)) {
                                             echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                         }
                                **/
                               ?>-->
                    </select>
                    <input type="text" name="position_id" id="position_id" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline  ">
                    <label class="form-label" for="objectives">Objectives:</label>
                    <textarea class="form-control" name="objectives" id="objectives" rows="3" style="background-color: #fff;" readonly></textarea>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-3 ">
                  <div class="form-outline ">
                    <label class="form-label" for="budget_req" id="asterisk">Budget Request:</label>
                    <?php
                    if ($result->num_rows > 0) {
                    ?>
                      <table class="table" id="budget-request">
                        <thead>
                          <th>Item</th>
                          <th>Budget</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-3 mb-4 mt-0">
                  <div class="form-outline projectdesc">
                    <label class="form-label" for="estimated_budget">Estimated Budget:</label>
                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">PHP</span>
                      <input type="text" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control" style="background-color: #fff;" readonly />
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_remarks">Remarks:</label>
                    <textarea class="form-control" name="project_remarks" id="project_remarks" rows="6" style="background-color: #fff;" readonly></textarea>
                  </div>
                </div>
              </div>
              <input type="hidden" name="college_id" id="college_id">
              <input type="hidden" name="org_id" id="org_id">
            </div>
          </div>
          <div class="modal-footer px-2 py-2 pt-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-md btn-outline-success" onclick="exportTableToCSV('budget-breakdown.csv')"><i class="bi bi-file-earmark-spreadsheet-fill"></i> <span id="btntitle">Export Budget Request</span></button> <!--  <button type="submit" name="updatedata" class="btn btn-primary">Update Project</button>!-->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="logmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Audit Trail: </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row g-0 mt-4 justify-content-center">
            <div id="log-content" class="table-responsive ms-0">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--For modal-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <script>
    var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
      entries.forEach(function(entry) {
        $(entry.target).DataTable().columns.adjust();
      });
    }) : null;

    // Function to add a datatable to the ResizeObserver entries array
    resizeHandler = function($table) {
      if (observer)
        observer.observe($table[0]);
    };

    $(document).on('click', '.logbtn', function() {
      var project_id = $(this).attr("id");
      var myTable;

      $.ajax({
        url: "include/signatory-fetch-project-logs.php",
        method: "POST",
        data: {
          project_id: project_id
        },
        dataType: "json",
        success: function(data) {

          var content = "";
          data.forEach(e => {
            var a = new Date(e['id'] * 1000).toLocaleString('default', {
              month: 'long',
              day: 'numeric',
              year: 'numeric',
            });;
            content = `
              ${content}
              <tr>
                <td>${a}</td>
                <td>${e['message']}</td>
                <td>${e['user_name']}</td>
              </tr>
            `;
          });

          var output = `
              <table id="logTable" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                  <th class='desktop'>Date</th>
                  <th class='desktop'>Message</th>
                  <th class='desktop'>By</th>
                </tr>
                </thead>
                <tbody>
                  ${content}
                </tbody>
                <tfoot>
                <tr>
                  <th class='desktop'>Date</th>
                  <th class='desktop'>Message</th>
                  <th class='desktop'>By</th>
                </tr>
                </tfoot>
              </table>
          `;

          $('#log-content').html(output);

          myTable = $('#logTable').DataTable({
            paging: true,
            searching: false,
            responsive: true,
            ordering: false,
            scrollX: true,
            keys: true,
            fixedheader: true,
            "bFilter": true,
            dom: 'Bfrtip',
            select: 'single',
            buttons: [
              'pageLength',
              {
                extend: 'excelHtml5',
                title: 'JRU Organizations Portal -   Audit Trail',
                footer: true,
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                },
              },
              {
                extend: 'pdfHtml5',
                title: 'JRU Organizations Portal -   Audit Trail',
                footer: true,
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                },
                orientation: 'landscape',
                pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
              },
            ],
            /*initComplete: function(settings, json) {
              table = settings.oInstance.api();
              setTimeout(function() {
                table.columns.adjust();
              }, 500);
            }*/
          });

          // Initiate additional resize handling on datatable
          resizeHandler($('#logTable'));

          $('#logmodal').modal('show');
          myTable.columns.adjust().draw();
        }
      });

    });

    $(document).on('click', '.editbtn', function() {
      var project_id = $(this).attr("id");
      $.ajax({
        url: "signatory-fetch-project.php",
        method: "POST",
        data: {
          project_id: project_id
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#project_id').val(data.project_id);
          $('#project_name').val(data.project_name);
          $('#organizer').val(data.organizer);
          $('#venue').val(data.venue);
          $('#status').val(data.status);
          $('#status_by').val(data.status_by);
          $('#date_submitted').val(data.date_submitted);
          $('#status_date').val(data.status_date);
          $('#start_date').val(data.start_date);
          $('#end_date').val(data.end_date);
          $('#project_type').val(data.project_type);
          $('#project_category').val(data.project_category);
          $('#participants').val(data.participants);
          $('#ORG').val(data.ORG);
          $('#college_id').val(data.college_id);
          $('#org_id').val(data.org_id);
          $('#requested_by').val(data.requested_by);
          $('#position_id').val(data.position);
          $('#attachments').val(data.attachments);
          $('#objectives').val(data.objectives);

          var breq = data.budget_req.split(";;");
          var codes = data.budget_codes;
          $("#budget-request > tbody").empty();
          breq.forEach(e => {
            var data = e.split("::");
            var title = codes[data[0]] ?? "Undefined Budget Code";

            var output = `
              <tr>
                <td>${title}</td>
                <td>${data[1]}</td>
              </tr>
            `;
            $("#budget-request > tbody").append(output);
          });

          $('#estimated_budget').val(data.estimated_budget);
          $('#project_remarks').val(data.remarks);
          $('#editmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });
    });
  </script>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <!-- Sidebar collapse -->
  <script src="../assets/js/form-validation.js"></script>
  <!-- waves css
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>-->
  <!-- Datatable default  -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>

  <!-- Datatable bs5
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
      src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>  -->
  <script>
    $(document).ready(function() {
      var myTable;
      myTable = $('#example').DataTable({
        "createdRow": function(row, data, dataIndex) {
          if (data[3] == "Rejected") {
            $('td', row).eq(3).css('color', 'red');
          }
          if (data[3] == "Approved") {
            $('td', row).eq(3).css('color', 'green');
          }
          if (data[3] == "Pending") {
            $('td', row).eq(3).css('color', '#0d6efd');
          }
          if (data[3] == "Ongoing") {
            $('td', row).eq(3).css('color', '#0dcaf0');
          }
          if (data[3] == "Done") {
            $('td', row).eq(3).css('color', '#00C9A7');
          }
          if (data[3] == "Approved") {
            $('td', row).eq(3).css('color', 'green');
          }
          if (data[3] == "For Revision") {
            $('td', row).eq(3).css('color', '#FF9671');
          }
          if (data[3] == "Reschedule") {
            $('td', row).eq(3).css('color', 'grey');
          }
        },
        responsive: true,
        keys: true,
        fixedheader: true,
        bautoWidth: false,
        dom: 'Bfrtip',
        "bFilter": true,
        "columns": [{
            "width": "60px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "100px"
          },
          {
            "width": "80px"
          },
          {
            "width": "60px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "100px"
          },
          {
            "width": "80px"
          },
          {
            "width": "60px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "100px"
          },
          {
            "width": "80px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "100px"
          },
          {
            "width": "100px"
          },
          {
            "width": "100px"
          },
          {
            "width": "80px"
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -   Done List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            },
          },
          //{
          //  extend: 'csvHtml5',
          //    title: 'JRU Organizations Portal - Officer Pending List',
          //    footer: true,
          //    customize: function (csv) {
          //     return "JRU Organizations Portal - Officer Pending List\n\n"+  csv;
          //    },
          //    exportOptions: {
          //      columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
          //  },
          //    } ,
          {
            extend: 'pdfHtml5',
            title: 'JRU Organizations Portal -   Done List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -   Done List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            },
            customize: function(win) {

              var last = null;
              var current = null;
              var bod = [];

              var css = '@page { size: landscape; font-size: 1em;}',
                head = win.document.head || win.document.getElementsByTagName('head')[0],
                style = win.document.createElement('style');

              style.type = 'text/css';
              style.media = 'print';

              if (style.styleSheet) {
                style.styleSheet.cssText = css;
              } else {
                style.appendChild(win.document.createTextNode(css));
              }

              head.appendChild(style);
            }
          },
        ]
      });
      myTable.columns.adjust().draw();
    });
  </script>
  <script src="../assets/js/dataTables.altEditor.free.js"></script>
</body>

</html>