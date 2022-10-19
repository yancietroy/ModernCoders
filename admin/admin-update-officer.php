<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$oi = $_POST['officer_id'];
	$pos = $_POST['position_id'];
	$org = $_POST['org_id'];
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$mn = $_POST['middle_initial'];
	$bdate = $_POST['birthdate'];
	$age = $_POST['age'];
	$g = $_POST['gender'];
	$yl = $_POST['year_level'];
	$cd = $_POST['college_dept'];
	$e = $_POST['email'];
	$c = $_POST['course'];
	$section = $_POST['section'];
	
	$query = "SELECT * FROM tb_officers";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
			
		if($row)
		{
			$query = "UPDATE `tb_officers` SET `position_id` = '$pos', `org_id` = '$org', `first_name` = '$fn', `last_name` = '$ln', `middle_initial` = '$mn', `birthdate`= '$bdate', `age`= '$age', `gender`= '$g', `year_level`= '$yl', `college_dept`= '$cd', `section`= '$section', `email` = '$e', `course` = '$c'  WHERE `officer_id` = '$oi'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
                    alert('Details Updated')
                    window.location.href='admin-officers-users.php'</script>";
		}
	
}
?>