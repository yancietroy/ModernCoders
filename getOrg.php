<?php 
include('mysql_connect.php');

if(isset($coid)){
	$coid = $_POST['college_id'];
	// Fetch college data based on specific organization
	$query = "SELECT * FROM tb_morg WHERE college_id = $coid";
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
    $options = '<option class="greyclr" selected disabled value="" text-muted>Select Course</option>';
	// Generate HTML of state options list
		while($row = @mysqli_fetch_array($result)) {
            echo '<option value="'.$row['MORG_ID']. '">'.$row['MOTHER_ORG'].'</option>';
        }	
        //echo $options;
}
@mysqli_close($conn);
?>