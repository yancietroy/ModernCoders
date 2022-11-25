<?php
include('../mysql_connect.php');
if(isset($_POST["course_id"]))
{
    $ci = $_POST["course_id"];
    $query = "SELECT * FROM tb_course_archive WHERE course_id = '$ci'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
?>