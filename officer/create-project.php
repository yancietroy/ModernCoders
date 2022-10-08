<?php
ob_start();
session_start();
$id = $_SESSION['use'];
$orgid = $_SESSION['org'];
include('../mysql_connect.php'); include('profilepic.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
  else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:login.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Datepicker CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        <h5 class="mt-2 mb-3 p-0 d-none d-sm-block ">JRU Student Organizations Portal Officer</h5>
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
                  <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME), position_id AS name FROM tb_Officers WHERE officer_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  $userName = $row[0];
                  $posID = $row[1];
                  echo "$userName";?></span></a>
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
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-plus-circle-fill"></i> Create Project</li>
        </ol>
      </nav>
      <!-- Page content -->
      <form action="" method="post" class="requires-validation" enctype="multipart/form-data" novalidate>
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-6  mb-4">
          <h4>Create New Project</h4>
        </div>
          <div class="wrap shadow px-5 py-4 mx-auto mb-4">
            <div class="row justify-content-center text-align-center mb-2 ">
              <div class="col-lg-3 col-3 ">
                <h7 id="titlejru">Jose Rizal University</h7>
              </div>
            </div>
          <div class="row justify-content-center">
            <div class="col-lg-5 col-5  mb-4">
              <h3 id="titleproj">Activity Proposal Form</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="project_name" id="asterisk">Project name:</label>
                <input type="text" name="project_name" id="project_name" class="form-control form-control-lg" maxlength="50" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Project name field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="organizer" id="asterisk">Organizer:</label>
                <input type="text" name="organizer" id="organizer" class="form-control" maxlength="50" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Project name field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="venue" id="asterisk">Venue:</label>
                <input type="text" name="venue" id="venue" class="form-control" maxlength="50" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Venue field cannot be blank!</div>
              </div>
            </div>
          <div class="col-12 col-md-4 col-sm-3 mb-4">
            <label class="form-label select-label" for="project_type" id="asterisk">Project Type:</label>
            <select class="mt-0 ms-0 form-select" name="project_type" id="project_type" required>
              <option class="greyclr" selected disabled value="" >Select Type</option>
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
            <div class="valid-feedback">  </div>
            <div class="invalid-feedback">Project Type field cannot be blank!</div>
          </div>
          <div class="col-12 col-md-4 col-sm-3 mb-4">
            <label class="form-label select-label" for="project_category" id="asterisk">Category:</label>
            <select class="mt-0 ms-0 form-select" name="project_category" id="project_category" required>
              <option class="greyclr" selected disabled value="" >Select Category</option>
              <option value="Onsite">Onsite</option>
              <option value="Online">Online</option>
              <option value="Hybrid">Hybrid</option>
            </select>
            <div class="valid-feedback">  </div>
            <div class="invalid-feedback">Category field cannot be blank!</div>
          </div>
          <div class="col-12 col-md-4 col-sm-3 mb-4">
            <div class="form-outline">
              <label class="form-label" for="participants" id="asterisk">Participants:</label>
              <input type="text" name="participants" id="participants" class="form-control"  maxlength="50" required />
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">Participants field cannot be blank!</div>
            </div>
          </div>
            </div>
          <div class="row">
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="start_date" id="asterisk">Start Date:</label>
                <input type="text" class="form-control" name="start_date" id="start_date" onkeydown="return false;" value="" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Date field Invalid!</div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="end_date" id="asterisk">End Date:</label>
                <input type="text" class="form-control" name="end_date" id="end_date" onkeydown="return false;" value="" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Date field Invalid!</div>
              </div>
            </div>
            <!--
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="no_of_participants" id="asterisk">No. of Participants:</label>
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_participants" maxlength="4" id="no_of_participants" class="form-control" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Number of Participants field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="beneficiary" id="asterisk">Beneficiary:</label>
                <input type="text" name="beneficiary" id="beneficiary" class="form-control"  maxlength="50" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Beneficiary field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="no_of_beneficiary" id="asterisk">No. of Beneficiary:</label>
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_beneficiary" maxlength="4" id="no_of_beneficiary" class="form-control" required />
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Number of Beneficiary field cannot be blank!</div>
              </div>
            </div>
            </div>
            <div class="col-12 col-md-3 col-sm-3 mb-4">
              <label class="form-label select-label" for="budget_source" id="asterisk">Budget Request:</label>
              <select class="mt-0 ms-0 form-select" name="budget_source" id="budget_source" required>
                <option class="greyclr" selected disabled value="" >Select Budget Source</option>
                <option value="Student Council">Student Council</option>
                <option value="Organization">Student Organization</option>
                <option value="Accounting Office">Accounting Office</option>
                <option value="Third Party">Third Party</option>
                <option value="Third Party">None</option>
              </select>
              <div class="valid-feedback">  </div>
              <div class="invalid-feedback">Category field cannot be blank!</div>
              <label class="form-label mt-4" for="estimated_budget" id="asterisk">Estimated Budget:</label>
              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control currency" required />
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">Budget field cannot be blank!</div>
            </div>-->

          </div>

          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="objectives" id="asterisk">Objectives:</label>
                <textarea class="form-control" name="objectives" id="objectives" rows="3"  placeholder="Enter project objectives and details." required></textarea>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Objectives field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="budget_req" id="asterisk">Budget Request:</label>
                <textarea class="form-control" name="budget_req" id="budget_req" rows="6" placeholder="Enter details of budget breakdown." required></textarea>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Objectives field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-sm-3 mb-4">
             <div class="form-outline">

                <label class="form-label" for="estimated_budget" id="asterisk" >Estimated Budget:</label>
               <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">PHP</span>
              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" name="estimated_budget" id="estimated_budget" class="form-control" required />
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">Budget field cannot be blank!</div>
             </div>
           </div>
         </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label mb-2" for="attachments" id="asterisk">Upload Attachment/s:</label>
                <input class="form-control mt-3" name="attachments" id="attachments" type="file" accept=".pdf" id="formFileMultiple" required multiple>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Upload attachment field cannot be blank!</div>
              </div>
            </div>
            <div class="col-12 col-md-8 col-sm-3 mb-4">
            <small class="text-muted">*Note: Attach necessary documents in this form that will support your request
            (invitation letter, quotation of provider, Program of the Activity etc.) <br>

            *Note: Please attach other request form/ file
            (Facility Request, Announcement Request, Service/ Guest Pass, etc.) <br>
            *Note: Please be mindful about submitting project proposals during exam week</small>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input class="btn btn-lg btn-outline-info" type="reset" value="Reset">
            <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit">
          </div>
      </div>
      </div>
      <?php
              if (isset($pn) || isset($vn) || isset($pt) || isset($sdate) || isset($edate) || isset($o) || isset($pc)   || isset($p) || isset($obj) ||  isset($br) || isset($eb) || isset($_POST['submit']))
                {
                  $pn = $_POST['project_name'];
                  $o = $_POST['organizer'];
                  $vn = $_POST['venue'];
                  $pt = $_POST['project_type'];
                  $sdate = $_POST['start_date'];
                  $edate = $_POST['end_date'];
                  $pc = $_POST['project_category'];
                  $p = $_POST['participants'];
                  $obj = $_POST['objectives'];
                  $br = $_POST['budget_req'];
                 $eb = $_POST['estimated_budget'];
                  $s = "Pending";

                  $pname = rand(1000,100000)."-".$_FILES['attachments']['name'];
                  $destination = 'attachments/' . $pname;
                  $tname = $_FILES['attachments']['tmp_name'];
                  move_uploaded_file($tname, $destination);

                    $query = "INSERT INTO tb_projectmonitoring(project_name, organizer, venue, project_type, start_date, end_date, project_category, participants, objectives, budget_req, estimated_budget, date_submitted, status, attachments, status_date, requested_by, org_id, position_id) VALUES('$pn', '$o', '$vn', '$pt', '$sdate', '$edate', '$pc', '$p', '$obj', '$br', '$eb', NOW(), '$s', '$pname', NOW(), '$userName', '$orgid', '$posID')";
                      $result = @mysqli_query($conn, $query);

                      echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Project Created',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";
                      //header("location:login.php");
                          @mysqli_close($conn);
                }
      ?>
      </form>
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
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
        Waves.attach('#sidebar ul li a');
        Waves.init();
      </script>
      <script src="../assets/js/date.js"></script>
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
        <script>
          $(document).ready(function() {
            $('#start_date').bind('cut copy paste', function(e) {
              e.preventDefault();
              return false;
            });
            $('#end_date').bind('cut copy paste', function(e) {
              e.preventDefault();
              return false;
            });
          });
        </script>
</body>
</html>
