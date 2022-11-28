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
$nav_selected = "Election";
$nav_breadcrumbs = [
    ["Home", "officer-index.php", "bi-house-fill"],
    ["CSC Election", "election-index.php", ""],
    ["Election Results", "", ""],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$curdate = date('Y-m-d');
$hasResults = false;

$election_id = -1;
$title = "";
$description = "";
$start_date = $curdate;
$end_date = $curdate;
$candidates = [];

$sql = "SELECT * FROM tb_elections WHERE ELECTION_TYPE='0' AND CURDATE() > END_DATE AND CURDATE() <= DATE_ADD(END_DATE, INTERVAL 7 DAY)";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        $hasResults = true;

        $row = $res->fetch_assoc();
        $election_id = $row['ELECTION_ID'];
        $title = $row['TITLE'];
        $description = $row['DESCRIPTION'];
        $start_date = $row['START_DATE'];
        $end_date = $row['END_DATE'];
    }
}

if ($hasResults) {
    $candidates = [];
    $sqlCandidates = "SELECT tb_candidate.*,tb_officers.LAST_NAME,tb_officers.FIRST_NAME,tb_officers.MIDDLE_INITIAL as MIDDLE_NAME,tb_officers.SECTION FROM tb_candidate LEFT JOIN tb_officers ON tb_candidate.STUDENT_NO=tb_officers.STUDENT_ID WHERE tb_candidate.ELECTION_ID='$election_id'";
    if ($res = @mysqli_query($conn, $sqlCandidates)) {
        $candidates = $res->fetch_all(MYSQLI_ASSOC);
    }
}

