<?php
include('../mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_course_archive SELECT * FROM tb_course WHERE course_id = '".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_course WHERE course_id = '".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Archived Course')
                    window.location.href='admin-course.php'</script>";
            }
            else
            {
                echo '<script> alert("Course Not Deleted"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Course Not Deleted"); </script>';
        }
    }
}
?>
