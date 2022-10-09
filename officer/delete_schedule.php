<?php
require_once('../mysql_connect.php');
if(!isset($_GET['project_id'])){
    echo "<script> alert('Undefined Schedule project_id.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `tb_projectmonitoring` WHERE project_id = '{$_GET['project_id']}'");
if($delete){
    echo "<script> alert('Event has deleted successfully.')
    	window.location.href='event-calendar.php' </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();

?>
