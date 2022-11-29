<?php
include('../../mysql_connect.php');
if (isset($_POST['question_id'])) {
    $question_id = $_POST['question_id'];

    $query = "SELECT submitted as date,answer as answer FROM tb_survey_answers WHERE question_id='$question_id' ORDER BY submitted DESC";

    $result = @mysqli_query($conn, $query);
    $rows = @mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
