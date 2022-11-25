<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$id = $_GET['survey_id'] ?? -1;
$orgid = $_GET['id'] ?? -1;
$orgName = "";
$orgType = 1;
$query = "SELECT ORG,org_type_id FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
    if ($orgRes->num_rows > 0) {
        $row = $orgRes->fetch_assoc();
        $orgName = $row['ORG'];
        $orgType = $row['org_type_id'];
    } else {
        header('location:admin-orgs.php');
    }
}

if ($id <= 0) {
    header("location:admin-survey.list.php?id=$orgid");
}

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
    ["Home", "admin-index.php", "bi-house-fill"],
    ["Site Management", "admin-users.php", ""],
    ["Organizations", "admin-orgs.php", ""],
    [$orgName, "admin-orgs-rso.php?id=$orgid", ""],
    ["Survey", "admin-survey.php?id=$orgid", ""],
    ["Survey List", "admin-survey-list.php?id=$orgid", ""],
    ["Survey Results", "", ""],
];

$query = "SELECT * FROM tb_surveys WHERE survey_id='$id'";
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
        header('location:admin-survey-list.php');
    }
}

$responses = [];
$queryQ = "SELECT * FROM tb_survey_questions WHERE survey_id='$id'";
if ($resQ = @mysqli_query($conn, $queryQ)) {
    while ($rowQ = $resQ->fetch_assoc()) {
        if ($rowQ['type'] >= 4 && $rowQ['type'] <= 7) {
            // with choices
            $qid = $rowQ['question_id'];
            $choices = explode(";;", $rowQ['choices']);
            $choices_arr = [];
            $count = 0;
            foreach ($choices as $choice) {
                $queryA = "SELECT COUNT(*) as total FROM tb_survey_answers WHERE question_id='$qid' AND answer LIKE '%[$count]%'";
                $total = 0;
                if ($resA = @mysqli_query($conn, $queryA)) {
                    $rowA = $resA->fetch_assoc();
                    $total = $rowA['total'];
                }
                $choices_arr[$choice] = $total;
                $count++;
            }

            $choices_arr["Data Visualization"] = "<obj>";

            $responses[$rowQ['question_id']] = [$rowQ['type'], $rowQ['question'], $choices_arr];
            /*} else if ($rowQ['type'] == 7) {
            // rating
            $qid = $rowQ['question_id'];
            $choices = ["Very Unsatisfied", "Unsatisfied", "Neutral", "Satisfied", "Very Satisfied"];
            $choices_arr = [];
            $count = 0;
            foreach ($choices as $choice) {
                $queryA = "SELECT COUNT(*) as total FROM tb_survey_answers WHERE question_id='$qid' AND answer='$count'";
                $total = 0;
                if ($resA = @mysqli_query($conn, $queryA)) {
                    $rowA = $resA->fetch_assoc();
                    $total = $rowA['total'];
                }
                $choices_arr[$choice] = $total;
                $count++;
            }
            $responses[$rowQ['question_id']] = [$rowQ['type'], $rowQ['question'], $choices_arr];*/
        } else {
            // objective questions
            $responses[$rowQ['question_id']] = [$rowQ['type'], $rowQ['question'], array("<obj>" => 0)];
        }
    }
}



$sqlCount = "SELECT count(DISTINCT student_no) as total FROM tb_survey_answers  WHERE survey_id='$id'";
$totalResponses = 0;
if ($resC = @mysqli_query($conn, $sqlCount)) {
    $rowC = $resC->fetch_assoc();
    $totalResponses = $rowC['total'];
}

