<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(1);

if (isset ($_POST['updatedata']))
{
	$si =  $mysqli -> real_escape_string ($_POST['STUDENT_ID']);
	$fn =  $mysqli -> real_escape_string ($_POST['FIRST_NAME']);
	$ln =  $mysqli -> real_escape_string ($_POST['LAST_NAME']);
	$mn =  $mysqli -> real_escape_string ($_POST['MIDDLE_NAME']);
	$bdate =  $mysqli -> real_escape_string ($_POST['BIRTHDATE']);
	$age =  $mysqli -> real_escape_string ($_POST['AGE']);
	$e =  $mysqli -> real_escape_string ($_POST['EMAIL']);

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_students` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_NAME` = '$mn', `BIRTHDATE` = '$bdate', `AGE` = '$age', `EMAIL` = '$e' WHERE `STUDENT_ID` = '$si'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['USER-NAME'] = $fn . ' ' . $ln;
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='student-profile.php'</script>";		}
}
