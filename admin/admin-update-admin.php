<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn =  $mysqli -> real_escape_string ($_POST['FIRST_NAME']);
	$ln =  $mysqli -> real_escape_string ($_POST['LAST_NAME']);
	$sid =  $mysqli -> real_escape_string ($_POST['ADMIN_ID']);
	$e =  $mysqli -> real_escape_string ($_POST['EMAIL']);

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_admin` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `EMAIL` = '$e' WHERE `ADMIN_ID` = '$sid'";
			$result = @mysqli_query($conn, $query);
			if($result)
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Administrator Details",
				"text" => "Successfully updated Administrator details.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Administrator Details",
				"text" => "Error upon updating Administrator details.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			header("Location:admin-administrators-users.php");
		}
}
?>
