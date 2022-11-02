<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Election";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["JRUSOC Election", "election-index.php", ""],
    ["Active Election", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

if (isset($_POST['submit-votes'])) {
    $pre = "INSERT INTO `tb_votes`(VOTER_ID,ELECTION_ID,POSITION_ID,CANDIDATE_ID,CAST_DATE) VALUES ";
    $values = [];
    $castdate = date('Y-m-d');
    $eid = $_POST['election-id'];

    foreach ($_POST as $key => $candidateid) {
        if (str_starts_with($key, "vote-")) {
            $position = str_replace("vote-", "", $key);
            array_push($values, "('$data_userid','$eid','$position','$candidateid','$castdate')");
        }
    }

    $sqlSubmit = $pre . implode(',', $values);
    if (@mysqli_query($conn, $sqlSubmit)) {
        echo "<script>alert('Votes successfully submitted.')</script>";
    } else {
        echo "<script>alert('Error occured while submitting your votes. Please try again.')</script>";
    }
}

$curdate = date('Y-m-d');
$hasElection = false;
$hasVoted = false;

$election_id = -1;
$title = "";
$description = "";
$start_date = $curdate;
$end_date = $curdate;
$candidates = [];

$sql = "SELECT * FROM tb_elections WHERE ELECTION_TYPE='0' AND ('$curdate'>=START_DATE AND '$curdate'<=END_DATE)";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        $hasElection = true;

        $row = $res->fetch_assoc();
        $election_id = $row['ELECTION_ID'];
        $title = $row['TITLE'];
        $description = $row['DESCRIPTION'];
        $start_date = $row['START_DATE'];
        $end_date = $row['END_DATE'];
    }
}

// Check if user already casted vote if there is an election ongoing
if ($hasElection) {
    $sqlCheckVote = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id' AND VOTER_ID='$data_userid'"
    );
    $total_records = @mysqli_fetch_array($sqlCheckVote);
    $total_records = $total_records['total_records'];

    if ($total_records > 0) $hasVoted = true;

    if ($hasVoted == false) {
        $sqlCandidates = "SELECT tb_candidate.*,tb_officers.LAST_NAME,tb_officers.FIRST_NAME,tb_officers.MIDDLE_INITIAL as MIDDLE_NAME,tb_officers.SECTION FROM tb_candidate LEFT JOIN tb_officers ON tb_candidate.STUDENT_NO=tb_officers.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
        if ($res = @mysqli_query($conn, $sqlCandidates)) {
            $candidates = $res->fetch_all(MYSQLI_ASSOC);
        }
    }
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
            <?php
            if ($hasElection && !$hasVoted) {
            ?>
            <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
                <div class="card-body px-2 mx-3 py-3 pt-4 ">

              <div class="ms-3 d-flex flex-row align-items-center">
                  <h3 class="flex-grow-1 lead"><strong class="pr-1  text-muted ">Name:<br></strong> <?= $title ?></h3>
              </div>
                <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Description:<br></strong> <?= $description ?></h6>
          <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Election Date:<br></strong> <?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>
              </div>
            </div>
                <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                    <div class="card-body px-2 mx-3 py-3 pt-4">
                        <form method="POST" action="">
                            <input type="text" name="election-id" value="<?= $election_id ?>" style="display:none;">
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
                                            <table id="table-pos-<?= $row['id'] ?>" class="table table-bordered table-hover">
                                                <thead class="thead-light">
                                                    <th style="width: 60px;"></th>
                                                    <th>Name</th>
                                                    <th>Section</th>
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
                                                        <tr style="cursor: pointer" onclick="$('#vote-abstain<?= $count ?>').prop('checked', true);">
                                                            <td class="text-center"><input type="radio" id="vote-abstain<?= $count ?>" name="vote-<?= $row['id'] ?>" value="-1" checked></td>
                                                            <td class="text-secondary">Abstain</td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($candidates as $candidate) {
                                                            if ($candidate['POSITION_ID'] == $row['id']) {
                                                        ?>
                                                                <tr style="cursor: pointer" onclick="$('#vote-<?= $candidate['CANDIDATE_ID']  ?>').prop('checked', true);">
                                                                    <td class="text-center"><input type="radio" id="vote-<?= $candidate['CANDIDATE_ID'] ?>" name="vote-<?= $row['id'] ?>" value="<?= $candidate['CANDIDATE_ID'] ?>"></td>
                                                                    <td><?= $candidate['FIRST_NAME'] . " " . $candidate['MIDDLE_NAME'] . " " . $candidate['LAST_NAME'] ?></td>
                                                                    <td><?= $candidate['SECTION'] ?></td>
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

                            <div class="mt-5 mb-2 text-center">
                                <button type="submit" name="submit-votes" class="btn btn-primary col-3" id="submit-votes-votes">Submit Votes</button>
                            </div>

                        </form>

                    </div>
                </div>
            <?php
            } else if ($hasElection && $hasVoted) {
            ?>
                <div class="text-center">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-5">Completed Casting Vote</h1>
                            <p class="lead">You have already submitted your vote.</p>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="text-center">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-5">No Active Election</h1>
                            <p class="lead">There is no active election at the moment.</p>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

            <!-- Footer
      <div class="row ms-3 me-3 mt-2 mb-4">
        <iframe src="https://calendar.google.com/calendar/embed?src=224d17edec0317d2aa84db81e393ad757c841147fc67c4d01eaf72e8347769b3%40group.calendar.google.com&ctz=Asia%2FManila" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
     -->
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
