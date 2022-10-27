<?php  
include('../mysql_connect.php');
 if(isset($_POST["officer_id"]))
 {
     $id = $_POST['officer_id'];
      $query = "SELECT tb_officers_archive.officer_id, tb_officers_archive.student_id, tb_officers_archive.first_name, tb_officers_archive.middle_initial, tb_officers_archive.last_name, tb_officers_archive.birthdate, tb_officers_archive.age, tb_officers_archive.email, tb_officers_archive.password, tb_officers_archive.gender, tb_officers_archive.year_level, tb_officers_archive.college_dept, tb_collegedept.college, tb_officers_archive.course, tb_officers_archive.section, tb_position.position, tb_orgs.ORG, tb_officers_archive.position_id, tb_officers_archive.org_id, tb_officers_archive.user_type, tb_officers_archive.profile_pic, tb_officers_archive.account_created FROM tb_officers_archive JOIN tb_position ON tb_officers_archive.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers_archive.org_id JOIN tb_usertypes ON tb_usertypes.usertype_id = tb_officers_archive.user_type JOIN tb_collegedept ON tb_officers_archive.college_dept = tb_collegedept.college_id WHERE tb_officers_archive.officer_id = '$id'";
      $result = @mysqli_query($conn, $query);
      $row = @mysqli_fetch_array($result);
      echo json_encode($row);
 }
 ?>
