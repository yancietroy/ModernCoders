<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Singapore');

include('../router.php');
route(3);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;

$data_userid = $_SESSION['USER-ID'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
$data_orgid = $_SESSION['USER-ORG'];
$data_collegeid = $_SESSION['USER-COLLEGE'];
$orgName = "";
$_SESSION['ORG'] = $orgName;
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$data_orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
  if ($orgRes->num_rows > 0) {
    $row = $orgRes->fetch_assoc();
    $orgName = $row['ORG'];
  }
}

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
  ["Discussion Forum", "", ""],
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
            <div class="row ms-3 me-3 mt-2">
              <div class="col-lg-6 col-7">
                <h4 id="orgtitle">Discussion Board</h4>
              </div>
              <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
                <a class="btn btn-default btn-circle button px-3" href="create-topic.php?id=<?= $orgid ?>" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">New Topic </span></a>
              </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-11">
                  <div class="card shadow-sm card-registration mb-4 mt-4" style="border-radius: 15px;">
                      <div class="card-body px-2 mx-4 ">
                            <?php
                            $sqlGroups = "SELECT * FROM tb_disc_groups WHERE visibility='0' OR visibility='2' OR visibility='5' OR visibility='3'";
                            if ($res = @mysqli_query($conn, $sqlGroups)) {
                                while ($groups = $res->fetch_assoc()) {
                                    $groupid = $groups['group_id'];
                            ?>
                                    <div class="forum-title">
                                        <h3><?= $groups['name'] ?></h3>
                                    </div>
                                    <?php
                                    $sqlTopics = "SELECT * FROM tb_disc_topics WHERE group_id='$groupid' AND (org_id='0' OR org_id='$data_orgid' OR org_id='$orgid') AND (visibility='0' OR visibility='2' OR visibility='5' OR visibility='3')";
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
