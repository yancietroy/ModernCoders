<?php
	include 'session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['FIRST_NAME'];
		$lastname = $_POST['LAST_NAME'];
		$position = $_POST['position'];

		$sql = "INSERT INTO tb_candidate (position_id, first_name, last_name) VALUES ('$position', '$firstname', '$lastname')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates.php');
?>