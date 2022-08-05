<?php
include('connection.php');
$FIRST_NAME = $_POST['FIRST_NAME'];
$LAST_NAME = $_POST['LAST_NAME'];
$EMAIL = $_POST['EMAIL'];

$sql = "INSERT INTO `tb_admin` (`FIRST_NAME`,`LAST_NAME`,`EMAIL`) values ('$FIRST_NAME', '$LAST_NAME', '$EMAIL' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
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
