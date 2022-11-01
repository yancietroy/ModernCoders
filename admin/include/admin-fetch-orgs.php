<?php
include('../../mysql_connect.php');

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $sql = "SELECT ORG_ID as id,ORG as name FROM tb_orgs WHERE org_type_id='$type'";
    $result = @mysqli_query($conn, $sql);
    $rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
