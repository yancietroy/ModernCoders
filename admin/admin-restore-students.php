<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['restoredata'])) {
    if (isset($_POST['STUDENT_ID'])) {

        $query = "INSERT tb_students SELECT * FROM tb_students_archive WHERE STUDENT_ID='" . $_POST["STUDENT_ID"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_students_archive WHERE STUDENT_ID='" . $_POST["STUDENT_ID"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Restored Account",
                    "text" => "Student account has been restored successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Account",
                    "text" => "Unexpected error has been encountered while restoring the student account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Account",
                "text" => "Unexpected error has been encountered while restoring the student account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-archive-students.php");
    }
}
