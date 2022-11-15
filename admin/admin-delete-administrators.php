<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['deletedata'])) {
    if (isset($_POST['delete_id'])) {

        $query = "INSERT tb_admin_archive SELECT * FROM tb_admin WHERE ADMIN_ID='" . $_POST["delete_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_admin WHERE ADMIN_ID='" . $_POST["delete_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Archive Account",
                    "text" => "Admin account has been archived successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Archive Account",
                    "text" => "Unexpected error has been encountered while archiving the admin account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Archive Account",
                "text" => "Unexpected error has been encountered while archiving the admin account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-administrators-users.php");
    }
}
