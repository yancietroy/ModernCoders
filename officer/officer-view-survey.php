<?php
ob_start();
session_start();
$officer_id = $_SESSION['use'];
$orgid = $_SESSION['org'];
include('../mysql_connect.php'); include('profilepic.php'); include('../assets/img/orglogopics.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
}
  else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../../officer-login.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JRU Student Organizations Portal Officer</title>
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
        <a class="navbar-brand" href="officer-index.php">
          <img src="../assets/img/jru-logo.png" alt="..." width="90" height="90">
        </a>
      </div>
      <div class="sidebar-heading mt-3 text-center">

        <h5 class="mt-2 mb-3 p-0 ">JRU Student Organizations Portal Officer</h5>
      </div>

      <ul class="list-unstyled components p-2">

        <li class="active">
          <a href="officer-index.php"> <i class="bi bi-house-fill"></i> <span>Home</span></a>

        </li>
        <li>
          <a href="officer-orgs.php"> <i class="bi bi-people-fill"></i> <span>Organizations</span></a>
        </li>
        <li>
          <a href="officer-projects.php"> <i class="bi bi-folder-fill"></i> <span>Projects</span></a>
        </li>
        <li>
          <a href="election-index.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="officer-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
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
                  <img class="rounded-circle me-lg-2" src="../assets/img/img_avatar.png" alt="" style="width: 40px; height: 40px;border: 2px solid #F2AC1B;">
                  <span class="d-none d-lg-inline-flex"><?php $query = "SELECT CONCAT(FIRST_NAME, ' ', LAST_NAME) AS name FROM tb_Officers WHERE officer_ID = '$officer_id'";
                  $result = @mysqli_query($conn, $query);
                  $row = mysqli_fetch_array ($result);
                  if ($row)
                  { echo "$row[0]"; } ?></span></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="officer-profile.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../officer-login.php">Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Page content -->

      <div class="col-lg-12">
      	<div class="row">
      		<div class="col-md-4">
      			<div class="card card-outline card-primary">
      				<div class="card-header">
      					<h3 class="card-title">Survey Details</h3>
      				</div>
              <?php 
              $qry = $conn->query("SELECT * FROM tb_survey_set where id = ".$_GET['id'])->fetch_array();
              foreach($qry as $k => $v){
                if($k == 'title')
                  $k = 'stitle';
                $$k = $v;
                
              }
              $answers = $conn->query("SELECT distinct(user_id) from tb_answers where survey_id =".$id)->num_rows;
              ?>
      				<div class="card-body p-0 py-2">
      					<div class="container-fluid">
      						<p>Title: <b><?php echo $stitle ?></b></p>
      						<p class="mb-0">Description:</p>
      						<small><?php echo $description; ?></small>
      						<p>Start: <b><?php echo date("M d, Y",strtotime($start_date)) ?></b></p>
      						<p>End: <b><?php echo date("M d, Y",strtotime($end_date)) ?></b></p>
      						<p>Have Taken: <b><?php echo number_format($answers) ?></b></p>

      					</div>
      					<hr class="border-primary">
      				</div>
      			</div>
      		</div>
      		<div class="col-md-8">
      			<div class="card card-outline card-success">
      				<div class="card-header">
      					<h3 class="card-title"><b>Survey Questionaire</b></h3>
      					<div class="card-tools">
      						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_question" type="button"><i class="fa fa-plus"></i> Add New Question</button>
      					</div>
      				</div>
      				<form action="" id="manage-sort">
      				<div class="card-body ui-sortable">
      					<?php
      					$question = $conn->query("SELECT * FROM tb_questions where survey_id = $id order by abs(order_by) asc,abs(id) asc");
      					while($row=$question->fetch_assoc()):
      					?>
      					<div class="callout callout-info">
      						<div class="row">
      							<div class="col-md-12">
      								<span class="dropleft float-right">
      									<a class="fa fa-ellipsis-v text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
      									<div class="dropdown-menu" style="">
      								        <a class="dropdown-item edit_question text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
      								        <div class="dropdown-divider"></div>
      								        <a class="dropdown-item delete_question text-dark" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
      								     </div>
      								</span>
      							</div>
      						</div>
      						<h5><?php echo $row['question'] ?></h5>
      						<div class="col-md-12">
      						<input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">
      							<?php
      								if($row['type'] == 'radio_opt'):
      									foreach(json_decode($row['frm_option']) as $k => $v):
      							?>
      							<div class="icheck-primary">
      		                        <input type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $k ?>" checked="">
      		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
      		                     </div>
      								<?php endforeach; ?>
      						<?php elseif($row['type'] == 'check_opt'):
      									foreach(json_decode($row['frm_option']) as $k => $v):
      							?>
      							<div class="icheck-primary">
      		                        <input type="checkbox" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>][]" value="<?php echo $k ?>" >
      		                        <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
      		                     </div>
      								<?php endforeach; ?>
      						<?php else: ?>
      							<div class="form-group">
      								<textarea name="answer[<?php echo $row['id'] ?>]" id="" cols="30" rows="4" class="form-control" placeholder="Write Something Here..."></textarea>
      							</div>
      						<?php endif; ?>
      						</div>
      					</div>
      					<?php endwhile; ?>
      				</div>
      				</form>
      			</div>
      		</div>
      	</div>
      </div>
      <script>
      	$(document).ready(function(){
      		$('.ui-sortable').sortable({
      			placeholder: "ui-state-highlight",
      			 update: function( ) {
      			 	alert_toast("Saving question sort order.","info")
      		        $.ajax({
      		        	url:"ajax.php?action=action_update_qsort",
      		        	method:'POST',
      		        	data:$('#manage-sort').serialize(),
      		        	success:function(resp){
      		        		if(resp == 1){
      			 				alert_toast("Question order sort successfully saved.","success")
      		        		}
      		        	}
      		        })
      		    }
      		})
      	})
      	$('.new_question').click(function(){
      		uni_modal("New Question","officer-managequestions-survey.php?sid=<?php echo $id ?>","large")
      	})
      	$('.edit_question').click(function(){
      		uni_modal("New Question","officer-managequestions-survey.php?sid=<?php echo $id ?>&id="+$(this).attr('data-id'),"large")
      	})

      	$('.delete_question').click(function(){
      	_conf("Are you sure to delete this question?","delete_question",[$(this).attr('data-id')])
      	})
      	function delete_question($id){
      		start_load()
      		$.ajax({
      			url:'ajax.php?action=delete_question',
      			method:'POST',
      			data:{id:$id},
      			success:function(resp){
      				if(resp==1){
      					alert_toast("Data successfully deleted",'success')
      					setTimeout(function(){
      						location.reload()
      					},1500)

      				}
      			}
      		})
      	}
      </script>
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
