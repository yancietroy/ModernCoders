<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:admin-login.php");
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
  <link rel="stylesheet" href="assets/css/style.css">

<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

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
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="admin-index.php">
          <img src="assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
      <li class="active">
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li class="active">
                <a href="admin-users.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
                <a href="#"><i class="las la-chalkboard-teacher"></i> <span>Officers</span></a>
            </li>
            <li>
                <a href="#"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
          <ul class="collapse list-unstyled" id="orgsSubmenu">
              <li>
                <a href="admin-users.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-copy"></i> <span>Projects</span></a>
            </li>
            <li>
                <a href="#"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="admin-users.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="#"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="#"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>
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
                  <img class="rounded-circle me-lg-2" src="assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
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
                  <li><a class="dropdown-item" href="admin-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Students</li>
        </ol>
      </nav>

      <!-- Page content -->
      <div class="table-responsive" id="tb">
  <div class="row justify-content-center align-items-center">
  <div class="col-md-11 ">
    <div class="row">
   <div class="col-xs-12">
    <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addStudentModal" class="btn btn-success btn-sm">Add User</a>
        </div>
        <table id='example' class='table table-striped dt-responsive nowrap w-100' style='width:100%'>
              <thead>
                              <th>Student ID</th>
                              <th>First Name</th>
                              <th>Middle Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Year Level</th>
                              <th>Age</th>
                              <th>Birth date</th>
                              <th>Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
