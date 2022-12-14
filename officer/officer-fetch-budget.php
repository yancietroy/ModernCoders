<?php
include('../mysql_connect.php');
if(isset($_POST["id"]))
{
    $pi = $_POST["id"];
    $query = "SELECT * FROM tb_budget_codes WHERE id = '$pi'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
