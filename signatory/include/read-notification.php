<?php

include('../../mysql_connect.php');

if (isset($_POST['notif_id'])) {
    $id = $_POST['notif_id'];
    $sqlUpd = "UPDATE tb_notification SET is_read='1' WHERE notif_id = $id";
    mysqli_query($conn, $sqlUpd);
}
