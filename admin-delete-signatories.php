<?php
include('mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_signatories_archive SELECT * FROM tb_signatories WHERE school_id='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_signatories WHERE school_id='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Archived User')
                    window.location.href='admin-signatories-users.php'</script>";
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
