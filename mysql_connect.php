<?php
/*
------------------------------------------------------------------------------------------------------
Script Name: ../mysql_connect.php
Author: <type your name>
Description: To connect to the MySQL server and database
------------------------------------------------------------------------------------------------------
*/
$servername ="localhost";
$username ="root";
$password="";
$database="dbstudentorgportal";
$conn = mysqli_connect($servername,$username,$password);
mysqli_select_db($conn, $database) or die ("Unable to select database");
?>
