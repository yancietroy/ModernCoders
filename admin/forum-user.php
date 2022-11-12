<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = "";
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
    if ($orgRes->num_rows > 0) {
        $row = $orgRes->fetch_assoc();
        $orgName = $row['ORG'];
    } else {
        header('location:admin-orgs.php');
    }
}

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
    ["Home", "admin-index.php", "bi-house-fill"],
    ["Site Management", "admin-users.php", ""],
    ["Organizations", "admin-orgs.php", ""],
    [$orgName, "admin-orgs-rso.php?id=$orgid", ""],
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

    <!-- Datatable Default-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

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
            <div class="row ms-3 me-3 mt-2">
              <div class="col-lg-6 col-7">
                <h4 id="orgtitle">Discussion Board</h4>
              </div>
              <div class="col-lg-6 col-5 d-flex align-items-end justify-content-end">
                <a class="btn btn-default btn-circle button px-3" href="admin-orgs-create-topic.php" role="button"><i class="bi bi-plus-circle-fill"></i> <span id="btntitle">New Topic </span></a>
              </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-11">
                  <div class="card shadow-sm card-registration mb-4 mt-4" style="border-radius: 15px;">
                      <div class="card-body px-2 mx-4 ">
                            <?php
                            $sqlGroups = "SELECT * FROM tb_disc_groups";
                            if ($res = @mysqli_query($conn, $sqlGroups)) {
                                while ($groups = $res->fetch_assoc()) {
                                    $groupid = $groups['group_id'];
                            ?>
                                    <div class="forum-title mt-4">
                                        <h3><?= $groups['name'] ?></h3>
                                    </div>
                                    <?php
                                    $cur_org = $_SESSION['ORG_ID'];
                                    $sqlTopics = "SELECT * FROM tb_disc_topics WHERE group_id='$groupid' AND (org_id='0' OR org_id='$cur_org')";
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

            <!-- Footer -->
            <div id="layoutAuthentication_footer">
                <footer class="py-2 bg-light mt-3">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Sidebar collapse -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
        Waves.attach('.button');
        Waves.init();
    </script>
    <!-- JavaScript validation -->
    <script src="../assets/js/bootstrap-validation.js"></script>



</body>

</html>
