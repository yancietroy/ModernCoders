<?php
ob_start();
session_start();
$id = $_SESSION['use'];
$morg_id = $_SESSION['morg_id'];
$secOrg_id = $_SESSION['org_id'];
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
  <!-- calendar
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script> !-->
</head>

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

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="student-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li class="active">
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="election-student-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
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
          <li class="breadcrumb-item"><a href="student-orgs.php"> <i class="bi bi-people-fill"></i> Organizations</a></li>
          <li class="breadcrumb-item"><a href="comsoc.php"> <i class="bi bi-people-fill"></i></i> <?php $query = "SELECT * FROM tb_morg WHERE MORG_ID = '$morg_id'";
                                                                                                  $result = @mysqli_query($conn, $query);
                                                                                                  $row = mysqli_fetch_array($result);
                                                                                                  if ($row) {
                                                                                                    echo "$row[1]";
                                                                                                  }
                                                                                                  ?></a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page">Discussion Forum</li>
        </ol>
      </nav>
      <!-- Page content -->

      <!-- Page content -->
      <div class="row justify-content-center align-items-center text-align-center">
        <div class="col-12 col-lg-10 col-xl-11">
          <div class="card shadow border-0 rounded-lg mb-5 mx-4 w-80 justify-content-center align-items-center text-align-center">
            <div class="card-body p-4 mx-auto px-auto">
              <div class="row g-0 ">
                <div class="col-md-2 d-none d-sm-block text-center mt-3">
                  <img src="<?php echo $logoPic; ?>" class="rounded-circle img-fluid " alt="..." style="border: 2px solid #F2AC1B" width="122" height="150">
                </div>
                <div class='col-12 col-md-10 mt-4'>
                  <h3 class="justify-content-center align-items-center text-align-center">Discussion Forum</h3>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-11">
          <div class="wrapper wrapper-content animated fadeInRight shadow px-auto mb-4 ">


            <div class="ibox-content forum-container ">
              <?php
              $sqlGroups = "SELECT * FROM tb_disc_groups WHERE visibility='0' OR visibility='1' OR visibility='5'";
              if ($res = @mysqli_query($conn, $sqlGroups)) {
                while ($groups = $res->fetch_assoc()) {
                  $groupid = $groups['group_id'];
              ?>
                  <div class="forum-title mt-4">
                    <h3><?= $groups['name'] ?></h3>
                  </div>
                  <?php

                  $sqlTopics = "SELECT * FROM tb_disc_topics WHERE group_id='$groupid' AND (org_id='0' OR org_id='$morg_id') AND (visibility='0' OR visibility='1' OR visibility='5')";
                  if ($res2 = @mysqli_query($conn, $sqlTopics)) {
                    if ($res->num_rows > 0) {
                      while ($topics = $res2->fetch_assoc()) {
                  ?>
                        <div class="forum-item">
                          <div class="row">
                            <div class="col-md-9">
                              <div class="forum-icon">
                                <i class="bi text-primary <?= $topics['icon'] == "" ? "bi-chat-square-dots-fill" : $topics['icon'] ?>"></i>
                              </div>
                              <a href="forum-threads.php?topic=<?= $topics['topic_id'] ?>" class="forum-item-title"><?= $topics['subject'] ?></a>
                              <div class="forum-sub-title small"><?= $topics['description'] ?></div>
                            </div>
                            <div class="col-md-3 forum-info">
                              <span class="views-number text-primary">
                                <?php
                                $sqlCount = mysqli_query(
                                  $conn,
                                  "SELECT COUNT(*) As total_records FROM `tb_disc_threads` WHERE topic_id=" . $topics['topic_id']
                                );
                                $total_records = @mysqli_fetch_array($sqlCount);
                                $total_records = $total_records['total_records'];
                                echo $total_records;
                                ?>
                              </span>
                              <div>
                                <small>Threads</small>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php
                      }
                    } else {
                      ?>
                      <div class="forum-item">
                        <div class="row">
                          <h6 class="text-center forum-sub-title ml-0">No Topics Found</h6>
                        </div>
                      </div>
              <?php
                    }
                  }
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
</body>

</html>