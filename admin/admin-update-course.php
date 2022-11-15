<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $ci = $_POST["course_id"];
    $c =  $mysqli -> real_escape_string ($_POST["course"]);
    $query = "SELECT * FROM tb_course";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_course` SET `course` = '$c' WHERE `course_id` = '$ci'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
                    alert('Updated Successful')
                    window.location.href='admin-course.php'</script>";
		}
}
?>
