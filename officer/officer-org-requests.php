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
  ["Org Applications", "", ""],
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
          <h4> Student Application List</h4>
        </div>
      </div>
      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-2 pb-4">
          <div class="row g-0 mt-4 justify-content-center">
            <div class="table-responsive ms-0">
              <?php
              $query = "SELECT tb_projectmonitoring.project_id, tb_projectmonitoring.project_name, tb_projectmonitoring.venue, tb_projectmonitoring.status, tb_projectmonitoring.date_submitted, tb_projectmonitoring.objectives, tb_projectmonitoring.project_category, tb_projectmonitoring.project_type, tb_projectmonitoring.start_date, tb_projectmonitoring.end_date, tb_projectmonitoring.participants, tb_projectmonitoring.organizer, tb_projectmonitoring.requested_by, tb_projectmonitoring.budget_req, tb_orgs.ORG, tb_position.position, tb_projectmonitoring.estimated_budget, tb_projectmonitoring.attachments FROM tb_projectmonitoring JOIN tb_orgs ON tb_orgs.ORG_ID=tb_projectmonitoring.org_id JOIN tb_position ON tb_position.POSITION_ID=tb_projectmonitoring.position_id WHERE tb_projectmonitoring.status IN('Pending') AND tb_projectmonitoring.org_id = '$orgid'";
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
                            <th class='desktop'>Date Submitted:</th>
                            <th class='desktop'>Actions</th>
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
                  $rb = $row['requested_by'];
                  $br = $row['budget_req'];
                  $oid = $row['ORG'];
                  $pst = $row['position'];
                  $a = $row['attachments'];
                  //$r = $row['remarks'];
                  $eb = $row['estimated_budget'];

                  echo "<tr>
                              <td> $pi  </td>
                              <td> $pn  </td>
                              <td> $v  </td>
                              <td> $s  </td>
                              <td> $ds </td>
                              <td>
                              <button type='button' title='project details' class='btn btn-success btn-sm editbtn' id='" . $pi . "'> <i class='bi bi-list-ul'></i> </button>
                              <a type='button' class='btn btn-primary btn-sm' id='btndl' title='download attachment/s' href='downloadFiles.php?project_id=" . $pi . "'>  <i class='bi bi-download'></i> </a>
                              </a>
                              </td>
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
        <form action="officer-revision-button.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-4 col-md-2 mb-4">
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
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_name">Project name:</label>
                    <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="organizer" id="asterisk">Organizer:</label>
                    <input type="text" name="organizer" id="organizer" class="form-control" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Project name field cannot be blank!</div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="venue">Venue:</label>
                    <input type="text" name="venue" id="venue" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <label class="form-label" for="status">Project Status:</label>
                  <input type="text" name="status" id="status" class="form-control" style="background-color: #fff;" readonly />
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
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="participants">Participants:</label>
                    <input type="text" name="participants" id="participants" class="form-control form-control-md" style="background-color: #fff;" readonly />
                  </div>
                </div>

                <!--<div class="col-12 col-md-4 col-sm-3 mb-2">
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
                    <label class="form-label" for="org_id">Name of Organization:</label>

                    <input type="text" name="org_id" id="org_id" class="form-control form-control-md" style="background-color: #fff;" readonly />
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
                    <!--<select class="form-control form-control-md" name="position_id" id="position_id" style="background-color: #fff;" readonly>
                              <1? php
                              /**
                                $query = "SELECT position_id, position FROM tb_position";
                                $result = @mysqli_query($conn, $query);
                                        while($data = @mysqli_fetch_array($result)) {
                                            echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                        }**/
                              ?>-->
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
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline ">
                    <label class="form-label" for="budget_req" id="asterisk">Budget Request:</label>
                    <textarea class="form-control" name="budget_req" id="budget_req" rows="6" style="background-color: #fff;" readonly></textarea>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">

                    <label class="form-label" for="estimated_budget">Estimated Budget:</label>
                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">PHP</span>
                      <input type="text" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control" style="background-color: #fff;" readonly />
                    </div>
                  </div>
                </div>
                <!--  <div class="col-12 col-md-12 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="project_remarks">Remarks:</label>
                              <textarea class="form-control" name="project_remarks" id="project_remarks" rows="6" style="background-color: #fff;" readonly></textarea>
                            </div>
                          </div>!-->
              </div>
            </div>
            <div class="modal-footer px-0 py-0 pt-2">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <?php
                if ($_SESSION['USER-POS'] <= 5 ){
              ?>
              <!--  <button type="submit" name="updatedata" class="btn btn-primary">Update Project</button>!-->
              <button class="btn btn-md btn-outline-secondary" name="Cancel">Reschedule</a>
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
          $('#date_submitted').val(data.date_submitted);
          $('#status_date').val(data.status_date);
          $('#start_date').val(data.start_date);
          $('#end_date').val(data.end_date);
          $('#project_type').val(data.project_type);
          $('#project_category').val(data.project_category);
          $('#participants').val(data.participants);
          $('#org_id').val(data.ORG);
          $('#requested_by').val(data.requested_by);
          $('#position_id').val(data.position);
          $('#objectives').val(data.objectives);
          $('#budget_req').val(data.budget_req);
          $('#estimated_budget').val(data.estimated_budget);
          $('#project_remarks').val(data.remarks);
          $('#editmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });
    });

    $(document).on("click", '#btndl2', function(e) {
      $('#btndl').trigger('click');
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
        //  scrollX:true,
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
            "width": "80px"
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -   Pending List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
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
            title: 'JRU Organizations Portal -   Pending List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -   Pending List',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
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