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
      if($result)
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update Position",
				"text" => "Successfully updated Position",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
          "title" => "Update Position",
  				"text" => "Successfully updated Position",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			header("Location:admin-position-list.php");
		}
}
?>
