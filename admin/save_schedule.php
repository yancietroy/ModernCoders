<?php
require_once('../mysql_connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($project_id)){
    $sql = "INSERT INTO `tb_projectmonitoring` (`project_name`,`project_desc`,`start_date`,`end_date`) VALUES ('$project_name','$project_desc','$start_date','$end_date')";
}else{
    $sql = "UPDATE `tb_projectmonitoring` set `project_name` = '{$project_name}', `project_desc` = '{$project_desc}', `start_date` = '{$start_date}', `end_date` = '{$end_date}' where `project_id` = '{$project_id}'";
}
$save = $conn->query($sql);
if($save){
    echo "<script> alert('Schedule Successfully Saved.')
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
