<?php
include('../mysql_connect.php');
ob_start();
session_start();

if (isset ($_POST['updatedata']))
{

    $orgid = $_POST["ORG_ID"];
    $orgName = $mysqli -> real_escape_string ($_POST["ORG"]);
    $query = "SELECT * FROM tb_orgs";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_orgs` SET `ORG` = '$orgName' WHERE `ORG_ID` = '$orgid'";
			$result = @mysqli_query($conn, $query);
			$_SESSION["sweetalert"] = [
			"title" => "Update Org Details",
			"text" => "Successfully updated $orgName\'s details.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
	} else {
		$_SESSION["sweetalert"] = [
			"title" => "Update Org Details",
			"text" => "Unexpected error while updating $orgName\'s details.",
			"icon" => "error", //success,warning,error,info
			"redirect" => null,
		];
	}
	header("Location:admin-orgs.php");
}elseif (isset ($_POST['updateOrgProfile']))
{
	
    $orgid = $_POST["ORG_ID"];
    $collegeID = $_POST["college_id"];
    $orgName =  $mysqli -> real_escape_string ($_POST["ORG"]);
    $query = "SELECT * FROM tb_orgs";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);

		if($row)
		{
			$query = "UPDATE `tb_orgs` SET `ORG` = '$orgName', `college_id` = '$collegeID' WHERE `ORG_ID` = '$orgid'";
			$result = @mysqli_query($conn, $query);
			$_SESSION["sweetalert"] = [
			"title" => "Update Org Details",
			"text" => "Successfully updated $orgName\'s details.",
			"icon" => "success", //success,warning,error,info
			"redirect" => null,
		];
		} else {
			$_SESSION["sweetalert"] = [
				"title" => "Update Org Details",
				"text" => "Unexpected error while updating $orgName\'s details.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
		}
		if (isset ($_POST["signatory_id"]))
		{
			$orgid = $_POST["ORG_ID"];
		    $query = "SELECT * FROM tb_signatories";
		    $result = @mysqli_query($conn, $query);
		    $row = @mysqli_fetch_array($result);

			if($row)
			{
				$query = "UPDATE `tb_signatories` SET `org_id` = '$orgid' WHERE `school_id` = '".$_POST["signatory_id"]."'";
				$result = @mysqli_query($conn, $query);
				$_SESSION["sweetalert"] = [
					"title" => "Update Org Details",
					"text" => "Successfully updated $orgName\'s details.",
					"icon" => "success", //success,warning,error,info
					"redirect" => null,
			];
			} else {
				$_SESSION["sweetalert"] = [
					"title" => "Update Org Details",
					"text" => "Unexpected error while updating $orgName\'s details.",
					"icon" => "error", //success,warning,error,info
					"redirect" => null,
				];
			}
		}
		header("Location:admin-orgs.php");
}
?>
