<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset($_POST['updatedata'])) {

	$ci = $_POST["college_id"];
	$c =  $mysqli->real_escape_string($_POST["college"]);
	$query = "SELECT * FROM tb_collegedept";
	$result = @mysqli_query($conn, $query);
	$row = @mysqli_fetch_array($result);

	if ($row) {
		$query = "UPDATE `tb_collegedept` SET `college` = '$c' WHERE `college_id` = '$ci'";
		$result = @mysqli_query($conn, $query);
		$_SESSION["sweetalert"] = [
			"title" => "Update College Details",
			"text" => "Successfully updated $c\'s details.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
	} else {
		$_SESSION["sweetalert"] = [
			"title" => "Update College Details",
			"text" => "Unexpected error while updating $c\'s details.",
			"icon" => "error", //success,warning,error,info
			"redirect" => null,
		];
	}

	header("Location:admin-college.php");
}
