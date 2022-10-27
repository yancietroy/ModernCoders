<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$ai = $_POST['ADMIN_ID'];
	$fn = $_POST['FIRST_NAME'];
	$ln = $_POST['LAST_NAME'];
	$mn = $_POST['MIDDLE_INITIAL'];
	$e = $_POST['EMAIL'];

	$query = "SELECT * FROM tb_admin";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_admin` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_INITIAL` = '$mn', `EMAIL` = '$e' WHERE `ADMIN_ID` = '$ai'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='admin-profile.php'</script>";		}
}
?>
