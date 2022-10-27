<?php
include('../mysql_connect.php');
  $qry = $conn->query("SELECT * FROM tb_survey_set where id = ".$_GET['id'])->fetch_array();
  foreach($qry as $k => $v){
  	if($k == 'title')
  		$k = 'stitle';
  	$$k = $v;
  }
  include('officer-add-survey.php');
  ?>