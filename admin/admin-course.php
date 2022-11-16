<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Courses";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Site Management", "", ""],
  ["Courses", "", ""],
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

      <!-- Page content -->
      <div class="row ms-3 me-3 mt-2">
        <div class="col-lg-6 col-7">
          <h4 id="orgtitle">Course Masterlist</h4>
        </div>
        <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
          <a class="btn btn-default btn-circle button px-3" href="admin-course-reg.php" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">New Course </span></a>
          <a class="btn btn-secondary bg-secondary btn-circle button px-3 ms-2" href="admin-archive-course.php" role="button"><i class="bi bi-archive-fill"></i> <span id="btntitle"> Course Archive</span></a>
        </div>
      </div>

      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-3 pt-4 ">
          <div class="row g-0 justify-content-center ">
            <div class="table-responsive ms-2">
              <?php
              $query = "SELECT * FROM tb_course";
              $result = @mysqli_query($conn, $query);
              $i = 0;
              $course = " ";
              echo "<table id='admin-user-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Course ID</th>
                                <th class='desktop'>Course</th>
                                <th class='desktop'>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
              /*
                      <th>course</th>
                      <th>Organization</th>
                      <th>Position</th>
                      <th>Account Created</th>
                      */
              if ($result !== false && $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $ci = $row['course_id'];
                  $c = $row['course'];
                  echo "<tr>
                              <td> $ci  </td>
                              <td> $c  </td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $ci . "'> <i class='bi bi-list-ul'></i> </button>
                              <button type='button' class='btn btn-secondary btn-sm deletebtn' id='" . $ci . "'>  <i class='bi bi-archive-fill'></i>  </button>
                              </td>
                              </tr>
                          ";
                  /*
                          <td>course</td>
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
  <!-- Student Modal -->
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Update Course Details </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-update-course.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="course_id">Course ID:</label>
                    <input type="text" name="course_id" id="course_id" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="course">course Name:</label>
                    <label class="form-label" for="course">Course Name:</label>
                    <input type="text" name="course" id="course" class="form-control" onkeypress="return /[a-z, ,-]/i.test(event.key)" maxlength="100" />
                  </div>
                </div>
                <div class="col-12 col-md-12  mb-4">
                  <label class="form-label"> College</label>
                  <select class="form-select" style="width:100%;" name="college_id" id="college_id">
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
            </div>
          </div>
          <div class="modal-footer py-2 px-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
          <h5 class="modal-title" id="exampleModalLabel"> Archive Course </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-delete-course.php" method="POST">
          <div class="modal-body">
            <div class="col-12 col-md-12 justify-content-center ">
              <div class="form-outline">
                <label class="form-label" for="delete_id">Course ID:</label>
                <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly />
              </div>
            </div>
            <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving College data. Are you sure?</p>
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
      var course_id = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-course.php",
        method: "POST",
        data: {
          course_id: course_id
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#course_id').val(data.course_id);
          $('#course').val(data.course);
          $('#college_id').val(data.college_id);
          $('#viewmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });
    });
  </script>

  <script>
    $(document).on('click', '.deletebtn', function() {
      var course_id = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-course.php",
        method: "POST",
        data: {
          course_id: course_id
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#delete_id').val(data.course_id);
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
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -  Course Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1]
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
            title: 'JRU Organizations Portal - Course Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -  Course Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1]
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

  <?php
  include('include/sweetalert.php');
  ?>
</body>

</html>
