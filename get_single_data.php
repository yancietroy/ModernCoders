<?php include('connection.php');
$admin_id = $_POST['admin_id'];
$sql = "SELECT * FROM tb_admin WHERE id='$admin_id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
