<?php
include('../mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['college_id'])){

        $query = "INSERT tb_collegedept SELECT * FROM tb_collegedept_archive WHERE college_id='".$_POST["college_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_collegedept_archive WHERE college_id='".$_POST["college_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Restored Department')
                    window.location.href='admin-archive-college.php'</script>";
            }
            else
            {
                echo '<script> alert("Data Not Restored"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Data Not Restored"); </script>';
        }
    }
}
?>