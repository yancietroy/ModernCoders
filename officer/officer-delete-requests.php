<?php
include('../mysql_connect.php');
session_start();

if (isset($_POST['deletedata'])) {
    if (isset($_POST['delete_id'])) {

            $query = "DELETE FROM tb_requests WHERE school_id='" . $_POST["delete_id"] . "'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Delete Request",
                    "text" => "Request has been Deleted successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Delete Request",
                    "text" => "Unexpected error has been encountered while deleting the request.",
                    "icon" => "error", //success,warning,error,info
                    "redirect" => null,
                ];
            }

        header("location:admin-signatories-users.php");
    }
}
?>