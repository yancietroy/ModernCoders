<?php
include('../mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['course_id'])){

        $query = "INSERT tb_course SELECT * FROM tb_course_archive WHERE course_id = '".$_POST["course_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_course_archive WHERE course_id = '".$_POST["course_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result){
                $_SESSION["sweetalert"] = [
                    "title" => "Restored Course",
                    "text" => "Admin account has been restored successfully.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            } else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Course",
                    "text" => "Unexpected error has been encountered while restoring the admin account.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        }
        else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Course",
                "text" => "Unexpected error has been encountered while restoring the admin account.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }
        header("location:admin-archive-course.php");
    }
}
?>