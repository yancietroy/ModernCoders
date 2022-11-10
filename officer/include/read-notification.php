<?php

include('../../mysql_connect.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sqlUpd = "UPDATE tb_notification SET is_read='1' WHERE id = $id";
    mysqli_query($conn, $sqlUpd);
}
