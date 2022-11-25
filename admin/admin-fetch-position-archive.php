<?php
include('../mysql_connect.php');
if(isset($_POST["position_id"]))
{
    $pi = $_POST["position_id"];
    $query = "SELECT * FROM tb_position_archive  WHERE POSITION_ID = '$pi'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
