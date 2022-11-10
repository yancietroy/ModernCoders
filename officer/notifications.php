<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Singapore');

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_studid = $_SESSION['USER-SID'];
$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_name = $_SESSION['USER-NAME'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Home";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Notifications", "", "bi-bell-fill"],
];

$page_no = $_GET['page'] ?? 1;

$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM tb_notification WHERE receiver='$data_studid'"
);

$total_records_per_page = 20;
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
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
                        <div class="card-body px-2 mx-3 py-3 pt-4 ">
                            <h3 class="mb-4">My Notifications</h3>
                            <div class="table-responsive-xl">
                                <table class="table forum no-cellpadding">
                                    <tbody>
                                        <?php
                                        $sqlNotifs = "SELECT * FROM tb_notification WHERE receiver='$data_studid' ORDER BY notif_id DESC LIMIT $offset,$total_records_per_page";

                                        $res = $conn->query($sqlNotifs);

                                        // Read All Notifs
                                        if ($total_records > 0) {
                                            $sqlUpd = "UPDATE tb_notification SET is_read='1' WHERE receiver='$data_studid'";
                                            mysqli_query($conn, $sqlUpd);
                                        }

                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td class="p-4" style="min-width: 400px; max-width: 400px;">
                                                        <div class="row">
                                                            <div class="d-flex">
                                                                <h6 class="text-primary" style="font-size: 15px;"><?= $row['title'] ?> <?php if ($row['is_read'] == 0) echo ' <span class="badge badge-pill badge-danger align-top">new</span>' ?></h6>
                                                                <h6 class="ml-auto text-secondary" style="font-size: 13px;"><?= date('F d, Y h:i A', $row['notif_id']) ?></h6>
                                                            </div>
                                                            <h6 class="text-secondary m-0" style="font-size: 13px;"><?= $row['message'] ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td class="text-center py-5">No Recent Notification</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                                if ($total_records > 0) {
                                ?>
                                    <nav class="mt-4 d-flex flex-row justify-content-end">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a href="?page=1" class="page-link text-dark">First</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="?page=<?php if ($page_no == 1) echo "1";
                                                                else echo $page_no - 1; ?>" class="page-link text-dark">Previous</a>
                                            </li>

                                            <?php
                                            if ($total_no_of_pages <= 5) {
                                                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                                            ?>
                                                    <li class="page-item <?= $page_no == $i ? "active" : "" ?>">
                                                        <a href="?page=<?= $i ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
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
                                                            <a href="?page=<?= $i ?>" class="page-link <?= $page_no == $i ? "" : "text-dark" ?>"><?= $i ?></a>
                                                        </li>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            <li class="page-item">
                                                <a href="?page=<?php if ($page_no == $total_no_of_pages) echo $total_no_of_pages;
                                                                else echo $page_no + 1; ?>" class="page-link text-dark">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="?page=<?= $total_no_of_pages ?>" class="page-link text-dark">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php
                                }
                                ?>
                            </div>
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