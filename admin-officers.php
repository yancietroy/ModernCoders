<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:admin-login.php");
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
  <link rel="stylesheet" href="assets/css/style.css">

<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

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
          <img src="assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 p-0 ">JRU Student Organizations Portal Administrator</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
      <li class="active">
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="admin-users.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li  class="active">
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
                <a href="admin-users.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
            </li>
            <li>
                <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
            </li>
            <li>
                <a href="#"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="admin-users.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="#"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="#"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>
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
                  <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell me-lg-2 mt-2" style="width:  25px; height:  25px;"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle me-lg-2" src="assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#!">Profile</a></li>
                  <li><a class="dropdown-item" href="#!">Settings</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="#!">About</a></li>
                  <li><a class="dropdown-item" href="admin-login.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
              <li class="breadcrumb-item">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Officers</li>
        </ol>
      </nav>

      <!-- Page content -->

      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h4>Officer User Management</h4>
        </div>

      </div>

        <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
          <div class="card-body px-2 mx-3 py-3 pt-4 ">
                <div class="row g-0 justify-content-center ">
        <div class="table-responsive ms-2">
            <?php
                    $query = "SELECT tb_officers.officer_id, tb_officers.first_name, tb_officers.middle_initial, tb_officers.last_name, tb_officers.email, tb_officers.course, tb_officers.section, tb_position.position, tb_orgs.ORG FROM tb_officers JOIN tb_position ON tb_officers.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers.org_id";
                    $result = @mysqli_query($conn,$query);
                    $i = 0;
                    $oi = " ";
                    $p = " ";
                    $org = " ";
                    $fn = " ";
                    $mn = " ";
                    $ln = " ";
                    $e = " ";
                    $c = " ";
                    echo "<table id='admin-user-table' class=' display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th>Officer ID</th>
                                <th>Position</th>
                                <th>Organization</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
                  if ($result !== false && $result->num_rows > 0)
                  {
                      // output data of each row
                      while($row = $result->fetch_assoc())
                      {
                        $oi = $row['officer_id'];
                        $p = $row['position'];
                        $org = $row['ORG'];
                        $fn = $row['first_name'];
                        $mn = $row['middle_initial'];
                        $ln = $row['last_name'];
                        $e = $row['email'];
                        $c = $row['course'];

                        echo "<tr>
                              <td> $oi  </td>
                              <td> $p  </td>
                              <td> $org  </td>
                              <td> $fn  </td>
                              <td> $mn </td>
                              <td> $ln </td>
                              <td> $e </td>
                              <td> $c </td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $oi . "'> <i class='bi bi-list-ul'></i> </button>
                              <button type='button' class='btn btn-danger btn-sm deletebtn' id='" . $oi . "'>  <i class='bi bi-trash-fill'></i> </button>
                              </td>
                              </tr>
                          ";
                      }
                  echo "</tbody>
                        </table>";
                  }
                    //$conn->close();
                  ?>

         </div>
       </div>
     </div>
   </div>


     </div>
        <!--   <div class="col">
        Card with right text alignment
          <div class="card text-end">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some dummy text to make up the card's content. You can replace it anytime.</p>
              <a href="#" class="btn btn-primary">Know more</a>
            </div>
          </div>
        </div>
      </div> -->

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
  <!-- Student Modal -->
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Officer Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="admin-update-officer.php" method="POST">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row justify-content-between">
                       <div class="col-4 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="officer_id" >Officer ID:</label>
                           <input type="text" name="officer_id" id="officer_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4">
                       <div class="form-outline">
                         <label class="form-label" for="date_submitted" >Account Created:</label>
                         <input type="text" name="date_submitted" id="date_submitted" class="form-control" style="background-color: #fff;" readonly />
                       </div>
                     </div>
                       </div>
                        <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="position_id" >Position:</label>
                            <select class="form-select" name="position_id" id="position_id">
                            <?php
                              $query = "SELECT position_id, position FROM tb_position";
                              $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                      }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="org_id" >Organization:</label>
                            <select class="form-select" name="org_id" id="org_id">
                            <?php
                              $query = "SELECT org_id, org FROM tb_orgs";
                              $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                      }
                            ?>
                            </select>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="first_name" >First Name:</label>
                              <input type="text" name="first_name" id="first_name" class="form-control" style="background-color: #fff;"  />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="middle_initial" >Middle Name:</label>
                              <input type="text" class="form-control" name="middle_initial" id="middle_initial" style="background-color: #fff;"  />
                            </div>
                          </div>
                          <div class="col-6 col-md-4 mb-4 ">
                            <label class="mb-3 me-5 min-vw-100" for="last_name">Last name </label>
                            <input type="text" class="form-control" name="last_name" id="last_name" style="background-color: #fff;"  />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="email" >Email:</label>
                            <input type="text" name="email" id="email" class="form-control" style="background-color: #fff;"  />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="course" >Course:</label>
                              <select class="form-select" style="width:100%;" name="course" id="course">
                                <?php
                                  $query = "SELECT course_id, course FROM tb_course";
                                  $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[1].'">'.$data[1].'</option>';
                                      }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
                    </div>
                 </form>
            </div>
        </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        $(document).on('click', '.viewbtn', function(){
           var officer_id = $(this).attr("id");
           $.ajax({
                url:"admin-fetch-officer.php",
                method:"POST",
                data:{officer_id:officer_id},
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#officer_id').val(data.officer_id);
                $('#position_id').val(data.position_id);
                $('#org_id').val(data.org_id);
                $('#first_name').val(data.first_name);
                $('#middle_initial').val(data.middle_initial);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#course').val(data.course);
                $('#viewmodal').modal('show');
                $('#modal-lg').css('max-width','70%');
                }
            });
        });
    </script>
<?php $conn->close(); ?>
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
    <!-- Datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
   <script>
    $(document).ready(function() {
        $('#admin-user-table').DataTable( {
          responsive: true,
          keys: true,
          fixedheader:true,
          bautoWidth:false,
         dom: 'Bfrtip',"bFilter": true,
         "columns": [
        { "width": "90px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "130px" },
        { "width": "80px" },
        { "width": "150px" },
        { "width": "60px" },
        { "width": "60px" },
        { "width": "70px" }
  ],
            select: 'single',
    buttons: [
   'pageLength',
      {
        extend: 'csvHtml5',
        title: 'JRU Organizations Portal Student Users'
      },
      {
        extend: 'pdfHtml5',
        title: 'JRU Organizations Portal Student Users'
      },
      {
        extend: 'print',
        title: 'JRU Organizations Portal Student Users'
      },
    ]
  });
    });
    </script>
  <script src="assets/js/age-validation.js"></script>
</body>

</html>
