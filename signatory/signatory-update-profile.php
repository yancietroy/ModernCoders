<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{
	$si = $_POST['school_id'];
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$e = $_POST['email'];
	$st = $_POST['signatory_type'];
	$ut = $_POST['user_type'];
	$oi = $_POST['org_id'];

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET  `first_name` = '$fn', `last_name` = '$ln', `email` = '$e', `signatory_type` = '$ut', `user_type` = '$oi', `org_id` = '$st'   WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
                    alert('Details Updated')
                    window.location.href='signatory-profile.php'</script>";
		}

}
?>
