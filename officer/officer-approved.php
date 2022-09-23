<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:login.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Datepicker CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
  <!-- Datatable BS5
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  --><!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">

</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center justify-content-center align-items-center">
        <a class="navbar-brand" href="officer-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90px" height="90px">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 d-none d-sm-block ">JRU Student Organizations Portal</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="officer-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li class="active">
          <a href="officer-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <li>
          <a href="election-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>

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

      <nav class="navbar navbar-expand navbar-light shadow" aria-label="navbar" id="topbar">
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
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_Officers WHERE officer_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="officer-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../officer-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="officer-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="officer-projects.php"><i class="bi bi-folder-fill"></i> Projects</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-check-circle-fill"></i> Approved list</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4>Officer Projects Approved List</h4>
        </div>
      </div>
      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-2 pb-4">
      <div class="row g-0 mt-4 justify-content-center">
        <div class="table-responsive ms-0">
                <?php
                    $query = "SELECT * FROM tb_projectmonitoring WHERE status  IN('Approved')";
                    $result = @mysqli_query($conn,$query);
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
                    echo "<table id='example' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                            <th class='all'>Project ID</th>
                            <th class='all'>Project Name</th>
                            <th class='all'>Venue</th>
                            <th class='all'>Status</th>
                            <th class='all'>Date Submitted</th>
                            <th class='all'>Actions</th>
                            <th class='none'>Project Description</th>
                            <th class='none'>Project Category</th>
                            <th class='none'>Project Type</th>
                            <th class='none'>Start Date</th>
                            <th class='none'>End Date</th>
                            <th class='none'>Participants</th>
                            <th class='none'>Number of Participants</th>
                            <th class='none'>Beneficiary</th>
                            <th class='none'>Number of Beneficiary</th>
                            <th class='none'>Budget Source</th>
                            <th class='none'>Estimated Budget</th>
                            <th class='none'>Attachment</th>
                            <th class='none'>Remarks</th>
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
                        $pt = $row['project_type'];
                        $pc =$row['project_category'];
                        $pd =$row['project_desc'];
                        $sd =$row['start_date'];
                        $ed =$row['end_date'];
                        $p =$row['participants'];
                        $np =$row['no_of_participants'];
                        $b = $row['beneficiary'];
                        $nb = $row['no_of_beneficiary'];
                        $bs =$row['budget_source'];
                        $eb =$row['estimated_budget'];
                        $a = $row['attachments'];
                        $r =$row['remarks'];

                        echo "<tr>
                              <td> $pi  </td>
                              <td> $pn  </td>
                              <td> $v  </td>
                              <td> $s  </td>
                              <td> $ds </td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm editbtn' id='" . $pi . "'> <i class='bi bi-list-ul'></i> </button>
                              </td>
                              <td> $pt  </td>
                              <td> $pc  </td>
                              <td> $pd  </td>
                              <td> $sd </td>
                              <td> $ed </td>
                              <td> $p  </td>
                              <td> $np  </td>
                              <td> $b  </td>
                              <td> $nb  </td>
                              <td> $bs </td>
                              <td> $eb  </td>
                              <td> $a  </td>
                              <td> $r  </td>
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
                              <th>Project Description</th>
                              <th>Project Category</th>
                              <th>Project Type</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Participants</th>
                              <th>Number of Participants</th>
                              <th>Beneficiary</th>
                              <th>Number of Beneficiary</th>
                              <th>Budget Source</th>
                              <th>Estimated Budget</th>
                              <th>Attachment</th>
                              <th>Remarks</th>
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
                           <label class="form-label" for="project_id" >Project ID:</label>
                           <input type="text" name="project_id" id="project_id" class="form-control form-control-md" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4">
                       <div class="form-outline">
                         <label class="form-label" for="date_submitted" >Date Submitted:</label>
                         <input type="text" name="date_submitted" id="date_submitted" class="form-control form-control-md" style="background-color: #fff;" readonly />
                       </div>
                     </div>
                       </div>
                        <div class="row">
                        <div class="col-12 col-md-6 col-sm-3 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="project_name" >Project name:</label>
                            <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                        </div>
                        <div class="col-12 col-md-6 col-sm-3 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="venue" >Venue:</label>
                            <input type="text" name="venue" id="venue" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                          <label class="form-label" for="status" >Project Status:</label>
                          <input type="text" name="status" id="status" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="start_date" >Start Date:</label>
                              <input type="text" class="form-control" name="start_date" id="start_date" style="background-color: #fff;" readonly />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="end_date" >End Date:</label>
                              <input type="text" class="form-control" name="end_date" id="end_date" style="background-color: #fff;" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                          <label class="form-label" for="project_type" >Project Type:</label>
                          <input type="text" name="project_type" id="project_type" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="budget_source" >Budget Source:</label>
                            <input type="text" name="budget_source" id="budget_source" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="project_category" >Category:</label>
                            <input type="text" name="project_category" id="project_category" class="form-control form-control-lg" style="background-color: #fff;" readonly />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="participants" >Participants:</label>
                              <input type="text" name="participants" id="participants" class="form-control form-control-md" style="background-color: #fff;" readonly />
                            </div>
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
                              <div class="form-outline d-grid">
                                <label class="form-label">Download Attachment:</label>
                              <button type="button" class="btn btn-secondary btn-md">Download</button>
                              </div>
                            </div>
                            <div class="col-12 col-md-3 col-sm-3 mb-4">
                              <div class="form-outline">
                                <label class="form-label" for="estimated_budget" >Estimated Budget:</label>
                              <input type="text" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control currency" style="background-color: #fff;" readonly />
                              </div>
                            </div>
                          </div>
                         <div class="row">
                          <div class="col-12 col-md-12 col-sm-3 mb-4">
                            <div class="form-outline  projectdesc">
                              <label class="form-label" for="project_desc" >Project Description:</label>
                              <textarea class="form-control" name="project_desc" id="project_desc" rows="6" style="background-color: #fff;" readonly></textarea>
                            </div>
                          </div>
                          <div class="col-12 col-md-12 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="project_remarks">Remarks:</label>
                              <textarea class="form-control" name="project_remarks" id="project_remarks" rows="6" style="background-color: #fff;" readonly></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer px-0 py-0 pt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <!--  <button type="submit" name="updatedata" class="btn btn-primary">Update Project</button>!-->
                        <button class="btn btn-md btn-outline-secondary" name="Cancel" >Cancel Project</a>
                        <button class="btn btn-md  btn-info"  name="Ongoing">Ongoing</a>
                    </div>
                 </form>
            </div>
        </div>
  </div>

    <!--For modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        $(document).on('click', '.editbtn', function(){
           var project_id = $(this).attr("id");
           $.ajax({
                url:"officer-fetch-project.php",
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
                $('#project_remarks').val(data.remarks);
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
        if ( data[3] == "Done" ) {
        $('td', row).eq(3).css('color', '#00C9A7');
        }
        if ( data[3] == "Approved" ) {
        $('td', row).eq(3).css('color', 'green');
        }
        if ( data[3] == "For Revision" ) {
        $('td', row).eq(3).css('color', '#FF9671');
      }
      if ( data[3] == "Cancelled" ) {
      $('td', row).eq(3).css('color', 'grey');
      }
          },
          responsive: true,
          keys: true,
          fixedheader:true,
          bautoWidth:false,
         dom: 'Bfrtip',"bFilter": true,
         "columns": [
        { "width": "60px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "100px" },
        { "width": "80px" },
        { "width": "60px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "100px" },
        { "width": "80px" },
        { "width": "60px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "100px" },
        { "width": "80px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "100px" },
        { "width": "80px" }
  ],
            select: 'single',
          buttons: [
         'pageLength',
         {
           extend: 'excelHtml5',
           title: 'JRU Organizations Portal -   Approved List',
           footer: true,
         exportOptions: {
           columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
       },
         } ,
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
              title: 'JRU Organizations Portal -   Approved List',
              footer: true,
              exportOptions: {
                columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
            },
            orientation : 'landscape',
          pageSize : 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
            } ,
            {
              extend: 'print',
              title: 'JRU Organizations Portal -   Approved List',
              footer: true,
              exportOptions: {
                columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
            },
            customize: function(win)
            {

                var last = null;
                var current = null;
                var bod = [];

                var css = '@page { size: landscape; font-size: 1em;}',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');

                style.type = 'text/css';
                style.media = 'print';

                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
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
<script src="../assets/js/dataTables.altEditor.free.js" ></script>
</body>

</html>
