<?php
ob_start();
session_start();
$officer_id = $_SESSION['use'];
include('../mysql_connect.php');
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

<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM tb_survey_questions where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-question">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-6 border-right">
						<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
						<input type="hidden" name="sid" value="<?php echo isset($_GET['sid']) ? $_GET['sid'] : '' ?>">
						<div class="form-group">
							<label for="" class="control-label">Question</label>
							<textarea name="question" id="" cols="30" rows="4" class="form-control"><?php echo isset($question)? $question: '' ?></textarea>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Question Answer Type</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<?php if(isset($id)): ?>
								<option value="" disabled="" selected="">Please Select here</option>
								<?php endif; ?>
								<option value="radio_opt" <?php echo isset($type) && $type == 'radio_opt' ? 'selected':'' ?>>Single Answer/Radio Button</option>
								<option value="check_opt" <?php echo isset($type) && $type == 'check_opt' ? 'selected':'' ?>>Multiple Answer/Check Boxes</option>
								<option value="textfield_s" <?php echo isset($type) && $type == 'textfield_s' ? 'selected':'' ?>>Text Field/ Text Area</option>
							</select>
						</div>

				</div>
				<div class="col-sm-6">
					<b>Preview</b>
					<div class="preview">
						<?php if(!isset($id)): ?>
						<center><b>Select Question Answer type first.</b></center>
						<?php else: ?>
							<div class="callout callout-info">
							<?php if($type != 'textfield_s'):
								$opt= $type =='radio_opt' ? 'radio': 'checkbox';
							?>
						      <table width="100%" class="table">
						      	<colgroup>
						      		<col width="10%">
						      		<col width="80%">
						      		<col width="10%">
						      	</colgroup>
						      	<thead>
							      	<tr class="">
								      	<th class="text-center"></th>

								      	<th class="text-center">
								      		<label for="" class="control-label">Label</label>
								      	</th>
								      	<th class="text-center"></th>
							     	</tr>
						     	</thead>
						     	<tbody>
						     		<?php
						     		$i = 0;
						     		foreach(json_decode($frm_option) as $k => $v):
						     			$i++;
						     		?>
						     		<tr class="">
								      	<td class="text-center">
								      		<div class="icheck-primary d-inline" data-count = '<?php echo $i ?>'>
									        	<input type="<?php echo $opt ?>" id="<?php echo $opt ?>Primary<?php echo $i ?>" name="<?php echo $opt ?>" checked="">
									        	<label for="<?php echo $opt ?>Primary<?php echo $i ?>">
									        	</label>
									        </div>
								      	</td>

								      	<td class="text-center">
								      		<input type="text" class="form-control form-control-sm check_inp"  name="label[]" value="<?php echo $v ?>">
								      	</td>
								      	<td class="text-center"></td>
							     	</tr>
						     		<?php  endforeach; ?>

						     	</tbody>
						      </table>
						      <div class="row">
						      <div class="col-sm-12 text-center">
						      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="<?php echo $type ?>($(this))"><i class="fa fa-plus"></i> Add</button>
						      </div>
						      </div>
						    </div>
						</div>

						<?php else: ?>
								<textarea name="frm_opt" id="" cols="30" rows="10" class="form-control" disabled="" placeholder="Write Something here..."></textarea>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="check_opt_clone"  style="display: none">
	<div class="callout callout-info">
      <table width="100%" class="table">
      	<colgroup>
      		<col width="10%">
      		<col width="80%">
      		<col width="10%">
      	</colgroup>
      	<thead>
	      	<tr class="">
		      	<th class="text-center"></th>

		      	<th class="text-center">
		      		<label for="" class="control-label">Label</label>
		      	</th>
		      	<th class="text-center"></th>
	     	</tr>
     	</thead>
     	<tbody>
     		<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '1'>
			        	<input type="checkbox" id="checkboxPrimary1" checked="">
			        	<label for="checkboxPrimary1">
			        	</label>
			        </div>
		      	</td>

		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp" name="label[]">
		      	</td>
		      	<td class="text-center"></td>
	     	</tr>
	     	<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '2'>
			        	<input type="checkbox" id="checkboxPrimary2" >
			        	<label for="checkboxPrimary2">
			        	</label>
			        </div>
		      	</td>

		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp" name="label[]">
		      	</td>
		      	<td class="text-center"></td>
	     	</tr>
     	</tbody>
      </table>
      <div class="row">
      <div class="col-sm-12 text-center">
      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_check($(this))"><i class="fa fa-plus"></i> Add</button>
      </div>
      </div>
    </div>
