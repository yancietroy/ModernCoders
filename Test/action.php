<?php

//action.php

include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':first_name'  => $_POST['first_name'],
  ':last_name'  => $_POST['last_name'],
  ':gender'   => $_POST['gender'],
  ':id'    => $_POST['id']
 );

 $query = "
 UPDATE tbl_sample 
 SET first_name = :first_name, 
 last_name = :last_name, 
 gender = :gender 
 WHERE id = :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM tbl_sample 
 WHERE id = '".$_POST["id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}


?>