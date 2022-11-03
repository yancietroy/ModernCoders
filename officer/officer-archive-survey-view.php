<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$id = $_GET['id'] ?? -1;
if ($id == -1) {
    header('location:officer-survey-list.php');
}

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Survey";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Survey", "officer-survey.php", ""],
    ["Survey List", "officer-survey-list.php", ""],
    ["View Survey", "", ""],
];

$query = "SELECT * FROM tb_surveys_archive WHERE survey_id='$id'";
if ($res = @mysqli_query($conn, $query)) {
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $survey_title = $row['title'];
        $survey_desc = $row['description'];
        $survey_startdate = $row['start_date'];
        $survey_enddate = $row['end_date'];
        $survey_status = 0;

        if ($row['start_date'] < date('Y-m-d') && $row['end_date'] < date('Y-m-d')) {
            $survey_status = 2;
        } else if ($row['start_date'] > date('Y-m-d') && $row['end_date'] > date('Y-m-d')) {
            $survey_status = 0;
        } else {
            $survey_status = 1;
        }
    } else {
        header('location:officer-survey-list.php');
    }
}

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
            <h4 class="ms-3 mb-4">View Survey</h4>

            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <div class="card-body px-2 mx-3 mb-4 py-3 pt-4 ">
                    <div class="mb-4">
                        <label class="form-label" for="TITLE">Title</label>
                        <input class="form-control" type="text" name="TITLE" id="TITLE" value="<?= $survey_title ?>" required <?= $survey_status == 0 ? "" : "readonly" ?>>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="DESC">Description</label>
                        <textarea class="form-control" name="DESC" id="DESC" rows="6" required <?= $survey_status == 0 ? "" : "readonly" ?>><?= $survey_desc ?></textarea>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label class="form-label" for="STARTDATE">Start Date</label>
                            <input class="form-control" type="date" name="STARTDATE" id="STARTDATE" value="<?= $survey_startdate ?>" min="<?php echo date("Y-m-d"); ?>" required <?= $survey_status == 0 ? "" : "readonly" ?>>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ENDDATE">End Date</label>
                            <input class="form-control" type="date" name="ENDDATE" id="ENDDATE" value="<?= $survey_enddate ?>" min="<?php echo date("Y-m-d"); ?>" required <?= $survey_status == 0 ? "" : "readonly" ?>>
                        </div>
                    </div>

                    <div class="mb-4 border" style="min-height:100px;">
                        <table id="qtable" class="table table-bordered" style="table-layout: fixed;">
                            <thead class="thead-light">
                                <th style="width: 80px;">#</th>
                                <th style="width: 200px;">Type</th>
                                <th>Question</th>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_survey_questions WHERE survey_id='$id'";
                                if ($res = @mysqli_query($conn, $query)) {
                                    $count = 0;
                                    while ($row = $res->fetch_assoc()) {
                                        $count++;
                                ?>
                                        <tr id="entry-<?= $count ?>">
                                            <td><?= $count ?></td>
                                            <td>
                                                <?php
                                                if ($row['type'] == 2) {
                                                    echo "Multiline";
                                                } else if ($row['type'] == 3) {
                                                    echo "Numeric";
                                                } else if ($row['type'] == 4) {
                                                    echo "Checkboxes";
                                                } else if ($row['type'] == 5) {
                                                    echo "Radiobutton";
                                                } else if ($row['type'] == 6) {
                                                    echo "Dropdown";
                                                } else if ($row['type'] == 7) {
                                                    echo "Rating";
                                                } else {
                                                    echo "TextBox";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <input type="text" name="entry-${entryCount}-${typeval}" value="<?= $row['question'] ?><?= $row['choices'] != "" ? "::" . $row['choices'] : "" ?>" style="display: none;">
                                                <?php
                                                if ($row['type'] >= 4 && $row['type'] <= 6) {
                                                    echo $row['question'] . "<br><br><i>Choices:<br> - " . str_replace(";;", "<br> - ", $row['choices']) . "</i>";
                                                } else {
                                                    echo $row['question'];
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <p class="ms-3 text-muted"><em>* You cannot edit a survey that has already been archived.</em></p>

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