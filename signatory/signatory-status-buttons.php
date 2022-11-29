<?php
ob_start();
session_start();
$org_id = $_SESSION['temp_org'];
$orgid = $_SESSION['USER-ORG'];
$data_username = $_SESSION['SIGNATORY'] . ' ' . $_SESSION['USER-NAME'];
$data_userid = $_SESSION['USER-ID'];
$data_signatorytype = $_SESSION['SIGNATORY-TYPE'];
//$stid = $_SESSION['signatory_type_id'];
include('../mysql_connect.php');
if ($data_signatorytype == 4) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "For Revision";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to For Revision.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been moved for revision by the adviser.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Rejected";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Rejected.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been rejected by the adviser.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $cid =  $mysqli->real_escape_string($_POST['college_id']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Pending";
        $ati = 2;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Pending.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $sqlGetNextSig = "SELECT school_id FROM tb_signatories WHERE signatorytype_id='3' AND college_dept = '$cid'";
            if ($resNextSig = @mysqli_query($conn, $sqlGetNextSig)) {
                if ($resNextSig->num_rows > 0) {
                    $sqlNotifSig = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($nextSig = $resNextSig->fetch_assoc()) {
                        $nextId = $nextSig['school_id'];
                        array_push($values, "('$timestamp','$nextId','1','$pn','Project is now requiring your approval.','signatory-rso-pending.php?id=$oid')");
                    }

                    $sqlNotifSig .= implode(",", $values);
                    @mysqli_query($conn, $sqlNotifSig);
                }
            }

            $timestamp = time();
            $msg = "'$pn' has been approved by the adviser.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    }
} elseif ($data_signatorytype == 3) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "For Revision";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to For Revision.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been moved for revision by the Chair.','officer-revision.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            $timestamp = time();
            $msg = "'$pn' has been moved for revision by the Chair.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Rejected";

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Rejected.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been rejected by the Chair.','officer-rejected.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            $timestamp = time();
            $msg = "'$pn' has been rejected by the Chair.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $cid =  $mysqli->real_escape_string($_POST['college_id']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Pending";
        $ati = 3;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Pending.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
            if ($resOfficers = @mysqli_query($conn, $sqlGetOfficers)) {
                if ($resOfficers->num_rows > 0) {
                    $SqlNotif = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($officer = $resOfficers->fetch_assoc()) {
                        $uid = $officer['student_id'];
                        array_push($values, "('$timestamp','$uid','2','$pn','Project has been approved by the Chair.','officer-approved.php')");
                    }
                    $SqlNotif .= implode(",", $values);

                    @mysqli_query($conn, $SqlNotif);
                }
            }

            $sqlGetNextSig = "SELECT school_id FROM tb_signatories WHERE signatorytype_id='2' AND college_dept = '$cid'";
            if ($resNextSig = @mysqli_query($conn, $sqlGetNextSig)) {
                if ($resNextSig->num_rows > 0) {
                    $sqlNotifSig = "INSERT INTO tb_notification(notif_id,receiver,direction,title,message,data) VALUES ";
                    $values = [];

                    $timestamp = time();
                    while ($nextSig = $resNextSig->fetch_assoc()) {
                        $nextId = $nextSig['school_id'];
                        array_push($values, "('$timestamp','$nextId','1','$pn','Project is now requiring your approval.','signatory-rso-pending.php?id=$oid')");
                    }

                    $sqlNotifSig .= implode(",", $values);
                    @mysqli_query($conn, $sqlNotifSig);
                }
            }

            $timestamp = time();
            $msg = "'$pn' has been approved by the Chair.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    }
} elseif ($data_signatorytype == 2) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to For Revision.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been moved for revision by the Dean.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Rejected.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been rejected by the Dean.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Pending";
        $ati = 4;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Pending.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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
                        array_push($values, "('$timestamp','$nextId','1','$pn','Project is now requiring your approval.','signatory-rso-pending.php?id=$oid')");
                    }

                    $sqlNotifSig .= implode(",", $values);
                    @mysqli_query($conn, $sqlNotifSig);
                }
            }

            $timestamp = time();
            $msg = "'$pn' has been approved by the Dean.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    }
} elseif ($data_signatorytype == 1) {
    if (isset($_POST['Revise'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "For Revision";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to For Revision.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been moved for revision by the SDO.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Reject'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Rejected";
        $ati = 1;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Rejected.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been rejected by the SDO.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    } else if (isset($_POST['Approve'])) {
        $id =  $mysqli->real_escape_string($_POST['project_id']);
        $pr =  $mysqli->real_escape_string($_POST['project_remarks']);
        $pn =  $mysqli->real_escape_string($_POST['project_name']);
        $oid =  $mysqli->real_escape_string($_POST['org_id']);
        $s = "Approved";
        $ati = 5;

        $query = "SELECT * FROM `tb_projectmonitoring`;";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $query = "UPDATE `tb_projectmonitoring` SET `status` = '$s', `remarks` ='$pr', `status_date` = NOW(), `approval_id` = '$ati', `status_by` = '$data_username' WHERE `project_id` = '$id';";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["sweetalert"] = [
                    "title" => "Status Updated",
                    "text" => "Project is moved to Approved.",
                    "icon" => "success", //success,warning,error,info
                    "redirect" => null,
                ];
            }
            $sqlGetOfficers = "SELECT student_id FROM tb_officers WHERE org_id='$oid' AND position_id IN ('1','2','3','4','5')";
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

            $timestamp = time();
            $msg = "'$pn' has been approved by the SDO.";
            $msg = $mysqli->real_escape_string($msg);
            $queryLog = "INSERT INTO tb_project_logs(id, project_id, message, user_name, user_id) VALUES ('$timestamp','$id','$msg','$data_username','$data_userid')";
            @mysqli_query($conn, $queryLog);
        }
    }
}
header("location:signatory-rso-pending.php?id=$org_id");
