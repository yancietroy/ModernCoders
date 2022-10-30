<?php
ob_start();
session_start();
$org_id = $_SESSION['org_id'];
if(!isset($_SESSION['org_id'])){
  unset($org_id);
}
$id = $_SESSION['use'];
unset($_SESSION['pid']);
$stid = $_SESSION['signatory_type_id'];
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <link rel="shortcut icon" type="image/jpg" href="../assets/img/jrusop-fav.ico"/>
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

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal Signatory</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li class="active">
          <a href="signatory-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <!--<a href="signatory-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>-->
        </li>
        <li>
          <a href="signatory-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <!--<li>
          <a href="election-student-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
        </li>-->
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
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM tb_signatories WHERE school_id = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="signatory-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../signatory-login.php">Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Signatory Profile -->
    <h3 class="ms-3">Signatory Profile</h3>
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
                  <h3 class="pt-3"><?php echo "$row[0]"; ?></h3>
                </div>
                <?php $query = "SELECT * FROM `tb_signatories` WHERE school_id = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $data = @mysqli_fetch_array ($result);
                  $si = $data['school_id'];?>
                <div class="card-body text-center">
                  <p class="mb-0"><strong class="pr-1">JRU ID:</strong><?php echo $si; ?></p>
                  <p class="mb-0"><strong class="pr-1">Position:</strong><?php $query = "SELECT tb_signatories.signatorytype_id, tb_signatory_type.signatory FROM tb_signatories INNER JOIN tb_signatory_type ON tb_signatories.signatorytype_id=tb_signatory_type.signatory_id WHERE tb_signatories.school_id = '$id'";
                            $result = @mysqli_query($conn, $query);
                            $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[signatory]"; } ?></p>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="card card-profile shadow" id="card-large">
                <div class="card-header bg-transparent border-0">
                   <div class="d-grid gap-2 py-2 d-md-flex justify-content-between">
                    <h3 class="mb-0 py-0"><i class="far fa-clone pr-1"></i> Signatory Information</h3>
                  </div>
                </div>
                <div class="card-body mt-2 pt-0">
                  <table class="table table-bordered" id="proftable">

                    <tr>
                      <th width="30%">First Name:</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['first_name']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Last Name:</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['last_name']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Email</th>
                      <td width="2%">:</td>
                      <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                      <th width="30%">Signatory Type: </th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_signatories.signatorytype_id, tb_signatory_type.signatory FROM tb_signatories INNER JOIN tb_signatory_type ON tb_signatories.signatorytype_id=tb_signatory_type.signatory_id WHERE tb_signatories.school_id = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[signatory]"; } ?></td>
                    </tr>
                    <tr>
                      <th width="30%">College </th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_signatories.college_dept, tb_collegedept.college FROM tb_signatories INNER JOIN tb_collegedept ON tb_signatories.college_dept=tb_collegedept.college_id WHERE tb_signatories.school_id = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></td>
                    </tr>
                 <tr>
                      <th width="30%">Organization  </th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_signatories.org_id, tb_orgs.ORG FROM tb_signatories INNER JOIN tb_orgs ON tb_signatories.org_id=tb_orgs.ORG_id WHERE tb_signatories.school_id = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[ORG]"; } ?></td>
                    </tr>

                     <tr>
                      <th width="30%">Role: </th>
                      <td width="2%">:</td>
                      <td><?php $query = "SELECT tb_signatories.usertype_id, tb_usertypes.user_type FROM tb_signatories INNER JOIN tb_usertypes ON tb_signatories.usertype_id=tb_usertypes.usertype_id WHERE tb_signatories.school_id = '$id'";
                                $result = @mysqli_query($conn, $query);
                                $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[user_type]"; } ?></td>
                    </tr>
                  <!--  <tr>
                      <th width="30%">Side Organization </th>
                      <td width="2%">:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th width="30%">Position  </th>
                      <td width="2%">:</td>
                    <td></td>
                  </tr>-->
                  </table>
                  <div class="card-body mt-2 p-0 w-100 pt-0" id="card-show">
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">First Name:<br></strong> <?php echo "$data[first_name]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1 text-muted ">Last Name:<br></strong><?php echo "$data[last_name]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Email:<br></strong><?php echo "$data[email]"; ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Signatory Type:<br></strong><?php $query = "SELECT tb_signatories.signatorytype_id, tb_signatory_type.signatory FROM tb_signatories INNER JOIN tb_signatory_type ON tb_signatories.signatorytype_id=tb_signatory_type.signatory_id WHERE tb_signatories.school_id = '$id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[signatory]"; } ?></p>
                 <p class="mb-2 pe-2"><strong class="pr-1  text-muted">College:<br></strong><?php $query = "SELECT tb_signatories.college_dept, tb_collegedept.college FROM tb_signatories INNER JOIN tb_collegedept ON tb_signatories.college_dept=tb_collegedept.college_id WHERE tb_signatories.school_id = '$id'";
                           $result = @mysqli_query($conn, $query);
                           $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[college]"; } ?></p>
                    <p class="mb-2 pe-2"><strong class="pr-1  text-muted">Organization:<br></strong><?php $query = "SELECT tb_signatories.org_id, tb_orgs.ORG FROM tb_signatories INNER JOIN tb_orgs ON tb_signatories.org_id=tb_orgs.ORG_id WHERE tb_signatories.school_id = '$id'";
                              $result = @mysqli_query($conn, $query);
                              $row = @mysqli_fetch_array ($result); if ($row){ echo "$row[ORG]"; } ?></p>

                            </div>
                  <div class="d-grid gap-2 pb-0 mb-0 d-md-flex justify-content-end">
                    <?php echo "<button type='button' class='btn btn-primary btn-sm viewbtn' id='" . $id . "' >Edit Profile</button>";?>
                    <?php echo "<button type='button' class='btn btn-primary btn-sm passbtn' id='" . $id . "' >Change Password</button>";?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 <!-- signatory Modal -->
 <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Update Signatory Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="signatory-update-profile.php" method="POST"  data-parsley-validate data-parsley-trigger="keyup">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row justify-content-between">
                       <div class="col-5 col-md-2 col-sm-3 mb-4">
                         <div class="form-outline">
                           <label class="form-label" for="school_id" >JRU ID:</label>
                           <input type="text" name="school_id" id="school_id" class="form-control" style="background-color: #fff;" readonly/>
                         </div>
                       </div>
                       <div class="col-4 col-md-3 mb-4 d-none d-sm-block">
                            <div class="form-outline">
                         <label class="form-label" for="account_created" >Account Created:</label>
                         <input type="text" name="account_created" id="account_created" class="form-control" style="background-color: #fff;" readonly />
                       </div>
                          </div>
                       </div>
                        <div class="row justify-content-between">
                        <div class="col-12 col-md-4 mb-4">
                          <div class="form-outline">
                            <label class="form-label" for="first_name" >First name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20"  style="background-color: #fff;"   required/>
                          </div>
                        </div>
                          <div class="col-12 col-md-4 mb-4">
                          <label class="form-label" for="last_name" >Last Name:</label>
                          <input type="text" name="last_name" id="last_name" class="form-control"  onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="20"  style="background-color: #fff;"  required />
                          </div>
                        </div>
                        <div class="row">

                       <div class="col-5 col-md-4 mb-4">
                       <div class="form-outline">
                            <label class="form-label" for="signatory_type" >Signatory Type:</label>
                            <select class="form-select" name="signatory_type" id="signatory_type" readonly >
                              <option value="Student Adviser">Student Adviser</option>
                              <option value="Dean">Dean</option>
                              <option value="SDO">SDO</option>
                            </select>
                          </div>
                     </div>
                        <!--  <div class="col-12 col-md-4 mb-4">
                            <div class="form-outline">
                            <label class="form-label" for="user_type" >Role:</label>
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
                        </div>-->
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
                          <div class="col-6 col-md-4 mb-4 ">
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
            url: "signatory-update-pic.php",
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
           var school_id = $(this).attr("id");
           $.ajax({
                url:"signatory-fetch-profile.php",
                method:"POST",
                data:{school_id:school_id},
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#school_id').val(data.school_id);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#org_id').val(data.org_id);
                $('#college_dept').val(data.college_dept);
                $('#signatory_type').val(data.signatory_type);
                $('#user_type').val(data.usertype_id);
                $('#account_created').val(data.account_created);
                $('#profile_pic').val(data.profile_pic);
                $('#viewmodal').modal('show');
                $('#modal-lg').css('max-width','70%');
                }
            });

            // UPPERCASE FIRST LETTER
            document.getElementById("FIRST_NAME").addEventListener("input", forceLower);
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
      $(document).on('click', '.passbtn', function(){
        var school_id = $(this).attr("id");
        $.ajax({
                url:"signatory-fetch-profile.php",
                method:"POST",
                data:
                {
                  school_id:school_id
                },
                dataType:"json",
                success:function(data){
                console.log(data);
                $('#cid').val(data.school_id);
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
