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

$page_no = $_GET['page'] ?? 1;

$topicid = $_GET['topic'] ?? 0;
if ($topicid <= 0) {
  header('location:forum-user.php');
}

$threadid = $_GET['thread'] ?? 0;
if ($threadid <= 0) {
  header('location:forum-user.php');
}

$topicsubject = "";

$sqlGroups = "SELECT subject FROM tb_disc_topics WHERE topic_id='$topicid'";
if ($res = @mysqli_query($conn, $sqlGroups)) {
  if ($res->num_rows > 0) {
    $topic = $res->fetch_assoc();
    $topicsubject = $topic['subject'];
  }
}

$sqlPost = "SELECT * FROM tb_disc_threads WHERE thread_id='$threadid'";
if ($res = @mysqli_query($conn, $sqlPost)) {
  if ($res->num_rows > 0) {
    $thread = $res->fetch_assoc();
    $threadUserId = $thread['user_id'];
    $threadUserName = $thread['name'];
    $threadUserType = $thread['user_type'];
    $threadTitle = $thread['title'];
    $threadMessage = $thread['message'];
    $threadViews = $thread['views'];
  } else {
    header('location:forum-threads.php?topic=' . $topicid);
  }
}

if ($threadUserType == 1) {
  $sqlMaker = "SELECT year_level,section,profile_pic,email FROM tb_students WHERE student_id='$threadUserId'";
} else if ($threadUserType == 2) {
  $sqlMaker = "SELECT year_level,section,profile_pic,email FROM tb_officers WHERE student_id='$threadUserId'";
} else if ($threadUserType == 3) {
  $sqlMaker = "SELECT profile_pic,email FROM tb_signatories WHERE school_id='$threadUserId'";
} else if ($threadUserType == 4) {
  $sqlMaker = "SELECT profile_pic,email FROM tb_admin WHERE student_id='$threadUserId'";
}

if ($res = @mysqli_query($conn, $sqlMaker)) {
  if ($res->num_rows > 0) {
    $maker = $res->fetch_assoc();
    $makerName = $threadUserName;
    $makerYear = $maker['year_level'] ?? "";
    $makerSection = $maker['section'] ?? "";
    $makerPic = $maker['profile_pic'] ?? "";
    $makerEmail = $maker['email'] ?? "";
  }
}

$result_count = mysqli_query(
  $conn,
  "SELECT COUNT(*) As total_records FROM tb_disc_threads WHERE topic_id='1'"
);

$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;

