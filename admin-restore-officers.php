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
              echo "<script type='text/javascript'>
                    alert('User Restored!')
                    window.location.href='admin-officers-archive.php'</script>";
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
