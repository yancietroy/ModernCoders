<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["project_id"]))  
 {  
      $query = "SELECT tb_projectmonitoring.project_id, tb_projectmonitoring.date_submitted, tb_projectmonitoring.status_date, tb_projectmonitoring.project_name, tb_projectmonitoring.organizer, tb_projectmonitoring.venue, tb_projectmonitoring.status_by, tb_projectmonitoring.project_type, tb_projectmonitoring.project_category, tb_projectmonitoring.start_date, tb_projectmonitoring.end_date, tb_projectmonitoring.participants, tb_projectmonitoring.objectives, tb_projectmonitoring.budget_req,  tb_projectmonitoring.requested_by, tb_projectmonitoring.estimated_budget, tb_projectmonitoring.remarks, tb_orgs.ORG, tb_position.position FROM tb_projectmonitoring JOIN tb_orgs ON tb_orgs.ORG_ID = tb_projectmonitoring.org_id JOIN tb_position ON tb_position.POSITION_ID = tb_projectmonitoring.position_id WHERE project_id = '".$_POST["project_id"]."'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>