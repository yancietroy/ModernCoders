<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $orgid = $_POST["ORG_ID"];
    $orgName = =  $mysqli -> real_escape_string ($_POST["ORG"]);
    $query = "SELECT * FROM tb_orgs";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_orgs` SET `ORG` = '$orgName' WHERE `ORG_ID` = '$orgid'";
			$result = @mysqli_query($conn, $query);
			$_SESSION['message'] = '<script>alert("Update Successful")</script>';
			header("Location:admin-orgs.php");
		}
}
?>
