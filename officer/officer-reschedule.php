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
  ["Projects", "officer-projects.php", ""],
  ["Rescheduled", "", ""],
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
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Datepicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatable Default-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  <!-- Datatable BS5
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  -->
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
          <h4>Officer Projects Reschedule List</h4>
        </div>
      </div>
      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-2 pb-4">
          <div class="row g-0 mt-4 justify-content-center">
            <div class="table-responsive ms-0">
              <?php
              $query = "SELECT tb_projectmonitoring.project_id, tb_projectmonitoring.project_name, tb_projectmonitoring.venue, tb_projectmonitoring.status, tb_projectmonitoring.date_submitted, tb_projectmonitoring.status_date, tb_projectmonitoring.objectives, tb_projectmonitoring.project_category, tb_projectmonitoring.project_type, tb_projectmonitoring.start_date, tb_projectmonitoring.end_date, tb_projectmonitoring.participants, tb_projectmonitoring.organizer, tb_projectmonitoring.requested_by, tb_projectmonitoring.budget_req, tb_orgs.ORG, tb_position.position, tb_projectmonitoring.estimated_budget, tb_projectmonitoring.attachments, tb_projectmonitoring.remarks FROM tb_projectmonitoring JOIN tb_orgs ON tb_orgs.ORG_ID=tb_projectmonitoring.org_id JOIN tb_position ON tb_position.POSITION_ID=tb_projectmonitoring.position_id WHERE tb_projectmonitoring.status IN('Reschedule') AND tb_projectmonitoring.org_id = '$orgid'";
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
                            <th class='desktop'>Venue</th>
                            <th class='desktop'>Status</th>
                            <th class='desktop'>Date Submitted</th>
                            <th class='desktop'>Actions</th>
                            <th class='none'>Date Reschedule: </th>
                            <th class='none'>Objectives: </th>
                            <th class='none'>Project Category: </th>
                            <th class='none'>Project Type: </th>
                            <th class='none'>Start Date: </th>
                            <th class='none'>End Date: </th>
                            <th class='none'>Participants: </th>
                            <th class='none'>Organizer: </th>
                            <th class='none'>Requested By: </th>
                            <th class='none'>Budget Request: </th>
                            <th class='none'>Organization: </th>
                            <th class='none'>Position: </th>
                            <th class='none'>Estimated Budget: </th>
                            <th class='none'>Attachment: </th>
                            <th class='none'>Remarks: </th>
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
                  $pc = $row['project_category'];
                  $sd = $row['start_date'];
                  $ed = $row['end_date'];
                  $p = $row['participants'];
                  $or = $row['organizer'];
                  $std = $row['status_date'];
                  $rb = $row['requested_by'];
                  $br = $row['budget_req'];
                  $oid = $row['ORG'];
                  $pst = $row['position'];
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
                              <a type='button' class='btn btn-primary btn-sm' title='download attachment/s' href='downloadFiles.php?project_id=" . $pi . "'>  <i class='bi bi-download'></i> </a>
                              </a>
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
                            <th class='desktop'>Venue</th>
                            <th class='desktop'>Status</th>
                            <th class='desktop'>Date Submitted</th>
                            <th class='desktop'>Actions</th>
                            <th class='none'>Date Reschedule</th>
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
        <form action="officer-revision-button.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-4 col-md-2 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_id">Project ID:</label>
                    <input type="text" name="project_id" id="project_id" class="form-control form-control-md"  readonly />
                  </div>
                </div>
                <div class="col-4 col-md-3 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="school_year">School Year:</label>
                    <input type="text" name="school_year" id="school_year" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-4 col-md-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="date_submitted">Date Submitted:</label>
                    <input type="text" name="date_submitted" id="date_submitted" class="form-control form-control-md"  readonly />
                  </div>
                </div>
                <div class="col-4 col-md-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="status_date">Date Reschedule:</label>
                    <input type="text" name="status_date" id="status_date" class="form-control form-control-md" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_name">Project name:</label>
                    <input type="text" name="project_name" id="project_name" class="form-control form-control-lg"  required />
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="organizer">Organizer:</label>
                    <input type="text" name="organizer" id="organizer" class="form-control" style="background-color: #fff;" required />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Project name field cannot be blank!</div>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="venue">Venue:</label>
                    <input type="text" name="venue" id="venue" class="form-control" style="background-color: #fff;" required />
                  </div>
                </div>

                  <div class="col-12 col-md-4 col-sm-3 mb-4">
                    <label class="form-label" for="status">Project Status:</label>
                    <input type="text" name="status" id="status" class="form-control" readonly />
                  </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <label class="form-label" for="status_by">Project status updated by:</label>
                  <input type="text" name="status_by" id="status_by" class="form-control" readonly />
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="project_type">Project Type:</label>
                  <select class="mt-0 ms-0 form-select" name="project_type" id="project_type" style="background-color: #fff;" required>
                    <option class="greyclr" selected disabled value="">Select Type</option>
                    <option value="Curricular">Curricular</option>
                    <option value="Extra Curricular">Extra Curricular</option>
                    <option value="Outreach">Outreach</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Competition">Competition</option>
                    <option value="Assembly">Assembly</option>
                    <option value="Socialization/Teambuilding">Socialization/Teambuilding</option>
                    <option value="Student Learning Circle">Student Learning Circle</option>
                    <option value="Showcase">Showcase</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="project_category">Category:</label>
                  <select class="mt-0 ms-0 form-select" name="project_category" id="project_category" required>
                    <option class="greyclr" selected disabled value="">Select Category</option>
                    <option value="Onsite">Onsite</option>
                    <option value="Online">Online</option>
                    <option value="Hybrid">Hybrid</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="start_date">Start Date:</label>
                    <input type="text" class="form-control" name="start_date" id="start_date" onkeydown="return false;" value="" style="background-color: #fff;" required />
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="end_date">End Date:</label>
                    <input type="text" class="form-control" name="end_date" id="end_date" onkeydown="return false;" value="" style="background-color: #fff;" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="participants">Participants:</label>
                    <input type="text" name="participants" id="participants" class="form-control form-control-md" style="background-color: #fff;" required />
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline d-grid">
                    <label class="form-label">Upload Attachment/s:</label>
                    <input type="file" class="form-control" name="attachments" accept=".zip,.rar,.7zip" id="formFileMultiple" required>
                  </div>
                </div>
              </div>
              <!--
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
                            </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="ORG" >Name of Organization:</label>
                              <input type="text" name="ORG" id="ORG" class="form-control form-control-md"   readonly />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                            <div class="form-outline d-grid">
                              <label class="form-label" for="requested_by">Requested By:</label>
                              <input type="text" name="requested_by" id="requested_by" class="form-control form-control-md"   readonly />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                            <div class="form-outline d-grid">
                              <label class="form-label" for="position_id">Position:</label>
                             <!--<select class="form-control form-control-md" name="position_id" id="position_id"   readonly>
                              <1? php
                              /**
                                $query = "SELECT position_id, position FROM tb_position";
                                $result = @mysqli_query($conn, $query);
                                        while($data = @mysqli_fetch_array($result)) {
                                            echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                        }**/
                              ?>
                              </select>
                              <input type="text" name="position_id" id="position_id" class="form-control form-control-md"   readonly />
                            </div>
                          </div>
                        </div>-->
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline  ">
                    <label class="form-label" for="objectives">Objectives:</label>
                    <textarea class="form-control" name="objectives" id="objectives" rows="3" style="background-color: #fff;" required></textarea>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-3 mb-2">
                  <div class="form-outline  ">
                    <label class="form-label" for="budget_req">Budget Request:</label>
                    <?php
                    if ($result->num_rows > 0) {
                    ?>
                      <table class="table" id="budget-request">
                        <thead>
                          <th>Item</th>
                          <th>Budget</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <div class="text-right">
                        <button type="button" class="btn btn-primary mt-1 " id="add-budget">Add Budget</button>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline projectdesc">
                    <label class="form-label" for="estimated_budget" id="asterisk">Estimated Budget:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input type="text" pattern="[0-9.,]+" class="form-control" name="estimated_budget" id="estimated_budget" required data-type="number" required />
                      <div class="valid-feedback"></div>
                    </div>

                  </div>
                </div>
                <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_remarks">Remarks:</label>
                    <textarea class="form-control" name="project_remarks" id="project_remarks" rows="6" readonly></textarea>
                  </div>
                </div>
              </div>
              <input type="hidden" name="college_id" id="college_id">
              <input type="hidden" name="org_id" id="org_id">
              <div class="modal-footer px-0 py-0 pt-2">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?php
                if ($_SESSION['USER-POS'] <= 5) {
                ?>
                  <button type="submit" name="updatedata" class="btn btn-primary">Restore Project</button> <!--  update and change status to pending-->
                  <!--  update and change status to pending-->
                <?php
                }
                ?>
              </div>
        </form>
      </div>
    </div>
  </div>

  <!--For modal-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <script>
    $(document).on('click', '.editbtn', function() {
      var project_id = $(this).attr("id");
      $.ajax({
        url: "officer-fetch-project.php",
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
          $('#objectives').val(data.objectives);

          var breq = data.budget_req.split(";;");
          $("#budget-request > tbody").empty();
          var bcount = 0;
          breq.forEach(e => {
            var data = e.split("::");
            bcount++;
            var output = `
              <tr id="budget-${bcount}">
                <td><input type="text" name="budgetdesc-${bcount}" id="budgetdesc-${bcount}" class="form-control" value="${data[0]}"></td>
                <td><input type="text" name="payment-${bcount}" id="payment-${bcount}" class="form-control payment" value="${data[1]}"></td>
                <td class="align-middle"><a class="text-danger" href="#" onclick="deleteBudget('${bcount}')"><u>Delete</u></a>
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
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }


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

      $("#budget-request").on("change", ".payment", function() { // <-- Only changed this line
        var sum = 0;
        $(".payment").each(function() {
          if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
          }
        });
        $('#estimated_budget').val(sum);
      });

      $('#add-budget').on("click", function() {
        var lastid = $('#budget-request > tbody > tr:last-child').prop("id");
        var bcount = parseInt(lastid.replaceAll("budget-", "")) + 1;
        var output = `
          <tr id="budget-${bcount}">
            <td><input type="text" name="budgetdesc-${bcount}" id="budgetdesc-${bcount}" class="form-control" value="Untitled"></td>
            <td><input type="text" name="payment-${bcount}" id="payment-${bcount}" class="form-control payment" value="0"></td>
            <td class="align-middle"><a class="text-danger" href="#" onclick="deleteBudget('${bcount}')"><u>Delete</u></a>
          </tr>
        `;
        $("#budget-request > tbody").append(output);
      });
    });

    function deleteBudget(id) {
      $("#budget-" + id).remove();
    }
  </script>
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
            title: 'JRU Organizations Portal -   For Revision List',
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
            title: 'JRU Organizations Portal -   For Revision List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -   For Revision List',
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
  <?php
    include('include/sweetalert.php');
  ?>
</body>

</html>