<!--<?php/**
                  $query = "SELECT STUDENT_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME, GENDER, EMAIL, YEAR_LEVEL, BIRTHDATE, AGE FROM tb_students";
                  $result = @mysqli_query($conn,$query);
                  $i = 0;
                  $sid = " ";
                  $fname = " ";
                  $mname = " ";
                  $lname = " ";
                  $gender = " ";
                  $email = " ";
                  $ylevel = " ";
                  $bdate = " ";
                  $age = " ";
                  echo "<table id='example' class='table table-striped dt-responsive nowrap w-100' style='width:100%'>
                        <thead>
                          <tr>
                              <th>Student ID</th>
                              <th>First Name</th>
                              <th>Middle Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Year Level</th>
                              <th>Age</th>
                              <th>Birth date</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
                  if ($result !== false && $result->num_rows > 0)
                  {
                      // output data of each row
                      while($row = $result->fetch_assoc())
                      {
                      $sid = $row["STUDENT_ID"];
                      $fname = $row["FIRST_NAME"];
                      $mname = $row["MIDDLE_NAME"];
                      $lname = $row["LAST_NAME"];
                      $gender = $row["GENDER"];
                      $email = $row["EMAIL"];
                      $ylevel = $row["YEAR_LEVEL"];
                      $bdate =  $row["BIRTHDATE"];
                      $age =$row["AGE"];

                      echo "<tr>
                            <td> $sid  </td>
                            <td> $fname  </td>
                            <td> $mname  </td>
                            <td> $lname  </td>
                            <td> $gender  </td>
                            <td> $email  </td>
                            <td> $ylevel  </td>
                            <td> $age </td>
                            <td> $bdate  </td>                            
                            </tr>
                          ";
                      }
                  }
                  echo "</tbody>
                        <tfoot>
                            <tr>
                              <th>Student ID</th>
                              <th>First Name</th>
                              <th>Middle Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Year Level</th>
                              <th>Age</th>
                              <th>Birth date</th>
                            </tr>
                        </tfoot>
                        </table>";
                  $conn->close();**/
                  ?>-->
                  
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
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetchdata-admin-user.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "defaultContent": "-",
            "aTargets": "_all"
          },

        ],

      });
    });
        $(document).on('submit', '#addStudent', function(e) {
      e.preventDefault();
      var STUDENT_ID = $('#addStudentIdField').val();
      var FIRST_NAME = $('#addFirstNameField').val();
      var MIDDLE_NAME = $('#addMiddleNameField').val();
      var LAST_NAME = $('#addLastNameField').val();
      var GENDER = $('#addGenderField').val();
      var EMAIL = $('#addEmailField').val();
      var YEAR_LEVEL = $('#addYearLevelField').val();
      var BIRTHDATE = $('#addBirthDateField').val();
      var AGE = $('#addAgeField').val();
      if (STUDENT_ID != '' && FIRST_NAME != '' && MIDDLE_NAME != '' && LAST_NAME != '' && GENDER != '' && EMAIL != '' && YEAR_LEVEL != '' && BIRTHDATE != '' && AGE != '') {
        $.ajax({
          url: "add_admin_user.php",
          type: "post",
          data: {
            STUDENT_ID: STUDENT_ID,
            FIRST_NAME: FIRST_NAME,
            MIDDLE_NAME: MIDDLE_NAME,
            LAST_NAME: LAST_NAME,
            GENDER: GENDER,
            EMAIL: EMAIL,
            YEAR_LEVEL: YEAR_LEVEL,
            BIRTHDATE: BIRTHDATE,
            AGE: AGE
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addStudentModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateStudent', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var STUDENT_ID = $('#STUDENT_ID').val();
      var FIRST_NAME = $('#editFirstNameField').val();
      var MIDDLE_NAME = $('#editMiddleNameField').val();
      var LAST_NAME = $('#editLastNameField').val();
      var GENDER = $('#editGenderField').val();
      var EMAIL = $('#editEmailField').val();
      var YEAR_LEVEL = $('#editYearLevelField').val();
      var BIRTHDATE = $('#editBirthDateField').val();
      var AGE = $('#editAgeField').val();
      var trid = $('#trid').val();
      if (STUDENT_ID != '' && FIRST_NAME != '' && MIDDLE_NAME != '' && LAST_NAME != '' && GENDER != '' && EMAIL != '' && YEAR_LEVEL != '' && BIRTHDATE != '' && AGE != '') {
        $.ajax({
          url: "update_admin_user.php",
          type: "post",
          data: {
            STUDENT_ID: STUDENT_ID,
            FIRST_NAME: FIRST_NAME,
            MIDDLE_NAME: MIDDLE_NAME,
            LAST_NAME: LAST_NAME,
            GENDER: GENDER,
            EMAIL: EMAIL,
            YEAR_LEVEL: YEAR_LEVEL,
            BIRTHDATE: BIRTHDATE,
            AGE: AGE
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="javascript:void();" data-id="' + STUDENT_ID + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + STUDENT_ID + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([STUDENT_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME, GENDER, EMAIL, YEAR_LEVEL, BIRTHDATE, AGE, button]);
              $('#updateStudentModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var STUDENT_ID = $(this).data('STUDENT_ID');
      $('#updateStudentModal').modal('show');
      $.ajax({
        url: "get_admin_data.php",
        data: {
          STUDENT_ID: STUDENT_ID
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#editFirstNameField').val(json.FIRST_NAME);
          $('#editMiddleNameField').val(json.MIDDLE_NAME);
          $('#editLastNameField').val(json.LAST_NAME);
          $('#editGenderField').val(json.GENDER);
          $('#editEmailField').val(json.EMAIL);
          $('#editYearLevelField').val(json.YEAR_LEVEL);
          $('#editBirthDateField').val(json.BIRTHDATE);
          $('#editAgeField').val(json.AGE);
          $('#STUDENT_ID').val(STUDENT_ID);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var STUDENT_ID = $(this).data('STUDENT_ID');
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "delete_admin_user.php",
          data: {
            STUDENT_ID: STUDENT_ID
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + STUDENT_ID).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    })
  </script>
  <!-- Modal -->
  <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateStudent" post = "">
            <input type="hidden" name="STUDENT_ID" id="STUDENT_ID" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="editFirstNameField" class="col-md-3 form-label">First Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="editFirstNameField" name="firstName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editMiddleNameField" class="col-md-3 form-label">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="editMiddleNameField" name="middleName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editLastNameField" class="col-md-3 form-label">Last Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="editLastNameField" name="lastName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editGenderField" class="col-md-3 form-label">Gender</label>
              <div class="col-md-9">
                <select class="form-select form-select-sm" name="gender" id="editGenderField">
                      <option class="greyclr" selected disabled value="" text-muted>Select Gender</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>                 
                    </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="editEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editYearLevelField" class="col-md-3 form-label">Year Level</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="editYearLevelField" name="yearLevel">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addBirthDateField" class="col-md-3 form-label">Birth Date</label>
              <div class="col-md-9">
                <input id="addBirthDateField" class="form-control form-control-lg" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old"/>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="editAgeField" class="col-md-3 form-label">Age</label>
              <div class="col-md-9">
                <input type="text" name="age" id="addAgeField" maxlength="2" class="form-control form-control-lg" style="background-color: #fff;" readonly />
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addStudent" action="">
            <div class="mb-3 row">
              <label for="addStudentIdField" class="col-md-3 form-label">Student ID</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addStudentIdField" name="studentID">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addFirstNameField" class="col-md-3 form-label">First Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addFirstNameField" name="firstName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMiddleNameField" class="col-md-3 form-label">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMiddleNameField" name="middleName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addLastNameField" class="col-md-3 form-label">Last Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addLastNameField" name="lastName">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addGenderField" class="col-md-3 form-label">Gender</label>
              <div class="col-md-9">
                <select class="form-select form-select-sm" name="gender" id="addGenderField">
                      <option class="greyclr" selected disabled value="" text-muted>Select Gender</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>                 
                    </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="addEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addYearLevelField" class="col-md-3 form-label">Year Level</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addYearLevelField" name="yearLevel">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addBirthDateField" class="col-md-3 form-label">Birth Date</label>
              <div class="col-md-9">
                <input id="addBirthDateField" class="form-control form-control-lg" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old"/>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addAgeField" class="col-md-3 form-label">Age</label>
              <div class="col-md-9">
                <input type="text" name="age" id="addAgeField" maxlength="2" class="form-control form-control-lg" style="background-color: #fff;" />
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">

  function getAge(){
      var dob = document.getElementById('addBirthDateField').value;
      dob = new Date(dob);
      var today = new Date();
      var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
      document.getElementById('addAgeField').value=age;
  }

  $(function () {
      $('input[data-relmax]').each(function () {
          var oldVal = $(this).prop('value');
          var relmax = $(this).data('relmax');
          var max = new Date();
          max.setFullYear(max.getFullYear() + relmax);
          $.prop(this, 'max', $(this).prop('valueAsDate', max).val());
          $.prop(this, 'value', oldVal);
      });
  });
  </script>

  <!--<script>
    $(document).ready(function(){
     
      /**var columnDefs = [{
        data: "STUDENT_ID",
        title: "Student ID",
        type: "readonly"
      },
      {
        data: "FIRST_NAME",
        title: "First Name"
      },
     {
        data: "MIDDLE_NAME",
        title: "Middle Name"
      },
     {
        data: "LAST_NAME",
        title: "Last Name"
      },
     {
        data: "GENDER",
        title: "Gender"
      },
     {
        data: "EMAIL",
        title: "Email"
      },
     {
        data: "YEAR_LEVEL",
        title: "Year Level"
      },
      {
        data: "AGE",
        title: "Age"
      },
      {
        data: "BIRTHDATE",
        title: "Birth date"
      },
     
  ];**/


        var myTable;
      myTable =  $('#admin-user-table').DataTable({
          responsive: true,
          keys: true,
          select: true,
          //  dom: 'Bfrtip',"bFilter": true,
          dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          "bFilter": true,
          select: 'single',
          responsive: true,
          altEditor: true,
          "aLengthMenu": [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"]
          ],
          buttons: [
            'pageLength',
          'copyHtml5',
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
            {
            text: 'Add',
            name: 'add'        // do not change name
            },
            {
            extend: 'selected', // Bind to Selected row
            text: 'Edit',
            name: 'edit'        // do not change name
            },
            {
            extend: 'selected', // Bind to Selected row
            text: 'Delete',
            name: 'delete'      // do not change name
            }
          ]
        });
      // Edit
    $(document).on('click', "[id^='admin-user-table'] tbody ", 'tr', function () {
      var tableID = $(this).closest('table').attr('id');    // id of the table
      var that = $( '#'+tableID )[0].altEditor;
      that._openEditModal();
      $('#altEditor-edit-form-' + that.random_id)
                  .off('submit')
                  .on('submit', function (e) {
                      e.preventDefault();
                      e.stopPropagation();
                      that._editRowData();
                  });
    });

    // Delete
    $(document).on('click', "[id^='admin-user-table'] .delbutton", 'tr', function (x) {
      var tableID = $(this).closest('table').attr('id');    // id of the table
      var that = $( '#'+tableID )[0].altEditor;
      that._openDeleteModal();
      $('#altEditor-delete-form-' + that.random_id)
                  .off('submit')
                  .on('submit', function (e) {
                      e.preventDefault();
                      e.stopPropagation();
                      that._deleteRow();
                  });
      x.stopPropagation(); //avoid open "Edit" dialog
    });

    // Add row
    $('#addbutton').on('click', function () {
      var that = $( '#admin-user-table' )[0].altEditor;
      that._openAddModal();
      $('#altEditor-add-form-' + that.random_id)
                  .off('submit')
                  .on('submit', function (e) {
                      e.preventDefault();
                      e.stopPropagation();
                      that._addRowData();
                  });
    });
});
   </script>
<script src="assets/js/dataTables.altEditor.free.js" ></script>-->
</body>

</html>
