<?php
//fetch.php
require_once "../../../config.php";

$columns = array('ID', 'Name', 'Price', 'Displacement', 'StoreID', 'Description');

$query = "SELECT * FROM motorcycle WHERE StoreID = '".$_POST["storeID"]."'
AND ID NOT IN (SELECT RentMotorID FROM customer)
";

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
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="ID">' . $row["ID"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="Price">' . $row["Price"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="Displacement">' . $row["Displacement"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="StoreID">' . $row["StoreID"] . '</div>';
 $sub_array[] = '<div class="update" data-id="'.$row["ID"].'" data-column="Description">' . $row["Description"] . '</div>';
 $sub_array[] = '<button type="button" name="rent" class="btn btn-success btn-xs rent" ID="'.$row["ID"].'">Rent</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM motorcycle";
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