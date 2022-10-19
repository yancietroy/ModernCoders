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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations </h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="student-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>

        <li class="active">
          <a href="election-student-index.php"> <i class="bi bi-check2-square"></i> <span>Election</span></a>

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
                  <!--<i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>-->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope me-lg-2 mt-2 d-none d-lg-block" style="width:  25px; height: 25px;"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">

                  <img class="rounded-circle me-lg-2" src="<?php echo $profilepic; ?>" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_students WHERE STUDENT_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
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

      <!-- Page content -->
<h4 class="ms-3">Current Active Election</h4>
<form method = "POST" action = "vote_result.php">
<div>
  <div><center>
    PRESIDENT</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 1") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
         <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "pres_id" class = "president"></center>
      </div>
      <?php
        }
      ?>
    </div>  
</div>
<div>
  <div><center>
    VICE PRESIDENT FOR INTERNAL AFFAIRS</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 2") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "vpinternal_id" class = "vpinternal"></center>
      </div>
      <?php
        }
      ?>
    </div>                    
</div>
<div>
  <div>
    <center>VICE PRESIDENT FOR EXTERNAL AFFAIRS</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 3") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
        <div>
          <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
          <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "vpexternal_id" class = "vpexternal"></center>
        </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>SECRETARY</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 4") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "secretary_id" class = "secretary"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>Assistant Secretary</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 5") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
        <div>
          <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
          <center><input type = "checkbox"  value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "asSec_id" class = "asSec"></center>
        </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>TREASURER</center>
  </div>
  <div>
    <?php
      $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 6") or die(mysqli_errno());
      while($fetch = $query->fetch_array())
      {
    ?>
    <div>
      <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
      <center><input type = "checkbox"  value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "treasurer_id" class = "treasurer"></center>
      </div>
    <?php
      }
    ?>
  </div>      
</div>
<div>
  <div>
    <center>AUDITOR</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 7") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
          {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "auditor_id" class = "auditor"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>PRO</center>
  </div>
    <div class="panel-body" style = "background-color:;">
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 8") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "pro_id" class = "pro"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>P.R.O. Internal</center>
  </div>
    <div class="panel-body" style = "background-color:;">
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 9") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "proInt_id" class = "proInt"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>P.R.O. External</center>
  </div>
    <div class="panel-body" style = "background-color:;">
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 10") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "proExt_id" class = "proExt"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>Assistant P.R.O</center>
  </div>
    <div>
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 11") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center> <center><input type = "checkbox"  value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "aPro_id" class = "aPro"></center>
      </div>
  
      <?php
        }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>BUSINESS MANAGER</center>
  </div>
    <div>
    <?php
      $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 12") or die(mysqli_errno());
      while($fetch = $query->fetch_array())
      {
    ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox"  value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "busman_id" class = "busman"></center>
      </div>
    <?php
    }
    ?>
    </div>      
</div>

<div>
  <div>
    <center>Overall Chairman</center>
  </div>
    <div>
      <?php
      $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 13") or die(mysqli_errno());
      while($fetch = $query->fetch_array())
      {
      ?>
        <div>
          <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
          <center><input type = "checkbox"  value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "oc_id" class = "oc"></center>
        </div>
  
      <?php
      }
      ?>
    </div>      
</div>
<div>
  <div>
    <center>Overall Co-Chairman</center>
  </div>
    <div class="panel-body" style = "background-color:;">
      <?php
        $query = $conn->query("SELECT * FROM `tb_candidate` WHERE `POSITION_ID` = 14") or die(mysqli_errno());
        while($fetch = $query->fetch_array())
        {
      ?>
      <div>
        <center><button type="button" class="btn btn-primary btn-xs" style = "border-radius:60px;margin-top:4px;"><?php echo $fetch['FIRST_NAME']." ".$fetch['LAST_NAME']?></button></center>
        <center><input type = "checkbox" value = "<?php echo $fetch['CANDIDATE_ID'] ?>" name = "ococ_id" class = "ococ"></center>
      </div>
      <?php
        }
      ?>
    </div>      
</div>
  <center><button class = "btn btn-success ballot" type = "submit" name = "submit">Submit Ballot</button></center>
