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
    header("Location:../admin-login.php");
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

  <!-- Icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">

</head>

<style>
a:hover {
  color:#F2AC1B;
}
</style>
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

        <li>
          <a href="admin-index.php"><i class="bi bi-house-fill"></i> <span>Home</span></a>
        </li>
        <li>
          <a href="#pageSubmenu" data-bs-toggle="collapse" href="#pageSubmenu" aria-expanded="false" class="dropdown-toggle"> <i class="bi bi-people-fill"></i> <span>User Management</span></a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="admin-students.php"><i class="bi bi-person-badge"></i> <span>Students</span></a>
            </li>
            <li>
              <a href="admin-officers.php"><i class="bi bi-file-earmark-person"></i> <span>Officers</span></a>
            </li>
            <li>
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
              <a href="admin-orgs.php"><i class="fas fa-briefcase"></i> <span>Organizations</span></a>
          </li>
          <li>
              <a href="admin-projects.php"><i class="fas fa-copy"></i> <span>Projects</span></a>
          </li>
          <li>
              <a href="admin-forums.php"><i class="bi bi-inbox-fill"></i> <span>Forums</span></a>
            </li>
        </ul>
        </li>
        <li class="active">
          <a href="admin-election.php"><i class="bi bi-check2-square"></i> <span>Election</span></a>
        </li>
        <li>
          <a href="admin-survey.php"><i class="bi bi-file-bar-graph-fill"></i> <span>Survey</span></a>
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
                  <i class="fa fa-bell me-lg-2 mt-2" style="width:  25px; height:  25px;"></i>
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
                        <li><a class="dropdown-item" href="../admin-login.php">Logout</a></li>
                      </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin-index.php"><i class="bi bi-house-fill"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="admin-election.php"><i class="bi bi-check2-square"></i> Election</a></li>
    <li class="breadcrumb-item active" id="active" aria-current="page">  <i class="bi bi-clipboard-data-fill"></i> Election List</li>
  </ol>
</nav>

      <!-- Page content -->
      <h4 class="ms-3 mb-4">Election List</h4>

  <style>
  	.update_default{
  		cursor: pointer;
  	}
  </style>
  <div class="container-fluid">

  	<div class="col-lg-12">
  		<div class="row">
  			<!-- FORM Panel -->
  			<div class="col-md-4">
  			<form action="" id="manage-voting">
  				<div class="card">
  					<div class="card-header">
  						    Create election poll
  				  	</div>
  					<div class="card-body">
  							<input type="hidden" name="id">
  							<div class="form-group">
  								<label class="control-label">Title</label>
  								<input type="text" class="form-control" name="title">
  							</div>
  					</div>
  					<div class="card-body">
  							<div class="form-group">
  								<label class="control-label">Description</label>
  								<textarea class="form-control" name="description"></textarea>
  							</div>
  					</div>
  					<div class="card-footer">
  						<div class="row">
  							<div class="col-md-12">
  								<button class="btn btn-sm btn-primary"> Save</button>
  								<button class="btn btn-sm btn-default" type="button" onclick="$('#manage-voting').get(0).reset()"> Cancel</button>
  							</div>
  						</div>
  					</div>
  				</div>
  			</form>
  			</div>
  			<!-- FORM Panel -->

  			<!-- Table Panel -->
  			<div class="col-md-8">
  				<div class="card">
  					<div class="card-body">
  						<table class="table table-bordered table-hover">
  							<colgroup>
  								<col width="5%">
  								<col width="30%">
  								<col width="35%">
  								<col width="10%">
  								<col width="20%">
  							</colgroup>
  							<thead>
  								<tr>
  									<th class="text-center">#</th>
  									<th class="text-center">Title</th>
  									<th class="text-center">Descrition</th>
  									<th class="text-center">Default</th>
  									<th class="text-center">Action</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?php
  								$i = 1;
  								$vote = $conn->query("SELECT * FROM voting_list order by id asc");
  								while($row=$vote->fetch_assoc()):
  								?>
  								<tr>
  									<td class="text-center"><?php echo $i++ ?></td>
  									<td class=""><a href="index.php?page=manage_voting&id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></td>
  									<td class=""><?php echo $row['description'] ?></td>
  									<?php if($row['is_default'] == 1): ?>
  										<td class="text-center"><div class="badge badge-success">Yes</div></td>
  									<?php elseif($row['is_default'] == 0):  ?>
  										<td class="text-center"><div class="badge badge-info update_default" data-id="<?php echo $row['id'] ?>">No</div></td>
  									<?php endif; ?>
  									<td class="text-center">
  										<button class="btn btn-sm btn-primary edit_voting" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
  										<button class="btn btn-sm btn-danger delete_voting" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
  									</td>
  								</tr>
  								<?php endwhile; ?>
  							</tbody>
  						</table>
  					</div>
  				</div>
  			</div>
  			<!-- Table Panel -->
  		</div>
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
  </div>

  <script>
  	$('#manage-voting').submit(function(e){
  		e.preventDefault()
  		start_load()
  		$.ajax({
  			url:'ajax.php?action=save_voting',
  			method:'POST',
  			data:$(this).serialize(),
  			success:function(resp){
  				if(resp==1){
  					alert_toast("Data successfully added",'success')
  					setTimeout(function(){
  						location.reload()
  					},1500)

  				}
  				else if(resp==2){
  					alert_toast("Data successfully updated",'success')
  					setTimeout(function(){
  						location.reload()
  					},1500)

  				}
  			}
  		})
  	})
  	$('.edit_voting').click(function(){
  		start_load()
  		var cat = $('#manage-voting')
  		var _this = $(this)
  		cat.get(0).reset()
  		$.ajax({
  			url:'ajax.php?action=get_voting',
  			method:'POST',
  			data:{id:_this.attr('data-id')},
  			success:function(resp){
  				if(typeof resp != undefined){

  					resp = JSON.parse(resp)
  					cat.find('[name="id"]').val(_this.attr('data-id'))
  					cat.find('[name="title"]').val(resp.title)
  					cat.find('[name="description"]').val(resp.description)
  					end_load()
  				}
  			}
  		})
  	})
  	$('.update_default').click(function(){
  		_conf("Are you sure to set this data as default?","update_default",[$(this).attr('data-id')])

  	})
  	$('.delete_voting').click(function(){
  		_conf("Are you sure to delete this data?","delete_voting",[$(this).attr('data-id')])
  	})
  	function update_default($id){
  		start_load()
  		$.ajax({
  			url:'ajax.php?action=update_voting',
  			method:'POST',
  			data:{id:$id},
  			success:function(resp){
  				if(resp == 1){
  					alert_toast("Data successfully updated",'success')
  					setTimeout(function(){
  						location.reload()
  					},1500)
  				}
  			}
  		})
  	}
  	function delete_voting($id){
  		start_load()
  		$.ajax({
  			url:'ajax.php?action=delete_voting',
  			method:'POST',
  			data:{id:$id},
  			success:function(resp){
  				if(resp == 1){
  					alert_toast("Data successfully deleted",'success')
  					setTimeout(function(){
  						location.reload()
  					},1500)

  				}
  			}
  		})
  	}
  </script>
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
