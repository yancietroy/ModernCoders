<?php

// -1=static,0=admin,1=student,2=officer,3=signatories
function route($usertype)
{
    if (isset($_SESSION['USER-TYPE']) == false) {
        if ($usertype == 0) {
            header("location:../admin/index.php");
        } else if ($usertype == 1) {
            header("location:../index.php");
        } else if ($usertype == 2) {
            header("location:../officer-login.php");
        } else if ($usertype == 3) {
            header("location:../signatory-login.php");
        }
    } else if ($_SESSION['USER-TYPE'] != $usertype && $usertype >= 0) {
        if ($_SESSION['USER-TYPE'] == 0) {
            header("location:../admin/admin-index.php");
        } else if ($_SESSION['USER-TYPE'] == 1) {
            header("location:../student/student-index.php");
        } else if ($_SESSION['USER-TYPE'] == 2) {
            header("location:../officer/officer-index.php");
        } else if ($_SESSION['USER-TYPE'] == 3) {
            header("location:../signatory/signatory-index.php");
        }
    } else if ($_SESSION['USER-TYPE'] != $usertype && $usertype < 0) {
        if ($_SESSION['USER-TYPE'] == 0) {
            header("location:admin/admin-index.php");
        } else if ($_SESSION['USER-TYPE'] == 1) {
            header("location:student/student-index.php");
        } else if ($_SESSION['USER-TYPE'] == 2) {
            header("location:officer/officer-index.php");
        } else if ($_SESSION['USER-TYPE'] == 3) {
            header("location:signatory/signatory-index.php");
        }
    }
}
