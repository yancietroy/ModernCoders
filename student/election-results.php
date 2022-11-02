<?php
ob_start();
session_start();

include('../router.php');
route(1);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = $_SESSION['USER-ORGS'][$orgid] ?? "";

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(1, $data_userid);
$nav_selected = "Organizations / $orgName";
$nav_breadcrumbs = [
    ["Home", "student-index.php", "bi-house-fill"],
    ["Organizations", "student-orgs.php", ""],
    ["$orgName", "rso.php?id=$orgid", ""],
    ["Election", "election-student-index.php?id=$orgid", ""],
    ["Election Results", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$curdate = date('Y-m-d');
$hasResults = false;

$election_id = -1;
$title = "";
$description = "";
$start_date = $curdate;
$end_date = $curdate;
$candidates = [];

$sql = "SELECT * FROM tb_elections WHERE ORG_ID='$orgid' AND CURDATE() > END_DATE AND CURDATE() <= DATE_ADD(END_DATE, INTERVAL 7 DAY)";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        $hasResults = true;

        $row = $res->fetch_assoc();
        $election_id = $row['ELECTION_ID'];
        $title = $row['TITLE'];
        $description = $row['DESCRIPTION'];
        $start_date = $row['START_DATE'];
        $end_date = $row['END_DATE'];
    }
}

if ($hasResults) {
    $candidates = [];
    $sqlCandidates = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME,tb_students.SECTION FROM tb_candidate LEFT JOIN tb_students ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
    if ($res = @mysqli_query($conn, $sqlCandidates)) {
        $candidates = $res->fetch_all(MYSQLI_ASSOC);
    }
}

function getVotes($election_id, $position_id, $candidate_id)
{
    include('../mysql_connect.php');
    $sqlGetVotes = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id' AND POSITION_ID='$position_id' AND CANDIDATE_ID='$candidate_id'"
    );
    $total_records = @mysqli_fetch_array($sqlGetVotes);
    $total_records = $total_records['total_records'];
    return $total_records;
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
    <!-- Waves CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
            <div class="col-lg-6 col-7 mb-4">
                <h4><?= $orgName ?> Election Results</h4>
            </div>
            <?php
            if ($hasResults) {
            ?>
                <div class="ms-3 d-flex flex-row align-items-center">
                    <h3 class="flex-grow-1 lead"><strong class="pr-1 text-muted ">Name:<br></strong> <?= $title ?></h3>
                </div>
                <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Description:<br></strong> <?= $description ?></h6>
                <h6 class="ms-3 mb-4"><strong class="pr-1 text-muted mb-3">Election Date:<br></strong> <?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>

                <div class="card card-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <th>Position</th>
                            <th>Candidate</th>
                            <th>Total Votes</th>
                            <th>Total Abstain</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT POSITION_ID as id,position FROM tb_position";
                            if ($respos = @mysqli_query($conn, $sql)) {
                                while ($row = $respos->fetch_assoc()) {
                                    $pos_id = $row['id'];
                                    $posname = $row['position'];

                                    $found = count(array_filter($candidates, function ($item) {
                                        global $pos_id;
                                        return isset($item['POSITION_ID']) && $pos_id == $item['POSITION_ID'];
                                    }));

                                    if ($found > 0) {
                                        $sqlWinner = "SELECT tb_votes.CANDIDATE_ID,count(*) as votes,tb_candidate.STUDENT_NO as studentno FROM `tb_votes` LEFT JOIN `tb_candidate` ON tb_votes.CANDIDATE_ID=tb_candidate.CANDIDATE_ID WHERE tb_votes.ELECTION_ID='$election_id' AND tb_votes.POSITION_ID='$pos_id' AND tb_votes.CANDIDATE_ID<>'-1' GROUP BY tb_votes.CANDIDATE_ID ORDER BY votes DESC";
                                        $votes = 0;
                                        $invalidWinner = false;
                                        if ($res = @mysqli_query($conn, $sqlWinner)) {
                                            if ($res->num_rows > 0) {
                                                $candidate = $res->fetch_assoc();
                                                $votes = $candidate['votes'];
                                                $winnerid = $candidate['studentno'];
                                                $winnername = "";

                                                $votes2 = -1;
                                                if ($res->num_rows > 1) {
                                                    $candidate2 = $res->fetch_assoc();
                                                    $votes2 = $candidate2['votes'];
                                                }

                                                if ($votes == $votes2) {
                                                    $winnername = "Still Calculating Winner";
                                                    $invalidWinner = true;
                                                } else {
                                                    $sqlGetName = "SELECT last_name as ln,first_name as fn,middle_name as mn FROM tb_students WHERE student_id='$winnerid'";
                                                    if ($res1 = @mysqli_query($conn, $sqlGetName)) {
                                                        if ($res1->num_rows > 0) {
                                                            $row1 = $res1->fetch_assoc();
                                                            $winnername = $row1['fn'] . " " . $row1['mn'] . " " . $row1['ln'];
                                                        }
                                                    }
                                                }
                                            } else {
                                                $winnername = "No Winner";
                                                $invalidWinner = true;
                                            }
                                        }
                            ?>
                                        <tr>
                                            <td><?= $posname ?></td>
                                            <td <?= $invalidWinner ? "class='text-danger'" : "" ?>><?= $winnername ?? "" ?></td>
                                            <td><?= $votes ?></td>
                                            <td><?= getVotes($election_id, $pos_id, "-1") ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <div class="text-center">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-5">No Recent Election</h1>
                            <p class="lead">There is no recent election conducted.</p>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!-- form validation/sidebar toggle -->
        <script src="../assets/js/form-validation.js"></script>
        <!--WAVES CSS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script> <!-- JavaScript validation -->
        <script type="text/javascript">
            Waves.attach('#sidebar ul li a');
            Waves.init();
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

            });
        </script>
</body>

</html>