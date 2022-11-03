<?php
include('mysql_connect.php');
if (isset($_POST['college_id'])) {
	$query = "SELECT course_id, course FROM tb_course WHERE college_id = " . $_POST['college_id'];
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		echo '<option class="greyclr" selected disabled value="" text-muted>Select Course</option>';
		while ($row = $result->fetch_array()) {
			echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
		}
	} else {
		echo '<option>No Course Found!</option>';
	}
} elseif (isset($_POST['org_id'])) {
	$oid = $_POST['org_id'];
	$query = "SELECT ORG_ID, ORG FROM tb_orgs WHERE course_ids LIKE '%[$oid]%'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		echo '<option class="greyclr" selected disabled value="" text-muted>Select Organization</option>';
		while ($row = $result->fetch_array()) {
			echo '<option value="' . $row[0] .  '" >' . $row[1] . '</option>';
		}
	} else {
		echo '<option>No Organization Found!</option>';
	}
}
