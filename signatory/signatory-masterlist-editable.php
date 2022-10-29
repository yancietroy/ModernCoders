<?php
ob_start();
session_start();
$org_id = $_SESSION['org_id'];
if(!isset($_SESSION['org_id'])){
  unset($org_id);
}
$id = $_SESSION['use'];
unset($_SESSION['pid']);
include('../mysql_connect.php'); include('profilepic.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../signatory-login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico"/>
  <title>JRU Student Organizations Portal Signatory</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"  referrerpolicy="no-referrer" />
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
<!-- Datepicker CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatable BS5
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  --><!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
  <style>
  @media only screen
  and (min-width: 1030px)
  and (max-width: 1366px)  {

        #wrapper {
            overflow:auto !important;
}
}
  </style>
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center justify-content-center align-items-center">
        <a class="navbar-brand" href="signatory-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90px" height="90px">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 d-none d-sm-block ">JRU Student Organizations Portal Signatory</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="signatory-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="#"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li class="active">
          <a href="signatory-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <!--<li>
        <a href="#pageSubmenu"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>-->
        <li>
      <!--  <a href="#"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>-->
        </li>
        <li>
<!--<a href="#"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->
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
                <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM tb_signatories WHERE school_id = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#!">Profile</a></li>
                  <li><a class="dropdown-item" href="#!">Settings</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="#!">About</a></li>
                  <li><a class="dropdown-item" href="../signatory-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="signatory-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="signatory-projects.php"><i class="bi bi-folder-fill"></i> Projects</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-card-list"></i> Masterlist</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4>Signatory Projects Masterlist</h4>
        </div>
      </div>
      <div class="row justify-content-center align-items-center mt-4" id="container">
        <div class="col-md-12 ">
          <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive justify-content-center align-items-center ms-4">
              <?php
                  $query = "SELECT project_id, date_submitted, project_name, venue, project_type, start_date, end_date, budget_source, project_category, participants, no_of_participants, beneficiary, no_of_beneficiary,  status FROM tb_projectmonitoring";
                  $result = @mysqli_query($conn,$query);
                  $i = 0;
                  $ds = " ";
                  $pi = " ";
                  $pn = " ";
                  $v = " ";
                  $s = " ";
                  echo "<table id='example' class=' display nowrap w-100 ms-0 master'>
                        <thead>
                          <tr>
                              <th>Project ID</th>
                              <th>Project Name</th>
                              <th>Venue</th>
                              <th>Status</th>
                              <th>Date Submitted</th>
                              <th>Options</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
                  if ($result !== false && $result->num_rows > 0)
                  {
                      // output data of each row
                      while($row = $result->fetch_assoc())
                      {
                      $ds = $row['date_submitted'];
                      $pi = $row['project_id'];
                      $pn = $row['project_name'];
                      $v = $row['venue'];
                      $s = $row['status'];

                      echo "<tr>
                            <td> $pi  </td>
                            <td> $pn  </td>
                            <td> $v  </td>
                            <td> $s  </td>
                            <td> $ds </td>
                            <td>
                            <button type='button' class='btn btn-primary btn-sm editbtn' id='" . $pi . "'> <i class='bi bi-list-ul'></i> </button>
                            </td>
                            </tr>
                          ";
                      }
                  echo "</tbody>
                        <tfoot>
                            <tr>
                              <th>Project ID</th>
                              <th>Project Name</th>
                              <th>Venue</th>
                              <th>Status</th>
                              <th>Date Submitted</th>
                              <th>Actions</th>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="signatory-update-button.php" method="POST">
                  <div class="modal-body">
                     <div class="container-fluid">
                       <div class="row justify-content-between">
                      <div class="col-4 col-md-2 col-sm-3 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="project_id" >Project ID:</label>
                          <input type="text" name="project_id" id="project_id" class="form-control" style="background-color: #fff;" readonly/>
                        </div>
                      </div>
                      <div class="col-4 col-md-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="date_submitted" >Date Submitted:</label>
                        <input type="text" name="date_submitted" id="date_submitted" class="form-control" style="background-color: #fff;" readonly />
                      </div>
                    </div>
                      </div>
                        <div class="row">
                        <div class="col-12 col-md-6 col-sm-3 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="project_name" >Project name:</label>
                            <input type="text" name="project_name" id="project_name" class="form-control form-control-lg"  />
                          </div>
                        </div>
                        <div class="col-12 col-md-6 col-sm-3 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="venue" >Venue:</label>
                            <input type="text" name="venue" id="venue" class="form-control form-control-lg"  />
                          </div>
                        </div>
                        </div>
                        <div class="row justify-content-between">
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="start_date" >Start Date:</label>
                              <input type="text" class="form-control" name="start_date" id="start_date"  />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="end_date" >End Date:</label>
                              <input type="text" class="form-control" name="end_date" id="end_date"  />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                          <label class="form-label" for="project_type" >Project Type:</label>
                          <input type="text" name="project_type" id="project_type" class="form-control form-control-lg"  />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="budget_source" >Budget Source:</label>
                            <input type="text" name="budget_source" id="budget_source" class="form-control form-control-lg"  />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="project_category" >Category:</label>
                            <input type="text" name="project_category" id="project_category" class="form-control form-control-lg"  />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="participants" >Participants:</label>
                              <input type="text" name="participants" id="participants" class="form-control form-control-md"  />
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="beneficiary">Beneficiary:</label>
                              <input type="text" name="beneficiary" id="beneficiary" class="form-control form-control-md" />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-3 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="no_of_participants" >No. of Participants:</label>
                              <input type="text" name="no_of_participants" maxlength="4" id="no_of_participants" class="form-control"  />
                            </div>
                            </div>
                            <div class="col-12 col-md-3 col-sm-3 mb-4">
                              <div class="form-outline">
                                <label class="form-label" for="no_of_beneficiary">No. of Beneficiary:</label>
                                <input type="text" name="no_of_beneficiary" maxlength="4" id="no_of_beneficiary" class="form-control" />
                              </div>
                            </div>
                            <div class="col-12 col-md-3 col-sm-3 mb-4">
                              <div class="form-outline">
                                <label class="form-label">Attachment:</label>
                                <div class="btn-group">
                              <button type="button" class="btn btn-secondary btn-md">Download</button>
                              <button type="button" class="btn btn-secondary btn-md">Upload</button>
                            </div>
                              </div>
                            </div>
                            <div class="col-12 col-md-3 col-sm-3 mb-4">
                              <div class="form-outline">
                                <label class="form-label" for="estimated_budget" >Estimated Budget:</label>
                              <input type="text" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control currency"  />
                              </div>
                            </div>
                          </div>
                         <div class="row">
                          <div class="col-12 col-md-12 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="project_desc" >Project Description:</label>
                              <textarea class="form-control" name="project_desc" id="project_desc" rows="6" ></textarea>
                            </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Project</button>
                    </div>
                 </form>
            </div>
        </div>
  </div>
  </div>
</div>

    <!--For modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).on('click', '.editbtn', function(){
           var project_id = $(this).attr("id");
           $.ajax({
                url:"signatory-fetch-project.php",
                method:"POST",
                data:{project_id:project_id},
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#project_id').val(data.project_id);
                $('#project_name').val(data.project_name);
                $('#project_desc').val(data.project_desc);
                $('#venue').val(data.venue);
                $('#estimated_budget').val(data.estimated_budget);
                $('#status').val(data.status);
                $('#date_submitted').val(data.date_submitted);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#project_type').val(data.project_type);
                $('#budget_source').val(data.budget_source);
                $('#project_category').val(data.project_category);
                $('#participants').val(data.participants);
                $('#beneficiary').val(data.beneficiary);
                $('#no_of_participants').val(data.no_of_participants);
                $('#no_of_beneficiary').val(data.no_of_beneficiary);
                $('#editmodal').modal('show');
                $('#modal-lg').css('max-width','70%');
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
    <!-- Datepicker cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
$(document).ready(function () {
    $('#start_date').datetimepicker({
      changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    formatTime:'H:i',
    formatDate:'m.d.Y',
    minDate: new Date()
    });

    $('#end_date').datetimepicker({
           dateFormat: "dd-M-yy",
           minDate: 0
       });
   });
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
      myTable =  $('#example').DataTable({
        "createdRow": function( row, data, dataIndex ) {
            if ( data[3] == "Rejected" ) {
            $('td', row).eq(3).css('color', 'red');
        }
        if ( data[3] == "Approved" ) {
        $('td', row).eq(3).css('color', 'green');
        }
        if ( data[3] == "Pending" ) {
        $('td', row).eq(3).css('color', '#0d6efd');
        }
        if ( data[3] == "Ongoing" ) {
        $('td', row).eq(3).css('color', '#0dcaf0');
        }
        if ( data[3] == "Implemented" ) {
        $('td', row).eq(3).css('color', '#00C9A7');
        }
        if ( data[3] == "Approved" ) {
        $('td', row).eq(3).css('color', 'green');
        }
          },
          responsive: true,
          keys: true,
          //select: true,
       //// scrollX:true,
      //    scrollCollapse: true,
          fixedheader:true,
      bautoWidth:false,
         dom: 'Bfrtip',"bFilter": true,
         "columns": [
        { "width": "60px" },
        { "width": "150px" },
        { "width": "100px" },
        { "width": "125px" },
        { "width": "100px" },
        { "width": "70px" }
  ],
        //  dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
          //  "<'row'<'col-sm-12'tr>>" +
        //    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        //  "bFilter": true,
            select: 'single',
        //  responsive: true,
        //  altEditor: true,
        //  "aLengthMenu": [
        //    [10, 20, 50, 100, -1],
        //    [10, 20, 50, 100, "desktop"]
        //  paging:true,
          buttons: [
         'pageLength',
          //'copyHtml5',
            //  {
            // extend: 'excelHtml5',
            //   title: 'JRU Organizations Portal Student Users'
            //   },
            {
              extend: 'csvHtml5',
              title: 'JRU Organizations Portal Student Users'
            },
            {
              extend: 'pdfHtml5',
              title: 'JRU Organizations Portal Student Users'
            },
            {
              extend: 'print',
              title: 'JRU Organizations Portal Student Users'
            },
          //  {
          //  text: 'Add',
          //  name: 'add'        // does not change name
          //  },
          //  {
          //  extend: 'selected', // Bind to Selected row
          //  text: 'Edit',
          //  name: 'edit'        // does not change name
          //  },
          //  {
          //  extend: 'selected', // Bind to Selected row
        //    text: 'Delete',
          //  name: 'delete'      // does not change name
          //  }
          ]/**,
          'columnDefs' : [
        { 'visible': false, 'targets': [7, 8, 9,
                                        10, 11, 12,
                                        13, 14, 15] }
    ]*/
        });
      myTable.columns.adjust().draw();
      /**myTable.columns( [ 7, 8, 9, 10, 11, 12, 13, 14, 15 ] ).visible( false, false );
      myTable.columns.adjust().draw( false );*/
        });
    </script>
<script src="../assets/js/dataTables.altEditor.free.js" ></script>
</body>

</html>
