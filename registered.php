
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
	$section = $_POST['section'];
	$org = $_POST['org'];
	$e = $_POST['email'];
	$pass = $_POST['password'];

		if ($_POST['password'] !== $_POST['confirmpassword'])
		{
			echo '<script>alert("Password must match!")</script>';
		}
		else if (isset ($_POST['submit']))
		{
			include('../mysql_connect.php');
		ob_start();
			$query = "INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL,  COURSE, SECTION, EMAIL, PASSWORD) VALUES('$si', '$fn', '$ln', '$mn', '$date', '$age', '$g', '$yl', '$course', '$section', '$e', SHA('$pass'))";
			$result = @mysqli_query($conn, $query);
			session_start();
			$_SESSION['message'] = '<script>alert("Register Successful")</script>';

header("Location:login.php");
					@mysqli_close($conn);
			exit();
		}
		else {
			 $msg = "Please fill all fields";
			 	ob_end_flush();
		}
?>
</body>
</html>
