<?php 
include('mysql_connect.php');
$si = $_POST['STUDENT_ID'];
$fn = $_POST['FIRST_NAME'];
$mn = $_POST['MIDDLE_NAME'];
$ln = $_POST['LAST_NAME'];
$g = $_POST['GENDER'];
$e = $_POST['EMAIL'];
$yl = $_POST['YEAR_LEVEL'];
$a = $_POST['AGE'];
$bd = $_POST['BIRTHDATE'];

$sql = "INSERT INTO tb_students(STUDENT_ID, FIRST_NAME, LAST_NAME, MIDDLE_NAME, BIRTHDATE, AGE, GENDER, YEAR_LEVEL, EMAIL) VALUES('$si', '$fn', '$ln', '$mn', '$bd', '$a', '$g', '$yl', '$e')";
$query= mysqli_query($conn,$sql);
$lastId = mysqli_insert_id($conn);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>