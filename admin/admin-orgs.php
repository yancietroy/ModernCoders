<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Site Management", "", ""],
  ["Organizations", "", ""],
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
          <h4 id="orgtitle">Student Organizations</h4>
        </div>
        <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
          <a class="btn btn-default btn-circle button px-3" href="admin-orgs-reg.php" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">New Org </span></a>
          <a class="btn btn-secondary bg-secondary btn-circle button px-3 ms-2" href="admin-orgs-archive.php" role="button"><i class="bi bi-archive-fill"></i> <span id="btntitle"> Org Archive</span></a>
        </div>
      </div>

      <div class="row ms-3 me-3 mt-2">
        <!--  <div class="col-lg-3 col-sm-6">
          <div class="card-counter primary">
            <div class="inner">
              <h2><i class="bi bi-diagram-3-fill"></i></h2>
              <p>Masterlist</p>
            </div>
            <div class="icon">
              <i class="bi bi-diagram-3-fill"></i>
            </div>
            <a href="admin-orgs-rso.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card-counter success">
            <div class="inner">
              <h2><i class="bi bi-pc-display"></i></h2>
              <p>rso</p>
            </div>
            <div class="icon">
                <i class="bi bi-pc-display"></i>
            </div>
            <a href="admin-orgs-rso.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>!-->
        <!--
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter danger">
            <div class="inner">
              <h2><i class="bi bi-person-x-fill"></i></h2>
              <p>Inactive</p>
            </div>
            <div class="icon">
              <i class="bi bi-person-x"></i>
            </div>
            <a href="admin-students-users-inactive.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-secondary">
            <div class="inner">
              <h2><i class="bi bi-archive-fill"></i></h2>
              <p>Archive</p>
            </div>
            <div class="icon">
              <i class="bi bi-archive"></i>
            </div>
            <a href="admin-orgs-archive.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>!-->

      </div>

      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-3 pt-4 ">
          <div class="row g-0 justify-content-center ">
            <div class="table-responsive ms-2">
              <?php
              $query = "SELECT * FROM tb_orgs";
              $result = @mysqli_query($conn, $query);
              $oi = 0;
              $org = " ";
              echo "<table id='admin-user-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Org ID</th>
                                <th class='desktop'>Organization</th>
                                <th class='desktop'>Actions</th>
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
                  $oi = $row['ORG_ID'];
                  $org = $row['ORG'];
                  echo "<tr>
                              <td> $oi  </td>
                              <td> $org  </td>
                              <td>
                              <button type='button' class='btn btn-primary btn-sm viewbtn' title='visit org' id='" . $oi . "'>  <i class='bi bi-eye'></i>  </button>
                              <button type='button' class='btn btn-secondary btn-sm deletebtn' title='archive org' id='" . $oi . "'>  <i class='bi bi-archive-fill'></i>  </button>
                              </td>
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
          <h5 class="modal-title" id="exampleModalLabel"> View Organization Details </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-update-orgs.php" method="POST">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row justify-content-between">
                <div class="col-12 col-md-4 col-sm-3 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG_ID">Organization ID:</label>
                    <input type="text" name="ORG_ID" id="ORG_ID" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="ORG">Organization name:</label>
                    <input type="text" name="ORG" id="ORG" class="form-control" maxlength="100" style="background-color: #fff;" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer py-2 px-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="updatedata" class="btn btn-success">Update Org</button>
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
          <h5 class="modal-title" id="exampleModalLabel"> Archive Oganization Data </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admin-delete-org.php" method="POST">
          <div class="modal-body">
            <div class="col-12 col-md-12 justify-content-center ">
              <div class="form-outline">
                <label class="form-label" for="delete_id">Organization ID:</label>
                <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly />
              </div>
            </div>
            <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving Organization. Are you sure?</p>
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
      var ORG_ID = $(this).attr("id");
      location.href = "admin-orgs-rso.php?id=" + ORG_ID;
    });

    $(document).on('click', '.editbtn', function() {
      var ORG_ID = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-org.php",
        method: "POST",
        data: {
          ORG_ID: ORG_ID
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#ORG_ID').val(data.ORG_ID);
          $('#ORG').val(data.ORG);
          $('#viewmodal').modal('show');
          $('#modal-lg').css('max-width', '70%');
        }
      });

      // UPPERCASE FIRST LETTER
      document.getElementById("ORG").addEventListener("input", forceLower);
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
      var ORG_ID = $(this).attr("id");
      $.ajax({
        url: "admin-fetch-org.php",
        method: "POST",
        data: {
          ORG_ID: ORG_ID
        },
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#delete_id').val(data.ORG_ID);
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

</body>

</html>
