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
		    $query = "UPDATE tb_students SET `ORG_IDS` = '$sorg_id' WHERE STUDENT_ID = '".$_POST["student_id"]."'"; 
		    $result = @mysqli_query($conn, $query);
		    echo "<script type='text/javascript'>
		            alert('Status updated!')
        			window.location.href='officer-org-requests.php'
		          </script>";
		}
    }
    elseif ($req_s == "Deny") 
    {
    	$query = "UPDATE tb_requests SET `req_status` = '$req_s' WHERE STUDENT_ID = '".$_POST["student_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
 			$sorg_id = NULL;
 			$query = "UPDATE tb_students SET `ORG_IDS` = '$sorg_id' WHERE STUDENT_ID = '".$_POST["student_id"]."'"; 
		    $result = @mysqli_query($conn, $query);
 			echo "<script type='text/javascript'>
		            alert('Status updated!')
        			window.location.href='officer-org-requests.php'
		          </script>";
 		}
    }
    elseif ($req_s == "Pending") 
    {
    	$query = "UPDATE tb_requests SET `req_status` = '$req_s' WHERE STUDENT_ID = '".$_POST["student_id"]."'";
 		$result = @mysqli_query($conn, $query);
 		if($result)
 		{
 			$sorg_id = NULL;
 			$query = "UPDATE tb_students SET `ORG_IDS` = '$sorg_id' WHERE STUDENT_ID = '".$_POST["student_id"]."'"; 
 			echo "<script type='text/javascript'>
		            alert('Status updated!')
        			window.location.href='officer-org-requests.php'
		          </script>";
 		}
    }
}
?>