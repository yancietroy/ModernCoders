<?php
include('mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$oi = $_POST['officer_id'];
	$pos = $_POST['position'];
	$org = $_POST['ORG'];
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$mn = $_POST['middle_initial'];
	$e = $_POST['email'];
	$c = $_POST['course'];

	$query = "SELECT tb_officers.officer_id, tb_officers.first_name, tb_officers.middle_initial, tb_officers.last_name, tb_officers.email, tb_officers.course, tb_officers.section, tb_position.position, tb_orgs.ORG, tb_position.POSITION_ID, tb_orgs.ORG_ID FROM tb_officers JOIN tb_position ON tb_officers.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers.org_id WHERE tb_officers.officer_id = '$oi'";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
			
		if($row)
		{
			$pi = $row['POSITION_ID'];
			$orgid = $row['ORG_ID'];
			$query = "UPDATE `tb_officers` SET `position_id` = '$pi', `org_id` = '$orgid', `first_name` = '$fn', `last_name` = '$ln', `middle_initial` = '$mn',  `email` = '$e', `course` = '$c' WHERE `officer_id` = '$oi'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-officers.php");
		}
}
?>