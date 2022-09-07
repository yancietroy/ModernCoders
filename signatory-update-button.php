<?php
    include('mysql_connect.php');

    if (isset($_POST['updatedata']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = $_POST['status'];

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
              alert('Status updated!')
              </script>";
        header("Location:signatory-masterlist.php");
        }
    }
@mysqli_close($conn);
?>