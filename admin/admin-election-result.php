<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
include('profilepic.php');
if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if (!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
{
    header("Location:index.php");
}

$election_id = $_GET['id'] ?? -1;

if ($election_id == -1) {
    header('location:admin-election-list.php');
}

$sql = "SELECT * FROM `tb_elections` WHERE ELECTION_ID='$election_id'";
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
        header('location:admin-election-list.php');
    }
}

$candidates = [];
$sqlCandidates = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME,tb_students.SECTION FROM tb_candidate LEFT JOIN tb_students ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
if ($res = @mysqli_query($conn, $sqlCandidates)) {
    $candidates = $res->fetch_all(MYSQLI_ASSOC);
}
if ($data_type == 2) {
    $sqlTotalVoters = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_students` WHERE MORG_ID='$data_orgid'"
    );
} else if ($data_type == 3) {
    $sqlTotalVoters = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_students` WHERE ORG_ID='$data_orgid'"
    );
} else {
    $sqlTotalVoters = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_officers`"
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
        <nav id="sidebar">

            <div class="sidebar-header text-center">
                <a class="navbar-brand" href="admin-index.php">
                    <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
                </a>
            </div>
            <div class="sidebar-heading mt-3 text-center">

                <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
            </div>

            <ul class="list-unstyled components p-2">

                <li>
                    <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
                        </li>
                        <li>
                            <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
                        </li>
                        <li>
                            <a href="admin-signatories.php"><i class="bi bi-person-check-fill"></i> <span>Signatories</span></a>
                        </li>
                        <li>
                            <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
                    <ul class="collapse list-unstyled" id="orgsSubmenu">
                        <li>
                            <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
                        </li>
                        <li>
                            <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
                        </li>
                        <li>
                            <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
                </li>
                <li>
                    <a href="admin-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
                </li>
                <li class="d-lg-none">
                    <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->

                </li>
            </ul>
            <!-- nav footer?
      <ul class="list-unstyled CTAs">
        <li>
          <a>about</a>
        </li>
        <li>
          <a>logout</a>
        </li>
      </ul> -->
        </nav>
        <!-- Navbar  -->
        <div id="content">

            <nav class="navbar shadow navbar-expand navbar-light bg-light" aria-label="navbar" id="topbar">
                <div class="container-fluid">
                    <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="#navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                                    <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
                                                                            $result = @mysqli_query($conn, $query);
                                                                            $row = mysqli_fetch_array($result);
                                                                            if ($row) {
                                                                                echo "$row[0]";
                                                                            } ?></span></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="admin-profile.php">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="index.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="admin-election.php"><i class="bi bi-check2-square"></i> Election</a></li>
                    <li class="breadcrumb-item"><a href="admin-election-list.php"><i class="bi bi-clipboard-data-fill"></i> Election List</a></li>
                    <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-bar-chart-steps"></i> Election Result</li>
                </ol>
            </nav>

            <!-- Page content -->
            <div class="ms-3 d-flex flex-row align-items-center">
                <h4 class="flex-grow-1">ELECTION: <?= $data_title ?></h4>
                <button class="btn btn-primary btn-sm px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Show Result
                </button>
            </div>
            <h6 class="ms-3 mb-3"><?= $data_desc ?></h6>
            <h6 class="ms-3">Election Date: <?= date("F d, Y", strtotime($data_startdate)) . " to " . date("F d, Y", strtotime($data_enddate)) ?></h6>
            <div class="ms-3 mb-4 row">
                <div class="col-sm m-0 p-0">
                    <h6>Total Number of Voters: <?= $total_voters ?></h6>
                </div>
                <div class="col-sm m-0 p-0">
                    <h6>Current Number of Votes: <?= $total_votes ?></h6>
                </div>
                <div class="col-sm m-0 p-0">
                    <h6>Pending Number of Votes: <?= $total_pending ?></h6>
                </div>
            </div>

            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <div class="card-body px-2 mx-3 py-3 pt-4 ">

                    <div class="collapse mb-4" id="collapseExample">
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
                                                $sqlWinner = "SELECT tb_votes.CANDIDATE_ID,count(*) as votes,tb_candidate.STUDENT_NO as studentno FROM `tb_votes` LEFT JOIN `tb_candidate` ON tb_votes.CANDIDATE_ID=tb_candidate.CANDIDATE_ID WHERE tb_votes.ELECTION_ID='$election_id' AND tb_votes.POSITION_ID='$pos_id' AND tb_votes.CANDIDATE_ID<>'-1' GROUP BY tb_votes.CANDIDATE_ID ORDER BY count(*) DESC";
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
                                                            $winnername = "There are more than 1 winner";
                                                            $invalidWinner = true;
                                                        } else {
                                                            if ($data_type == 1) {
                                                                $sqlGetName = "SELECT last_name as ln,first_name as fn,middle_initial as mn FROM tb_officers WHERE student_id='$winnerid'";
                                                            } else {
                                                                $sqlGetName = "SELECT LAST_NAME as ln,FIRST_NAME as fn,MIDDLE_NAME as mn FROM tb_students WHERE STUDENT_ID='$winnerid'";
                                                            }
                                                            if ($res1 = @mysqli_query($conn, $sqlGetName)) {
                                                                if ($res1->num_rows > 0) {
                                                                    $row1 = $res1->fetch_assoc();
                                                                    $winnername = $row1['fn'] . " " . $row1['mn'] . " " . $row1['ln'];
                                                                }
                                                            }
                                                        }
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
                    </div>

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