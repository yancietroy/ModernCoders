<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Organizations";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Election", "officer-election-index.php", ""],
    ["Active Election", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$curdate = date('Y-m-d');
$hasElection = false;

$election_id = -1;
$title = "";
$description = "";
$start_date = $curdate;
$end_date = $curdate;
$candidates = [];

$sql = "SELECT * FROM tb_elections WHERE ORG_ID='$orgid' AND CURDATE() >= START_DATE AND CURDATE() <= END_DATE ORDER BY END_DATE DESC";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        $hasElection = true;

        $row = $res->fetch_assoc();
        $election_id = $row['ELECTION_ID'];
        $title = $row['TITLE'];
        $description = $row['DESCRIPTION'];
        $start_date = $row['START_DATE'];
        $end_date = $row['END_DATE'];
        $election_type = $row['ELECTION_TYPE'];
    }
}

if ($hasElection) {
    $candidates = [];
    $sqlCandidates = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME,tb_students.SECTION FROM tb_candidate LEFT JOIN tb_students ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
    if ($res = @mysqli_query($conn, $sqlCandidates)) {
        $candidates = $res->fetch_all(MYSQLI_ASSOC);
    }

    if ($election_type == 1) {
        $sqlTotalVoters = mysqli_query(
            $conn,
            "SELECT COUNT(*) As total_records FROM `tb_students` WHERE MORG_ID='$orgid'"
        );
    } else if ($election_type == 2) {
        $sqlTotalVoters = mysqli_query(
            $conn,
            "SELECT COUNT(*) As total_records FROM `tb_students` WHERE ORG_IDS LIKE '%[$orgid]%'"
        );
    }
    $total_voters = @mysqli_fetch_array($sqlTotalVoters);
    $total_voters = $total_voters['total_records'];


    $sqlTotalVotes = mysqli_query(
        $conn,
        "SELECT COUNT(DISTINCT VOTER_ID) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id'"
    );
    $total_votes = @mysqli_fetch_array($sqlTotalVotes);
    $total_votes = $total_votes['total_records'];
    $total_pending = $total_voters - $total_votes;
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
    <title>JRU Student Organizations Portal Officer</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- waves CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons-->
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
                <h4><?= $_SESSION['USER-ORG-NAME'] ?> Election Results</h4>
            </div>
            <?php
            if ($hasElection) {
            ?>
                <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                    <div class="card-body px-2 mx-3 py-3 pt-4 ">

                        <div class="ms-3 d-flex flex-row align-items-center">
                            <h3 class="flex-grow-1 lead"><strong class="pr-1 text-muted ">Name:<br></strong> <?= $title ?></h3>
                        </div>
                        <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Description:<br></strong> <?= $description ?></h6>
                        <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Election Date:<br></strong> <?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>
                        <div class="ms-3 mb-3 row">
                            <div class="col-sm m-0 p-0">
                                <h6><strong class="pr-1 text-muted mb-3">Total Number of Students:<br></strong> <?= $total_voters ?></h6>
                            </div>
                            <div class="col-sm m-0 p-0">
                                <h6><strong class="pr-1 text-muted mb-3">Total Number of Votes:<br></strong> <?= $total_votes ?></h6>
                            </div>
                            <div class="col-sm m-0 p-0">
                                <h6><strong class="pr-1 text-muted mb-3">Pending Votes:<br></strong> <?= $total_pending ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                    <div class="card-body px-2 mx-3 py-3 pt-4 ">

                        <?php
                        $sql = "SELECT POSITION_ID as id,position FROM tb_position";
                        if ($res = @mysqli_query($conn, $sql)) {
                            $count = 0;
                            while ($row = $res->fetch_assoc()) {
                                $count++;
                        ?>
                                <div class="card card-primary shadow-sm mb-2">
                                    <div class="card-header text-center">
                                        <?= $row['position'] ?>
                                    </div>
                                    <div class="card-body">
                                        <table id="table-pos-<?= $row['id'] ?>" class="table table-bordered">
                                            <thead class="thead-light">
                                                <th>Name</th>
                                                <th>Section</th>
                                                <th>Votes</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                global $posid;
                                                $posid = $row['id'];
                                                $found = count(array_filter($candidates, function ($item) {
                                                    global $posid;
                                                    return isset($item['POSITION_ID']) && $posid == $item['POSITION_ID'];
                                                }));

                                                if ($found > 0) {
                                                ?>
                                                    <tr onclick="$('#vote-abstain<?= $count ?>').prop('checked', true);">
                                                        <td class="text-secondary">Abstain</td>
                                                        <td></td>
                                                        <td><?= getVotes($election_id, $posid, "-1") ?></td>
                                                    </tr>
                                                    <?php
                                                    foreach ($candidates as $candidate) {
                                                        if ($candidate['POSITION_ID'] == $row['id']) {
                                                    ?>
                                                            <tr>
                                                                <td><?= $candidate['FIRST_NAME'] . " " . $candidate['MIDDLE_NAME'] . " " . $candidate['LAST_NAME'] ?></td>
                                                                <td><?= $candidate['SECTION'] ?></td>
                                                                <td><?= getVotes($election_id, $posid, $candidate['CANDIDATE_ID']) ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center text-danger">No Candidates</td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>


                    </div>
                </div>
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
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
        Waves.attach('#sidebar ul li a');
        Waves.attach('.button');
        Waves.init();
    </script>
</body>

</html>