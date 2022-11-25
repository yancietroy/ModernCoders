<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['deletedata'])) {
    if (isset($_POST['delete_id'])) {

        $query = "INSERT tb_collegedept_archive SELECT * FROM tb_collegedept WHERE college_id='" . $_POST["delete_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {

            $query = "DELETE FROM tb_collegedept WHERE college_id='" . $_POST["delete_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Archived College",
                    "text" => "College details has been archived successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Archive College",
                    "text" => "Unexpected error has been encountered while archiving the college details.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Archive College",
                "text" => "Unexpected error has been encountered while archiving the college details.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }

        header("location:admin-college.php");
    }
}
