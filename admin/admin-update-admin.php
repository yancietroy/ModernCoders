<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn = $_POST['FIRST_NAME'];
	$ln = $_POST['LAST_NAME'];
	$sid = $_POST['ADMIN_ID'];
	$e = $_POST['EMAIL'];

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_admin` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `EMAIL` = '$e' WHERE `ADMIN_ID` = '$sid'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-administrators-users.php");
		}
}
?>
