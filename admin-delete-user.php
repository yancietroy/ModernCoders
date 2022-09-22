<?php
include('mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_students_archive SELECT * FROM tb_students WHERE STUDENT_ID='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_students WHERE STUDENT_ID='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Archived User')
                    window.location.href='admin-students.php'</script>";
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
