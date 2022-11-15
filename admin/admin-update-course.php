<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset($_POST['updatedata'])) {

	$ci = $_POST["course_id"];
	$c =  $mysqli->real_escape_string($_POST["course"]);
	$query = "SELECT * FROM tb_course";
	$result = @mysqli_query($conn, $query);
	$row = @mysqli_fetch_array($result);

	if ($row) {
		$query = "UPDATE `tb_course` SET `course` = '$c' WHERE `course_id` = '$ci'";
		$result = @mysqli_query($conn, $query);
		$_SESSION["sweetalert"] = [
			"title" => "Update Course Details",
			"text" => "Successfully updated $c\'s details.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
	} else {
		$_SESSION["sweetalert"] = [
			"title" => "Update Course Details",
			"text" => "Unexpected error while updating $c\'s details.",
			"icon" => "error", //success,warning,error,info
			"redirect" => null,
		];
	}

	header("Location:admin-course.php");
}
