<?php
ob_start();
session_start();

include('../router.php');
route(2);

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
    header('location:officer-orgs.php');
  }
}

$_SESSION['ORG'] = $orgName;
$_SESSION['ORG_ID'] = $orgid;

$logoPic = getOrgLogo($orgid);
$data_userid = $_SESSION['USER-ID'];
$data_orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  ["Academic", "officer-orgs-acad.php", "bi bi-book-fill"],
  ["$orgName", "officer-orgs-rso.php?id=$orgid", ""],
  ["Members", "", "bi bi-file-person"],
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- Datatable Default-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">


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

      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h4>JRU Student Organizations - Members Masterlist</h4>
        </div>
      </div>

      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-3 pt-4 ">
          <div class="row g-0 justify-content-center ">
            <div class="table-responsive ms-2">
              <?php
              $query = "SELECT * FROM tb_students WHERE MORG_ID = '$orgid' OR ORG_IDS LIKE '%,[$orgid]%'";
              $result = @mysqli_query($conn, $query);
              $i = 0;
              $ds = " ";
              $pi = " ";
              $pn = " ";
              $v = " ";
              $s = " ";
              echo "<table id='admin-user-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Student ID</th>
                                <th class='desktop'>First Name</th>
                                <th class='desktop'>Middle Name</th>
                                <th class='desktop'>Last name</th>
                                <th class='desktop'>Age</th>
                                <th class='desktop'>Gender</th>
                                <th class='desktop'>Actions</th>
                                <th class='none'>Course</th>
                                <th class='none'>Email</th>
                                <th class='none'>Birthdate</th>
                                <th class='none'>Year Level</th>
                                <th class='none'>Section</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
              /*
                      <th>College</th>
                      <th>Organization</th>
                      <th>Position</th>
                      <th>Account Created</th>
                      */
              if ($result !== false && $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $si = $row['STUDENT_ID'];
                  $fn = $row['FIRST_NAME'];
                  $mn = $row['MIDDLE_NAME'];
                  $ln = $row['LAST_NAME'];
                  $a = $row['AGE'];
                  $g = $row['GENDER'];
                  $e = $row['EMAIL'];
                  $bd = $row['BIRTHDATE'];
                  $yl = $row['YEAR_LEVEL'];
                  $se = $row['SECTION'];
                  $c = $row['COURSE'];
                  echo "<tr>
                              <td> $si  </td>
                              <td> $fn  </td>
                              <td> $mn  </td>
                              <td> $ln  </td>
                              <td> $a </td>
                              <td> $g</td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $si . "'> <i class='bi bi-list-ul'></i> </button>
                              </td>
                              <td> $c</td>
                              <td> $e </td>
                              <td> $bd  </td>
                              <td> $yl </td>
                              <td> $se</td>
                              </tr>
                          ";
                  /*
                          <td>College</td>
                          <td>Organization</td>
                          <td>Position</td>
                          <th>Account Created</th>
                        */
                }
                echo "</tbody>
                        </table>";
              }
              //$conn->close();
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
        <form action="" method="POST">
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
                    <input type="text" name="FIRST_NAME" id="FIRST_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="MIDDLE_NAME">Middle Name:</label>
                    <input type="text" name="MIDDLE_NAME" id="MIDDLE_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;"readonly/>
                  </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                  <label class="form-label" for="LAST_NAME">Last Name:</label>
                  <input type="text" name="LAST_NAME" id="LAST_NAME" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4 d-none d-none">
                  <div class="form-outline">
                    <label class="form-label" for="BIRTHDATE">Birthdate:</label>
                    <input id="BIRTHDATE" class="form-control form-control-lg birthdate" data-relmax="-18" min="1922-01-01" type="date" name="BIRTHDATE" onblur="getAge();" title="You should be over 18 years old" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-2 mb-4 d-none">
                  <div class="form-outline">
                    <label class="form-label" for="AGE">Age:</label>
                    <input type="number" class="form-control age" name="AGE" id="AGE" maxlength="2" max="99" min="18" style="background-color: #fff;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="display:none;" readonly />
                  </div>
                </div>
                <div class="col-6 col-md-4 mb-4 d-none ">
                  <label class="form-label" for="GENDER">Gender </label>
                  <select class="form-select" name="GENDER" id="GENDER"readonly>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-4 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="YEAR_LEVEL">Year Level:</label>
                    <select class="form-select" name="YEAR_LEVEL" id="YEAR_LEVEL"readonly>
                      <option value="1">Year 1</option>
                      <option value="2">Year 2</option>
                      <option value="3">Year 3</option>
                      <option value="4">Year 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="SECTION">Section:</label>
                    <input type="text" name="SECTION" id="SECTION" class="form-control" maxlength="4" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-4 col-sm-3 mb-2">
                  <label class="form-label" for="EMAIL">Email:</label>
                  <input type="text" name="EMAIL" id="EMAIL" class="form-control" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30" style="background-color: #fff;" readonly />
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="COLLEGE_DEPT">College:</label>
                    <select class="form-select" name="COLLEGE_DEPT" id="COLLEGE_DEPT"readonly>
                      <?php
                      $query = "SELECT * FROM tb_collegedept";
                      $result = @mysqli_query($conn, $query);
                      while ($data = @mysqli_fetch_array($result)) {
                        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label select-label" for="COURSE">Course:</label>
                    <select class="form-select" style="width:100%;" name="COURSE" id="COURSE"readonly>
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
                <div class="col-12 col-md-4 mb-4 d-none">
                  <div class="form-outline">
                    <label class="form-label" for="MORG_ID">Academic Organization:</label>
                    <select class="form-select" name="MORG_ID" id="MORG_ID"readonly>
                      <?php
                      $query = "SELECT ORG_ID,ORG FROM tb_orgs";
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
                <div class="col-12 col-md-4 mb-4 d-none d-none">
                  <div class="form-outline">
                    <label class="form-label" for="USER_TYPE">User Type:</label>
                    <select class="form-select" name="USER_TYPE" id="USER_TYPE"readonly>
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
                <div class="col-12 col-md-4 mb-4 d-none d-none">
                  <div class="form-outline">
                    <label class="form-label" for="USER_TYPE">Password:</label>
                    <input type="password" name="PASSWORD" id="PASSWORD" class="form-control" readonly />
                  </div>
                </div>
                 <div class="col-12 col-md-4 mb-4 d-none">
                  <div class="form-outline">
                    <label class="form-label" for="position_id">Officer position:</label>
                    <select class="form-select" name="position_id" id="position_id"readonly>
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
            <div class="row">
              <div class="col-12 col-md-12 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="BIO">Member Information:</label>
                    <textarea class="form-control" name="BIO" id="BIO" rows="3"  style="background-color: #fff;" readonly></textarea>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        url: "rso-fetch-user.php",
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
          $('input[type=radio][id="GENDER"][value=' + data.GENDER + ']').prop('checked', true);
          $('#YEAR_LEVEL').val(data.YEAR_LEVEL);
          $('#EMAIL').val(data.EMAIL);
          $('#COLLEGE_DEPT').val(data.COLLEGE_DEPT);
          $('#COURSE').val(data.COURSE);
          $('#SECTION').val(data.SECTION);
          $('#MORG_ID').val(data.MORG_ID);
          $('#USER_TYPE').val(data.USER_TYPE);
          $('#PASSWORD').val(data.PASSWORD);
          $('#PROFILE_PIC').val(data.PROFILE_PIC);
          $('#BIO').val(data.BIO);
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
            title: 'JRU Student Organizations - Members Masterlist',
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
            title: 'JRU Student Organizations - Members Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Student Organizations - Members Masterlist',
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

  <!--input mask-->
  <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
  <script src="../assets/js/inputmask-validation.js"></script>

  <!--password validation!-->
  <script src="../assets/js/pass-validation.js"></script>

  <!-- age validation !-->
  <script src="../assets/js/age-validation.js"></script>

</body>

</html>
