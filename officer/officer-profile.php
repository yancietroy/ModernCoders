<?php
ob_start();
session_start();
$officer_id = $_SESSION['use'];
$orgid = $_SESSION['org'];
include('../mysql_connect.php'); include('profilepic.php'); include('../assets/img/orglogopics.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:login.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Datepicker CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
  <!-- Datatable BS5
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
  --><!-- Icons -->
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

      <div class="sidebar-header text-center justify-content-center align-items-center">
        <a class="navbar-brand" href="officer-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90px" height="90px">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 d-none d-sm-block ">JRU Student Organizations Portal Officer</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li class="active">
          <a href="officer-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

          <li>
            <a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
          </li>
          <li>
            <a href="officer-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
          </li>
          <li>
            <a href="election-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
          </li>
          <li>
            <a href="officer-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
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
      <!-- Officer Profile -->
    <h3 class="ms-3">Officer Profile</h3>
      <div class="student-profile py-4 px-5">
        <div class="container-lg">
          <div class="row">
            <div class="col-lg-4 mb-4 col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center">
                  <div class="container">
                        <img class="profile_img" src="<?php echo $profilepic; ?>"  id="profile-pic" alt="">
                      <div class="middle">
                        <div class="upload-button"><i class="bi bi-pencil-square"></i></div>
                          <input class="file-upload" type="file" name=profilePic id=profilePic accept="image/*"/>
                      </div>
                    </div>
                  <h3 class="pt-3"><?php echo "$row[0]"; ?></h3>
                </div>
                <?php $query = "SELECT * FROM `tb_officers` WHERE officer_id = '$officer_id'";
                  $result = @mysqli_query($conn, $query);
                  $data = @mysqli_fetch_array ($result);
                  $si = $data['student_id'];?>
                <div class="card-body">
                  <p class="mb-0"><strong class="pr-1">Student ID:</strong><?php echo $si; ?></p>
                  <p class="mb-0"><strong class="pr-1">Year Level:</strong><?php echo $data['year_level']; ?></p>
                  <p class="mb-0"><strong class="pr-1">Section:</strong><?php echo $data['section']; ?></p>
                  <!--<p class="mb-0"><strong class="pr-1">Academic Year:</strong></p>-->
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-12 ">
              <div class="card shadow-sm" id="card-large">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 pt-2"><i class="far fa-clone pr-1"></i>Student Information</h3>
                </div>
                <div class="card-body mt-2 pt-0">
                  <table class="table table-bordered" id="proftable">

                    <tr>
                      <th width="30%">Gender</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['gender']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Birthdate</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['birthdate']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Age</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['age']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Email</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">College	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_officers.college_dept, tb_collegedept.college FROM tb_officers INNER JOIN tb_collegedept ON tb_officers.college_dept=tb_collegedept.college_id WHERE tb_officers.officer_id = '$officer_id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Course	</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['course']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Organization	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_officers.org_id, tb_orgs.ORG FROM tb_officers INNER JOIN tb_orgs ON tb_officers.org_id=tb_orgs.ORG_ID WHERE tb_officers.officer_id = '$officer_id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[ORG]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Role	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_officers.user_type, tb_usertypes.user_type FROM tb_officers INNER JOIN tb_usertypes ON tb_officers.user_type=tb_usertypes.usertype_id WHERE tb_officers.officer_id = '$officer_id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[user_type]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Position	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_officers.position_id, tb_position.position FROM tb_officers INNER JOIN tb_position ON tb_officers.position_id=tb_position.POSITION_ID WHERE tb_officers.officer_id = '$officer_id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[position]"; } ?>
                    </td>
                    </tr>
                  </table>
                  <div class="card-body mt-2 p-0 w-100 pt-0" id="card-show">
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Gender:<br></strong> <?php echo "$data[gender]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Birthdate:<br></strong><?php echo "$data[birthdate]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Age:<br></strong><?php echo "$data[age]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Email:<br></strong><?php echo "$data[email]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">College:<br></strong><?php $query = "SELECT tb_officers.college_dept, tb_collegedept.college FROM tb_officers INNER JOIN tb_collegedept ON tb_officers.college_dept=tb_collegedept.college_id WHERE tb_officers.officer_id = '$officer_id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></p>
                                  <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Course:<br></strong><?php echo "$data[course]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Main Organization:<br></strong><?php $query = "SELECT tb_officers.college_dept, tb_collegedept.college FROM tb_officers INNER JOIN tb_collegedept ON tb_officers.college_dept=tb_collegedept.college_id WHERE tb_officers.officer_id = '$officer_id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></p>
                              <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Role:<br></strong><?php $query = "SELECT tb_officers.user_type, tb_usertypes.user_type FROM tb_officers INNER JOIN tb_usertypes ON tb_officers.user_type=tb_usertypes.usertype_id WHERE tb_officers.officer_id = '$officer_id'";
                                        $result = @mysqli_query($conn, $query);
                                        $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[user_type]"; } ?></p>

                                        <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Side Organization:</strong>
                                                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Role:</strong></p>
                            </div>
                  <div class="d-grid gap-2 pb-0 mb-0 d-md-flex justify-content-end">
                    <?php echo "<button type='button' class='btn btn-primary btn-sm viewbtn' id='" . $officer_id . "' >Edit Profile</button>";?>
                    <?php echo "<button type='button' class='btn btn-primary btn-sm passbtn' id='" . $officer_id . "' >Change Password</button>";?>
                  </div>
                </div>

              </div>
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
                <form action="officer-update-profile.php" method="POST">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row justify-content-between">
                       <div class="col-12 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="officer_id" >Officer ID:</label>
                           <input type="text" name="officer_id" id="officer_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-12 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="student_id" >Student ID:</label>
                           <input type="text" name="student_id" id="student_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-12 col-md-3 mb-4">
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
                            <select class="form-select" name="position_id" id="position_id" readonly>
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
                            <select class="form-select" name="org_id" id="org_id" readonly>
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
                              <input type="text" name="first_name" id="first_name" class="form-control" style="background-color: #fff;" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20"  />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="middle_initial" >Middle Name:</label>
                              <input type="text" class="form-control" name="middle_initial" id="middle_initial" style="background-color: #fff;"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4 ">
                            <label class="form-label" for="last_name">Last name </label>
                            <input type="text" class="form-control" name="last_name" id="last_name" style="background-color: #fff;"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="email" >Email:</label>
                            <input type="text" name="email" id="email" class="form-control" style="background-color: #fff;"  pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30"  />
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="college_dept" >College:</label>
                              <select class="form-select" name="college_dept" id="college_dept" readonly>
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
                              <select class="form-select" style="width:100%;" name="course" id="course" readonly>
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
                              <select class="form-select" name="user_type" id="user_type" readonly>
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
                              <input type="text" name="section" id="section" class="form-control" maxlength="4" style="background-color: #fff;"  readonly/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="year_level" >Year Level:</label>
                              <select class="form-select" name="year_level" id="year_level" readonly>
                                <option value="1">Year 1</option>
                                <option value="2">Year 2</option>
                                <option value="3">Year 3</option>
                                <option value="4">Year 4</option>
                              </select>
                            </div>
                          </div>
                          <input type="hidden" name="profile_pic" id="profile_pic" class="form-control"/>
                        </div>
                        <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="birthdate" >Birthdate:</label>
                              <input id="birthdate" class="form-control birthdate" data-relmax="-18" min="1922-01-01" type="date" name="birthdate" onblur="getAge();" title="You should be over 18 years old" style="background-color: #fff;" readonly />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="age" >Age:</label>
                              <input type="number" class="form-control age" name="age" id="age" maxlength="2" max="99" min="18" style="background-color: #fff;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" readonly/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="gender" >Gender</label>
                              <select class="form-select" name="gender" id="gender" readonly>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                              </select>
                          </div>
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
    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-3 px-3">
                    <h5 class="modal-title" id="exampleModalLabel"> Change Password </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="officer-change-pass.php" method="POST" data-parsley-validate data-parsley-trigger="keyup">
                    <div class="modal-body">
                      <div class="col-12 col-md-12 justify-content-center ">
                        <div class="form-outline">
                          <input type="hidden" id="cid" name="cid" class="form-control">
                           <label class="form-label" for="password" id="asterisk">New Password</label>
                      <input type="password" class="form-control password" name="password" id="txtNewPassword" data-parsley-trigger="keyup" data-parsley-minlength="8" maxlength="20" data-parsley-errors-container=".errorspannewpassinput"
                        data-parsley-required-message="Please enter your password." data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required required />
                      <span class="errorspannewpassinput"></span>
                      <div class="valid-feedback"> </div>
                      <div class="form-outline">
                      <label class="form-label" for="Confirmpassword" id="asterisk">Confirm Password</label>
                      <input type="password" class="form-control password" name="confirmpassword" id="txtConfirmPassword" maxlength="20" data-parsley-trigger="keyup" onChange="checkPasswordMatch();" data-parsley-minlength="8"
                        data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your password." data-parsley-equalto="#txtNewPassword" data-parsley-required required />
                      <span class="errorspanconfirmnewpassinput"></span>
                      <div class="valid-feedback"> </div>
                      <!--  <div class="invalid-feedback">Invalid Field!</div>-->
                    </div>
                         </div>
                       </div>
                       <p class="mt-3 mb-0 mx-0 text-center justify-content-center align-items center"> You are about to change your password. Are you sure?</p>
                   </div>
                   <div class="modal-footer py-2 px-3">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                       <button type="submit" name="changePassword" class="btn btn-info">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--For modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        $(document).on('click', '.viewbtn', function(){
           var officer_id = $(this).attr("id");
           $.ajax({
                url:"officer-fetch-profile.php",
                method:"POST",
                data:{officer_id:officer_id},
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
            document.getElementById("first_name").addEventListener("input", forceLower);
            document.getElementById("middle_initial").addEventListener("input", forceLower);
            document.getElementById("last_name").addEventListener("input", forceLower);
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

      $(document).ready(function() {
          $("#SECTION").inputmask("999A", {
            autoUnmask: true,
            onincomplete: function() {
              $("#errorsection").show();
            },

            clearIncomplete: true,
            removeMaskOnSubmit: true,
            showMaskOnFocus: false,
            showMaskOnHover: false,
            oncomplete: function() {
              $("#errorsection").hide();
            }
          });
        });
    </script>
    <script>
    $(document).ready(function() {
    $('#profilePic').change(function(){
        var file_data = $('#profilePic').prop('files')[0];
        var form_data = new FormData();
        form_data.append('profilePic', file_data);
        $.ajax({
            url: "officer-update-pic.php",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                console.log(data);
                location.reload();
            }
        });
    });
});
    </script>
        <script>
      $(document).on('click', '.passbtn', function(){
        var officer_id = $(this).attr("id");
        $.ajax({
                url:"officer-fetch-profile.php",
                method:"POST",
                data:
                {
                  officer_id:officer_id
                },
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#cid').val(data.officer_id);
                $('#changePass').modal('show');
                }
        });
      });
</script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- Sidebar collapse -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves css
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>-->
    <!-- Datatable default  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>

    <!-- Datatable bs5
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
      src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>  -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- <script src="js/form-validation.js"></script>
  Prevent Cut Copy Paste -->
    <script>
      $(document).ready(function() {
        $('input:text').bind('cut copy paste', function(e) {
          e.preventDefault();
          return false;
        });

      });

      document.addEventListener('click', function handleClickOutsideBox(event) {
    const box = document.getElementById('box');

    if (!box.contains(event.target)) {
      box.style.display = 'none';
    }
  });
    </script>

    <!--image upload-->
    <script>
    $(document).ready(function() {


    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
    </script>
    <!--input mask-->
    <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.6/dist/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="../assets/js/inputmask-validation.js"></script>

    <!--Uppercase first letter !-->
    <script src="../assets/js/uppercase-firstletter.js"></script>

    <!--password validation!-->
    <script src="../assets/js/pass-validation.js"></script>

    <!-- age validation !-->
    <script src="../assets/js/age-validation.js"></script>
<script src="../assets/js/dataTables.altEditor.free.js" ></script>
</body>

</html>
