<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(0);

if (isset($_POST['changePassword'])) {
	$si = $mysqli->real_escape_string($_POST['cid']);
	$pass =  $mysqli->real_escape_string($_POST['password']);

	$query = "SELECT * FROM tb_admin";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if ($row) {
		$query = "UPDATE `tb_admin` SET `PASSWORD` = SHA('$pass') WHERE `ADMIN_ID` = '$si'";
		$result = @mysqli_query($conn, $query);
		$_SESSION["sweetalert"] = [
			"title" => "Saved!",
			"text" => "Successfully changed your account password.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
	}
}
