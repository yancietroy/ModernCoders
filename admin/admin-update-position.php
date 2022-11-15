<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $pi = $_POST["POSITION_ID"];
    $p =  $mysqli -> real_escape_string ($_POST["position"]);
    $query = "SELECT * FROM tb_position";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_position` SET `position` = '$p' WHERE `POSITION_ID` = '$pi'";
			$result = @mysqli_query($conn, $query);
			echo "<script type='text/javascript'>
                    alert('Updated Successful')
                    window.location.href='admin-position-list.php'</script>";
		}
}
?>
