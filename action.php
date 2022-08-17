<?php 
include('mysql_connect.php');

if(isset($coid)){
	$coid = $_POST['college_id'];
	// Fetch college data based on specific course
	$query = "SELECT * FROM tb_course WHERE college_id = $coid";
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
    $options = '<option class="greyclr" selected disabled value="" text-muted>Select Course</option>';
	// Generate HTML of state options list
		while($row = @mysqli_fetch_assoc($result)) {
            $options .= '<option value="'.$row['course_id']. '">'.$row['course'].'</option>';
        }	
        echo $options;
}
@mysqli_close($conn);
?>