<?php
include('../../mysql_connect.php');

if (isset($_POST['delete-survey'])) {
    $query = "INSERT tb_surveys_archive SELECT * FROM tb_surveys WHERE survey_id='" . $_POST["delete_id"] . "'";
    $result = @mysqli_query($conn, $query);
    if ($result) {

        $query = "DELETE FROM tb_surveys WHERE survey_id='" . $_POST["delete_id"] . "'";
        $result = @mysqli_query($conn, $query);
        if ($result) {
            echo "<script type='text/javascript'>
                    alert('Archived Election')
                    window.location.href='../officer-survey-list.php'</script>";
        } else {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
