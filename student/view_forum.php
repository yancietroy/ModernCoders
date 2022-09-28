<? php
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
<!-- calendar
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script> !-->
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
        <li class="active">
          <a href="student-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="election-student-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="user-survey.php"><i class="bi bi-list-ul"></i></i> <span>Survey</span></a>
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
                  <img class="rounded-circle me-lg-2" src="../assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><? /*php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_students WHERE STUDENT_ID = '$id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } */?></span></a>
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
          <li class="breadcrumb-item"><a href="student-orgs.php">  Organizations</a></li>
          <li class="breadcrumb-item"><a href="comsoc.php">  COMSOC</a></li>
          <li class="breadcrumb-item"><a href="forum-user.php">  Discussion Forum</a></li>
          <li class="breadcrumb-item active" id="active" aria-current="page">View Forum</li>
        </ol>
      </nav>
      <!-- Page content -->

      <!-- Page content -->
      <div class="container-field">
      	<div class="col-lg-12">
      		<div class="card">
      			<div class="card-body">
      				<? /*php if($_SESSION['login_id'] == $row['user_id'] || $_SESSION['login_type'] == 1): */?>
                          <div class="dropleft float-right mr-4" style="position: relative;">
                            <a class="text-dark" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="fa fa-ellipsis-v"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item edit_topic" data-id="<? /*php echo $id */?>" href="javascript:void(0)">Edit</a>
                              <a class="dropdown-item delete_topic" data-id="<? /*php echo $id */?>" href="javascript:void(0)">Delete</a>
                            </div>
                          </div>
                      <? /*php endif; */?>
                      <span class="float-right mr-4"><small><i><? /*php echo date('M d, Y h:i A',strtotime($date_created)) */?></i></small></span>
                       <span class="float-right mr-4 text-primary"><small><i>Posted By: <? /*php echo ucwords($name) */?></i></small></span>
                       <div class="col-md-8">
      					<h4><b><? /*php echo $title */?></b></h4>
      				</div>
      			<!--	<? /*php if(count($tags) > 0): */ ?>-->
      				<div>
      					<span class="badge badge-default"><i class="fa fa-tags"></i> Tags: </span>
      				<? /*php foreach(explode(',',$category_ids) as $t): */?>
      					<span class="badge badge-info text-white"><? /*php echo $tags[$t] */?></span>
      				<? /*php endforeach; */?>

      				</div>
      				<? /*php endif; */?>
      				<hr>
      				<div class="w-100">
      				<span class="badge badge-secondary text-white"><? /*php echo number_format($view) */?> view/s</span>
      				<span class="badge badge-primary text-white ml-2"><i class="fa fa-comments"></i> <? /*php echo number_format(count($com_arr)) */?> comment/s</span>
      				</div>
      				<div id="content" class="w-100 mt-4">
      					<? /*php echo html_entity_decode($content) */?>
      				</div>
      			</div>
      		</div>
      		<div class="card">
      			<div class="card-body">
          		<div class="col-lg-12">
          			<div class="row">
          				<h3><b> <i class="fa fa-comments"></i> Comment/s</b></h3>
          			</div>
          			<hr class="divider" style="max-width: 100%">
          			<? /*php
          			foreach($com_arr as $row):
          			*/?>
          			<div class="form-group comment">
                          <? /*php if($_SESSION['login_id'] == $row['user_id']): */?>
                          <div class="dropleft float-right">
                            <a class="text-dark" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="fa fa-ellipsis-v"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item edit_comment" data-id="<? /*php echo $row['id'] */?>" href="javascript:void(0)">Edit</a>
                              <a class="dropdown-item delete_comment" data-id="<? /*php echo $row['id'] */?>" href="javascript:void(0)">Delete</a>
                            </div>
                          </div>
                          <? /*php endif; */?>
      	                <span class="float-right mr-4"><small><i>Created: <? /*php echo date('M d, Y h:i A',strtotime($row['date_created'])) */?></i></small></span>

          				<p class="mb-0"><large><b><? /*php echo $row['name'] */?></b></large>  <span class="text-primary"><small class="mb-0"><i><? /*php echo $row['username'] */?></i></small></span></p>

          				<br>
          				<? /*php echo html_entity_decode($row['comment']) */?>
          				<div>
          				<!--	<span><button class="btn btn-default btn-sm c_reply" data-id='<? /*php echo $row['id'] */?>'><i class="fa fa-reply"></i></button></span>!-->
          					<span class="text-primary ml-4"><!--<? /*php echo isset($rep_arr[$row['id']]) ? count($rep_arr[$row['id']]).(count($rep_arr[$row['id']]) > 1? ' Replies':' Replied') : '' */?>!--></span>

          					<? /*php if(isset($rep_arr[$row['id']])): */?>
          						<hr>
          					<div class="col-lg-8 offset-lg-2 replies">
          						<a href="javascript:void(0)" class="show_all" style="display: none">Show all replies</a>
          						<? /*php

          							foreach($rep_arr[$row['id']] as $rep):
          						*/?>
          						<div class="form-group ty-compact-list">
      			                    <? /*php if($_SESSION['login_id'] == $rep['user_id']): */?>
      			                    <div class="dropleft float-right">
      			                      <a class="text-dark" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      			                        <span class="fa fa-ellipsis-v"></span>
      			                      </a>
      			                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      			                        <a class="dropdown-item edit_reply" data-id="<? /*php echo $rep['id'] */?>" href="javascript:void(0)">Edit</a>
      			                        <a class="dropdown-item delete_reply" data-id="<? /*php echo $rep['id'] */?>" href="javascript:void(0)">Delete</a>
      			                      </div>
      			                    </div>
      			                    <? /*php endif; */?>
      				                <span class="float-right mr-4"><small><i>Created: <? /*php echo date('M d, Y h:i A',strtotime($rep['date_created'])) */?></i></small></span>

      			    				<p class="mb-0"><large><b><? /*php echo $rep['name'] */?></b></large>  <span class="text-primary"><small class="mb-0"><i><? /*php echo $rep['username'] */?></i></small></span></p>

      			    				<br>
      			    				<? /*php echo html_entity_decode($rep['reply']) */?>
      			    				<hr>
      			    			</div>
          					<? /*php endforeach; */?>
          					</div>
          					<? /*php endif; */?>

          				</div>
          				<hr>
          			</div>
          		<? /*php endforeach; */?>
          		</div>
          			<hr class="divider" style="max-width: 100%">
          			<div class="col-lg-12">
          				<form action="" id="manage-comment">
          					<div class="form-group">
          						<input type="hidden" name="id" value="">
          						<input type="hidden" name="topic_id" value="<? /*php echo isset($id) ? $id : '' */?>">
          						<textarea class="form-control jqte" id="comment-txt" name="comment" cols="30" rows="5" placeholder="New Comment"></textarea>
          					</div>
          					<button class="btn btn-primary">Save Comment</button>
          				</form>
          			</div>
          	</div>
      		</div>
      		</div>
      	</div>
      </div>
      <div id="reply_clone" style="display: none;">
      	<div class="col-lg-8 offset-lg-2 reply-field">
      		<hr>
      		<form action="" id="">
      			<div class="form-group">
      				<input type="hidden" name="id" value="">
      				<input type="hidden" name="comment_id" value="">
      				<textarea class="form-control" name="" cols="30" rows="5" placeholder="New Reply"></textarea>
      			</div>
      			<button class="btn btn-primary">Reply</button>
      		</form>
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
</body>

</html>
