<?php include('mysql_connect.php');

$output= array();
$sql = "SELECT * FROM tb_students";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'STUDENT_ID',
	1 => 'FIRST_NAME',
	2 => 'MIDDLE_NAME',
	3 => 'LAST_NAME',
	4 => 'GENDER',
	5 => 'EMAIL',
	6 => 'YEAR_LEVEL',
	7 => 'AGE',
	8 => 'BIRTHDATE',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE STUDENT_ID like '%".$search_value."%'";
	$sql .= " OR FIRST_NAME like '%".$search_value."%'";
	$sql .= " OR MIDDLE_NAME like '%".$search_value."%'";
	$sql .= " OR GENDER like '%".$search_value."%'";
	$sql .= " OR EMAIL like '%".$search_value."%'";
	$sql .= " OR YEAR_LEVEL like '%".$search_value."%'";
	$sql .= " OR AGE like '%".$search_value."%'";
	$sql .= " OR BIRTHDATE like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY STUDENT_ID desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  " . $start . ", " . $length;
}	

$query = mysqli_query($conn,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
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
		$sub_array[] = '<a href="javascript:void();" data-id="'.$row['STUDENT_ID'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['STUDENT_ID'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
