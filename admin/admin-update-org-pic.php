<?php
include('../mysql_connect.php');
session_start();

//$_SESSION['ORG_ID'] = $orgid;

	$pname = rand(1000,100000)."-".$_FILES['logoPic']['name'];
    $destination = '../assets/img/logos/' . $pname;
    $tname = $_FILES['logoPic']['tmp_name'];
    move_uploaded_file($tname, $destination);

	$query = "SELECT * FROM tb_orgs";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_orgs` SET `logo` = '$pname' WHERE `ORG_ID` = " . $_SESSION['ORG_ID'];
			$result = @mysqli_query($conn, $query);
			if($result){
				$_SESSION["sweetalert"] = [
				"title" => "Update Org Picture",
				"text" => "Successfully updated Org Picture.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else 
			{
				$_SESSION["sweetalert"] = [
					"title" => "Update Org Picture",
					"text" => "Unexpected error while updating Org Picture.",
					"icon" => "error", //success,warning,error,info
					"redirect" => null,
				];
			}
		}
?>