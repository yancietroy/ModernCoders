<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
  else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../signatory-login.php");
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
  <!-- Waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">

      <div class="sidebar-header text-center">
        <a class="navbar-brand" href="signatory-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="signatory-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>

        <li class="active">
          <a href="signatory-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="signatory-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <!--<li>
        <a href="#pageSubmenu"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>-->
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
                  <img class="rounded-circle me-lg-2" src="../assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
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
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="signatory-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="signatory-orgs.php"> <i class="bi bi-people-fill"></i> Organizations</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> COMSOC</li>
        </ol>
      </nav>
      <!-- Page content -->

            <div class="row ms-3 me-3 mt-2 mb-2">
              <div class="col-lg-6 col-7">
                <h4>Student Organizations Management</h4>
              </div>
            </div>
            <div class="row justify-content-center align-items-center text-align-center">
              <div class="col-12 col-lg-10 col-xl-11">
                <div class="card shadow border-0 rounded-lg mb-4 mx-4 w-80 justify-content-center align-items-center text-align-center">
                  <div class="card-body p-4 mx-auto px-auto">
                    <div class="row g-0 ">
                      <div class="col-md-2 d-none d-sm-block text-center mt-3">
                        <img src="../assets/img/comsoc-logo.png" class="rounded-circle img-fluid " alt="..." style="border: 2px solid #F2AC1B" width="122" height="150">
                      </div>
                        <div class='col-12 col-md-10 mt-4'>
                          <h3 class="justify-content-center align-items-center text-align-center">JRU Computer Society</h3>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="row ms-3 me-3">
             <div class="col-lg-3 col-sm-6">
                <div class="card-counter primary">
                  <div class="inner">
                    <h2><i class="bi bi-file-person"></i></h2>
                    <p>Members</p>
                  </div>
                  <div class="icon">
                  <i class="bi bi-file-person"></i>
                  </div>
                  <a href="comsoc-members.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="card-counter bg-warning">
                  <div class="inner">
                    <h2><i class="bi bi-person-badge"></i></h2>
                    <p>Officers</p>
                  </div>
                  <div class="icon">
                  <i class="bi bi-person-badge"></i>
                  </div>
                  <a href="admin-orgs-comsoc-officers.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="card-counter bg-info">
                  <div class="inner">
                    <h2><i class="bi bi-person-rolodex"></i></h2>
                    <p>Signatories</p>
                  </div>
                  <div class="icon">
                    <i class="bi bi-person-rolodex"></i>
                  </div>
                  <a href="admin-orgs-comsoc-signatories.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="card-counter events">
                  <div class="inner">
                    <h2><i class="bi bi-calendar3"></i></h2>
                    <p>Event Calendar</p>
                  </div>
                  <div class="icon">
                <i class="bi bi-calendar3-fill"></i>
                  </div>
                  <a href="event-calendar.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="card-counter bg-danger">
                  <div class="inner">
                    <h3><i class="bi bi-file-bar-graph"></i></h3>
                    <p>Survey</p>
                  </div>
                  <div class="icon">
                    <i class="bi bi-file-bar-graph-fill" aria-hidden="true"></i>
                  </div>
                  <a href="user-survey.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>


              <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card-counter done">
                  <div class="inner">
                    <h3><i class="bi bi-inbox"></i></h3>
                    <p>Forum</p>
                  </div>
                  <div class="icon">
                <i class="bi bi-inbox-fill"></i>
                  </div>
                  <a href="forum-user.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card-counter bg-success">
                  <div class="inner">
                    <h3><i class="bi bi-folder"></i></h3>
                    <p>Projects</p>
                  </div>
                  <div class="icon">
                <i class="bi bi-folder-fill"></i>
                  </div>
                  <a href="signatory-projects.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="card-counter masterlist">
                  <div class="inner">
                    <h3><i class="bi bi-envelope"></i> </h3>
                    <p>Messages</p>
                  </div>
                  <div class="icon">
                    <i class="bi bi-envelope-fill"></i>
                  </div>
                  <a href="signatory-masterlist.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
</body>

</html>
