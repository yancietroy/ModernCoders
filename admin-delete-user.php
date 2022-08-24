<?php
include('mysql_connect.php');

if(isset($_POST['deletedata']))
{
    $id = $_POST['STUDENT_ID'];

    $query = "DELETE FROM tb_students WHERE STUDENT_ID='$id'";
    $result = @mysqli_query($conn, $query);
    $row = @mysqli_fetch_array($result); 
    if($row)
    {
        echo json_encode($row); 
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:admin-users.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
?>