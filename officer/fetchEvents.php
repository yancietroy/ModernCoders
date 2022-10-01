<?php

// Include database configuration file
require_once 'dbConfig.php';

// Filter events by calendar date
$where_sql = '';
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $where_sql .= " WHERE start_date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' ";
}

// Fetch events from database
$sql = "SELECT * FROM tb_projectmonitoring $where_sql";
$result = $conn->query($sql);

$eventsArr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($eventsArr, $row);
    }
}

// Render event data in JSON format
echo json_encode($eventsArr);
