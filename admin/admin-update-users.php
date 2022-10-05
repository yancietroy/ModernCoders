<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn = $_POST['FIRST_NAME'];
	$ln = $_POST['LAST_NAME'];
	$mn = $_POST['MIDDLE_NAME'];
	$bdate = $_POST['BIRTHDATE'];
	$age = $_POST['AGE'];
	$g = $_POST['GENDER'];
	$si = $_POST['STUDENT_ID'];
	$yl = $_POST['YEAR_LEVEL'];
	$course = $_POST['COURSE'];
	$section = $_POST['SECTION'];
	$morg = $_POST['MORG_ID'];
	$e = $_POST['EMAIL'];
	$cd = $_POST['COLLEGE_DEPT'];
	$ut = $_POST['USER_TYPE'];
	$pass = $_POST['PASSWORD'];
	$pos_id = $_POST['position_id'];
	$profilepic = $_POST['PROFILE_PIC'];

	$query = "SELECT * FROM tb_students";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_students` SET `FIRST_NAME` = '$fn', `LAST_NAME` = '$ln', `MIDDLE_NAME` = '$mn', `BIRTHDATE` = '$bdate', `AGE` = '$age', `GENDER` = '$g', `YEAR_LEVEL` = '$yl', `SECTION` = '$section', `EMAIL` = '$e', `COLLEGE_DEPT` = '$cd', `MORG_ID` = '$morg', `COURSE` = '$course', `USER_TYPE` = '$ut', `PASSWORD` = '$pass' , `PROFILE_PIC` = '$profilepic' WHERE `STUDENT_ID` = '$si'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-students-users.php");
			if ($ut = 2)
		{
			$query = "INSERT INTO tb_officers(student_id, position_id, last_name, first_name, middle_initial, birthdate, age, gender, year_level, college_dept, course, section, email, password, org_id, user_type, profile_pic,  account_created)
                  VALUES('$si', '$pos_id', '$ln', '$fn', '$mn', '$bdate', '$age', '$g', '$yl', '$cd', '$course', '$section', '$e', '$pass', '$morg', '$ut', '$profilepic', NOW())";
            $result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-students-users.php");
		}
		}
}
?>