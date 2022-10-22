<?php
ob_start();
session_start();
$officer_id = $_SESSION['use'];
$orgid = $_SESSION['org'];
include('../mysql_connect.php'); include('profilepic.php'); include('../assets/img/orglogopics.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
  else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../../officer-login.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico"/>
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />


<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">


<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="officer-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal Officer</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="officer-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li class="active">
          <a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="officer-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <li>
          <a href="election-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
      <!--    <a href="msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>-->

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

      <nav class="navbar navbar-expand navbar-light shadow" aria-label="navbar" id="topbar">
        <div class="container-fluid">
          <button type="btn btn-light d-inline-block d-lg-none ml-auto" id="sidebarCollapse" class="btn btn-info navbar-toggle" data-toggle="collapse" data-target="#sidebar">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="#navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_Officers WHERE officer_ID = '$officer_id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="officer-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../officer-login.php">Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="officer-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> Organizations</a></li>
          <li class="breadcrumb-item"><a href="rso.php"> <i class="bi bi-people-fill"></i><?php $query = "SELECT * FROM tb_orgs WHERE ORG_ID = '$orgid'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[1]"; }?></a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> Members</li>
        </ol>
      </nav>
      <!-- Page content -->

      <div class="row ms-3 me-3 mt-2 mb-2">
        <div class="col-lg-6 col-7">
          <h4 id="orgtitle">JRU Computer Society Officers</h4>
        </div>
      </div>

        <div class="card shadow card-registration mb-4 mt-3" style="border-radius: 15px;">
          <div class="card-body px-2 mx-3 py-3 pt-4 ">
                <div class="row g-0 justify-content-center ">
        <div class="table-responsive ms-2">
            <?php
                    $query = "SELECT * FROM tb_officers WHERE ORG_ID = '$orgid'";
                    $result = @mysqli_query($conn,$query);
                    $i = 0;
                    $fn = " ";
                    $md = " ";
                    $ln = " ";
                    $a = " ";
                    $g = " ";
                    $yl = " ";
                    $cd = " ";
                    $c = " ";
                    $se = " ";
                    $e = " ";
                    $ac = " ";
                    $pi = " ";
                    $oi = " ";
                    echo "<table id='admin-user-table' class='py-3 display nowrap w-100 ms-0 stud'>
                          <thead>
                            <tr>
                                <th class='desktop'>Student ID</th>
                                <th class='desktop'>First Name</th>
                                <th class='desktop'>Middle Name</th>
                                <th class='desktop'>Last name</th>
                                <th class='desktop'>Age</th>
                                <th class='desktop'>Gender</th>
                                <th class='desktop'>Actions</th>
                                <th class='none'>College</th>
                                <th class='none'>Course</th>
                                <th class='none'>Organization</th>
                                <th class='none'>Position</th>
                                <th class='none'>Email</th>
                                <th class='none'>Birthdate</th>
                                <th class='none'>Year Level</th>
                                <th class='none'>Section</th>
                                <th class='none'>Account Created</th>
                          </tr>
                        </thead>
                        <tbody>
                      ";
                      /*
                      <th>College</th>
                      <th>Organization</th>
                      <th>Position</th>
                      <th>Account Created</th>
                      */
                  if ($result !== false && $result->num_rows > 0)
                  {
                      // output data of each row
                      while($row = $result->fetch_assoc())
                      {
                        $si = $row['student_id'];
                        $fn = $row['first_name'];
                        $mn = $row['middle_initial'];
                        $ln = $row['last_name'];
                        $a = $row['age'];
                        $g = $row['gender'];
                        $e = $row['email'];
                        $bd = $row['birthdate'];
                        $yl = $row['year_level'];
                        $se = $row['section'];
                        $c = $row['course'];
                        $cd = $row['college_dept'];
                        $oi = $row['org_id'];
                        $ac = $row['account_created'];
                        $pi = $row['position_id'];
                        echo "<tr>
                              <td> $si  </td>
                              <td> $fn  </td>
                              <td> $mn  </td>
                              <td> $ln  </td>
                              <td> $a </td>
                              <td> $g</td>
                              <td>
                              <button type='button' class='btn btn-success btn-sm viewbtn' id='" . $si . "'> <i class='bi bi-list-ul'></i> </button>

                              </td>
                              <td> $cd</td>
                              <td> $c</td>
                              <td> $oi</td>
                              <td> $pi</td>
                              <td> $e </td>
                              <td> $bd  </td>
                              <td> $yl </td>
                              <td> $se</td>
                              <td> $ac</td>
                              </tr>
                          ";
                          /*
                          <td>College</td>
                          <td>Organization</td>
                          <td>Position</td>
                          <th>Account Created</th>
                        */
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

<!-- Officer Modal -->
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
                       <div class="col-4 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="student_id" >Student ID:</label>
                           <input type="text" name="student_id" id="student_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4">
                       <div class="form-outline">
                         <label class="form-label" for="account_created" >Account Created:</label>
                         <input type="text" name="account_created" id="account_created" class="form-control" style="background-color: #fff;" readonly />
                       </div>
                     </div>
                       </div>
                        <div class="row justify-content-between">
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
                            <select class="form-select" name="org_id" id="org_id" >
                              <?php
                              $query = "SELECT ORG_ID, ORG FROM tb_orgs";
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
                              <input type="text" name="first_name" id="first_name" class="form-control" style="background-color: #fff;" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" required />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="middle_initial" >Middle Name:</label>
                              <input type="text" class="form-control" name="middle_initial" id="middle_initial" style="background-color: #fff;"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" />
                            </div>
                          </div>
                          <div class="col-6 col-md-4 mb-4 ">
                            <label class="form-label" for="last_name">Last name </label>
                            <input type="text" class="form-control" name="last_name" id="last_name" style="background-color: #fff;"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" required/>
                          </div>
                        </div>

                        <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="birthdate" >Birthdate:</label>
                              <input id="birthdate" class="form-control birthdate" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old"  required/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="age" >Age:</label>
                              <input type="number" class="form-control age" name="age" id="age" maxlength="2" max="99" min="18" style="background-color: #fff;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="display:none;" required/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="gender" >Gender</label>
                              <select class="form-select" name="gender" id="gender">
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                              </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="email" >Email:</label>
                            <input type="text" name="email" id="email" class="form-control" style="background-color: #fff;"  pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30" required />
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="college_dept" >College:</label>
                              <select class="form-select" name="college_dept" id="college_dept" >
                                <?php
                                    $query = "SELECT college_id, college FROM tb_collegedept";
                                    $result = @mysqli_query($conn, $query);
                                    while($data = @mysqli_fetch_array($result)) {
                                        echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                    }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <div class="form-outline">
                              <label class="form-label" for="course" >Course:</label>
                              <select class="form-select" style="width:100%;" name="course" id="course" >
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
                        <div class="row">
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="user_type" >User Type:</label>
                              <select class="form-select" name="user_type" id="user_type">
                                <?php
                                  $query = "SELECT * FROM tb_usertypes";
                                  $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[0].'">'.$data[1].'</option>';
                                      }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="section">Section:</label>
                              <input type="text" name="section" id="section" class="form-control" maxlength="4" style="background-color: #fff;" required />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="year_level" >Year Level:</label>
                                <select class="form-select" name="year_level" id="year_level">
                                  <option value="1">Year 1</option>
                                  <option value="2">Year 2</option>
                                  <option value="3">Year 3</option>
                                  <option value="4">Year 4</option>
                                </select>
                            </div>
                            </div>
                          </div>
                          <input type="hidden" name="profile_pic" id="profile_pic" class="form-control" readonly/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
  </div>

        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header py-3 px-3">
                      <h5 class="modal-title" id="exampleModalLabel"> Archive Student Data </h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="admin-delete-user.php" method="POST">
                      <div class="modal-body">
                        <div class="col-12 col-md-12 justify-content-center ">
                          <div class="form-outline">
                             <label class="form-label" for="delete_id" >Student ID:</label>
                             <input type="text" name="delete_id" id="delete_id" class="form-control" style="background-color: #fff;" readonly/>
                           </div>
                         </div>
                          <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> Archiving user data. Are you sure?</p>
                      </div>
                      <div class="modal-footer py-2 px-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" name="deletedata" class="btn btn-info">Yes</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

      <script>
          $(document).on('click', '.viewbtn', function(){
             var student_id = $(this).attr("id");
             $.ajax({
                  url:"rso-fetch-officer.php",
                  method:"POST",
                  data:
                  {
                    student_id:student_id
                  },
                  dataType:"json",
                  success:function(data){
                  console.log(data);
                  $('#officer_id').val(data.officer_id);
                  $('#student_id').val(data.student_id);
                  $('#position_id').val(data.position_id);
                  $('#org_id').val(data.org_id);
                  $('#first_name').val(data.first_name);
                  $('#middle_initial').val(data.middle_initial);
                  $('#last_name').val(data.last_name);
                  $('#birthdate').val(data.birthdate);
                  $('#age').val(data.age);
                  $('#gender').val(data.gender);
                  $('#year_level').val(data.year_level);
                  $('#section').val(data.section);
                  $('#email').val(data.email);
                  $('#password').val(data.password);
                  $('#college_dept').val(data.college_dept);
                  $('#course').val(data.course);
                  $('#user_type').val(data.user_type);
                  $('#account_created').val(data.account_created);
                  $('#profile_pic').val(data.profile_pic);
                  $('#viewmodal').modal('show');
                  $('#modal-lg').css('max-width','70%');
                    }
              });

              // UPPERCASE FIRST LETTER
              document.getElementById("FIRST_NAME").addEventListener("input", forceLower);
              document.getElementById("MIDDLE_NAME").addEventListener("input", forceLower);
              document.getElementById("LAST_NAME").addEventListener("input", forceLower);
              // Event handling functions are automatically passed a reference to the
              // event that triggered them as the first argument (evt)
              function forceLower(evt) {
                // Get an array of desktop the words (in desktop lower case)
                var words = evt.target.value.toLowerCase().split(/\s+/g);

                // Loop through the array and replace the first letter with a cap
                var newWords = words.map(function(element) {
                  // As long as we're not dealing with an empty array element, return the first letter
                  // of the word, converted to upper case and add the rest of the letters from this word.
                  // Return the final word to a new array
                  return element !== "" ? element[0].toUpperCase() + element.substr(1, element.length) : "";
                });

                // Replace the original value with the updated array of capitalized words.
                evt.target.value = newWords.join(" ");
              }


          });
      </script>

      <script>
        $(document).on('click', '.deletebtn', function(){
          var STUDENT_ID = $(this).attr("id");
          $.ajax({
                  url:"rso-fetch-user.php",
                  method:"POST",
                  data:
                  {
                    STUDENT_ID:STUDENT_ID
                  },
                  dataType:"json",
                  success:function(data){
                  console.log(data);
                  $('#delete_id').val(data.STUDENT_ID);
                  $('#deletemodal').modal('show');
                  }
              });
          });
      </script>
    <?php @mysqli_close($conn); ?>
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
          { "width": "40px" },
          { "width": "40px" },
          { "width": "130px" },
          { "width": "130px" },
          { "width": "130px" },
          { "width": "80px" },
          { "width": "150px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" },
          { "width": "60px" }
    ],
              select: 'single',
      buttons: [
     'pageLength',
     {
       extend: 'excelHtml5',
       title: 'JRU Computer Society Members Masterlist',
       footer: true,
     exportOptions: {
       columns: [0,1,2,3,4,6,7,8,9,10,11]
     },
     } ,
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
          title: 'JRU Computer Society Members Masterlist',
          footer: true,
          exportOptions: {
            columns: [0,1,2,3,4,5,7,8,9,10,11]
        },
        orientation : 'landscape',
      pageSize : 'LEGAL', // You can also use "A1","A2" or "A3", most of the time "A3" works the best.
        } ,
        {
          extend: 'print',
          title: 'JRU Computer Society Members Masterlist',
          footer: true,
          exportOptions: {
            columns: [0,1,2,3,4,5,7,8,9,10,11]
        },
        customize: function(win)
        {

            var last = null;
            var current = null;
            var bod = [];

            var css = '@page { size: landscape; font-size: 1em;}',
                head = win.document.head || win.document.getElementsByTagName('head')[0],
                style = win.document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet)
            {
              style.styleSheet.cssText = css;
            }
            else
            {
              style.appendChild(win.document.createTextNode(css));
            }

            head.appendChild(style);
     }
     },
      ]
     });
     myTable.columns.adjust().draw();
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
      <!-- <script src="js/form-validation.js"></script>
    Prevent Cut Copy Paste -->
      <script>
        $(document).ready(function() {
          $('input:text').bind('cut copy paste', function(e) {
            e.preventDefault();
            return false;
          });

        });
      </script>

      <!--input mask-->
      <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
      <script src="../assets/js/inputmask-validation.js"></script>

      <!--password validation!-->
      <script src="../assets/js/pass-validation.js"></script>

      <!-- age validation !-->
      <script src="../assets/js/age-validation.js"></script>

    </body>

</html>