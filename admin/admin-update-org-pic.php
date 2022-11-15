<?php
include('../mysql_connect.php');
ob_start();
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
			echo "<script type='text/javascript'>
			alert('Logo updated!')</script>";
		}