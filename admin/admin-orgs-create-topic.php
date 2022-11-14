<?php
ob_start();
session_start();

include('../router.php');
route(0);

include('../mysql_connect.php');
include('include/get-userdata.php');

$orgid = $_GET['id'] ?? -1;
$orgName = "";
$query = "SELECT ORG FROM tb_orgs WHERE ORG_ID='$orgid'";
if ($orgRes = @mysqli_query($conn, $query)) {
    if ($orgRes->num_rows > 0) {
        $row = $orgRes->fetch_assoc();
        $orgName = $row['ORG'];
    } else {
        header('location:admin-orgs.php');
    }
}


$data_userid = $_SESSION['USER-ID'];
$data_picture = getProfilePicture(0, $data_userid);
$nav_selected = "Site Management / Organizations";
$nav_breadcrumbs = [
    ["Home", "admin-index.php", "bi-house-fill"],
    ["Site Management", "admin-users.php", ""],
    ["Organizations", "admin-orgs.php", ""],
    [$orgName, "admin-orgs-rso.php?id=$orgid", ""],
    ["Discussion Board", "forum-user.php?id=$orgid", ""],
    ["New Topic", "", ""],
];

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
  <!-- waves CSS CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.css" integrity="sha512-sZpz+opN4EQSKs1/8HcRC26qYLImX6oCOKZmIFEW9bsL5OJwYbeemphkSPeRpHaaS0WLci2fUNWvZJloNKlZng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datepicker CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Icons-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar  -->
    <?php include("include/sidebar.php") ?>

    <div id="content">

      <!-- Navbar/Header  -->
      <?php include("include/header.php") ?>

      <!-- breadcrumb -->
      <?php include("include/breadcrumb.php") ?>

      <!-- Page content -->
      <form action="" method="post" class="requires-validation" enctype="multipart/form-data" autocomplete="off" data-parsley-validate data-parsley-trigger="keyup" data-parsley-errors-messages-disabled parsley-use-html5-constraints>
        <div class="row ms-3 me-3 mt-2">
          <div class="col-lg-6 col-6  mb-4">
            <h4>Create New Topic</h4>
          </div>
        </div>
        <div class="wrap shadow px-5 py-4 mx-auto mb-4">
          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4 mt-4">
              <div class="form-outline">
                <label class="form-label" for="subject" id="asterisk">Topic name:</label>
                <input type="text" name="subject" id="subject" class="form-control form-control-lg" maxlength="50" required />
                <div class="valid-feedback"></div>

              </div>
            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <label class="form-label select-label" for="icon" id="asterisk">Topic Icon:</label>
              <select class="mt-0 ms-0 form-select" name="icon" id="icon" required>
                <option value="bi bi-chat-square-dots-fill">Discussion</option>
                <option value="bi bi-clipboard-fill">Reminder</option>
                <option value="bi bi-megaphone-fill">Announcement</option>
                <option value="bi bi-lightning-charge-fill">Introduction</option>
              </select>
              <div class="valid-feedback"> </div>

            </div>
            <div class="col-12 col-md-6 col-sm-3 mb-4">
              <label class="form-label select-label" for="group_id" id="asterisk">Category:</label>
              <select class="mt-0 ms-0 form-select" name="group_id" id="group_id" required>
                <?php
                  $query = "SELECT * FROM tb_disc_groups";
                  $result = @mysqli_query($conn, $query);
                  while ($data = @mysqli_fetch_array($result)) {
                    echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                  }
                ?>
              </select>
              <div class="valid-feedback"> </div>
            </div>


          <div class="row">
            <div class="col-12 col-md-12 col-sm-3 mb-4">
              <div class="form-outline">
                <label class="form-label" for="description" id="asterisk">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter topic description" required></textarea>
                <div class="valid-feedback"></div>
              </div>
            </div>
          </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <input class="btn btn-lg btn-outline-info" type="reset" value="Reset">
              <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit">
            </div>
          </div>
        </div>
        <?php
        $mysqli = new mysqli("$servername","$username","$password","$database");

        if ($mysqli -> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }

        if (isset($s) || isset($gi) || isset($i) || isset($d) || isset($_POST['submit'])) {
        // Escape special characters, if any
          $s = $mysqli -> real_escape_string ($_POST['subject']);
          $gi = $mysqli -> real_escape_string ($_POST['group_id']);
          $i = $mysqli -> real_escape_string ($_POST['icon']);
          $d = $mysqli -> real_escape_string ($_POST['description']);
          if($gi == 3){
          $v = 2;
          $query = "INSERT INTO tb_disc_topics(subject, group_id, icon, description, org_id, visibility) VALUES('$s', '$gi', '$i', '$d', '$orgid', '$v')";
          $result = @mysqli_query($conn, $query);
          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Topic Created',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";
          }elseif($gi == 4){
          $v = 5;
          $query = "INSERT INTO tb_disc_topics(subject, group_id, icon, description, org_id, visibility) VALUES('$s', '$gi', '$i', '$d', '$orgid', '$v')";
          $result = @mysqli_query($conn, $query);
          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Topic Created',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";
          }else{
          $v = 0;
          $org_id = 0;
          $query = "INSERT INTO tb_disc_topics(subject, group_id, icon, description, org_id, visibility) VALUES('$s', '$gi', '$i', '$d', '$orgid', '$v')";
          $result = @mysqli_query($conn, $query);
          echo "<script type='text/javascript'>
                          Swal.fire({
                               icon: 'success',
                               title: 'Topic Created',
                                confirmButtonColor: '#F2AC1B'
                           })
                            </script>";
          }
          @mysqli_close($conn);
        }
        ?>
      </form>
      <!-- Footer -->
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- form validation/sidebar toggle -->
    <script src="../assets/js/form-validation.js"></script>
    <!-- waves js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>
    <script src="../assets/js/date.js"></script>
    <!-- Datepicker cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>