<?php
    include('../mysql_connect.php'); include('profilepic.php');

    if (isset($_POST['updatedata']) || isset($pr) || isset($s))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = $_POST['status'];
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
              alert('Status updated!')
              </script>";
        header("Location:signatory-masterlist.php");
        }
    }
@mysqli_close($conn);
?>