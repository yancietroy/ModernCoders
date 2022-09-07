<?php
include('mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$st = $_POST['signatory_type'];
	$si = $_POST['school_id'];
	$e = $_POST['email'];

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = @mysqli_fetch_array($result);
			
		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `first_name` = '$fn', `last_name` = '$ln', `signatory_type` = '$st',  `email` = '$e' WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-signatories.php");
		}
}
?>