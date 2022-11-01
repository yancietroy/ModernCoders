<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $ci = $_POST["college_id"];
    $c = $_POST["college"];
    $query = "SELECT * FROM tb_collegedept";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_collegedept` SET `college` = '$c' WHERE `college_id` = '$ci'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-college.php");
		}
}
?>