$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);

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
  <link href="../assets/js/summernote/summernote-bs4.css" rel="stylesheet">

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
          <li class="breadcrumb-item"><a href="student-orgs.php"> Organizations</a></li>
          <li class="breadcrumb-item"><a href="rso.php"></i></i> <?php $query = "SELECT * FROM tb_morg WHERE MORG_ID = '$morg_id'";
                                                                    $result = @mysqli_query($conn, $query);
                                                                    $row = mysqli_fetch_array($result);
                                                                    if ($row) {
                                                                      echo "$row[1]";
                                                                    }
                                                                    ?></a></li>
          <li class="breadcrumb-item"><a href="forum-user.php"><i class="bi bi-inbox-fill"></i> Discussion Forum</a></li>
          <li class="breadcrumb-item"><a href="forum-threads.php?topic=<?= $topicid ?>"> <?= $topicsubject ?></a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page">Thread</li>
        </ol>
      </nav>


      <!-- Page content -->
      <div class="row justify-content-center">
        <div class="col-lg-11">
          <div class="wrapper wrapper-content animated fadeInRight shadow px-auto mb-4 ">

            <div class="ibox-content forum-container ">

              <div class="row">
                <div class="col-12 col-md-2 mb-4 text-center">
                  <h6 class="mt-3"><?= $makerName ?></h6>
                  <img class="rounded-circle me-lg-2" src="<?= "pictures/" . $makerPic ?>" alt="" style="width: 120px; height: 120px;border: 2px solid #F2AC1B;">
                  <div style="overflow: hidden; text-overflow: ellipsis;">
                    <h6 class="mt-3" style="color:#F2AC1B; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $makerEmail ?></h6>
                  </div>
                  <?php
                  if ($threadUserType == 4) {
                  ?>
                    <h6 style="font-size: 13px;">ADMINISTRATOR</h6>
                  <?php
                  } else if ($threadUserType == 3) {
                  ?>
                    <h6 style="font-size: 13px;">SIGNATORY</h6>
                  <?php
                  } else if ($threadUserType == 2) {
                  ?>
                    <h6 style="font-size: 13px;">OFFICER</h6>
                  <?php
                  } else if ($threadUserType == 1) {
                  ?>
                    <h6 style="font-size: 13px;">STUDENT</h6>
                  <?php
                  }
                  ?>
                  <h6 style="font-size: 13px;">Year <?= $makerYear ?> Section <?= $makerSection ?></h6>
                  <h6 class="mt-3 text-secondary" style="font-size: 12px;">Posted: <?= date('M. d Y', $threadid) ?></h6>
                </div>
                <div class="col-12 col-md-10 border p-3">
                  <div style="overflow: hidden; text-overflow: ellipsis;">
                    <h4 class="text-primary" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $threadTitle ?></h4>
                  </div>
                  <hr>
                  <div style="font-size: 15px;">
                    <?= $threadMessage ?>
                  </div>
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
              if ($total_records > 0) {
              ?>
                <h6>Replies</h6>
                <nav class="mt-4 d-flex flex-row justify-content-end">
                  <ul class="pagination">
                    <li class="page-item">
                      <a href="?page=1&topic=<?= $topicid ?>" class="page-link text-dark">First</a>
                    </li>
                    <li class="page-item">
                      <a href="?page=<?php if ($page_no == 1) echo "1";
                                      else echo $page_no - 1; ?>&topic=<?= $topicid ?>" class="page-link text-dark">Previous</a>
                    </li>

                    <?php
                    if ($total_no_of_pages <= 5) {
                      for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    ?>
                        <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                          <a href="?page=<?= $i ?>&topic=<?= $topicid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                        </li>
                        <?php
                      }
                    } else {
                      $mid;
                      $after = $total_no_of_pages - $page_no;
                      $before = $page_no - 1;

                      if ($before >= 2 && $after >= 2) {
                        $x = $page_no - 2;
                        $y = $page_no + 2;
                      } else if ($before < 2 && $after >= 2) {
                        $x = $page_no - $before;
                        $y = $page_no + 2 + (2 - $before);
                      } else if ($before >= 2 && $after < 2) {
                        $x = $page_no - 2 - (2 - $after);
                        $y = $total_no_of_pages;
                      }

                      for ($i = $x; $i <= $y; $i++) {
                        if ($page_no == $i) {
                        ?>
                          <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                            <a href="?page=<?= $i ?>&topic=<?= $topicid ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                          </li>
                    <?php
                        }
                      }
                    }
                    ?>

                    <li class="page-item">
                      <a href="?page=<?php if ($page_no == $total_no_of_pages) echo $total_no_of_pages;
                                      else echo $page_no + 1; ?>&topic=<?= $topicid ?>" class="page-link text-dark">Next</a>
                    </li>
                    <li class="page-item">
                      <a href="?page=<?= $total_no_of_pages ?>&topic=<?= $topicid ?>" class="page-link text-dark">Last</a>
                    </li>
                  </ul>
                </nav>
              <?php
              }
              ?>


              <h6>Reply to this thread</h6>
              <textarea id="replybox"></textarea>
              <div class="d-flex flex-row justify-content-end mt-3">
                <button class="btn btn-primary small">Post Reply</button>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- jQuery CDN - Slim version (=without AJAX) -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
      <!-- form validation/sidebar toggle -->
      <script src="../assets/js/form-validation.js"></script>
      <!--WAVES CSS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
      </script>
      <script src="../assets/js/tinymce/tinymce.min.js"></script>
      <script type="text/javascript">
        tinymce.init({
          selector: '#replybox',
          plugins: 'link image',
          height: 300,
          menubar: 'edit view insert format',
          toolbar: 'undo redo | styles | bold italic underline | link | alignleft aligncenter alignright',
        });
      </script>
      <!-- JavaScript validation -->
      <script type="text/javascript">
        Waves.attach('#sidebar ul li a');
        Waves.init();
      </script>
</body>

</html>
