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
$nav_selected = "Survey";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Survey", "officer-survey.php", ""],
    ["Create New Survey", "", ""],
];

if (isset($_POST['create-survey'])) {
    $title = $_POST['TITLE'];
    $description = $_POST['DESC'];
    $startdate = $_POST['STARTDATE'];
    $enddate = $_POST['ENDDATE'];
    $questions = [];
    foreach ($_POST as $key => $value) {
        if (str_starts_with($key, "entry-")) {
            $type = explode("-", $key)[2];
            $question = "";
            $choices = "";

            if ($type >= 4 && $type <= 6) {
                // 4,5,6
                $val = explode("::", $value);
                $question = $val[0];
                $choices = $val[1];
            } else {
                // 1,2,3,7
                $question = $value;
            }
            array_push($questions, ["$type", "$question", "$choices"]);
        }
    }
    $timestamp = time();
    $query = "INSERT INTO tb_surveys (survey_id,title,description,start_date,end_date,org_id) VALUES ('$timestamp','$title','$description','$startdate','$enddate','$orgid')";
    if ($resGen = @mysqli_query($conn, $query)) {
        $query = "INSERT INTO tb_survey_questions (survey_id,question,type,choices) VALUES ";
        $values = [];
        foreach ($questions as $data) {
            $q = $data[1];
            $t = $data[0];
            $c = $data[2];
            $val = "('$timestamp','$q','$t','$c')";
            array_push($values, $val);
        }
        $query = $query . implode(",", $values);

        if ($resQ = @mysqli_query($conn, $query)) {
            header('location:officer-survey-list.php');
        } else {
            echo "<script>alert('Unexpected error while saving the survey questions. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Unexpected error while saving the survey details. Please try again.')</script>";
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
            <h4 class="ms-3 mb-4">Create New Survey</h4>

            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <form method="POST" action="" class="card-body px-2 mx-3 mb-4 py-3 pt-4 ">
                    <div class="mb-4">
                        <label class="form-label" for="TITLE">Title</label>
                        <input class="form-control" type="text" name="TITLE" id="TITLE" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="DESC">Description</label>
                        <textarea class="form-control" name="DESC" id="DESC" rows="6" required></textarea>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label class="form-label" for="STARTDATE">Start Date</label>
                            <input class="form-control" type="date" name="STARTDATE" id="STARTDATE" min="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ENDDATE">End Date</label>
                            <input class="form-control" type="date" name="ENDDATE" id="ENDDATE" min="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="ENDDATE">Add Question</label>
                        <div class="d-flex flex-row">
                            <button class="btn btn-primary small ms-2 btnText" type="button">Text</button>
                            <button class="btn btn-primary small ms-2 btnMText" type="button">Multiline Text</button>
                            <button class="btn btn-primary small ms-2 btnNum" type="button">Numeric</button>
                            <button class="btn btn-primary small ms-2 btnCb" type="button">Checkboxes</button>
                            <button class="btn btn-primary small ms-2 btnRb" type="button">Radiobutton</button>
                            <button class="btn btn-primary small ms-2 btnDd" type="button">Dropdown</button>
                            <button class="btn btn-primary small ms-2 btnRate" type="button">Rating</button>
                        </div>
                    </div>

                    <div class="mb-4 border" style="min-height:100px;">
                        <table id="qtable" class="table table-bordered" style="table-layout: fixed;">
                            <thead class="thead-light">
                                <th style="width: 200px;">Type</th>
                                <th>Question</th>
                                <th style="width: 200px;">Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-row justify-content-center w-100 mt-5 mb-2">
                        <button type="submit" name="create-survey" class="btn btn-primary col-6 col-md-5" id="create-survey">Create Survey</button>
                    </div>

                </form>
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

        <div class="modal fade" id="modalText" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Textbox </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <label class="form-label" for="add-text-question">Question</label>
                                <input type="text" id="add-text-question" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="add-text" class="btn btn-info" data-bs-dismiss="modal">Add Field</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalMText" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Multiline Textbox </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <label class="form-label" for="add-mtext-question">Question</label>
                                <input type="text" id="add-mtext-question" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="add-mtext" class="btn btn-info" data-bs-dismiss="modal">Add Field</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalNum" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Numeric Field </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <label class="form-label" for="add-num-question">Question</label>
                                <input type="text" id="add-num-question" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="add-num" class="btn btn-info" data-bs-dismiss="modal">Add Field</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRating" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Rating </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <label class="form-label" for="add-rating-question">Question</label>
                                <input type="text" id="add-rating-question" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="add-rating" class="btn btn-info" data-bs-dismiss="modal">Add Field</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalChoice" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="modalChoiceTitle"> Add Checkboxes </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                            <div class="form-outline">
                                <input type="text" id="add-choices-type" style="display: none;">
                                <label class="form-label" for="add-choices-question">Question</label>
                                <input type="text" id="add-choices-question" class="form-control" />
                                <label class="form-label mt-4" for="add-choices-list">Choices</label>
                                <div class="form-outline mb-3" id="add-choices-list">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" id="add-choices-addbtn" class="btn btn-primary mr-3">Add Choices</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="add-choices" class="btn btn-info" data-bs-dismiss="modal">Add Field</button>
                    </div>
                </div>
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
        <script>
            let entryCount = 1;

            $(document).on('click', '#add-text', function() {
                var question = $('#add-text-question').val();
                var output = `
                    <tr id="entry-${entryCount}">
                        <td>TextBox</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-1" value="${question}" style="display: none;">
                            ${question}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')">Delete Question</a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-mtext', function() {
                var question = $('#add-mtext-question').val();
                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Multiline</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-2" value="${question}" style="display: none;">
                            ${question}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')">Delete Question</a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-num', function() {
                var question = $('#add-num-question').val();
                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Numeric</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-3" value="${question}" style="display: none;">
                            ${question}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')">Delete Question</a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-rating', function() {
                var question = $('#add-rating-question').val();
                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Rating</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-7" value="${question}" style="display: none;">
                            ${question}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')">Delete Question</a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });

            $(document).on('click', '#add-choices', function() {
                var question = $('#add-choices-question').val();
                var choices = [];
                $('#add-choices-list').children('input').each(function(i) {
                    if ($(this).val() != "") {
                        choices.push($(this).val());
                    }
                });

                var value = `
                    ${question}
                    <br>
                    <br>
                    <i>
                        Choices:<br> - 
                        ${choices.join("<br> - ")}
                    </i>
                `;

                var type = "";
                var typeval = 6;
                if ($('#add-choices-type').val() == "1") {
                    type = "Checkboxes";
                    typeval = 4;
                } else if ($('#add-choices-type').val() == "2") {
                    type = "Radiobutton";
                    typeval = 5;
                } else if ($('#add-choices-type').val() == "3") {
                    type = "Dropdown";
                    typeval = 6;
                }

                var output = `
                    <tr id="entry-${entryCount}">
                        <td>${type}</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-${typeval}" value="${question}::${choices.join(";;")}" style="display: none;">
                            ${value}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')">Delete Question</a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });

            function deleteEntry(id) {
                $("#" + id).remove();
            }
        </script>
        <script>
            let choiceIndex = 1;

            $(document).on('click', '.btnText', function() {
                $('#add-text-question').val('');
                $('#modalText').modal('show');
            });

            $(document).on('click', '.btnMText', function() {
                $('#add-mtext-question').val('');
                $('#modalMText').modal('show');
            });

            $(document).on('click', '.btnNum', function() {
                $('#add-num-question').val('');
                $('#modalNum').modal('show');
            });

            $(document).on('click', '.btnRate', function() {
                $('#add-rating-question').val('');
                $('#modalRating').modal('show');
            });

            $(document).on('click', '.btnCb', function() {
                choiceIndex = 1;
                $('#modalChoiceTitle').text('Add Checkbox');
                $('#add-choices-list').empty();
                $('#add-choices-question').val('');
                $('#add-choices-type').val("1");
                $('#modalChoice').modal('show');
            });
            $(document).on('click', '#add-cb-add-choices', function() {
                $('#add-choices-list').append('<input type="text" class="form-control mt-2" id="add-choices-choice' + choiceIndex + '" />');
                choiceIndex += 1;
            });

            $(document).on('click', '.btnRb', function() {
                choiceIndex = 1;
                $('#modalChoiceTitle').text('Add Radiobutton');
                $('#add-choices-list').empty();
                $('#add-choices-question').val('');
                $('#add-choices-type').val("2");
                $('#modalChoice').modal('show');
            });
            $(document).on('click', '#add-cb-add-choices', function() {
                $('#add-choices-list').append('<input type="text" class="form-control mt-2" id="add-choices-choice' + choiceIndex + '" />');
                choiceIndex += 1;
            });

            $(document).on('click', '.btnDd', function() {
                choiceIndex = 1;
                $('#modalChoiceTitle').text('Add Dropdown');
                $('#add-choices-list').empty();
                $('#add-choices-question').val('');
                $('#add-choices-type').val("3");
                $('#modalChoice').modal('show');
            });
            $(document).on('click', '#add-choices-addbtn', function() {
                $('#add-choices-list').append('<input type="text" class="form-control mt-2" id="add-choices-choice' + choiceIndex + '" />');
                choiceIndex += 1;
            });
        </script>
</body>

</html>