</div>
<div id="radio_opt_clone" style="display: none">
	<div class="callout callout-info">
      <table width="100%" class="table">
      	<colgroup>
      		<col width="10%">
      		<col width="80%">
      		<col width="10%">
      	</colgroup>
      	<thead>
	      	<tr class="">
		      	<th class="text-center"></th>

		      	<th class="text-center">
		      		<label for="" class="control-label">Label</label>
		      	</th>
		      	<th class="text-center"></th>
	     	</tr>
     	</thead>
     	<tbody>
     		<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '1'>
			        	<input type="radio" id="radioPrimary1" name="radio" checked="">
			        	<label for="radioPrimary1">
			        	</label>
			        </div>
		      	</td>

		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp"  name="label[]">
		      	</td>
		      	<td class="text-center"></td>
	     	</tr>
	     	<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '2'>
			        	<input type="radio" id="radioPrimary2" name="radio" >
			        	<label for="radioPrimary2">
			        	</label>
			        </div>
		      	</td>

		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp"  name="label[]">
		      	</td>
		      	<td class="text-center"></td>
	     	</tr>
     	</tbody>
      </table>
      <div class="row">
      <div class="col-sm-12 text-center">
      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Add</button>
      </div>
      </div>
    </div>
</div>
<div id="textfield_s_clone" style="display: none">
	<div class="callout callout-info">
		<textarea name="frm_opt" id="" cols="30" rows="10" class="form-control" disabled=""  placeholder="Write Something here..."></textarea>
	</div>
</div>
<script>
	function new_check(_this){
		var tbody=_this.closest('.row').siblings('table').find('tbody')
		var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count')
			count++;
		console.log(count)
		var opt = '';
			opt +='<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count = "'+count+'"><input type="checkbox" id="checkboxPrimary'+count+'"><label for="checkboxPrimary'+count+'"> </label></div></td>';
			opt +='<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="label[]"></td>';
			opt +='<td class="text-center"><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><span class="fa fa-times" ></span></a></td>';
		var tr = $('<tr></tr>')
		tr.append(opt)
		tbody.append(tr)
	}
	function new_radio(_this){
		var tbody=_this.closest('.row').siblings('table').find('tbody')
		var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count')
			count++;
		console.log(count)
		var opt = '';
			opt +='<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count = "'+count+'"><input type="radio" id="radioPrimary'+count+'" name="radio"><label for="radioPrimary'+count+'"> </label></div></td>';
			opt +='<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="label[]"></td>';
			opt +='<td class="text-center"><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><span class="fa fa-times" ></span></a></td>';
		var tr = $('<tr></tr>')
		tr.append(opt)
		tbody.append(tr)
	}
	function check_opt(){
		var check_opt_clone = $('#check_opt_clone').clone()
		$('.preview').html(check_opt_clone.html())
	}
	function radio_opt(){
		var radio_opt_clone = $('#radio_opt_clone').clone()
		$('.preview').html(radio_opt_clone.html())
	}
	function textfield_s(){
		var textfield_s_clone = $('#textfield_s_clone').clone()
		$('.preview').html(textfield_s_clone.html())
	}
	$('[name="type"]').change(function(){
		window[$(this).val()]()
	})
	$(function () {
	$('#manage-question').submit(function(e){
		e.preventDefault()
		start_load()
		// $('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_question',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})

  })
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
