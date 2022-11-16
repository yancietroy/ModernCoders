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
