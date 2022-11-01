<?php
include('../mysql_connect.php');
ob_start();
session_start();

include('../router.php');
route(3);

if (isset ($_POST['updatedata']))
{
	$si = $_POST['school_id'];
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];

	$query = "SELECT * FROM tb_signatories";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_signatories` SET  `first_name` = '$fn', `last_name` = '$ln' WHERE `school_id` = '$si'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
                    alert('Details Updated')
                    window.location.href='signatory-profile.php'</script>";
		}

}
