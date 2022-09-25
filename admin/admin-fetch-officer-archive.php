<?php  
include('../mysql_connect.php');
 if(isset($_POST["officer_id"]))
 {
     $id = $_POST['officer_id'];
      $query = "SELECT tb_officers_archive.officer_id, tb_officers_archive.student_id, tb_officers_archive.first_name, tb_officers_archive.middle_initial, tb_officers_archive.last_name, tb_officers_archive.email, tb_officers_archive.course, tb_officers_archive.section, tb_position.position, tb_orgs.ORG, tb_officers_archive.position_id, tb_officers_archive.org_id, tb_officers_archive.account_created FROM tb_officers_archive JOIN tb_position ON tb_officers_archive.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers_archive.org_id WHERE tb_officers_archive.officer_id = '$id'";
      $result = @mysqli_query($conn, $query);
      $row = @mysqli_fetch_array($result);
      echo json_encode($row);
 }
 ?>
