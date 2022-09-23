<?php  
include('../mysql_connect.php');
 if(isset($_POST["school_id"]))
 {
      $query = "SELECT * FROM tb_signatories_archive WHERE school_id = '".$_POST["school_id"]."'";
      $result = @mysqli_query($conn, $query);
      $row = @mysqli_fetch_array($result);
      echo json_encode($row);
 }
 ?>
