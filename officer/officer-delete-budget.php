<?php
include('../mysql_connect.php');
session_start();
if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_budget_codes_archive SELECT * FROM tb_budget_codes WHERE id='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_budget_codes WHERE id='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
           {
               $_SESSION["sweetalert"] = [
               "title" => "Archived Budget Code",
               "text" => "Successfully archived Budget Code",
               "icon" => "success", //success,warning,error,info
               "redirect" => null,
               ];
           }else
           {
               $_SESSION["sweetalert"] = [
               "title" => "Archive Budget Code",
               "text" => "Error upon archiving Budget Code",
               "icon" => "error", //success,warning,error,info
               "redirect" => null,
               ];
           }
       }
           else
           {
               $_SESSION["sweetalert"] = [
               "title" => "Archive Budget Code",
               "text" => "Error upon archiving Budget Code",
               "icon" => "error", //success,warning,error,info
               "redirect" => null,
               ];
           }
   }
       else
       {
           $_SESSION["sweetalert"] = [
               "title" => "Archive Budget Code",
               "text" => "Error upon archiving Budget Code",
               "icon" => "error", //success,warning,error,info
               "redirect" => null,
               ];
       }
           header("Location:budget-codes.php");
}
?>
