<?php
include('../mysql_connect.php');
session_start();

if(isset($_POST['restoredata']))
{
    if(isset($_POST['ORG_ID'])){

        $query = "INSERT tb_orgs SELECT * FROM tb_orgs_archive WHERE ORG_ID='".$_POST["ORG_ID"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {
            $query = "DELETE FROM tb_orgs_archive WHERE ORG_ID='".$_POST["ORG_ID"]."'";
            $result = @mysqli_query($conn, $query);
                if($result){
                    $_SESSION["sweetalert"] = [
                        "title" => "Restored Organization",
                        "text" => "Student Organization has been restored successfully.",
                        "icon" => "success", //success,warning,error,info
                        "redirect" => null,
                    ];
                }
              else {
                $_SESSION["sweetalert"] = [
                    "title" => "Restore Organization",
                    "text" => "Unexpected error has been encountered while restoring Student Organization.",
                    "icon" => "warning", //success,warning,error,info
                    "redirect" => null,
                ];
            }
        } else {
            $_SESSION["sweetalert"] = [
                "title" => "Restore Organization",
                "text" => "Unexpected error has been encountered while restoring Student Organization.",
                "icon" => "warning", //success,warning,error,info
                "redirect" => null,
            ];
        }
        header("location:admin-orgs-archive.php");
    }
}
?>
