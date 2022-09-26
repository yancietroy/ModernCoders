<?php

include('../mysql_connect.php');
if (isset($_POST["project_id"])) {
    $query = "SELECT * FROM tb_projectmonitoring WHERE project_id = '".$_POST["project_id"]."'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row);
}
