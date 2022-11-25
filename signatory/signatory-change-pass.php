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
			if($result)
			{
				$_SESSION["sweetalert"] = [
					"title" => "Saved!",
					"text" => "Successfully changed your account password.",
					"icon" => "success", //success,warning,error,info
					"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
				"title" => "Error",
				"text" => "Change password error.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			header("Location:signatory-profile.php");
		}
	}
	?>
