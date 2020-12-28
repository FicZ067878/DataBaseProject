<?php
//$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
require_once "../config.php";
if(isset($_POST["ID"], $_POST["name"], $_POST["address"], $_POST["phone"]))
{
 $ID = mysqli_real_escape_string($connect, $_POST["ID"]);
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $address = mysqli_real_escape_string($connect, $_POST["address"]);
 $phone = mysqli_real_escape_string($connect, $_POST["phone"]);
 $query = "INSERT INTO store(ID, name, address, phone) VALUES('$ID', '$name', '$address', '$phone')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>