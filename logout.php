<?php
session_start();

echo '<script>alert("You have been logged out.")</script>';
session_destroy();
header("Location:login.php");
?>
