<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Election";
$nav_breadcrumbs = [
    ["Home", "admin-index.php", "bi-house-fill"],
    ["Election", "admin-election.php", "bi-check2-square"],
    ["Create New Election", "", "bi-plus-circle"],
];

if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}

$selected_type = $_GET['type'] ?? 1;
$selected_org = $_GET['org'] ?? -1;


if (isset($_POST['create-election'])) {
    // Get General Information
    $orgid = explode("::", $_POST['ORG'])[0];
    $title = $_POST['TITLE'];
    $description = $_POST['DESC'];
    $startdate = $_POST['STARTDATE'];
    $enddate = $_POST['ENDDATE'];
    $type = explode("::", $_POST['ORG'])[1];

    if ($orgid == -1) {
        echo "<script>alert('Please select an organization.')</script>";
    } else {
        $selected_org = $orgid;

        // Get Candidates + Position
        $candidates = [];
        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, "pos-")) {
                $studentno = str_replace('pos-', '', $key);
                $position = $value;
                $candidates[$studentno] = $position;
            }
        }

        // Check if date already exists
        $sqlCheckDate = mysqli_query(
            $conn,
            "SELECT COUNT(*) As total_records FROM `tb_elections` WHERE ORG_ID='$orgid' AND (('$startdate'>=START_DATE AND '$startdate'<=END_DATE)
    OR ('$enddate'>=START_DATE AND '$enddate'<=END_DATE)
    OR (START_DATE>='$startdate' AND START_DATE<='$enddate')
    OR (END_DATE>='$startdate' AND END_DATE<='$enddate'))"
        );
        $total_records = @mysqli_fetch_array($sqlCheckDate);
        $total_records = $total_records['total_records'];

        if ($total_records > 0) {
            echo "<script>alert('Election with the same organization and date range already exist. Please try again.')</script>";
        } else if (count($candidates) > 0) {
            $sqlGeneral = "INSERT INTO `tb_elections`(ELECTION_TYPE,ORG_ID,TITLE,DESCRIPTION,START_DATE,END_DATE) VALUES ('$type','$orgid','$title','$description','$startdate','$enddate')";

            if (@mysqli_query($conn, $sqlGeneral)) {
                $electionid = $conn->insert_id;
                $sqlCandidates = "INSERT INTO `tb_candidate`(ELECTION_ID,POSITION_ID,STUDENT_NO) VALUES ";

                $values = [];
                foreach ($candidates as $studentno => $position) {
                    array_push($values, "('$electionid','$position','$studentno')");
                }

                $sqlCandidates .= implode(',', $values);

                if (@mysqli_query($conn, $sqlCandidates)) {
                    // Successfully created
                    header('location:admin-election-list.php');
                } else {
                    echo "<script>alert('Error while saving the candidates information. Please try again.')</script>";
                }
            } else {
                echo "<script>alert('Error while saving the election information. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('No Candidates were selected. Please try again.')</script>";
        }
    }
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
            <h4 class="ms-3 mb-4">Create New Election</h4>
            <input type="text" id="selected_org" value="<?= $selected_org ?>" style="display: none;">

            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <form method="POST" action="" class="card-body px-2 mx-3 mb-4 py-3 pt-4 ">
                    <div class="mb-4" id="orgcontainer">
                        <label class="form-label" for="ORG">Organization</label>
                        <select class="form-select" name="ORG" id="ORG" required>
                            <option value="0">JRU Student Organization Council</option>
                            <?php
                            $queryOrgs = "SELECT ORG_ID,ORG,ORG_TYPE_ID FROM tb_orgs WHERE ORG_TYPE_ID = 1";
                            if ($resOrgs = @mysqli_query($conn, $queryOrgs)) {
                                while ($rowOrgs = $resOrgs->fetch_assoc()) {
                                    $orgname = $rowOrgs['ORG'];
                                    if ($rowOrgs['ORG_TYPE_ID'] == 1) {
                                        $orgname = "Main - " . $orgname;
                                    } else {
                                        $orgname = "Side - " . $orgname;
                                    }
                            ?>
                                    <option value="<?= $rowOrgs['ORG_ID'] . "::" . $rowOrgs['ORG_TYPE_ID'] ?>"><?= $orgname ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
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
                        <label class="form-label" for="STARTDATE">Candidates</label>
                        <div class="row align-items-center mb-2 m-0">
                            <input class="form-control col mr-2" type="text" name="searchtext" id="searchtext" placeholder="Search Names...">
                            <button type="button" class="btn btn-primary col-2" id="searchbtn"><i class="bi bi-search"></i> <span id="btntitle"> Search</span></button>
                        </div>
                        <div id="selections">
                            <select class="list-group m-0 w-100" id="listselections" size="6">
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <table id="candidatestable" class="table table-bordered">
                            <thead class="thead-light">
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-row justify-content-center w-100 mt-5 mb-2">
                        <button type="submit" name="create-election" class="btn btn-primary col-6 col-md-5" id="create-election">Create Election</button>
                    </div>

                </form>
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
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- Sidebar collapse -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- Waves CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
        Waves.attach('#sidebar ul li a');
        Waves.init();
    </script>
    <script>
        function deleteCandidate(id) {
            $('#can-' + id).remove();
        }

        $(document).on('click', '#searchbtn', function() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            const query = $('#searchtext').val();
            const orgid = $('#ORG').val();
            const type = urlParams.get('type');
            $.ajax({
                url: "include/admin-search-name.php",
                method: "POST",
                data: {
                    type: type,
                    query: query,
                    orgid: orgid,
                },
                dataType: "json",
                success: function(data) {
                    if (data == null) {
                        alert('Result is empty');
                    } else {
                        var options = "";
                        $.each(data, function(i, item) {
                            name = item.fname + " " + item.mname + " " + item.lname;
                            options = options + '<option class="list-group-item list-group-item-action" value="' + item.id + '">' + name + ' (' + item.section + ')</option>\n';
                        });

                        $('#listselections').html(options);
                    }
                }
            });
        });

        $(document).on('dblclick', '#listselections', function() {

            if ($('#listselections').val() != null) {
                selectedval = $('#listselections').val();
                if ($("#candidatestable tr[id='can-" + selectedval + "']").length <= 0) {
                    selectedtext = $("#listselections option[value='" + selectedval + "']").text();

                    selector_options = '<option value="-1">-- Select Position --</option>';

                    $.ajax({
                        url: "include/admin-fetch-positions.php",
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data == null) {
                                alert('Result is empty');
                            } else {
                                var options = "";
                                $.each(data, function(i, item) {
                                    selector_options += '<option value="' + item.id + '">' + item.position + '</option>\n';
                                });

                                delBtn = '<a class="align-middle text-white btn btn-danger" onclick="deleteCandidate(\'' + selectedval + '\')">Delete Candidate</a>';
                                selector = '<select class="form-select" name="pos-' + selectedval + '">' + selector_options + '</select>';

                                output = '<tr id="can-' + selectedval + '"><td class="align-middle">' + selectedtext + '</td>\n<td>' + selector + '</td>\n<td>' + delBtn + '</td>\n</tr>';

                                $('#candidatestable tr:last').after(output);
                            }
                        }
                    })
                }
            }
        });
    </script>

    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
</body>

</html>