<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");

$columns = array('ID', 'Name', 'RentDays', 'RentMotorID', 'Phone', 'Description');

$query = "SELECT * FROM customer ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE ID LIKE "%'.$_POST["search"]["value"].'%" 
 OR Name LIKE "%'.$_POST["search"]["value"].'%"
 OR RentMotorID LIKE "%'.$_POST["search"]["value"].'%"
 OR Phone LIKE "%'.$_POST["search"]["value"].'%"
 OR Description LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();//$row[]的index要跟資料庫屬性名稱一樣
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="ID">' . $row["ID"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="RentDays">' . $row["RentDays"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="RentMotorID">' . $row["RentMotorID"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Phone">' . $row["Phone"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Description">' . $row["Description"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" ID="'.$row["ID"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM customer";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>