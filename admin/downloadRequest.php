<?php
include('../mysql_connect.php');
// Downloads files
if (isset($_GET['org_req_id'])) {
    $oi = $_GET['org_req_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM tb_org_application WHERE org_req_id = $oi";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'attachments/' . $file['requirements'];

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