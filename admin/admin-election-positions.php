<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Election";
$nav_breadcrumbs = [
  ["Home", "admin-index.php", "bi-house-fill"],
  ["Election", "admin-election.php", "bi-check2-square"],
  ["Positions", "", ""],
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
  <title>JRU Student Organizations Portal</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- Datatable Default-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
      <h4 class="ms-3">Candidate List</h4>
      <div class="ms-3 d-flex align-items-end justify-content-end">
        <a class="btn btn-default btn-circle button px-3" href="admin-elect-newCandidate.php" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">New Candidate </span></a>
      </div>
      <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-3 pt-4 ">
          <div class="row g-0 justify-content-center ">
            <div class="table-responsive ms-2">
              <?php
              $query = "SELECT  tb_candidate.CANDIDATE_ID, tb_candidate.STUDENT_NO, tb_candidate.FIRST_NAME, tb_candidate.MIDDLE_INITIAL, tb_candidate.LAST_NAME, tb_candidate.section, tb_candidate.course, tb_position.position, tb_orgs.ORG FROM tb_candidate JOIN tb_position ON tb_candidate.POSITION_ID = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_candidate.ORG_ID";
              $result = @mysqli_query($conn, $query);
              $i = 0;
              $ci = " ";
              $p = " ";
              $org = " ";
              $fn = " ";
              $mn = " ";
              $ln = " ";
              $s = " ";
              $c = " ";
              $si = " ";
              echo "<table id='admin-candidates-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Candidate ID</th>
                                <th class='desktop'>Student ID</th>
                                <th class='desktop'>Position</th>
                                <th class='none'>Organization: </th>
                                <th class='desktop'>First Name</th>
                                <th class='none'>Middle Initial</th>
                                <th class='desktop'>Last name</th>
                                <th class='none'>Section</th>
                                <th class='none'>Course: </th>
                                <th class='desktop'>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
              if ($result !== false && $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $ci = $row['CANDIDATE_ID'];
                  $si = $row['STUDENT_NO'];
                  $p = $row['position'];
                  $org = $row['ORG'];
                  $fn = $row['FIRST_NAME'];
                  $mn = $row['MIDDLE_INITIAL'];
                  $ln = $row['LAST_NAME'];
                  $s = $row['section'];
                  $c = $row['course'];

                  echo "<tr>
                              <td> $ci  </td>
                              <td> $si  </td>
                              <td> $p  </td>
                              <td> $org  </td>
                              <td> $fn  </td>
                              <td> $mn </td>
                              <td> $ln </td>
                              <td> $s </td>
                              <td> $c </td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $si . "'> <i class='bi bi-list-ul'></i> </button>
                              <button type='button' class='btn btn-secondary btn-sm deletebtn' id='" . $si . "'>  <i class='bi bi-archive-fill'></i> </button>
                              </td>
                              </tr>
                          ";
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
  </div>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <!-- Sidebar collapse -->
  <script src="../assets/js/form-validation.js"></script>
  <!-- Waves CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script> <!-- JavaScript validation -->
  <script type="text/javascript">
    Waves.attach('#sidebar ul li a');
    Waves.init();
  </script>
  <!-- Datatable -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#admin-candidates-table').DataTable({
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
            "width": "70px"
          }
        ],
        select: 'single',
        buttons: [
          'pageLength',
          {
            extend: 'excelHtml5',
            title: 'JRU Organizations Portal -  Officer Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            title: 'JRU Organizations Portal - Officer Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
          },
          {
            extend: 'print',
            title: 'JRU Organizations Portal -  Officer Masterlist',
            footer: true,
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
</body>

</html>