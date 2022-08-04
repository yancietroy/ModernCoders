<?php
/*
------------------------------------------------------------------------------------------------------
Script Name: mysql_connect.php
Author: <type your name>
Description: To connect to the MySQL server and database
------------------------------------------------------------------------------------------------------
*/
$username ="root";
$password="";
$database="dbstudentorgportal";
$conn = mysqli_connect("localhost",$username,$password);
mysqli_select_db($conn, $database) or die ("Unable to select database");
?>

<?php

  class Config {
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'dbstudentorgportal';

    private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';

    protected $connect = null;

    // Method for connection to the database
    public function __construct() {
      try {
        $this->connect = new PDO($this->dsn, self::DBUSER, self::DBPASS);
        $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
      }
    }
  }

?>