<?php
include('../mysql_connect.php');
if(isset($_POST["org_req_id"]))
{
    $orgid = $_POST["org_req_id"];
    $query = "SELECT * FROM tb_org_application WHERE org_req_id = '$orgid'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row); 
}
?>