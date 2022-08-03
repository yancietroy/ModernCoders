<?php 
include('connection.php');
$si = $_POST['STUDENT_ID'],
$fn = $_POST['FIRST_NAME'],
$mn = $_POST['MIDDLE_NAME'],
$ln = $_POST['LAST_NAME'],
$g = $_POST['GENDER'],
$e = $_POST['EMAIL'],
$yl = $_POST['YEAR_LEVEL'],
$a = $_POST['AGE']
$bd = $_POST['BIRTHDATE']

$sql = "UPDATE tb_students SET  `FIRST_NAME`='$fn' , `MIDDLE_NAME`= '$mn', `LAST_NAME`='$ln',  `GENDER`='$g',  `EMAIL`='$e',  `YEAR_LEVEL`='$yl',  `AGE`='$a',  `BIRTHDATE`='$bd' WHERE STUDENT_ID='$si' ";
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