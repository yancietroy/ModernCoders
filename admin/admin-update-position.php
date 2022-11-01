<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $pi = $_POST["POSITION_ID"];
    $p = $_POST["position"];
    $query = "SELECT * FROM tb_position";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_position` SET `position` = '$p' WHERE `POSITION_ID` = '$pi'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-position-list.php");
		}
}
?>
