<?php
ob_start();
session_start();
$id = $_SESSION['use'];
$morg_id = $_SESSION['morg_id'];
$secOrg_id = $_SESSION['org_id'];
include('../mysql_connect.php'); include('profilepic.php'); include('../assets/img/logopics.php');
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

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li>
          <a href="student-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="election-student-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li class="active">
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

      <!-- breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="student-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page"> <i class="bi bi-file-bar-graph-fill"></i> Project Feedback</li>
        </ol>
      </nav>

      <!-- Page content -->
      <!---<center>
      <iframe frameborder="0" align="center" width="600" height="600" src="https://s.surveyplanet.com/63358210077cad4dbcd8bb43" frameborder="0"></iframe>
    </center>

<iframe src="https://survey.zohopublic.com/zs/qdCzq7" frameborder='0' style='height:700px;width:100%;' marginwidth='0' marginheight='0' scrolling='auto' allow='geolocation'></iframe>  <script type="text/javascript" src="https://form.jotform.com/jsform/222712855164052"></script>
 -->

      <form class="survey-form" method="post" action="">
        <div class="title p-2 pt-4 pb-3 mt-3">
      <h5>Sample Project</h5>
        <h2>Feedback Form</h3>
        </div>
<div class="steps">
	<div class="step current"></div>
	<div class="step"></div>
	<div class="step"></div>
	<div class="step"></div>
</div>

<div class="step-content current" data-step="1">
	<div class="fields">
		<p>How would you rate your experience to the event?</p>
		<div class="rating">
			<input type="radio" name="rating" id="radio1" value="Very Unsatisfied">
			<label for="radio1">1</label>
			<input type="radio" name="rating" id="radio2" value="Unsatisfied">
			<label for="radio2">2</label>
			<input type="radio" name="rating" id="radio3" value="Neutral">
			<label for="radio3">3</label>
			<input type="radio" name="rating" id="radio4" value="Satisfied">
			<label for="radio4">4</label>
			<input type="radio" name="rating" id="radio5" value="Very Satisfied">
			<label for="radio5">5</label>
		</div>
		<div class="rating-footer">
			<span>Very Unsatisfied</span>
			<span>Very Satisfied</span>
		</div>
    <hr>
		<div class="group pt-2">
      <p>Where did you hear about the event?</p>
			<label for="radio6">
				<input type="radio" name="hear_about_us" id="radio6" value="Search Engine">
				JRU Website
			</label>
			<label for="radio7">
				<input type="radio" name="hear_about_us" id="radio7" value="Newsletter">
				Canvas
			</label>
			<label for="radio8">
				<input type="radio" name="hear_about_us" id="radio8" value="Advertisements">
				Social Media
			</label>
			<label for="radio9">
				<input type="radio" name="hear_about_us" id="radio9" value="Social Media">
				other
			</label>
		</div>
	</div>
	<div class="buttons">
		<a href="#" class="btn" data-set-step="2">Next</a>
	</div>
</div>
<!-- page 2 -->
<div class="step-content" data-step="2">
	<div class="fields">
		<p>How likely are you to recommend us?</p>
		<div class="rating">
			<input type="radio" name="recommend" id="radio10" value="Very Unlikely">
			<label for="radio10">1</label>
			<input type="radio" name="recommend" id="radio11" value="Unlikely">
			<label for="radio11">2</label>
			<input type="radio" name="recommend" id="radio12" value="Neutral">
			<label for="radio12">3</label>
			<input type="radio" name="recommend" id="radio13" value="Likely">
			<label for="radio13">4</label>
			<input type="radio" name="recommend" id="radio14" value="Very Likely">
			<label for="radio14">5</label>
		</div>
		<div class="rating-footer">
			<span>Very Unlikely</span>
			<span>Very Likely</span>
		</div>
		<p>How would you like us to respond to you?</p>
		<div class="group">
			<label for="check1">
				<input type="checkbox" name="contact_pref[]" id="check1" value="Email">
				Email
			</label>
			<label for="check2">
				<input type="checkbox" name="contact_pref[]" id="check2" value="Canvas">
				Canvas
			</label>
			<label for="check3">
				<input type="checkbox" name="contact_pref[]" id="check3" value="Messenger">
				Messenger
			</label>
      <label for="check4">
				<input type="checkbox" name="contact_pref[]" id="check4" value="SMS">
				SMS
			</label>
		</div>
	</div>
	<div class="buttons">
		<a href="#" class="btn alt" data-set-step="1">Prev</a>
		<a href="#" class="btn" data-set-step="3">Next</a>
	</div>
</div>

<!-- page 3 -->
<div class="step-content" data-step="3">
	<div class="fields">
		<label for="email">Your Email</label>
		<div class="field">
			<i class="bi bi-envelope"></i>
			<input type="email" class="form-control" id="email" name="email" pattern=".+@my.jru\.edu" title="Please provide a Jose Rizal University e-mail address" required>
		</div>
		<label for="comments">Do you have additional feedback for us?</label>
		<div class="field">
			<textarea id="comments" name="comments" ></textarea>
		</div>
	</div>
	<div class="buttons">
		<a href="#" class="btn alt" data-set-step="2">Prev</a>
		<input type="submit" class="btn" name="submit" value="Submit">
	</div>
</div>

<!-- page 4 -->
<div class="step-content" data-step="4">
	<div class="result"><?=$response?></div>
</div>
		<!-- place code here -->
		</form>

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
    <script>
    const setStep = step => {
    	document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
    	document.querySelector("[data-step='" + step + "']").style.display = "block";
    	document.querySelectorAll(".steps .step").forEach((element, index) => {
    		index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
    		index == step-1 ? element.classList.add("current") : element.classList.remove("current");
    	});
    };
    document.querySelectorAll("[data-set-step]").forEach(element => {
    	element.onclick = event => {
    		event.preventDefault();
    		setStep(parseInt(element.dataset.setStep));
    	};
    });
    <?php if (!empty($_POST)): ?>
    setStep(4);
    <?php endif; ?>
    </script>

</body>

</html>
