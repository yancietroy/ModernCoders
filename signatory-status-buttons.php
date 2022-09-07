<?php
    include('mysql_connect.php');

    if (isset($_POST['Revise']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "For Revision";

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
        header("Location:signatory-revision.php");
        }
    } else if (isset($_POST['Reject']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Rejected";

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
        header("Location:signatory-rejected.php");
        }
    } else if (isset($_POST['Approve']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Approved";

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
        header("Location:signatory-approved.php");
        }
    }
@mysqli_close($conn);
?>