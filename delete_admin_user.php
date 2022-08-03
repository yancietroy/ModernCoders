<?php 
include('mysql_connect.php');

$si = $_POST['STUDENT_ID'];
$sql = "DELETE FROM tb_students WHERE STUDENT_ID='$si'";
$delQuery =mysqli_query($conn,$sql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>