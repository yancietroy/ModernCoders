<?php

//fetch.php

include('../mysql_connect.php');

$column = array("STUDENT_ID", "FIRST_NAME", "MIDDLE_NAME", "LAST_NAME", "GENDER", "EMAIL", "YEAR_LEVEL", "AGE", "BIRTHDATE" );

$query = "SELECT * FROM tb_students ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE STUDENT_ID LIKE "%'.$_POST["search"]["value"].'%"
 OR FIRST_NAME LIKE "%'.$_POST["search"]["value"].'%"
 OR MIDDLE_NAME LIKE "%'.$_POST["search"]["value"].'%" 
 OR LAST_NAME LIKE "%'.$_POST["search"]["value"].'%" 
 OR GENDER LIKE "%'.$_POST["search"]["value"].'%"
 OR EMAIL LIKE "%'.$_POST["search"]["value"].'%"
 OR YEAR_LEVEL LIKE "%'.$_POST["search"]["value"].'%"
 OR AGE LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY STUDENT_ID DESC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['STUDENT_ID'];
 $sub_array[] = $row['FIRST_NAME'];
 $sub_array[] = $row['MIDDLE_NAME'];
 $sub_array[] = $row['LAST_NAME'];
 $sub_array[] = $row['GENDER'];
 $sub_array[] = $row['EMAIL'];
 $sub_array[] = $row['YEAR_LEVEL'];
 $sub_array[] = $row['AGE'];
 $sub_array[] = $row['BIRTHDATE'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM tb_students";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

echo json_encode($output);

?>