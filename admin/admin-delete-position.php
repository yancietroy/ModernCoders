<?php
include('../mysql_connect.php');
session_start();
if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_position_archive SELECT * FROM tb_position WHERE POSITION_ID='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_position WHERE position_id='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
             if($result)
            {
                $_SESSION["sweetalert"] = [
                "title" => "Restored Position",
                "text" => "Successfully restored position",
                "icon" => "success", //success,warning,error,info
                "redirect" => null,
                ];
            }else
            {
                $_SESSION["sweetalert"] = [
                "title" => "Restore Position",
                "text" => "Error upon restoring position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
            }
        }
            else
            {
                $_SESSION["sweetalert"] = [
                "title" => "Restore Position",
                "text" => "Error upon restoring position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
            }
    }
        else
        {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Position",
                "text" => "Error upon restoring position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
        }
            header("Location:admin-archive-Position.php");
}
?>