</form>

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
    <!--WAVES CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js" integrity="sha512-MzXgHd+o6pUd/tm8ZgPkxya3QUCiHVMQolnY3IZqhsrOWQaBfax600esAw3XbBucYB15hZLOF0sKMHsTPdjLFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script> <!-- JavaScript validation -->
    <script type="text/javascript">
      Waves.attach('#sidebar ul li a');
      Waves.init();
    </script>

  <script type = "text/javascript">
    $(document).ready(function(){
      $(".president").on("change", function(){
        if($(".president:checked").length == 1)
          {
            $(".president").attr("disabled", "disabled");
            $(".president:checked").removeAttr("disabled");
          }
        else
          {
            $(".president").removeAttr("disabled");
          }
      });
      
      $(".vpinternal").on("change", function(){
        if($(".vpinternal:checked").length == 1)
          {
            $(".vpinternal").attr("disabled", "disabled");
            $(".vpinternal:checked").removeAttr("disabled");
          }
        else
          {
            $(".vpinternal").removeAttr("disabled");
          }
      });
      
      $(".vpexternal").on("change", function(){
        if($(".vpexternal:checked").length == 1)
          {
            $(".vpexternal").attr("disabled", "disabled");
            $(".vpexternal:checked").removeAttr("disabled");
          }
        else
          {
            $(".vpexternal").removeAttr("disabled");
          }
      });
      
      $(".secretary").on("change", function(){
        if($(".secretary:checked").length == 1)
          {
            $(".secretary").attr("disabled", "disabled");
            $(".secretary:checked").removeAttr("disabled");
          }
        else
          {
            $(".secretary").removeAttr("disabled");
          }
      });

      $(".asSec").on("change", function(){
        if($(".asSec:checked").length == 1)
          {
            $(".asSec").attr("disabled", "disabled");
            $(".asSec:checked").removeAttr("disabled");
          }
        else
          {
            $(".asSec").removeAttr("disabled");
          }
      });
      
       $(".treasurer").on("change", function(){
        if($(".treasurer:checked").length == 1)
          {
            $(".treasurer").attr("disabled", "disabled");
            $(".treasurer:checked").removeAttr("disabled");
          }
        else
          {
            $(".treasurer").removeAttr("disabled");
          }
        
      });

      $(".auditor").on("change", function(){
        if($(".auditor:checked").length == 1)
          {
            $(".auditor").attr("disabled", "disabled");
            $(".auditor:checked").removeAttr("disabled");
          }
        else
          {
            $(".auditor").removeAttr("disabled");
          }
      });

      $(".pro").on("change", function(){
        if($(".pro:checked").length == 1)
          {
            $(".pro").attr("disabled", "disabled");
            $(".pro:checked").removeAttr("disabled");
          }
        else
          {
            $(".pro").removeAttr("disabled");
          }
      });

      $(".proInt").on("change", function(){
        if($(".proInt:checked").length == 1)
          {
            $(".proInt").attr("disabled", "disabled");
            $(".proInt:checked").removeAttr("disabled");
          }
        else
          {
            $(".proInt").removeAttr("disabled");
          }
      });

      $(".proExt").on("change", function(){
        if($(".proExt:checked").length == 1)
          {
            $(".proExt").attr("disabled", "disabled");
            $(".proExt:checked").removeAttr("disabled");
          }
        else
          {
            $(".proExt").removeAttr("disabled");
          }
      });

      $(".aPro").on("change", function(){
        if($(".aPro:checked").length == 1)
          {
            $(".aPro").attr("disabled", "disabled");
            $(".aPro:checked").removeAttr("disabled");
          }
        else
          {
            $(".aPro").removeAttr("disabled");
          }
      });

      $(".busman").on("change", function(){
        if($(".busman:checked").length == 1)
        {
          $(".busman").attr("disabled", "disabled");
          $(".busman:checked").removeAttr("disabled");
        }
      else
        {
          $(".busman").removeAttr("disabled");
        }
      });
      $(".oc").on("change", function(){
        if($(".oc:checked").length == 1)
        {
          $(".oc").attr("disabled", "disabled");
          $(".oc:checked").removeAttr("disabled");
        }
      else
        {
          $(".oc").removeAttr("disabled");
        }
      });
      $(".ococ").on("change", function(){
        if($(".ococ:checked").length == 1)
        {
          $(".ococ").attr("disabled", "disabled");
          $(".ococ:checked").removeAttr("disabled");
        }
      else
        {
          $(".ococ").removeAttr("disabled");
        }
      });
    }); 
  </script>
</body>

</html>
