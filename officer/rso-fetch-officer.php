<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["student_id"]))  
 {  
      $query = "SELECT * FROM tb_officers WHERE student_id = '".$_POST["student_id"]."'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>