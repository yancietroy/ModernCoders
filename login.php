<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>JRU Student Organizations Portal Login Page</title>
	<link rel="stylesheet" type="text/css" title="stylesheet" href="assets/css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body class="bg">
	<section class="vh-100">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-lg">
						<div class="card-body p-4 text-center">

							<img class="mb-3" src="assets/img/jru-logo.png" alt="" width="92" height="90">
							<p class="h5 mb-2">JRU Student Organizations Portal</p>

							  <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
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
					<div class="text-center mt-5 text-light">
					</div>
				</div>
			</div>
		</div>

		<script src="js/login.js"></script>
		<?php
if(isset ($_POST['submit']))
{
	include('mysql_connect.php');
	$e = $_POST['email'];
	$p = $_POST['password'];

	if(!empty($_POST['email']) || !empty($_POST['password'])) {
		$query = "Select FIRST_NAME , LAST_NAME FROM tb_students WHERE EMAIL='$e' AND PASSWORD=SHA('$p')";
		$result = @mysqli_query($conn, $query);
		$row = mysqli_fetch_array ($result);

		if($row)
		{
			echo "<h1>Welcome!....$row[0] $row[1]</h1><br><br>";
			echo '<a href = "menu.php">Continue';
			exit();
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

</body>

</html>
