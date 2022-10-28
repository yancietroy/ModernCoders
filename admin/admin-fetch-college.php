<?php
include('../mysql_connect.php');
if(isset($_POST["college_id"]))
{
    $ci = $_POST["college_id"];
    $query = "SELECT * FROM tb_collegedept WHERE college_id = '$ci'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
?>
