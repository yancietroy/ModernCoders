<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['changePassword']))
{
	$si = $_POST['cid'];
	$pass = $_POST['password'];

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `password` = SHA('$pass') WHERE `tb_signatories` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='signatory-profile.php'</script>";
		}
}
?>
