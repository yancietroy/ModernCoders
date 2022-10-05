<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php'); include('profilepic.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
  else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../index.php");
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
  <!-- Waves CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="student-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li class="active">
          <a href="student-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="election-student-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>
        <li class="d-lg-none">
          <a href="msg.php"> <i class="bi bi-envelope-fill"></i> <span>Message</span></a>

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
                  <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_students WHERE STUDENT_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $name = @mysqli_fetch_array ($result);
                  if ($name)
                  { echo "$name[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="student-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../index.php">Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Student Profile -->
    <h3 class="ms-3">Student Profile</h3>
      <div class="student-profile py-4 px-5">
        <div class="container-lg ">
          <div class="row">
            <div class="col-12 col-lg-4 mb-4">
              <div class="card shadow">
                <div class="card-header bg-transparent text-center">
                    <div class="container">
                        <img class="profile_img" src="<?php echo $profilepic; ?>"  id="profile-pic" alt="">
                      <div class="middle">
                        <div class="upload-button"><i class="bi bi-pencil-square"></i></div>
                          <input class="file-upload" type="file" name=profilePic id=profilePic accept="image/*"/>
                      </div>
                    </div>
                  <h3 class="pt-3"><?php echo "$name[0]"; ?></h3>
                </div>
                <?php $query = "SELECT * FROM tb_students WHERE STUDENT_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $data = @mysqli_fetch_array ($result);
                  $si = $data['STUDENT_ID'];?>
                <div class="card-body">
                  <p class="mb-0"><strong class="pr-1">Student ID:</strong><?php echo "$si"; ?></p>
                  <p class="mb-0"><strong class="pr-1">Year Level:</strong><?php echo "$data[YEAR_LEVEL]"; ?></p>
                  <p class="mb-0"><strong class="pr-1">Section:</strong><?php echo "$data[SECTION]"; ?></p>
                  <p class="mb-0"><strong class="pr-1">Academic Year:</strong>2022</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="card card-profile shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="mb-0 pt-2"><i class="far fa-clone pr-1"></i>Student Information</h3>
                </div>
                <div class="card-body mt-2 pt-0">
                  <table class="table table-bordered" id="proftable">

                    <tr>
                      <th width="30%">Gender</th>
                      <td width="2%">:</td>
                      <td><?php echo "$data[GENDER]"; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Birthdate</th>
                      <td width="2%">:</td>
                      <td><?php echo "$data[BIRTHDATE]"; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Age</th>
                      <td width="2%">:</td>
                      <td><?php echo "$data[AGE]"; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Email</th>
                      <td width="2%">:</td>
                      <td><?php echo "$data[EMAIL]"; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">College	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_students.COLLEGE_DEPT, tb_collegedept.college FROM tb_students INNER JOIN tb_collegedept ON tb_students.COLLEGE_DEPT=tb_collegedept.college_id WHERE tb_students.STUDENT_ID = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Course	</th>
                      <td width="2%">:</td>
                      <td><?php echo "$data[COURSE]"; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Organization	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_students.MORG_ID, tb_morg.MOTHER_ORG FROM tb_students INNER JOIN tb_morg ON tb_students.MORG_ID=tb_morg.MORG_ID WHERE tb_students.STUDENT_ID = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[MOTHER_ORG]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Position	</th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_students.USER_TYPE, tb_usertypes.user_type FROM tb_students INNER JOIN tb_usertypes ON tb_students.USER_TYPE=tb_usertypes.usertype_id WHERE tb_students.STUDENT_ID = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[user_type]"; } ?></td>
                    </tr>
                  </table>
                  <div class="card-body mt-2 p-4 pt-0" id="card-show">
                    <p class="mb-2 pe-2"><strong class="pr-1  ">Gender:</strong> <?php echo "$data[GENDER]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  ">Birthdate:</strong><?php echo "$data[BIRTHDATE]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  ">Age:</strong><?php echo "$data[AGE]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  ">Email:</strong><?php echo "$data[EMAIL]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  ">College:</strong><?php $query = "SELECT tb_students.COLLEGE_DEPT, tb_collegedept.college FROM tb_students INNER JOIN tb_collegedept ON tb_students.COLLEGE_DEPT=tb_collegedept.college_id WHERE tb_students.STUDENT_ID = '$id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  ">Mother Organization:</strong><?php $query = "SELECT tb_students.MORG_ID, tb_morg.MOTHER_ORG FROM tb_students INNER JOIN tb_morg ON tb_students.MORG_ID=tb_morg.MORG_ID WHERE tb_students.STUDENT_ID = '$id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[MOTHER_ORG]"; } ?></p>
                              <p class="mb-2 pe-2"><strong class="pr-1  ">Birthdate:</strong><?php echo "$data[BIRTHDATE]"; ?></p>
                              <p class="mb-2 pe-2"><strong class="pr-1  ">Role:</strong><?php $query = "SELECT tb_students.USER_TYPE, tb_usertypes.user_type FROM tb_students INNER JOIN tb_usertypes ON tb_students.USER_TYPE=tb_usertypes.usertype_id WHERE tb_students.STUDENT_ID = '$id'";
                                        $result = @mysqli_query($conn, $query);
                                        $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[user_type]"; } ?></p>

                              <p class="mb-2 pe-2"><strong class="pr-1  ">Side Organization:</strong></p>
                              <p class="mb-2 pe-2"><strong class="pr-1  ">Position:</strong></p>
                            </div>
                  <div class="d-grid gap-2 pb-0 mb-0 d-md-flex justify-content-end">
                    <?php echo "<button type='button' class='btn btn-primary btn-sm viewbtn' id='" . $si . "' >Edit Profile</button>";?>
                    <?php echo "<button type='button' class='btn btn-primary btn-sm passbtn' id='" . $si . "' >Change Password</button>";?>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="student-update-profile.php" method="POST"  data-parsley-validate data-parsley-trigger="keyup">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row justify-content-between">
                       <div class="col-4 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="STUDENT_ID" >Student ID:</label>
                           <input type="text" name="STUDENT_ID" id="STUDENT_ID" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="USER_TYPE" >User Type:</label>
                              <select class="form-select" name="USER_TYPE" id="USER_TYPE" readonly>
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
                       <div class="col-4 col-md-3 mb-4">
                       <div class="form-outline">
                         <label class="form-label" for="ACCOUNT_CREATED" >Account Created:</label>
                         <input type="text" name="ACCOUNT_CREATED" id="ACCOUNT_CREATED" class="form-control" style="background-color: #fff;" readonly />
                       </div>
                     </div>
                       </div>
                        <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="FIRST_NAME" >First name:</label>
                            <input type="text" name="FIRST_NAME" id="FIRST_NAME" class="form-control"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20"  style="background-color: #fff;"   required/>
                          </div>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="MIDDLE_NAME" >Middle Name:</label>
                            <input type="text" name="MIDDLE_NAME" id="MIDDLE_NAME" class="form-control"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20" style="background-color: #fff;"   />
                          </div>
                        </div>
                          <div class="col-12 col-md-4 mb-4">
                          <label class="form-label" for="LAST_NAME" >Last Name:</label>
                          <input type="text" name="LAST_NAME" id="LAST_NAME" class="form-control"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20"  style="background-color: #fff;"  required />
                          </div>
                          </div>
                        <div class="row">
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="BIRTHDATE" >Birthdate:</label>
                              <input id="BIRTHDATE" class="form-control form-control-lg birthdate" data-relmax="-18" min="1922-01-01" type="date" name="BIRTHDATE" onblur="getAge();" title="You should be over 18 years old"  required/>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="AGE" >Age:</label>
                              <input type="number" class="form-control age" name="AGE" id="AGE" maxlength="2" max="99" min="18" style="background-color: #fff;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="display:none;" required/>
                            </div>
                          </div>
                          <div class="col-6 col-md-4 mb-4 ">
                            <label class="mb-3   min-vw-100" for="GENDER">Gender </label>
                            <div class="btn-group">
                              <input type="radio" class="btn-check" name="GENDER" id="GENDER" value="Male" readonly>
                              <label class="btn btn-sm me-2 btn-outline-secondary" for="GENDER">Male</label>
                              <input type="radio" class="btn-check" name="GENDER" id="GENDER" value="Female" readonly>
                              <label class="btn btn-sm me-2 btn-outline-secondary" for="GENDER">Female</label>
                              <!--<div class="valid-feedback check"> &#x2713;</div>
                              <div class="invalid-feedback mv-up">Please select a gender!</div>-->
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="YEAR_LEVEL" >Year Level:</label>
                            <input type="text" name="YEAR_LEVEL" id="YEAR_LEVEL" class="form-control" maxlength="1"  oninput="this.value = this.value.replace(/[^1-4.]/g, '').replace(/(\..*)\./g, '$1');" style="background-color: #fff;" readonly />
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="SECTION">Section:</label>
                              <input type="text" name="SECTION" id="SECTION" class="form-control" maxlength="4" style="background-color: #fff;" readonly />
                            </div>
                          </div>
                          <div class="col-12 col-md-4 col-sm-3 mb-2">
                            <label class="form-label" for="EMAIL" >Email:</label>
                            <input type="text" name="EMAIL" id="EMAIL" class="form-control" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" maxlength="30" style="background-color: #fff;" />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="college" >College:</label>
                              <select class="form-select" name="college" id="college" readonly>
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
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label select-label" for="COURSE" >Course:</label>
                              <select class="form-select" style="width:100%;" name="COURSE" id="COURSE" readonly>
                                <?php
                                      $query = "SELECT course FROM tb_course";
                                      $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                      }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                              <label class="form-label" for="MORG_ID" >Mother Organization:</label>
                              <select class="form-select" name="MORG_ID" id="MORG_ID" readonly>
                                <?php
                                  $query = "SELECT MORG_ID, MOTHER_ORG FROM tb_morg";
                                  $result = @mysqli_query($conn, $query);
                                      while($data = @mysqli_fetch_array($result)) {
                                          echo '<option value="'.$data[0].'">'.$data[1].'</option>';
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
                <form action="student-change-pass.php" method="POST" data-parsley-validate data-parsley-trigger="keyup">
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
      <!-- Page content

      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-10 col-xl-11">
          <div class="card shadow border-0 rounded-lg mt-4 mb-5">
            <div class="card-body p-4">
              <div class="row g-0">
                <div class="col-md-2 mb-2 mt-4 d-none d-sm-block text-center ">
                  <img src="<?php echo $profilepic; ?>" class="rounded-circle img-fluid " alt="..." style="border: 4px solid #F2AC1B" width="102" height="100">
                </div>
                <?php
                  $query = "SELECT STUDENT_ID , CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name, COURSE, EMAIL, SECTION, YEAR_LEVEL FROM tb_students WHERE STUDENT_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  {
                    echo "
                          <div class='col-12 col-md-3 mt-2'>
                            <label class='text-muted'>Name:</label>
                            <h5>$row[1]</h5>
                            <label class='text-muted'>Section:</label>
                            <h5>$row[4]</h5>
                        </div>
                        <div class='col-12 col-md-4 mt-2'>
                            <label class='text-muted'>Email:</label>
                            <h6>$row[3]</h6>
                            <label class='text-muted'>Course:</label>
                            <h6>$row[2]</h6>
                        </div>
                        <div class='col-12 col-md-3 mt-2'>
                            <label class='text-muted'>Student ID:</label>
                            <h5>$row[0]</h5>
                            <label class='text-muted'>Year Level:</label>
                            <h5>Year $row[5] </h5>
                        </div>";
                        @mysqli_close($conn);
                        }
                        ?>
              </div>

            </div>
          </div>
        </div>
      </div> -->
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

    <script>
    $(document).ready(function() {
    $('#profilePic').change(function(){
        var file_data = $('#profilePic').prop('files')[0];
        var form_data = new FormData();
        form_data.append('profilePic', file_data);
        $.ajax({
            url: "student-update-pic.php",
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script>
        $(document).on('click', '.viewbtn', function(){
           var STUDENT_ID = $(this).attr("id");
           $.ajax({
                url:"student-fetch-profile.php",
                method:"POST",
                data:
                {
                  STUDENT_ID:STUDENT_ID
                },
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#STUDENT_ID').val(data.STUDENT_ID);
                $('#ACCOUNT_CREATED').val(data.ACCOUNT_CREATED);
                $('#FIRST_NAME').val(data.FIRST_NAME);
                $('#MIDDLE_NAME').val(data.MIDDLE_NAME);
                $('#LAST_NAME').val(data.LAST_NAME);
                $('#BIRTHDATE').val(data.BIRTHDATE);
                $('#AGE').val(data.AGE);
                $('input[type=radio][id="GENDER"][value='+data.GENDER+']').prop('checked', true);
                $('#YEAR_LEVEL').val(data.YEAR_LEVEL);
                $('#EMAIL').val(data.EMAIL);
                $('#COLLEGE_DEPT').val(data.COLLEGE_DEPT);
                $('#COURSE').val(data.COURSE);
                $('#SECTION').val(data.SECTION);
                $('#MORG_ID').val(data.MORG_ID);
                $('#PASSWORD').val(data.PASSWORD);
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
      $(document).on('click', '.passbtn', function(){
        var STUDENT_ID = $(this).attr("id");
        $.ajax({
                url:"student-fetch-profile.php",
                method:"POST",
                data:
                {
                  STUDENT_ID:STUDENT_ID
                },
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#cid').val(data.STUDENT_ID);
                $('#changePass').modal('show');
                }
        });
      });
</script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!--WAVES CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
    <!-- JavaScript validation -->
    <script src="../assets/js/bootstrap-validation.js"></script>
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
</body>

</html>
