<?php
ob_start();
session_start();
$id = $_SESSION['use'];
include('../mysql_connect.php');

	$pname = rand(1000,100000)."-".$_FILES['profilePic']['name'];
    $destination = 'pictures/' . $pname;
    $tname = $_FILES['profilePic']['tmp_name'];
    move_uploaded_file($tname, $destination);

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `profile_pic` = '$pname' WHERE `school_id` = '$id'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
			alert('Profile picture updated!')
			window.location.href='signatory-profile.php'</script>";
		}

?>