function getVotes($election_id, $position_id, $candidate_id)
{
    include('../mysql_connect.php');
    $sqlGetVotes = mysqli_query(
        $conn,
        "SELECT COUNT(*) As total_records FROM `tb_votes` WHERE ELECTION_ID='$election_id' AND POSITION_ID='$position_id' AND CANDIDATE_ID='$candidate_id'"
    );
    $total_records = @mysqli_fetch_array($sqlGetVotes);
    $total_records = $total_records['total_records'];
    return $total_records;
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

    <!-- Datatable Default-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

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
            <div class="col-lg-6 col-7 mb-4">
                <h4>JRU Central Student Council Election Results</h4>
            </div>
            <?php
            if ($hasResults) {
            ?>
                <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">
                    <div class="card-body px-2 mx-3 py-3 pt-4 ">

                        <div class="ms-3 d-flex flex-row align-items-center">
                            <h3 class="flex-grow-1 lead"><strong class="pr-1  text-muted ">Name:<br></strong> <?= $title ?></h3>
                        </div>
                        <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Description:<br></strong> <?= $description ?></h6>
                        <h6 class="ms-3 mb-3"><strong class="pr-1 text-muted mb-3">Election Date:<br></strong> <?= date("F d, Y", strtotime($start_date)) . " to " . date("F d, Y", strtotime($end_date)) ?></h6>
                    </div>
                </div>
                <div class="card shadow-sm card-registration mb-4" style="border-radius: 15px;">

                    <div class="card card-body">
                        <table id="resultTable" class="display nowrap m-0 w-100">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Candidate</th>
                                    <th>Winner/Total Votes</th>
                                    <th>Total Abstain</th>
                                    <th>Hidden</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT POSITION_ID as id,position FROM tb_position";
                                if ($respos = @mysqli_query($conn, $sql)) {
                                    while ($row = $respos->fetch_assoc()) {
                                        $pos_id = $row['id'];
                                        $posname = $row['position'];

                                        $found = count(array_filter($candidates, function ($item) {
                                            global $pos_id;
                                            return isset($item['POSITION_ID']) && $pos_id == $item['POSITION_ID'];
                                        }));

                                        if ($found > 0) {
                                            $sqlWinner = "SELECT tb_votes.CANDIDATE_ID,count(*) as votes,tb_candidate.STUDENT_NO as studentno FROM `tb_votes` LEFT JOIN `tb_candidate` ON tb_votes.CANDIDATE_ID=tb_candidate.CANDIDATE_ID WHERE tb_votes.ELECTION_ID='$election_id' AND tb_votes.POSITION_ID='$pos_id' AND tb_votes.CANDIDATE_ID<>'-1' GROUP BY tb_votes.CANDIDATE_ID ORDER BY votes DESC";
                                            $votes = 0;
                                            $invalidWinner = false;
                                            if ($res = @mysqli_query($conn, $sqlWinner)) {
                                                if ($res->num_rows > 0) {
                                                    $candidate = $res->fetch_assoc();
                                                    $votes = $candidate['votes'];
                                                    $winnerid = $candidate['studentno'];
                                                    $winnername = "";

                                                    $votes2 = -1;
                                                    if ($res->num_rows > 1) {
                                                        $candidate2 = $res->fetch_assoc();
                                                        $votes2 = $candidate2['votes'];
                                                    }

                                                    if ($votes == $votes2) {
                                                        $winnername = "Still Calculating Winner";
                                                        $invalidWinner = true;
                                                    } else {
                                                        $sqlGetName = "SELECT last_name as ln,first_name as fn,middle_initial as mn FROM tb_officers WHERE student_id='$winnerid'";
                                                        if ($res1 = @mysqli_query($conn, $sqlGetName)) {
                                                            if ($res1->num_rows > 0) {
                                                                $row1 = $res1->fetch_assoc();
                                                                $winnername = $row1['fn'] . " " . $row1['mn'] . " " . $row1['ln'];
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $winnername = "No Winner";
                                                    $invalidWinner = true;
                                                }
                                            }

                                            $pos_abstain_votes = getVotes($election_id, $pos_id, "-1");
                                            $pos_total_votes = 0;
                                            $sqlTotal = "SELECT COUNT(*) as total FROM tb_votes WHERE ELECTION_ID='$election_id' AND POSITION_ID='$pos_id' AND tb_votes.CANDIDATE_ID<>'-1'";
                                            if ($restotal = @mysqli_query($conn, $sqlTotal)) {
                                                $rowtotal = @mysqli_fetch_assoc($restotal);
                                                $pos_total_votes = $rowtotal['total'];
                                            }
                                ?>
                                            <tr>
                                                <td><?= $posname ?></td>
                                                <td <?= $invalidWinner ? "class='text-danger'" : "" ?>><?= $winnername ?? "" ?></td>
                                                <td><?= $votes . "/" . $pos_total_votes ?></td>
                                                <td><?= $pos_abstain_votes ?></td>
                                                <td style="display: none;">
                                                    <input type="text" id="dataset-<?= $pos_id ?>" value="<?= $posname . ";;" . $pos_total_votes . ";;" . $votes . ";;" . $pos_abstain_votes ?>">
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
            } else {
                ?>
                    <div class="text-center">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-5">No Recent Election</h1>
                                <p class="lead">There is no recent election conducted.</p>
                            </div>
                        </div>
                    </div>
                <?php
            }

                ?>


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
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js" integrity="sha512-gQhCDsnnnUfaRzD8k1L5llCCV6O9HN09zClIzzeJ8OJ9MpGmIlCxm+pdCkqTwqJ4JcjbojFr79rl2F1mzcoLMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
        Waves.attach('#sidebar ul li a');
        Waves.attach('.button');
        Waves.init();
    </script>

    <script>
        const CHART_COLORS = {
            blue: 'rgb(54, 162, 235)',
            orange: 'rgb(255, 159, 64)',
            red: 'rgb(255, 99, 132)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        var data_positions = [];
        var data_totalvotes = [];
        var data_totalwinner = [];
        var data_totalabstain = [];

        $("input[id^='dataset-']").each(function(index, element) {
            const val = element.value;
            const explodeval = val.split(";;");
            data_positions.push(explodeval[0]);
            data_totalvotes.push(explodeval[1]);
            data_totalwinner.push(explodeval[2]);
            data_totalabstain.push(explodeval[3]);
        });

        new Chart(
            document.getElementById('barchart'), {
                type: 'bar',
                options: {
                    indexAxis: 'y',
                    elements: {
                        bar: {
                            borderWidth: 2,
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Vote Tally'
                        }
                    }
                },
                data: {
                    labels: data_positions,
                    datasets: [{
                            label: 'Total Votes',
                            data: data_totalvotes,
                            borderColor: CHART_COLORS.blue,
                            backgroundColor: CHART_COLORS.blue,
                        },
                        {
                            label: 'Winner\'s Votes',
                            data: data_totalwinner,
                            borderColor: CHART_COLORS.green,
                            backgroundColor: CHART_COLORS.green
                        },
                        {
                            label: 'Total Abstain',
                            data: data_totalabstain,
                            borderColor: CHART_COLORS.red,
                            backgroundColor: CHART_COLORS.red
                        },
                    ]
                },
            }
        );
    </script>
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <script>
        myTable = $('#resultTable').DataTable({
            paging: false,
            searching: false,
            responsive: true,
            ordering: false,
            keys: true,
            fixedheader: true,
            "bFilter": true,
            dom: 'Bfrt',
            select: 'single',
            buttons: [{
                    extend: 'excelHtml5',
                    title: 'JRU Organizations Portal - Election Results',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    title: 'JRU Organizations Portal - Election Results',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
                },
            ],
            columns: [
                null,
                null,
                null,
                null,
                {
                    visible: false,
                }
            ],
        });
        myTable.columns.adjust().draw();
    </script>
</body>

</html>