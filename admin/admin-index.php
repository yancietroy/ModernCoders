<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Home";

if (isset($_SESSION['msg'])) {
  print_r($_SESSION['msg']); #display message
  unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
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

      <!-- Page content -->
      <h4 class="ms-3">Admin Profile</h4>
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-10 col-xl-11">
          <div class="card shadow border-0 rounded-lg mt-4 mb-5">
            <div class="card-body p-4">
              <div class="row g-0 justify-content-between">
                <div class="col-md-3  d-none d-sm-block text-center ">
                  <img class="profile_img rounded-circle" src="<?= $data_picture ?>" id="indexpic" alt="">
                </div>
                <?php
                $query = "SELECT admin_id, CONCAT(FIRST_NAME, ' ', LAST_NAME), email AS name, EMAIL FROM tb_admin WHERE admin_id = '$data_userid'";
                $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
                $row = mysqli_fetch_array($result);
                if ($row) {
                  echo "
                            <div class='col-12 col-md-2 mt-4'>
                            <label class='text-muted'>Admin ID:</label>
                            <h6>$row[0]</h6>
                          </div>
                          <div class='col-12 col-md-3 mt-4'>
                            <label class='text-muted'>Name:</label>
                            <h6>$row[1]</h6>
                          </div>
                          <div class='col-12 col-md-4 mt-4 '>
                            <label class='text-muted'>Email:</label>
                            <h6>$row[2]</h6>
                          </div>
                          ";
                  /**<div class='col-12 col-md-3 mt-3'>
                            <label class='text-muted'>Role:</label>
                            <h6>$row[2]</h6>
                          </div>**/
                }
                ?>
              </div>
            </div>
          </div>


        </div>

      </div>
      <h4 class="ms-3">Site Management</h4>
      <div class="row ms-3 me-3 mt-2 justify-content-between">
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-primary">
            <div class="inner">
              <h2><i class="bi bi-people"></i></h2>
              <p>User Management</p>
            </div>
            <div class="icon">
              <i class="bi bi-people-fill"></i>
            </div>
            <a href="admin-users.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter done">
            <div class="inner">
              <h2><i class="bi bi-check2-square"></i></h2>
              <p>Election</p>
            </div>
            <div class="icon">
              <i class="bi bi-check2-square"></i>
            </div>
            <a href="admin-election.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-success">
            <div class="inner">
              <h2><i class="bi bi-activity"></i></h2>
              <p>Data Analytics</p>
            </div>
            <div class="icon">
              <i class="bi bi-activity"></i>
            </div>
            <a href="admin-data.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card-counter bg-danger">
            <div class="inner">
              <h2><i class="bi bi-briefcase"></i> </h2>
              <p>Org Management</p>
            </div>
            <div class="icon">
              <i class="bi bi-briefcase-fill"></i>
            </div>
            <a href="admin-orgs.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!--  <div class="col-lg-3 col-sm-6">
  <div class="card-counter bg-info">
    <div class="inner">
      <h2><i class="bi bi-check-square"></i></h2>
      <p>Approval Management</p>
    </div>
    <div class="icon">
      <i class="bi bi-check-square-fill"></i>
    </div>
    <a href="admin-approval.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>-->
      <!--  <div class="row ms-3 me-3 mt-2 justify-content-between">

      <div class="col-lg-3 col-sm-6">
        <div class="card-counter bg-warning">
          <div class="inner">
            <h2><i class="bi bi-check2-square"></i></h2>
            <p>Election Management</p>
          </div>
          <div class="icon">
              <i class="bi bi-check2-square"></i>
          </div>
          <a href="admin-election.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-counter events">
          <div class="inner">
            <h2><i class="bi bi-folder"></i></h2>
            <p>Project Management</p>
          </div>
          <div class="icon">
            <i class="bi bi-folder-fill"></i>
          </div>
          <a href="admin-projects.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
         <div class="card-counter bg-info">
           <div class="inner">
             <h2><i class="bi bi-inbox"></i> </h2>
             <p>Forum Management</p>
           </div>
           <div class="icon">
            <i class="bi bi-inbox-fill"></i>
           </div>
           <a href="admin-audit.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <div class="col-lg-3 col-sm-6">
          <div class="card-counter masterlist">
            <div class="inner">
              <h2><i class="bi bi-file-bar-graph"></i> </h2>
              <p>Survey Management</p>
            </div>
            <div class="icon">
            <i class="bi bi-file-bar-graph-fill"></i>
            </div>
            <a href="admin-audit.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
     <div class="col-lg-3 col-sm-6">
        <div class="card-counter masterlist">
          <div class="inner">
            <h2><i class="bi bi-clock-history"></i></h2>
            <p>Audit Trail</p>
          </div>
          <div class="icon">
            <i class="bi bi-clock-history"></i>
          </div>
          <a href="admin-audit.php" class="card-counter-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>-->

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
</body>

</html>
