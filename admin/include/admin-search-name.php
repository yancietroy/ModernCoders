<?php
include('../../mysql_connect.php');
if (isset($_POST["query"])) {
    $query = $_POST['query'];
    $orgid = $_POST['orgid'];
    if ($orgid == 0) {
        $sql = "SELECT student_id as id,last_name as lname,first_name as fname,middle_initial as mname,section FROM tb_officers WHERE last_name LIKE '%$query%' OR first_name LIKE '%$query%'";
    } else {
        $sql = "SELECT STUDENT_ID as id,LAST_NAME as lname,FIRST_NAME as fname,MIDDLE_NAME as mname,SECTION as section FROM tb_students WHERE MORG_ID='$orgid' AND (LAST_NAME LIKE '%$query%' OR MIDDLE_NAME LIKE '%$query%' OR FIRST_NAME LIKE '%$query%')";
    }
    $result = @mysqli_query($conn, $sql);
    $rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
