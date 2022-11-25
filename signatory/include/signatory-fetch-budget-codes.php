<?php
include('../../mysql_connect.php');

$sql = "SELECT code,description FROM tb_budget_codes";
$result = @mysqli_query($conn, $sql);
$rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($rows);
