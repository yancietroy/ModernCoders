<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
$nav_selected = "Survey";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["Organizations", "officer-orgs.php", "bi-people-fill"],
    [$_SESSION['USER-ORG-NAME'], "rso.php", ""],
    ["Survey", "officer-survey.php", ""],
    ["Create New Survey", "", ""],
];

if (isset($_POST['create-survey'])) {
    $title =  $mysqli->real_escape_string($_POST['TITLE']);
    $description =  $mysqli->real_escape_string($_POST['DESC']);
    $startdate =  $mysqli->real_escape_string($_POST['STARTDATE']);
    $enddate =  $mysqli->real_escape_string($_POST['ENDDATE']);
    $type =  $mysqli->real_escape_string($_POST['qType']);
    $questions = [];

    if ($type == 1) {
        // Standard Questions:
        array_push($questions, ["7", "Physical setting and arrangements", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Adequate space and ventilation", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Relevance of the topics discussed", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);

        array_push($questions, ["7", "Scope of the topics covered", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Usefulness of activities", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Effectiveness of the speaker", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Mastery of the topic", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Sound System", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);

        array_push($questions, ["7", "Use of computer and technology", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
        array_push($questions, ["7", "Adequate seats", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);

        array_push($questions, ["2", "Remarks/Suggestions", "POOR;;NEEDS IMPROVEMENT;;SATISFACTORY;;VERY SATISFACTORY;;EXCELLENT", "0"]);
    } else {
        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, "entry-")) {
                $optional = explode("-", $key)[3];
                $type = explode("-", $key)[2];
                $question = "";
                $choices = "";

                if ($type >= 4 && $type <= 7) {
                    // 4,5,6,7
                    $val = explode("::", $value);
                    $question = $val[0];
                    $choices = $val[1];
                } else {
                    // 1,2,3,7
                    $question = $value;
                }
                array_push($questions, ["$type", "$question", "$choices", "$optional"]);
            }
        }
    }

    $timestamp = time();
    $query = "INSERT INTO tb_surveys (survey_id,title,description,start_date,end_date,org_id) VALUES ('$timestamp','$title','$description','$startdate','$enddate','$orgid')";
    if ($resGen = @mysqli_query($conn, $query)) {
        $query = "INSERT INTO tb_survey_questions (survey_id,question,type,choices,optional) VALUES ";
        $values = [];
        foreach ($questions as $data) {
            $q = $data[1];
            $t = $data[0];
            $c = $data[2];
            $o = $data[3];
            $val = "('$timestamp','$q','$t','$c','$o')";
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
                    <div class="mb-4 row">
                        <label class="form-label">Survey Questions</label>
                        <div class="col">
                            <input type="radio" id="rdStandard" name="qType" onchange="typeChanged()" value="1" checked>
                            <label class="form-label" for="rdStandard">Standard Template</label>
                            <input type="radio" class="ml-3" id="rdCustom" onchange="typeChanged()" value="2" name="qType">
                            <label class="form-label" for="rdCustom">Custom Questions</label>
                        </div>
                    </div>
                    <div class="mb-4 row" id="customMakerButtons" style="display: none;">
                        <div class="col-12">
                            <label class="form-label" for="ENDDATE">Type of Question:</label><br>
                            <button class="btn btn-primary small ms-2 btnText my-2" type="button">Text</button>
                            <button class="btn btn-primary small ms-2 btnMText my-2" type="button">Multiline Text</button>
                            <button class="btn btn-primary small ms-2 btnNum my-2" type="button">Numeric</button>
                            <button class="btn btn-primary small ms-2 btnCb my-2" type="button">Checkboxes</button>
                            <button class="btn btn-primary small ms-2 btnRb my-2" type="button">Radio Button</button>
                            <button class="btn btn-primary small ms-2 btnDd my-2" type="button">Dropdown</button>
                            <button class="btn btn-primary small ms-2 btnRate my-2" type="button">Rating</button>
                        </div>
                    </div>
                    <div class="mb-4 border" id="customMakerTable" style="min-height:100px; display: none;">
                        <div class="table-responsive-xl">
                            <table id="qtable" class="table table-bordered">
                                <thead class="thead-light">
                                    <th style="width: 200px;">Type</th>
                                    <th>Question:</th>
                                    <th style="width: 200px;">Action</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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
                                <label class="form-label" for="add-text-question">Question:</label>
                                <input type="text" id="add-text-question" class="form-control" />
                                <div class="d-flex flex-row align-items-center mt-2">
                                    <input type="checkbox" id="add-text-optional" />
                                    <label class="form-label m-0 ml-1" for="add-text-optional">Optional</label>
                                </div>
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
                                <label class="form-label" for="add-mtext-question">Question:</label>
                                <input type="text" id="add-mtext-question" class="form-control" />
                                <div class="d-flex flex-row align-items-center mt-2">
                                    <input type="checkbox" id="add-mtext-optional" />
                                    <label class="form-label m-0 ml-1" for="add-mtext-optional">Optional</label>
                                </div>
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
                                <label class="form-label" for="add-num-question">Question:</label>
                                <input type="text" id="add-num-question" class="form-control" />
                                <div class="d-flex flex-row align-items-center mt-2">
                                    <input type="checkbox" id="add-num-optional" />
                                    <label class="form-label m-0 ml-1" for="add-num-optional">Optional</label>
                                </div>
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
                                <label class="form-label" for="add-rating-question">Question:</label>
                                <input type="text" id="add-rating-question" class="form-control" />
                                <div class="d-flex flex-row align-items-center mt-2">
                                    <input type="checkbox" id="add-rating-optional" />
                                    <label class="form-label m-0 ml-1" for="add-rating-optional">Optional</label>
                                </div>
                                <p class="mb-1 mt-4">Rating Description</p>
                                <label class="form-label" for="add-rating-desc1">Rate 1:</label>
                                <input type="text" id="add-rating-desc1" class="form-control" value="Very Unsatisfied" />
                                <label class="form-label" for="add-rating-desc2">Rate 2:</label>
                                <input type="text" id="add-rating-desc2" class="form-control" value="Unsatisfied" />
                                <label class="form-label" for="add-rating-desc3">Rate 3:</label>
                                <input type="text" id="add-rating-desc3" class="form-control" value="Neutral" />
                                <label class="form-label" for="add-rating-desc4">Rate 4:</label>
                                <input type="text" id="add-rating-desc4" class="form-control" value="Satisfied" />
                                <label class="form-label" for="add-rating-desc5">Rate 5:</label>
                                <input type="text" id="add-rating-desc5" class="form-control" value="Very Satisfied" />
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
                                <label class="form-label" for="add-choices-question">Question:</label>
                                <input type="text" id="add-choices-question" class="form-control" />
                                <div class="d-flex flex-row align-items-center mt-2">
                                    <input type="checkbox" id="add-choices-optional" />
                                    <label class="form-label m-0 ml-1" for="add-choices-optional">Optional</label>
                                </div>
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
            function typeChanged() {
                if ($('#rdStandard').prop("checked")) {
                    $('#customMakerButtons').hide();
                    $('#customMakerTable').hide();
                } else if ($('#rdCustom').prop("checked")) {
                    $('#customMakerButtons').show();
                    $('#customMakerTable').show();
                }
            }
        </script>
        <script>
            let entryCount = 1;

            $(document).on('click', '#add-text', function() {
                var question = $('#add-text-question').val();
                var optional = $('#add-text-optional').prop('checked') ? "1" : "0";

                var output = `
                    <tr id="entry-${entryCount}">
                        <td>TextBox</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-1-${optional}" value="${question}" style="display: none;">
                            ${question}${optional == "0" ? "<span class='ml-1 text-danger'>*</span>" : ""}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')"><i class="bi bi-trash-fill"></i> <span id="btntitle">Delete Question</span></a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-mtext', function() {
                var question = $('#add-mtext-question').val();
                var optional = $('#add-mtext-optional').prop('checked') ? "1" : "0";

                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Multiline</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-2-${optional}" value="${question}" style="display: none;">
                            ${question}${optional == "0" ? "<span class='ml-1 text-danger'>*</span>" : ""}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')"><i class="bi bi-trash-fill"></i> <span id="btntitle">Delete Question</span></a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-num', function() {
                var question = $('#add-num-question').val();
                var optional = $('#add-num-optional').prop('checked') ? "1" : "0";

                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Numeric</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-3-${optional}" value="${question}" style="display: none;">
                            ${question}${optional == "0" ? "<span class='ml-1 text-danger'>*</span>" : ""}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')"><i class="bi bi-trash-fill"></i> <span id="btntitle">Delete Question</span></a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });
            $(document).on('click', '#add-rating', function() {
                var question = $('#add-rating-question').val();
                var optional = $('#add-rating-optional').prop('checked') ? "1" : "0";

                var choices = [
                    $('#add-rating-desc1').val(),
                    $('#add-rating-desc2').val(),
                    $('#add-rating-desc3').val(),
                    $('#add-rating-desc4').val(),
                    $('#add-rating-desc5').val(),
                ];
                var value = `
                    ${question}
                    <br>
                    <br>
                    <i>
                        Rating:
                        <br> 1. ${choices[0]}
                        <br> 2. ${choices[1]}
                        <br> 3. ${choices[2]}
                        <br> 4. ${choices[3]}
                        <br> 5. ${choices[4]}
                    </i>
                `;

                var output = `
                    <tr id="entry-${entryCount}">
                        <td>Rating</td>
                        <td>
                            <input type="text" name="entry-${entryCount}-7-${optional}" value="${question}::${choices.join(";;")}" style="display: none;">
                            ${value}${optional == "0" ? "<span class='ml-1 text-danger'>*</span>" : ""}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')"><i class="bi bi-trash-fill"></i> <span id="btntitle">Delete Question</span></a>
                        </td>
                    </tr>
                `;
                $('#qtable > tbody').append(output);
                entryCount++;
            });

            $(document).on('click', '#add-choices', function() {
                var question = $('#add-choices-question').val();
                var optional = $('#add-choices-optional').prop('checked') ? "1" : "0";

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
                            <input type="text" name="entry-${entryCount}-${typeval}-${optional}" value="${question}::${choices.join(";;")}" style="display: none;">
                            ${value}${optional == "0" ? "<span class='ml-1 text-danger'>*</span>" : ""}
                        </td>
                        <td>
                            <a class="align-middle text-white btn btn-danger" onclick="deleteEntry('entry-${entryCount}')"><i class="bi bi-trash-fill"></i> <span id="btntitle">Delete Question</span></a>
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
