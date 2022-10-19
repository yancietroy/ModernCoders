<?php
include('../mysql_connect.php');
if(isset($_POST["ORG_ID"]))
{
    $orgid = $_POST["ORG_ID"];
    $query = "SELECT * FROM tb_orgs WHERE ORG_ID = '$orgid'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result);
    echo json_encode($row); 
}
?>