<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$si = $_POST['STUDENT_ID'];
	$fn = $_POST['FIRST_NAME'];
	$ln = $_POST['LAST_NAME'];
	$mn = $_POST['MIDDLE_NAME'];
	$bdate = $_POST['BIRTHDATE'];
	$age = $_POST['AGE'];
	$e = $_POST['EMAIL'];

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_students` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_NAME` = '$mn', `BIRTHDATE` = '$bdate', `AGE` = '$age', `EMAIL` = '$e' WHERE `STUDENT_ID` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='student-profile.php'</script>";		}
}
?>
