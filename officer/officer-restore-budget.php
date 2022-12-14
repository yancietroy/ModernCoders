<?php
include('../mysql_connect.php');
session_start();
if(isset($_POST['restoredata']))
{
    if(isset($_POST['id'])){

        $query = "INSERT tb_budget_codes SELECT * FROM tb_budget_codes_archive WHERE id='".$_POST["id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_budget_codes_archive WHERE id='".$_POST["id"]."'";
            $result = @mysqli_query($conn, $query);
if($result)
{
   $_SESSION["sweetalert"] = [
   "title" => "Restored Budget Codes",
   "text" => "Successfully restored Budget Codes",
   "icon" => "success", //success,warning,error,info
   "redirect" => null,
   ];
}else
{
   $_SESSION["sweetalert"] = [
   "title" => "Restore Budget Codes",
   "text" => "Error upon restoring Budget Codes",
   "icon" => "error", //success,warning,error,info
   "redirect" => null,
   ];
}
}
else
{
   $_SESSION["sweetalert"] = [
   "title" => "Restore Budget Codes",
   "text" => "Error upon restoring Budget Codes",
   "icon" => "error", //success,warning,error,info
   "redirect" => null,
   ];
}
}
else
{
$_SESSION["sweetalert"] = [
   "title" => "Restore Budget Codes",
   "text" => "Error upon restoring Budget Codes",
   "icon" => "error", //success,warning,error,info
   "redirect" => null,
   ];
}
header("Location:budget-codes-archive.php");
}
?>
