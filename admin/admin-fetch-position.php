<?php
include('../mysql_connect.php');
if(isset($_POST["POSITION_ID"]))
{
    $pi = $_POST["POSITION_ID"];
    $query = "SELECT * FROM tb_position WHERE POSITION_ID = '$pi'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
