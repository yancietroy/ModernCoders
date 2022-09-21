<?php
include('mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['STUDENT_ID'])){

        $query = "INSERT tb_students SELECT * FROM tb_students_archive WHERE STUDENT_ID='".$_POST["STUDENT_ID"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_students_archive WHERE STUDENT_ID='".$_POST["STUDENT_ID"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $_SESSION['msg'] = '<script>alert("Data Deleted")</script>';
                header("Location:admin-students-archive.php");
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