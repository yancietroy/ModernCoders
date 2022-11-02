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
    ["Election Archive", "admin-archive-election.php", "bi-archive-fill"],
    ["View Election", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$data_electionid = $_GET['election_id'] ?? -1;
if ($data_electionid == -1) header('location:admin-election.php');

$sql = "SELECT * FROM `tb_elections_archive` WHERE ELECTION_ID='$data_electionid'";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $data_type = $row['ELECTION_TYPE'];
        $data_orgid = $row['ORG_ID'];
        $data_title = $row['TITLE'];
        $data_desc = $row['DESCRIPTION'];
        $data_startdate = $row['START_DATE'];
        $data_enddate = $row['END_DATE'];
    } else {
        header('location:admin-archive-election.php');
    }
}

$org_name = "";
if ($data_type == 0) {
    $org_name = "JRU Student Organization Council";
} else {
    $sql = "SELECT ORG FROM `tb_orgs` WHERE ORG_ID='$data_orgid' AND org_type_id='$data_type'";
    if ($res = @mysqli_query($conn, $sql)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $org_name = $row['ORG'];
        }
    }
}

$positions = [];

$sql = "SELECT POSITION_ID as id,position FROM tb_position";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $positions[$row['id']] = $row['position'];
        }
    }
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
            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <form method="POST" action="" class="card-body px-2 mx-3 py-3 pt-4 ">
                    <div class="mb-4">
                        <label class="form-label" for="ORGNAME"><?php
                                                                if ($data_type == 2) {
                                                                    echo "Side Organization";
                                                                } else if ($data_type == 1) {
                                                                    echo "Mother Organization";
                                                                } else {
                                                                    echo "Organization";
                                                                }
                                                                ?></label>
                        <input class="form-control" type="text" name="ORGNAME" id="ORGNAME" value="<?= $org_name ?>" readonly>
                        <input type="text" name="ORG" id="ORG" value="<?= $data_orgid ?>" style="display: none;">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="TITLE">Title</label>
                        <input class="form-control" type="text" name="TITLE" id="TITLE" value="<?= $data_title ?>" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="DESC">Description</label>
                        <textarea class="form-control" name="DESC" id="DESC" rows="6" readonly><?= $data_desc ?></textarea>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label class="form-label" for="STARTDATE">Start Date</label>
                            <input class="form-control" type="date" name="STARTDATE" id="STARTDATE" value="<?= $data_startdate ?>" readonly>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ENDDATE">End Date</label>
                            <input class="form-control" type="date" name="ENDDATE" id="ENDDATE" value="<?= $data_enddate ?>" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <table id="candidatestable" class="table table-bordered">
                            <thead class="thead-light">
                                <th>Name</th>
                                <th>Position</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($data_type == 1) {
                                    $sql = "SELECT tb_candidate.*,tb_officers.LAST_NAME,tb_officers.FIRST_NAME,tb_officers.MIDDLE_INITIAL as MIDDLE_NAME FROM `tb_candidate` LEFT JOIN `tb_officers` ON tb_candidate.STUDENT_NO=tb_officers.STUDENT_ID WHERE ELECTION_ID='$data_electionid'";
                                } else {
                                    $sql = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME FROM `tb_candidate` LEFT JOIN `tb_students` ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE ELECTION_ID='$data_electionid'";
                                }
                                if ($res = @mysqli_query($conn, $sql)) {
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            $fullname = $row['FIRST_NAME'] . " " . $row['MIDDLE_NAME'] . " " . $row['LAST_NAME'];
                                ?>
                                            <tr id="can-<?= $row['STUDENT_NO'] ?>">
                                                <td class="align-middle"><?= $fullname ?></td>
                                                <td>
                                                    <span><?= $positions[$row['POSITION_ID']] ?></span>
                                                </td>
                                            </tr>

                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
</body>

</html>