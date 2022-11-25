<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn =  $mysqli -> real_escape_string ($_POST['first_name']);
	$ln =  $mysqli -> real_escape_string ($_POST['last_name']);
	$st =  $mysqli -> real_escape_string ($_POST['signatory_type']);
	$si =  $mysqli -> real_escape_string ($_POST['school_id']);
	$e =  $mysqli -> real_escape_string ($_POST['email']);
	$cd =  $mysqli -> real_escape_string ($_POST['college_id']);
  	$oid =  $mysqli -> real_escape_string ($_POST['org_id']);
  	$ul =  $mysqli -> real_escape_string ($_POST['user_type']);
	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `first_name` = '$fn', `last_name` = '$ln', `signatorytype_id` = '$st', `college_dept` = '$cd', `org_id` = '$oid',  `email` = '$e', `usertype_id` = '$ul' WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			if($result)
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Signatory Details",
				"text" => "Successfully updated signatory details.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Signatory Details",
				"text" => "Error upon updating Signatory details.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			if ($st == 1)
			{
				$query = "UPDATE `tb_signatories` SET `first_name` = '$fn', `last_name` = '$ln', `signatorytype_id` = '$st', `college_dept` = NULL, `org_id` = NULL,  `email` = '$e', `usertype_id` = '$ul' WHERE `school_id` = '$si'";
				$result = @mysqli_query($conn, $query);
				if($result)
				{
					$_SESSION["sweetalert"] = [
							"title" => "Update Signatory Details",
							"text" => "Successfully updated signatory details.",
							"icon" => "success", //success,warning,error,info
							"redirect" => null,
							];
				}else
				{
					$_SESSION["sweetalert"] = [
							"title" => "Update Signatory Details",
							"text" => "Error upon updating Signatory details.",
							"icon" => "error", //success,warning,error,info
							"redirect" => null,
							];
				}
			}
		}
	header("Location:admin-signatories-users.php");
}
?>