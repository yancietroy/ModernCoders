<?php
include('mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['ADMIN_ID'])){

        $query = "INSERT tb_admin SELECT * FROM tb_admin_archive WHERE ADMIN_ID='".$_POST["ADMIN_ID"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_admin_archive WHERE ADMIN_ID='".$_POST["ADMIN_ID"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $_SESSION['msg'] = '<script>alert("Data Deleted")</script>';
                header("Location:admin-administrators-archive.php");
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
