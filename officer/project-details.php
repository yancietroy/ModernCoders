<?php
ob_start();
session_start();

include('../router.php');
route(2);

$officer_id = $_SESSION['USER-ID'];
$ssid = $_GET['project_id'];
//$ssid = $_SESSION['pid'];
$orgid = $_SESSION['org'];
include('../mysql_connect.php');
include('profilepic.php');
include('../assets/img/orglogopics.php');
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datepicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
          <a href="officer-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <!--    <a href="msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->

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
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_Officers WHERE officer_ID = '$officer_id'";
                                                        $result = @mysqli_query($conn, $query);
                                                        $row = mysqli_fetch_array($result);
                                                        if ($row) {
                                                          echo "$row[0]";
                                                        } ?></span></a>
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
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-list-ul"></i> Project Details</li>
        </ol>
      </nav>
      <?php
      $query = "SELECT project_name, venue, project_type, start_date, end_date, budget_source, project_category, participants, no_of_participants, beneficiary, no_of_beneficiary, project_desc, estimated_budget FROM tb_projectmonitoring WHERE project_id = '$ssid'";
      $result = @mysqli_query($conn, $query);
      $pn = " ";
      $v = " ";
      $pt = " ";
      $sd = " ";
      $ed = " ";
      $bs = " ";
      $pc = " ";
      $p = " ";
      $nop = " ";
      $b = " ";
      $nob = " ";
      $pd = " ";
      $eb = " ";
      if ($result) {
        while ($row = @mysqli_fetch_array($result)) {
          $pn = $row['project_name'];
          $v = $row['venue'];
          $pt = $row['project_type'];
          $sd = $row['start_date'];
          $ed = $row['end_date'];
          $bs = $row['budget_source'];
          $pc = $row['project_category'];
          $p = $row['participants'];
          $nop = $row['no_of_participants'];
          $b = $row['beneficiary'];
          $nob = $row['no_of_beneficiary'];
          $pd = $row['project_desc'];
          $eb = $row['estimated_budget'];
        }
      }
      ?>

      <!-- Page content -->
      <form action="" method="post" class="requires-validation" novalidate>
        <div class="row ms-3 me-3 mt-2">
          <div class="col-lg-6 col-7  mb-2">
            <h4>Officer Project Details</h4>
          </div>
          <div class="wrap shadow px-5 py-4 mx-auto mb-4">
            <div class="row justify-content-between">
              <div class="col-4 col-md-2 col-sm-3 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="project_name">Project ID:</label>
                  <input type="text" name="project_name" id="project_deets" class="form-control" placeholder="" style="background-color: #fff;" readonly />
                </div>
              </div>
              <div class="col-4 col-md-3 mb-4 me-4">
                <div class="form-outline">
                  <label class="form-label" for="project_name">Date Submitted:</label>
                  <input type="text" name="project_name" id="project_deets" class="form-control" placeholder="" style="background-color: #fff;" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_name">Project name:</label>
                    <input type="text" name="project_name" id="project_deets" class="form-control form-control-lg" placeholder="<?php echo $pn; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Project name field cannot be blank!</div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="venue">Venue:</label>
                    <input type="text" name="venue" id="project_deets" class="form-control form-control-lg" placeholder="<?php echo $v; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Venue field cannot be blank!</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <label class="form-label select-label" for="project_type">Project Status:</label>
                  <select class="mt-0 ms-0 form-select" name="project_type" id="project_deets" style="background-color: #fff;" readonly>
                    <option class="greyclr" selected disabled value=""></option>
                    <option value="Curricular">Curricular</option>
                    <option value="Extra Curricular">Extra Curricular</option>
                    <option value="Outreach">Outreach</option>
                  </select>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="start_date">Start Date:</label>
                    <input type="text" class="form-control" name="start_date" id="project_deets" value="" placeholder="<?php echo $sd; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Date field Invalid!</div>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="end_date">End Date:</label>
                    <input type="text" class="form-control" name="end_date" id="project_deets" value="" placeholder="<?php echo $ed; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Date field Invalid!</div>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label select-label" for="project_type">Project Type:</label>
                  <select class="mt-0 ms-0 form-select" name="project_type" id="project_deets" style="background-color: #fff;" readonly>
                    <option class="greyclr" selected disabled value=""><?php echo $pt; ?></option>
                    <option value="Curricular">Curricular</option>
                    <option value="Extra Curricular">Extra Curricular</option>
                    <option value="Outreach">Outreach</option>
                  </select>
                  <div class="valid-feedback"> </div>
                  <div class="invalid-feedback">Project Type field cannot be blank!</div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label select-label" for="budget_source">Budget Source:</label>
                  <select class="mt-0 ms-0 form-select" name="budget_source" id="project_deets" style="background-color: #fff;" readonly>
                    <option class="greyclr" selected disabled value=""><?php echo $bs; ?></option>
                    <option value="Student Council">Student Council</option>
                    <option value="(Main org)">(Main org)</option>
                  </select>
                  <div class="valid-feedback"> </div>
                  <div class="invalid-feedback">Category field cannot be blank!</div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label select-label" for="project_category">Category:</label>
                  <select class="mt-0 ms-0 form-select" name="project_category" id="project_deets" style="background-color: #fff;" readonly>
                    <option class="greyclr" selected disabled value=""><?php echo $pc; ?></option>
                    <option value="Onsite">Onsite</option>
                    <option value="Online">Online</option>
                  </select>
                  <div class="valid-feedback"> </div>
                  <div class="invalid-feedback">Category field cannot be blank!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="participants">Participants:</label>
                    <input type="text" name="participants" id="project_deets" class="form-control form-control-md" placeholder="<?php echo $p; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Participants field cannot be blank!</div>
                  </div>
                </div>

                <div class="col-12 col-md-6 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="beneficiary">Beneficiary:</label>
                    <input type="text" name="beneficiary" id="project_deets" class="form-control form-control-md" placeholder="<?php echo $b; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Beneficiary field cannot be blank!</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-3 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="no_of_participants">No. of Participants:</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_participants" maxlength="4" id="project_deets" class="form-control" placeholder="<?php echo $nop; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Number of Participants field cannot be blank!</div>
                  </div>
                </div>
                <div class="col-12 col-md-3 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="no_of_beneficiary">No. of Beneficiary:</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="no_of_beneficiary" maxlength="4" id="project_deets" class="form-control" placeholder="<?php echo $nob; ?>" style="background-color: #fff;" readonly />
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Number of Beneficiary field cannot be blank!</div>
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
                    <label class="form-label" for="estimated_budget">Estimated Budget:</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" name="estimated_budget" id="project_deets" class="form-control currency" placeholder="<?php echo $eb; ?>" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="project_desc">Project Description:</label>
                    <textarea class="form-control" name="project_desc" id="project_deets" placeholder="<?php echo $pd; ?>" rows="6" style="background-color: #fff;" readonly></textarea>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Project Description field cannot be blank!</div>
                  </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                  <a class="btn btn-lg btn-outline-secondary" href="javascript:history.back()" role="button" id="butt">Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
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
      Waves.attach('#butt');
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
    -<script src="../assets/js/date.js"></script>
    <!-- Datepicker cdn
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
        </script>  -->
</body>

</html>