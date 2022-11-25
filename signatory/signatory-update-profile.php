<?php
include('../mysql_connect.php');
session_start();

include('../router.php');
route(3);

if (isset ($_POST['updatedata']))
{
	$si =  $mysqli -> real_escape_string ($_POST['school_id']);
	$fn =  $mysqli -> real_escape_string ($_POST['first_name']);
	$ln =  $mysqli -> real_escape_string ($_POST['last_name']);

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row)
	{
		$query = "UPDATE `tb_signatories` SET  `first_name` = '$fn', `last_name` = '$ln' WHERE `school_id` = '$si'";
		$result = @mysqli_query($conn, $query);
		$_SESSION['USER-NAME'] = $fn . ' ' . $ln;
		if($result){
			$_SESSION["sweetalert"] = [
				"title" => "Edit Account",
				"text" => "Successfully updated your account information.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
		}else{
			$_SESSION["sweetalert"] = [
				"title" => "Edit Account",
				"text" => "There was an error upon updating your account information.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
		}
		header("location:signatory-profile.php");
	}
}
?>