if ($orgType == 1) {
    $sqlCount = "SELECT count(*) as total FROM tb_students WHERE MORG_ID='$orgid'";
} else {
    $sqlCount = "SELECT count(*) as total FROM tb_students WHERE ORG_IDS LIKE '%[$orgid]%'";
}
$totalMembers = 0;
if ($resC = @mysqli_query($conn, $sqlCount)) {
    $rowC = $resC->fetch_assoc();
    $totalMembers = $rowC['total'];
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
    <title>JRU Student Organizations Portal</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Datatable Default-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

    <!-- Waves CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <h4 class="ms-3 mb-4">Survey Results</h4>

            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <div class="card-body px-2 mx-3 mb-4 py-3 pt-4 ">
                    <h5 class="mb-4">Survey Information & Tallies</h5>
                    <div class="mb-4">
                        <label class="form-label" for="TITLE">Title</label>
                        <p class="form-control"><?= $survey_title ?></p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="DESC">Description</label>
                        <p class="form-control"><?= $survey_desc ?></p>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label class="form-label" for="STARTDATE">Start Date</label>
                            <p class="form-control"><?= $survey_startdate ?></p>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ENDDATE">End Date</label>
                            <p class="form-control"><?= $survey_enddate ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <label class="form-label">Total Responses: <?= $totalResponses . " out of " . $totalMembers . " members" ?></label>
                    </div>

                    <div class="mb-4">
                        <div class="table-responsive-md">
                            <table id="qtable" class="table table-bordered">
                                <thead class="thead-light">
                                    <th style="width: max-content;">Questions</th>
                                    <th style="width: max-content;">Choices</th>
                                    <th style="width: 200px;">Responses</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($responses as $key => $value) {
                                        $choices = array_keys($value[2]);
                                        for ($i = 0; $i < count($choices); $i++) {
                                            if ($choices[$i] == "<obj>") {
                                    ?>

                                                <tr>
                                                    <td><?= $i == 0 ? $count . ". " . $value[1] : "" ?></td>
                                                    <td>Unable to tally objective type questions.</td>
                                                    <td><a href="#" id="<?= $key ?>" class="btn btn-primary showAnswers"><i class="bi bi-eye-fill"></i> <span id="btntitle">View Answers</span></a></td>
                                                </tr>
                                            <?php
                                            } else {
                                            ?>

                                                <tr>
                                                    <td><?= $i == 0 ? $count . ". " . $value[1] : "" ?></td>
                                                    <td><?= $choices[$i] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($value[2][$choices[$i]] == "<obj>") {
                                                        ?>
                                                            <a href="#" onclick="showTally('Data Visualization for Question #<?= $count ?>', '<?= implode(';;', array_keys($value[2])) ?>', '<?= implode(';;', array_values($value[2])) ?>')" class="btn btn-primary"><i class="bi bi-eye-fill"></i> <span id="btntitle"> View Answers </span></a>
                                                        <?php
                                                        } else {
                                                            echo $value[2][$choices[$i]];
                                                        }

                                                        ?>

                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                        $count++;
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card shadow card-registration m-4 mb-4" style="border-radius: 15px;">
                    <div class="card-body px-2 mx-3 mb-4 py-3 pt-4 ">
                        <h5 class="mb-4">Response Logs</h5>
                        <div class="row g-0 justify-content-center ">
                            <div class="table-responsive ms-2">
                                <table id='survey-table' class='py-3 display nowrap w-100 ms-0 stud'>
                                    <thead>
                                        <tr>
                                            <th>Respondent</th>
                                            <th>Section</th>
                                            <th>Date Submitted</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sql = "SELECT DISTINCT tb_survey_answers.submitted as date,tb_students.first_name as fn,tb_students.last_name as ln,tb_students.section as section FROM tb_survey_answers LEFT JOIN tb_students ON tb_survey_answers.student_no=tb_students.student_id WHERE survey_id='$id' ORDER BY tb_survey_answers.answer_id DESC";
                                        $res = @mysqli_query($conn, $sql);
                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?= $row['fn'] . " " . $row['ln'] ?></td>
                                                    <td><?= $row['section'] ?></td>
                                                    <td><?= date('M. d, Y h:i A', $row['date']) ?></td>
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
        </div>

        <div class="modal fade" id="modalAnswers" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="modalChoiceTitle"> Answers </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table id="tableAnswers" class='py-3 display nowrap w-100 ms-0 stud'>
                            <thead>
                                <th>Survey ID</th>
                                <th>Answer</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalTally" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header py-3 px-3">
                        <h5 class="modal-title" id="modalTallyTitle"> Answers </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-row justify-content-center p-5">
                        <div style="width: 400px;"><canvas id="tallychart"></canvas></div>
                    </div>
                    <div class="modal-footer py-2 px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!-- Sidebar collapse -->
        <script src="../assets/js/form-validation.js"></script>
        <!-- Chart JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js" integrity="sha512-gQhCDsnnnUfaRzD8k1L5llCCV6O9HN09zClIzzeJ8OJ9MpGmIlCxm+pdCkqTwqJ4JcjbojFr79rl2F1mzcoLMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Waves CSS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script> <!-- JavaScript validation -->
        <script type="text/javascript">
            Waves.attach('#sidebar ul li a');
            Waves.init();
        </script>
        <script>
            $(document).on('click', '.showAnswers', function() {
                var question_id = $(this).attr("id");
                $.ajax({
                    url: "include/survey-fetch-answers.php",
                    method: "POST",
                    data: {
                        question_id: question_id
                    },
                    dataType: "json",
                    error: function(x, y, z) {
                        console.log(x);
                        console.log(y);
                        console.log(z);
                    },
                    success: function(data) {
                        if (data == null) {
                            alert('Result is empty');
                        } else {
                            var table = $('#tableAnswers').DataTable();
                            table.clear();
                            $.each(data, function(i, item) {
                                table.row.add([item.date, item.answer]).draw();
                            });

                            $('#modalAnswers').modal('show');

                        }
                    }
                });
            });

            function showTally(title, keys, values) {
                Chart.helpers.each(Chart.instances, function(instance) {
                    if (instance.canvas.id == "tallychart") {
                        instance.destroy();
                    }
                })

                const CHART_COLORS = {
                    blue: 'rgb(54, 162, 235)',
                    orange: 'rgb(255, 159, 64)',
                    red: 'rgb(255, 99, 132)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(201, 203, 207)'
                };

                new Chart(
                    document.getElementById('tallychart'), {
                        type: 'doughnut',
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                title: {
                                    display: false,
                                }
                            }
                        },
                        data: {
                            labels: keys.split(";;").slice(0, -1),
                            datasets: [{
                                label: 'Value',
                                data: values.split(";;").slice(0, -1),
                                backgroundColor: Object.values(CHART_COLORS),
                            }],
                        },
                    },
                );

                $('#modalTallyTitle').text(title);
                $('#modalTally').modal('show');
            }
        </script>
        <!-- Datatable -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tableAnswers').DataTable({
                    responsive: true,
                    keys: true,
                    fixedheader: true,
                    bautoWidth: true,
                    dom: 'Bfrtip',
                    "bFilter": true,
                    select: 'single',
                    buttons: [
                        'pageLength',
                    ]
                });
                $('#survey-table').DataTable({
                    responsive: true,
                    keys: true,
                    fixedheader: true,
                    bautoWidth: false,
                    dom: 'Bfrtip',
                    "bFilter": true,
                    "columns": [{
                            "width": "200px"
                        },
                        {
                            "width": "300px"
                        },
                        {
                            "width": "200px"
                        }
                    ],
                    select: 'single',
                    buttons: [
                        'pageLength',
                        {
                            extend: 'excelHtml5',
                            title: 'JRU Organizations Portal -  Survey Responses',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                        },
                        //{
                        //  extend: 'csvHtml5',
                        //    title: 'JRU Organizations Portal - Officer Pending List',
                        //    footer: true,
                        //    customize: function (csv) {
                        //     return "JRU Organizations Portal - Officer Pending List\n\n"+  csv;
                        //    },
                        //    exportOptions: {
                        //      columns: [0,1,2,3,4,6,7,8,9,10,11,12,13,14,15,16]
                        //  },
                        //    } ,
                        {
                            extend: 'pdfHtml5',
                            title: 'JRU Organizations Portal - Elections Masterlist',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                            orientation: 'landscape',
                            pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
                        },
                        {
                            extend: 'print',
                            title: 'JRU Organizations Portal -  Elections Masterlist',
                            footer: true,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                            customize: function(win) {

                                var last = null;
                                var current = null;
                                var bod = [];

                                var css = '@page { size: landscape; font-size: 1em;}',
                                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                                    style = win.document.createElement('style');

                                style.type = 'text/css';
                                style.media = 'print';

                                if (style.styleSheet) {
                                    style.styleSheet.cssText = css;
                                } else {
                                    style.appendChild(win.document.createTextNode(css));
                                }

                                head.appendChild(style);
                            }
                        },
                    ]
                });
            });
        </script>
</body>

</html>