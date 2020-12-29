<?php
require_once "../config.php";
if(isset($_POST["ID"], $_POST["Name"], $_POST["Price"], $_POST["Displacement"], $_POST["StoreID"], $_POST["Description"]))
{
 $ID = mysqli_real_escape_string($connect, $_POST["ID"]);
 $name = mysqli_real_escape_string($connect, $_POST["Name"]);
 $price = mysqli_real_escape_string($connect, $_POST["Price"]);
 $disp = mysqli_real_escape_string($connect, $_POST["Displacement"]);
 $SID = mysqli_real_escape_string($connect, $_POST["StoreID"]);
 $des = mysqli_real_escape_string($connect, $_POST["Description"]);
 $query = "INSERT INTO motorcycle(ID, Name, Price, Displacement, StoreID, Description) VALUES('$ID', '$name', '$price', '$disp', '$SID', '$des')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>