<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['changePassword']))
{
	$si = $_POST['cid'];
	$pass = $_POST['PASSWORD'];

	$query = "SELECT * FROM tb_admin";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_admin` SET `PASSWORD` = SHA('$pass') WHERE `ADMIN_ID` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='admin-profile.php'</script>";
		}
}
?>
