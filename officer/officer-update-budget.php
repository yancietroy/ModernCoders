<?php
include('../mysql_connect.php');
ob_start();
session_start();
if (isset ($_POST['updatedata']))
{

    $pi = $_POST["id"];
    $p =  $mysqli -> real_escape_string ($_POST["code"]);
    $desc =  $mysqli -> real_escape_string ($_POST["desc"]);
    $query = "SELECT * FROM tb_budget_codes";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_budget_codes` SET `code` = '$p', `description` = '$desc' WHERE `id` = '$pi'";
			$result = @mysqli_query($conn, $query);
      if($result)
			{
				$_SESSION["sweetalert"] = [
				"title" => "Update code",
				"text" => "Successfully updated code",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
			}else
			{
				$_SESSION["sweetalert"] = [
          		"title" => "Update code",
  				"text" => "Error upon updating code",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
				];
			}
			header("Location:budget-codes.php");
		}
}
?>
