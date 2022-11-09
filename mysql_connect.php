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

<?php
$mysqli = new mysqli("$servername","$username","$password","$database");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
 ?>
