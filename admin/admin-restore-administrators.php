<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['restoredata'])) {
    if (isset($_POST['ADMIN_ID'])) {

        $query = "INSERT tb_admin SELECT * FROM tb_admin_archive WHERE ADMIN_ID='" . $_POST["ADMIN_ID"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_admin_archive WHERE ADMIN_ID='" . $_POST["ADMIN_ID"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Restored Account",
                    "text" => "Admin account has been restored successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Account",
                    "text" => "Unexpected error has been encountered while restoring the admin account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Account",
                "text" => "Unexpected error has been encountered while restoring the admin account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-archive-administrators.php");
    }
}
