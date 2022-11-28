<?php
include('../../mysql_connect.php');

if (isset($_POST['project_id'])) {
    $pid = $_POST['project_id'];
    $querylog = "SELECT * FROM tb_project_logs WHERE project_id='$pid' ORDER BY id DESC";
    $result = @mysqli_query($conn, $querylog);
    $rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
