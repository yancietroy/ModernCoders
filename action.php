<?php 
include('mysql_connect.php');
if(!empty($_POST["college_id"])){
	$coid = $_POST['college_id'];
	// Fetch college data based on specific course
	$query = "SELECT * FROM tb_course WHERE college_id = '$coid'";
	$result = @mysqli_query($conn, $query);
	// Generate HTML of state options list
		while($row = @mysqli_fetch_array($result)){
			echo '<option value="'.$row['course']. 'hidden ="' . $row['course_id'] . '">'.$row['course'].'</option>';
		}	
}
@mysqli_close($conn);
?>