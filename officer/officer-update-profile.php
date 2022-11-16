<?php
include('../mysql_connect.php');
session_start();

include('../router.php');
route(2);

if (isset ($_POST['updatedata']))
{
	$oi =  $mysqli -> real_escape_string ($_POST['officer_id']);
	$pos =  $mysqli -> real_escape_string ($_POST['position_id']);
	$org =  $mysqli -> real_escape_string ($_POST['org_id']);
	$fn =  $mysqli -> real_escape_string ($_POST['first_name']);
	$ln =  $mysqli -> real_escape_string ($_POST['last_name']);
	$mn =  $mysqli -> real_escape_string ($_POST['middle_initial']);
	$bdate =  $mysqli -> real_escape_string ($_POST['birthdate']);
	$age =  $mysqli -> real_escape_string ($_POST['age']);
	$g =  $mysqli -> real_escape_string ($_POST['gender']);
	$yl =  $mysqli -> real_escape_string ($_POST['year_level']);
	$cd =  $mysqli -> real_escape_string ($_POST['college_dept']);
	$e =  $mysqli -> real_escape_string ($_POST['email']);
	$c =  $mysqli -> real_escape_string ($_POST['course']);
	$section =  $mysqli -> real_escape_string ($_POST['section']);

	$query = "SELECT * FROM tb_officers";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_officers` SET `position_id` = '$pos', `org_id` = '$org', `first_name` = '$fn', `last_name` = '$ln', `middle_initial` = '$mn', `birthdate`= '$bdate', `age`= '$age', `gender`= '$g', `year_level`= '$yl', `college_dept`= '$cd', `section`= '$section', `email` = '$e', `course` = '$c'  WHERE `officer_id` = '$oi'";
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
			header("location:officer-profile.php");
		}
}
?>