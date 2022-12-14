<?php
include('../mysql_connect.php');
// Downloads files
if (isset($_GET['project_id'])) {
    $pi = $mysqli->real_escape_string($_GET['project_id']);

    // fetch file to download from database
    $sql = "SELECT * FROM tb_projectmonitoring WHERE project_id = '$pi'";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../officer/attachments/' . $file['attachments'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }
}
?>