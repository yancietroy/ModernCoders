<?php 
ob_start();
session_start();
include('../mysql_connect.php');
 if(isset($_POST["updatedata"]))  
 {  
 	$sorg_id = ',[' . $_SESSION['USER-ORG'] . ']';
 	$req_s = $_POST["req_status"];

 	if($req_s == "Approved")
 	{
 		$query = "UPDATE tb_requests SET `req_status` = '$req_s' WHERE STUDENT_ID = '".$_POST["student_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
		    $query = "UPDATE tb_students SET `ORG_IDS` = CONCAT(ORG_IDS,'$sorg_id') WHERE STUDENT_ID = '".$_POST["student_id"]."'"; 
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
				"title" => "Status Update",
				"text" => "Unexpected error while updating request status.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
			}
		}
    }
    elseif ($req_s == "Deny") 
    {
    	$query = "UPDATE tb_requests SET `req_status` = '$req_s' WHERE STUDENT_ID = '".$_POST["student_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
 			$query = "UPDATE tb_students SET `ORG_IDS` = REPLACE(ORG_IDS, '$sorg_id', '') WHERE STUDENT_ID = '".$_POST["student_id"]."'"; 
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
				"title" => "Status Update",
				"text" => "Unexpected error while updating request status.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
			}
 		}
    }
    elseif ($req_s == "Pending") 
    {
    	$query = "UPDATE tb_requests SET `req_status` = '$req_s' WHERE STUDENT_ID = '".$_POST["student_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
 			$query = "UPDATE tb_students SET `ORG_IDS` = REPLACE(ORG_IDS, '$sorg_id', '') WHERE STUDENT_ID = '".$_POST["student_id"]."'";
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
				"title" => "Status Update",
				"text" => "Unexpected error while updating request status.",
				"icon" => "error", //success,warning,error,info
				"redirect" => null,
			];
			}
 		}
    }
    header("location:officer-org-requests.php");
}
?>