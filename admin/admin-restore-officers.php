<?php
include('../mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['student_id'])){

        $query = "INSERT tb_officers SELECT * FROM tb_officers_archive WHERE student_id='".$_POST["student_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_officers_archive WHERE student_id='".$_POST["student_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              $query = "UPDATE tb_students SET USER_TYPE = 2 WHERE STUDENT_ID='".$_POST["student_id"]."'";
                $result = @mysqli_query($conn, $query);
                if($result)
                {
                  echo "<script type='text/javascript'>
                        alert('User Restored!')
                        window.location.href='admin-archive-officers.php'</script>";
                }
            }
            else
            {
                echo '<script type="text/javascript"> alert("Data Not Deleted"); </script>';
            }
        }
        else
        {
            echo '<script type="text/javascript"> alert("Data Not Deleted"); </script>';
        }
    }
}
?>
