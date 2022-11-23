<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "User Management / Students";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["User Management", "admin-users.php", ""],
  ["Students", "admin-students.php", ""],
  ["Masterlist", "", ""],
];

if (isset($_SESSION['msg'])) {
  print_r($_SESSION['msg']); #display message
  unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
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

      <!-- Display status message -->
      <?php if(!empty($statusMsg)){ ?>
    <div class='col-xs-12' id='box'>
          <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
      </div>
      <?php } ?>
      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4>Students Bulk Register</h4>
        </div>
    <!-- Page content-->
        <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
        </div>
      </div>

      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-3 pt-4 ">
          <div class="row">
            <form action="bulk-register.php" method="post" enctype="multipart/form-data">
              <div class="col-12 col-md-6 col-sm-3 mb-4" id="importFrm" style="display: none;">
                  <label class="form-label mb-2" for="attachments" id="asterisk">Import CSV:</label>
                  <div class="d-flex">
                  <input class="form-control mr-1" type="file" name="file" required>
                  <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                </div>
                <div class="col-12 col-md-6 col-sm-3 mb-4 pt-4">

                </div>

              </div>
            </form>
</div>
    <!-- Data list table -->
            <table class="table table-striped table-bordered">
       <thead>
           <tr>
               <th>#ID</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Email</th>
           </tr>
       </thead>
       <tbody>
       <?php
       // Get member rows
       $result = $conn->query("SELECT * FROM tb_students2 ORDER BY USER_ID ASC");
       if($result->num_rows > 0){
           while($row = $result->fetch_assoc()){
       ?>
           <tr>
                <td><?php echo $row['USER_ID']; ?></td>
               <td><?php echo $row['FIRST_NAME']; ?></td>
               <td><?php echo $row['LAST_NAME']; ?></td>
               <td><?php echo $row['EMAIL']; ?></td>
           </tr>
       <?php } }else{ ?>
           <tr><td colspan="5">No member(s) found...</td></tr>
       <?php } ?>
       </tbody>
   </table>
          </div>


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
      <!-- Show/hide CSV upload form -->
      <script>
      function formToggle(ID){
          var element = document.getElementById(ID);
          if(element.style.display === "none"){
              element.style.display = "block";
          }else{
              element.style.display = "none";
          }
      }
      </script>
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
  <!-- Student Modal -->
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Update Student Details </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-update-users.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-12 col-md-2 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="STUDENT_ID">Student ID:</label>
                    <input type="text" name="STUDENT_ID" id="STUDENT_ID" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ACCOUNT_CREATED">Account Created:</label>
                    <input type="text" name="ACCOUNT_CREATED" id="ACCOUNT_CREATED" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="FIRST_NAME">First name:</label>
                    <input type="text" name="FIRST_NAME" id="FIRST_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;" required />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="MIDDLE_NAME">Middle Name:</label>
                    <input type="text" name="MIDDLE_NAME" id="MIDDLE_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;" />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <label class="form-label" for="LAST_NAME">Last Name:</label>
                  <input type="text" name="LAST_NAME" id="LAST_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;" required />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="BIRTHDATE">Birthdate:</label>
                    <input id="BIRTHDATE" class="form-control form-control-lg birthdate" data-relmax="-18" min="1922-01-01" type="date" name="BIRTHDATE" onblur="getAge();" title="You should be over 18 years old" required />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="AGE">Age:</label>
                    <input type="number" class="form-control age" name="AGE" id="AGE" maxlength="2" max="99" style="background-color: #fff;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="display:none;" required />
                  </div>
                </div>
                <div class="col-6 col-md-4 mb-4 ">
                  <label class="form-label" for="GENDER">Gender </label>
                  <select class="form-select" name="GENDER" id="GENDER">
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="YEAR_LEVEL">Year Level:</label>
                    <select class="form-select" name="YEAR_LEVEL" id="YEAR_LEVEL">
                      <option value="1">Year 1</option>
                      <option value="2">Year 2</option>
                      <option value="3">Year 3</option>
                      <option value="4">Year 4</option>
                      <option value="5">Year 5</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="SECTION">Section:</label>
                    <input type="text" name="SECTION" id="SECTION" class="form-control" maxlength="4" style="background-color: #fff;" required />
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="EMAIL">Email:</label>
                  <input type="text" name="EMAIL" id="EMAIL" class="form-control" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30" style="background-color: #fff;" required />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="COLLEGE_DEPT">College:</label>
                    <select class="form-select" name="COLLEGE_DEPT" id="COLLEGE_DEPT">
                      <?php
                      $query = "SELECT college_id, college FROM tb_collegedept";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label select-label" for="COURSE">Course:</label>
                    <select class="form-select" style="width:100%;" name="COURSE" id="COURSE">
                      <?php
                      $query = "SELECT course FROM tb_course";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[0] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="USER_TYPE">User Type:</label>
                    <select class="form-select" name="USER_TYPE" id="USER_TYPE">
                      <?php
                      $query = "SELECT * FROM tb_usertypes WHERE usertype_id = '1' OR usertype_id = '2'";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="MORG_ID">Academic Organization:</label>
                    <select class="form-select" name="MORG_ID" id="MORG_ID">
                      <?php
                      $query = "SELECT ORG_ID, ORG FROM tb_orgs";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG_IDS">Non-Academic Organization:</label>
                    <select class="form-select" name="ORG_IDS" id="ORG_IDS">
                      <option class="greyclr" selected disabled value="" text-muted>------</option>
                      <option class="greyclr" value="" text-muted>Clear</option>
                      <?php
                      $query = "SELECT ORG_ID, ORG FROM tb_orgs WHERE org_type_id = 2 AND NOT ORG_ID = 26";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="position_id">Officer position:</label>
                    <select class="form-select" name="position_id" id="position_id">
                      <option class="greyclr" selected disabled value="" text-muted>------</option>
                      <?php
                      $query = "SELECT * FROM tb_position";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header py-3 px-3">
          <h5 class="modal-title" id="exampleModalLabel"> Archive Student Data </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-delete-user.php" method="POST">
          <div class="modal-body">
            <div class="col-12 col-md-12 justify-content-center ">
              <div class="form-outline">
                <label class="form-label" for="delete_id">Student ID:</label>
                <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly />
              </div>
            </div>
            <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving user data. Are you sure?</p>
          </div>
          <div class="modal-footer py-2 px-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="deletedata" class="btn btn-info">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <script>
    $(document).on('click', '.viewbtn', function() {
      var STUDENT_ID = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-user.php",
        method: "POST",
        data: {
          STUDENT_ID: STUDENT_ID
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#STUDENT_ID').val(data.STUDENT_ID);
          $('#ACCOUNT_CREATED').val(data.ACCOUNT_CREATED);
          $('#FIRST_NAME').val(data.FIRST_NAME);
          $('#MIDDLE_NAME').val(data.MIDDLE_NAME);
          $('#LAST_NAME').val(data.LAST_NAME);
          $('#BIRTHDATE').val(data.BIRTHDATE);
          $('#AGE').val(data.AGE);
          $('#GENDER').val(data.GENDER);
          $('#YEAR_LEVEL').val(data.YEAR_LEVEL);
          $('#EMAIL').val(data.EMAIL);
          $('#COLLEGE_DEPT').val(data.COLLEGE_DEPT);
          $('#COURSE').val(data.COURSE);
          $('#SECTION').val(data.SECTION);
          $('#ORG_IDS').val(data.ORG_IDS);
          $('#MORG_ID').val(data.MORG_ID);
          $('#USER_TYPE').val(data.USER_TYPE);
          $('#PASSWORD').val(data.PASSWORD);
          $('#PROFILE_PIC').val(data.PROFILE_PIC);
          $('#viewmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });

      // UPPERCASE FIRST LETTER
      document.getElementById("FIRST_NAME").addEventListener("input", forceLower);
      document.getElementById("MIDDLE_NAME").addEventListener("input", forceLower);
      document.getElementById("LAST_NAME").addEventListener("input", forceLower);
      // Event handling functions are automatically passed a reference to the
      // event that triggered them as the first argument (evt)
      function forceLower(evt) {
        // Get an array of desktop the words (in desktop lower case)
        var words = evt.target.value.toLowerCase().split(/\s+/g);

        // Loop through the array and replace the first letter with a cap
        var newWords = words.map(function(element) {
          // As long as we're not dealing with an empty array element, return the first letter
          // of the word, converted to upper case and add the rest of the letters from this word.
          // Return the final word to a new array
          return element !== "" ? element[0].toUpperCase() + element.substr(1, element.length) : "";
        });

        // Replace the original value with the updated array of capitalized words.
        evt.target.value = newWords.join(" ");
      }


    });
  </script>

  <script>
    $(document).on('click', '.deletebtn', function() {
      var STUDENT_ID = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-user.php",
        method: "POST",
        data: {
          STUDENT_ID: STUDENT_ID
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#delete_id').val(data.STUDENT_ID);
          $('#deletemodal').modal('show');
        }
      });
    });
  </script>
  <?php @mysqli_close($conn); ?>
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
  <script>
    $(document).ready(function() {
      $('#admin-user-table').DataTable({
        responsive: true,
        keys: true,
        fixedheader: true,
        bautoWidth: false,
        dom: 'Bfrtip',
        "bFilter": true,
        "columns": [{
            "width": "40px"
          },
          {
            "width": "40px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "130px"
          },
          {
            "width": "80px"
          },
          {
            "width": "150px"
          },
          {
            "width": "60px"
          },
          {
            "width": "60px"
          },
          {
            "width": "60px"
          },
          {
            "width": "60px"
          },
          {
            "width": "60px"
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -  Student Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11]
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
            title: 'JRU Organizations Portal - Student Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -  Student Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11]
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script> <!-- JavaScript validation -->
  <script type="text/javascript">
    Waves.attach('.button');
    Waves.init();
  </script>
  <!-- JavaScript validation -->
  <script src="../assets/js/bootstrap-validation.js"></script>
  <!-- <script src="js/form-validation.js"></script>
  Prevent Cut Copy Paste -->
  <script>
    $(document).ready(function() {
      $('input:text').bind('cut copy paste', function(e) {
        e.preventDefault();
        return false;
      });

    });
  </script>
  <script type="text/javascript">
    document.addEventListener('click', function handleClickOutsideBox(event) {
      const box = document.getElementById('box');

      if (!box.contains(event.target)) {
        box.style.display = 'none';
      }
    });
  </script>
  <!--input mask-->
  <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
  <script src="../assets/js/inputmask-validation.js"></script>

  <!--password validation!-->
  <script src="../assets/js/pass-validation.js"></script>

  <!-- age validation !-->
  <script src="../assets/js/age-validation.js"></script>

  <?php
  include('include/sweetalert.php');
  ?>
</body>

</html>