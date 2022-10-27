<?php
ob_start();
session_start();
$id = $_SESSION['use'];
$morg_id = $_SESSION['morg_id'];
$secorg_id = $_SESSION['org_id'];
include('../mysql_connect.php');
include('profilepic.php');
include('../assets/img/logopics.php');
if (isset($_SESSION['msg'])) {
  print_r($_SESSION['msg']); #display message
  unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if (!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
{
  header("Location:../index.php");
}

if (isset($_POST['submit-votes'])) {
  $pre = "INSERT INTO `tb_votes`(VOTER_ID,ELECTION_ID,POSITION_ID,CANDIDATE_ID,CAST_DATE) VALUES ";
  $values = [];
  $castdate = date('Y-m-d');
  $eid = $_POST['election-id'];

  foreach ($_POST as $key => $candidateid) {
    if (str_starts_with($key, "vote-")) {
      $position = str_replace("vote-", "", $key);
      array_push($values, "('$id','$eid','$position','$candidateid','$castdate')");
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
$hasElection = 0;
$morgHasElection = false;

$election_id = -1;
$title = "";
$description = "";
$start_date = $curdate;
$end_date = $curdate;
$candidates = [];

$sql = "SELECT * FROM tb_elections WHERE ORG_ID='$morg_id' AND ELECTION_TYPE='2' AND ('$curdate'>=START_DATE AND '$curdate'<=END_DATE)";
if ($res = @mysqli_query($conn, $sql)) {
  if ($res->num_rows > 0) {
    $morgHasElection = true;
    $hasElection = 2;

    $row = $res->fetch_assoc();
    $election_id = $row['ELECTION_ID'];
    $title = $row['TITLE'];
    $description = $row['DESCRIPTION'];
    $start_date = $row['START_DATE'];
    $end_date = $row['END_DATE'];
  }
}

// Check if user already casted vote
$sqlCheckVote = mysqli_query(
  $conn,
  "SELECT COUNT(*) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id' AND VOTER_ID='$id'"
);
$total_records = @mysqli_fetch_array($sqlCheckVote);
$total_records = $total_records['total_records'];

if ($total_records > 0) $morgHasElection = false;

if (!$morgHasElection) {
  $sql = "SELECT * FROM tb_elections WHERE ORG_ID='$secorg_id' AND ELECTION_TYPE='3' AND ('$curdate'>=START_DATE AND '$curdate'<=END_DATE)";
  if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
      $hasElection = 3;

      $row = $res->fetch_assoc();
      $election_id = $row['ELECTION_ID'];
      $title = $row['TITLE'];
      $description = $row['DESCRIPTION'];
      $start_date = $row['START_DATE'];
      $end_date = $row['END_DATE'];
    }
  }
}

// Check if user already casted vote
$sqlCheckVote = mysqli_query(
  $conn,
  "SELECT COUNT(*) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id' AND VOTER_ID='$id'"
);
$total_records = @mysqli_fetch_array($sqlCheckVote);
$total_records = $total_records['total_records'];
if ($total_records > 0) $hasElection = 0;

if ($hasElection > 0) {
  $sqlCandidates = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME,tb_students.SECTION FROM tb_candidate LEFT JOIN tb_students ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
  if ($res = @mysqli_query($conn, $sqlCandidates)) {
    $candidates = $res->fetch_all(MYSQLI_ASSOC);
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
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="student-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations </h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="student-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>

        <li class="active">
          <a href="election-student-index.php"> <i class="bi bi-check2-square"></i> <span>Election</span></a>

        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>

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

      <nav class="navbar navbar-expand navbar-light shadow" aria-label="navbar" id="topbar">
        <div class="container-fluid">
          <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
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
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_students WHERE STUDENT_ID = '$id'";
                                                        $result = @mysqli_query($conn, $query);
                                                        $row = mysqli_fetch_array($result);
                                                        if ($row) {
                                                          echo "$row[0]";
                                                        } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="student-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../index.php">Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="student-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-check2-square"></i> Election </li>
        </ol>
      </nav>
      <!-- Page content -->
      <?php
      if ($hasElection > 0) {
      ?>
        <h4 class="ms-3 mb-4">ELECTION: <?= $title ?></h4>
        <p class="ms-3"><?= $description ?></p>
        <h6 class="ms-3 mb-4">Election Date: <?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>
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
      <!-- Footer -->
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
