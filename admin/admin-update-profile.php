<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset($_POST['updatedata'])) {
	$ai =  $mysqli->real_escape_string($_POST['ADMIN_ID']);
	$fn =  $mysqli->real_escape_string($_POST['FIRST_NAME']);
	$ln =  $mysqli->real_escape_string($_POST['LAST_NAME']);
	$mn =  $mysqli->real_escape_string($_POST['MIDDLE_INITIAL']);
	$e =  $mysqli->real_escape_string($_POST['EMAIL']);

	$query = "SELECT * FROM tb_admin";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if ($row) {
		$query = "UPDATE `tb_admin` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_INITIAL` = '$mn', `EMAIL` = '$e' WHERE `ADMIN_ID` = '$ai'";
		$result = @mysqli_query($conn, $query);
		$_SESSION['USER-NAME'] = $fn . ' ' . $ln;
		$_SESSION["sweetalert"] = [
			"title" => "Edit Account",
			"text" => "Successfully updated your account information.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];

		header("location:admin-profile.php");
	}
}
