<?php
include('../mysql_connect.php');

if(isset($_POST['deletedata']))
{
    if(isset($_POST['delete_id'])){

        $query = "INSERT tb_officers_archive SELECT * FROM tb_officers WHERE student_id='".$_POST["delete_id"]."'";
        $result = @mysqli_query($conn, $query);
        if($result)
        {
            $query = "DELETE FROM tb_officers WHERE student_id='".$_POST["delete_id"]."'";
            $result = @mysqli_query($conn, $query);
            if($result)
            {
                $query = "UPDATE tb_students SET USER_TYPE = 1 WHERE STUDENT_ID='".$_POST["delete_id"]."'";
                $result = @mysqli_query($conn, $query);
                if($result)
                {
                  echo "<script type='text/javascript'>
                        alert('Archived User')
                        window.location.href='admin-officers-users.php'</script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'> alert('Data Not Deleted'); </script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'> alert('Data Not Deleted'); </script>";
        }
    }
}
?>
