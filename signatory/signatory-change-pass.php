<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(3);

if (isset ($_POST['changePassword']))
{
	$si =  $mysqli -> real_escape_string ($_POST['cid']);
	$pass =  $mysqli -> real_escape_string ($_POST['password']);

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `password` = SHA('$pass') WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='signatory-profile.php'</script>";
		}
}
