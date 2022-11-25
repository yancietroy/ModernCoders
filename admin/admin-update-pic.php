<?php
ob_start();
session_start();
$id = $_SESSION['USER-ID'];
include('../mysql_connect.php');

	$pname = rand(1000,100000)."-".$_FILES['profilePic']['name'];
    $destination = 'pictures/' . $pname;
    $tname = $_FILES['profilePic']['tmp_name'];
    move_uploaded_file($tname, $destination);

	$query = "SELECT * FROM tb_admin";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_admin` SET `PROFILE_PIC` = '$pname' WHERE `ADMIN_ID` = '$id'";
			$result = @mysqli_query($conn, $query);
			if($result){
			$_SESSION["sweetalert"] = [
				"title" => "Update Picture",
				"text" => "Successfully updated Profile Picture.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}
			else {
			$_SESSION["sweetalert"] = [
				"title" => "Update Picture",
				"text" => "Unexpected error while updating Profile Picture.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
			}
		}
?>