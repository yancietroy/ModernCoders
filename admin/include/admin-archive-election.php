<?php
include('../../mysql_connect.php');

if (isset($_POST['delete-election'])) {
    $query = "INSERT tb_elections_archive SELECT * FROM tb_elections WHERE ELECTION_ID='" . $_POST["delete_id"] . "'";
    $result = @mysqli_query($conn, $query);
    if ($result) {

        $query = "DELETE FROM tb_elections WHERE ELECTION_ID='" . $_POST["delete_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {
            echo "<script type='text/javascript'>
                    alert('Archived Election')
                    window.location.href='../admin-election-list.php'</script>";
        } else {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
