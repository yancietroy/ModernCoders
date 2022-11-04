<?php
ob_start();
session_start();

include('../router.php');
route(2);

include('../mysql_connect.php');
include('include/get-userdata.php');

$data_userid = $_SESSION['USER-ID'];
$orgid = $_SESSION['USER-ORG'];
$data_picture = getProfilePicture(2, $data_userid);
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
  <title>JRU Student Organizations Portal Officer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
      <h4 class="ms-3"><a class="" href="officer-profile.php" title="view student officer profile" aria-label="profile">Student Officer Profile</a></h4>
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-10 col-xl-11">
          <div class="card shadow border-0 rounded-lg mt-4 mb-5">
            <div class="card-body p-4">
              <div class="row g-0">
                <div class="col-md-2 mb-2 mt-4 d-none d-sm-block text-center ">
                  <img class="profile_img rounded-circle" src="<?= $data_picture ?>" id="indexpic" alt="">
                </div>
                <?php
                $query = "SELECT tb_officers.position_id, tb_position.position , CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name, COURSE, EMAIL, SECTION FROM tb_officers INNER JOIN tb_position ON tb_officers.position_id=tb_position.POSITION_ID WHERE officer_id = '$data_userid'";
                $result = @mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                if ($row) {
                  echo "
                    <div class='col-12 col-md-3 mt-2'>
                      <label class='text-muted'>Name:</label>
                      <h5>$row[2]</h5>
                      <label class='text-muted mt-3'>Section:</label>
                      <h5>$row[5]</h5>
                  </div>
                  <div class='col-12 col-md-4 mt-2'>
                    <label class='text-muted'>JRU ID:</label>
                    <h5>19-255322</h5>
                    <label class='text-muted mt-3'>Email:</label>
                    <h6>$row[4]</h6>
                  </div>
                  <div class='col-12 col-md-3 mt-2'>
                      <label class='text-muted'>Position:</label>
                      <h5>$row[1]</h5>
                      <label class='text-muted mt-3'>Course:</label>
                      <h6 class='fs-6'>$row[3]</h6>
                  ";
                  /**<label class='text-muted'>Position:</label>
                      <h5>Year $row[5] </h5>
                          </div>";**/
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </div>
      <h4 class="ms-5 mb-0">My Organizations</h4>
      <div class="row ms-4 mb-4 mt-4">
        <div class="col-12  col-md-5  " id="orgs">
          <div class="card shadow-md display: inline-block cards">
            <img src="<?= getOrgLogo($orgid) ?>" class="card-img-top rounded mx-auto d-block mt-4" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center mt-2"><?= $_SESSION['USER-ORG-NAME'] ?></h5>

              <a href="rso.php" class="stretched-link"></a>
            </div>
          </div>
        </div>

        <!-- Footer -->
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