<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
include('profilepic.php');
if (isset($_SESSION['msg'])) {
    print_r($_SESSION['msg']); #display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if (!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
{
    header("Location:index.php");
}

$data_electionid = $_GET['election_id'] ?? -1;
if ($data_electionid == -1) header('location:admin-election.php');

// Save Election
if (isset($_POST['save-election'])) {
    // Get General Information
    $orgid = $_POST['ORG'];
    $title = $_POST['TITLE'];
    $description = $_POST['DESC'];
    $startdate = $_POST['STARTDATE'];
    $enddate = $_POST['ENDDATE'];

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
        "SELECT COUNT(*) As total_records FROM `tb_elections` WHERE ELECTION_ID<>$data_electionid AND ORG_ID='$orgid' AND (('$startdate'>=START_DATE AND '$startdate'<=END_DATE) 
        OR ('$enddate'>=START_DATE AND '$enddate'<=END_DATE)
        OR (START_DATE>='$startdate' AND START_DATE<='$enddate')
        OR (END_DATE>='$startdate' AND END_DATE<='$enddate'))"
    );
    $total_records = @mysqli_fetch_array($sqlCheckDate);
    $total_records = $total_records['total_records'];

    if ($total_records > 0) {
        echo "<script>alert('Election with the same organization and date range already exist. Please try again.')</script>";
    } else if (count($candidates) > 0) {
        // Update General Information
        $sqlGeneral = "UPDATE `tb_elections` SET TITLE='$title',DESCRIPTION='$description',START_DATE='$startdate',END_DATE='$enddate' WHERE ELECTION_ID = $data_electionid";

        if (@mysqli_query($conn, $sqlGeneral)) {
            $sqlDelete = "DELETE FROM tb_candidate WHERE ELECTION_ID='$data_electionid'";
            if (@mysqli_query($conn, $sqlDelete)) {
                $sqlCandidates = "INSERT INTO `tb_candidate`(ELECTION_ID,POSITION_ID,STUDENT_NO) VALUES ";

                $values = [];
                foreach ($candidates as $studentno => $position) {
                    array_push($values, "('$data_electionid','$position','$studentno')");
                }

                $sqlCandidates .= implode(',', $values);

                if (@mysqli_query($conn, $sqlCandidates)) {
                    // Successfully created
                    echo "<script>alert('Successfully Saved!')</script>";
                } else {
                    echo "<script>alert('Error while saving the candidates information. Please try again.')</script>";
                }
            } else {
                echo "<script>alert('Error while parsing the candidates information. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Error while saving the election information. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('No Candidates were selected. Please try again.')</script>";
    }
}


$sql = "SELECT * FROM `tb_elections` WHERE ELECTION_ID='$data_electionid'";
if ($res = @mysqli_query($conn, $sql)) {
    $row = $res->fetch_assoc();
    $data_type = $row['ELECTION_TYPE'];
    $data_orgid = $row['ORG_ID'];
    $data_title = $row['TITLE'];
    $data_desc = $row['DESCRIPTION'];
    $data_startdate = $row['START_DATE'];
    $data_enddate = $row['END_DATE'];
}

$org_name = "";
if ($data_type == 1) {
    $org_name = "JRU Student Organization Council";
} else if ($data_type == 2) {
    $sql = "SELECT MOTHER_ORG FROM `tb_morg` WHERE MORG_ID='$data_orgid'";
    if ($res = @mysqli_query($conn, $sql)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $org_name = $row['MOTHER_ORG'];
        }
    }
} else if ($data_type == 3) {
    $sql = "SELECT ORG FROM `tb_orgs` WHERE ORG_ID='$data_orgid'";
    if ($res = @mysqli_query($conn, $sql)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $org_name = $row['ORG'];
        }
    }
}

$positions = [];

$sql = "SELECT POSITION_ID as id,position FROM tb_position";
if ($res = @mysqli_query($conn, $sql)) {
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $positions[$row['id']] = $row['position'];
        }
    }
}

$enable_edit = false;

