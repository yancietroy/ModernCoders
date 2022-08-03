<?php include('mysql_connect.php');
$si = $_POST['STUDENT_ID'];
$sql = "SELECT * FROM tb_students WHERE STUDENT_ID='$si' LIMIT 1";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>  