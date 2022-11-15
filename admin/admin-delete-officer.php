<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['deletedata'])) {
    if (isset($_POST['delete_id'])) {

        $query = "INSERT tb_officers_archive SELECT * FROM tb_officers WHERE student_id='" . $_POST["delete_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_officers WHERE student_id='" . $_POST["delete_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $query = "UPDATE tb_students SET USER_TYPE = 1 WHERE STUDENT_ID='" . $_POST["delete_id"] . "'";
                $result = @mysqli_query($conn, $query);
                if ($result) {
                    $_SESSION["sweetalert"] = [
                        "title" => "Archive Account",
                        "text" => "Officer account has been archived successfully.",
                        "icon" => "success", //success,warning,error,info
                        "redirect" => null,
                    ];
                }
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Archive Account",
                    "text" => "Unexpected error has been encountered while archiving the officer account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Archive Account",
                "text" => "Unexpected error has been encountered while archiving the officer account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-officers-users.php");
    }
}
