<?php
include('../mysql_connect.php');
session_start();
if (isset ($_POST['updatedata'])){

	$fn =  $mysqli -> real_escape_string ($_POST['FIRST_NAME']);
	$ln =  $mysqli -> real_escape_string ($_POST['LAST_NAME']);
	$mn =  $mysqli -> real_escape_string ($_POST['MIDDLE_NAME']);
	$bdate =  $mysqli -> real_escape_string ($_POST['BIRTHDATE']);
	$age =  $mysqli -> real_escape_string ($_POST['AGE']);
	$g =  $mysqli -> real_escape_string ($_POST['GENDER']);
	$si =  $mysqli -> real_escape_string ($_POST['STUDENT_ID']);
	$yl =  $mysqli -> real_escape_string ($_POST['YEAR_LEVEL']);
	$course =  $mysqli -> real_escape_string ($_POST['COURSE']);
	$section =  $mysqli -> real_escape_string ($_POST['SECTION']);
	$morg =  $mysqli -> real_escape_string ($_POST['MORG_ID']);
	$e =  $mysqli -> real_escape_string ($_POST['EMAIL']);
	$cd =  $mysqli -> real_escape_string ($_POST['COLLEGE_DEPT']);
	$ut =  $mysqli -> real_escape_string ($_POST['USER_TYPE']);
	$pass = $mysqli -> real_escape_string ($_POST['PASSWORD']);
	$profilepic = $mysqli -> real_escape_string ($_POST['PROFILE_PIC']);
	$pos_id = $_POST['position_id'];
	$orgids = ',[' .  $_POST['ORG_IDS'] . ']';

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_students` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_NAME` = '$mn', `BIRTHDATE` = '$bdate', `AGE` = '$age', `GENDER` = '$g', `YEAR_LEVEL` = '$yl', `SECTION` = '$section', `EMAIL` = '$e', `COLLEGE_DEPT` = '$cd', `MORG_ID` = '$morg', `COURSE` = '$course', `USER_TYPE` = '$ut' , `ORG_IDS` = '$orgids' WHERE `STUDENT_ID` = '$si'";
			$result = @mysqli_query($conn, $query);
			if($result)
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Student Details",
				"text" => "Successfully updated student details.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Student Details",
				"text" => "Error upon updating student details.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			header("Location:admin-students-users.php");
			if ($ut = 2)
			$duplicate=@mysqli_query($conn,"SELECT * FROM tb_officers WHERE org_id='$morg' AND position_id='$pos_id'");
				if (mysqli_num_rows($duplicate)>0)
                {
                    $_SESSION["sweetalert"] = [
						"title" => "Error",
						"text" => "Error Officer already exists.",
						"icon" => "error", //success,warning,error,info
						"redirect" => null,
						];
	         	}else
	        	{
					$query = "INSERT INTO tb_officers(student_id, position_id, last_name, first_name, middle_initial, birthdate, age, gender, year_level, college_dept, course, section, email, password, org_id, user_type, profile_pic, account_created)
	                  VALUES('$si', '$pos_id', '$ln', '$fn', '$mn', '$bdate', '$age', '$g', '$yl', '$cd', '$course', '$section', '$e', '$pass', '$morg', '$ut', '$profilepic', NOW())";
		            $result = @mysqli_query($conn, $query);
					if($result)
					{
						$_SESSION["sweetalert"] = [
						"title" => "Officer Added",
						"text" => "Successfully added student as an officer.",
						"icon" => "success", //success,warning,error,info
						"redirect" => null,
						];
					}else
					{
						$_SESSION["sweetalert"] = [
						"title" => "Error",
						"text" => "Error upon adding student as an officer.",
						"icon" => "error", //success,warning,error,info
						"redirect" => null,
						];
					}
				}
		}
		header("Location:admin-students-users.php");
}

?>