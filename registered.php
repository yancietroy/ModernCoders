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
				$age = $_POST['age'];
				$g = $_POST['gender'];
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

				} else if (isset ($_POST['submit']))
					{
						include('mysql_connect.php');
						$query = "INSERT INTO tb_students(FIRST_NAME, LAST_NAME, MIDDLE_NAME, AGE, GENDER, COURSE, EMAIL, PASSWORD) VALUES('$fn', '$ln', '$mn', '$age', '$g', '$course', '$e', SHA('$pass'))";
					$result = @mysqli_query($conn, $query);

	echo "  <h1 class=\"thanks\">You are now registered</h3>";


						mysqli_close($conn);
					}

			?>
</body>
</html>