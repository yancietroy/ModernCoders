<?php
include('../mysql_connect.php');
session_start();

if(isset($_POST['restoredata']))
{
    if(isset($_POST['college_id'])){

        $query = "INSERT tb_collegedept SELECT * FROM tb_collegedept_archive WHERE college_id='".$_POST["college_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_collegedept_archive WHERE college_id='".$_POST["college_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Restored College",
                    "text" => "Admin account has been restored successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore College",
                    "text" => "Unexpected error has been encountered while restoring the admin account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
       } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore College",
                "text" => "Unexpected error has been encountered while restoring the admin account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }
        header("location:admin-archive-college.php");
    }
}
?>