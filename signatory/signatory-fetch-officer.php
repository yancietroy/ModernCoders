<?php  
include('../mysql_connect.php'); 
 if(isset($_POST["student_id"]))  
 {  
     $id = $_POST['student_id'];
       $query = "SELECT tb_officers.officer_id, tb_officers.student_id, tb_officers.first_name, tb_officers.bio, tb_officers.last_name, tb_officers.birthdate, tb_officers.age, tb_officers.email, tb_officers.password, tb_officers.gender, tb_officers.year_level, tb_officers.college_dept, tb_collegedept.college, tb_officers.course, tb_officers.section, tb_position.position, tb_orgs.ORG, tb_officers.position_id, tb_officers.org_id, tb_officers.user_type, tb_officers.profile_pic, tb_officers.account_created, tb_officers.bio FROM tb_officers JOIN tb_position ON tb_officers.position_id = tb_position.POSITION_ID JOIN tb_orgs ON tb_orgs.ORG_ID = tb_officers.org_id JOIN tb_usertypes ON tb_usertypes.usertype_id = tb_officers.user_type JOIN tb_collegedept ON tb_officers.college_dept = tb_collegedept.college_id JOIN tb_students ON tb_officers.student_id=tb_students.STUDENT_ID WHERE tb_officers.student_id = '$id'"; 
      $result = @mysqli_query($conn, $query);  
      $row = @mysqli_fetch_array($result);
      echo json_encode($row);  
 }  
?>