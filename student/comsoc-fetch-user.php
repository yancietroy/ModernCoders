<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["STUDENT_ID"]))  
 {  
      $query = "SELECT * FROM tb_students WHERE STUDENT_ID = '".$_POST["STUDENT_ID"]."'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>