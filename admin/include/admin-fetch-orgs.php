<?php
include('../../mysql_connect.php');

if (isset($_POST['type'])) {
    if ($_POST['type'] == 3) {
        // Side Org
        $sql = "SELECT ORG_ID as id,ORG as name FROM tb_orgs";
    } else if ($_POST['type'] == 2) {
        // Mother Org
        $sql = "SELECT MORG_ID as id,MOTHER_ORG as name FROM tb_morg";
    }
    $result = @mysqli_query($conn, $sql);
    $rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
