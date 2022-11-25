<?php
ob_start();
session_start();

include('../router.php');
route(1);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = $_SESSION['USER-ORGS'][$orgid] ?? "";

if ($orgid <= 0 || !array_key_exists($orgid, $_SESSION['USER-ORGS'])) {
  header("location:student-index.php");
}

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(1, $data_userid);
$nav_selected = "Organizations / $orgName";
$nav_breadcrumbs = [
  ["Home", "student-index.php", "bi-house-fill"],
  ["Organizations", "student-orgs.php", ""],
  ["$orgName", "rso.php?id=$orgid", ""],
  ["Discussion Board", "", ""],
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
    <?php include("include/sidebar.php") ?>

    <div id="content">

      <!-- Navbar/Header  -->
      <?php include("include/header.php") ?>

      <!-- breadcrumb -->
      <?php include("include/breadcrumb.php") ?>

      <!-- Page content -->
      <div class="row justify-content-center">
        <div class="col-lg-11">
          <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
            <div class="card-body px-2 mx-3 py-3 pt-4 ">
              <?php
              $sqlGroups = "SELECT * FROM tb_disc_groups WHERE visibility in ('0','1','5')";
              if ($res = @mysqli_query($conn, $sqlGroups)) {
                while ($groups = $res->fetch_assoc()) {
                  $groupid = $groups['group_id'];
              ?>
                  <div class="forum-title mt-4">
                    <h3><?= $groups['name'] ?></h3>
                  </div>
                  <?php
                  $sqlTopics = "SELECT * FROM tb_disc_topics WHERE group_id='$groupid' AND (org_id='0' OR org_id='$orgid') AND (visibility in ('0','1','5') OR (visibility='6' AND members LIKE '%;;$data_userid%'))";
                  if ($res2 = @mysqli_query($conn, $sqlTopics)) {
                    if ($res2->num_rows > 0) {
                      while ($topics = $res2->fetch_assoc()) {
                  ?>
                        <div class="forum-item">
                          <div class="row">
                            <div class="col-md-9">
                              <div class="forum-icon">
                                <i class="bi text-primary <?= $topics['icon'] == "" ? "bi-chat-square-dots-fill" : $topics['icon'] ?>"></i>
                              </div>
                              <a href="forum-threads.php?id=<?= $orgid ?>&topic=<?= $topics['topic_id'] ?>" class="forum-item-title"><?= $topics['subject'] ?></a>
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