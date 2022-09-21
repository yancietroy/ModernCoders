<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["officer_id"]))  
 {  
     $id = $_POST['officer_id'];
      $query = "SELECT tb_officers.officer_id, tb_officers.first_name, tb_officers.middle_initial, tb_officers.last_name, tb_officers.email, tb_officers.course, tb_officers.section, tb_position.position, tb_orgs.ORG, tb_officers.position_id, tb_officers.org_id FROM tb_officers JOIN tb_position ON tb_officers.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers.org_id WHERE tb_officers.officer_id = '$id'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>