<?php
ob_start();
session_start();

$orgid = $_SESSION['USER-ORG'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
$stid = $_SESSION['signatory_type_id'];
include('../mysql_connect.php');

if ($data_signatorytype == 3){
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
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW() WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
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
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW() WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Pending";
        $ati = 2;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
}elseif($data_signatorytype == 2){
    if (isset($_POST['Revise']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Reject']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Pending";
        $ati = 3;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
}elseif($data_signatorytype == 1){
    if (isset($_POST['Revise']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Reject']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve']))
    {
        $id = $_POST['project_id'];
        $pr = $_POST['project_remarks'];
        $s = "Approved";
        $ati = 4;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if($row)
        {
        $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
        $result = @mysqli_query($conn, $query);
        echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
}
@mysqli_close($conn);
?>
