<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['restoredata'])) {
    if (isset($_POST['student_id'])) {

        $query = "INSERT tb_officers SELECT * FROM tb_officers_archive WHERE student_id='" . $_POST["student_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_officers_archive WHERE student_id='" . $_POST["student_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $query = "UPDATE tb_students SET USER_TYPE = 2 WHERE STUDENT_ID='" . $_POST["student_id"] . "'";
                $result = @mysqli_query($conn, $query);
                if ($result) {
                    $_SESSION["sweetalert"] = [
                        "title" => "Restore Account",
                        "text" => "Officer account has been restored successfully.",
                        "icon" => "success", //success,warning,error,info
                        "redirect" => null,
                    ];
                }
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Account",
                    "text" => "Unexpected error has been encountered while restoring the officer account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Account",
                "text" => "Unexpected error has been encountered while restoring the officer account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-archive-officers.php");
    }
}
