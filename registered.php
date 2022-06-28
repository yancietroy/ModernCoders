<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registered</title>
</head>
<body>
<?php
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$mn = $_POST['middle_name'];
	$date = $_POST['birthdate'];
	$age = $_POST['age'];
	$g = $_POST['gender'];
	$si = $_POST['studentid'];
	$yl = $_POST['school_year'];
	$course = $_POST['course'];
	$org = $_POST['org'];
	$e = $_POST['email'];
	$pass = $_POST['password'];

		if ($_POST['password'] !== $_POST['confirmpassword'])
		{
			echo "Password must MATCH!
					<br><br>
					<a href='register.php'>
					<input type='button' name='back' value='Back to registration.'>
					</a>";
		} 
		else if (isset ($_POST['submit']))
		{
			include('mysql_connect.php');
			$query = "INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL,  COURSE, EMAIL, PASSWORD) VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$course', '$e', SHA('$pass'))";
			$result = @mysqli_query($conn, $query);

			echo "  <h3>You are now registered</h3>";
					@mysqli_close($conn);
		}
					echo "<pre>";
					print_r($_POST);
					echo "</pre>";
?>
</body>
</html>