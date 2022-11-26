<?php
ob_start();
session_start();

include('../router.php');
route(3);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = "";
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
    if ($orgRes->num_rows > 0) {
        $row = $orgRes->fetch_assoc();
        $orgName = $row['ORG'];
    } 
}

$data_userid = $_SESSION['USER-ID'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
$data_orgid = $_SESSION['USER-ORG'];
$data_collegeid = $_SESSION['USER-COLLEGE'];
$collName = "";
$_SESSION['college'] = $collName;
$query = "SELECT college FROM tb_collegedept WHERE college_id='$data_collegeid'";
if ($collRes = @mysqli_query($conn, $query)) {
  if ($collRes->num_rows > 0) {
    $row = $collRes->fetch_assoc();
    $collName = $row['college'];
  } 
}
$data_picture = getProfilePicture(3, $data_userid);
$nav_selected = "Organizations / Organization";
$nav_breadcrumbs = [
    ["Home", "signatory-index.php", "bi-house-fill"],
    ["Organizations", "", "bi bi-diagram-3-fill"],
    ["$orgName", "signatory-orgs-rso.php?id=$orgid", ""],
    ["Survey", "signatory-rso-survey.php?id=$orgid", ""],
    ["Survey List", "", ""],
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
            <div class="row ms-3 me-3 mt-2 mb-2">
                <div class="col-lg-6 col-7">
                    <h4>Survey Masterlist</h4>
                </div>
            </div>

            <input type="text" style="display: none;" id="org-id" value="<?= $orgid ?>">
            <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
                <div class="card-body px-2 mx-3 py-3 pt-4 ">
                    <div class="row g-0 justify-content-center ">
                        <div class="table-responsive ms-2">
                            <table id='survey-table' class='py-3 display nowrap w-100 ms-0 stud'>
                                <thead>
                                    <tr>
                                                <th class="desktop">Survey ID</th>  <th class="desktop">Survey Title</th>
                                        <th class="desktop">Status</th>
                                        <th class="desktop">Start Date</th>
                                        <th class="desktop">End Date</th>
                                        <th class="desktop">Actions</th>
                                        <th class="none">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tb_surveys WHERE org_id='$orgid' ORDER BY survey_id DESC";
                                    $res = @mysqli_query($conn, $sql);
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                               <td><?= $row['survey_id'] ?></td>    <td><?= $row['title'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['start_date'] < date('Y-m-d') && $row['end_date'] < date('Y-m-d')) {
                                                        echo "Completed";
                                                    } else if ($row['start_date'] > date('Y-m-d') && $row['end_date'] > date('Y-m-d')) {
                                                        echo "Upcoming";
                                                    } else {
                                                        echo "Ongoing";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $row['start_date'] ?></td>
                                                <td><?= $row['end_date'] ?></td>
                                                <td>
                                                    <button type='button' class='btn btn-success btn-sm viewbtn' id="<?= $row['survey_id'] ?>"> <i class='bi bi-list-ul'></i> </button>
                                                    <button type='button' class='btn btn-warning text-white btn-sm resultbtn' id="<?= $row['survey_id'] ?>"> <i class='bi bi-bar-chart-steps'></i> </button>
                                                    <!--<button type='button' class='btn btn-secondary btn-sm deletebtn' id="<?= $row['survey_id'] ?>"> <i class=' bi bi-archive-fill'></i> </button>-->
                                                </td>
                                                <td><?= $row['description'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
    </div>

    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-3 px-3">
                    <h5 class="modal-title" id="exampleModalLabel"> Archive Survey Data </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="include/admin-archive-survey.php" method="POST">
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <label class="form-label" for="delete_id">Survey ID:</label>
                                <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly />
                            </div>
                        </div>
                        <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving survey data. Are you sure?</p>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete-survey" class="btn btn-info">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    <script>
        $(document).on('click', '.viewbtn', function() {
            var SURVEY_ID = $(this).attr("id");
            var ORG_ID = $('#org-id').val();
            location.href = "signatory-rso-survey-view.php?id=" + ORG_ID + "&survey_id=" + SURVEY_ID;
        });
        $(document).on('click', '.resultbtn', function() {
            var SURVEY_ID = $(this).attr("id");
            var ORG_ID = $('#org-id').val();
            location.href = "signatory-rso-survey-result.php?id=" + ORG_ID + "&survey_id=" + SURVEY_ID;
        });
        $(document).on('click', '.deletebtn', function() {
            var SURVEY_ID = $(this).attr("id");
            $('#delete_id').val(SURVEY_ID);
            $('#deletemodal').modal('show');
        });
    </script>
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('#survey-table').DataTable({    "createdRow": function(row, data, dataIndex) {
          if (data[2] == "Ongoing") {
            $('td', row).eq(2).css('color', 'orange');
          }
          if (data[2] == "Completed") {
            $('td', row).eq(2).css('color', 'green');
          }
        },
                responsive: true,
                keys: true,
                fixedheader: true,
                bautoWidth: false,
                dom: 'Bfrtip',
                "bFilter": true,
                "columns": [{
                        "width": "200px"
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
                        },
                    {
                        "width": "300px"
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
                            columns: [0, 1, 2, 3, 5]
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
                        title: 'JRU Organizations Portal - Elections Masterlist',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
                        },
                        orientation: 'landscape',
                        pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
                    },
                    {
                        extend: 'print',
                        title: 'JRU Organizations Portal -  Elections Masterlist',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
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
        });
    </script>
</body>

</html>