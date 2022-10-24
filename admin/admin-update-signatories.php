<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$st = $_POST['signatory_type'];
	$si = $_POST['school_id'];
	$e = $_POST['email'];
	$cd = $_POST['college_id'];
  $oid = $_POST['org_id'];
	$ul = $_POST['user_type'];
	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET `first_name` = '$fn', `last_name` = '$ln', `signatorytype_id` = '$st', `college_dept` = '$cd', `org_id` = '$oid',  `email` = '$e', `usertype_id` = '$ul' WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
        		alert('Status updated!')
        		</script>";
			header("Location:admin-signatories-users.php");
			if ($ul = 3)
		{
			$query =  "INSERT INTO tb_signatories(school_id, first_name, last_name, signatorytype_id, email, password, college_dept, org_id, account_created, profile_pic, usertype_id)
			VALUES('$si', '$fn', '$ln', '$st', '$e', SHA('$p'), '$cd','$oid',NOW(), '$pp', '$ul')";
						$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
        		alert('User updated!')
        		</script>";
			header("Location:admin-signatories-users.php");
		}
		}
	}
	?>
