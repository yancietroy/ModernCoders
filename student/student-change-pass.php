<?php

include('../mysql_connect.php');
ob_start();
session_start();
if (isset($_POST['changePassword'])) {
    $si = $_POST['cid'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM tb_students";
    $result = @mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if ($row) {
        $query = "UPDATE `tb_students` SET `PASSWORD` = SHA('$pass') WHERE `STUDENT_ID` = '$si'";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
			alert('Successfuly updated!')
			window.location.href='student-profile.php'</script>";
    }
}
