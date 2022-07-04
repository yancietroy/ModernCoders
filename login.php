<?php
session_start();
if(isset ($_POST['submit']))
{
	include('mysql_connect.php');
	$e = $_POST['email'];
	$p = $_POST['password'];

	if(!empty($_POST['email']) || !empty($_POST['password'])) {
		$query = "SELECT STUDENT_ID FROM tb_students WHERE EMAIL='$e' AND PASSWORD=SHA('$p')";
		$result = @mysqli_query($conn, $query);
		$row = mysqli_fetch_array ($result);

		if($row)
		{
			$_SESSION['use']=$row[0];
			if(isset($_SESSION['use']))   // Checking whether the session is already there or not if
  					                              // true then header redirect it to the home page directly
  			{
				/**echo "<script type='text/javascript'>
					  window.location = 'index.php'
                      </script>";**/
                header("Location:index.php");
  			}
		}
		else
		{
			echo 'The email address and password entered do not match those on file.';
		}
	}
	else
	echo 'Please enter email and/or password...';
	mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>JRU Student Organizations Portal</title>
	<link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg">
	<div id="layoutAuthentication">
			<div id="layoutAuthentication_content">
					<main>
							<div class="container ">
									<div class="row justify-content-center">
										    <div class="col-10 col-lg-5 col-xl-5">
													<div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
															<div class="card-body p-4 text-center">
																<div class="row g-0 justify-content-center mt-2">
																		<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4  d-none d-sm-block">
																				<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
																					</div>
																				<div class="col-xs-12 col-md-4 col-md-offset-3 mb-4 d-none d-sm-block">
																				<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
																						</div>
																						<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4 d-none d-sm-block">
																				<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
																					</div>
														</div>
																<p class="h5 mb-2">JRU Student Organizations Portal</p>
																	<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
																		<h1 class="fs-4 card-title fw-bold mb-3 text-uppercase">Login</h1>

																		<div class="form-floating mb-3">
																			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
																			<label class="text-muted" for="email">Email address</label>
																		</div>

																		<div class="form-floating mb-2">
																			<input type="password" class="form-control" id="password" name="password" value="" placeholder="password" required>
																			<label class=" text-muted " for="password">Password</label>
																		</div>

																		<button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name='submit'>Sign in</button>

																		<hr class="my-4">
																		<p class="mt-3">Don't have an account? <a href="register.php" class="text-blue-50 fw-bold">Register</a>
																		</p>
																	</form>
															</div>

													</div>
											</div>
									</div>
							</div>
					</main>
			</div>
	<!--<section class="vh-100">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-lg mb-4">
						<div class="card-body p-4 text-center">

							<div class="row g-0 justify-content-center">
									<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4">
											<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/csc-logo.png" alt="" width="82" height="80">
												</div>
											<div class="col-xs-12 col-md-4 col-md-offset-3 mb-4">
											<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/jru-logo.png" alt="" width="110" height="110">
													</div>
													<div class="col-xs-12 col-md-3 col-md-offset-3 mb-4">
											<img class="mb-3 mx-auto d-none d-md-block" src="assets/img/comsoc-logo.png" alt="" width="82" height="80">
												</div>
					</div>
							<p class="h5 mb-2">JRU Student Organizations Portal</p>-->
							  <!--form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<form>
									<h1 class="fs-4 card-title fw-bold mb-3 text-uppercase">Login</h1>

									<div class="form-floating mb-3">
										<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
										<label class="text-muted" for="email">Email address</label>
									</div>

									<div class="form-floating mb-2">
										<input type="password" class="form-control" id="password" name="password" value="" placeholder="password" required>
										<label class=" text-muted " for="password">Password</label>
									</div>

									<button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name='submit'>Sign in</button>

									<hr class="my-4">
									<p class="mt-3">Don't have an account? <a href="register.php" class="text-blue-50 fw-bold">Register</a>
									</p>
								</form>

						</div>
					</div>
				</div>
			</div>

		</div>

		<div id="layoutAuthentication_footer">
				<footer class="py-2 bg-light mt-5">
						<div class="container-fluid px-4">
								<div class="d-flex align-items-center justify-content-between small">
										<div class="text-muted">Copyright &copy; Modern Coders 2022</div>
								</div>
						</div>
				</footer>
		</div>!-->
		<script src="js/login.js"></script>
</body>

</html>
