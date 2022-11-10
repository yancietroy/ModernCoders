<?php
ob_start();
session_start();

$orgid = $_SESSION['USER-ORG'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
//$stid = $_SESSION['signatory_type_id'];
include('../mysql_connect.php');

if ($data_signatorytype == 3) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "For Revision";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW() WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been moved for revision by your Adviser.','officer-revision.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Rejected";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW() WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been rejected by your Adviser.','officer-rejected.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Pending";
        $ati = 2;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been approved by your Adviser.','officer-pending.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            $sqlGetNextSig = "SELECT school_id FROM tb_signatories WHERE signatorytype_id='2'";
            if ($resNextSig = @mysqli_query($conn, $sqlGetNextSig)) {
                if ($resNextSig->num_rows > 0) {
                    $sqlNotifSig = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($nextSig = $resNextSig->fetch_assoc()) {
                        $nextId = $nextSig['school_id'];
                        array_push($values, "('$timestamp','$nextId','1','$pn','Project is now requiring your approval.','signatory-pending.php')");
                    }

                    $sqlNotifSig .= implode(",", $values);
                    @mysqli_query($conn, $sqlNotifSig);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
} elseif ($data_signatorytype == 2) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been moved for revision by the Dean.','officer-revision.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been rejected by the Dean.','officer-rejected.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Pending";
        $ati = 3;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been approved by the Dean.','officer-pending.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            $sqlGetNextSig = "SELECT school_id FROM tb_signatories WHERE signatorytype_id='1'";
            if ($resNextSig = @mysqli_query($conn, $sqlGetNextSig)) {
                if ($resNextSig->num_rows > 0) {
                    $sqlNotifSig = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($nextSig = $resNextSig->fetch_assoc()) {
                        $nextId = $nextSig['school_id'];
                        array_push($values, "('$timestamp','$nextId','1','$pn','Project is now requiring your approval.','signatory-pending.php')");
                    }

                    $sqlNotifSig .= implode(",", $values);
                    @mysqli_query($conn, $sqlNotifSig);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
} elseif ($data_signatorytype == 1) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been moved for revision by the SDO.','officer-revision.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been rejected by the SDO.','officer-rejected.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $s = "Approved";
        $ati = 4;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);

            $oid = $_SESSION['USER-ORG'];
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been approved by the SDO.','officer-approved.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            echo "<script type='text/javascript'>
        alert('Status updated!')
        window.location.href='signatory-pending.php'</script>";
        }
    }
}
@mysqli_close($conn);
