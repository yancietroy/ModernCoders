<?php  
include('../mysql_connect.php');
 if(isset($_POST["project_id"]))  
 {
     $proj_id = $_POST["project_id"];
      $query = "SELECT tb_projectmonitoring.project_id, tb_projectmonitoring.date_submitted, tb_projectmonitoring.project_name, tb_projectmonitoring.organizer, tb_projectmonitoring.venue, tb_projectmonitoring.status_date, tb_projectmonitoring.status, tb_projectmonitoring.status_by, tb_projectmonitoring.project_type, tb_projectmonitoring.project_category, tb_projectmonitoring.start_date, tb_projectmonitoring.end_date, tb_projectmonitoring.participants, tb_orgs.ORG, tb_projectmonitoring.requested_by, tb_position.position, tb_projectmonitoring.objectives, tb_projectmonitoring.budget_req, tb_projectmonitoring.estimated_budget, tb_projectmonitoring.remarks,tb_projectmonitoring.college_id, tb_projectmonitoring.org_id FROM tb_projectmonitoring JOIN tb_orgs ON tb_orgs.ORG_ID=tb_projectmonitoring.org_id JOIN tb_position ON tb_position.POSITION_ID=tb_projectmonitoring.position_id WHERE project_id = '$proj_id'";  
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);  
      
      $query = "SELECT code,description FROM tb_budget_codes";
      $result = @mysqli_query($conn, $query);
      $codes = [];
      while ($code = @mysqli_fetch_assoc($result)) {
           $codes[$code["code"]] = $code['description'];
      }
 
      $row["budget_codes"] = $codes;
      echo json_encode($row);  
 }
?>