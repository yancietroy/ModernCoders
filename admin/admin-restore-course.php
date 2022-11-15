<?php
include('../mysql_connect.php');

if(isset($_POST['restoredata']))
{
    if(isset($_POST['course_id'])){

        $query = "INSERT tb_course SELECT * FROM tb_course_archive WHERE course_id = '".$_POST["course_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_course_archive WHERE course_id = '".$_POST["course_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Restored Course')
                    window.location.href='admin-archive-course.php'</script>";
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