<?php
	$conn = new mysqli('localhost', 'root', '', 'voting');
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>	