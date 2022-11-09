<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(0);

if (isset ($_POST['changePassword']))
{
	$si = $_POST['cid'];
	$pass =  $mysqli -> real_escape_string ($_POST['PASSWORD']);

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
