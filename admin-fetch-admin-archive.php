<?php  
include('mysql_connect.php'); 
 if(isset($_POST["ADMIN_ID"]))  
 {  
      $query = "SELECT * FROM tb_admin_archive WHERE ADMIN_ID = '".$_POST["ADMIN_ID"]."'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>