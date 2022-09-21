<?php
include('mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['officer_id'])){

        $query = "INSERT tb_officers SELECT * FROM tb_officers_archive WHERE officer_id='".$_POST["officer_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_officers_archive WHERE officer_id='".$_POST["officer_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $_SESSION['msg'] = '<script>alert("Data Deleted")</script>';
                header("Location:admin-officers-archive.php");
            }
            else
            {
                echo '<script> alert("Data Not Deleted"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }
}
?>