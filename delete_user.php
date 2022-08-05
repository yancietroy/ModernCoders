<?php
include('connection.php');

$admin_id = $_POST['ADMIN_ID'];
$sql = "DELETE FROM tb_admin WHERE ADMIN_ID='$admin_id'";
$delQuery =mysqli_query($con,$sql);
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
