<?php
include('mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['school_id'])){

        $query = "INSERT tb_signatories SELECT * FROM tb_signatories_archive WHERE school_id='".$_POST["school_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_signatories_archive WHERE school_id='".$_POST["school_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $_SESSION['msg'] = '<script>alert("Data Deleted")</script>';
                header("Location:admin-signatories-archive.php");
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
