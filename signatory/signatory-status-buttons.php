<?php
ob_start();
session_start();
$org_id = $_SESSION['org_id'];
if(!isset($_SESSION['org_id'])){
  unset($org_id);
}
$id = $_SESSION['use'];
unset($_SESSION['pid']);
$stid = $_SESSION['signatory_type_id'];
include('../mysql_connect.php');
if(isset($_SESSION['msg'])){
    print_r($_SESSION['msg']);#display message
    unset($_SESSION['msg']); #remove it from session array, so it doesn't get displayed twice
} else if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
    header("Location:../signatory-login.php");
  }
    include('../mysql_connect.php');
if ($stid == 3){
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
}elseif($stid == 2){
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
}elseif($stid == 1){
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
