<?php
include('../mysql_connect.php');
session_start();
if(isset($_POST['restoredata']))
{
    if(isset($_POST['position_id'])){

        $query = "INSERT tb_position SELECT * FROM tb_position_archive WHERE POSITION_ID='".$_POST["position_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_position_archive WHERE position_id='".$_POST["position_id"]."'";
            $result = @mysqli_query($conn, $query);
             if($result)
            {
                $_SESSION["sweetalert"] = [
                "title" => "Archived Position",
                "text" => "Successfully archived position",
                "icon" => "success", //success,warning,error,info
                "redirect" => null,
                ];
            }else
            {
                $_SESSION["sweetalert"] = [
                "title" => "Archive Position",
                "text" => "Error upon archiving position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
            }
        }
            else
            {
                $_SESSION["sweetalert"] = [
                "title" => "Archive Position",
                "text" => "Error upon archiving position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
            }
    }
        else
        {
            $_SESSION["sweetalert"] = [
                "title" => "Archive Position",
                "text" => "Error upon archiving position",
                "icon" => "error", //success,warning,error,info
                "redirect" => null,
                ];
        }
            header("Location:admin-position-list.php");
}
?>