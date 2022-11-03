<?php

include('mysql_connect.php');
$code = $_GET['code'] ?? -1;
if ($code <= 0) {
    echo "<script>alert('Verification code is invalid.'); location.href='index.php';</script>";
} else {
    $query = "SELECT student_id FROM tb_students WHERE VCODE='$code'";
    if ($res = @mysqli_query($conn, $query)) {
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $student_id = $row['student_id'];
            $sql = "UPDATE tb_students SET VCODE='' WHERE student_id='$student_id'";
            @mysqli_query($conn, $sql);
            echo "<script>alert('Email Successfully Verified!'); location.href='index.php';</script>";
        } else {
            echo "<script>alert('Verification code is invalid.'); location.href='index.php';</script>";
        }
    }
}
