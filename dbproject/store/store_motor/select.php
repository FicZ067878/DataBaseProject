<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");

//print_r($_POST);



$query = "SELECT * FROM motorcycle WHERE StoreID = '".$_POST["storeID"]."'";
//$query = "SELECT * FROM motorcycle WHERE StoreID = 31";
//echo $id;
if(isset($_POST["storeID"]))
{
   //echo $_POST["storeID"];
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE ID LIKE "%'.$_POST["search"]["value"].'%" 
 OR Name LIKE "%'.$_POST["search"]["value"].'%"
 OR Price LIKE "%'.$_POST["search"]["value"].'%"
 OR Displacement LIKE "%'.$_POST["search"]["value"].'%"
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
/*
if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
*/
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();//$row[]的index要跟資料庫屬性名稱一樣
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="ID">' . $row["ID"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Price">' . $row["Price"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Displacement">' . $row["Displacement"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="StoreID">' . $row["StoreID"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["ID"].'" data-column="Description">' . $row["Description"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" ID="'.$row["ID"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM motorcycle WHERE StoreID = '".$_POST["storeID"]."'";
 //$query = "SELECT * FROM motorcycle WHERE StoreID = 31";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => $number_filter_row,
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>