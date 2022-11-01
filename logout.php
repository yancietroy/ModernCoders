<?php
session_start();

$usertype = $_GET['type'] ?? 1;
if ($usertype == 0) {
    header("location:admin/index.php");
} else if ($usertype == 1) {
    header("location:index.php");
} else if ($usertype == 2) {
    header("location:officer-login.php");
} else if ($usertype == 3) {
    header("location:signatory-login.php");
}

session_destroy();
