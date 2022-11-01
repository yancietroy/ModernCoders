<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(2);

if (isset ($_POST['changePassword']))
{
	$si = $_POST['cid'];
	$pass = $_POST['password'];

	$query = "SELECT * FROM tb_officers";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_officers` SET `password` = SHA('$pass') WHERE `officer_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='officer-profile.php'</script>";
		}
}
