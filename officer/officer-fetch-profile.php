<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["officer_id"]))  
 {  
      $query = "SELECT * FROM tb_officers WHERE officer_id = '".$_POST["officer_id"]."'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>