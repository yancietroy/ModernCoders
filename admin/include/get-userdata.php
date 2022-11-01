<?php
// Type: 0=Admin, 1=Student, 2=Officer, 3=Signatory
function getProfilePicture($type, $userid)
{
    include '../mysql_connect.php';
    if ($type == 0) {
        $query = "SELECT PROFILE_PIC FROM tb_admin WHERE ADMIN_ID = '$userid'";
        $prefix = "../admin/pictures/";
    } else if ($type == 1) {
        $query = "SELECT PROFILE_PIC FROM tb_students WHERE STUDENT_ID = '$userid'";
        $prefix = "../student/pictures/";
    } else if ($type == 2) {
        $query = "SELECT PROFILE_PIC FROM tb_officers WHERE OFFICER_ID = '$userid'";
        $prefix = "../officer/pictures/";
    } else if ($type == 3) {
        $query = "SELECT PROFILE_PIC FROM tb_signatories WHERE SCHOOL_ID = '$userid'";
        $prefix = "../signatory/pictures/";
    }

    $pic = "pictures/img_avatar.png";
    $result = @mysqli_query($conn, $query);
    if ($result->num_rows) {
        $data = @mysqli_fetch_assoc($result);
        if (file_exists("pictures/" . $data['PROFILE_PIC'])) {
            $pic = $prefix . $data['PROFILE_PIC'];
        }
    }

    return $pic;
}

function checkProfilePicture($type, $path)
{
    if ($type == 0) {
        $prefix = "../admin/pictures/";
    } else if ($type == 1) {
        $prefix = "../student/pictures/";
    } else if ($type == 2) {
        $prefix = "../officer/pictures/";
    } else if ($type == 3) {
        $prefix = "../signatory/pictures/";
    }
    $pic = $prefix . "img_avatar.png";

    if (file_exists($prefix . $path)) {
        $pic = $prefix . $path;
    }

    return $pic;
}

function getOrgLogo($id)
{
    include '../mysql_connect.php';
    $query = "SELECT logo FROM tb_orgs WHERE ORG_ID = '$id'";

    $pic = "../assets/img/logos/jru-logo.png";
    $result = @mysqli_query($conn, $query);
    if ($result->num_rows) {
        $data = @mysqli_fetch_assoc($result);
        if (file_exists("../assets/img/logos/" . $data['logo'])) {
            $pic = "../assets/img/logos/" . $data['logo'];
        }
    }

    return $pic;
}
