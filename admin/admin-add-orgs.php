<?php 
session_start();
include('../mysql_connect.php');
 if(isset($_POST["updatedata"]))  
 {  
 	$status = $_POST["status"];
 	$ot = $_POST["org_type"];
 	$on = $_POST["org_name"];
 	$logo = "jrusop-logo2.png";
 	$st = "Active";

 	if($status == "Approved")
 	{
 		if($ot == 1){
	 		$query = "UPDATE tb_org_application SET `status` = '$status' WHERE org_req_id = '".$_POST["org_req_id"]."'";
	 		$result = @mysqli_query($conn, $query);
	 		if($result)
	 		{
			    $query = "INSERT INTO tb_orgs(ORG, logo, status, org_type_id) VALUES('$on', '$logo', '$st', '$ot')"; 
			    $result = @mysqli_query($conn, $query);
			    if($result){
				$_SESSION["sweetalert"] = [
					"title" => "Status Updated",
					"text" => "Successfully updated request status.",
					"icon" => "success", //success,warning,error,info
					"redirect" => null,
					];
				}
				else {
				$_SESSION["sweetalert"] = [
					"title" => "Error Status Update",
					"text" => "Unexpected error while updating request status.",
					"icon" => "error", //success,warning,error,info
					"redirect" => null,
				];
				}
			}
		}elseif($ot == 2){
			$query = "UPDATE tb_org_application SET `status` = '$status' WHERE org_req_id = '".$_POST["org_req_id"]."'";
	 		$result = @mysqli_query($conn, $query);
	 		if($result)
	 		{
			    $query = "INSERT INTO tb_orgs(ORG, logo, status, org_type_id) VALUES('$on', '$logo', '$st', '$ot')"; 
			    $result = @mysqli_query($conn, $query);
			    if($result){
				$_SESSION["sweetalert"] = [
					"title" => "Status Updated",
					"text" => "Successfully updated request status.",
					"icon" => "success", //success,warning,error,info
					"redirect" => null,
					];
				}
				else {
				$_SESSION["sweetalert"] = [
					"title" => "Error Status Update",
					"text" => "Unexpected error while updating request status.",
					"icon" => "error", //success,warning,error,info
					"redirect" => null,
				];
				}
			}
		}
    }
    elseif ($status == "Deny") 
    {
    	$query = "UPDATE tb_org_application SET `status` = '$status' WHERE org_req_id = '".$_POST["org_req_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
			$_SESSION["sweetalert"] = [
				"title" => "Status Updated",
				"text" => "Successfully updated request status.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
		}else{
			$_SESSION["sweetalert"] = [
				"title" => "Error Status Update",
				"text" => "Unexpected error while updating request status.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
		}
 		
    }
    elseif ($status == "Pending") 
    {
    	$query = "UPDATE tb_org_application SET `status` = '$status' WHERE org_req_id = '".$_POST["org_req_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
			$_SESSION["sweetalert"] = [
				"title" => "Status Updated",
				"text" => "Successfully updated request status.",
				"icon" => "success", //success,warning,error,info
				"redirect" => null,
				];
		}else{
			$_SESSION["sweetalert"] = [
				"title" => "Error Status Update",
				"text" => "Unexpected error while updating request status.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
		}
    }
    header("location:admin-orgs-review.php");
}
?>