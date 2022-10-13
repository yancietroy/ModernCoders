<?php

//action-admin-user.php

include('../mysql_connect.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':STUDENT_ID'    => $_POST['STUDENT_ID'],
  ':FIRST_NAME'  => $_POST['FIRST_NAME'],
  ':MIDDLE_NAME'  => $_POST['MIDDLE_NAME'],
  ':LAST_NAME'   => $_POST['LAST_NAME'],
  ':GENDER'    => $_POST['GENDER'],
  ':EMAIL'    => $_POST['EMAIL'],
  ':YEAR_LEVEL'    => $_POST['YEAR_LEVEL'],
  ':AGE'    => $_POST['AGE']
 );

 $query = "
 UPDATE tb_students
 SET FIRST_NAME = :FIRST_NAME,
 MIDDLE_NAME = :MIDDLE_NAME,
 LAST_NAME = :LAST_NAME,
 GENDER = :GENDER,
 EMAIL = :EMAIL,
 YEAR_LEVEL = :YEAR_LEVEL,
 AGE = :AGE
 WHERE STUDENT_ID = :STUDENT_ID
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM tb_students
 WHERE STUDENT_ID = '".$_POST["STUDENT_ID"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}


?>