<?php
include('../../mysql_connect.php');

$sql = "SELECT POSITION_ID as id,position FROM tb_position";
$result = @mysqli_query($conn, $sql);
$rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($rows);
