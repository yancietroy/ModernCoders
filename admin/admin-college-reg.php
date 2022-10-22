<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php'); include('profilepic.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:index.php");
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

<!-- Datatable Default-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <li class="active">
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
      <li >
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
              <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
            </li>
            <li  class=" ">
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
                <a href="admin-students.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
            </li>
            <li>
                <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
            </li>
            <li>
                <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
              </li>
          </ul>
        </li>
        <li>
          <a href="admin-students.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="admin-survey.pho"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
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
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_admin WHERE ADMIN_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
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

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="admin-college.php">College Management</a></li>
          <li class="breadcrumb-item active" aria-current="page">New College</li>
        </ol>
      </nav>

      <!-- Page content -->

              <div class="row justify-content-center align-items-center">
      <div class="col-11 col-lg-11 col-xl-11">
        <div class="card shadow card-registration mb-4" style="border-radius: 15px;">
          <div class="card-body px-5 py-3 pt-4 ">
            <div class="row g-0 justify-content-center align-items-center ">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form" name="form" data-parsley-validate data-parsley-trigger="keyup" data-parsley-validate class="requires-validation" novalidate>
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">College Registration</h3>

                                    <!-- <form class="was-validated"> -->
                                    <!--   <div class="row justify-content-between">
                                    <div class="col-12 col-md-4  mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" for="schoolId" id="asterisk">Org ID</label>
                                        <input type="text" name="schoolId" id="schoolId" class="form-control" placeholder="##-###### " required />
                                        <div class="valid-feedback"> </div>
                                      </div> college id is auto increment
                                    </div>


                                    <div class="col-12 col-md-4  mb-4">
                                      <label class="form-label" id="asterisk">Organization Type</label>
                                      <select class=" form-select" name="signatory_type" id="showme" required>
                                        <option class="greyclr" selected disabled value="">Select Type</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Non-Academic">Non-Academic</option>
                                      </select>
                                  </div>

                                  <div class="col-12 col-md-4  mb-4" style='display:none;' id="orghide">
                                  <label class="form-label" id="asterisk">Assign Course</label>
                                  <select class="form-select" style="width:100%;" name="COURSE" id="COURSE" >
                                    <option class="greyclr" selected disabled value="">Select Course</option>
                                    <?php/*
                                          $query = "SELECT course FROM tb_course";
                                          $result = @mysqli_query($conn, $query);
                                          while($data = @mysqli_fetch_array($result)) {
                                              echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                          }
                                    */?>
                                  </select>
                              </div>
                                    </div>-->
                                  <div class="row justify-content-between">
                                    <div class="col-12 col-md-12 col-sm-3 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" for="collegename" id="asterisk">College Department Name</label>
                                        <input type="text" name="collegename" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="50"  class="form-control form-control-lg" required="" />
                                        <div class="valid-feedback"></div>
                                        <!--<div class="invalid-feedback">First name field invalid!</div>-->
                                      </div>
                                    </div>
                                    <!--<div class="col-12 col-md-6  mb-4">
                                      <div class="form-outline">

                                        <label class="form-label" for="lastName" id="asterisk">Abbreviation</label>
                                        <input type="text" name="lastName" onkeypress="return /[a-z, ,-]/i.test(event.key)" pattern="^(?:[A-Za-z]+[ -])*[A-Za-z]+$" maxlength="10"  oninput="this.value = this.value.toUpperCase()" class="form-control form-control-lg" required />
                                        <div class="valid-feedback"> </div>
                                        <div class="invalid-feedback">Last name field invalid!</div>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="row mb-0">
                                      <div class="col-12 col-md-6 col-sm-3 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" for="orgname" id="asterisk">Assign Student Adviser</label>
                                          <select class="form-select" style="width:100%;" name="Signatory" id="Signatory" >
                                            <option class="greyclr" selected disabled value="">Select Adviser</option>
                                            <?php/*
                                                  $query = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM tb_signatories WHERE signatory_type='Adviser'";
                                                  $result = @mysqli_query($conn, $query);
                                                  while($data = @mysqli_fetch_array($result)) {
                                                      echo '<option value="'.$data[0].'">'.$data[0].'</option>';
                                                  }
                                          */  ?>
                                          </select>
                                      </div>
                                    </div>
                                      <div class="col-12 col-md-6  mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" for="lastName" id="asterisk">Organization Logo</label>
                                          <input class="form-control" name="attachments" id="orgpic" type="file" accept="image/*"/ id="orgpic" required single>
                                          <div class="valid-feedback"> </div>
                                        </div>-->
                                          <!--<div class="invalid-feedback">Last name field invalid!</div>    </div>-->

                                  </div>
                                    <div class="col-12 col-md-12 mt-0 mb-4">
                                      <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit" value="register">Register</button>

                                    </div>


                                    <?php
                                if (isset($collegename) || isset($_POST['submit']))
                                  {
                                      $collegename = $_POST['collegename'];
                                    /*$duplicate=mysqli_query($conn,"SELECT * FROM tb_orgs WHERE ORG='$org'");
                                    $mDuplicate=mysqli_query($conn,"SELECT * FROM tb_morg WHERE MOTHER_ORG='$org'");
                                    if (mysqli_num_rows($duplicate)>0)
                                    {
                                      echo "<script type='text/javascript'>
                                            alert('Organization already exists!')
                                            window.location.href='admin-orgs-reg.php'
                                            </script>";
                                    }else if (mysqli_num_rows($mduplicate)>0)
                                    {
                                      echo "<script type='text/javascript'>
                                            alert('Organization already exists!')
                                            window.location.href='admin-orgs-reg.php'
                                            </script>";
                                    }
                                    else{*/
                                    try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "INSERT INTO tb_collegedept(college) VALUES('$collegename')";
                                    $conn->exec($sql);
                                    echo "<script type='text/javascript'>
                                        Swal.fire({
                                             icon: 'success',
                                             title: 'College Department Created',
                                             confirmButtonColor: '#F2AC1B'

                                         })
                                          </script>";
                                    }
                                       catch(PDOException $e)
                                        {
                                              echo $sql . "
                                              " . $e->getMessage();
                                        }
                                    $conn = null;
                                    //}
                                  }
                                ?>
                                  </form>
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

      <script>
      document.getElementById('showme').addEventListener('change', function () {
          var style = this.value == "Academic" ? 'block' : 'none';
          document.getElementById('orghide').style.display = style;
      });
    </script>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
  <!-- Sidebar collapse -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('.btn-primary');
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
    <!--email generator-->
    <script>
      $("#txtTest, #txtTest2").on('input', function() {
        var fname = $("#txtTest").val().toLowerCase().replace(/\s/g, '');
        var lname = $("#txtTest2").val().toLowerCase().replace(/\s/g, '');
        $("#email").attr("value", fname + "." + lname + "@jru.edu");
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