if ($data_startdate > date('Y-m-d') && $data_enddate > date('Y-m-d')) {
    $enable_edit = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <nav id="sidebar">

            <div class="sidebar-header text-center">
                <a class="navbar-brand" href="admin-index.php">
                    <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
                </a>
            </div>
            <div class="sidebar-heading mt-3 text-center">

                <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
            </div>

            <ul class="list-unstyled components p-2">

                <li>
                    <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
                        </li>
                        <li>
                            <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
                        </li>
                        <li>
                            <a href="admin-signatories.php"><i class="bi bi-person-check-fill"></i> <span>Signatories</span></a>
                        </li>
                        <li>
                            <a href="admin-administrators.php"><i class="ri-user-2-fill"></i> <span>Admin</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#orgsSubmenu" data-bs-toggle="collapse" href="#orgsSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-diagram-3-fill"></i> <span>Orgs Management</span></a>
                    <ul class="collapse list-unstyled" id="orgsSubmenu">
                        <li>
                            <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
                        </li>
                        <li>
                            <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
                        </li>
                        <li>
                            <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
                </li>
                <li>
                    <a href="admin-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
                </li>
                <li class="d-lg-none">
                    <!--  <a href="admin-msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->

                </li>
            </ul>
            <!-- nav footer?
      <ul class="list-unstyled CTAs">
        <li>
          <a>about</a>
        </li>
        <li>
          <a>logout</a>
        </li>
      </ul> -->
        </nav>
        <!-- Navbar  -->
        <div id="content">

            <nav class="navbar shadow navbar-expand navbar-light bg-light" aria-label="navbar" id="topbar">
                <div class="container-fluid">
                    <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="#navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                                    <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
                                                                            $result = @mysqli_query($conn, $query);
                                                                            $row = mysqli_fetch_array($result);
                                                                            if ($row) {
                                                                                echo "$row[0]";
                                                                            } ?></span></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="admin-profile.php">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="index.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="admin-election.php"><i class="bi bi-check2-square"></i> Election</a></li>
                    <li class="breadcrumb-item"><a href="admin-election-list.php"><i class="bi bi-clipboard-data-fill"></i> Election List</a></li>
                    <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-list-ul"></i> <?= $data_title ?></li>
                </ol>
            </nav>

            <!-- Page content -->
            <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
                <form method="POST" action="" class="card-body px-2 mx-3 py-3 pt-4 ">
                    <div class="mb-4">
                        <label class="form-label" for="ORGNAME"><?php
                                                                if ($data_type == 3) {
                                                                    echo "Side Organization";
                                                                } else if ($data_type == 2) {
                                                                    echo "Mother Organization";
                                                                } else {
                                                                    echo "Organization";
                                                                }
                                                                ?></label>
                        <input class="form-control" type="text" name="ORGNAME" id="ORGNAME" value="<?= $org_name ?>" readonly>
                        <input type="text" name="ORG" id="ORG" value="<?= $data_orgid ?>" style="display: none;">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="TITLE">Title</label>
                        <input class="form-control" type="text" name="TITLE" id="TITLE" value="<?= $data_title ?>" <?= $enable_edit ? "" : "readonly" ?>>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="DESC">Description</label>
                        <textarea class="form-control" name="DESC" id="DESC" rows="6" <?= $enable_edit ? "" : "readonly" ?>><?= $data_desc ?></textarea>
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label class="form-label" for="STARTDATE">Start Date</label>
                            <input class="form-control" type="date" name="STARTDATE" id="STARTDATE" value="<?= $data_startdate ?>" <?= $enable_edit ? "" : "readonly" ?>>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ENDDATE">End Date</label>
                            <input class="form-control" type="date" name="ENDDATE" id="ENDDATE" value="<?= $data_enddate ?>" <?= $enable_edit ? "" : "readonly" ?>>
                        </div>
                    </div>
                    <div class="mb-4 row" style="<?= $enable_edit ? "" : "display: none;" ?>">
                        <label class="form-label" for="STARTDATE">Candidates</label>
                        <div class="row align-items-center mb-2 m-0">
                            <input class="form-control col mr-2" type="text" name="searchtext" id="searchtext" placeholder="Search Names...">
                            <button type="button" class="btn btn-primary col-2" id="searchbtn">Search</button>
                        </div>
                        <div id="selections">
                            <select class="form-select m-0" id="listselections" size="10">
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <table id="candidatestable" class="table table-bordered">
                            <thead class="thead-light">
                                <th>Name</th>
                                <th>Position</th>
                                <th style="<?= $enable_edit ? "" : "display: none;" ?>">Action</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($data_type == 1) {
                                    $sql = "SELECT tb_candidate.*,tb_officers.LAST_NAME,tb_officers.FIRST_NAME,tb_officers.MIDDLE_INITIAL as MIDDLE_NAME FROM `tb_candidate` LEFT JOIN `tb_officers` ON tb_candidate.STUDENT_NO=tb_officers.STUDENT_ID WHERE ELECTION_ID='$data_electionid'";
                                } else {
                                    $sql = "SELECT tb_candidate.*,tb_students.LAST_NAME,tb_students.FIRST_NAME,tb_students.MIDDLE_NAME FROM `tb_candidate` LEFT JOIN `tb_students` ON tb_candidate.STUDENT_NO=tb_students.STUDENT_ID WHERE ELECTION_ID='$data_electionid'";
                                }
                                if ($res = @mysqli_query($conn, $sql)) {
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            $fullname = $row['FIRST_NAME'] . " " . $row['MIDDLE_NAME'] . " " . $row['LAST_NAME'];
                                ?>
                                            <tr id="can-<?= $row['STUDENT_NO'] ?>">
                                                <td class="align-middle"><?= $fullname ?></td>
                                                <td>
                                                    <select class="form-select" name="pos-<?= $row['STUDENT_NO'] ?>" <?= $enable_edit ? "" : "readonly" ?>>
                                                        <option value="-1">-- Select Position --</option>
                                                        <?php
                                                        foreach ($positions as $key  => $value) {
                                                        ?>
                                                            <option value="<?= $key ?>" <?= $row['POSITION_ID'] == $key ? "selected" : "" ?>><?= $value ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td style="<?= $enable_edit ? "" : "display: none;" ?>">
                                                    <a class="align-middle text-white btn btn-danger" onclick="deleteCandidate('<?= $row['STUDENT_NO'] ?>')">Delete Candidate</a>
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

                    <div class="d-flex flex-row justify-content-center w-100 mt-5">
                        <button type="submit" name="save-election" class="btn btn-primary col-3" id="save-election" style="<?= $enable_edit ? "" : "display: none;" ?>">Save Changes</button>
                        <h4 class="mb-3" style="<?= $enable_edit ? "display: none;" : "" ?>">You cannot edit an ongoing or completed election.</h4>
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
            var query = $('#searchtext').val();
            var orgid = $('#ORG').val();
            $.ajax({
                url: "include/admin-search-name.php",
                method: "POST",
                data: {
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
                            options = options + '<option value="' + item.id + '">' + name + ' (' + item.section + ')</option>\n';
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