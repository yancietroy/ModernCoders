<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_username = $_SESSION['USER-NAME'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Projects";
$nav_breadcrumbs = [
  ["Home", "officer-index.php", "bi-house-fill"],
  ["Organizations", "officer-orgs.php", "bi-people-fill"],
  [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
  ["Projects", "officer-projects.php", ""],
  ["Budget Codes", "budget-codes.php", ""],
    ["Archive", "", ""],
];

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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datebicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimebicker/2.5.20/jquery.datetimebicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
          <h4 id="orgtitle">Position Archive</h4>
        </div>
      </div>

      <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
        <div class="card-body px-2 mx-3 py-2 pb-4">
          <div class="row g-0 mt-4 justify-content-center">
            <div class="table-responsive-md ms-0">
              <?php
              $query = "SELECT * FROM tb_budget_codes_archive";
              $result = @mysqli_query($conn, $query);
              $i = 0;
              $c = " ";
              echo "<table id='admin-user-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Budget ID</th>
                                <th class='desktop'>Code</th>
                                <th class='desktop'>Description</th>
                                  <th class='desktop'>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
              /*
                      <th>College</th>
                      <th>Position</th>
                      <th>Position</th>
                      <th>Account Created</th>
                      */
              if ($result !== false && $result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $bi = $row['id'];
                  $c = $row['code'];
                  $desc = $row['description'];
                  echo "<tr>
                              <td> $bi  </td>
                              <td> $c </td>
                              <td> $desc </td>
                              <td>
                            <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $bi . "'> <i class='bi bi-list-ul'></i> </button>
                              </td>
                              </tr>
                          ";
                  /*
                          <td>College</td>
                          <td>Position</td>
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
      </div>
      </div>

      <!-- Student Modal -->
      <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Restore Position</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="officer-restore-budget.php" method="POST">
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="row justify-content-between">
                    <div class="col-12 col-md-4 col-sm-3 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="id">Budget ID:</label>
                        <input type="text" name="id" id="id" class="form-control" style="background-color: #fff;" readonly />
                      </div>
                    </div>
                  </div>
                        <div class="row justify-content-between">
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="code">Budget Code:</label>
                        <input type="text" name="code" id="code" class="form-control" maxlength="50" />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                      <div class="form-outline">
                        <label class="form-label" for="desc">Budget Description:</label>
                        <input type="text" name="desc" id="desc" class="form-control" maxlength="50" />
                      </div>
                    </div>
                  </div>
                </div>
              <div class="modal-footer py-2 px-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="restoredata" class="btn btn-primary">Restore</button>
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
              <h5 class="modal-title" id="exampleModalLabel"> Archive Position </h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="admin-delete-position.php" method="POST">
              <div class="modal-body">
                <div class="col-12 col-md-12 justify-content-center ">
                  <div class="form-outline">
                    <label class="form-label" for="delete_id">Position ID:</label>
                    <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly />
                  </div>
                </div>
                <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving Position. Are you sure?</p>
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
            var id = $(this).attr("id");
            $.ajax({
              url: "officer-fetch-budget-archive.php",
              method: "POST",
              data: {
                id: id
              },
              dataType: "json",
              success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#code').val(data.code);
                $('#desc').val(data.description);
                $('#viewmodal').modal('show');
                $('#modal-lg').css('max-width', '70%');
              }
            });
          });
        </script>

        <script>
          $(document).on('click', '.deletebtn', function() {
            var id = $(this).attr("id");
            $.ajax({
              url: "officer-fetch-budget.php",
              method: "POST",
              data: {
                id: id
              },
              dataType: "json",
              success: function(data) {
                console.log(data);
                $('#delete_id').val(data.id);
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
           title: 'JRU Organizations Portal -  Position Masterlist',
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
           title: 'JRU Organizations Portal - Position Masterlist',
           footer: true,
           exportOptions: {
             columns: [0, 1]
           },
           orientation: 'landscape',
           pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
         },
         {
           extend: 'print',
           title: 'JRU Organizations Portal -  Position Masterlist',
           footer: true,
           exportOptions: {
             columns: [0, 1]
           },
           customize: function(win) {

             var last = null;
             var current = null;
             var bod = [];

             var css = '@page { size: portrait; font-size: 1em;}',
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
