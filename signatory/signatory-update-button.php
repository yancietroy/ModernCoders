<?php
    include('../mysql_connect.php');

    if (isset($_POST['updatedata']) || isset($pr) || isset($s))
    {
        $id =  $mysqli -> real_escape_string ($_POST['project_id']);
        $pr =  $mysqli -> real_escape_string ($_POST['project_remarks']);
        $s =  $mysqli -> real_escape_string ($_POST['status']);

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
