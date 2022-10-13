<?php
include('../mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_projects_archive SELECT * FROM tb_projectmonitoring WHERE project_id='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {

            $query = "DELETE FROM tb_projectmonitoring WHERE project_id='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
              echo "<script type='text/javascript'>
                    alert('Archived Project')</script>";
            }
            else
            {
                echo '<script> alert("Project Not Archived"); </script>';
            }
        }
        else
        {
            echo '<script> alert("Project Not Archived"); </script>';
        }
    }
}
?>
