<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['restoredata'])) {
    if (isset($_POST['school_id'])) {

        $query = "INSERT tb_signatories SELECT * FROM tb_signatories_archive WHERE school_id='" . $_POST["school_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_signatories_archive WHERE school_id='" . $_POST["school_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Restored Account",
                    "text" => "Signatory account has been restored successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Account",
                    "text" => "Unexpected error has been encountered while restoring the signatory account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Account",
                "text" => "Unexpected error has been encountered while restoring the signatory account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-archive-signatories.php");
    }
}
