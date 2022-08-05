<?php
include('connection.php');
$firstname = $_POST['FIRST_NAME'];
$lastname = $_POST['LAST_NAME'];
$email = $_POST['EMAIL'];
$adminid = $_POST['admin_id'];

$sql = "UPDATE `tb_admin` SET  `first_name`='$firstname' , `last_name`= '$lastname', `email`='$email' WHERE id='$adminid' ";
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
