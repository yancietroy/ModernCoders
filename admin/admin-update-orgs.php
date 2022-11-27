<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $ci = $_POST["ORG_ID"];
    $c =  $mysqli -> real_escape_string ($_POST["ORG"]);
    $s =  $mysqli -> real_escape_string ($_POST["status"]);
    $query = "SELECT * FROM tb_orgs";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_orgs` SET `ORG` = '$c', `status` = '$s' WHERE `ORG_ID` = '$ci'";
			$result = @mysqli_query($conn, $query);
			$_SESSION["sweetalert"] = [
			"title" => "Update Org Details",
			"text" => "Successfully updated $c\'s details.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
	} else {
		$_SESSION["sweetalert"] = [
			"title" => "Update Org Details",
			"text" => "Unexpected error while updating $c\'s details.",
			"icon" => "error", //success,warning,error,info
			"redirect" => null,
		];
	}
	header("Location:admin-orgs.php");
}
?>
